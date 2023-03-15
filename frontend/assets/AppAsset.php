<?php

namespace frontend\assets;

use yii\web\AssetBundle;
use yii\web\View;

/**
 * Main frontend application asset bundle.
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '/frontend/web';

    public $css = [
        'css/fonts-nngp.css',
        'css/skin.min.css',
        'css/all.min.css',
        'css/index.min.css',
        'css/animation.css',
        'css/owl.carousel.min.css',
        'css/owl.theme.default.min.css',
        'css/jquery.guillotine.css',
        'css/jquery-ui.css',
        'css/jquery-ui.structure.css',
        'css/jquery-ui.theme.css',
        'css/stylesheets.css'
    ];
    public $js = [
//        'js/jquery-3.6.0.min.js',
        'js/data.nngp.js',
        'js/appeals.js',
        'js/index.min.js',
        'js/jquery.mousewheel.min.js',
        'js/owl.carousel.min.js',
        'js/carousel.nnpg.js',
        'js/jquery.guillotine.min.js',
        'js/jquery-ui.min.js',
        'js/nngp.logs.js'
    ];
    public $depends = [
        'yii\web\YiiAsset',
//        'yii\bootstrap4\BootstrapAsset',
    ];
}
