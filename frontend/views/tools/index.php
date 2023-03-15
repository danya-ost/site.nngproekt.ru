<?php

/** @var yii\web\View $this */

use yii\helpers\Url;

$this->title = 'Инструменты';
?>

<div class="container h-auto">

    <!-- nngp:title_page -->
    <div class="w-full ha-auto mb-12">
        <h1 class="font-bold text-4xl uppercase">Инструменты</h1>
    </div>
    <!-- /nngp:title_page -->

    <!-- nngp:services -->
    <div class="w-full h-auto grid grid-cols-1 gap-3 mb-24">

        <?php if ( \frontend\tools\tools::isCan('adminHonor') ): ?>
            <a href="<?= Url::to(['/honor/index']) ?>" class="bg-white hover:bg-main-red shadow-[0px_0px_10px_0px_#00000017] h-[110px] grid grid-cols-[25%_75%] grid-rows-1 text-black hover:text-white duration-300 ease-in-out">
                <div class="relative">
                    <div class="w-[45px] h-[45px] flex items-center justify-center rounded-full absolute top-2/4 -translate-y-2/4 left-2/4 -translate-x-2/4">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-8 h-8">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.59 14.37a6 6 0 01-5.84 7.38v-4.8m5.84-2.58a14.98 14.98 0 006.16-12.12A14.98 14.98 0 009.631 8.41m5.96 5.96a14.926 14.926 0 01-5.841 2.58m-.119-8.54a6 6 0 00-7.381 5.84h4.8m2.581-5.84a14.927 14.927 0 00-2.58 5.84m2.699 2.7c-.103.021-.207.041-.311.06a15.09 15.09 0 01-2.448-2.448 14.9 14.9 0 01.06-.312m-2.24 2.39a4.493 4.493 0 00-1.757 4.306 4.493 4.493 0 004.306-1.758M16.5 9a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0z" />
                        </svg>
                    </div>
                </div>
                <div class="flex items-center justify-start">
                    <span>
                        <div class="text-xs text-gray-400">Администрирование</div>
                        <div class="font-medium text-sm md:text-md uppercase">Доска почета</div>
                    </span>
                </div>
            </a>
        <?php endif; ?>

        <?php if ( \frontend\tools\tools::isCan('adminBar') ): ?>
            <a href="<?= Url::to(['/bar/index']) ?>" class="bg-white hover:bg-main-red shadow-[0px_0px_10px_0px_#00000017] h-[110px] grid grid-cols-[25%_75%] grid-rows-1 text-black hover:text-white duration-300 ease-in-out">
                <div class="relative">
                    <div class="w-[45px] h-[45px] flex items-center justify-center rounded-full absolute top-2/4 -translate-y-2/4 left-2/4 -translate-x-2/4">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-8 h-8">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6A2.25 2.25 0 016 3.75h2.25A2.25 2.25 0 0110.5 6v2.25a2.25 2.25 0 01-2.25 2.25H6a2.25 2.25 0 01-2.25-2.25V6zM3.75 15.75A2.25 2.25 0 016 13.5h2.25a2.25 2.25 0 012.25 2.25V18a2.25 2.25 0 01-2.25 2.25H6A2.25 2.25 0 013.75 18v-2.25zM13.5 6a2.25 2.25 0 012.25-2.25H18A2.25 2.25 0 0120.25 6v2.25A2.25 2.25 0 0118 10.5h-2.25a2.25 2.25 0 01-2.25-2.25V6zM13.5 15.75a2.25 2.25 0 012.25-2.25H18a2.25 2.25 0 012.25 2.25V18A2.25 2.25 0 0118 20.25h-2.25A2.25 2.25 0 0113.5 18v-2.25z" />
                        </svg>
                    </div>
                </div>
                <div class="flex items-center justify-start">
                    <span>
                        <div class="text-xs text-gray-400">Администрирование</div>
                        <div class="font-medium text-sm md:text-md uppercase">Редактор бара</div>
                    </span>
                </div>
            </a>
        <?php endif; ?>

        <?php if ( \frontend\tools\tools::isCan('adminDepartment') ): ?>
            <a href="<?= Url::to(['/department/admin']) ?>" class="bg-white hover:bg-main-red shadow-[0px_0px_10px_0px_#00000017] h-[110px] grid grid-cols-[25%_75%] grid-rows-1 text-black hover:text-white duration-300 ease-in-out">
                <div class="relative">
                    <div class="w-[45px] h-[45px] flex items-center justify-center rounded-full absolute top-2/4 -translate-y-2/4 left-2/4 -translate-x-2/4">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-8 h-8">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 21h19.5m-18-18v18m10.5-18v18m6-13.5V21M6.75 6.75h.75m-.75 3h.75m-.75 3h.75m3-6h.75m-.75 3h.75m-.75 3h.75M6.75 21v-3.375c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21M3 3h12m-.75 4.5H21m-3.75 3.75h.008v.008h-.008v-.008zm0 3h.008v.008h-.008v-.008zm0 3h.008v.008h-.008v-.008z" />
                        </svg>
                    </div>
                </div>
                <div class="flex items-center justify-start">
                    <span>
                        <div class="text-xs text-gray-400">Администрирование</div>
                        <div class="font-medium text-sm md:text-md uppercase">Департаменты</div>
                    </span>
                </div>
            </a>
        <?php endif; ?>

        <?php if ( \frontend\tools\tools::idUser() == 1 ): ?>
            <a href="<?= Url::to(['/rbac/index']) ?>" class="bg-white hover:bg-main-red shadow-[0px_0px_10px_0px_#00000017] h-[110px] grid grid-cols-[25%_75%] grid-rows-1 text-black hover:text-white duration-300 ease-in-out">
                <div class="relative">
                    <div class="w-[45px] h-[45px] flex items-center justify-center rounded-full absolute top-2/4 -translate-y-2/4 left-2/4 -translate-x-2/4">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-8 h-8">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 10-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 002.25-2.25v-6.75a2.25 2.25 0 00-2.25-2.25H6.75a2.25 2.25 0 00-2.25 2.25v6.75a2.25 2.25 0 002.25 2.25z" />
                        </svg>
                    </div>
                </div>
                <div class="flex items-center justify-start">
                    <span>
                        <div class="text-xs text-gray-400">Администрирование</div>
                        <div class="font-medium text-sm md:text-md uppercase">Контроль доступа</div>
                    </span>
                </div>
            </a>
        <?php endif; ?>

        <?php if ( \frontend\tools\tools::idUser() == 1 ): ?>
            <a href="<?= Url::to(['/rbac/ldap-to-rbac']) ?>" class="bg-white hover:bg-main-red shadow-[0px_0px_10px_0px_#00000017] h-[110px] grid grid-cols-[25%_75%] grid-rows-1 text-black hover:text-white duration-300 ease-in-out">
                <div class="relative">
                    <div class="w-[45px] h-[45px] flex items-center justify-center rounded-full absolute top-2/4 -translate-y-2/4 left-2/4 -translate-x-2/4">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-8 h-8">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5m-13.5-9L12 3m0 0l4.5 4.5M12 3v13.5" />
                        </svg>
                    </div>
                </div>
                <div class="flex items-center justify-start">
                    <span>
                        <div class="text-xs text-gray-400">Администрирование</div>
                        <div class="font-medium text-sm md:text-md uppercase">Вгрузка пользователей</div>
                    </span>
                </div>
            </a>
        <?php endif; ?>

    </div>
    <!-- /nngp:services -->

</div>

<?php
$script = <<<JS
    let location = 'tools';
    $('#a_'+location).attr('class', 'block text-left w-full py-3 px-3 pl-10 rounded-r-xl font-bold text-main-red text-xl bg-[#F8F8F8] border-t border-r border-b border-solid border-stone-300 relative after:absolute after:content-[\'\'] after:bg-[#F8F8F8] after:w-4 after:-top-px after:-bottom-px after:-left-px after:border-t after:border-b after:border-solid after:border-stone-300');
    
    // $.ajax({
    //     url: '/frontend/web/profile/information',
    //     method: 'POST',
    //     dataType: 'html',
    //     data: 1,
    //     success: function(response){
    //         console.log(response);
    //         $('#information').removeClass('gradient-load').removeAttr('style').html(response);
    //     },
    //     error: function(response){
    //         alert('Произршла ошибка при загрузке данных. Обновите страницу!');
    //     }
    // });
JS;

$this->registerJs($script, \yii\web\View::POS_READY);
