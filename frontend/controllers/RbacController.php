<?php

namespace frontend\controllers;

use common\models\User;
use frontend\models\AuthAssigment;
use frontend\models\AuthItem;
use frontend\models\AuthItemChild;
use frontend\models\DepartmentContent;
use frontend\models\DepartmentStaff;
use frontend\models\DepartmentWorker;
use frontend\models\UserAvatar;
use frontend\models\UserData;
use frontend\models\UserMentor;
use frontend\models\UserTelephone;
use frontend\tools\tools;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

/**
 * Rbac controller
 */
class RbacController extends Controller
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

    public function getManual($model){
        $data = [];
        foreach ( $model as $item ){
            $modelUD = UserData::find()->where(['user_id' => $item['id']])->one();
            $modelUA = UserAvatar::find()->where(['user_id' => $item['id']])->one();
            $modelDW = DepartmentWorker::find()->where(['user_id' => $item['id']])->one();
            $department_key = isset($modelDepartmentWorker['data_key']) ? $modelDepartmentWorker['data_key'] : 0;
            if ( $department_key != 0 ){
                if ( $modelDW['department_id'] != NULL ){
                    $modelDC = DepartmentContent::find()->where(['department_id' => $modelDW['department_id']])->one();
                } elseif ( $modelDW['middle_id'] != NULL ){
                    $modelDC = DepartmentContent::find()->where(['middle_id' => $modelDW['middle_id']])->one();
                } else{
                    $modelDC = DepartmentContent::find()->where(['bottom_id' => $modelDW['bottom_id']])->one();
                }
            } else{
                $modelDW = ' ';
            }
            $birthday_m = $modelUD['birthday_month'];
            switch ($birthday_m){
                case 1:
                    $birthday_m = 'января';
                    break;
                case 2:
                    $birthday_m = 'февраля';
                    break;
                case 3:
                    $birthday_m = 'марта';
                    break;
                case 4:
                    $birthday_m = 'апреля';
                    break;
                case 5:
                    $birthday_m = 'мая';
                    break;
                case 6:
                    $birthday_m = 'июня';
                    break;
                case 7:
                    $birthday_m = 'июля';
                    break;
                case 8:
                    $birthday_m = 'августа';
                    break;
                case 9:
                    $birthday_m = 'сентября';
                    break;
                case 10:
                    $birthday_m = 'октября';
                    break;
                case 11:
                    $birthday_m = 'ноября';
                    break;
                case 12:
                    $birthday_m = 'декабря';
                    break;
            }
            $data[] = [
                'id'            => $item['id'],
                'fullname'      => $modelUD['fullname'],
                'job'           => $modelUD['job'],
                'department'    => $department_key != 0 ? $modelDC['abbreviation'] : ' ',
                'email'         => $item['email'],
                'telephone'     => UserTelephone::find()->where(['user_id' => $item['id']])->one()['telephone'],
                'avatar'        => $modelUA['src'],
                'in_work'       => $modelUD['in_work'],
                'birthday'      => $modelUD['birthday_day'] . ' ' . $birthday_m
            ];
        }
        return $data;
    }

    /** Displays homepage. @return mixed */
    public function actionIndex()
    {
        if ( tools::isAuth() && tools::idUser() == 1 ){
            $modelU = User::find()->where(['!=', 'id', '1'])->andWhere(['status' => '10'])->all();
            $modelAA = AuthItem::find()->where(['type' => 1])->andWhere(['!=', 'name', 'admin'])->all();
            return $this->render('index', [
                'data' => $this->getManual( $modelU ),
                'roles' => $modelAA
            ]);
        } else{ return $this->redirect(['/site/index']); }
    }

    /** Displays adding form from role. @return mixed */
    public function actionAddFormRoles()
    {
        if ( tools::isAuth() && tools::idUser() == 1 ){
            $modelAI = AuthItem::find()->where(['type' => 2])->all();
            return $this->render('add-roles', [
                'modelAI' => $modelAI
            ]);
        } else{ return $this->redirect(['/site/index']); }
    }

    /** Adding new roles. @return mixed */
    public function actionAddRoles()
    {
        if ( tools::isAuth() && tools::idUser() == 1 && tools::isAjax() && tools::isPost() ){
            $modelAI = new AuthItem();
            $modelAI->name = tools::getPost('name');
            $modelAI->type = 1;
            $modelAI->description = tools::getPost('description');
            $modelAI->rule_name = NULL;
            $modelAI->data = NULL;
            $modelAI->created_at = 1661249735;
            $modelAI->updated_at = 1661249735;
            if ( $modelAI->save() ){
                foreach ( tools::getPost('set_ai') as $item ){
                    $modelAIC = new AuthItemChild();
                    $modelAIC->parent = $modelAI->name;
                    $modelAIC->child = $item;
                    $modelAIC->save();
                }
            }
        } else{ return $this->redirect(['/site/index']); }
    }

    /** Deleting roles. @return mixed */
    public function actionDeleteRoles()
    {
        if ( tools::isAuth() && tools::idUser() == 1 && tools::isAjax() && tools::isPost() ){
            $modelAIC = AuthItemChild::find()->where(['parent' => tools::getPost('name')])->all();
            foreach ( $modelAIC as $item ){
                $item->delete();
            }
            $modelAI = AuthItem::find()->where(['name' => tools::getPost('name')])->one();
            $modelAI->delete();
        } else{ return $this->redirect(['/site/index']); }
    }

    /** Displays updating form from role. @return mixed */
    public function actionUpdateFormRoles()
    {
        if ( tools::isAuth() && tools::idUser() == 1 ){
            $modelAI = AuthItem::find()->where(['type' => 2])->all();
            $data = [];
            $data_set = [];
            foreach ( $modelAI as $item ){
                if ( AuthItemChild::find()->where(['parent' => $_GET['role']])->andWhere(['child' => $item['name']])->one() ){
                    $data_set[] = $item;
                } else{
                    $data[] = $item;
                }
            }
            $modelAI = AuthItem::find()->where(['name' => $_GET['role']])->one();
            return $this->render('update-roles', [
                'modelAI' => $modelAI,
                'data' => $data,
                'data_set' => $data_set
            ]);
        } else{ return $this->redirect(['/site/index']); }
    }

    /** Updating roles. @return mixed */
    public function actionUpdateRoles()
    {
        if ( tools::isAuth() && tools::idUser() == 1 && tools::isAjax() && tools::isPost() ){
            $modelAI = AuthItem::find()->where(['name' => tools::getPost('role')])->one();
            $modelAI->name = tools::getPost('name');
            $modelAI->description = tools::getPost('description');
            if ( $modelAI->save() ){
                $old_scheme = AuthItemChild::find()->where(['parent' => tools::getPost('role')])->all();
                if ( $old_scheme ){
                    foreach ( $old_scheme as $item ){
                        $item->delete();
                    }
                }
                foreach ( tools::getPost('set_ai') as $item ){
                    $modelAIC = new AuthItemChild();
                    $modelAIC->parent = $modelAI->name;
                    $modelAIC->child = $item;
                    $modelAIC->save();
                }
            }
        } else{ return $this->redirect(['/site/index']); }
    }

    /** Displays updating role form from user. @return mixed */
    public function actionRoleUser()
    {
        if ( tools::isAuth() && tools::idUser() == 1 ){
            return $this->render('role-user', [
                'user' => UserData::find()->where(['user_id' => $_GET['u']])->one(),
                'role' => AuthAssigment::find()->where(['user_id' => $_GET['u']])->one()
            ]);
        } else{ return $this->redirect(['/site/index']); }
    }

    /** Updating role for user. @return mixed */
    public function actionUpdateRoleUser()
    {
        if ( tools::isAuth() && tools::idUser() == 1 ){
            $modelAA = AuthAssigment::find()->where(['user_id' => tools::getPost('user_id')])->one();
            $modelAA->item_name = tools::getPost('new_role');
            $modelAA->save();
        } else{ return $this->redirect(['/site/index']); }
    }

    /** Uploading users to RBAC in ADLDAP @return mixed */
    public function actionLdapToRbac()
    {
        if ( tools::isAuth() && tools::idUser() == 1 ){
            return $this->render('ldap-to-rbac');
        } else{ return $this->redirect(['/site/index']); }
    }

    /** ADLDAP @return mixed */
    public function actionConnectionLdap()
    {
        if ( tools::isAuth() && tools::idUser() == 1 && tools::isAjax() ){
            $users_emails = [];
            //LDAP Bind paramters, need to be a normal AD User account.
            $ldap_password = 'AD_Password';
            $ldap_username = 'AD_Username@domain.tld';
            $ldap_connection = ldap_connect("domain.tld");
            if (FALSE === $ldap_connection) {
                return 'Unable to connect to the ldap server';
            }
            // We have to set this option for the version of Active Directory we are using.
            ldap_set_option($ldap_connection, LDAP_OPT_PROTOCOL_VERSION, 3) or die('Unable to set LDAP protocol version');
            ldap_set_option($ldap_connection, LDAP_OPT_REFERRALS, 0); // We need this for doing an LDAP search.

            if (TRUE === ldap_bind($ldap_connection, $ldap_username, $ldap_password)) {
                //Your domains DN to query
                $ldap_base_dn = 'DC=domain,DC=tld,DC=tld';
                //Get standard users and contacts
                $search_filter = '(|(objectCategory=person)(objectCategory=contact))';
                //Connect to LDAP
                $result = ldap_search($ldap_connection, $ldap_base_dn, $search_filter);

                if (FALSE !== $result) {
                    $entries = ldap_get_entries($ldap_connection, $result);

                    // Uncomment the below if you want to write all entries to debug somethingthing
                    //var_dump($entries);

                    //For each account returned by the search
                    for ($x = 0; $x < $entries['count']; $x++) {

                        //
                        //Retrieve values from Active Directory
                        //

                        //Windows Usernaame
                        $LDAP_samaccountname = "";

                        if (!empty($entries[$x]['samaccountname'][0])) {
                            $LDAP_samaccountname = $entries[$x]['samaccountname'][0];
                            if ($LDAP_samaccountname == "NULL") {
                                $LDAP_samaccountname = "";
                            }
                        } else {
                            //#There is no samaccountname s0 assume this is an AD contact record so generate a unique username

                            $LDAP_uSNCreated = $entries[$x]['usncreated'][0];
                            $LDAP_samaccountname = "CONTACT_" . $LDAP_uSNCreated;
                        }

                        //Last Name
                        $LDAP_LastName = "";

                        if (!empty($entries[$x]['sn'][0])) {
                            $LDAP_LastName = $entries[$x]['sn'][0];
                            if ($LDAP_LastName == "NULL") {
                                $LDAP_LastName = "";
                            }
                        }

                        //First Name
                        $LDAP_FirstName = "";

                        if (!empty($entries[$x]['givenname'][0])) {
                            $LDAP_FirstName = $entries[$x]['givenname'][0];
                            if ($LDAP_FirstName == "NULL") {
                                $LDAP_FirstName = "";
                            }
                        }

                        //Department
                        $LDAP_Department = "";

                        if (!empty($entries[$x]['department'][0])) {
                            $LDAP_Department = $entries[$x]['department'][0];
                            if ($LDAP_Department == "NULL") {
                                $LDAP_Department = "";
                            }
                        }

                        //Job Title
                        $LDAP_JobTitle = "";

                        if (!empty($entries[$x]['title'][0])) {
                            $LDAP_JobTitle = $entries[$x]['title'][0];
                            if ($LDAP_JobTitle == "NULL") {
                                $LDAP_JobTitle = "";
                            }
                        }

                        //Mobile Number
                        $LDAP_CellPhone = "";

                        if (!empty($entries[$x]['mobile'][0])) {
                            $LDAP_CellPhone = $entries[$x]['mobile'][0];
                            if ($LDAP_CellPhone == "NULL") {
                                $LDAP_CellPhone = "";
                            }
                        }

                        //Email address
                        $LDAP_InternetAddress = "";

                        if (!empty($entries[$x]['mail'][0])) {
                            $LDAP_InternetAddress = $entries[$x]['mail'][0];
                            if ($LDAP_InternetAddress == "NULL") {
                                $LDAP_InternetAddress = "";
                            }
                        }
                        $users_emails[] = $LDAP_InternetAddress;

                        //Date start work
                        $LDAP_StartWork = "";

                        if (!empty($entries[$x]['extensionattribute1'][0])) {
                            $LDAP_StartWork = $entries[$x]['extensionattribute1'][0];
                            if ($LDAP_StartWork == "NULL") {
                                $LDAP_StartWork = "";
                            }
                        }

                        //Birthday
                        $LDAP_Birthday = "";

                        if (!empty($entries[$x]['extensionattribute2'][0])) {
                            $LDAP_Birthday = $entries[$x]['extensionattribute2'][0];
                            if ($LDAP_Birthday == "NULL") {
                                $LDAP_Birthday = "";
                            }
                        }

                        //Location Work
                        $LDAP_LocationWork = "";

                        if (!empty($entries[$x]['streetaddress'][0])) {
                            $LDAP_LocationWork = $entries[$x]['streetaddress'][0];
                            if ($LDAP_LocationWork == "NULL") {
                                $LDAP_LocationWork = "";
                            }
                        }

                        if ( strlen($LDAP_InternetAddress) > 0 && $LDAP_samaccountname == 'test' ){

                            if ( !User::find()->where(['email' => $LDAP_InternetAddress])->one() ){

                                $user = new User();
                                $user->username = $LDAP_InternetAddress;
                                $user->email = $LDAP_InternetAddress;

                                $password = \Yii::$app->getSecurity()->generateRandomString(8);

                                $user->setPassword($password);
                                $user->generateAuthKey();
                                $user->generateEmailVerificationToken();
                                $user->save();

                                $auth = \Yii::$app->authManager;
                                $userRole = $auth->getRole('default');
                                $auth->assign($userRole, $user->getId());

                                $user = User::find()->where(['id' => $user->id])->one();
                                $user->status = 10;
                                $user->save();

                                $modelUserAvatar = new UserAvatar();
                                $modelUserAvatar->user_id = $user->id;
                                $modelUserAvatar->src = 'image/elements/user.png';
                                $modelUserAvatar->status = 1;
                                $modelUserAvatar->status_delete = 0;
                                $modelUserAvatar->save();

                                $modelUserData = new UserData();
                                $modelUserData->user_id = $user->id;
                                $modelUserData->surname = strlen($LDAP_LastName) > 0 ? $LDAP_LastName : ' ';

                                $surname = strlen($LDAP_LastName) > 0 ? $LDAP_LastName : ' ';
                                $firstname = strlen($LDAP_FirstName) > 0 ? $LDAP_FirstName : ' ';
                                $report = ' ';

                                $modelUserData->firstname = $firstname;
                                $modelUserData->report = $report;
                                $modelUserData->fullname = $surname . ' ' . $firstname . ' ' .$report;
                                $modelUserData->job = strlen($LDAP_JobTitle) > 0 ? $LDAP_JobTitle : ' ';

                                $birthday = strlen($LDAP_Birthday) > 0 ? explode('.', $LDAP_Birthday) : NULL;

                                $modelUserData->birthday_day = $birthday != NULL ? $birthday[0] : NULL;
                                $modelUserData->birthday_month = $birthday != NULL ? $birthday[1] : NULL;
                                $modelUserData->birthday_year = $birthday != NULL ? $birthday[2] : NULL;
                                $modelUserData->birthday_view = 0;
                                $modelUserData->recruitment = \Yii::$app->formatter->asDate($LDAP_StartWork, 'Y-m-d H:i:s');
                                $modelUserData->address = strlen($LDAP_LocationWork) > 0 ? $LDAP_LocationWork : ' ';
                                $modelUserData->in_work = 1;
                                $modelUserData->status = 1;
                                $modelUserData->status_delete = 0;
                                $modelUserData->save();

                                $modelUserTelephone = new UserTelephone();
                                $modelUserTelephone->user_id = $user->id;
                                $modelUserTelephone->telephone = strlen($LDAP_CellPhone) > 0 ? $LDAP_CellPhone : NULL;
                                $modelUserTelephone->status = 1;
                                $modelUserTelephone->status_delete = 0;
                                $modelUserTelephone->save();

                                $notIsMentor = true;
                                $modelDepContent = DepartmentContent::find()->where(['title' => $LDAP_Department])->one();
                                if ( $modelDepContent ){
                                    if ( $modelDepContent['department_id'] != NULL ){
                                        $modelDepWorker = new DepartmentWorker();
                                        $modelDepWorker->data_key = 'top';
                                        $modelDepWorker->department_id = $modelDepContent['department_id'];
                                        $modelDepWorker->user_id = $user->id;
                                        $modelDepWorker->save();

                                        $modelDepartmentStaff = DepartmentStaff::find()->where(['department_id' => $modelDepContent['department_id']])->andWhere(['department_key' => 'top'])->one();
                                        if ( $modelDepartmentStaff ){
                                            $modelUserMentor = new UserMentor();
                                            $modelUserMentor->user_id = $user->id;
                                            $modelUserMentor->user_id_mentor = $modelDepartmentStaff['user_id'];
                                            $modelUserMentor->save();
                                            $notIsMentor = false;
                                        }
                                    } elseif ( $modelDepContent['middle_id'] != NULL ){
                                        $modelDepWorker = new DepartmentWorker();
                                        $modelDepWorker->data_key = 'middle';
                                        $modelDepWorker->middle_id = $modelDepContent['middle_id'];
                                        $modelDepWorker->user_id = $user->id;
                                        $modelDepWorker->save();

                                        $modelDepartmentStaff = DepartmentStaff::find()->where(['department_id' => $modelDepContent['middle_id']])->andWhere(['department_key' => 'middle'])->one();
                                        if ( $modelDepartmentStaff ){
                                            $modelUserMentor = new UserMentor();
                                            $modelUserMentor->user_id = $user->id;
                                            $modelUserMentor->user_id_mentor = $modelDepartmentStaff['user_id'];
                                            $modelUserMentor->save();
                                            $notIsMentor = false;
                                        }
                                    } else{
                                        $modelDepWorker = new DepartmentWorker();
                                        $modelDepWorker->data_key = 'bottom';
                                        $modelDepWorker->bottom_id = $modelDepContent['bottom_id'];
                                        $modelDepWorker->user_id = $user->id;
                                        $modelDepWorker->save();

                                        $modelDepartmentStaff = DepartmentStaff::find()->where(['department_id' => $modelDepContent['bottom_id']])->andWhere(['department_key' => 'bottom'])->one();
                                        if ( $modelDepartmentStaff ){
                                            $modelUserMentor = new UserMentor();
                                            $modelUserMentor->user_id = $user->id;
                                            $modelUserMentor->user_id_mentor = $modelDepartmentStaff['user_id'];
                                            $modelUserMentor->save();
                                            $notIsMentor = false;
                                        }
                                    }
                                }

                                if ( $notIsMentor ){
                                    $modelUserMentor = new UserMentor();
                                    $modelUserMentor->user_id = $user->id;
                                    $modelUserMentor->user_id_mentor = 1;
                                    $modelUserMentor->save();
                                }

                                \Yii::$app
                                    ->mailer
                                    ->compose(
                                        ['html' => 'newUser-html', 'text' => 'newUser-text'],
                                        [
                                            'fullname' => $modelUserData->fullname,
                                            'email' => $LDAP_InternetAddress,
                                            'password' => $password
                                        ]
                                    )
                                    ->setFrom([\Yii::$app->params['portalEmail'] => \Yii::$app->name . ' NNGP'])
                                    ->setTo($LDAP_InternetAddress)
                                    ->setSubject('Доступ к порталу ННГП' . \Yii::$app->name)
                                    ->send();

                            } else{
                                $user = User::find()->where(['email' => $LDAP_InternetAddress])->one();
                                $user->status = 10;
                                $user->save();
                                $user = User::find()->where(['email' => $LDAP_InternetAddress])->one();

                                $modelUserData = UserData::find()->where(['user_id' => $user['id']])->one();
                                $modelUserData->surname = strlen($LDAP_LastName) > 0 ? $LDAP_LastName : ' ';

                                $surname = strlen($LDAP_LastName) > 0 ? $LDAP_LastName : ' ';
                                $firstname = strlen($LDAP_FirstName) > 0 ? $LDAP_FirstName : ' ';
                                $report = ' ';

                                $modelUserData->firstname = $firstname;
                                $modelUserData->report = $report;
                                $modelUserData->fullname = $surname . ' ' . $firstname . ' ' .$report;
                                $modelUserData->job = strlen($LDAP_JobTitle) > 0 ? $LDAP_JobTitle : ' ';

                                $birthday = strlen($LDAP_Birthday) > 0 ? explode('.', $LDAP_Birthday) : NULL;

                                $modelUserData->birthday_day = $birthday != NULL ? $birthday[0] : NULL;
                                $modelUserData->birthday_month = $birthday != NULL ? $birthday[1] : NULL;
                                $modelUserData->birthday_year = $birthday != NULL ? $birthday[2] : NULL;
                                $modelUserData->recruitment = \Yii::$app->formatter->asDate($LDAP_StartWork, 'Y-m-d H:i:s');
                                $modelUserData->address = strlen($LDAP_LocationWork) > 0 ? $LDAP_LocationWork : ' ';
                                $modelUserData->save();

                                $mentor = UserMentor::find()->where(['user_id' => $user['id']])->one();
                                $mentor->delete();

                                $notIsMentor = true;
                                $modelDepContent = DepartmentContent::find()->where(['title' => $LDAP_Department])->one();
                                $modelDepWorker = DepartmentWorker::find()->where(['user_id' => $user['id']])->one();
                                if ( $modelDepWorker ){
                                    $modelDepWorker->delete();
                                }
                                if ( $modelDepContent ){
                                    if ( $modelDepContent['department_id'] != NULL ){
                                        $modelDepWorker = new DepartmentWorker();
                                        $modelDepWorker->data_key = 'top';
                                        $modelDepWorker->department_id = $modelDepContent['department_id'];
                                        $modelDepWorker->user_id = $user->id;
                                        $modelDepWorker->save();

                                        $modelDepartmentStaff = DepartmentStaff::find()->where(['department_id' => $modelDepContent['department_id']])->andWhere(['department_key' => 'top'])->one();
                                        if ( $modelDepartmentStaff ){
                                            $modelUserMentor = new UserMentor();
                                            $modelUserMentor->user_id = $user->id;
                                            $modelUserMentor->user_id_mentor = $modelDepartmentStaff['user_id'];
                                            $modelUserMentor->save();
                                            $notIsMentor = false;
                                        }
                                    } elseif ( $modelDepContent['middle_id'] != NULL ){
                                        $modelDepWorker = new DepartmentWorker();
                                        $modelDepWorker->data_key = 'middle';
                                        $modelDepWorker->middle_id = $modelDepContent['middle_id'];
                                        $modelDepWorker->user_id = $user->id;
                                        $modelDepWorker->save();

                                        $modelDepartmentStaff = DepartmentStaff::find()->where(['department_id' => $modelDepContent['middle_id']])->andWhere(['department_key' => 'middle'])->one();
                                        if ( $modelDepartmentStaff ){
                                            $modelUserMentor = new UserMentor();
                                            $modelUserMentor->user_id = $user->id;
                                            $modelUserMentor->user_id_mentor = $modelDepartmentStaff['user_id'];
                                            $modelUserMentor->save();
                                            $notIsMentor = false;
                                        }
                                    } else{
                                        $modelDepWorker = new DepartmentWorker();
                                        $modelDepWorker->data_key = 'bottom';
                                        $modelDepWorker->bottom_id = $modelDepContent['bottom_id'];
                                        $modelDepWorker->user_id = $user->id;
                                        $modelDepWorker->save();

                                        $modelDepartmentStaff = DepartmentStaff::find()->where(['department_id' => $modelDepContent['bottom_id']])->andWhere(['department_key' => 'bottom'])->one();
                                        if ( $modelDepartmentStaff ){
                                            $modelUserMentor = new UserMentor();
                                            $modelUserMentor->user_id = $user->id;
                                            $modelUserMentor->user_id_mentor = $modelDepartmentStaff['user_id'];
                                            $modelUserMentor->save();
                                            $notIsMentor = false;
                                        }
                                    }
                                }

                                if ( $notIsMentor ){
                                    $modelUserMentor = new UserMentor();
                                    $modelUserMentor->user_id = $user->id;
                                    $modelUserMentor->user_id_mentor = 1;
                                    $modelUserMentor->save();
                                }

                            }

                        }

                    } //END for loop



                } //END FALSE !== $result

                ldap_unbind($ldap_connection); // Clean up after ourselves.

            } //END ldap_bind

            foreach ( User::find()->all() as $item ){
                $remove = true;
                foreach ( $users_emails as $email ){
                    if ( (string)$email == (string)$item['email'] ){
                        $remove = false;
                    }
                }
                if ( $remove && $item['id'] > 1 ){
                    $model = User::find()->where(['id' => $item['id']])->one();
                    $model->status = 9;
                    $model->save();
                }
            }
        } else{ return $this->redirect(['/site/index']); }
    }

}
