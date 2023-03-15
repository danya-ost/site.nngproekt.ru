<?php

namespace frontend\controllers;

use frontend\models\Honor;
use frontend\models\HonorContent;
use frontend\models\ResendVerificationEmailForm;
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
 * Honor controller
 */
class HonorController extends Controller
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
            $modelH = Honor::find()->where(['status_delete' => 0])->all();
            $data = [];
            foreach ( $modelH as $item ){
                $data[] = HonorContent::find()->where(['honor_id' => $item['id']])->one();
            }
            return $this->render('index', [
                'data' => $data
            ]);
        } else{ return $this->redirect(['/site/index']); }
    }

    /** Displays adding form. @return mixed */
    public function actionAddForm()
    {
        if ( tools::isAuth() ){
            return $this->render('add-from');
        } else{ return $this->redirect(['/site/index']); }
    }

    /** Adding new honor people. @return mixed */
    public function actionAddHonor()
    {
        if ( tools::isAuth() && tools::isAjax() && tools::isPost() ){
            $modelH = new Honor();
            $modelH->user_id = tools::idUser();
            $modelH->status = 1;
            $modelH->status_delete = 0;
            if ( $modelH->save() ){
                $modelHC = new HonorContent();
                $modelHC->honor_id = $modelH->id;
                $modelHC->user_id = tools::getPost('id');
                $modelHC->text = tools::getPost('text');
                $modelHC->save();
            }
        } else{ return $this->redirect(['/site/index']); }
    }

    /** Deleting new honor people. @return mixed */
    public function actionDeleteHonor()
    {
        if ( tools::isAuth() && tools::isAjax() && tools::isPost() ){
            $modelH = Honor::find()->where(['id' => tools::getPost('delete_id')])->one();
            $modelH->user_id = tools::idUser();
            $modelH->status = 0;
            $modelH->status_delete = 1;
            $modelH->save();
        } else{ return $this->redirect(['/site/index']); }
    }

}
