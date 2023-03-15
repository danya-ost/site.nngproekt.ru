<?php

/* @var yii\web\View $this */
/* @var frontend\controllers\TalentsController $data */
use yii\helpers\Url;

foreach ( $data as $item ):
?>
<a href="<?= Url::to(['/talents/view-news', 'n' => $item['id']]) ?>" class="grid grid-cols-1 grid-rows-[40%_60%] h-[323px] relative rounded-xl bg-white overflow-hidden">
    <div class="bg-no-repeat bg-top bg-cover relative" style="background-image: url('<?= $item['image_src'] ?>');">
        <div class="absolute right-0 bottom-0 font-light text-xs text-white w-44 bg-main-red py-1 flex items-center justify-center">
            <span><?= $item['category'] ?></span>
        </div>
    </div>
    <div class="p-4 pb-16">
        <div class="flex items-center justify-start mb-3">
            <span class="font-light text-xs text-stone-400 mr-3"><?= $item['date_add'] ?></span>
            <span class="flex items-center justify-start">
                <svg width="14" height="9" viewBox="0 0 14 9" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M7 9C11.1794 9 14 5.56268 14 4.49738C14 3.43732 11.1743 0 7 0C2.88235 0 0 3.43732 0 4.49738C0 5.56268 2.87721 9 7 9ZM7.00515 7.36268C5.43529 7.36268 4.18456 6.05598 4.17941 4.50262C4.17426 2.89679 5.43529 1.63732 7.00515 1.63732C8.56471 1.63732 9.82574 2.90204 9.82574 4.50262C9.82574 6.05598 8.56471 7.36268 7.00515 7.36268ZM7.00515 5.56793C7.58162 5.56793 8.06029 5.08513 8.06029 4.50262C8.06029 3.91487 7.58162 3.42682 7.00515 3.42682C6.41838 3.42682 5.94485 3.91487 5.94485 4.50262C5.94485 5.08513 6.41838 5.56793 7.00515 5.56793Z" fill="#D7D5D5"/>
                </svg>
                <span class="font-light text-xs text-stone-400 ml-1"><?= $item['views'] ?></span>
            </span>
        </div>
        <div class="font-light text-xl text-black leading-6">
            <?= $item['title'] ?>
        </div>
        <div class="font-light text-sm text-black uppercase absolute bottom-4 left-4 after:block after:content-[''] after:absolute after:left-0 after:-bottom-px after:bg-black after:h-px after:w-full">ЧИТАТЬ</div>
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