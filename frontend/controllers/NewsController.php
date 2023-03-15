<?php

namespace frontend\controllers;

require '../language/language.php';
require '../tools/tools.php';

use frontend\models\DepartmentContent;
use frontend\models\News;
use frontend\models\NewsCategory;
use frontend\models\NewsComments;
use frontend\models\NewsContent;
use frontend\models\NewsFixed;
use frontend\models\NewsLiked;
use frontend\models\NewsPreview;
use frontend\models\UserAvatar;
use frontend\models\UserData;
use frontend\tools\tools;
use frontend\tools\tools as tool;
use Yii;
use yii\helpers\Url;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use frontend\language\language as lang;
use yii\web\View;

/**
 * News controller
 */
class NewsController extends Controller
{

    public $layout = 'main';

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout', 'signup'],
                'rules' => [['actions' => ['signup'], 'allow' => true, 'roles' => ['?'],], ['actions' => ['logout'], 'allow' => true, 'roles' => ['@'],],],
            ],
            'verbs' => ['class' => VerbFilter::className(), 'actions' => ['logout' => ['post'],],],
        ];
    }

    public function actions()
    {
        return [
            'error' => ['class' => 'yii\web\ErrorAction',],
            'captcha' => ['class' => 'yii\captcha\CaptchaAction', 'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,],
        ];
    }
    
    public function getNews($model, $search, $one)
    {
        $data = [];
        if( $search ){
            foreach ( $model as $item ){
                foreach ( $item as $jtem ){
                    $modelNewsContent = NewsContent::find()->where(['news_id' => $jtem['id']])->one();
                    $modelPreview = NewsPreview::find()->where(['news_id' => $jtem['id']])->one();
                    $modelFixed = NewsFixed::find()->where(['news_id' => $jtem['id']])->one();
                    $data[] = [
                        'id'            => $jtem['id'],
                        'date_add'      => Yii::$app->formatter->asDate($jtem['date_add'], 'dd/MM/yyyy'),
                        'views'         => $jtem['views'],
                        'likes'         => $jtem['likes'],
                        'status'        => $jtem['status'],
                        'title'         => $modelNewsContent['title'],
                        'annotation'    => $modelNewsContent['annotation'],
                        'content'       => $modelNewsContent['content'],
                        'category'      => NewsCategory::find()->where(['id' => $jtem['category_id']])->one()['name'],
                        'department'    => DepartmentContent::find()->where(['id' => $jtem['department_id']])->one()['title'],
                        'image_src'     => $modelPreview['image_src'],
                        'video_src'     => $modelPreview['video_src'],
                        'fixed'         => $modelFixed['status'],
                        'user'          => UserData::find()->where(['user_id' => $jtem['user_id']])->one()['fullname'],
                        'href'          => Url::to(['/news/view-news', 'n' => $jtem['id']])
                    ];
                }
            }
        } else{
            if( $one ){
                $modelNewsContent = NewsContent::find()->where(['news_id' => $model['id']])->one();
                $modelPreview = NewsPreview::find()->where(['news_id' => $model['id']])->one();
                $modelFixed = NewsFixed::find()->where(['news_id' => $model['id']])->one();
                $data = [
                    'id'            => $model['id'],
                    'date_add'      => Yii::$app->formatter->asDate($model['date_add'], 'dd/MM/yyyy'),
                    'views'         => $model['views'],
                    'likes'         => $model['likes'],
                    'status'        => $model['status'],
                    'title'         => $modelNewsContent['title'],
                    'annotation'    => $modelNewsContent['annotation'],
                    'content'       => $modelNewsContent['content'],
                    'category'      => NewsCategory::find()->where(['id' => $model['category_id']])->one()['name'],
                    'category_id'   => NewsCategory::find()->where(['id' => $model['category_id']])->one()['id'],
                    'department'    => DepartmentContent::find()->where(['id' => $model['department_id']])->one()['title'],
                    'department_id' => DepartmentContent::find()->where(['id' => $model['department_id']])->one()['id'],
                    'image_src'     => $modelPreview['image_src'],
                    'video_src'     => $modelPreview['video_src'],
                    'fixed'         => $modelFixed['status'],
                    'user'          => UserData::find()->where(['user_id' => $model['user_id']])->one()['fullname'],
                    'href'          => Url::to(['/news/view-news', 'n' => $model['id']])
                ];
            } else{
                foreach ( $model as $item ){
                    $modelNewsContent = NewsContent::find()->where(['news_id' => $item['id']])->one();
                    $modelPreview = NewsPreview::find()->where(['news_id' => $item['id']])->one();
                    $modelFixed = NewsFixed::find()->where(['news_id' => $item['id']])->one();
                    $data[] = [
                        'id'            => $item['id'],
                        'date_add'      => Yii::$app->formatter->asDate($item['date_add'], 'dd/MM/yyyy'),
                        'views'         => $item['views'],
                        'likes'         => $item['likes'],
                        'status'        => $item['status'],
                        'title'         => $modelNewsContent['title'],
                        'annotation'    => $modelNewsContent['annotation'],
                        'content'       => $modelNewsContent['content'],
                        'category'      => NewsCategory::find()->where(['id' => $item['category_id']])->one()['name'],
                        'department'    => DepartmentContent::find()->where(['id' => $item['department_id']])->one()['title'],
                        'image_src'     => $modelPreview['image_src'],
                        'video_src'     => $modelPreview['video_src'],
                        'fixed'         => $modelFixed['status'],
                        'user'          => UserData::find()->where(['user_id' => $item['user_id']])->one()['fullname'],
                        'href'          => Url::to(['/news/view-news', 'n' => $item['id']])
                    ];
                }
            }
        }
        return $data;
    }

    public function getBreadcrumbs($url) { $data[0] = Url::to(['/home/index']); $data[1] = Url::to(['/news/index']); $data[3] = $url; return $data; }

    /*
     * Displays Homepage.
     */
    public function actionIndex()
    {
        if ( tool::isAuth() ) {
            $modelNews = News::find()->where(['status_delete' => 0])->orderBy(['date_add' => SORT_DESC])->limit('3')->all();
            $data = [];
            $i = 0;
            foreach ($modelNews as $item) {
                $modelNewsContent = NewsContent::find()->where(['news_id' => $item['id']])->one();
                $data[$i] = [
                    'id' => $item['id'],
                    'date_add' => Yii::$app->formatter->asDate($item['date_add'], 'dd/MM/yyyy'),
                    'views' => $item['views'],
                    'category' => NewsCategory::find()->where(['id' => $item['category_id']])->one()['name'],
                    'title' => $modelNewsContent['title'],
                    'annotation' => $modelNewsContent['annotation'],
                    'image_src' => NewsPreview::find()->where(['news_id' => $item['id']])->one()['image_src'],
                    'url' => Url::to(['/news/view-news', 'n' => $item['id']])
                ];
                $i++;
            }
            return $this->render('index', [
                'data' => $data,
                'lastNews' => News::find()->where(['status_delete' => 0])->one() ? News::find()->where(['status_delete' => 0])->one()['id'] : 0,
                'permission' => tools::isPermission('news')
            ]);
        } else { return $this->redirect(['/site/index']); }
    }

    /*
     * Displays current News.
     */
    public function actionViewNews()
    {
        if( tool::isAuth() ){
            $modelNewsLikes = NewsLiked::find()->where(['news_id' => $_GET['n']])->andWhere(['user_id' => tool::idUser()])->one();
            if ( isset($modelNewsLikes) ){ $liked = $modelNewsLikes['status']; } else{ $liked = 0; }
            return $this->render('view-news', [
                'data' => $this->getNews( News::find()->where(['id' => $_GET['n']])->one(), false, true ),
                'breadcrumbs' => $this->getBreadcrumbs( Url::to(['/news/view-news', 'n' => $_GET['n']]) ),
                'liked' => $liked,
                'permission' => tools::isPermission('news'),
                'user_avatar' => UserAvatar::find()->where(['user_id' => tool::idUser()])->one()['src']
            ]);
        } else{ return $this->redirect(['/site/index']); }
    }

    /*
     * Displays News in index page.
     */
    public function actionIndexViewNews()
    {
        if( tool::isAjax() && tool::isPost() ){
            $last_id = tool::getPost('last_id');
            $modelNews = News::find()
                ->where(['status_delete' => 0])
                ->andWhere(['<', 'id', $last_id])
                ->orderBy(['date_add' => SORT_DESC])
                ->limit('6')->all();
            return $this->renderAjax('index-view-news', [
                'data' => $this->getNews( $modelNews, false, false),
                'permission' => tool::isPermission('news')
            ]);
        } else{ return $this->redirect(['/site/index']); }
    }

    /*
     * Displays results search.
     */
    public function actionIndexSearch()
    {
        if (tool::isAjax() && tool::isPost()) {
            $value = tool::getPost('value');
            $data = [];
            $modelDepartmentContent = DepartmentContent::find()
                ->where(['like', 'title', $value])
                ->all();
            if (isset($modelDepartmentContent)) {
                foreach ($modelDepartmentContent as $item) {
                    $modelNews = News::find()
                        ->where(['status_delete' => 0])
                        ->andWhere(['department_id' => $item['id']])
                        ->orderBy(['date_add' => SORT_DESC])
                        ->all();
                    $data[] = $modelNews;
                }
            }
            $modelNewsContent = NewsContent::find()
                ->where(['like', 'title', $value])
                ->all();
            if (isset($modelNewsContent)) {
                foreach ($modelNewsContent as $item) {
                    $modelNews = News::find()
                        ->where(['status_delete' => 0])
                        ->andWhere(['id' => $item['news_id']])
                        ->orderBy(['date_add' => SORT_DESC])
                        ->all();
                    $data[] = $modelNews;
                }
            }
            return $this->renderAjax('index-view-news', [
                'data' => $this->getNews($data, true, false),
                'permission' => tool::isPermission('news')
            ]);
        } else { return $this->redirect(['/site/index']); }
    }

    /*
     * Function add view to database for news.
     */
    public function actionViews()
    {
        if ( tool::isAuth() ){
            if( tool::isAjax() && tool::isPost() ){
                $modelNews = News::find()->where(['id' => tool::getPost('id')])->one();
                $modelNews->views = $modelNews->views + 1;
                $modelNews->save();
                return true;
            }
            return false;
        } else { return $this->redirect(['/site/index']); }
    }

    /*
    * Function add liked to database for news.
    */
    public function actionLiked()
    {
        if ( tool::isAuth() ){
            if( tool::isAjax() && tool::isPost() ){
                $modelNewsLikes = NewsLiked::find()->where(['news_id' => tool::getPost('id')])->andWhere(['user_id' => tool::idUser()])->one();
                $modelNews = News::find()->where(['id' => tool::getPost('id')])->one();
                if( isset($modelNewsLikes) ){
                    $modelNewsLikes->status = tool::getPost('status') == 0 ? '1' : '0';
                    $modelNewsLikes->save();
                    $modelNews->likes = tool::getPost('status') == 0 ? $modelNews->likes + 1 : $modelNews->likes - 1;
                    $modelNews->save();
                } else{
                    $modelNewsLikes = new NewsLiked();
                    $modelNewsLikes->news_id = tool::getPost('id');
                    $modelNewsLikes->user_id = tool::idUser();
                    $modelNewsLikes->status = 1;
                    $modelNewsLikes->save();
                    $modelNews->likes = $modelNews->likes + 1;
                    $modelNews->save();
                }
                return true;
            }
            return false;
        } else { return $this->redirect(['/site/index']); }
    }

    /*
    * Function the return random news.
    */
    public function actionRelevantNews()
    {
        if ( tool::isAuth() ){
            if( tool::isAjax() && tool::isPost() ){
                $modelNews = News::find()->where(['status_delete' => 0])->andWhere(['!=', 'id', tool::getPost('id')])->orderBy('rand()')->limit('2')->all();
                return $this->renderAjax('index-view-news', [
                    'data' => $this->getNews( $modelNews, false, false )
                ]);
            }
            return false;
        } else { return $this->redirect(['/site/index']); }
    }



    /* ADMIN ACTION`S */
    /*
     * Displays form for adding news.
     */
    public function actionAddNewsForm()
    {
        if( tool::isAuth() && tool::isCan('addNews') ){
            $this->layout = 'main_tiny';
            return $this->render('add-news', [
                'department_list' => tool::getDepartments(),
                'category_list' => NewsCategory::find()->where(['status_delete' => 0])->all()
            ]);
        } else{ return $this->redirect(['/site/index']); }
    }

    /*
     * Function sending data to database for new news.
     */
    public function actionAddNews()
    {
        if( tool::isAuth() && tool::isCan('addNews') ){
            if( tool::isAjax() && tool::isPost() ){
                $modelNews = new News();
                $modelNews->user_id = tool::idUser();
                $modelNews->department_id = tool::getPost('department_id');
                $modelNews->category_id = tool::getPost('category_id');
                $modelNews->views = 0;
                $modelNews->likes = 0;
                $modelNews->status = 1;
                $modelNews->status_delete = 0;
                if( $modelNews->save() ){
                    $modelNewsContent = new NewsContent();
                    $modelNewsContent->news_id = $modelNews->id;
                    $modelNewsContent->title = tool::getPost('title');
                    $modelNewsContent->annotation = tool::getPost('annotation');
                    $modelNewsContent->content = tool::getPost('content');
                    if( $modelNewsContent->save() ){
                        $modelNewsPreview = new NewsPreview();
                        $modelNewsPreview->news_id = $modelNews->id;
                        $modelNewsPreview->image_src = tool::getPost('image_src');
                        $modelNewsPreview->video_src = tool::getPost('video_src');
                        if( $modelNewsPreview->save() ){
                            $modelNewsFixed = new NewsFixed();
                            $modelNewsFixed->news_id = $modelNews->id;
                            $modelNewsFixed->status = tool::getPost('status');
                            if( $modelNewsFixed->save() ){
                                return $this->renderAjax('admin-views-news-one', [
                                    'data' => $this->getNews( News::find()->where(['id' => $modelNews->id])->one(), false , true)
                                ]);
                            } else{ return $this->renderAjax('notification', [ 'data' => tool::setNotification('error', lang::$lang['n_no_db_connected']) ]); }
                        } else{ return $this->renderAjax('notification', [ 'data' => tool::setNotification('error', lang::$lang['n_no_db_connected']) ]); }
                    } else{ return $this->renderAjax('notification', [ 'data' => tool::setNotification('error', lang::$lang['n_no_db_connected']) ]); }
                } else{ return $this->renderAjax('notification', [ 'data' => tool::setNotification('error', lang::$lang['n_no_db_connected']) ]); }
            } else{ return $this->renderAjax('notification', [ 'data' => tool::setNotification('error', lang::$lang['n_no_db_connected']) ]); }
        } else{ return $this->redirect(['/site/index']); }
    }

    /*
     * Displays form for updating news.
     */
    public function actionUpdateNewsForm()
    {
        if( tool::isAuth() && tool::isCan('updateNews') ){
            $this->layout = 'main_tiny';
            $modelNews = News::find()->where(['id' => $_GET['n']])->one();
            return $this->render('update-news', [
                'data' => $this->getNews( $modelNews, false, true ),
                'department_list' => tool::getDepartments(),
                'category_list' => NewsCategory::find()->where(['status_delete' => 0])->all()
            ]);
        } else{ return $this->redirect(['/site/index']); }
    }

    /*
     * Function updated data in database for news.
     */
    public function actionUpdateNews()
    {
        if( tool::isAuth() && tool::isCan('updateNews') ){
            if( tool::isAjax() && tool::isPost() ){
                $id = tool::getPost('id');
                $modelNews = News::find()->where(['id' => $id])->one();
                $modelNews->user_id = tool::idUser();
                $modelNews->department_id = tool::getPost('department_id');
                $modelNews->category_id = tool::getPost('category_id');
                $modelNews->date_update = date('Y-m-d H:i:s');
                $modelNews->views = 0;
                if( $modelNews->save() ){
                    $modelNewsContent = NewsContent::find()->where(['news_id' => $id])->one();
                    $modelNewsContent->title = tool::getPost('title');
                    $modelNewsContent->annotation = tool::getPost('annotation');
                    $modelNewsContent->content = tool::getPost('content');
                    if( $modelNewsContent->save() ){
                        $modelNewsPreview = NewsPreview::find()->where(['news_id' => $id])->one();
                        $modelNewsPreview->image_src = tool::getPost('image_src');
                        $modelNewsPreview->video_src = tool::getPost('video_src');
                        if( $modelNewsPreview->save() ){
                            $modelNewsFixed = NewsFixed::find()->where(['news_id' => $id])->one();
                            $modelNewsFixed->status = tool::getPost('status');
                            if( $modelNewsFixed->save() ){
                                return $this->renderAjax('admin-views-news-one', [
                                    'data' => $this->getNews( News::find()->where(['id' => $id])->one(), false , true)
                                ]);
                            } else{ return $this->renderAjax('notification', [ 'data' => tool::setNotification('error', lang::$lang['n_no_db_connected']) ]); }
                        } else{ return $this->renderAjax('notification', [ 'data' => tool::setNotification('error', lang::$lang['n_no_db_connected']) ]); }
                    } else{ return $this->renderAjax('notification', [ 'data' => tool::setNotification('error', lang::$lang['n_no_db_connected']) ]); }
                } else{ return $this->renderAjax('notification', [ 'data' => tool::setNotification('error', lang::$lang['n_no_db_connected']) ]); }
            } else{ return $this->renderAjax('notification', [ 'data' => tool::setNotification('error', lang::$lang['n_no_db_connected']) ]); }
        } else{ return $this->redirect(['/site/index']); }
    }

    /*
     * Function logical remove data in database for news.
     */
    public function actionDeleteNews()
    {
        if( tool::isAuth() && tool::isCan('deleteNews') ){
            $modelNews = News::find()->where(['id' => tool::getPost('id')])->one();
            $modelNews->date_remove = date('Y-m-d H:i:s');
            $modelNews->status = 0;
            $modelNews->status_delete = 1;
            if( $modelNews->save() ){
                return true;
            } else{ return $this->renderAjax('notification', [ 'data' => tool::setNotification('error', lang::$lang['n_no_db_connected']) ]); }
        } else{ return $this->redirect(['/site/index']); }
    }

    /*
     * Displays category for news.
     */
    public function actionAdminCategory()
    {
        if( tool::isAuth() && ( tool::isCan('addNewsCategory') || tool::isCan('updateNewsCategory') || tool::isCan('deleteNewsCategory') ) ){
            return $this->render('admin-category', [
                'permission' => tool::isPermission('news')
            ]);
        } else{ return $this->redirect(['/site/index']); }
    }

    /*
     * Displays Category in admin page.
     */
    public function actionViewCategory()
    {
        if( tool::isAuth() && ( tool::isCan('addNewsCategory') || tool::isCan('updateNewsCategory') || tool::isCan('deleteNewsCategory') ) ){
            if( tool::isAjax() && tool::isPost() ){
                return $this->renderAjax('admin-view-category', [ 'data' => NewsCategory::find()->where(['status_delete' => 0])->all() ]);
            } else{ return $this->redirect(['/site/index']); }
        } else{ return $this->redirect(['/site/index']); }
    }

    /*
     * Displays current Category in admin page.
     */
    public function actionViewCurrentCategory()
    {
        if( tool::isAuth() && ( tool::isCan('addNewsCategory') || tool::isCan('updateNewsCategory') || tool::isCan('deleteNewsCategory') ) ){
            if( tool::isAjax() && tool::isPost() ){
                return $this->renderAjax('admin-view-current-category', [ 'data' => NewsCategory::find()->where(['id' => tool::getPost('id')])->one() ]);
            } else{ return $this->redirect(['/site/index']); }
        } else{ return $this->redirect(['/site/index']); }
    }

    /*
     * Function adding data in database for news category.
     */
    public function actionAddCategory()
    {
        if( tool::isAuth() && tool::isCan('addNewsCategory') ){
            $modelNewsCategory = new NewsCategory();
            $modelNewsCategory->user_id = tool::idUser();
            $modelNewsCategory->name = tool::getPost('value');
            $modelNewsCategory->status = 1;
            $modelNewsCategory->status_delete = 0;
            if( $modelNewsCategory->save() ){
                return true;
            } else{ return $this->renderAjax('notification', [ 'data' => tool::setNotification('error', lang::$lang['n_no_db_connected']) ]); }
        } else{ return $this->redirect(['/site/index']); }
    }

    /*
     * Function updated data in database for news category.
     */
    public function actionUpdateCategory()
    {
        if( tool::isAuth() && ( tool::isCan('addNewsCategory') || tool::isCan('updateNewsCategory') || tool::isCan('deleteNewsCategory') ) ){
            if( tool::isAjax() && tool::isPost() ){
                $modelNewsCategory = NewsCategory::find()->where(['id' => tool::getPost('id')])->one();
                $modelNewsCategory->date_update = date('Y-m-d H:i:s');
                $modelNewsCategory->name = tool::getPost('value');
                if( $modelNewsCategory->save() ){
                    return true;
                } else{ return $this->renderAjax('notification', [ 'data' => tool::setNotification('error', lang::$lang['n_no_db_connected']) ]); }
            } else{ return $this->redirect(['/site/index']); }
        } else{ return $this->redirect(['/site/index']); }
    }

    /*
     * Function logical remove data in database for news category.
     */
    public function actionDeleteCategory()
    {
        if( tool::isAuth() && tool::isCan('deleteNewsCategory') ){
            $modelNewsCategory = NewsCategory::find()->where(['id' => tool::getPost('id')])->one();
            $modelNewsCategory->date_remove = date('Y-m-d H:i:s');
            $modelNewsCategory->status = 0;
            $modelNewsCategory->status_delete = 1;
            if( $modelNewsCategory->save() ){
                return true;
            } else{ return $this->renderAjax('notification', [ 'data' => tool::setNotification('error', lang::$lang['n_no_db_connected']) ]); }
        } else{ return $this->redirect(['/site/index']); }
    }

    public function actionViewComments()
    {
        if( tool::isAjax() ){
            $modelNewsComments = NewsComments::find()->where(['status' => 1])->andWhere(['parent_comment_id' => NULL])->andWhere(['news_id' => tool::getPost('id')])->orderBy(['date_add' => SORT_DESC])->all();
            if ( $modelNewsComments ){
                return $this->renderAjax('view-comments', [
                    'data' => $modelNewsComments,
                    'user_id' => tool::idUser(),
                    'permission' => tool::isPermission('news')
                ]);
            }
        }
    }

    public function actionAddComment()
    {
        if( tool::isAjax() ){
            if ( strlen(tool::getPost('response')) == 0 ){
                $modelNewsComment = new NewsComments();
                $modelNewsComment->user_id = tool::idUser();
                $modelNewsComment->news_id = tool::getPost('id');
                $modelNewsComment->comment = tool::getPost('comment');
                $modelNewsComment->parent_comment_id = NULL;
                $modelNewsComment->status = 1;
                $modelNewsComment->save();
            } else{
                $modelNewsComment = new NewsComments();
                $modelNewsComment->user_id = tool::idUser();
                $modelNewsComment->news_id = tool::getPost('id');
                $modelNewsComment->comment = tool::getPost('comment');
                $modelNewsComment->parent_comment_id = tool::getPost('response');
                $modelNewsComment->status = 1;
                $modelNewsComment->save();
            }
        }
    }

    public function actionViewUserNews()
    {
        if( tool::isAjax() ){
            $modelNewsComment = NewsComments::find()->where(['id' => tool::getPost('id')])->one();
            return UserData::find()->where(['user_id' => $modelNewsComment['user_id']])->one()['fullname'];
        }
    }

    public function actionDeleteComment()
    {
        if( tool::isAjax() ){
            $modelNewsComment = NewsComments::find()->where(['id' => tool::getPost('id')])->one();
            $modelNewsComment->status = 0;
            $modelNewsComment->save();
        }
    }

}