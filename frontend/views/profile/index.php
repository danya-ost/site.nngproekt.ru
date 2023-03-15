<?php

/** @var yii\web\View $this */
/** @var \frontend\models\UserData $data */

use yii\helpers\Url;

$this->title = 'Мой профиль';

?>

<div class="container">
    <div class="max-w-[865px]">
        <h1 class="font-semibold text-2xl">
            Мой профиль
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
                    <?= $data['department']['name'] ?> <br>
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

            <div class="relative">
                <h1 class="font-light text-xs text-stone-400 uppercase mb-2">
                    НАСТАВНИК
                </h1>
                <button type="button" id="mentor_open" class="block font-medium text-sm relative after:block after:content-[''] after:absolute after:left-0 after:-bottom-px after:bg-black after:h-px after:w-full">
                    <?= \frontend\models\UserData::find()->where(['user_id' => $data['mentor']])->one()['fullname'] ?>
                </button>

                <div id="mentor_container" style="display: none;" class="bg-white shadow-[0px_0px_10px_0px_#00000017] px-4 py-6 absolute -top-2/4 min-w-[345px] md:min-w-[536px]">
                    <button type="button" id="mentor_close" class="absolute top-2 right-2">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                    <div class="w-full h-auto grid grid-cols-[25%_75%] grid-rows-1">
                        <div>
                            <div class="w-[50px] md:w-[118px] h-[50px] md:h-[118px] border-2 md:border-[6px] border-solid border-[#C4C4C4] rounded-full bg-no-repeat bg-center bg-cover relative" style="background-image: url('/frontend/web/<?= \frontend\models\UserAvatar::find()->where(['user_id' => $data['mentor']])->one()['src'] ?>');">
                                <?php if ( \frontend\models\UserData::find()->where(['user_id' => $data['mentor']])->one()['in_work'] == 1 ): ?>
                                    <i class="block w-5 h-5 bg-lime-500 rounded-full absolute right-1 bottom-1"></i>
                                <?php else: ?>
                                    <i class="block w-5 h-5 bg-main-red rounded-full absolute right-1 bottom-1"></i>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="flex items-center justify-start">
                            <div>
                                <h1 class="font-light text-xl text-main-red">
                                    <?= \frontend\models\UserData::find()->where(['user_id' => $data['mentor']])->one()['fullname'] ?>
                                </h1>
                                <p class="font-medium text-sm text-black mt-1">
                                    <?= \frontend\models\UserData::find()->where(['user_id' => $data['mentor']])->one()['job'] ?>
                                </p>
                                <p class="inline-block font-light text-sm text-stone-400 mt-[10px] relative after:block after:content-[''] after:absolute after:left-0 after:-bottom-px after:bg-stone-300 after:h-px after:w-full">
                                    <?php
                                        $dep = \frontend\models\DepartmentWorker::find()->where(['user_id' => $data['mentor']])->one() ? \frontend\models\DepartmentWorker::find()->where(['user_id' => $data['mentor']])->one()['data_key'] : 0;
                                        if ( $dep != 0 ){
                                            if ( $dep == 'top' ){
                                                $dep = \frontend\models\DepartmentWorker::find()->where(['user_id' => $data['mentor']])->one()['department_id'];
                                                echo \frontend\models\DepartmentContent::find()->where(['department_id' => $dep])->one()['title'];
                                            } elseif( $dep == 'middle' ){
                                                $dep = \frontend\models\DepartmentWorker::find()->where(['user_id' => $data['mentor']])->one()['middle_id'];
                                                echo \frontend\models\DepartmentContent::find()->where(['middle_id' => $dep])->one()['title'];
                                            } else{
                                                $dep = \frontend\models\DepartmentWorker::find()->where(['user_id' => $data['mentor']])->one()['bottom_id'];
                                                echo \frontend\models\DepartmentContent::find()->where(['bottom_id' => $dep])->one()['title'];
                                            }
                                        } else{
                                            echo 'CMS';
                                        }
                                    ?>
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="w-full h-auto mt-3">

                        <div class="grid grid-cols-[15%_85%] md:grid-cols-[5%_95%] grid-rows-1">
                            <div>
                                <svg width="21" height="21" viewBox="0 0 21 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M20.8149 4.17212L14.446 10.5L20.8149 16.8278C20.93 16.5872 20.9999 16.3212 20.9999 16.0371V4.96286C20.9999 4.67874 20.93 4.41276 20.8149 4.17212Z" fill="#868686"/>
                                    <path d="M19.1543 3.11719H1.84567C1.56156 3.11719 1.29557 3.18704 1.05493 3.30217L9.19502 11.4012C9.91476 12.121 11.0852 12.121 11.8049 11.4012L19.945 3.30217C19.7044 3.18704 19.4384 3.11719 19.1543 3.11719Z" fill="#868686"/>
                                    <path d="M0.18498 4.17212C0.0698496 4.41276 0 4.67874 0 4.96286V16.0371C0 16.3212 0.0698496 16.5872 0.18498 16.8278L6.55385 10.5L0.18498 4.17212Z" fill="#868686"/>
                                    <path d="M13.5761 11.3699L12.6749 12.2712C11.4756 13.4704 9.52425 13.4704 8.32499 12.2712L7.4238 11.3699L1.05493 17.6978C1.29557 17.8129 1.56156 17.8828 1.84567 17.8828H19.1543C19.4384 17.8828 19.7044 17.8129 19.945 17.6978L13.5761 11.3699Z" fill="#868686"/>
                                </svg>
                            </div>
                            <div class="font-medium text-sm text-stone-400">
                                <?= \common\models\User::find()->where(['id' => $data['mentor']])->one()['email'] ?>
                            </div>
                        </div>

                        <div class="grid grid-cols-[15%_85%] md:grid-cols-[5%_95%] grid-rows-1 mt-3">
                            <div>
                                <svg width="21" height="21" viewBox="0 0 21 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M16.6934 0H4.30664C1.93196 0 0 1.93196 0 4.30664V16.6934C0 19.068 1.93196 21 4.30664 21H16.6934C19.068 21 21 19.068 21 16.6934V4.30664C21 1.93196 19.068 0 16.6934 0ZM16.05 15.1712L15.7205 15.7204C14.4391 17.0018 11.063 15.7033 8.17983 12.8202C5.29668 9.93702 3.99816 6.56098 5.27957 5.27953L5.82877 4.95001C6.32633 4.6515 6.97171 4.81281 7.27022 5.31038L8.0478 6.6063C8.29586 7.0197 8.23069 7.54884 7.88981 7.88977C7.40927 8.37031 7.40927 9.1494 7.88981 9.62989L11.3701 13.1102C11.8506 13.5907 12.6297 13.5907 13.1102 13.1102C13.4511 12.7693 13.9803 12.7041 14.3937 12.9522L15.6896 13.7297C16.1871 14.0283 16.3485 14.6737 16.05 15.1712Z" fill="#868686"/>
                                </svg>
                            </div>
                            <div class="font-medium text-sm text-stone-400">
                                <?= \frontend\models\UserTelephone::find()->where(['user_id' => $data['mentor']])->andWhere(['status_delete' => 0])->one()['telephone'] ?>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>

        <i class="block h-px bg-stone-300"></i>

        <div class="py-8">
            <h1 class="font-bold text-lg mb-8">
                Важная информация
            </h1>
            <div id="information" class="grid grid-cols-1 sm:grid-cols-3 lg:grid-cols-4 gap-5 gradient-load" style="min-height: 150px;"></div>
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
    
    $.ajax({
        url: '/frontend/web/profile/information',
        method: 'POST',
        dataType: 'html',
        data: 1,
        success: function(response){
            console.log(response);
            $('#information').removeClass('gradient-load').removeAttr('style').html(response);
        },
        error: function(response){
            alert('Произршла ошибка при загрузке данных. Обновите страницу!');
        }
    });
    
    $('#mentor_open').on('click', function (){
        $('#mentor_container').show();
    });
    
    $('#mentor_close').on('click', function (){
        $('#mentor_container').hide();
    });
JS;

$this->registerJs($script, \yii\web\View::POS_READY);
