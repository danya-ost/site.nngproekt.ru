<?php

/** @var \yii\web\View $this */
/** @var \frontend\models\Notification $data */

$this->title = 'Уведомления';
?>
<div class="container h-auto pb-14">
    <div class="max-w-[865px]">
        <div class="w-full ha-auto mb-8">
            <h1 class="font-bold text-2xl">Уведомления</h1>
        </div>

        <?php foreach ( $data as $item ): ?>
            <div class="flex items-start justify-start py-5 border-b border-solid border-stone-300 last:border-none">
                <div class="pr-2 pt-1">
                    <i class="block w-3 h-3 bg-main-red rounded-full"></i>
                </div>
                <div>
                    <h1 class="font-medium text-sm"><?= $item['message'] ?></h1>
                    <h1 class="font-light text-xs text-stone-400"><?= date( 'd.m.Y H:i', strtotime($item['date_add']) ) ?></h1>
                </div>
            </div>
        <?php endforeach; ?>
        <?php if ( count($data) == 0 ): ?>
            <div class="font-bold text-sm">
                Ничего не найдено...
            </div>
        <?php endif; ?>

    </div>
</div>
<?php
$script = <<<JS
    $('#profile_bar').css({ visibility: 'visible' }).animate({
        opacity: 1
    }, 300);

    $('#page_notification').removeClass('text-stone-400').addClass('text-main-red').addClass('font-bold');

    let location = 'notification';
    $('#a_'+location).attr('class', 'block text-left w-full py-3 px-3 pl-10 rounded-r-xl font-bold text-main-red text-xl bg-[#F8F8F8] border-t border-r border-b border-solid border-stone-300 relative after:absolute after:content-[\'\'] after:bg-[#F8F8F8] after:w-4 after:-top-px after:-bottom-px after:-left-px after:border-t after:border-b after:border-solid after:border-stone-300');
JS;

$this->registerJs($script, \yii\web\View::POS_READY);