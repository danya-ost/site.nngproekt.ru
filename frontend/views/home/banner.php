<?php

/* @var yii\web\View $this */
/* @var frontend\controllers\NewsController $data */

use yii\helpers\Url;

foreach ( $data as $item ):
?>
<div class="item h-[450px] sm:h-[412px] block lg:grid grid-cols-[60%_40%] grid-rows-1 relative">
    <div class="block bg-no-repeat bg-center bg-cover absolute lg:static top-0 right-0 bottom-0 left-0 h-full brightness-[.6] lg:brightness-100" style="background-image: url('<?= $item['image_src'] ?>');"></div>
    <div class="absolute lg:static top-0 right-0 bottom-0 left-0 h-full py-10 p-5 sm:p-10 lg:bg-white">
        <h1 class="font-bold text-3xl sm:text-4xl mb-3 text-white lg:text-black">
            <?= $item['title'] ?>
        </h1>
        <p class="font-medium text-sm mb-5 text-white lg:text-black">
            <?= $item['annotation'] ?>
        </p>
        <a href="<?= Url::to(['/news/view-news', 'n' => $item['id']]) ?>" class="inline-block px-10 py-3 text-white uppercase font-medium text-xs rounded-xl shadow-[0px_15px_40px_#00000040] bg-black hover:bg-main-red duration-300 ease-in-out">
            ПОДРОБНЕЕ
        </a>
    </div>
</div>
<?php
endforeach;
if ( count($data) == 0 ):
    ?>
    <div class="font-bold text-sm px-14 py-10">
        Здесь пока ничего нет...
    </div>
<?php
endif;