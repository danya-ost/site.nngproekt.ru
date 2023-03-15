<?php

namespace frontend\controllers;

use frontend\models\ResendVerificationEmailForm;
use frontend\models\Survey;
use frontend\models\SurveyContent;
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
 * Survey controller
 */
class SurveyController extends Controller
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
            $modelS = Survey::find()->where(['status_delete' => 0])->orderBy(['date_add' => SORT_DESC])->all();
            $data = [];
            foreach ( $modelS as $s ){
                $data[] = SurveyContent::find()->where(['survey_id' => $s['id']])->one();
            }
            return $this->render('index', [
                'data' => $data,
                'permission' => tools::isPermission('survey')
            ]);
        } else{ return $this->redirect(['/site/index']); }
    }

    /** Displays admin page. @return mixed */
    public function actionAdmin()
    {

    }

    /** Displays adding form. @return mixed */
    public function actionAddForm()
    {
        return $this->render('add-form');
    }

    /** Adding new survey. @return mixed */
    public function actionAddSurvey()
    {
        if ( tools::isAuth() && tools::isAjax() && tools::isPost() ){
            $modelS = new Survey();
            $modelS->user_id = tools::idUser();
            $modelS->status = 1;
            $modelS->status_delete = 0;
            if ( $modelS->save() ){
                $modelSC = new SurveyContent();
                $modelSC->survey_id = $modelS->id;
                $modelSC->title = tools::getPost('title');
                $modelSC->cover_src = tools::getPost('cover_src');
                $modelSC->href = tools::getPost('href');
                $modelSC->response = 0;
                $modelSC->save();
                return $modelS->id;
            }
        } else{ return $this->redirect(['/site/index']); }
    }

    /** Displays adding form. @return mixed */
    public function actionUpdateForm()
    {
        return $this->render('update-form', [
            'data' => SurveyContent::find()->where(['survey_id' => $_GET['s']])->one()
        ]);
    }

    /** Updating new survey. @return mixed */
    public function actionUpdateSurvey()
    {
        if ( tools::isAuth() && tools::isAjax() && tools::isPost() ){
            $modelS = Survey::find()->where(['id' => tools::getPost('id')])->one();
            $modelS->date_update = date('Y-m-d H:i:s');
            $modelS->user_id = tools::idUser();
            if ( $modelS->save() ){
                $modelSC = SurveyContent::find()->where(['survey_id' => tools::getPost('id')])->one();
                $modelSC->title = tools::getPost('title');
                $modelSC->cover_src = tools::getPost('cover_src');
                $modelSC->href = tools::getPost('href');
                $modelSC->response = strlen(tools::getPost('response_href')) > 0 ? 1 : 0;
                $modelSC->response_href = strlen(tools::getPost('response_href')) > 0 ? tools::getPost('response_href') : NULL;
                $modelSC->save();
            }
        } else{ return $this->redirect(['/site/index']); }
    }

    /** Deleting new survey. @return mixed */
    public function actionDeleteSurvey()
    {
        if ( tools::isAuth() && tools::isAjax() && tools::isPost() ){
            $modelS = Survey::find()->where(['id' => tools::getPost('id')])->one();
            $modelS->status = 0;
            $modelS->status_delete = 1;
            $modelS->save();
        } else{ return $this->redirect(['/site/index']); }
    }

    /** Searching survey. @return mixed */
    public function actionSearch()
    {
        if ( tools::isAuth() && tools::isAjax() && tools::isPost() ){
            $data = [];
            $modelSC = SurveyContent::find()->where(['like', 'title', tools::getPost('value')])->all();
            foreach ( $modelSC as $sc ){
                if ( Survey::find()->where(['id' => $sc['survey_id']])->one()['status_delete'] == 0 ){
                    $data[] = $sc;
                }
            }
            return $this->renderAjax('view-survey', [
                'data' => $data
            ]);
        } else{ return $this->redirect(['/site/index']); }
    }


}
