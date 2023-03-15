<?php

namespace frontend\controllers;

use frontend\models\Abs;
use frontend\models\AbsContent;
use frontend\models\AbsFile;
use frontend\models\FileContent;
use frontend\models\UserData;
use frontend\tools\tools;
use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

/**
 * Abs controller
 */
class AbsController extends Controller
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

    public function getAbs($model, $one)
    {
        $data = [];
        if ( $one ){
            $modelAC = AbsContent::find()->where(['abs_id' => $model['id']])->one();
            $modelAF = AbsFile::find()->where(['abs_id' => $model['id']])->all();
            $files = [];
            foreach ( $modelAF as $file ){ $files[] = [ 'src' => $file['src'] ]; }
            $data = [
                'id' => $model['id'],
                'user' => UserData::find()->where(['user_id' => $model['user_id']])->one()['firstname'] . ' ' . UserData::find()->where(['user_id' => $model['user_id']])->one()['surname'],
                'date' => Yii::$app->formatter->asDate($model['date_add'], 'dd.MM.yyyy'),
                'title' => $modelAC['title'],
                'content' => $modelAC['content'],
                'files' => $files
            ];
        } else{
            foreach ( $model as $item ){
                $modelAC = AbsContent::find()->where(['abs_id' => $item['id']])->one();
                $modelAF = AbsFile::find()->where(['abs_id' => $item['id']])->all();
                $files = [];
                foreach ( $modelAF as $file ){ $files[] = [ 'src' => $file['src'] ]; }
                $data[] = [
                    'id' => $item['id'],
                    'user' => UserData::find()->where(['user_id' => $item['user_id']])->one()['firstname'] . ' ' . UserData::find()->where(['user_id' => $item['user_id']])->one()['surname'],
                    'date' => Yii::$app->formatter->asDate($item['date_add'], 'dd.MM.yyyy'),
                    'title' => $modelAC['title'],
                    'content' => $modelAC['content'],
                    'files' => $files
                ];
            }
        }
        return $data;
    }

    /** Displays homepage */
    public function actionIndex()
    {
        if ( tools::isAuth() ){
            return $this->render('index');
        } else{ return $this->redirect(['/site/index']); }
    }

    public function actionAddFileForm()
    {
        if ( tools::isAuth() ){
            if ( tools::isAjax() && tools::isPost() ){
                $modelF = FileContent::find()->where(['src' => tools::getPost('src')])->one();
                $data = [
                    'id' => $modelF['id'],
                    'name' => $modelF['name'],
                    'src' => $modelF['src']
                ];
                return $this->renderAjax('add-file-form', [
                    'data' => $data
                ]);
            }
        } else{ return $this->redirect(['/site/index']); }
    }

    public function actionAddAbs()
    {
        if ( tools::isAuth() ){
            if ( tools::isAjax() && tools::isPost() ){
                $modelA = new Abs();
                $modelA->user_id = tools::idUser();
                $modelA->status = 1;
                $modelA->status_delete = 0;
                if ( $modelA->save() ){
                    $modelAC = new AbsContent();
                    $modelAC->abs_id = $modelA->id;
                    $modelAC->title = tools::getPost('title');
                    $modelAC->content = tools::getPost('content');
                    if ( $modelAC->save() ){
                        foreach ( tools::getPost('files') as $file ){
                            $modelAF = new AbsFile();
                            $modelAF->abs_id = $modelA->id;
                            $modelAF->src = $file;
                            $modelAF->save();
                        }
                    }
                }
            }
        } else{ return $this->redirect(['/site/index']); }
    }

    public function actionViewAbsAll()
    {
        if ( tools::isAuth() ){
            if ( tools::isAjax() && tools::isPost() ){
                return $this->renderAjax('view-abs-all', [
                    'data' => $this->getAbs( Abs::find()->where(['status_delete' => 0])->orderBy(['date_add' => SORT_DESC])->all(), false ),
                    'permission' => tools::isPermission('abs')
                ]);
            }
        } else{ return $this->redirect(['/site/index']); }
    }

    public function actionViewAbs()
    {
        if ( tools::isAuth() ){
            if ( tools::isAjax() && tools::isPost() ){
                return $this->renderAjax('view-abs-one', [
                    'data' => $this->getAbs( Abs::find()->where(['id' => tools::getPost('id')])->one(), true ),
                    'permission' => Abs::find()->where(['id' => tools::getPost('id')])->one()['user_id'] == tools::idUser() ? true : false
                ]);
            }
        } else{ return $this->redirect(['/site/index']); }
    }

    public function actionViewFormUpdateAbs()
    {
        if ( tools::isAuth() ){
            if ( tools::isAjax() && tools::isPost() ){
                $modelAF = AbsFile::find()->where(['abs_id' => tools::getPost('id')])->all();
                $files = [];
                foreach ( $modelAF as $file ){
                    $modelF = FileContent::find()->where(['src' => $file['src']])->one();
                    $files[] = [
                        'id' => $modelF['id'],
                        'name' => $modelF['name'],
                        'src' => $modelF['src']
                    ];
                }
                return $this->renderAjax('update-form', [
                    'data' => $this->getAbs( Abs::find()->where(['id' => tools::getPost('id')])->one(), true ),
                    'files' => $files
                ]);
            }
        } else{ return $this->redirect(['/site/index']); }
    }

    public function actionUpdateAbs()
    {
        if ( tools::isAuth() ){
            if ( tools::isAjax() && tools::isPost() ){
                $modelA = Abs::find()->where(['id' => tools::getPost('id')])->one();
                $modelA->user_id = tools::idUser();
                $modelA->date_update = date('Y-m-d H:i:s');
                if ( $modelA->save() ){
                    $modelAC = AbsContent::find()->where(['abs_id' => $modelA->id])->one();
                    $modelAC->title = tools::getPost('title');
                    $modelAC->content = tools::getPost('content');
                    if ( $modelAC->save() ){
                        $modelAF = AbsFile::find()->where(['abs_id' => $modelA->id])->all();
                        $files = tools::getPost('files');
                        foreach ( $modelAF as $file) {
                            $flag = true;
                            foreach ( $files as $postFile ){
                                if ( $file['src'] == $postFile ){
                                    $flag = false;
                                }
                            }
                            if ( $flag ){ $file->delete(); }
                        }
                    }
                }
            }
        } else{ return $this->redirect(['/site/index']); }
    }

    public function actionDeleteAbs()
    {
        if ( tools::isAuth() ){
            if ( tools::isAjax() && tools::isPost() ){
                $modelA = Abs::find()->where(['id' => tools::getPost('id')])->one();
                $modelA->date_remove = date('Y-m-d H:i:s');
                $modelA->status = 0;
                $modelA->status_delete = 1;
                $modelA->save();
            }
        } else{ return $this->redirect(['/site/index']); }
    }


}
