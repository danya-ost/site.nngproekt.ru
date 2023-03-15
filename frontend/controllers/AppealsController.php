<?php

namespace frontend\controllers;

use common\models\User;
use frontend\models\Appeals;
use frontend\models\AppealsContent;
use frontend\models\AppealsFile;
use frontend\models\AppealsStatus;
use frontend\models\AuthAssigment;
use frontend\models\AuthItemChild;
use frontend\models\FileContent;
use frontend\models\News;
use frontend\models\NewsCategory;
use frontend\models\NewsContent;
use frontend\models\NewsFixed;
use frontend\models\NewsPreview;
use frontend\models\Notification;
use frontend\models\Template;
use frontend\models\UserData;
use frontend\tools\tools;
use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

/**
 * Appeals controller
 */
class AppealsController extends Controller
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

    public function getAppeals($model, $one)
    {
        $data = [];
        if ( $one ){
            $modelAC = AppealsContent::find()->where(['appeals_id' => $model['id']])->one();
            $modelAF = AppealsFile::find()->where(['appeals_id' => $model['id']])->all();
            $files = [];
            $files_response = [];
            foreach ($modelAF as $file) {
                if ($file['type'] == 1) {
                    $files[] = [
                        'name' => FileContent::find()->where(['src' => $file['src']])->one()['name'],
                        'src' => $file['src']
                    ];
                } else {
                    $files_response[] = [
                        'name' => FileContent::find()->where(['src' => $file['src']])->one()['name'],
                        'src' => $file['src']
                    ];
                }
            }
            $data = [
                'id'                => $model['id'],
                'status_id'         => AppealsStatus::find()->where(['id' => $model['status_id']])->one()['id'],
                'status'            => AppealsStatus::find()->where(['id' => $model['status_id']])->one()['name'],
                'title'             => $modelAC['title'],
                'msg'               => $modelAC['message_text'],
                'msg_preview'       => strlen($modelAC['message_text']) < 125 ? $modelAC['message_text'] : substr($modelAC['message_text'], 0, strpos($modelAC['message_text'], ' ', 120)),
                'response'          => $modelAC['response_text'],
                'files'             => $files,
                'files_response'    => $files_response
            ];
        } else {
            foreach ($model as $item) {
                $modelAC = AppealsContent::find()->where(['appeals_id' => $item['id']])->one();
                $modelAF = AppealsFile::find()->where(['appeals_id' => $item['id']])->all();
                $files = [];
                $files_response = [];
                foreach ($modelAF as $file) {
                    if ($file['type'] == 1) {
                        $files[] = [
                            'name' => FileContent::find()->where(['src' => $file['src']])->one()['name'],
                            'src' => $file['src']
                        ];
                    } else {
                        $files_response[] = [
                            'name' => FileContent::find()->where(['src' => $file['src']])->one()['name'],
                            'src' => $file['src']
                        ];
                    }
                }
                $data[] = [
                    'id' => $item['id'],
                    'status_id' => AppealsStatus::find()->where(['id' => $item['status_id']])->one()['id'],
                    'status' => AppealsStatus::find()->where(['id' => $item['status_id']])->one()['name'],
                    'title' => $modelAC['title'],
                    'msg' => $modelAC['message_text'],
                    'msg_preview' => strlen($modelAC['message_text']) < 125 ? $modelAC['message_text'] : substr($modelAC['message_text'], 0, strpos($modelAC['message_text'], ' ', 120)),
                    'response' => $modelAC['response_text'],
                    'files' => $files,
                    'files_response' => $files_response
                ];
            }
        }
        return $data;
    }

    /** Displays homepage */
    public function actionIndex()
    {
        if ( tools::isAuth() ){
            $modelAA = AuthAssigment::find()->where(['user_id' => tools::idUser()])->one();
            $modelAIC = AuthItemChild::find()->where(['parent' => $modelAA['item_name']])->andWhere(['child' => 'responseAppeals'])->one();
            if ( isset($modelAIC) ){ $permission = true; } else{ $permission = false; };
            return $this->render('index', [ 'permission' => $permission ]);
        } else{ return $this->redirect(['/site/index']); }
    }

    public function actionViewMyAppeals()
    {
        if ( tools::isAuth() ){
            if ( tools::isAjax() && tools::isPost() ){
                return $this->renderAjax('appeals_items', [
                    'data' => $this->getAppeals( Appeals::find()->where(['status_delete' => 0])->andWhere(['user_id' => tools::idUser()])->orderBy(['status_id' => SORT_ASC])->all(), false )
                ]);
            }
        } else{ return $this->redirect(['/site/index']); }
    }

    public function actionViewMeAppeals()
    {
        if ( tools::isAuth() ){
            if ( tools::isAjax() && tools::isPost() ){
                return $this->renderAjax('appeals_items_management', [
                    'data' => $this->getAppeals( Appeals::find()->where(['status_delete' => 0])->andWhere(['status_id' => 2])->orWhere(['status_id' => 3])->andWhere(['defined_user_id' => tools::idUser()])->orderBy(['status_id' => SORT_ASC])->all(), false )
                ]);
            }
        } else{ return $this->redirect(['/site/index']); }
    }

    public function actionViewCurrentAppeals()
    {
        if ( tools::isAuth() ){
            if ( tools::isAjax() && tools::isPost() ){
                return $this->renderAjax('view-appeals', [
                    'data' => $this->getAppeals( Appeals::find()->where(['id' => tools::getPost('id')])->one(), true )
                ]);
            }
        } else{ return $this->redirect(['/site/index']); }
    }

    public function actionAddFormAppeals()
    {
        if ( tools::isAuth() ){
            $management = [];
            $modelAIC = AuthItemChild::find()->where(['child' => 'responseAppeals'])->all();
            foreach ( $modelAIC as $ais ){
                $modelAA = AuthAssigment::find()->where(['item_name' => $ais['parent']])->all();
                foreach ( $modelAA as $aa ){
                    $modelUD = UserData::find()->where(['user_id' => $aa['user_id']])->one();
                    if ( $modelUD['user_id'] > 1 ){
                        $management[] = [
                            'id'        => $modelUD['user_id'],
                            'fullname'  => $modelUD['fullname']
                        ];
                    }
                }
            }
            return $this->render('appeals_form', [
                'management' => $management
            ]);
        } else{ return $this->redirect(['/site/index']); }
    }

    public function actionAddFileForm()
    {
        if ( tools::isAuth() && tools::isAjax() && tools::isPost() ){
            $modelFC = FileContent::find()->where(['src' => tools::getPost('src')])->one();
            $data = [
                'id' => $modelFC['file_id'],
                'name' => $modelFC['name'],
                'src' => $modelFC['src']
            ];
            return $this->renderAjax('add-file-form', [ 'data' => $data ]);
        } else{ return $this->redirect(['/site/index']); }
    }

    public function actionAddAppeals()
    {
        if ( tools::isAuth() ){
            if ( tools::isAjax() && tools::isPost() ){
                $modelA = new Appeals();
                $modelA->user_id = tools::idUser();
                $modelA->status_id = 2;
                $modelA->defined_user_id = tools::getPost('user_id');
                $modelA->status = 1;
                $modelA->status_delete = 0;
                if ( $modelA->save() ){
                    $modelAC = new AppealsContent();
                    $modelAC->appeals_id = $modelA->id;
                    $modelAC->title = tools::getPost('title');
                    $modelAC->message_text = tools::getPost('msg');
                    if ( $modelAC->save() ){
                        $files = tools::getPost('files');
                        if ( $files != '0' ) {
                            foreach ( $files as $file ){
                                $modelAF = new AppealsFile();
                                $modelAF->appeals_id = $modelA->id;
                                $modelAF->src = $file;
                                $modelAF->type = 1;
                                $modelAF->save();
                            }
                        }

                        \Yii::$app
                            ->mailer
                            ->compose(
                                ['html' => 'newAppeals-html', 'text' => 'newAppeals-text'],
                                [
                                    'fullname' => UserData::find()->where(['user_id' => $modelA->user_id])->one()['fullname'],
                                    'fullname_to' => UserData::find()->where(['user_id' => $modelA->defined_user_id])->one()['firstname'],
                                    'theme' => $modelAC->title,
                                    'file' => $files != '0' ? 'да' : 'нет',
                                    'href' => $_SERVER['HTTP_HOST'] . '/frontend/web/appeals/response?a=' . $modelA->id
                                ]
                            )
                            ->setFrom([\Yii::$app->params['portalEmail'] => 'Корпоративный порта ННГП'])
                            ->setTo(User::find()->where(['id' => $modelA->defined_user_id])->one()['email'])
                            ->setSubject('Поступило обращение от сотрудника')
                            ->send();
                    }
                }
            }
        } else{ return $this->redirect(['/site/index']); }
    }

    public function actionResponsingAppeals()
    {
        if ( tools::isAuth() ){
            if ( tools::isAjax() && tools::isPost() ){
                $modelA = Appeals::find()->where(['id' => tools::getPost('id')])->one();
                $modelA->status_id = 3;
                if ( $modelA->save() ){
                    return $this->renderAjax('view-appeals', [
                        'data' => $this->getAppeals( Appeals::find()->where(['id' => tools::getPost('id')])->one(), true )
                    ]);
                }
            }
        } else{ return $this->redirect(['/site/index']); }
    }

    public function actionResponse()
    {
        if ( tools::isAuth() ){
            return $this->render('appeals_form_management', [
                'data' => $this->getAppeals( Appeals::find()->where(['id' => $_GET['a']])->one(), true )
            ]);
        } else{ return $this->redirect(['/site/index']); }
    }

    public function actionResponseAppeals()
    {
        if ( tools::isAuth() ){
            if ( tools::isAjax() && tools::isPost() ){
                $modelA = Appeals::find()->where(['id' => tools::getPost('id')])->one();
                $modelA->status_id = 1;
                if ( $modelA->save() ){
                    $modelAC = AppealsContent::find()->where(['appeals_id' => tools::getPost('id')])->one();
                    $modelAC->response_text = tools::getPost('response');
                    if ( $modelAC->save() ){
                        $files = tools::getPost('files');
                        if ( $files != '0' ) {
                            foreach ( $files as $file ){
                                $modelAF = new AppealsFile();
                                $modelAF->appeals_id = $modelAC->appeals_id;
                                $modelAF->src = $file;
                                $modelAF->type = 2;
                                $modelAF->save();
                            }
                        }
                        $notify = new Notification();
                        $notify->data_key = 'appeals';
                        $notify->user_id = $modelA->user_id;
                        $notify->message = 'Получен ответ на обращение: ' . $modelAC->title;
                        $notify->is_href = 0;
                        $notify->href = NULL;
                        $notify->ready = 0;
                        $notify->status = 1;
                        $notify->status_delete = 0;
                        $notify->save();
                    }
                }
            }
        } else{ return $this->redirect(['/site/index']); }
    }

    public function actionSearch()
    {
        if ( tools::isAuth() ){
            if ( tools::isAjax() && tools::isPost() ){
                $search = [];
                $value = tools::getPost('value');
                $modelAC = AppealsContent::find()->where(['like', 'title', $value])->orWhere(['like', 'message_text', $value])->orWhere(['like', 'response_text', $value])->all();
                foreach ( $modelAC as $ac ) {
                    $modelA = Appeals::find()->where(['id' => $ac['appeals_id']])->andWhere(['user_id' => tools::idUser()])->andWhere(['status_delete' => 0])->one();
                    if ( isset($modelA) ){
                        $search[] = $this->getAppeals( $modelA, true );
                    }
                }
                return $this->renderAjax('appeals_items', [ 'data' => $search ]);
            }
        } else{ return $this->redirect(['/site/index']); }
    }

}
