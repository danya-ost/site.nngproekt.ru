<?php

/** @var \yii\web\View $this */
/** @var string $content */

use frontend\assets\AppAsset;
use yii\bootstrap4\Html;
use yii\helpers\Url;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
    <!DOCTYPE html>
    <html lang="<?= Yii::$app->language ?>" class="h-100">
    <head>
        <meta charset="<?= Yii::$app->charset ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <?php $this->registerCsrfMetaTags() ?>
        <title><?= Html::encode($this->title) ?></title>
        <link rel="apple-touch-icon" sizes="76x76" href="/frontend/web/icon/apple-touch-icon.png">
        <link rel="icon" type="image/png" sizes="32x32" href="/frontend/web/icon/favicon-32x32.png">
        <link rel="icon" type="image/png" sizes="16x16" href="/frontend/web/icon/favicon-16x16.png">
        <link rel="manifest" href="/frontend/web/icon/site.webmanifest">
        <link rel="mask-icon" href="/frontend/web/icon/safari-pinned-tab.svg" color="#5bbad5">
        <meta name="msapplication-TileColor" content="#ffffff">
        <meta name="theme-color" content="#ffffff">
        <?php $this->head() ?>
    </head>
    <body class="max-w-[1920px] min-w-[375px] h-auto relative font-montserrat bg-[#F8F8F8]">
    <?php $this->beginBody() ?>

    <main role="main" class="w-full h-auto min-h-screen bg-no-repeat bg-center bg-cover" style="background-image: url('<?= Url::to(['/image/bg/bg_01.png']) ?>');">
        <?= $content ?>
    </main>

    <script>

    </script>

    <?php $this->endBody() ?>
    </body>
    </html>
<?php $this->endPage();
