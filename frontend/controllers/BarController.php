<?php

namespace frontend\controllers;

use frontend\tools\tools;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use frontend\models\Navbar;
use frontend\models\NavbarContent;

/**
 * Bar controller
 */
class BarController extends Controller
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

    /** Displays index page for left bar. @return mixed */
    public function actionEditLeft()
    {
        if ( tools::isAuth() ){
            $data = [];
            $modelN = Navbar::find()->where(['status_delete' => 0])->all();
            foreach ( $modelN as $item ){
                if ( NavbarContent::find()->where(['navbar_id' => $item['id']])->one()['data_key'] == 'left' ){
                    $data[] = NavbarContent::find()->where(['navbar_id' => $item['id']])->one();
                }
            }
            return $this->render('edit-left', [
                'data' => $data
            ]);
        } else{ return $this->redirect(['/site/index']); }
    }

    /** Displays updating form from element a left bar. @return mixed */
    public function actionEditLeftItem()
    {
        if ( tools::isAuth() ){
            return $this->render('edit-left-item', [
                'data' => NavbarContent::find()->where(['navbar_id' => $_GET['lbi']])->one()
            ]);
        } else{ return $this->redirect(['/site/index']); }
    }

    /** Updating form from element a left bar. @return mixed */
    public function actionUpdateLeftItem()
    {
        if ( tools::isAuth() && tools::isAjax() && tools::isPost() ){
            $modelN = Navbar::find()->where(['id' => tools::getPost('id')])->one();
            $modelN->user_id = tools::idUser();
            $modelN->status = tools::getPost('on_off');
            if ( $modelN->save() ){
                $modelNC = NavbarContent::find()->where(['navbar_id' => $modelN->id])->one();
                $modelNC->title = tools::getPost('title');
                $modelNC->href = tools::getPost('href');
                $modelNC->svg = tools::getPost('svg');
                $modelNC->save();
            }
        } else{ return $this->redirect(['/site/index']); }
    }

    /** Displays index page for bottom bar. @return mixed */
    public function actionEditBottom()
    {
        if ( tools::isAuth() ){
            $data_01 = [];
            $data_02 = [];
            $data_03 = [];
            $data_04 = [];
            $modelN = Navbar::find()->where(['status_delete' => 0])->all();
            foreach ( $modelN as $item ){
                if ( NavbarContent::find()->where(['navbar_id' => $item['id']])->one()['data_key'] == 'bottom_01' ){
                    $data_01[] = NavbarContent::find()->where(['navbar_id' => $item['id']])->one();
                } elseif ( NavbarContent::find()->where(['navbar_id' => $item['id']])->one()['data_key'] == 'bottom_02' ){
                    $data_02[] = NavbarContent::find()->where(['navbar_id' => $item['id']])->one();
                } elseif ( NavbarContent::find()->where(['navbar_id' => $item['id']])->one()['data_key'] == 'bottom_03' ){
                    $data_03[] = NavbarContent::find()->where(['navbar_id' => $item['id']])->one();
                } elseif ( NavbarContent::find()->where(['navbar_id' => $item['id']])->one()['data_key'] == 'bottom_04' ){
                    $data_04[] = NavbarContent::find()->where(['navbar_id' => $item['id']])->one();
                }
            }
            return $this->render('edit-bottom', [
                'data_01' => $data_01,
                'data_02' => $data_02,
                'data_03' => $data_03,
                'data_04' => $data_04
            ]);
        } else{ return $this->redirect(['/site/index']); }
    }

    /** Displays updating form from element a bottom bar. @return mixed */
    public function actionEditBottomItem()
    {
        if ( tools::isAuth() ){
            return $this->render('edit-bottom-item', [
                'data' => NavbarContent::find()->where(['navbar_id' => $_GET['bbi']])->one()
            ]);
        } else{ return $this->redirect(['/site/index']); }
    }

    /** Updating form from element a bottom bar. @return mixed */
    public function actionUpdateBottomItem()
    {
        if ( tools::isAuth() && tools::isAjax() && tools::isPost() ){
            $modelN = Navbar::find()->where(['id' => tools::getPost('id')])->one();
            $modelN->user_id = tools::idUser();
            $modelN->status = tools::getPost('on_off');
            if ( $modelN->save() ){
                $modelNC = NavbarContent::find()->where(['navbar_id' => $modelN->id])->one();
                $modelNC->title = tools::getPost('title');
                $modelNC->href = tools::getPost('href');
                $modelNC->save();
            }
        } else{ return $this->redirect(['/site/index']); }
    }

}
