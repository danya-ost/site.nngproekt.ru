<?php

namespace frontend\controllers;

use common\models\User;
use frontend\models\Blog;
use frontend\models\BlogContent;
use frontend\models\BlogPreview;
use frontend\models\Gallery;
use frontend\models\GalleryContent;
use frontend\models\Honor;
use frontend\models\HonorContent;
use frontend\models\Talents;
use frontend\models\TalentsCategory;
use frontend\models\TalentsContent;
use frontend\models\TalentsFixed;
use frontend\models\TalentsPreview;
use frontend\models\News;
use frontend\models\NewsCategory;
use frontend\models\NewsContent;
use frontend\models\NewsFixed;
use frontend\models\NewsPreview;
use frontend\models\Projects;
use frontend\models\ProjectsContent;
use frontend\models\Survey;
use frontend\models\SurveyContent;
use frontend\models\Template;
use frontend\models\UserData;
use frontend\tools\tools;
use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

/**
 * Home controller
 */
class HomeController extends Controller
{

    public $layout = 'main_about';

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

    /** Displays homepage */
    public function actionIndex()
    {
        if ( tools::isAuth() ){
            $this->layout = 'main';
            $data = [];
            $honor = Honor::find()->where(['status_delete' => 0])->all();
            return $this->render('index', [
                'honor' => $honor
            ]);
        } else{ return $this->redirect(['/site/index']); }
    }

    public function actionSitemap()
    {
        if ( tools::isAuth() ){
            $this->layout = 'main';
            return $this->render('sitemap');
        } else{ return $this->redirect(['/site/index']); }
    }

    /** Displays homepage */
    public function actionMenu()
    {
        if ( tools::isAuth() ){
            $this->layout = 'main';
            return $this->render('menu');
        } else{ return $this->redirect(['/site/index']); }
    }

    /** Displays about page */
    public function actionAbout()
    {
        if ( tools::isAuth() ){
            $data = [];
            $modelTemplate = Template::find()->where(['data_key' => 'about'])->all();
            foreach ( $modelTemplate as $template ){
                $data[$template['data_key_content']] = [
                    'id' => $template['id'],
                    'text' => $template['content']
                ];
            }
            return $this->render('about', [
                'data' => $data,
                'permission' => tools::isPermission('template')
            ]);
        } else{ return $this->redirect(['/site/index']); }
    }

    /** Function updated data on about page */
    public function actionAboutUpdate()
    {
        if ( tools::isAuth() && tools::isAjax() && tools::isPost() ){
            $data = tools::getPost('data');
            foreach ( $data as $item ){
                $modelTemplate = Template::find()->where(['id' => $item['0']])->one();
                $modelTemplate->content = $item[1];
                $modelTemplate->save();
            }
        }
    }

    /** Displays carrier page */
    public function actionCarrier()
    {
        if ( tools::isAuth() ){
            $data = [];
            $modelTemplate = Template::find()->where(['data_key' => 'carrier'])->all();
            foreach ( $modelTemplate as $template ){
                $data[$template['data_key_content']] = [
                    'id' => $template['id'],
                    'text' => $template['content']
                ];
            }
            return $this->render('carrier', [
                'data' => $data,
                'permission' => tools::isPermission('template')
            ]);
        } else{ return $this->redirect(['/site/index']); }
    }

    /** Function updated data on carrier page */
    public function actionCarrierUpdate()
    {
        if ( tools::isAuth() && tools::isAjax() && tools::isPost() ){
            $data = tools::getPost('data');
            foreach ( $data as $item ){
                $modelTemplate = Template::find()->where(['id' => $item['0']])->one();
                $modelTemplate->content = $item[1];
                $modelTemplate->save();
            }
        }
    }

    /** Displays banner items in homepage */
    public function actionBanner()
    {
        if ( tools::isAuth() && tools::isAjax() && tools::isPost() ){
            $modelFixed = NewsFixed::find()->where(['status' => 1])->all();
            $data = [];
            $i = 0;
            foreach ( $modelFixed as $item ){
                $model = News::find()->where(['id' => $item['news_id']])->one();
                $modelContent = NewsContent::find()->where(['news_id' => $item['news_id']])->one();
                if( $model['status_delete'] == 0 ){
                    $data[$i] = [
                        'id' => $model['id'],
                        'title' => $modelContent['title'],
                        'annotation' => $modelContent['annotation'],
                        'image_src' => '/frontend/web/' . NewsPreview::find()->where(['news_id' => $item['news_id']])->one()['image_src']
                    ];
                    $i++;
                }
            }
            $modelFixed = TalentsFixed::find()->where(['status' => 1])->all();
            foreach ( $modelFixed as $item ){
                $model = Talents::find()->where(['id' => $item['talents_id']])->one();
                $modelContent = TalentsContent::find()->where(['talents_id' => $item['talents_id']])->one();
                if( $model['status_delete'] == 0 ){
                    $data[$i] = [
                        'id' => $model['id'],
                        'title' => $modelContent['title'],
                        'annotation' => $modelContent['annotation'],
                        'image_src' => '/frontend/web/' . TalentsPreview::find()->where(['talents_id' => $item['talents_id']])->one()['image_src']
                    ];
                    $i++;
                }
            }
            return $this->renderAjax('banner', [ 'data' => $data ]);
        } else{ return $this->redirect(['/site/index']); }
    }

    /** Displays news (4-limit) in homepage */
    public function actionNews()
    {
        if ( tools::isAuth() && tools::isAjax() && tools::isPost() ){
            $model = News::find()->where(['status_delete' => 0])->orderBy(['date_add' => SORT_DESC])->limit('4')->all();
            $data = [];
            $i = 0;
            foreach ( $model as $item ){
                $data[$i] = [
                    'id'        => $item['id'],
                    'title'     => NewsContent::find()->where(['news_id' => $item['id']])->one()['title'],
                    'image_src' => '/frontend/web/' . NewsPreview::find()->where(['news_id' => $item['id']])->one()['image_src'],
                    'category'  => NewsCategory::find()->where(['id' => $item['category_id']])->one()['name'],
                    'date_add'  => Yii::$app->formatter->asDate($item['date_add'], 'dd/MM/yy'),
                    'views'     => $item['views'],
                ];
                $i++;
            }
            return $this->renderAjax('news', [ 'data' => $data ]);
        } else{ return $this->redirect(['/site/index']); }
    }

    /** Displays news (3-limit) in homepage */
    public function actionTalents()
    {
        if ( tools::isAuth() && tools::isAjax() && tools::isPost() ){
            $model = Talents::find()->where(['status_delete' => 0])->orderBy(['date_add' => SORT_DESC])->limit('3')->all();
            $data = [];
            $i = 0;
            foreach ( $model as $item ){
                $data[$i] = [
                    'id'        => $item['id'],
                    'title'     => TalentsContent::find()->where(['talents_id' => $item['id']])->one()['title'],
                    'image_src' => '/frontend/web/' . TalentsPreview::find()->where(['talents_id' => $item['id']])->one()['image_src'],
                    'category'  => TalentsCategory::find()->where(['id' => $item['category_id']])->one()['name'],
                    'date_add'  => Yii::$app->formatter->asDate($item['date_add'], 'dd/MM/yy'),
                    'views'     => $item['views'],
                ];
                $i++;
            }
            return $this->renderAjax('talents', [ 'data' => $data ]);
        } else{ return $this->redirect(['/site/index']); }
    }

    /** Displays blog posts (3-limit) in homepage */
    public function actionBlog()
    {
        if ( tools::isAuth() && tools::isAjax() && tools::isPost() ){
            $model = Blog::find()->where(['status_delete' => 0])->orderBy(['date_add' => SORT_DESC])->limit('3')->all();
            $data = [];
            foreach ( $model as $item ){
                $modelBC = BlogContent::find()->where(['blog_id' => $item['id']])->one();
                $modelBP = BlogPreview::find()->where(['blog_id' => $item['id']])->one();
                $data[] = [
                    'id'            => $item['id'],
                    'user_fullname' => UserData::find()->where(['user_id' => $item['user_id']])->one()['fullname'],
                    'date'          => Yii::$app->formatter->asDate($item['date_add'], 'dd|MM|yy'),
                    'title'         => $modelBC['title'],
                    'thumb'         => $modelBP['image_src'],
                ];
            }
            return $this->renderAjax('blog', [ 'data' => $data ]);
        } else{ return $this->redirect(['/site/index']); }
    }

    public function actionSearch()
    {
        if ( tools::isAuth() ){
            if ( tools::isAjax() && tools::isPost() ){
                if ( tools::getPost('type') == 'users' ){
                    $userData = UserData::find()->where(['like', 'fullname', tools::getPost('value')])->andWhere(['status_delete' => 0])->orderBy(['fullname' => SORT_ASC])->all();
                    if ( $userData ){
                        $users = [];
                        foreach ( $userData as $item ){
                            $user = User::find()->where(['id' => $item['user_id']])->one();
                            if ( $user && $user['id'] > 1 ){
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
                } else{
                    $data = [];
                    $modelNC = TalentsContent::find()->where(['like', 'title', tools::getPost('value')])->all();
                    foreach ( $modelNC as $item ){
                        if ( Talents::find()->where(['id' => $item['news_id']])->one()['status_delete'] == 0 ){
                            $data[] = [
                                'id' => $item['news_id'],
                                'title' => $item['title'] . '<span class="font-light text-xs" style="color: #bcbcbc;"> (Новость)</span>',
                                'href' => '/frontend/web/news/view-news?n=' . $item['news_id']
                            ];
                        }
                    }
                    $modelBC = BlogContent::find()->where(['like', 'title', tools::getPost('value')])->all();
                    foreach ( $modelBC as $item ){
                        if ( Blog::find()->where(['id' => $item['blog_id']])->one()['status_delete'] == 0 ){
                            $data[] = [
                                'id' => $item['blog_id'],
                                'title' => $item['title'] . '<span class="font-light text-xs" style="color: #bcbcbc;"> (Блог руководства)</span>',
                                'href' => '/frontend/web/blog/view-post?b=' . $item['blog_id']
                            ];
                        }
                    }
                    $modelPC = ProjectsContent::find()->where(['like', 'title', tools::getPost('value')])->all();
                    foreach ( $modelPC as $item ){
                        if ( Projects::find()->where(['id' => $item['project_id']])->one()['status_delete'] == 0 ){
                            $data[] = [
                                'id' => $item['project_id'],
                                'title' => $item['title'] . '<span class="font-light text-xs" style="color: #bcbcbc;"> (Проект)</span>',
                                'href' => '/frontend/web/projects/view-project?p=' . $item['project_id']
                            ];
                        }
                    }
                    $modelGC = GalleryContent::find()->where(['like', 'title', tools::getPost('value')])->all();
                    foreach ( $modelGC as $item ){
                        if ( Gallery::find()->where(['id' => $item['gallery_id']])->one()['status_delete'] == 0 ){
                            $data[] = [
                                'id' => $item['gallery_id'],
                                'title' => $item['title'] . '<span class="font-light text-xs" style="color: #bcbcbc;"> (Глаллерея)</span>',
                                'href' => '/frontend/web/foto/view-gallery?g=' . $item['gallery_id']
                            ];
                        }
                    }
                    $modelSC = SurveyContent::find()->where(['like', 'title', tools::getPost('value')])->all();
                    foreach ( $modelSC as $item ){
                        if ( Survey::find()->where(['id' => $item['survey_id']])->one()['status_delete'] == 0 ){
                            $data[] = [
                                'id' => $item['survey_id'],
                                'title' => $item['title'] . '<span class="font-light text-xs" style="color: #bcbcbc;"> (Опрос)</span>',
                                'href' => '/frontend/web/survey/index'
                            ];
                        }
                    }
                    return $this->renderAjax('all-search', [
                        'data' => $data
                    ]);
                }
            }
        } else{ return $this->redirect(['/site/index']); }
    }

}
