<?php

namespace frontend\controllers;

require '../language/language.php';

use frontend\models\Logs;
use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use frontend\language\language;
use frontend\tools\tools;
use frontend\models\File;
use frontend\models\FileContent;
/**
 * Tools controller
 */
class ToolsController extends Controller
{

    public $layout = 'main';

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout', 'signup'],
                'rules' => [ ['actions' => ['signup'], 'allow' => true, 'roles' => ['?'],], ['actions' => ['logout'], 'allow' => true, 'roles' => ['@'],], ],
            ],
            'verbs' => [ 'class' => VerbFilter::className(), 'actions' => ['logout' => ['post'],], ],
        ];
    }

    public function actions()
    {
        return [
            'error' => ['class' => 'yii\web\ErrorAction',],
            'captcha' => ['class' => 'yii\captcha\CaptchaAction', 'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,],
        ];
    }

    public function actionIndex()
    {
        if (!Yii::$app->user->isGuest){
            return $this->render('index');
        } else{
            return $this->redirect(['/site/index']);
        }
    }

    public function actionUpload()
    {
        if( tools::isAuth() ){
            if ( 0 < $_FILES['file']['error'] ) {
                return 'Error: ' . $_FILES['file']['error'] . '<br>';
            }
            else {
                $ext = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);
                $currentName = $_FILES['file']['name'];
                $securityName = Yii::$app->security->generateRandomString(30) . '.' . $ext;
                move_uploaded_file($_FILES['file']['tmp_name'], $_SERVER['DOCUMENT_ROOT'] . '/frontend/web/uploads/' . $securityName);

                $modelFile = new File();
                $modelFile->user_id = tools::idUser();
                $modelFile->status = 1;
                $modelFile->status_delete = 0;
                if ( $modelFile->save() ) {
                    $modelFileContent = new FileContent();
                    $modelFileContent->file_id = $modelFile->id;
                    $modelFileContent->name = $currentName;
                    $modelFileContent->alias = $securityName;
                    $modelFileContent->src = 'uploads/' . $securityName;
                    if ( $modelFileContent->save() ){
                        return $modelFileContent->src;
                    } else{ return $this->renderAjax('notification', [ 'data' => tools::setNotification('error', language::$lang['n_no_file_load_meta']) ]); }
                } else{ return $this->renderAjax('notification', [ 'data' => tools::setNotification('error', language::$lang['n_no_file_load']) ]); }
            }
        } else{ return $this->redirect(['/site/index']); }
    }

    public function actionLogs()
    {
        if( tools::isAuth() && tools::isAjax() && tools::isPost() ){
            $modelLogs = new Logs();
            $modelLogs->data_core = tools::getPost('core');
            $modelLogs->data_key = tools::getPost('key');
            $modelLogs->data_log = tools::getPost('log');
            $modelLogs->user_id = tools::idUser();
            $modelLogs->success = tools::getPost('success');
            $modelLogs->error = tools::getPost('error');
            $modelLogs->save();
        }
    }

}
