<?php

namespace frontend\controllers;

use common\models\User;
use frontend\models\DepartmentContent;
use frontend\models\Initiative;
use frontend\models\InitiativeCategory;
use frontend\models\InitiativeContent;
use frontend\models\InitiativeStatus;
use frontend\models\InitiativeSupportive;
use frontend\models\Notification;
use frontend\models\UserData;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use frontend\tools\tools;
use Yii;

/**
 * Initiative controller
 */
class InitiativeController extends Controller
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

    public function getInitiative($model, $one)
    {
        $data = [];
        if ( $one ){
            $modelIC = InitiativeContent::find()->where(['initiative_id' => $model['id']])->one();
            $modelIS = InitiativeSupportive::find()->where(['initiative_id' => $model['id']])->one();
            $modelUD = UserData::find()->where(['user_id' => $model['user_id']])->one();
            $modelUDS = UserData::find()->where(['user_id' => $modelIS['user_id']])->one();
            if ( isset($modelUDS) ){
                $supportive = $modelUDS['surname'] . ' ' . mb_substr( $modelUDS['firstname'], 0, 1 ) . '. ' . mb_substr( $modelUDS['report'], 0, 1 ) . '.';
                $supportive_id = $modelUDS['user_id'];
            } else{
                $supportive = '';
                $supportive_id = '';
            }
            $data = [
                'id'            => $model['id'],
                'category'      => InitiativeCategory::find()->where(['id' => $model['category_id']])->one()['name'],
                'date'          => Yii::$app->formatter->asDate($model['date_add'], 'dd.MM.yyyy'),
                'status'        => InitiativeStatus::find()->where(['id' => $model['status_id']])->one()['name'],
                'status_id'     => InitiativeStatus::find()->where(['id' => $model['status_id']])->one()['id'],
                'status_color'  => InitiativeStatus::find()->where(['id' => $model['status_id']])->one()['color'],
                'department'    => DepartmentContent::find()->where(['id' => $model['department_id']])->one()['title'],
                'abbreviation'  => DepartmentContent::find()->where(['id' => $model['department_id']])->one()['abbreviation'],
                'title'         => $modelIC['title'],
                'problem'       => $modelIC['problem_text'],
                'solution'      => $modelIC['solution_text'],
                'effect'        => $modelIC['effect_text'],
                'effect_meta'   => $modelIC['effect_meta'],
                'rewarded'      => $modelIC['amount_rewarded'],
                'response'      => $modelIC['response_text'],
                'contacts'      => $modelIC['contacts'],
                'author'        => $modelUD['surname'] . ' ' . mb_substr( $modelUD['firstname'], 0, 1 ) . '. ' . mb_substr( $modelUD['report'], 0, 1 ) . '.',
                'author_id'     => $modelUD['user_id'],
                'supportive'    => $supportive,
                'supportive_id' => $supportive_id
            ];
        } else{
            foreach ( $model as $item ) {
                $modelIC = InitiativeContent::find()->where(['initiative_id' => $item['id']])->one();
                $modelIS = InitiativeSupportive::find()->where(['initiative_id' => $item['id']])->one();
                $modelUD = UserData::find()->where(['user_id' => $item['user_id']])->one();
                $modelUDS = UserData::find()->where(['user_id' => $modelIS['user_id']])->one();
                if ( isset($modelUDS) ){
                    $supportive = $modelUDS['surname'] . ' ' . mb_substr( $modelUDS['firstname'], 0, 1 ) . '. ' . mb_substr( $modelUDS['report'], 0, 1 ) . '.';
                    $supportive_id = $modelUDS['user_id'];
                } else{
                    $supportive = '';
                    $supportive_id = '';
                }
                $data[] = [
                    'id'            => $item['id'],
                    'category'      => InitiativeCategory::find()->where(['id' => $item['category_id']])->one()['name'],
                    'date'          => Yii::$app->formatter->asDate($item['date_add'], 'dd.MM.yyyy'),
                    'status'        => InitiativeStatus::find()->where(['id' => $item['status_id']])->one()['name'],
                    'status_id'     => InitiativeStatus::find()->where(['id' => $item['status_id']])->one()['id'],
                    'status_color'  => InitiativeStatus::find()->where(['id' => $item['status_id']])->one()['color'],
                    'department'    => DepartmentContent::find()->where(['id' => $item['department_id']])->one()['title'],
                    'abbreviation'  => DepartmentContent::find()->where(['id' => $item['department_id']])->one()['abbreviation'],
                    'title'         => $modelIC['title'],
                    'problem'       => $modelIC['problem_text'],
                    'solution'      => $modelIC['solution_text'],
                    'effect'        => $modelIC['effect_text'],
                    'effect_meta'   => $modelIC['effect_meta'],
                    'rewarded'      => $modelIC['amount_rewarded'],
                    'response'      => $modelIC['response_text'],
                    'contacts'      => $modelIC['contacts'],
                    'author'        => $modelUD['surname'] . ' ' . mb_substr( $modelUD['firstname'], 0, 1 ) . '. ' . mb_substr( $modelUD['report'], 0, 1 ) . '.',
                    'author_id'     => $modelUD['user_id'],
                    'supportive'    => $supportive,
                    'supportive_id' => $supportive_id
                ];
            }
        }
        return $data;
    }

    /** Displays homepage. @return mixed  */
    public function actionIndex()
    {
        if ( tools::isAuth() ){
            return $this->render('index');
        } else{ return $this->redirect(['/site/index']); }
    }

    public function actionAddFormInitiative()
    {
        if ( tools::isAuth() ){
            $modelICat = InitiativeCategory::find()->where(['status_delete' => 0])->all();
            $modelU = UserData::find()->where(['user_id' => tools::idUser()])->one();
            return $this->render('add-form-initiative', [
                'category_s' => $modelICat,
                'user_name' => $modelU['fullname']
            ]);
        } else{ return $this->redirect(['/site/index']); }
    }

    public function actionUsersSearch()
    {
        if ( tools::isAuth() ){
            if ( tools::isAjax() && tools::isPost() ){
                $userData = UserData::find()->where(['like', 'fullname', tools::getPost('value')])->andWhere(['status_delete' => 0])->orderBy(['fullname' => SORT_ASC])->all();
                if ( $userData ){
                    $users = [];
                    foreach ( $userData as $item ){
                        $data = User::find()->where(['id' => $item['user_id']])->one();
                        if ( $data && $data['id'] > 1 ){
                            $users[] = $item;
                        }
                    }
                    return $this->renderAjax('users-search', [
                        'data' => $users
                    ]);
                } else{
                    return $this->renderAjax('users-search', [
                        'data' => $userData
                    ]);
                }
            }
        } else{ return $this->redirect(['/site/index']); }
    }

    public function actionDepartmentSearch()
    {
        if ( tools::isAuth() ){
            if ( tools::isAjax() && tools::isPost() ){
                return $this->renderAjax('department-search', [
                    'data' => DepartmentContent::find()->where(['like', 'title', tools::getPost('value')])->all()
                ]);
            }
        } else{ return $this->redirect(['/site/index']); }
    }

    public function actionAddInitiative()
    {
        if ( tools::isAuth() ){
            if ( tools::isAjax() && tools::isPost() ){
                $modelI = new Initiative();
                $modelI->user_id = tools::idUser();
                $modelI->department_id  = tools::getPost('department_id');
                $modelI->category_id = tools::getPost('category_id');
                $modelI->status_id = 1;
                $modelI->status = 1;
                $modelI->status_delete = 0;
                if ( $modelI->save() ){
                    $modelIC = new InitiativeContent();
                    $modelIC->initiative_id = $modelI->id;
                    $modelIC->title = tools::getPost('title');
                    $modelIC->problem_text = tools::getPost('msg_problem');
                    $modelIC->solution_text = tools::getPost('msg_solution');
                    $modelIC->effect_text = tools::getPost('msg_effect');
                    $modelIC->contacts = tools::getPost('contacts');
                    if ( $modelIC->save() ){
                        $modelIS = new InitiativeSupportive();
                        $modelIS->initiative_id = $modelI->id;
                        $modelIS->user_id = tools::getPost('helper_id') == 0 ? 'NULL' : tools::getPost('helper_id');
                        $modelIS->save();
                        return $modelI->id;
                    }
                }
            }
        } else{ return $this->redirect(['/site/index']); }
    }

    public function actionViewInitiative()
    {
        if ( tools::isAuth() ){
            return $this->render('view-initiative', [
                'data' => $this->getInitiative( Initiative::find()->where(['id' => $_GET['i']])->one(), true )
            ]);
        } else{ return $this->redirect(['/site/index']); }
    }

    public function actionViewMyInitiative()
    {
        if ( tools::isAuth() ){
            if ( tools::isAjax() && tools::isPost() ){
                $data = $this->getInitiative( Initiative::find()->where(['status_delete' => 0])->andWhere(['user_id' => tools::idUser()])->orderBy(['status_id' => SORT_ASC])->all(), false );
//                $dataSupportive = [];
//                $modelIS = InitiativeSupportive::find()->where(['user_id' => tools::idUser()])->all();
//                foreach ( $modelIS as $item ){
//                    $modelI = Initiative::find()->where(['id' => $item['initiative_id']])->one();
//                    if ( $modelI['status_delete'] == 0 ){
//                        $dataSupportive[] = $this->getInitiative( $modelI, true );
//                    }
//                }
//                $data = array_merge($data, $dataSupportive);
                return $this->renderAjax('view-initiative-items', [
                    'data' => $data
                ]);
            }
        } else{ return $this->redirect(['/site/index']); }
    }

    public function actionViewMeInitiative()
    {
        if ( tools::isAuth() ){
            if ( tools::isAjax() && tools::isPost() && tools::isPermission('initiative')['responseInitiative'] ){
                return $this->renderAjax('view-initiative-items-management', [
                    'data' => $this->getInitiative( Initiative::find()->where(['status_delete' => 0])->andWhere(['status' => 1])->andWhere(['status_id' => '1'])->all(), false )
                ]);
            }
        } else{ return $this->redirect(['/site/index']); }
    }

    public function actionResponse()
    {
        if ( tools::isAuth() && tools::isPermission('initiative')['responseInitiative'] ){
            return $this->render('response', [
                'data' => $this->getInitiative( Initiative::find()->where(['id' => $_GET['i']])->one(), true ),
                'status_s' => InitiativeStatus::find()->all()
            ]);
        } else{ return $this->redirect(['/initiative/index']); }
    }

    public function actionAddResponse()
    {
        if ( tools::isAuth() ){
            if ( tools::isAjax() && tools::isPost() ){
                $modelIC = InitiativeContent::find()->where(['initiative_id' => tools::getPost('id')])->one();
                $modelIC->response_text = tools::getPost('response');
                if ( $modelIC->save() ){
                    $modelI = Initiative::find()->where(['id' => tools::getPost('id')])->one();
                    $modelI->status_id = tools::getPost('status');
                    if ( $modelI->save() ){
                        $notify = new Notification();
                        $notify->data_key = 'initiative';
                        $notify->user_id = $modelI->user_id;
                        $notify->message = 'Статус инициативы "' .  $modelIC->title . '" изменен';
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
                $value = tools::getPost('value');
                $modelSearch = [];
                $modelIC = InitiativeContent::find()->where(['like', 'title', $value])->all();
                foreach ( $modelIC as $ic ){
                    $modelI = Initiative::find()->where(['id' => $ic['initiative_id']])->one();
                    if ( $modelI['status_delete'] == 0 ){
                        $modelSearch[] = $this->getInitiative( $modelI, true );
                    }
                }
                return $this->renderAjax('view-initiative-items', [
                    'data' => $modelSearch
                ]);
            }
        } else{ return $this->redirect(['/site/index']); }
    }

    public function actionIndexRegedit()
    {
        if ( tools::isAuth() ){
            $modelI = Initiative::find()->where(['status_delete' => 0])->one();
            if ( isset($modelI) ){
                $first_id = $modelI['id'];
            } else{
                $first_id = 0;
            }
            return $this->render('regedit', [
                'first_id' => $first_id
            ]);
        } else{ return $this->redirect(['/site/index']); }
    }

    public function actionViewRegeditItems()
    {
        if ( tools::isAuth() ){
            if ( tools::isAjax() && tools::isPost() ){
                if ( tools::getPost('last_id') == 0 ){
                    return $this->renderAjax('view-initiative-regedit', [
                        'data' => $this->getInitiative( Initiative::find()
                            ->where(['status_delete' => 0])
                            ->orderBy(['date_add' => SORT_DESC])
                            ->limit('10')
                            ->all(), false ),
                        'i' => tools::getPost('key')
                    ]);
                } else{
                    return $this->renderAjax('view-initiative-regedit', [
                        'data' => $this->getInitiative( Initiative::find()
                            ->where(['status_delete' => 0])
                            ->andWhere(['<', 'id', tools::getPost('last_id')])
                            ->orderBy(['date_add' => SORT_DESC])
                            ->limit('10')->all(), false ),
                        'i' => tools::getPost('key')
                    ]);
                }
            }
        } else{ return $this->redirect(['/site/index']); }
    }

    public function actionSortRegedit()
    {
        if ( tools::isAuth() ){
            if ( tools::isAjax() && tools::isPost() ){
                $value = tools::getPost('value');
                if ( tools::getPost('sort') == 'department' ){
                    $modelDC = DepartmentContent::find()->where(['like', 'title', $value])->orWhere(['like', 'abbreviation', $value])->orderBy(['title' => tools::getPost('type_sort') == 'asc' ? SORT_ASC : SORT_DESC])->all();
                    $data = [];
                    if ( isset($modelDC) ){
                        foreach ( $modelDC as $dc ){
                            $modelI = Initiative::find()->where(['status_delete' => 0])->andWhere(['department_id' => $dc['id']])->all();
                            foreach ( $modelI as $i ){
                                $data[] = $this->getInitiative( $i, true );
                            }
                        }
                    }
                    return $this->renderAjax('view-initiative-regedit', [
                        'data' => $data,
                        'i' => 1
                    ]);
                } elseif ( tools::getPost('sort') == 'author' ){
                    $modelUD = UserData::find()->where(['status_delete' => 0])->andWhere(['like', 'fullname', $value])->orderBy(['fullname' => tools::getPost('type_sort') == 'asc' ? SORT_ASC : SORT_DESC])->all();
                    $data = [];
                    if ( isset($modelUD) ){
                        foreach ( $modelUD as $ud ){
                            $modelI = Initiative::find()->where(['status_delete' => 0])->andWhere(['user_id' => $ud['user_id']])->orderBy(['date_add' => tools::getPost('type_sort') == 'asc' ? SORT_ASC : SORT_DESC])->all();
                            if ( isset($modelI) ){
                                foreach ( $modelI as $i ){
                                    $data[] = $this->getInitiative( $i, true );
                                }
                            }
                        }
                    }
                    return $this->renderAjax('view-initiative-regedit', [
                        'data' => $data,
                        'i' => 1
                    ]);
                } else{
                    $modelIS = InitiativeStatus::find()->where(['like', 'name', $value])->all();
                    $data = [];
                    if ( isset($modelIS) ){
                        foreach ( $modelIS as $is ){
                            $modelI = Initiative::find()->where(['status_delete' => 0])->andWhere(['status_id' => $is['id']])->orderBy(['date_add' => tools::getPost('type_sort') == 'asc' ? SORT_ASC : SORT_DESC])->all();
                            foreach ( $modelI as $i ){
                                $data[] = $this->getInitiative( $i, true );
                            }
                        }
                    }
                    return $this->renderAjax('view-initiative-regedit', [
                        'data' => $data,
                        'i' => 1
                    ]);
                }
            }
        } else{ return $this->redirect(['/site/index']); }
    }

    public function actionSearchRegedit()
    {
        if ( tools::isAuth() ){
            if ( tools::isAjax() && tools::isPost() ){
                $value = tools::getPost('value');
                $modelIC = InitiativeContent::find()->where(['like', 'title', $value])->all();
                $data = [];
                if ( isset($modelIC) ){
                    foreach ( $modelIC as $ic ){
                        $modelI = Initiative::find()->where(['status_delete' => 0])->andWhere(['id' => $ic['initiative_id']])->one();
                        $data[] = $this->getInitiative( $modelI, true );
                    }
                }
                return $this->renderAjax('view-initiative-regedit', [
                    'data' => $data,
                    'i' => 1
                ]);
            }
        } else{ return $this->redirect(['/site/index']); }
    }

}