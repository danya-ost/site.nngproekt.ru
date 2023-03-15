<?php

namespace frontend\controllers;

use common\models\User;
use frontend\models\DepartmentContent;
use frontend\models\DepartmentWorker;
use frontend\models\UserAvatar;
use frontend\models\UserData;
use frontend\models\UserMentor;
use frontend\models\UserTelephone;
use frontend\tools\tools;
use yii\db\Expression;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

/**
 * Manual controller
 */
class ManualController extends Controller
{

    /** {@inheritdoc} */
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

    /** {@inheritdoc} */
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

    public function getManual($model){
        $data = [];
        foreach ( $model as $item ){
            $modelUD = UserData::find()->where(['user_id' => $item['id']])->one();
            $modelUA = UserAvatar::find()->where(['user_id' => $item['id']])->one();
            $modelUT = UserTelephone::find()->where(['user_id' => $item['id']])->one();
            $modelDW = DepartmentWorker::find()->where(['user_id' => $item['id']])->one();
            if ( $modelDW ){
                if ( $modelDW['department_id'] != NULL ){
                    $modelDC = DepartmentContent::find()->where(['department_id' => $modelDW['department_id']])->one();
                } elseif ( $modelDW['middle_id'] != NULL ){
                    $modelDC = DepartmentContent::find()->where(['middle_id' => $modelDW['middle_id']])->one();
                } else{
                    $modelDC = DepartmentContent::find()->where(['bottom_id' => $modelDW['bottom_id']])->one();
                }
                $modelDW = $modelDC['title'];
            } else{
                $modelDW = 'ННГП';
            }
            $birthday_m = $modelUD['birthday_month'];
            switch ($birthday_m){
                case 1:
                    $birthday_m = 'января';
                    break;
                case 2:
                    $birthday_m = 'февраля';
                    break;
                case 3:
                    $birthday_m = 'марта';
                    break;
                case 4:
                    $birthday_m = 'апреля';
                    break;
                case 5:
                    $birthday_m = 'мая';
                    break;
                case 6:
                    $birthday_m = 'июня';
                    break;
                case 7:
                    $birthday_m = 'июля';
                    break;
                case 8:
                    $birthday_m = 'августа';
                    break;
                case 9:
                    $birthday_m = 'сентября';
                    break;
                case 10:
                    $birthday_m = 'октября';
                    break;
                case 11:
                    $birthday_m = 'ноября';
                    break;
                case 12:
                    $birthday_m = 'декабря';
                    break;
            }
            $data[] = [
                'id'            => $item['id'],
                'fullname'      => $modelUD['fullname'],
                'job'           => $modelUD['job'],
                'department'    => $modelDW,
                'email'         => $item['email'],
                'telephone'     => $modelUT['telephone'],
                'avatar'        => $modelUA['src'],
                'in_work'       => $modelUD['in_work'],
                'birthday'      => $modelUD['birthday_day'] . ' ' . $birthday_m
            ];
        }
        return $data;
    }

    /** Displays homepage @return mixed  */
    public function actionIndex()
    {
        if ( tools::isAuth() ){
            $alpha = 'А';
            $data = UserData::find()->where(new Expression('surname LIKE :term', [':term' => $alpha.'%']))->all();
            $model = [];
            foreach ( $data as $item ){
                $user = User::find()->where(['id' => $item['user_id']])->andWhere(['!=', 'id', 1])->one();
                if ( $user && $user['status'] == 10 ){
                    $model[] = $user;
                }
            }
            return $this->render('index', [
                'data' => $this->getManual($model)
            ]);
        } else{ return $this->redirect(['/site/index']); }
    }

    /** Returned workers to ajax page @return mixed */
    public function actionViewWorkers()
    {
        if ( tools::isAuth() && tools::isAjax() && tools::isPost() ){
            $alpha = tools::getPost('alpha');
            $data = UserData::find()->where(new Expression('surname LIKE :term', [':term' => $alpha.'%']))->all();
            $model = [];
            foreach ( $data as $item ){
                $user = User::find()->where(['id' => $item['user_id']])->andWhere(['!=', 'id', 1])->one();
                if ( $user && $user['status'] == 10 ){
                    $model[] = $user;
                }
            }
            return $this->renderAjax('view-workers', [
                'data' => $this->getManual($model)
            ]);
        }
    }

    /** Returned departments to ajax page @return mixed */
    public function actionViewDepartments()
    {
        if ( tools::isAuth() && tools::isAjax() && tools::isPost() ){
            $value = tools::getPost('value');
            return $this->renderAjax('view-departments', [
                'data' => DepartmentContent::find()->where(['like', 'title', $value])->all()
            ]);
        }
    }

    /** Returned post for department_id to ajax page @return mixed */
    public function actionSearchInDepartment()
    {
        if ( tools::isAuth() && tools::isAjax() && tools::isPost() ){
            $department_id = tools::getPost('department_id');
            $departments = [];
            $modelDW = DepartmentWorker::find()->where(['department_content_id' => $department_id])->all();
            foreach ( $modelDW as $dw ){
                $departments[] = User::find()->where(['id' => $dw['user_id']])->andWhere(['!=', 'id', 1])->one();
            }
            return $this->renderAjax('view-workers', [
                'data' => $this->getManual( $departments )
            ]);
        }
    }

    /** Returned post for value searhing to ajax page @return mixed */
    public function actionSearchFullname()
    {
        if ( tools::isAuth() && tools::isAjax() && tools::isPost() ){
            $value = tools::getPost('value');
            $modelUD = UserData::find()->where(['like', 'fullname', $value])->all();
            $model = [];
            foreach ( $modelUD as $ud ){
                $user = User::find()->where(['id' => $ud['user_id']])->andWhere(['status' => '10'])->andWhere(['!=', 'id', 1])->one();
                if ( $user ){
                    $model[] = $user;
                }
            }
            return $this->renderAjax('view-workers', [
                'data' => $this->getManual( $model )
            ]);
        }
    }

}
