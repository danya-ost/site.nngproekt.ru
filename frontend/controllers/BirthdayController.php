<?php

namespace frontend\controllers;

use frontend\models\ResendVerificationEmailForm;
use frontend\models\UserAvatar;
use frontend\models\UserData;
use frontend\models\VerifyEmailForm;
use frontend\tools\tools;
use Yii;
use yii\base\InvalidArgumentException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;
use frontend\models\ContactForm;

/**
 * Birthday controller
 */
class BirthdayController extends Controller
{

    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout', 'signup'],
                'rules' => [
                    [
                        'actions' => ['signup'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /** Displays homepage. @return mixed */
    public function actionIndex()
    {
        if ( tools::isAuth() ){
            return $this->render('index');
        } else{ return $this->redirect(['/site/index']); }
    }

    /** returns the nearest birthdays @return mixed */
    public function actionNearestBirthday()
    {
        if ( tools::isAuth() && tools::isAjax() && tools::isPost() ){
            $today_day = date('j');
            $today_month = date('n');
            $today_year = date('Y');
            $data_nearest = [];
            $birthday = true;
            while ( $birthday ){
                $modelUD = UserData::find()->where(['birthday_day' => $today_day])->andWhere(['birthday_month' => $today_month])->all();
                if ( count($modelUD) > 0 ){
                    foreach ( $modelUD as $ud ){
                        $data_nearest[] = $ud;
                    }
                    $birthday = false;
                } else{
                    if ( $today_day <= 30 ){
                        $today_day++;
                    } else{
                       if ( $today_month <= 11 ){
                           $today_day = 1;
                           $today_month++;
                       } else{
                           $birthday = false;
                       }
                    }
                }
            }
            $found_dmy = $today_day . '~' . $today_month . '~' . $today_year;
            $data_nearest_next = [];
            $birthday_next = true;
            $found_dmy_next = NULL;
            if ( count($data_nearest) >= 1 ){
                if ( $today_day <= 30 ){
                    $today_day++;
                } else{
                    if ( $today_month <= 11 ) {
                        $today_day = 1;
                        $today_month++;
                    } else{
                        $today_day = 1;
                        $today_month = 1;
                        $today_year = (int) $today_year + 1;
                    }
                }
                while ( $birthday_next ){
                    $modelUD = UserData::find()->where(['birthday_day' => $today_day])->andWhere(['birthday_month' => $today_month])->all();
                    if ( count($modelUD) > 0 ){
                        foreach ( $modelUD as $ud ){
                            $data_nearest_next[] = $ud;
                        }
                        $birthday_next = false;
                    } else{
                        if ( $today_day <= 30 ){
                            $today_day++;
                        } else{
                            if ( $today_month <= 11 ){
                                $today_day = 1;
                                $today_month++;
                            } else{
                                $birthday_next = false;
                            }
                        }
                    }
                }
                $found_dmy_next = $today_day . '~' . $today_month . '~' . $today_year;
            }
            if ( count($data_nearest) > 0 ){
                return $this->renderAjax('birthday-module', [
                    'data_nearest' => $data_nearest,
                    'found_dmy' => $found_dmy,
                    'data_nearest_next' => $data_nearest_next,
                    'found_dmy_next' => $found_dmy_next
                ]);
            } else{
                return 'В ближайшие дни, день рождение никто не празднует...';
            }
        } else{ return $this->redirect(['/site/index']); }
    }
}
