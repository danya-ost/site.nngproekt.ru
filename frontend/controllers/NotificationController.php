<?php

namespace frontend\controllers;

use frontend\models\Notification;
use frontend\tools\tools;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

/**
 * Notification controller
 */
class NotificationController extends Controller
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
            return $this->render('index', [
                'data' => Notification::find()->where(['user_id' => tools::idUser()])->orderBy(['date_add' => SORT_DESC])->all()
            ]);
        } else{ return $this->redirect(['/site/index']); }
    }

    /** Set new notification. @return mixed */
    public function actionSet()
    {
        if ( tools::isAuth() && tools::isAjax() && tools::isPost() ){
            $modelN = new Notification();
            $modelN->data_key = tools::getPost('key');
            $modelN->user_id = tools::getPost('id');
            $modelN->message = tools::getPost('msg');
            $modelN->is_href = tools::getPost('href') != NULL ? 1 : 0; ;
            $modelN->href = tools::getPost('href') != NULL ? tools::getPost('href') : NULL;
            $modelN->ready = 1;
            $modelN->status = 1;
            $modelN->status_delete = 0;
            $modelN->save();
        } else{ return $this->redirect(['/site/index']); }
    }

}
