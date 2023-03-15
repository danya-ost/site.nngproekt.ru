<?php

namespace frontend\controllers;

use frontend\models\Blog;
use frontend\models\BlogComments;
use frontend\models\BlogContent;
use frontend\models\BlogPreview;
use frontend\models\ResendVerificationEmailForm;
use frontend\models\UserAvatar;
use frontend\models\UserData;
use frontend\models\VerifyEmailForm;
use frontend\tools\tools;
use frontend\tools\tools as tool;
use Yii;
use yii\base\InvalidArgumentException;
use yii\helpers\Url;
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
 * Blog controller
 */
class BlogController extends Controller
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

    public function getBlogPosts($model, $one)
    {
        $data = [];
        if ( $one ){
            $modelBC = BlogContent::find()->where(['blog_id' => $model['id']])->one();
            $modelBP = BlogPreview::find()->where(['blog_id' => $model['id']])->one();
            $data = [
                'id'            => $model['id'],
                'user_fullname' => UserData::find()->where(['user_id' => $model['user_id']])->one()['fullname'],
                'user_id'       => $model['user_id'],
                'date'          => Yii::$app->formatter->asDate($model['date_add'], 'dd|MM|yy'),
                'title'         => $modelBC['title'],
                'annotation'    => $modelBC['annotation'],
                'content'       => $modelBC['content'],
                'thumb'         => $modelBP['image_src'],
                'video'         => strlen($modelBP['video_src']) > 0 ? $modelBP['video_src'] : NULL
            ];
        } else{
            foreach ( $model as $item ){
                $modelBC = BlogContent::find()->where(['blog_id' => $item['id']])->one();
                $modelBP = BlogPreview::find()->where(['blog_id' => $item['id']])->one();
                $data[] = [
                    'id'            => $item['id'],
                    'user_fullname' => UserData::find()->where(['user_id' => $item['user_id']])->one()['fullname'],
                    'user_id'       => $item['user_id'],
                    'date'          => Yii::$app->formatter->asDate($item['date_add'], 'dd|MM|yy'),
                    'title'         => $modelBC['title'],
                    'annotation'    => $modelBC['annotation'],
                    'content'       => $modelBC['content'],
                    'thumb'         => $modelBP['image_src'],
                    'video'         => strlen($modelBP['video_src']) > 0 ? $modelBP['video_src'] : NULL
                ];
            }
        }
        return $data;
    }

    public function getBreadcrumbs($url)
    {
        $breadcrumbs = [];
        $breadcrumbs[] = Url::to(['/home/index']);
        $breadcrumbs[] = Url::to(['/blog/index']);
        $breadcrumbs[] = $url;
        return $breadcrumbs;
    }

    /** Displays homepage. @return mixed */
    public function actionIndex()
    {
        if ( tools::isAuth() ){
            return $this->render('index', [
                'permission' => tools::isPermission('blog'),
                'first_post_id' => Blog::find()->where(['status_delete' => 0])->one() != NULL ? Blog::find()->where(['status_delete' => 0])->one()['id'] : 0
            ]);
        } else{ return $this->redirect(['/site/index']); }
    }

    /** Displays add form for blog post @return mixed */
    public function actionAddForm()
    {
        if ( tools::isAuth() ){
            $this->layout = 'main_tiny';
            return $this->render('add-blog-form');
        } else{ return $this->redirect(['/site/index']); }
    }

    /** Adding data post to database (ajax_function) @return mixed */
    public function actionAddPost()
    {
        if ( tools::isAuth() && tools::isAjax() && tools::isPost() ){
            $modelB = new Blog();
            $modelB->user_id = tools::idUser();
            $modelB->views = 0;
            $modelB->status = 1;
            $modelB->status_delete = 0;
            if ( $modelB->save() ){
                $modelBC = new BlogContent();
                $modelBC->blog_id = $modelB->id;
                $modelBC->title = tools::getPost('title');
                $modelBC->annotation = tools::getPost('annotation');
                $modelBC->content = tools::getPost('content');
                if ( $modelBC->save() ){
                    $modelBP = new BlogPreview();
                    $modelBP->blog_id = $modelB->id;
                    $modelBP->image_src = tools::getPost('image_src');
                    $modelBP->video_src = tools::getPost('video_src');
                    if ( $modelBP->save() ){
                        return $modelB->id;
                    }
                }
            }
        } else{ return $this->redirect(['/site/index']); }
    }

    /** Displays post in index page (ajax_function) @return mixed */
    public function actionPaginationPost()
    {
        if ( tools::isAuth() && tools::isAjax() && tools::isPost() ){
            if ( tools::getPost('onload') == 'true' ){
                $modelB = Blog::find()->where(['status_delete' => 0])->orderBy(['date_add' => SORT_DESC])->limit('9')->all();
            } else{
                $modelB = Blog::find()->where(['status_delete' => 0])->andWhere(['<', 'id', tools::getPost('last_id')])->orderBy(['date_add' => SORT_DESC])->limit('9')->all();
            }
            return $this->renderAjax('pagination-post', [
                'data' => $this->getBlogPosts( $modelB, false )
            ]);
        } else{ return $this->redirect(['/site/index']); }
    }

    /** Displays searching post in index page (ajax_function) @return mixed */
    public function actionSearch()
    {
        if ( tools::isAuth() && tools::isAjax() && tools::isPost() ){
            $value = tools::getPost('value');
            $modelBC = BlogContent::find()->where(['like', 'title', $value])->orWhere(['like', 'annotation', $value])->orWhere(['like', 'content', $value])->all();
            $model = [];
            foreach ( $modelBC as $bc ){
                $modelB = Blog::find()->where(['id' => $bc['blog_id']])->one();
                if ( $modelB['status_delete'] == 0 ) $model[] = $modelB;
            }
            return $this->renderAjax('pagination-post', [
                'data' => $this->getBlogPosts( $model, false )
            ]);
        } else{ return $this->redirect(['/site/index']); }
    }

    /** Displays selected post in blog module */
    public function actionViewPost()
    {
        if( tools::isAuth() ){
            return $this->render('view-post', [
                'data' => $this->getBlogPosts( Blog::find()->where(['id' => $_GET['b']])->one(), true ),
                'breadcrumbs' => $this->getBreadcrumbs( Url::to(['/blog/view-post', 'b' => $_GET['b']]) ),
                'permission' => tools::isPermission('blog'),
                'user_avatar' => UserAvatar::find()->where(['user_id' => tool::idUser()])->one()['src']
            ]);
        } else{ return $this->redirect(['/site/index']); }
    }

    /** Displays set views post */
    public function actionViews()
    {
        if( tools::isAuth() ){
            $modelB = Blog::find()->where(['id' => tools::getPost('id')])->one();
            $modelB->views = $modelB->views + 1;
            $modelB->save();
        } else{ return $this->redirect(['/site/index']); }
    }

    /** Displays relevant post to view-post page */
    public function actionRelevantPost()
    {
        if( tools::isAuth() && tools::isAjax() && tools::isPost() ){
            $modelB = Blog::find()->where(['status_delete' => 0])->andWhere(['!=', 'id', tools::getPost('id')])->orderBy('rand()')->limit('3')->all();
            return $this->renderAjax('pagination-post', [
                'data' => $this->getBlogPosts( $modelB, false )
            ]);
        } else{ return $this->redirect(['/site/index']); }
    }

    /** Displays update form for blog post @return mixed */
    public function actionUpdateForm()
    {
        if ( tools::isAuth() ){
            $this->layout = 'main_tiny';
            return $this->render('update-blog-form', [
                'data' => $this->getBlogPosts( Blog::find()->where(['id' => $_GET['b']])->one(), true )
            ]);
        } else{ return $this->redirect(['/site/index']); }
    }


    /** Updating data post from database (ajax_function) @return mixed */
    public function actionUpdatePost()
    {
        if ( tools::isAuth() && tools::isAjax() && tools::isPost() ){
            $modelB = Blog::find()->where(['id' => tools::getPost('id')])->one();
            $modelB->user_id = tools::idUser();
            $modelB->date_update = date("Y-m-d H:i:s");
            if ( $modelB->save() ){
                $modelBC = BlogContent::find()->where(['blog_id' => tools::getPost('id')])->one();
                $modelBC->blog_id = tools::getPost('id');
                $modelBC->title = tools::getPost('title');
                $modelBC->annotation = tools::getPost('annotation');
                $modelBC->content = tools::getPost('content');
                if ( $modelBC->save() ){
                    $modelBP = BlogPreview::find()->where(['blog_id' => tools::getPost('id')])->one();
                    $modelBP->blog_id = tools::getPost('id');
                    $modelBP->image_src = tools::getPost('image_src');
                    $modelBP->video_src = tools::getPost('video_src');
                    if ( $modelBP->save() ){
                        return tools::getPost('id');
                    }
                }
            }
        } else{ return $this->redirect(['/site/index']); }
    }

    /** Deleting data post from database (ajax_function) @return mixed */
    public function actionDeletePost()
    {
        if ( tools::isAuth() && tools::isAjax() && tools::isPost() ){
            $modelB = Blog::find()->where(['id' => tools::getPost('id')])->one();
            $modelB->date_remove = date("Y-m-d H:i:s");
            $modelB->status = 0;
            $modelB->status_delete = 1;
            if ( $modelB->save() ){
                return $modelB->id;
            }
        } else{ return $this->redirect(['/site/index']); }
    }

    public function actionViewComments()
    {
        if( tool::isAjax() ){
            $modelNewsComments = BlogComments::find()->where(['status' => 1])->andWhere(['parent_comment_id' => NULL])->andWhere(['blog_id' => tool::getPost('id')])->orderBy(['date_add' => SORT_DESC])->all();
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
                $modelNewsComment = new BlogComments();
                $modelNewsComment->user_id = tool::idUser();
                $modelNewsComment->blog_id = tool::getPost('id');
                $modelNewsComment->comment = tool::getPost('comment');
                $modelNewsComment->parent_comment_id = NULL;
                $modelNewsComment->status = 1;
                $modelNewsComment->save();
            } else{
                $modelNewsComment = new BlogComments();
                $modelNewsComment->user_id = tool::idUser();
                $modelNewsComment->blog_id = tool::getPost('id');
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
            $modelNewsComment = BlogComments::find()->where(['id' => tool::getPost('id')])->one();
            return UserData::find()->where(['user_id' => $modelNewsComment['user_id']])->one()['fullname'];
        }
    }

    public function actionDeleteComment()
    {
        if( tool::isAjax() ){
            $modelNewsComment = BlogComments::find()->where(['id' => tool::getPost('id')])->one();
            $modelNewsComment->status = 0;
            $modelNewsComment->save();
        }
    }

}
