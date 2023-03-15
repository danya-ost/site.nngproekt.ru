<?php

/** @var yii\web\View $this */
/** @var \frontend\models\UserData $data */

use yii\helpers\Url;

$this->title = 'Мой профиль';

?>

<div class="container">
    <div class="max-w-[865px]">
        <h1 class="font-semibold text-2xl">
            Профиль
        </h1>

        <div class="py-8">

            <div class="block sm:inline-block align-middle relative left-2/4 sm:left-auto -translate-x-2/4 sm:-translate-x-0 mr-9 w-[120px] sm:w-[165px] h-[120px] sm:h-[165px] bg-no-repeat bg-center bg-cover rounded-full relative" style="background-image: url('<?= Url::to([$data['avatar']]) ?>');">
                <?php if ( $data['in_work'] == 1 ): ?>
                    <i class="block w-5 h-5 bg-lime-500 rounded-full absolute right-4 bottom-4"></i>
                <?php else: ?>
                    <i class="block w-5 h-5 bg-main-red rounded-full absolute right-4 bottom-4"></i>
                <?php endif; ?>
            </div>

            <div class="block sm:inline-block align-middle ">
                <h1 class="font-bold text-lg text-center sm:text-left">
                    <?= $data['surname'] . ' ' . $data['firstname'] ?>
                </h1>

                <h2 class="font-medium text-sm text-center sm:text-left">
                    <?= isset($data['department']['name']) ? $data['department']['name'] . '<br>' : NULL ?>
                    <?= $data['job'] ?>
                </h2>
            </div>

        </div>

        <i class="block h-px bg-stone-300"></i>

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-5 py-6">
            <div>
                <h1 class="font-light text-xs text-stone-400 uppercase mb-2">
                    КОНТАКТЫ
                </h1>
                <?php foreach ( $data['telephone'] as $tel ): ?>
                    <a href="tel:<?= $tel['telephone'] ?>" class="block font-medium text-sm mb-1">
                        <?= $tel['telephone'] ?>
                    </a>
                <?php endforeach; ?>
                <a href="mailto:IvanovaAnna_tech@nngp.com" class="block font-medium text-sm">
                    <?= $data['email'] ?>
                </a>
            </div>

            <div>
                <h1 class="font-light text-xs text-stone-400 uppercase mb-2">
                    ДАТА ПРИЕМА НА РАБОТУ
                </h1>
                <div class="font-medium text-sm">
                    <?= $data['recruitment'] ?>
                </div>
            </div>

            <div>
                <h1 class="font-light text-xs text-stone-400 uppercase mb-2">
                    НАСТАВНИК
                </h1>
                <button type="button" class="block font-medium text-sm relative after:block after:content-[''] after:absolute after:left-0 after:-bottom-px after:bg-black after:h-px after:w-full">
                    <?= $data['mentor'] ?>
                </button>
            </div>
        </div>

    </div>
</div>

<?php
$script = <<<JS

    $('#profile_bar').css({ visibility: 'visible' }).animate({
        opacity: 1
    }, 300);

    let location = 'index';
    $('#a_'+location).attr('class', 'block text-left w-full py-3 px-3 pl-10 rounded-r-xl font-bold text-main-red text-xl bg-[#F8F8F8] border-t border-r border-b border-solid border-stone-300 relative after:absolute after:content-[\'\'] after:bg-[#F8F8F8] after:w-4 after:-top-px after:-bottom-px after:-left-px after:border-t after:border-b after:border-solid after:border-stone-300');
    
JS;

$this->registerJs($script, \yii\web\View::POS_READY);
