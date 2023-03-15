<?php

namespace frontend\controllers;

require '../language/language.php';

use common\models\User;
use frontend\models\Department;
use frontend\models\DepartmentBottom;
use frontend\models\DepartmentMiddle;
use frontend\models\File;
use frontend\models\FileContent;
use frontend\models\InformationContent;
use frontend\models\UploadImage;
use frontend\models\UserData;
use frontend\models\UserMentor;
use frontend\models\UserTelephone;
use Yii;
use yii\imagine\Image;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use frontend\models\DepartmentWorker;
use frontend\models\DepartmentContent;
use frontend\models\UserAvatar;

use frontend\language\language as lang;

/**
 * Profile controller
 */
class ProfileController extends Controller
{
    public $layout = 'main';

    public function behaviors()
    {
        return [
            'access' => ['class' => AccessControl::className(), 'only' => ['logout', 'signup'], 'rules' => [ ['actions' => ['signup'], 'allow' => true, 'roles' => ['?'],], ['actions' => ['logout'], 'allow' => true, 'roles' => ['@'],], ],],
            'verbs' => [ 'class' => VerbFilter::className(), 'actions' => ['logout' => ['post'],], ],
        ];
    }

    public function actions()
    {
        return [ 'error' => ['class' => 'yii\web\ErrorAction',], 'captcha' => ['class' => 'yii\captcha\CaptchaAction', 'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,], ];
    }

    public function isAuth() { if (!Yii::$app->user->isGuest){ return true; } else { return false; } }
    public function isAjax() { if (Yii::$app->request->isAjax){ return true; } else { return false; } }
    public function isPost() { if (Yii::$app->request->isPost){ return true; } else { return false; } }
    public function idUser() { return Yii::$app->user->id; }

    public function setNotification($key, $text){
        return [ 'key' => $key, 'id' => rand(1000, 9999), 'text' => $text ];
    }

    public function getDepartment()
    {
        $worker = DepartmentWorker::find()->where(['user_id' => $this->idUser()])->one();
        if ( $worker ){
            if ( $worker['data_key'] == 'top' ){
                $department = DepartmentContent::find()->where(['department_id' => $worker['department_id']])->one();
            } else if ( $worker['data_key'] == 'middle' ){
                $department = DepartmentContent::find()->where(['middle_id' => $worker['middle_id']])->one();
            } else {
                $department = DepartmentContent::find()->where(['bottom_id' => $worker['bottom_id']])->one();
            }
        }

        $data = array(
            'id' => isset($department['id']) ? $department['id'] : '0',
            'name' => isset($department['title']) ? $department['title'] : ' ',
        );

        return $data;
    }

    public function getAvatar()
    {
        $avatar = UserAvatar::find()->where(['user_id' => $this->idUser()])->one();
        return $avatar['src'];
    }

    public function getTelephone()
    {
        return UserTelephone::find()->where(['user_id' => $this->idUser(), 'status_delete' => '0'])->all();
    }

    public function getMentor()
    {
        $mentor = UserMentor::find()->where(['user_id' => $this->idUser()])->one();
        return $mentor['user_id_mentor'];
    }

    public function getEmail()
    {
        $email = User::find()->where(['id' => $this->idUser()])->one();
        return $email['email'];
    }

    public function getProfile()
    {
        $user_id = $this->idUser();
        $userData = UserData::find()->where(['user_id' => $user_id, 'status_delete' => '0'])->one();
        $telephone = $this->getTelephone();
        $login = User::find()->where(['id' => $user_id])->one();
        return $data = array(
            'surname'           => $userData['surname'],
            'firstname'         => $userData['firstname'],
            'fullname'          => $userData['fullname'],
            'department'        => $this->getDepartment(),
            'job'               => $userData['job'],
            'avatar'            => $this->getAvatar(),
            'recruitment'       => Yii::$app->formatter->asDate($userData['recruitment'], 'dd/MM/yyyy'),
            'email'             => $this->getEmail(),
            'telephone'         => count($telephone) > 0 ? $telephone : '',
            'mentor'            => $this->getMentor(),
            'birthday_day'      => $userData['birthday_day'],
            'birthday_month'    => $userData['birthday_month'],
            'birthday_year'     => $userData['birthday_year'],
            'birthday_view'     => $userData['birthday_view'],
            'address'           => $userData['address'],
            'login'             => $login['username'],
            'in_work'           => $userData['in_work'],
        );
    }

    public function actionIndex()
    {
        if ( $this->isAuth() ) {
            return $this->render('index', [
                'data' => $this->getProfile()
            ]);
        } else{ return $this->redirect(['/site/index']); }
    }

    public function actionViewProfile()
    {
        if ( $this->isAuth() ) {
            $user_id = $_GET['u'];
            $userData = UserData::find()->where(['user_id' => $user_id, 'status_delete' => '0'])->one();
            $telephone = UserTelephone::find()->where(['user_id' => $user_id, 'status_delete' => '0'])->all();
            $mentor = UserMentor::find()->where(['user_id' => $user_id])->one();
            $worker = DepartmentWorker::find()->where(['user_id' => $user_id])->one();
            if ( $worker ){
                if ( $worker['data_key'] == 'top' ){
                    $department = DepartmentContent::find()->where(['department_id' => $worker['department_id']])->one();
                } else if ( $worker['data_key'] == 'middle' ){
                    $department = DepartmentContent::find()->where(['middle_id' => $worker['middle_id']])->one();
                } else {
                    $department = DepartmentContent::find()->where(['bottom_id' => $worker['bottom_id']])->one();
                }
                $worker = array(
                    'id' => $department['id'],
                    'name' => $department['title'],
                );
            } else{
                $worker = '';
            }
            $mentor = UserData::find()->where(['user_id' => $mentor['user_id_mentor'], 'status_delete' => '0'])->one();
            $mentor = $mentor['surname'] . ' ' . $mentor['firstname'] . ' ' . $mentor['report'];

            $data = [
                'surname'           => $userData['surname'],
                'firstname'         => $userData['firstname'],
                'fullname'          => $userData['fullname'],
                'department'        => $worker,
                'job'               => $userData['job'],
                'avatar'            => UserAvatar::find()->where(['user_id' => $user_id])->one()['src'],
                'recruitment'       => Yii::$app->formatter->asDate($userData['recruitment'], 'dd/MM/yyyy'),
                'email'             => User::find()->where(['id' => $user_id])->one()['email'],
                'telephone'         => count($telephone) > 0 ? $telephone : '',
                'mentor'            => $mentor,
                'birthday_day'      => $userData['birthday_day'],
                'birthday_month'    => $userData['birthday_month'],
                'birthday_year'     => $userData['birthday_year'],
                'birthday_view'     => $userData['birthday_view'],
                'address'           => $userData['address'],
                'in_work'           => $userData['in_work']
            ];
            return $this->render('view-profile', [
                'data' => $data
            ]);
        } else{ return $this->redirect(['/site/index']); }
    }

    public function actionInformation()
    {
        if ( $this->isAjax() )
        {
            if ( $this->isAuth() ) {
                return $this->renderAjax('information_view', [
                    'information' => InformationContent::find()->all()
                ]);
            } else{ return $this->redirect(['/site/index']); }
        }
    }

    public function actionProfileEdit()
    {
        if ( $this->isAuth() ) {
            $department = [];
            $modelD = Department::find()->where(['status_delete' => 0])->all();
            foreach ( $modelD as $item ){
                $department[] = DepartmentContent::find()->where(['data_key' => 'top'])->andWhere(['department_id' => $item['id']])->one();
            }
            $modelDM = DepartmentMiddle::find()->where(['status_delete' => 0])->all();
            foreach ( $modelDM as $item ){
                $department[] = DepartmentContent::find()->where(['data_key' => 'middle'])->andWhere(['middle_id' => $item['id']])->one();
            }
            $modelDB = DepartmentBottom::find()->where(['status_delete' => 0])->all();
            foreach ( $modelDB as $item ){
                $department[] = DepartmentContent::find()->where(['data_key' => 'bottom'])->andWhere(['bottom_id' => $item['id']])->one();
            }
            return $this->render('profile_form', [
                'data' => $this->getProfile(),
                'telephones' => $this->getTelephone(),
                'departments' => $department
            ]);
        } else{ return $this->redirect(['/site/index']); }
    }

    public function actionUpdateJob()
    {
        if( $this->isAjax() ){
            if( $this->isPost() ){
                $value = Yii::$app->request->post('__val');
                $model = UserData::find()->where(['user_id' => $this->idUser()])->one();
                $model->job = $value;
                if ( $model->save() ){
                    if ( $this->isAuth() ) {
                        return $this->renderAjax('notification', [
                            'data' => $this->setNotification('success', lang::$profile['n_yes_update_job'])
                        ]);
                    } else{ return $this->redirect(['/site/index']); }
                } else{
                    if ( $this->isAuth() ) {
                        return $this->renderAjax('notification', [
                            'data' => $this->setNotification('error', lang::$lang['n_no_db_connected'])
                        ]);
                    } else{ return $this->redirect(['/site/index']); }
                }
            } else{
                if ( $this->isAuth() ) {
                    return $this->renderAjax('notification', [
                        'data' => $this->setNotification('error', lang::$lang['n_no_post'])
                    ]);
                } else{ return $this->redirect(['/site/index']); }
            }
        }
    }

    public function actionUpdateAddress()
    {
        if( $this->isAjax() ){
            if( $this->isPost() ){
                $value = Yii::$app->request->post('__val');
                $model = UserData::find()->where(['user_id' => $this->idUser()])->one();
                $model->address = $value;
                if ( $model->save() ){
                    if ( $this->isAuth() ) {
                        return $this->renderAjax('notification', [
                            'data' => $this->setNotification('success', lang::$profile['n_yes_update_address'])
                        ]);
                    } else{ return $this->redirect(['/site/index']); }
                } else{
                    if ( $this->isAuth() ) {
                        return $this->renderAjax('notification', [
                            'data' => $this->setNotification('error', lang::$lang['n_no_db_connected'])
                        ]);
                    } else{ return $this->redirect(['/site/index']); }
                }
            } else{
                return $this->renderAjax('notification', [
                    'data' => $this->setNotification('error', lang::$lang['n_no_post'])
                ]);
            }
        }
    }

    public function actionUpdateEmail()
    {
        if( $this->isAjax() ){
            if( $this->isPost() ){
                $value = Yii::$app->request->post('__val');
                $model = User::find()->where(['id' => $this->idUser()])->one();
                $model->email = $value;
                if ( $model->save() ){
                    if ( $this->isAuth() ) {
                        return $this->renderAjax('notification', [
                            'data' => $this->setNotification('success', lang::$profile['n_yes_update_email'])
                        ]);
                    } else{ return $this->redirect(['/site/index']); }
                } else{
                    if ( $this->isAuth() ) {
                        return $this->renderAjax('notification', [
                            'data' => $this->setNotification('error', lang::$lang['n_no_db_connected'])
                        ]);
                    } else{ return $this->redirect(['/site/index']); }
                }
            } else{
                return $this->renderAjax('notification', [
                    'data' => $this->setNotification('error', lang::$lang['n_no_post'])
                ]);
            }
        }
    }

    public function actionUpdateBirthdayDay()
    {
        if( $this->isAjax() ){
            if( $this->isPost() ){
                $value = Yii::$app->request->post('__val');
                $model = UserData::find()->where(['user_id' => $this->idUser()])->one();
                $model->birthday_day = $value;
                if ( $model->save() ){
                    if ( $this->isAuth() ) {
                        return $this->renderAjax('notification', [
                            'data' => $this->setNotification('success', lang::$profile['n_yes_update_birthday_day'])
                        ]);
                    } else{ return $this->redirect(['/site/index']); }
                } else{
                    if ( $this->isAuth() ) {
                        return $this->renderAjax('notification', [
                            'data' => $this->setNotification('error', lang::$lang['n_no_db_connected'])
                        ]);
                    } else{ return $this->redirect(['/site/index']); }
                }
            } else{
                return $this->renderAjax('notification', [
                    'data' => $this->setNotification('error', lang::$lang['n_no_post'])
                ]);
            }
        }
    }

    public function actionUpdateBirthdayMonth()
    {
        if( $this->isAjax() ){
            if( $this->isPost() ){
                $value = Yii::$app->request->post('__val');
                $model = UserData::find()->where(['user_id' => $this->idUser()])->one();
                $model->birthday_month = $value;
                if ( $model->save() ){
                    if ( $this->isAuth() ) {
                        return $this->renderAjax('notification', [
                            'data' => $this->setNotification('success', lang::$profile['n_yes_update_birthday_month'])
                        ]);
                    } else{ return $this->redirect(['/site/index']); }
                } else{
                    if ( $this->isAuth() ) {
                        return $this->renderAjax('notification', [
                            'data' => $this->setNotification('error', lang::$lang['n_no_db_connected'])
                        ]);
                    } else{ return $this->redirect(['/site/index']); }
                }
            } else{
                return $this->renderAjax('notification', [
                    'data' => $this->setNotification('error', lang::$lang['n_no_post'])
                ]);
            }
        }
    }

    public function actionUpdateBirthdayYear()
    {
        if( $this->isAjax() ){
            if( $this->isPost() ){
                $value = Yii::$app->request->post('__val');
                $model = UserData::find()->where(['user_id' => $this->idUser()])->one();
                $model->birthday_year = $value;
                if ( $model->save() ){
                    if ( $this->isAuth() ) {
                        return $this->renderAjax('notification', [
                            'data' => $this->setNotification('success', lang::$profile['n_yes_update_birthday_year'])
                        ]);
                    } else{ return $this->redirect(['/site/index']); }
                } else{
                    if ( $this->isAuth() ) {
                        return $this->renderAjax('notification', [
                            'data' => $this->setNotification('error', lang::$lang['n_no_db_connected'])
                        ]);
                    } else{ return $this->redirect(['/site/index']); }
                }
            } else{
                return $this->renderAjax('notification', [
                    'data' => $this->setNotification('error', lang::$lang['n_no_post'])
                ]);
            }
        }
    }

    public function actionUpdateBirthdayView()
    {
        if( $this->isAjax() ){
            if( $this->isPost() ){
                $value = Yii::$app->request->post('__val');
                $model = UserData::find()->where(['user_id' => $this->idUser()])->one();
                $model->birthday_view = $value;
                if ( $model->save() ){
                    if ( $this->isAuth() ) {
                        if ( $value == 1 ){
                            return $this->renderAjax('notification', [
                                'data' => $this->setNotification('success', lang::$profile['n_yes_update_birthday_view'])
                            ]);
                        } else{
                            return $this->renderAjax('notification', [
                                'data' => $this->setNotification('success', lang::$profile['n_yes_update_birthday_no_view'])
                            ]);
                        }
                    } else{ return $this->redirect(['/site/index']); }
                } else{
                    if ( $this->isAuth() ) {
                        return $this->renderAjax('notification', [
                            'data' => $this->setNotification('error', lang::$lang['n_no_db_connected'])
                        ]);
                    } else{ return $this->redirect(['/site/index']); }
                }
            } else{
                return $this->renderAjax('notification', [
                    'data' => $this->setNotification('error', lang::$lang['n_no_post'])
                ]);
            }
        }
    }

    public function actionUpdateDepartment()
    {
        if( $this->isAjax() ){
            if( $this->isPost() ){
                $value = Yii::$app->request->post('__val');

                $dep = DepartmentContent::find()->where(['id' => $value])->one();
                $dep_type = $dep['data_key'];
                $model = DepartmentWorker::find()->where(['user_id' => $this->idUser()])->one();
                if( $dep_type == 'top' ){
                    $model->data_key = 'top';
                    $model->department_id  = $dep['department_id'];
                    $model->middle_id  = NULL;
                    $model->bottom_id  = NULL;
                } elseif ( $dep_type == 'middle' ){
                    $model->data_key = 'middle';
                    $model->department_id  = NULL;
                    $model->middle_id  = $dep['middle_id'];
                    $model->bottom_id  = NULL;
                } else{
                    $model->data_key = 'bottom';
                    $model->department_id  = NULL;
                    $model->middle_id  = NULL;
                    $model->bottom_id  = $dep['bottom_id'];
                }

                if ( $model->save() ){
                    if ( $this->isAuth() ) {
                        return $this->renderAjax('notification', [
                            'data' => $this->setNotification('success', lang::$profile['n_yes_update_department'])
                        ]);
                    } else{ return $this->redirect(['/site/index']); }
                } else{
                    if ( $this->isAuth() ) {
                        return $this->renderAjax('notification', [
                            'data' => $this->setNotification('error', lang::$lang['n_no_db_connected'])
                        ]);
                    } else{ return $this->redirect(['/site/index']); }
                }
            } else{
                return $this->renderAjax('notification', [
                    'data' => $this->setNotification('error', lang::$lang['n_no_post'])
                ]);
            }
        }
    }

    public function actionUpdateFullname()
    {
        if( $this->isAjax() ){
            if( $this->isPost() ){
                $value = Yii::$app->request->post('__val');
                $fullname = explode(' ', $value);
                $model = UserData::find()->where(['user_id' => $this->idUser()])->one();
                $model->surname = $fullname[0];
                $model->firstname = $fullname[1];
                $model->report = $fullname[2];
                $model->fullname = $value;
                if ( $model->save() ){
                    if ( $this->isAuth() ) {
                        return $this->renderAjax('notification', [
                            'data' => $this->setNotification('success', lang::$profile['n_yes_update_fullname'])
                        ]);
                    } else{ return $this->redirect(['/site/index']); }
                } else{
                    if ( $this->isAuth() ) {
                        return $this->renderAjax('notification', [
                            'data' => $this->setNotification('error', lang::$lang['n_no_db_connected'])
                        ]);
                    } else{ return $this->redirect(['/site/index']); }
                }
            } else{
                return $this->renderAjax('notification', [
                    'data' => $this->setNotification('error', lang::$lang['n_no_post'])
                ]);
            }
        }
    }

    public function actionAddTelephones()
    {
        if( $this->isAjax() ){
            if( $this->isPost() ){
                $value = Yii::$app->request->post('__val');

                if ( count($this->getTelephone()) == 3 ){
                    return $this->renderAjax('notification', [
                        'data' => $this->setNotification('error', lang::$lang['n_no_telephone_count'])
                    ]);
                }

                $model = new UserTelephone();
                $model->user_id = $this->idUser();
                $model->telephone = $value;
                $model->status = 1;
                $model->status_delete = 0;
                if ( $model->save() ){
                    if ( $this->isAuth() ) {
                        return $this->renderAjax('notification', [
                            'data' => $this->setNotification('success', lang::$profile['n_yes_add_telephone'])
                        ]);
                    } else{ return $this->redirect(['/site/index']); }
                } else{
                    if ( $this->isAuth() ) {
                        return $this->renderAjax('notification', [
                            'data' => $this->setNotification('error', lang::$lang['n_no_db_connected'])
                        ]);
                    } else{ return $this->redirect(['/site/index']); }
                }
            } else{
                return $this->renderAjax('notification', [
                    'data' => $this->setNotification('error', lang::$lang['n_no_post'])
                ]);
            }
        }
    }

    public function actionDeleteTelephone()
    {
        if( $this->isAjax() ){
            if( $this->isPost() ){
                $id = Yii::$app->request->post('__id');

                $telephones_user = $this->getTelephone();
                $model = UserTelephone::find()->where(['id' => $id])->one();
                if( count( $telephones_user ) == 1 ){
                    $modelSave = new UserTelephone();
                    $modelSave->user_id = $this->idUser();
                    $modelSave->status = 1;
                    $modelSave->status_delete = 0;
                    $modelSave->save();
                }
                $model->status_delete = 1;
                if ( $model->save() ){
                    if ( $this->isAuth() ) {
                        return $this->renderAjax('notification', [
                            'data' => $this->setNotification('success', lang::$profile['n_yes_delete_telephone'])
                        ]);
                    } else{ return $this->redirect(['/site/index']); }
                } else{
                    if ( $this->isAuth() ) {
                        return $this->renderAjax('notification', [
                            'data' => $this->setNotification('error', lang::$lang['n_no_db_connected'])
                        ]);
                    } else{ return $this->redirect(['/site/index']); }
                }
            } else{
                return $this->renderAjax('notification', [
                    'data' => $this->setNotification('error', lang::$lang['n_no_post'])
                ]);
            }
        }
    }

    public function actionUpdateTelephone()
    {
        if( $this->isAjax() ){
            if( $this->isPost() ){
                $id = Yii::$app->request->post('__id');
                $value = Yii::$app->request->post('__val');

                $model = UserTelephone::find()->where(['id' => $id])->one();
                $model->telephone = $value;
                if ( $model->save() ){
                    if ( $this->isAuth() ) {
                        return $this->renderAjax('notification', [
                            'data' => $this->setNotification('success', lang::$profile['n_yes_update_telephone'])
                        ]);
                    } else{ return $this->redirect(['/site/index']); }
                } else{
                    if ( $this->isAuth() ) {
                        return $this->renderAjax('notification', [
                            'data' => $this->setNotification('error', lang::$lang['n_no_db_connected'])
                        ]);
                    } else{ return $this->redirect(['/site/index']); }
                }
            } else{
                return $this->renderAjax('notification', [
                    'data' => $this->setNotification('error', lang::$lang['n_no_post'])
                ]);
            }
        }
    }

    public function actionUpdateInWork()
    {
        if( $this->isAjax() ){
            if( $this->isPost() ){
                $value = Yii::$app->request->post('__val');
                $model = UserData::find()->where(['user_id' => $this->idUser()])->one();
                $model->in_work = $value;
                if ( $model->save() ){
                    if ( $this->isAuth() ) {
                        if ( $value == 0 ){
                            return $this->renderAjax('notification', [
                                'data' => $this->setNotification('error', lang::$profile['n_yes_update_not_in_work'])
                            ]);
                        } else{
                            return $this->renderAjax('notification', [
                                'data' => $this->setNotification('success', lang::$profile['n_yes_update_in_work'])
                            ]);
                        }
                    } else{ return $this->redirect(['/site/index']); }
                } else{
                    if ( $this->isAuth() ) {
                        return $this->renderAjax('notification', [
                            'data' => $this->setNotification('error', lang::$lang['n_no_db_connected'])
                        ]);
                    } else{ return $this->redirect(['/site/index']); }
                }
            } else{
                return $this->renderAjax('notification', [
                    'data' => $this->setNotification('error', lang::$lang['n_no_post'])
                ]);
            }
        }
    }

    public function actionUploadImage()
    {
        if ( 0 < $_FILES['imageFile']['error'] ) {
            return 'Error: ' . $_FILES['imageFile']['error'] . '<br>';
        }
        else {
            $ext = pathinfo($_FILES['imageFile']['name'], PATHINFO_EXTENSION);
            $currentName = $_FILES['imageFile']['name'];
            $securityName = Yii::$app->security->generateRandomString(30) . '.' . $ext;
            move_uploaded_file($_FILES['imageFile']['tmp_name'], $_SERVER['DOCUMENT_ROOT'] . '/frontend/web/uploads/' . $securityName);

            $modelFile = new File();
            $modelFile->user_id = $this->idUser();
            $modelFile->status = 1;
            $modelFile->status_delete = 0;
            if ( $modelFile->save() ) {
                $modelFileContent = new FileContent();
                $modelFileContent->file_id = $modelFile->id;
                $modelFileContent->name = $currentName;
                $modelFileContent->alias = $securityName;
                $modelFileContent->src = 'uploads/' . $securityName;
                if ( $modelFileContent->save() ){
                    if ( $this->isAuth() ) {
                        return $modelFileContent->src;
                    } else{ return $this->redirect(['/site/index']); }
                } else{
                    if ( $this->isAuth() ) {
                        return $this->renderAjax('notification', [
                            'data' => $this->setNotification('error', lang::$lang['n_no_file_load_meta'])
                        ]);
                    } else{ return $this->redirect(['/site/index']); }
                }
            } else{
                if ( $this->isAuth() ) {
                    return $this->renderAjax('notification', [
                        'data' => $this->setNotification('error', lang::$lang['n_no_file_load'])
                    ]);
                } else{ return $this->redirect(['/site/index']); }
            }
        }

    }

    public function actionUpdateAvatar()
    {
        if( $this->isAjax() ){
            if( $this->isPost() ){
                $data = Yii::$app->request->post('data_image');
                $src = strval( $_SERVER['DOCUMENT_ROOT'] . '/frontend/web/' .$data['src'] );

                $info = pathinfo($src);
                $info_name = $info['filename'];
                $info_ext = $info['extension'];

                $key = Yii::$app->security->generateRandomString(5);
                $src_to_save = strval( $_SERVER['DOCUMENT_ROOT'] . '/frontend/web/uploads/' . $key . $info_name . '.' . $info_ext );

                list($w) = getimagesize($src);

                $width = $w * $data['scale'];
                Image::resize($src, $width, null)->save($src, ['quality' => 80]);
                Image::crop($src,400, 400, [ $data['x'], $data['y'] ])->save($src_to_save, ['quality' => 80]);

                unlink($src);

                $model = UserAvatar::find()->where(['user_id' => $this->idUser()])->one();
                $model->src = 'uploads/' . $key . $info_name . '.' . $info_ext;
                $model->save();
            }
        }
    }

    public function actionUpdatePassword()
    {
        if( $this->isAjax() ){
            if( $this->isPost() ){
                $value = Yii::$app->request->post('__val');
                $model = User::find()->where(['id' => $this->idUser()])->one();
                $model->password_hash = Yii::$app->security->generatePasswordHash($value);
                if ( $model->save() ){
                    if ( $this->isAuth() ) {
                        return $this->renderAjax('notification', [
                            'data' => $this->setNotification('success', lang::$profile['n_yes_update_password'])
                        ]);
                    } else{ return $this->redirect(['/site/index']); }
                } else{
                    if ( $this->isAuth() ) {
                        return $this->renderAjax('notification', [
                            'data' => $this->setNotification('error', lang::$lang['n_no_db_connected'])
                        ]);
                    } else{ return $this->redirect(['/site/index']); }
                }
            } else{
                return $this->renderAjax('notification', [
                    'data' => $this->setNotification('error', lang::$lang['n_no_post'])
                ]);
            }
        }
    }

}
