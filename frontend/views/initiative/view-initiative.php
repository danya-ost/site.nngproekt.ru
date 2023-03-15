<?php

/** @var \yii\web\View $this */
/** @var \frontend\controllers\InitiativeController $data */

use yii\helpers\Url;

$this->title = $data['title'];
?>
<div class="container">
    <div class="max-w-[865px]">
        <h1 class="font-semibold text-2xl mb-4"><?= $data['title'] ?></h1>
        <span class="inline-block py-1.5 px-2.5 leading-none text-center whitespace-nowrap align-baseline font-bold text-white rounded mb-5" style="background-color: <?= $data['status_color'] ?>;"><?= $data['status'] ?></span>
        <h1 class="font-medium text-main-red uppercase text-sm mb-1"><?= $data['category'] ?></h1>
        <h1 class="font-medium text-stone-400 text-sm mb-2"><?= $data['date'] ?></h1>
        <h1 class="font-medium text-stone-400 text-sm mb-2">
            АВТОР: <a href="<?= Url::to(['/profile/view-user', 'u' => $data['author_id']]) ?>" class="ml-2 text-black relative after:block after:content-[''] after:absolute after:left-0 after:-bottom-px after:bg-black after:h-px after:w-full"><?= $data['author'] ?></a>
        </h1>
        <?php if ( $data['supportive'] != NULL ): ?>
            <h1 class="font-medium text-stone-400 text-sm mb-2">
                СОДЕЙСТВУЮЩИЙ: <a href="<?= Url::to(['/profile/view-user', 'u' => $data['supportive_id']]) ?>" class="ml-2 text-black relative after:block after:content-[''] after:absolute after:left-0 after:-bottom-px after:bg-black after:h-px after:w-full"><?= $data['supportive'] ?></a>
            </h1>
        <?php endif; ?>
        <i class="block h-px bg-stone-200 mt-4 mb-8"></i>

        <div>
            <label class="font-light text-xs text-stone-500 uppercase">Выявленная проблема:</label>
            <div class="font-medium text-sm text-black pt-2 pb-6">
                <?= $data['problem'] ?>
            </div>
        </div>

        <div>
            <label class="font-light text-xs text-stone-500 uppercase">Предлагаемое решение:</label>
            <div class="font-medium text-sm text-black pt-2 pb-6">
                <?= $data['solution'] ?>
            </div>
        </div>

        <div>
            <label class="font-light text-xs text-stone-500 uppercase">Ожидаемый эффект:</label>
            <div class="font-medium text-sm text-black pt-2 pb-6">
                <?= $data['effect'] ?>
            </div>
        </div>

        <i class="block h-px bg-stone-200 mt-4 mb-8"></i>

        <?php if ( $data['response'] != NULL ): ?>
            <div class="mb-96">
                <label class="font-light text-xs text-stone-500 uppercase">Комментарий к инициативе:</label>
                <div class="font-bold text-sm text-black pt-2 pb-6">
                    <?= $data['response'] ?>
                </div>
            </div>
        <?php endif; ?>

    </div>
</div>
<?php
$script = <<<JS
    $('#profile_bar').css({ visibility: 'visible' }).animate({
        opacity: 1
    }, 300);

    let location = 'initiative';
    $('#a_'+location).attr('class', 'block text-left w-full py-3 px-3 pl-10 rounded-r-xl font-bold text-main-red text-xl bg-[#F8F8F8] border-t border-r border-b border-solid border-stone-300 relative after:absolute after:content-[\'\'] after:bg-[#F8F8F8] after:w-4 after:-top-px after:-bottom-px after:-left-px after:border-t after:border-b after:border-solid after:border-stone-300');
JS;

$this->registerJs($script, \yii\web\View::POS_READY);