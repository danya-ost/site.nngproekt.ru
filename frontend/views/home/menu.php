<?php

/** @var \yii\web\View $this */
/** @var \frontend\controllers\HomeController $data */

use yii\helpers\Url;

?>
<div class="container px-2">

    <div class="mb-10 last:mb-8">
        <h1 class="font-bold text-base text-black mb-1">Основное</h1>
        <div class="w-full h-auto bg-white rounded-xl shadow">

            <a href="<?= Url::to(['/home/about']) ?>" data-mdb-ripple="true" class="flex items-center justify-between py-3 px-5">
                <div class="text-sm text-stone-700">О компании</div>
                <div>
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 text-stone-300">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
                    </svg>
                </div>
            </a>
            <i class="block px-5 block last:hidden"><i class="block h-px bg-stone-200"></i></i>

            <a href="<?= Url::to(['/projects/index']) ?>" data-mdb-ripple="true" class="flex items-center justify-between py-3 px-5">
                <div class="text-sm text-stone-700">Проекты</div>
                <div>
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 text-stone-300">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
                    </svg>
                </div>
            </a>
            <i class="block px-5 block last:hidden"><i class="block h-px bg-stone-200"></i></i>

            <a href="<?= Url::to(['/docs/index']) ?>" data-mdb-ripple="true" class="flex items-center justify-between py-3 px-5">
                <div class="text-sm text-stone-700">Документы</div>
                <div>
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 text-stone-300">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
                    </svg>
                </div>
            </a>
            <i class="block px-5 block last:hidden"><i class="block h-px bg-stone-200"></i></i>

            <a href="<?= Url::to(['/home/carrier']) ?>" data-mdb-ripple="true" class="flex items-center justify-between py-3 px-5">
                <div class="text-sm text-stone-700">Карьера</div>
                <div>
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 text-stone-300">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
                    </svg>
                </div>
            </a>
            <i class="block px-5 block last:hidden"><i class="block h-px bg-stone-200"></i></i>

            <a href="<?= Url::to(['/services/index']) ?>" data-mdb-ripple="true" class="flex items-center justify-between py-3 px-5">
                <div class="text-sm text-stone-700">Сервисы</div>
                <div>
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 text-stone-300">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
                    </svg>
                </div>
            </a>
            <i class="block px-5 block last:hidden"><i class="block h-px bg-stone-200"></i></i>

        </div>
    </div>

    <div class="mb-10 last:mb-8">
        <h1 class="font-bold text-base text-black mb-1">Профиль</h1>
        <div class="w-full h-auto bg-white rounded-xl shadow">

            <a href="<?= Url::to(['/profile/index']) ?>" data-mdb-ripple="true" class="flex items-center justify-between py-3 px-5">
                <div class="text-sm text-stone-700">Мой профиль</div>
                <div>
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 text-stone-300">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
                    </svg>
                </div>
            </a>
            <i class="block px-5 block last:hidden"><i class="block h-px bg-stone-200"></i></i>

            <a href="<?= Url::to(['/profile/profile-edit']) ?>" data-mdb-ripple="true" class="flex items-center justify-between py-3 px-5">
                <div class="text-sm text-stone-700">Настройки профиля</div>
                <div>
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 text-stone-300">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
                    </svg>
                </div>
            </a>
            <i class="block px-5 block last:hidden"><i class="block h-px bg-stone-200"></i></i>

            <?php if ( \frontend\tools\tools::isCan('adminHonor') || \frontend\tools\tools::isCan('adminBar') || \frontend\tools\tools::isCan('adminDepartment') || \frontend\tools\tools::idUser() == 1 ): ?>
                <a href="<?= Url::to(['/tools/index']) ?>" data-mdb-ripple="true" class="flex items-center justify-between py-3 px-5">
                    <div class="text-sm text-stone-700">Инструменты</div>
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 text-stone-300">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
                        </svg>
                    </div>
                </a>
                <i class="block px-5 block last:hidden"><i class="block h-px bg-stone-200"></i></i>
            <?php endif; ?>

            <a href="<?= Url::to(['/appeals/index']) ?>" data-mdb-ripple="true" class="flex items-center justify-between py-3 px-5">
                <div class="text-sm text-stone-700">Обращения к руководству</div>
                <div>
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 text-stone-300">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
                    </svg>
                </div>
            </a>
            <i class="block px-5 block last:hidden"><i class="block h-px bg-stone-200"></i></i>

            <a href="<?= Url::to(['/initiative/index']) ?>" data-mdb-ripple="true" class="flex items-center justify-between py-3 px-5">
                <div class="text-sm text-stone-700">Инициативы</div>
                <div>
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 text-stone-300">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
                    </svg>
                </div>
            </a>
            <i class="block px-5 block last:hidden"><i class="block h-px bg-stone-200"></i></i>

        </div>
    </div>

    <div class="mb-10 last:mb-8">
        <h1 class="font-bold text-base text-black mb-1">Дополнительно</h1>
        <div class="w-full h-auto bg-white rounded-xl shadow">

            <?php foreach ( \frontend\models\Navbar::find()->where(['status' => 1])->all() as $item ): ?>
                <?php if ( \frontend\models\NavbarContent::find()->where(['navbar_id' => $item['id']])->one()['data_key'] == 'left' ): ?>
                    <a href="<?= \frontend\models\NavbarContent::find()->where(['navbar_id' => $item['id']])->one()['href'] ?>" data-mdb-ripple="true" class="flex items-center justify-between py-3 px-5">
                        <div class="text-sm text-stone-700"><?= \frontend\models\NavbarContent::find()->where(['navbar_id' => $item['id']])->one()['title'] ?></div>
                        <div>
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 text-stone-300">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
                            </svg>
                        </div>
                    </a>
                    <i class="block px-5 block last:hidden"><i class="block h-px bg-stone-200"></i></i>
                <?php endif; ?>
            <?php endforeach; ?>

        </div>
    </div>

</div>
<?php
$script = <<<JS
    $('#page_name').removeClass('text-stone-400').addClass('text-main-red').addClass('font-bold');
JS;

$this->registerJs($script, \yii\web\View::POS_READY);