<?php

namespace frontend\controllers;

use common\models\User;
use frontend\models\Department;
use frontend\models\DepartmentBottom;
use frontend\models\DepartmentChildren;
use frontend\models\DepartmentContent;
use frontend\models\DepartmentMiddle;
use frontend\models\DepartmentStaff;
use frontend\models\UserAvatar;
use frontend\models\UserData;
use frontend\models\UserTelephone;
use frontend\tools\tools;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

/** Department controller */
class DepartmentController extends Controller
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

    public function getDepartment($model, $one, $key)
    {
        $data = [];
        if ( $one ){
            if ( $key == 'top' ){
                $modelDC = DepartmentContent::find()->where(['department_id' => $model['id']])->one();
            } elseif ( $key == 'middle' ){
                $modelDC = DepartmentContent::find()->where(['middle_id' => $model['id']])->one();
            } else{
                $modelDC = DepartmentContent::find()->where(['bottom_id' => $model['id']])->one();
            }
            $data = [
                'id'            => $model['id'],
                'title'         => $modelDC['title'],
                'abbreviation'  => $modelDC['abbreviation'],
                'telephone'     => $modelDC['telephone'],
                'type'          => $modelDC['data_key'],
                'bottoms'       => isset($model['bottoms']) ? $model['bottoms'] : NULL
            ];
        } elseif ( $key == 'all'){
            foreach ( $model as $item ){
                if ( $item['child_key'] == 'middle' ){
                    $modelDC = DepartmentContent::find()->where(['middle_id' => $item['child_id']])->one();
                } else{
                    $modelDC = DepartmentContent::find()->where(['bottom_id' => $item['child_id']])->one();
                }
                $data[] = [
                    'id'            => $item['child_id'],
                    'title'         => $modelDC['title'],
                    'abbreviation'  => $modelDC['abbreviation'],
                    'telephone'     => $modelDC['telephone'],
                    'type'          => $modelDC['data_key']
                ];
            }
        } else{
            foreach ( $model as $item ){
                if ( $key == 'top' ){
                    $modelDC = DepartmentContent::find()->where(['department_id' => $item['id']])->one();
                } elseif ( $key == 'middle' ){
                    $modelDC = DepartmentContent::find()->where(['middle_id' => $item['id']])->one();
                } else{
                    $modelDC = DepartmentContent::find()->where(['bottom_id' => $item['id']])->one();
                }
                $data[] = [
                    'id'            => $item['id'],
                    'title'         => $modelDC['title'],
                    'abbreviation'  => $modelDC['abbreviation'],
                    'telephone'     => $modelDC['telephone'],
                    'type'          => $modelDC['data_key']
                ];
            }
        }
        return $data;
    }

    /** Displays homepage. @return mixed */
    public function actionIndex()
    {
        if ( tools::isAuth() ){
            $director_id = DepartmentStaff::find()->where(['data_key' => 'director'])->one() ? DepartmentStaff::find()->where(['data_key' => 'director'])->one()['user_id'] : '1';
            $modelUD = UserData::find()->where(['user_id' => $director_id])->one();
            $director = [
                'id' => $director_id,
                'fullname' => $modelUD['fullname'],
                'email' => User::find()->where(['id' => $director_id])->one()['email'],
                'telephone' => UserTelephone::find()->where(['user_id' => $director_id])->andWhere(['status_delete' => 0])->one()['telephone'],
                'avatar' => UserAvatar::find()->where(['user_id' => $director_id])->andWhere(['status_delete' => 0])->one()['src']
            ];
            $modelD = Department::find()->where(['status_delete' => 0])->all();
            return $this->render('index', [
                'director' => $director,
                'departments_top' => $this->getDepartment( $modelD, false, 'top' )
            ]);
        } else{ return $this->redirect(['/site/index']); }
    }

    /** Displays selected department. @return mixed */
    public function actionView()
    {
        if ( tools::isAuth() ){
            $modelD = Department::find()->where(['id' => $_GET['d']])->one();
            $director = NULL;
            $director_id = DepartmentStaff::find()->where(['data_key' => 'supervisor'])->andWhere(['department_key' => 'top'])->andWhere(['department_id' => $modelD['id']])->one();
            if ( isset($director_id) ){
                $modelUD = UserData::find()->where(['user_id' => $director_id['user_id']])->one();
                $director = [
                    'id' => $director_id['user_id'],
                    'fullname' => $modelUD['fullname'],
                    'email' => User::find()->where(['id' => $director_id['user_id']])->one()['email'],
                    'telephone' => UserTelephone::find()->where(['user_id' => $director_id['user_id']])->andWhere(['status_delete' => 0])->one()['telephone'],
                    'avatar' => UserAvatar::find()->where(['user_id' => $director_id['user_id']])->andWhere(['status_delete' => 0])->one()['src']
                ];
            }
            return $this->render('view-department', [
                'director' => $director,
                'departments_top' => $this->getDepartment( $modelD, true, 'top' )
            ]);
        } else{ return $this->redirect(['/site/index']); }
    }

    /** Displays admin page. @return mixed */
    public function actionAdmin()
    {
        if ( tools::isAuth() && tools::isCan('adminDepartment') ){
            $modelD = Department::find()->where(['status_delete' => 0])->all();
            $modelDM = DepartmentMiddle::find()->where(['status_delete' => 0])->all();
            $modelDB = DepartmentBottom::find()->where(['status_delete' => 0])->all();
            $director_id = DepartmentStaff::find()->where(['data_key' => 'director'])->one() ? DepartmentStaff::find()->where(['data_key' => 'director'])->one()['user_id'] : 1;
            $modelUD = UserData::find()->where(['user_id' => $director_id])->one();
            $director = [
                'id' => $director_id,
                'fullname' => $modelUD['fullname'],
                'email' => User::find()->where(['id' => $director_id])->one()['email'],
                'telephone' => UserTelephone::find()->where(['user_id' => $director_id])->andWhere(['status_delete' => 0])->one()['telephone'],
                'avatar' => UserAvatar::find()->where(['user_id' => $director_id])->andWhere(['status_delete' => 0])->one()['src']
            ];
            return $this->render('admin', [
                'top' => $this->getDepartment( $modelD, false, 'top' ),
                'middle' => $this->getDepartment( $modelDM, false, 'middle' ),
                'bottom' => $this->getDepartment( $modelDB, false, 'bottom' ),
                'director' => $director
            ]);
        } else{ return $this->redirect(['/site/index']); }
    }

    /** Adding form from departments. @return mixed */
    public function actionAddForm()
    {
        if ( tools::isAuth() && tools::isCan('adminDepartment') ){
            return $this->render('add-from');
        } else{ return $this->redirect(['/site/index']); }
    }

    /** Adding departments to database (ajax_page). @return mixed */
    public function actionAdd()
    {
        if ( tools::isAuth() && tools::isAjax() && tools::isPost() && tools::isCan('adminDepartment') ){
            if ( tools::getPost('type') == 'top' ){
                $modelD = new Department();
                $modelD->user_id = tools::idUser();
                $modelD->bottoms = 0;
                $modelD->status = 1;
                $modelD->status_delete = 0;
                if ( $modelD->save() ){
                    $modelDC = new DepartmentContent();
                    $modelDC->data_key = 'top';
                    $modelDC->department_id = $modelD->id;
                    $modelDC->title = tools::getPost('title');
                    $modelDC->abbreviation = tools::getPost('abbreviation');
                    $modelDC->telephone = tools::getPost('telephone');
                    if ( $modelDC->save() ){
                        return $modelD->id;
                    }
                 }
            } elseif ( tools::getPost('type') == 'middle' ){
                $modelDM = new DepartmentMiddle();
                $modelDM->user_id = tools::idUser();
                $modelDM->status = 1;
                $modelDM->status_delete = 0;
                if ( $modelDM->save() ){
                    $modelDC = new DepartmentContent();
                    $modelDC->data_key = 'middle';
                    $modelDC->middle_id = $modelDM->id;
                    $modelDC->title = tools::getPost('title');
                    $modelDC->abbreviation = tools::getPost('abbreviation');
                    $modelDC->telephone = tools::getPost('telephone');
                    if ( $modelDC->save() ){
                        return $modelDM->id;
                    }
                }
            } else{
                $modelDB = new DepartmentBottom();
                $modelDB->user_id = tools::idUser();
                $modelDB->status = 1;
                $modelDB->status_delete = 0;
                if ( $modelDB->save() ){
                    $modelDC = new DepartmentContent();
                    $modelDC->data_key = 'bottom';
                    $modelDC->bottom_id = $modelDB->id;
                    $modelDC->title = tools::getPost('title');
                    $modelDC->abbreviation = tools::getPost('abbreviation');
                    $modelDC->telephone = tools::getPost('telephone');
                    if ( $modelDC->save() ){
                        return $modelDB->id;
                    }
                }
            }
        } else{ return $this->redirect(['/site/index']); }
    }

    /** Updating form from departments. @return mixed */
    public function actionUpdateForm()
    {
        if ( tools::isAuth() && tools::isCan('adminDepartment') ){
            $model = '';
            $type = '';
            if ( $_GET['t'] == 't' ){
                $model = Department::find()->where(['id' => $_GET['d']])->one();
                $model_children = DepartmentChildren::find()->where(['parent_id' => $_GET['d']])->andWhere(['parent_key' => 'top'])->all();
                $modelDM = DepartmentMiddle::find()->where(['status_delete' => 0])->andWhere(['parent_id' => NULL])->all();
                $modelDB = DepartmentBottom::find()->where(['status_delete' => 0])->andWhere(['parent_id' => NULL])->all();
                $type = 'top';
                $supervisor = NULL;
                $supervisor_id = DepartmentStaff::find()->where(['department_key' => 'top'])->andWhere(['department_id' => $_GET['d']])->one();
                if ( isset($supervisor_id) ){
                    $modelUD = UserData::find()->where(['user_id' => $supervisor_id['user_id']])->one();
                    $supervisor = [
                        'id' => $supervisor_id['user_id'],
                        'fullname' => $modelUD['fullname'],
                        'email' => User::find()->where(['id' => $supervisor_id['user_id']])->one()['email'],
                        'telephone' => UserTelephone::find()->where(['user_id' => $supervisor_id['user_id']])->andWhere(['status_delete' => 0])->one()['telephone'],
                        'avatar' => UserAvatar::find()->where(['user_id' => $supervisor_id['user_id']])->andWhere(['status_delete' => 0])->one()['src']
                    ];
                }
                return $this->render('update-form', [
                    'data' => $this->getDepartment( $model, true, $type ),
                    'dataDM' => $this->getDepartment( $modelDM, false, 'middle' ),
                    'dataDB' => $this->getDepartment( $modelDB, false, 'bottom' ),
                    'children' => $this->getDepartment( $model_children, false, 'all' ),
                    'supervisor' => $supervisor
                ]);
            } elseif( $_GET['t'] == 'm' ){
                $model = DepartmentMiddle::find()->where(['id' => $_GET['d']])->one();
                $model_children = DepartmentChildren::find()->where(['parent_id' => $_GET['d']])->andWhere(['parent_key' => 'middle'])->all();
                $modelDB = DepartmentBottom::find()->where(['status_delete' => 0])->andWhere(['parent_id' => NULL])->all();
                $type = 'middle';
                $supervisor = NULL;
                $supervisor_id = DepartmentStaff::find()->where(['department_key' => 'middle'])->andWhere(['department_id' => $_GET['d']])->one();
                if ( isset($supervisor_id) ){
                    $modelUD = UserData::find()->where(['user_id' => $supervisor_id['user_id']])->one();
                    $supervisor = [
                        'id' => $supervisor_id['user_id'],
                        'fullname' => $modelUD['fullname'],
                        'email' => User::find()->where(['id' => $supervisor_id['user_id']])->one()['email'],
                        'telephone' => UserTelephone::find()->where(['user_id' => $supervisor_id['user_id']])->andWhere(['status_delete' => 0])->one()['telephone'],
                        'avatar' => UserAvatar::find()->where(['user_id' => $supervisor_id['user_id']])->andWhere(['status_delete' => 0])->one()['src']
                    ];
                }
                return $this->render('update-form', [
                    'data' => $this->getDepartment( $model, true, $type ),
                    'dataDB' => $this->getDepartment( $modelDB, false, 'bottom' ),
                    'dataDM' => NULL,
                    'children' => $this->getDepartment( $model_children, false, 'all' ),
                    'supervisor' => $supervisor
                ]);
            } else{
                $model = DepartmentBottom::find()->where(['id' => $_GET['d']])->one();
                $type = 'bottom';
                return $this->render('update-form', [
                    'data' => $this->getDepartment( $model, true, $type ),
                    'dataDM' => NULL,
                    'dataDB' => NULL,
                    'children' => NULL,
                    'supervisor' => NULL
                ]);
            }
        } else{ return $this->redirect(['/site/index']); }
    }

    /** Updating title departments. @return mixed */
    public function actionUpdateTitle()
    {
        if ( tools::isAuth() && tools::isAjax() && tools::isPost() && tools::isCan('adminDepartment') ){
            if ( tools::getPost('type') == 'top' ){
                $model = DepartmentContent::find()->where(['department_id' => tools::getPost('id')])->one();
                $model->title = tools::getPost('title');
            } elseif ( tools::getPost('type') == 'middle' ){
                $model = DepartmentContent::find()->where(['middle_id' => tools::getPost('id')])->one();
                $model->title = tools::getPost('title');
            } else{
                $model = DepartmentContent::find()->where(['bottom_id' => tools::getPost('id')])->one();
                $model->title = tools::getPost('title');
            }
            if ( $model->save() ){
                return $this->renderAjax('notification', [
                    'data' => tools::setNotification('success', 'Наименование успешно изменено.')
                ]);
            }
        } else{ return $this->redirect(['/site/index']); }
    }

    /** Updating telephone departments. @return mixed */
    public function actionUpdateTelephone()
    {
        if ( tools::isAuth() && tools::isAjax() && tools::isPost() && tools::isCan('adminDepartment') ){
            if ( tools::getPost('type') == 'top' ){
                $model = DepartmentContent::find()->where(['department_id' => tools::getPost('id')])->one();
                $model->telephone = tools::getPost('telephone');
            } elseif ( tools::getPost('type') == 'middle' ){
                $model = DepartmentContent::find()->where(['middle_id' => tools::getPost('id')])->one();
                $model->telephone = tools::getPost('telephone');
            } else{
                $model = DepartmentContent::find()->where(['bottom_id' => tools::getPost('id')])->one();
                $model->telephone = tools::getPost('telephone');
            }
            if ( $model->save() ){
                return $this->renderAjax('notification', [
                    'data' => tools::setNotification('success', 'Телефон успешно изменен.')
                ]);
            }
        } else{ return $this->redirect(['/site/index']); }
    }

    /** Updating bottoms departments. @return mixed */
    public function actionUpdateBottoms()
    {
        if ( tools::isAuth() && tools::isAjax() && tools::isPost() && tools::isCan('adminDepartment') ){
            $model = Department::find()->where(['id' => tools::getPost('id')])->one();
            if ( $model['bottoms'] == 0 ){
                $model->bottoms = 1;
            } else{
                $model->bottoms = 0;
            }
            if ( $model->save() ){
                return $this->renderAjax('notification', [
                    'data' => tools::setNotification('success', 'Вид структуры изменен успешно.')
                ]);
            }
        } else{ return $this->redirect(['/site/index']); }
    }

    /** Logical deleting departments. @return mixed */
    public function actionDelete()
    {
        if ( tools::isAuth() && tools::isAjax() && tools::isPost() && tools::isCan('adminDepartment') ){
            $id = tools::getPost('delete_id');
            $type = tools::getPost('delete_type');
            if ( $type == 't' ){
                $modelD = Department::find()->where(['id' => $id])->one();
                $modelD->status = 0;
                $modelD->status_delete = 1;
                $modelD->save();
            } elseif ( $type == 'm' ){
                $modelDM = DepartmentMiddle::find()->where(['id' => $id])->one();
                $modelDM->status = 0;
                $modelDM->status_delete = 1;
                $modelDM->save();
            } else{
                $modelDB = DepartmentBottom::find()->where(['id' => $id])->one();
                $modelDB->status = 0;
                $modelDB->status_delete = 1;
                $modelDB->save();
            }
        } else{ return $this->redirect(['/site/index']); }
    }

    /** Set structure from current department. @return mixed */
    public function actionSetStructure()
    {
        if ( tools::isAuth() && tools::isAjax() && tools::isPost() && tools::isCan('adminDepartment') ){
            $current_id = tools::getPost('current_id');
            $current_type = tools::getPost('current_type');
            $selected_id = tools::getPost('selected_id');
            $selected_type = tools::getPost('selected_type');
            if ( $selected_type == 'm' ){
                $modelDM = DepartmentMiddle::find()->where(['id' => $selected_id])->one();
                $modelDM->parent_id = $current_id;
                if ( $modelDM->save() ){
                    $modelDC = new DepartmentChildren();
                    $modelDC->parent_key = $current_type;
                    $modelDC->parent_id = $current_id;
                    $modelDC->child_key = $selected_type == 'm' ? 'middle' : 'bottom';
                    $modelDC->child_id = $selected_id;
                    $modelDC->save();
                }
            } else{
                $modelDB = DepartmentBottom::find()->where(['id' => $selected_id])->one();
                $modelDB->parent_id = $current_id;
                if ( $modelDB->save() ){
                    $modelDC = new DepartmentChildren();
                    $modelDC->parent_key = $current_type;
                    $modelDC->parent_id = $current_id;
                    $modelDC->child_key = $selected_type == 'm' ? 'middle' : 'bottom';
                    $modelDC->child_id = $selected_id;
                    $modelDC->save();
                }
            }
        } else{ return $this->redirect(['/site/index']); }
    }

    /** Remove structure from current department. @return mixed */
    public function actionRemoveStructure()
    {
        if ( tools::isAuth() && tools::isAjax() && tools::isPost() && tools::isCan('adminDepartment') ){
            $delete_id = tools::getPost('delete_id');
            $delete_type = tools::getPost('delete_type');
            if ( $delete_type == 'm' ){
                $modelDM = DepartmentMiddle::find()->where(['id' => $delete_id])->one();
                $modelDM->parent_id = NULL;
                if ( $modelDM->save() ){
                    $modelDC = DepartmentChildren::find()->where(['child_key' => 'middle'])->andWhere(['child_id' => $delete_id])->one();
                    $modelDC->delete();
                }
            } else{
                $modelDB = DepartmentBottom::find()->where(['id' => $delete_id])->one();
                $modelDB->parent_id = NULL;
                if ( $modelDB->save() ){
                    $modelDC = DepartmentChildren::find()->where(['child_key' => 'bottom'])->andWhere(['child_id' => $delete_id])->one();
                    $modelDC->delete();
                }
            }
        } else{ return $this->redirect(['/site/index']); }
    }

    /** Adding new director a current company. @return mixed */
    public function actionAddDirector()
    {
        if ( tools::isAuth() && tools::isAjax() && tools::isPost() && tools::isCan('adminDepartment') ){
            $modelDS = DepartmentStaff::find()->where(['data_key' => 'director'])->one();
            if ( $modelDS ){
                $modelDS->user_id = tools::getPost('director_id');
                $modelDS->save();
            } else{
                $modelDS = new DepartmentStaff();
                $modelDS->data_key = 'director';
                $modelDS->user_id = tools::getPost('director_id');
                $modelDS->department_key = 'director';
                $modelDS->save();
            }
        } else{ return $this->redirect(['/site/index']); }
    }

    /** Adding new supervisor a current company. @return mixed */
    public function actionAddSupervisor()
    {
        if ( tools::isAuth() && tools::isAjax() && tools::isPost() && tools::isCan('adminDepartment') ){
            $modelDS = DepartmentStaff::find()->where(['data_key' => 'supervisor'])->andWhere(['department_id' => tools::getPost('id')])->one();
            if ( $modelDS ){
                $modelDS->user_id = tools::getPost('director_id');
                $modelDS->department_key = tools::getPost('type');
                $modelDS->department_id = tools::getPost('id');
                $modelDS->save();
            } else{
                $modelDS = new DepartmentStaff();
                $modelDS->data_key = 'supervisor';
                $modelDS->user_id = tools::getPost('director_id');
                $modelDS->department_key = tools::getPost('type');
                $modelDS->department_id = tools::getPost('id');
                $modelDS->save();
            }
        } else{ return $this->redirect(['/site/index']); }
    }

}
