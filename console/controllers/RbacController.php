<?php
namespace console\controllers;

use Yii;
use yii\console\Controller;

class RbacController extends Controller
{
    public function actionInit()
    {
        $auth = Yii::$app->authManager;

        $addNews = $auth->createPermission('addNews');
        $addNews->description = 'Add to news in core NEWS';
        $auth->add($addNews);

        $updateNews = $auth->createPermission('updateNews');
        $updateNews->description = 'Update to news in core NEWS';
        $auth->add($updateNews);

        $deleteNews = $auth->createPermission('deleteNews');
        $deleteNews->description = 'Delete to news in core NEWS';
        $auth->add($deleteNews);

        $deputy_admin  = $auth->createRole('deputy_admin');
        $auth->add($deputy_admin);
        $auth->addChild($deputy_admin, $addNews);
        $auth->addChild($deputy_admin, $updateNews);

        $admin = $auth->createRole('admin');
        $auth->add($admin);
        $auth->addChild($admin, $deleteNews);
        $auth->addChild($admin, $deputy_admin);

        $auth->assign($admin, 1);
    }
}