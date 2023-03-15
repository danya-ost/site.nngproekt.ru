<?php

namespace frontend\controllers;

use frontend\models\Customer;
use frontend\models\Projects;
use frontend\models\ProjectsContent;
use frontend\models\ProjectsGroup;
use frontend\tools\tools;
use frontend\tools\tools as tool;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

/**
 * Site controller
 */
class ProjectsController extends Controller
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

    /*
     * Formatting a customers massive.
     */
    public function getCustomer($model, $one)
    {
        $data = [];
        if ( $one ){
            $data = [
                'id' => $model['id'],
                'name' => $model['name'],
                'address' => $model['address']
            ];
        } else{
            foreach ( $model as $item ){
                $data[] = [
                    'id' => $item['id'],
                    'name' => $item['name'],
                    'address' => $item['address']
                ];
            }
        }
        return $data;
    }

    /*
     * Formatting a projects massive.
     */
    public function getProjects($model, $one)
    {
        $data = [];
        if( $one ){
            $modelProjectsContent = ProjectsContent::find()->where(['project_id' => $model['id']])->one();
            $data = [
                'id' => $model['id'],
                'customer'          => Customer::find()->where(['id' => $modelProjectsContent['customer_id']])->one()['name'],
                'customer_address'          => Customer::find()->where(['id' => $modelProjectsContent['customer_id']])->one()['address'],
                'customer_id'       => Customer::find()->where(['id' => $modelProjectsContent['customer_id']])->one()['id'],
                'group_id'          => ProjectsGroup::find()->where(['id' => $model['group_id']])->one()['id'],
                'group'             => ProjectsGroup::find()->where(['id' => $model['group_id']])->one()['name'],
                'number_customer'   => $modelProjectsContent['number_customer'],
                'number_in'         => $modelProjectsContent['number_in'],
                'date'              => $modelProjectsContent['date'],
                'title'             => $modelProjectsContent['title'],
                'text'              => $modelProjectsContent['text'],
                'status'            => $model['status']
            ];
        } else{
            foreach ( $model as $item ){
                $modelProjectsContent = ProjectsContent::find()->where(['project_id' => $item['id']])->one();
                $data[] = [
                    'id'                => $item['id'],
                    'customer'          => Customer::find()->where(['id' => $modelProjectsContent['customer_id']])->one()['name'],
                    'customer_address'          => Customer::find()->where(['id' => $modelProjectsContent['customer_id']])->one()['address'],
                    'customer_id'       => Customer::find()->where(['id' => $modelProjectsContent['customer_id']])->one()['id'],
                    'group_id'          => ProjectsGroup::find()->where(['id' => $item['group_id']])->one()['id'],
                    'group'             => ProjectsGroup::find()->where(['id' => $item['group_id']])->one()['name'],
                    'number_customer'   => $modelProjectsContent['number_customer'],
                    'number_in'         => $modelProjectsContent['number_in'],
                    'date'              => $modelProjectsContent['date'],
                    'title'             => $modelProjectsContent['title'],
                    'text'              => $modelProjectsContent['text'],
                    'status'            => $item['status']
                ];
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
                'stop_pagination' => Projects::find()->where(['status_delete' => 0])->andWhere(['status' => 1])->one() ? Projects::find()->where(['status_delete' => 0])->andWhere(['status' => 1])->one()['id'] : '0',
                'groups' => ProjectsGroup::find()->all(),
                'permission' => tools::isPermission('projects'),
                'permission_cust' => tools::isPermission('customer'),
            ]);
        } else{ $this->redirect(['/site/index']); }
    }

    /**
     * Displays all projects.
     *
     * @return mixed
     */
    public function actionViewAllProjects()
    {
        if ( tools::isAuth() ){
            if ( tools::isAjax() && tools::isPost() ){
                $onload = tools::getPost('onload');
                if ( $onload == 'true' ){
                    $modelProjects = Projects::find()
                        ->where(['status_delete' => 0])
                        ->andWhere(['status' => 1])
                        ->orderBy(['date_add' => SORT_DESC])
                        ->limit('6')
                        ->all();
                } else{
                    $modelProjects = Projects::find()
                        ->where(['status_delete' => 0])
                        ->andWhere(['status' => 1])
                        ->andWhere(['<', 'id', tools::getPost('last_id')])
                        ->orderBy(['date_add' => SORT_DESC])
                        ->limit('6')
                        ->all();
                }
                return $this->renderAjax('index-view-all', [
                    'data' => $this->getProjects( $modelProjects, false ),
                    'permission' => tools::isPermission('projects')
                ]);
            }
        } else{ $this->redirect(['/site/index']); }
    }

    /**
     * Displays archive projects.
     *
     * @return mixed
     */
    public function actionViewArchiveProjects()
    {
        if ( tools::isAuth() ){
            if ( tools::isAjax() && tools::isPost() ){
                $modelProjects = Projects::find()
                    ->where(['status_delete' => 0])
                    ->andWhere(['status' => 0])
                    ->all();
                return $this->renderAjax('index-view-archive', [
                    'data' => $this->getProjects( $modelProjects, false ),
                    'permission' => tools::isPermission('projects')
                ]);
            }
        } else{ $this->redirect(['/site/index']); }
    }

    /**
     * Displays current project.
     *
     * @return mixed
     */
    public function actionViewProject()
    {
        if ( tools::isAuth() ){
            return $this->render('index-view', [
                'data' => $this->getProjects( Projects::find()->where(['id' => $_GET['p']])->one(), true )
            ]);
        } else{ $this->redirect(['/site/index']); }
    }

    /**
     * Sorting projects.
     *
     * @return mixed
     */
    public function actionSortGroup()
    {
        if ( tools::isAuth() ){
            if ( tools::isAjax() && tools::isPost() ){
                $value = tools::getPost('value');
                $modelProjects = Projects::find()
                    ->where(['status_delete' => 0])
                    ->andWhere(['group_id' => $value])
                    ->orderBy(['date_add' => SORT_DESC])
                    ->all();
                return $this->renderAjax('index-view-all', [
                    'data' => $this->getProjects( $modelProjects, false ),
                    'permission' => tools::isPermission('projects')
                ]);
            }
        } else{ $this->redirect(['/site/index']); }
    }

    /**
     * Searching.
     *
     * @return mixed
     */
    public function actionSearch()
    {
        if ( tools::isAuth() ){
            if ( tools::isAjax() && tools::isPost() ){
                $data = [];
                $value_text = tools::getPost('value_text');
                $value_date = tools::getPost('value_date');
                if ( strlen($value_date) > 0 ){
                    if( strlen($value_text) > 0 ){
                        $modelProjectsContent = ProjectsContent::find()
                            ->andWhere(['like', 'date', $value_date])
                            ->andWhere(['like', 'title', $value_text])
                            ->all();
                        if ( isset($modelProjectsContent) ){
                            foreach ( $modelProjectsContent as $item ){
                                $modelProjects = Projects::find()
                                    ->where(['id' => $item['project_id']])
                                    ->andWhere(['status_delete' => 0])
                                    ->andWhere(['status' => 1])
                                    ->one();
                                if ( isset($modelProjects) ){
                                    $data[] = $this->getProjects( $modelProjects, true );
                                }
                            }
                        } else{ return false; }
                    } else{
                        $modelProjectsContent = ProjectsContent::find()
                            ->andWhere(['like', 'date', $value_date])
                            ->all();
                        if ( isset($modelProjectsContent) ){
                            foreach ( $modelProjectsContent as $item ){
                                $modelProjects = Projects::find()
                                    ->where(['id' => $item['project_id']])
                                    ->andWhere(['status_delete' => 0])
                                    ->andWhere(['status' => 1])
                                    ->one();
                                if ( isset($modelProjects) ){
                                    $data[] = $this->getProjects( $modelProjects, true );
                                }
                            }
                        } else{ return false; }
                    }
                } else{
                    $modelProjectsContent = ProjectsContent::find()
                        ->where(['like', 'title', $value_text])
                        ->all();
                    foreach ( $modelProjectsContent as $item ){
                        $modelProject = Projects::find()
                            ->where(['status_delete' => 0])
                            ->andWhere(['status' => 1])
                            ->andWhere(['id' => $item['project_id']])
                            ->one();
                        if ( isset($modelProject) ){
                            $data[] = $this->getProjects( $modelProject, true );
                        }
                    }
                }
                return $this->renderAjax('index-view-all', [
                    'data' => $data,
                    'permission' => tools::isPermission('projects')
                ]);
            }
        } else{ $this->redirect(['/site/index']); }
    }




    /* ADMIN */

    /**
     * Function adding to archive.
     *
     * @return mixed
     */
    public function actionArchiveProjects()
    {
        if ( tools::isAuth() && tools::isCan('addProjects') ){
            if ( tools::isAjax() && tools::isPost() ){
                $modelProjects = Projects::find()->where(['id' => tools::getPost('id')])->one();
                $modelProjects->status = tools::getPost('value') == 0 ? '1' : '0';
                $modelProjects->save();
                return true;
            }
        } else{ return $this->redirect(['/site/index']); }
    }


    /**
     * Displays form for adding projects data to database.
     *
     * @return mixed
     */
    public function actionAddProjectsForm()
    {
        if ( tools::isAuth() && tools::isCan('addProjects') ){
            return $this->render('add-projects', [
                'customers' => Customer::find()->all(),
                'groups' => ProjectsGroup::find()->all()
            ]);
        } else{ return $this->redirect(['/site/index']); }
    }

    /**
     * Function adding new projects to database.
     *
     * @return mixed
     */
    public function actionAddProjects()
    {
        if ( tools::isAuth() && tools::isCan('addProjects') ){
            $modelProjects = new Projects();
            $modelProjects->user_id = tools::idUser();
            $modelProjects->group_id = tools::getPost('group');
            $modelProjects->status = 1;
            $modelProjects->status_delete = 0;
            if ( $modelProjects->save() ){
                $modelProjectsContent = new ProjectsContent();
                $modelProjectsContent->project_id = $modelProjects->id;
                $modelProjectsContent->customer_id = tools::getPost('customer');
                $modelProjectsContent->number_customer = tools::getPost('number_customer');
                $modelProjectsContent->number_in = tools::getPost('number_in');
                $modelProjectsContent->date = tools::getPost('date');
                $modelProjectsContent->title = tools::getPost('title');
                $modelProjectsContent->text = tools::getPost('text');
                if( $modelProjectsContent->save() ){
                    return $this->renderAjax('admin-view-projects-one', [
                        'data' => $this->getProjects( $modelProjects, true )
                    ]);
                } else{ return false; }
            } else{ return false; }
        } else{ return $this->redirect(['/site/index']); }
    }

    /**
     * Displays form for updating projects data to database.
     *
     * @return mixed
     */
    public function actionUpdateProjectsForm()
    {
        if (tools::isAuth() && tools::isCan('addProjects')) {
            return $this->render('update-projects', [
                'customers' => Customer::find()->all(),
                'groups' => ProjectsGroup::find()->all(),
                'data' => $this->getProjects(Projects::find()->where(['id' => $_GET['p']])->one(), true)
            ]);
        } else { return $this->redirect(['/site/index']); }
    }

    /**
     * Function updating new projects to database.
     *
     * @return mixed
     */
    public function actionUpdateProjects()
    {
        if ( tools::isAuth() && tools::isCan('updateProjects') ){
            $modelProjects = Projects::find()->where(['id' => tools::getPost('id')])->one();
            $modelProjects->user_id = tools::idUser();
            $modelProjects->group_id = tools::getPost('group');
            $modelProjects->status = 1;
            $modelProjects->status_delete = 0;
            if ( $modelProjects->save() ){
                $modelProjectsContent = ProjectsContent::find()->where(['project_id' => $modelProjects->id])->one();
                $modelProjectsContent->customer_id = tools::getPost('customer');
                $modelProjectsContent->number_customer = tools::getPost('number_customer');
                $modelProjectsContent->number_in = tools::getPost('number_in');
                $modelProjectsContent->date = tools::getPost('date');
                $modelProjectsContent->title = tools::getPost('title');
                $modelProjectsContent->text = tools::getPost('text');
                if( $modelProjectsContent->save() ){
                    return $this->renderAjax('admin-view-projects-one', [
                        'data' => $this->getProjects( $modelProjects, true )
                    ]);
                } else{ return false; }
            } else{ return false; }
        } else{ return $this->redirect(['/site/index']); }
    }

    /**
     * Function updating new projects to database.
     *
     * @return mixed
     */
    public function actionDeleteProjects()
    {
        if ( tools::isAuth() && tools::isCan('deleteProjects') ){
            if ( tools::isAjax() && tools::isPost() ){
                $modelProject = Projects::find()->where(['id' => tools::getPost('id')])->one();
                $modelProject->status = 0;
                $modelProject->status_delete = 1;
                $modelProject->save();
            }
        } else{ return $this->redirect(['/site/index']); }
    }




    /**
     * Displays customers admin page.
     *
     * @return mixed
     */
    public function actionAdminCustomer()
    {
        if ( tools::isAuth() && tools::isCan('addCust') && tools::isCan('updateCust') && tools::isCan('deleteCust') ){
            return $this->render('admin-customer', [
                'permission' => tools::isPermission('customer')
            ]);
        } else{ $this->redirect(['/site/index']); }
    }

    /**
     * Function load customers list for admin page.
     *
     * @return mixed
     */
    public function actionAdminCustomerView()
    {
        if ( tools::isAuth() && tools::isAjax() ){
            return $this->renderAjax('admin-customer-view', [
                'data' => $this->getCustomer( Customer::find()->all() , false )
            ]);
        } else{ $this->redirect(['/site/index']); }
    }

    /**
     * Function adding new customer to database.
     *
     * @return mixed
     */
    public function actionAddCustomer()
    {
        if ( tools::isAuth() ){
            if ( tools::isAjax() && tools::isPost() ){
                $modelCustomer = new Customer();
                $modelCustomer->name = htmlspecialchars(tools::getPost('name'));
                $modelCustomer->address = tools::getPost('address');
                $modelCustomer->save();
            }
        } else{ $this->redirect(['/site/index']); }
    }

    /**
     * Load customer form for updated.
     *
     * @return mixed
     */
    public function actionAdminCustomerViewForm()
    {
        if ( tools::isAuth() ){
            if ( tools::isAjax() && tools::isPost() ){
                return $this->renderAjax('admin-customer-view-form', [
                    'data' => $this->getCustomer( Customer::find()->where(['id' => tools::getPost('id')])->one(), true )
                ]);
            }
        } else{ $this->redirect(['/site/index']); }
    }

    /**
     * Function updating customer to database.
     *
     * @return mixed
     */
    public function actionUpdateCustomer()
    {
        if ( tools::isAuth() ){
            if ( tools::isAjax() && tools::isPost() ){
                $modelCustomer = Customer::find()->where(['id' => tools::getPost('id')])->one();
                $modelCustomer->name = htmlspecialchars(tools::getPost('name'));
                $modelCustomer->address = tools::getPost('address');
                $modelCustomer->save();
            }
        } else{ $this->redirect(['/site/index']); }
    }

    /**
     * Function deleting customer to database.
     *
     * @return mixed
     */
    public function actionDeleteCustomer()
    {
        if ( tools::isAuth() ){
            if ( tools::isAjax() && tools::isPost() ){
                $modelCustomer = Customer::find()->where(['id' => tools::getPost('id')])->one();
                $modelCustomer->delete();
            }
        } else{ $this->redirect(['/site/index']); }
    }




    /**
     * Displays project groups admin page.
     *
     * @return mixed
     */
    public function actionAdminProjectsGroup()
    {
        if ( tools::isAuth() ){
            return $this->render('admin-projects-group', [
                'permission' => tools::isPermission('projects')
            ]);
        } else{ $this->redirect(['/site/index']); }
    }

    /**
     * Function load groups list for admin page.
     *
     * @return mixed
     */
    public function actionAdminProjectsGroupView()
    {
        if ( tools::isAuth() ){
            return $this->renderAjax('admin-projects-group-view', [
                'data' => ProjectsGroup::find()->all()
            ]);
        } else{ $this->redirect(['/site/index']); }
    }

    /**
     * Function adding new groups to database.
     *
     * @return mixed
     */
    public function actionAddProjectsGroup()
    {
        if ( tools::isAuth() ){
            if ( tools::isAjax() && tools::isPost() ){
                $modelProjectsGroup = new ProjectsGroup();
                $modelProjectsGroup->name = htmlspecialchars(tools::getPost('name'));
                $modelProjectsGroup->save();
            }
        } else{ $this->redirect(['/site/index']); }
    }

    /**
     * Load group form for updated.
     *
     * @return mixed
     */
    public function actionAdminProjectsGroupViewForm()
    {
        if ( tools::isAuth() ){
            if ( tools::isAjax() && tools::isPost() ){
                return $this->renderAjax('admin-projects-group-view-form', [
                    'data' => ProjectsGroup::find()->where(['id' => tools::getPost('id')])->one()
                ]);
            }
        } else{ $this->redirect(['/site/index']); }
    }

    /**
     * Function updating groups to database.
     *
     * @return mixed
     */
    public function actionUpdateProjectsGroup()
    {
        if ( tools::isAuth() ){
            if ( tools::isAjax() && tools::isPost() ){
                $modelProjectsGroup = ProjectsGroup::find()->where(['id' => tools::getPost('id')])->one();
                $modelProjectsGroup->name = htmlspecialchars(tools::getPost('name'));
                $modelProjectsGroup->save();
            }
        } else{ $this->redirect(['/site/index']); }
    }

    /**
     * Function deleting group to database.
     *
     * @return mixed
     */
    public function actionDeleteProjectsGroup()
    {
        if ( tools::isAuth() ){
            if ( tools::isAjax() && tools::isPost() ){
                $modelProjectsGroup = ProjectsGroup::find()->where(['id' => tools::getPost('id')])->one();
                $modelProjectsGroup->delete();
            }
        } else{ $this->redirect(['/site/index']); }
    }
}
