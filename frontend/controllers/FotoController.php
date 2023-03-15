<?php

namespace frontend\controllers;

use frontend\models\Gallery;
use frontend\models\GalleryContent;
use frontend\models\GalleryItems;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use frontend\tools\tools;

/**
 * Foto controller
 */
class FotoController extends Controller
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

    /** Displays homepage. @return mixed */
    public function actionIndex()
    {
        if ( tools::isAuth() ){
            $data = [];
            $modelG = Gallery::find()->where(['status_delete' => 0])->orderBy(['date_add' => SORT_DESC])->all();
            foreach ( $modelG as $g ){
                $data[] = GalleryContent::find()->where(['gallery_id' => $g['id']])->one();
            }
            return $this->render('index', [
                'permission' => tools::isPermission('foto'),
                'data' => $data
            ]);
        } else{ return $this->redirect(['/site/index']); }
    }

    /** Displays add form. @return mixed */
    public function actionAddForm()
    {
        if ( tools::isAuth() ){
            return $this->render('add-form');
        } else{ return $this->redirect(['/site/index']); }
    }

    /** Adding image to form. @return mixed */
    public function actionAddFotoForm()
    {
        if ( tools::isAuth() ){
            return $this->renderAjax('add-foto-form', [
                'data' => tools::getPost('src')
            ]);
        } else{ return $this->redirect(['/site/index']); }
    }

    /** Adding new gallery. @return mixed */
    public function actionAddGallery()
    {
        if ( tools::isAuth() && tools::isAjax() && tools::isPost() ){
            $modelG = new Gallery();
            $modelG->user_id = tools::idUser();
            $modelG->status = 1;
            $modelG->status_delete = 0;
            if ( $modelG->save() ){
                $cover = null;
                foreach ( tools::getPost('fotos') as $item ){
                    $modelGI = new GalleryItems();
                    $modelGI->gallery_id = $modelG->id;
                    $modelGI->src = $item;
                    $modelGI->user_id = tools::idUser();
                    $modelGI->status = 1;
                    $modelGI->status_delete = 0;
                    $modelGI->save();
                    $cover = $item;
                }
                $modelGC = new GalleryContent();
                $modelGC->gallery_id = $modelG->id;
                $modelGC->title = tools::getPost('title');
                $modelGC->cover_src = $cover;
                $modelGC->save();
                return $modelG->id;
            }
        } else{ return $this->redirect(['/site/index']); }
    }

    /** Displays update form. @return mixed */
    public function actionUpdateForm()
    {
        if ( tools::isAuth() ){
            $modelGC = GalleryContent::find()->where(['gallery_id' => $_GET['g']])->one();
            $modelGI = GalleryItems::find()->where(['gallery_id' => $_GET['g']])->all();
            return $this->render('update-form', [
                'modelGC' => $modelGC,
                'modelGI' => $modelGI
            ]);
        } else{ return $this->redirect(['/site/index']); }
    }

    /** Updating new gallery. @return mixed */
    public function actionUpdateGallery()
    {
        if ( tools::isAuth() && tools::isAjax() && tools::isPost() ){
            $modelG = Gallery::find()->where(['id' => tools::getPost('id')])->one();
            $modelG->user_id = tools::idUser();
            $modelG->date_update = date('Y-m-d H:i:s');
            if ( $modelG->save() ){
                foreach ( GalleryItems::find()->where(['gallery_id' => $modelG->id])->all() as $item ){
                    $item->delete();
                }
                $cover = null;
                foreach ( tools::getPost('fotos') as $item ){
                    $modelGI = new GalleryItems();
                    $modelGI->gallery_id = $modelG->id;
                    $modelGI->src = $item;
                    $modelGI->user_id = tools::idUser();
                    $modelGI->status = 1;
                    $modelGI->status_delete = 0;
                    $modelGI->save();
                    $cover = $item;
                }
                $modelGC = GalleryContent::find()->where(['gallery_id' => $modelG->id])->one();
                $modelGC->title = tools::getPost('title');
                $modelGC->cover_src = $cover;
                $modelGC->save();
                return $modelG->id;
            }
        } else{ return $this->redirect(['/site/index']); }
    }

    /** Displays selected gallery. @return mixed */
    public function actionViewGallery()
    {
        if ( tools::isAuth() ){
            $modelGC = GalleryContent::find()->where(['gallery_id' => $_GET['g']])->one();
            $modelGI = GalleryItems::find()->where(['gallery_id' => $_GET['g']])->all();
            return $this->render('view-gallery', [
                'data' => $modelGC,
                'data_items' => $modelGI
            ]);
        } else{ return $this->redirect(['/site/index']); }
    }

    /** Deleting selected gallery. @return mixed */
    public function actionDeleteGallery()
    {
        if ( tools::isAuth() && tools::isAjax() && tools::isPost() ){
            $modelG = Gallery::find()->where(['id' => tools::getPost('id')])->one();
            $modelG->status = 0;
            $modelG->status_delete = 1;
            $modelG->save();
        } else{ return $this->redirect(['/site/index']); }
    }

    /** Searching gallery. @return mixed */
    public function actionSearchGallery()
    {
        if ( tools::isAuth() && tools::isAjax() && tools::isPost() ){
            $modelGC = GalleryContent::find()->where(['like', 'title', tools::getPost('value')])->all();
            $data = [];
            foreach ( $modelGC as $item ){
                $modelG = Gallery::find()->where(['status_delete' => 0])->andWhere(['id' => $item['gallery_id']])->one();
                if ( isset($modelG) ){
                    $data[] = $item;
                }
            }
            return $this->renderAjax('view-gallery-search', [
                'data' => $data
            ]);
        } else{ return $this->redirect(['/site/index']); }
    }


}
