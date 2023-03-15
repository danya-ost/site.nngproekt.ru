<?php

namespace frontend\controllers;

use frontend\models\Services;
use frontend\models\ServicesContent;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use frontend\tools\tools;

/**
 * Services controller
 */
class ServicesController extends Controller
{

    public $layout = 'main';

    /** {@inheritdoc} */
    public function behaviors()
    {
        return [
            'access' => [ 'class' => AccessControl::className(), 'only' => ['logout', 'signup'], 'rules' => [ [ 'actions' => ['signup'], 'allow' => true, 'roles' => ['?'], ], [ 'actions' => ['logout'], 'allow' => true, 'roles' => ['@'], ], ], ],
            'verbs' => [ 'class' => VerbFilter::className(), 'actions' => [ 'logout' => ['post'], ], ],
        ];
    }

    /** {@inheritdoc} */
    public function actions() { return [ 'error' => [ 'class' => 'yii\web\ErrorAction', ], 'captcha' => [ 'class' => 'yii\captcha\CaptchaAction', 'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null, ], ]; }

    public function getServices($model, $one){
        $data = [];
        if ( $one ){
            $modelSC = ServicesContent::find()->where(['services_id' => $model['id']])->one();
            $data = [
                'id'        => $model['id'],
                'type_id'   => $model['type_id'],
                'title'     => $modelSC['title'],
                'href'      => $modelSC['href'],
                'href_src'  => $modelSC['href_src'],
            ];
        } else{
            foreach ( $model as $item ){
                $modelSC = ServicesContent::find()->where(['services_id' => $item['id']])->one();
                $data[] = [
                    'id'        => $item['id'],
                    'type_id'   => $item['type_id'],
                    'title'     => $modelSC['title'],
                    'href'      => $modelSC['href'],
                    'href_src'  => $modelSC['href_src'],
                ];
            }
        }
        return $data;
    }

    /** Displays homepage. @return mixed  */
    public function actionIndex()
    {
        return $this->render('index', [
            'permission' => tools::isPermission('services')
        ]);
    }

    /** Ajax function returned services items for view. @return mixed  */
    public function actionViewServices()
    {
        if ( tools::isAuth() ){
            if ( tools::isAjax() && tools::isPost() ){
                return $this->renderAjax('view-services-all', [
                    'data' => $this->getServices( Services::find()->where(['status_delete' => 0])->andWhere(['type_id' => tools::getPost('type')])->orderBy(['date_add' => SORT_DESC])->all(), false ),
                    'permission' => tools::isPermission('services')
                ]);
            }
        } else{ return $this->redirect(['/site/index']); }
    }

    /** Ajax function adding new data from database. @return mixed  */
    public function actionAddServices()
    {
        if ( tools::isAuth() ){
            if ( tools::isAjax() && tools::isPost() ){
                $modelS = new Services();
                $modelS->user_id = tools::idUser();
                $modelS->type_id = tools::getPost('type');
                $modelS->status = 1;
                $modelS->status_delete = 0;
                if ( $modelS->save() ){
                    $modelSC = new ServicesContent();
                    $modelSC->services_id = $modelS->id;
                    $modelSC->title = tools::getPost('title');
                    $src = tools::getPost('src');
                    if ( strlen($src) > 0 ){
                        $modelSC->href = 1;
                        $modelSC->href_src = $src;
                    } else{ $modelSC->href = 0; }
                    $modelSC->save();
                }
            }
        } else{ return $this->redirect(['/site/index']); }
    }

    /** Ajax function logical deleting data on database. @return mixed  */
    public function actionDeleteServices()
    {
        if( tools::isAuth() ){
            if ( tools::isAjax() && tools::isPost() ){
                $modelS = Services::find()->where(['id' => tools::getPost('id')])->one();
                $modelS->status = 0;
                $modelS->status_delete = 1;
                $modelS->save();
            }
        } else{ return $this->redirect(['/site/index']); }
    }

    /** Ajax function returned data from view form. @return mixed  */
    public function actionLoadDataServices()
    {
        if( tools::isAuth() ){
            if ( tools::isAjax() && tools::isPost() ){
                return $this->renderAjax('load-data-update', [
                    'data' => $this->getServices( Services::find()->where(['id' => tools::getPost('id')])->one(), true )
                ]);
            }
        } else{ return $this->redirect(['/site/index']); }
    }

    /** Ajax function updating new data from database. @return mixed  */
    public function actionUpdateServices()
    {
        if ( tools::isAuth() ){
            if ( tools::isAjax() && tools::isPost() ){
                $modelS = Services::find()->where(['id' => tools::getPost('id')])->one();
                $modelS->type_id = tools::getPost('type');
                if ( $modelS->save() ){
                    $modelSC = ServicesContent::find()->where(['services_id' => $modelS->id])->one();
                    $modelSC->title = tools::getPost('title');
                    $src = tools::getPost('src');
                    if ( strlen($src) > 0 ){
                        $modelSC->href = 1;
                        $modelSC->href_src = $src;
                    } else{ $modelSC->href = 0; }
                    $modelSC->save();
                }
            }
        } else{ return $this->redirect(['/site/index']); }
    }
}
