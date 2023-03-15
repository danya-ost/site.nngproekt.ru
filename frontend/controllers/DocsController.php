<?php

namespace frontend\controllers;

use frontend\models\Doc;
use frontend\models\DocContent;
use frontend\models\ResendVerificationEmailForm;
use frontend\models\VerifyEmailForm;
use frontend\tools\tools;
use Yii;
use yii\base\InvalidArgumentException;
use yii\helpers\Url;
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
 * Docs controller
 */
class DocsController extends Controller
{

    public $layout = 'main';


    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [ 'class' => AccessControl::className(), 'only' => ['logout', 'signup'], 'rules' => [ [ 'actions' => ['signup'], 'allow' => true, 'roles' => ['?'], ], [ 'actions' => ['logout'], 'allow' => true, 'roles' => ['@'], ], ], ],
            'verbs' => [ 'class' => VerbFilter::className(), 'actions' => [ 'logout' => ['post'], ], ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions() { return [ 'error' => [ 'class' => 'yii\web\ErrorAction', ], 'captcha' => [ 'class' => 'yii\captcha\CaptchaAction', 'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null, ], ]; }

    public function getDocs($model, $one){
        $data = [];
        if( $one ){
            $modelDocContent = DocContent::find()->where(['doc_id' => $model['id']])->one();
            $data = [
                'id'    => $model['id'],
                'title' => $modelDocContent['title'],
                'href'  => '/frontend/web/' . $modelDocContent['src']
            ];
        } else{
            foreach ( $model as $item ){
                if ( $item['status_delete'] == false ){
                    $modelDocContent = DocContent::find()->where(['doc_id' => $item['id']])->one();
                    $data[] = [
                        'id'    => $item['id'],
                        'title' => $modelDocContent['title'],
                        'href'  => '/frontend/web/' . $modelDocContent['src']
                    ];
                }
            }
        }
        return $data;
    }

    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionIndex()
    {
        if ( tools::isAuth() ){
            return $this->render('index', [
                'permission' => tools::isPermission('docs')
            ]);
        } else { return $this->redirect(['/site/index']); }
    }

    /**
     * Fiction load items docs to index page.
     *
     * @return mixed
     */
    public function actionViewDocsAll()
    {
        if ( tools::isAuth() ){
            if ( tools::isAjax() && tools::isPost() ){
                if( tools::getPost('onload') ){
                    return $this->renderAjax('view-docs-all', [
                        'data' => $this->getDocs( Doc::find()->orderBy(['date_add' => SORT_DESC])->limit('6')->all(), false )
                    ]);
                } else{
                    return $this->renderAjax('view-docs-all', [
                        'data' => $this->getDocs( Doc::find()->where(['<', 'id', tools::getPost('last_id')])->orderBy(['date_add' => SORT_DESC])->limit('6')->all(), false )
                    ]);
                }
            }
        } else { return $this->redirect(['/site/index']); }
    }

    public function actionAddFile()
    {
        if ( tools::isAuth() ){
            if ( tools::isAjax() && tools::isPost() ){
                $modelDoc = new Doc();
                $modelDoc->user_id = tools::idUser();
                $modelDoc->status = 1;
                $modelDoc->status_delete = 0;
                if ( $modelDoc->save() ){
                    $modelDocContent = new DocContent();
                    $modelDocContent->doc_id = $modelDoc->id;
                    $modelDocContent->title = tools::getPost('title');
                    $modelDocContent->src = tools::getPost('src');
                    $modelDocContent->save();
                }
            }
        } else{ return $this->redirect(['/site/index']); }
    }

    public function actionDeleteDocs()
    {
        if ( tools::isAuth() ){
            if ( tools::isAjax() && tools::isPost() ){
                $modelDoc = Doc::find()->where(['id' => tools::getPost('id')])->one();
                $modelDoc->status = 0;
                $modelDoc->status_delete = 1;
                $modelDoc->save();
            }
        } else{ return $this->redirect(['/site/index']); }
    }

}
