<?php

/** @var \frontend\controllers\HomeController $data */

use yii\helpers\Url;

foreach ( $data as $item ):
?>
<a href="<?= Url::to(['/blog/view-post', 'b' => $item['id']]) ?>" class="grid grid-cols-1 grid-rows-2 px-5 hover:bg-white duration-300 ease-in-out">
    <div class="bg-no-repeat bg-center bg-cover" style="background-image: url('/frontend/web/<?= $item['thumb'] ?>');"></div>
    <div class="pt-4 py-6 pb-14">
        <div class="flex items-center justify-start">
            <div class="font-light text-xs text-stone-400"><?= $item['date'] ?></div>
            <div class="font-light text-xs text-stone-400 ml-3"><?= $item['user_fullname'] ?></div>
        </div>
        <p class="font-light text-xl text-black mt-5">
            <?= $item['title'] ?>
        </p>
    </div>
</a>
<?php
endforeach;
if ( count($data) == 0 ):
?>
    <div class="font-bold text-sm">
        Ничего не найдено...
    </div>
<?php
endif;