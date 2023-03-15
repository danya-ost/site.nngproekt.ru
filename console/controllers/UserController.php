<?php
namespace console\controllers;

use common\models\User;
use frontend\models\DepartmentWorker;
use frontend\models\UserAvatar;
use frontend\models\UserData;
use frontend\models\UserMentor;
use Yii;
use yii\console\Controller;

class UserController extends Controller
{

    public function actionInit($dir)
    {
        if (($handle = fopen($dir, 'r')) !== false) {
            $iteration = 0;
            while (($row = fgetcsv($handle, 1000, ";")) !== false) {
                if ($iteration == 1) {

                    $user = new User();
                    $user->username = $row[0];
                    $user->email = $row[1];
                    $user->status = 10;
                    $user->setPassword($row[2]);
                    $user->generateAuthKey();
                    $user->generateEmailVerificationToken();

                    if ( $user->save() ){
                        $auth = Yii::$app->authManager;
                        $userRole = $auth->getRole('deputy_admin');
                        $auth->assign($userRole, $user->id);

                        $userData = new UserData();
                        $userData->user_id = $user->id;
                        $userData->surname = $row[3];
                        $userData->firstname = $row[4];
                        $userData->report = $row[5];
                        $userData->fullname = $row[6];
                        $userData->job = $row[7];
                        $userData->birthday_day = $row[8];
                        $userData->birthday_month = $row[9];
                        $userData->birthday_year = $row[10];
                        $userData->birthday_view = 1;
                        $userData->status = 1;
                        $userData->status_delete = 0;
                        $userData->address = $row[11];
                        $userData->in_work = 1;

                        if ( $userData->save() ){
                            $userMentor = new UserMentor();
                            $userMentor->user_id = $user->id;
                            $userMentor->user_id_mentor = $row[12];

                            if ( $userMentor->save() ){
                                $userAvatar = new UserAvatar();
                                $userAvatar->user_id = $user->id;
                                $userAvatar->src = 'image/elements/user.png';
                                $userAvatar->status = 1;
                                $userAvatar->status_delete = 0;

                                if ( $userAvatar->save() ){
                                    $department = new DepartmentWorker();
                                    $department->data_key = 'bottom';
                                    $department->bottom_id = 1;
                                    $department->user_id = $user->id;
                                    $department->save();
                                }

                            }

                        }

                    }

                }
                $iteration = 1;
            }
            fclose($handle);
        }
    }

}