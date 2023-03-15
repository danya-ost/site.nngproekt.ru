<?php

/** @var \yii\web\View $this */
/** @var string $content */

use frontend\assets\AppAsset;
use yii\helpers\Html;
use yii\helpers\Url;
use frontend\models\DepartmentContent;
use frontend\models\DepartmentWorker;
use frontend\models\UserData;
use frontend\models\UserAvatar;
use yii\widgets\ActiveForm;

$data_user_id = Yii::$app->user->id;

$modelUserData = UserData::find()->where(['user_id' => $data_user_id])->one();

$modelDepartmentWorker = DepartmentWorker::find()->where(['user_id' => $data_user_id])->one();
$department_key = isset($modelDepartmentWorker['data_key']) ? $modelDepartmentWorker['data_key'] : 0;
if( $department_key != 0 ){
    if ( $department_key == 'top' ){
        $department = DepartmentContent::find()->where(['department_id' => $modelDepartmentWorker['department_id']])->one();
    } else if ( $department_key == 'middle' ){
        $department = DepartmentContent::find()->where(['middle_id' => $modelDepartmentWorker['middle_id']])->one();
    } else {
        $department = DepartmentContent::find()->where(['bottom_id' => $modelDepartmentWorker['bottom_id']])->one();
    }
} else{
    $department = ' ';
}

$avatar = UserAvatar::find()->where(['user_id' => $data_user_id])->one();

$data_user = array(
    'surname' => $modelUserData['surname'],
    'firstname' => $modelUserData['firstname'],
    'job' => $modelUserData['job'],
    'department' => isset($department['abbreviation']) ? $department['abbreviation'] : ' ',
    'avatar' => $avatar['src'],
    'in_work' => $modelUserData['in_work'],
);

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
    <script src="<?= Url::to(['/js/jquery-3.6.0.min.js']) ?>"></script>
    <?php $this->head() ?>
</head>
<body class="max-w-[1920px] min-w-[375px] h-auto relative font-montserrat bg-[#F8F8F8]">
<?php $this->beginBody() ?>

<header class="w-full h-auto lg:h-[150px] absolute top-0 right-0 left-0 shadow-[0px_4px_30px_#0000001a] bg-white z-40 px-5 pl-5 lg:pl-[140px] pb-5 lg:pb-0 pt-5 lg:pt-9">
    <div class="container h-full flex items-start justify-between">
        <a href="<?= Url::to(['/home/index']) ?>" class="hidden lg:block font-bold text-2xl uppercase">
            Корпоративный портал <br> «Нижегороднефтегазпроект»
        </a>
        <a href="<?= Url::to(['/home/index']) ?>" class="block lg:hidden">
            <img src="<?= Url::to(['image/logo/mainlogo 1.png']) ?>" class="w-[42px]">
        </a>

        <div>
            <!-- nngp:navigation -->
            <div id="navigation_top" class="hidden lg:flex items-center justify-start mb-4">
                <a href="<?= Url::to(['/home/about']) ?>" id="a_about" class="font-medium text-xs uppercase text-black">О КОМПАНИИ</a>
                <i class="w-px h-5 bg-stone-400 block mx-5"></i>
                <a href="<?= Url::to(['/projects/index']) ?>" id="a_projects" class="font-medium text-xs uppercase text-black">ПРОЕКТЫ</a>
                <i class="w-px h-5 bg-stone-400 block mx-5"></i>
                <a href="<?= Url::to(['/docs/index']) ?>" id="a_docs" class="font-medium text-xs uppercase text-black">ДОКУМЕНТЫ</a>
                <i class="w-px h-5 bg-stone-400 block mx-5"></i>
                <a href="<?= Url::to(['/home/carrier']) ?>" id="a_carrier" class="font-medium text-xs uppercase text-black">КАРЬЕРА</a>
                <i class="w-px h-5 bg-stone-400 block mx-5"></i>
                <a href="<?= Url::to(['/services/index']) ?>" id="a_services" class="font-medium text-xs uppercase text-black">СЕРВИСЫ</a>
            </div>
            <!-- /nngp:navigation -->

            <div class="flex items-center justify-end xl:justify-between">
                <!-- nngp:input_search -->
                <div class="w-[340px] hidden xl:block relative">
                    <div class="relative">
                        <input type="text" name="main_search" placeholder="Борисов Андрей" class="border-solid border-b border-stone-400 w-full focus:outline-none focus:border-main-red text-black font-semibold text-sm">

                        <svg class="absolute right-0 top-2/4 -translate-y-2/4" width="16" height="16" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M17.8901 17.3599L12.4133 11.883C13.5509 10.6199 14.25 8.95461 14.25 7.12498C14.25 3.1963 11.0537 0 7.12501 0C3.1963 0 0 3.1963 0 7.12501C0 11.0537 3.1963 14.25 7.12501 14.25C8.95465 14.25 10.6199 13.5509 11.883 12.4133L17.3599 17.8901C17.4331 17.9634 17.5291 18 17.625 18C17.721 18 17.8169 17.9634 17.8902 17.8901C18.0366 17.7436 18.0366 17.5063 17.8901 17.3599ZM7.12501 13.5C3.61013 13.5 0.750023 10.6403 0.750023 7.12501C0.750023 3.60977 3.61013 0.749988 7.12501 0.749988C10.6399 0.749988 13.5 3.60974 13.5 7.12501C13.5 10.6403 10.6399 13.5 7.12501 13.5Z" fill="black"/>
                        </svg>

                        <div id="main_search_container" style="display: none;" class="w-full h-auto absolute z-[999] top-full bg-white shadow-lg border-r border-b border-l border-solid border-stone-300"></div>
                        <div id="main_search_loader" style="display: none;" class="w-full h-auto absolute z-[999] top-full bg-white shadow-lg border-r border-b border-l border-solid border-stone-300">
                            <div class="w-full h-auto flex items-center justify-center p-1">
                                <div class="spinner-border animate-spin inline-block w-5 h-5 border-2 rounded-full text-main-red" role="status">
                                    <span class="visually-hidden">Loading...</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <button name="main_type_search_users" class="font-bold text-main-red uppercase text-[10px]">
                        Поиск сотрудника
                    </button>
                    <button name="main_type_search_all" class="text-stone-500 uppercase text-[10px] ml-5">
                        Поиск ПО порталу
                    </button>
                </div>
                <!-- /nngp:input_search -->

                <button type="button" class="hidden lg:block xl:hidden">
                    <svg class="" width="16" height="16" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M17.8901 17.3599L12.4133 11.883C13.5509 10.6199 14.25 8.95461 14.25 7.12498C14.25 3.1963 11.0537 0 7.12501 0C3.1963 0 0 3.1963 0 7.12501C0 11.0537 3.1963 14.25 7.12501 14.25C8.95465 14.25 10.6199 13.5509 11.883 12.4133L17.3599 17.8901C17.4331 17.9634 17.5291 18 17.625 18C17.721 18 17.8169 17.9634 17.8902 17.8901C18.0366 17.7436 18.0366 17.5063 17.8901 17.3599ZM7.12501 13.5C3.61013 13.5 0.750023 10.6403 0.750023 7.12501C0.750023 3.60977 3.61013 0.749988 7.12501 0.749988C10.6399 0.749988 13.5 3.60974 13.5 7.12501C13.5 10.6403 10.6399 13.5 7.12501 13.5Z" fill="black"/>
                    </svg>
                </button>

                <!-- nngp:login -->
                <button type="button" data-nngp-name="#profile_bar" class="hidden lg:flex items-center justify-center">
                    <div class="text-right ml-4 xl:ml-8 mr-3">
                        <h6 class="font-bold text-sm lg:text-base"><?= $data_user['surname'] . ' ' . $data_user['firstname'] ?></h6>
                        <p class="font-light text-[8px] lg:text-xs text-stone-400"><?= $data_user['department'] ?></p>
                        <p class="font-light text-[8px] lg:text-xs text-stone-400"><?= $data_user['job'] ?></p>
                    </div>
                    <div class="w-[40px] lg:w-[61px] h-[40px] lg:h-[61px] rounded-full border-solid border border-main-red bg-no-repeat bg-center bg-cover relative" style="background-image: url('<?= Url::to([$data_user['avatar']]) ?>');">
                        <?php if ( $data_user['in_work'] == 1 ): ?>
                            <i class="block w-4 h-4 bg-lime-500 rounded-full absolute right-0 bottom-0"></i>
                        <?php else: ?>
                            <i class="block w-4 h-4 bg-main-red rounded-full absolute right-0 bottom-0"></i>
                        <?php endif; ?>
                    </div>
                </button>
                <!-- /nngp:login -->

                <!-- nngp:login_lg -->
                <a href="<?= Url::to(['/profile/index']) ?>" class="flex lg:hidden items-center justify-center">
                    <div class="text-right ml-4 xl:ml-8 mr-3">
                        <h6 class="font-bold text-sm lg:text-base"><?= $data_user['surname'] . ' ' . $data_user['firstname'] ?></h6>
                        <p class="font-light text-[8px] lg:text-xs text-stone-400"><?= $data_user['department'] ?></p>
                        <p class="font-light text-[8px] lg:text-xs text-stone-400"><?= $data_user['job'] ?></p>
                    </div>
                    <div class="w-[40px] lg:w-[61px] h-[40px] lg:h-[61px] rounded-full border-solid border border-main-red bg-no-repeat bg-center bg-cover relative" style="background-image: url('<?= Url::to([$data_user['avatar']]) ?>');">
                        <?php if ( $data_user['in_work'] == 1 ): ?>
                            <i class="block w-4 h-4 bg-lime-500 rounded-full absolute right-0 bottom-0"></i>
                        <?php else: ?>
                            <i class="block w-4 h-4 bg-main-red rounded-full absolute right-0 bottom-0"></i>
                        <?php endif; ?>
                    </div>
                </a>
                <!-- /nngp:login_lg -->
            </div>
        </div>
    </div>
</header>

<!-- nngp:bottom_bar -->
<div class="block lg:hidden w-full h-auto fixed right-0 bottom-0 left-0 shadow-[0px_4px_30px_#0000001a] bg-white z-[100]">
    <div class="container grid grid-cols-5 grid-rows-1">
        <a href="<?= Url::to(['/home/index']) ?>" id="page_home" data-mdb-ripple="true" class="block text-center py-4 text-stone-400">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-5 w-5 relative left-2/4 -translate-x-2/4">
                <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12l8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
            </svg>
            <h6 class="uppercase text-[8px] mt-2">Главная</h6>
        </a>

        <a href="<?= Url::to(['/notification/index']) ?>" id="page_notification" data-mdb-ripple="true" class="block text-center py-4 text-stone-400">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-5 w-5 relative left-2/4 -translate-x-2/4">
                <path stroke-linecap="round" stroke-linejoin="round" d="M10.34 15.84c-.688-.06-1.386-.09-2.09-.09H7.5a4.5 4.5 0 110-9h.75c.704 0 1.402-.03 2.09-.09m0 9.18c.253.962.584 1.892.985 2.783.247.55.06 1.21-.463 1.511l-.657.38c-.551.318-1.26.117-1.527-.461a20.845 20.845 0 01-1.44-4.282m3.102.069a18.03 18.03 0 01-.59-4.59c0-1.586.205-3.124.59-4.59m0 9.18a23.848 23.848 0 018.835 2.535M10.34 6.66a23.847 23.847 0 008.835-2.535m0 0A23.74 23.74 0 0018.795 3m.38 1.125a23.91 23.91 0 011.014 5.395m-1.014 8.855c-.118.38-.245.754-.38 1.125m.38-1.125a23.91 23.91 0 001.014-5.395m0-3.46c.495.413.811 1.035.811 1.73 0 .695-.316 1.317-.811 1.73m0-3.46a24.347 24.347 0 010 3.46" />
            </svg>
            <h6 class="uppercase text-[8px] mt-2">Уведомления</h6>
        </a>

        <a href="<?= Url::to(['/manual/index']) ?>" id="page_manual" data-mdb-ripple="true" class="block text-center py-4 text-stone-400">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-5 w-5 relative left-2/4 -translate-x-2/4">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z" />
            </svg>
            <h6 class="uppercase text-[8px] mt-2">Справочник</h6>
        </a>

        <a href="<?= Url::to(['/news/index']) ?>" id="page_news" data-mdb-ripple="true" class="block text-center py-4 text-stone-400">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-5 w-5 relative left-2/4 -translate-x-2/4">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 7.5h1.5m-1.5 3h1.5m-7.5 3h7.5m-7.5 3h7.5m3-9h3.375c.621 0 1.125.504 1.125 1.125V18a2.25 2.25 0 01-2.25 2.25M16.5 7.5V18a2.25 2.25 0 002.25 2.25M16.5 7.5V4.875c0-.621-.504-1.125-1.125-1.125H4.125C3.504 3.75 3 4.254 3 4.875V18a2.25 2.25 0 002.25 2.25h13.5M6 7.5h3v3H6v-3z" />
            </svg>
            <h6 class="uppercase text-[8px] mt-2">Новости</h6>
        </a>

        <a href="<?= Url::to(['/home/menu']) ?>" id="page_menu" data-mdb-ripple="true" class="block text-center py-4 text-stone-400">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-5 w-5 relative left-2/4 -translate-x-2/4">
                <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
            </svg>
            <h6 class="uppercase text-[8px] mt-2">Меню</h6>
        </a>
    </div>
</div>
<!-- /nngp:bottom_bar -->

<!-- nngp:aside_bar -->
<aside class="hidden w-[120px] h-[100vh] fixed top-0 bottom-0 left-0 bg-main-red z-50 lg:flex items-start justify-center pt-[30px]">
    <div>
        <a href="<?= Url::to(['/home/index']) ?>" class=""><img src="<?= Url::to(['image/logo/mainlogo 1.png']) ?>" class="w-20 mb-8"></a>
        <?php foreach ( \frontend\models\Navbar::find()->where(['status' => 1])->all() as $item ): ?>
            <?php $data = \frontend\models\NavbarContent::find()->where(['navbar_id' => $item['id']])->one(); ?>
            <?php if ( $data['data_key'] == 'left' ): ?>
                <a href="<?= $data['href'] ?>" class="w-[51px] h-[51px] bg-main-red-900 rounded-full flex items-center justify-center m-auto mb-5 relative animation-data-title">
                    <?= $data['svg'] ?>
                    <div class="animation-data-title_item">
                        <?= $data['title'] ?>
                    </div>
                </a>
            <?php endif; ?>
        <?php endforeach; ?>
    </div>
</aside>
<!-- /nngp:aside_bar -->

<!-- nngp:profile_bar -->
<div data-nngp-name="profile_bar" id="profile_bar" class="hidden lg:block w-[345px] h-screen rounded-l-3xl border-l border-solid border-stone-300 backdrop-blur-2xl py-16 pr-16 fixed top-0 right-0 bottom-0 z-[150]" style="visibility: hidden; opacity: 0;">
    <i class="block w-5 h-screen absolute top-0 right-0 bottom-0 bg-main-red"></i>
    <button type="button" data-nngp-name="*profile_bar" class="owl-main-banner-next hidden absolute right-0 top-2/4 -translate-y-2/4 z-30 bg-main-red w-[50px] h-[50px] sm:flex items-center justify-start pl-2 rounded-full">
        <svg width="21" height="8" viewBox="0 0 21 8" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M20.3536 4.35355C20.5488 4.15829 20.5488 3.84171 20.3536 3.64645L17.1716 0.464466C16.9763 0.269204 16.6597 0.269204 16.4645 0.464466C16.2692 0.659728 16.2692 0.976311 16.4645 1.17157L19.2929 4L16.4645 6.82843C16.2692 7.02369 16.2692 7.34027 16.4645 7.53553C16.6597 7.7308 16.9763 7.7308 17.1716 7.53553L20.3536 4.35355ZM0 4.5H20V3.5H0V4.5Z" fill="white"/>
        </svg>
    </button>

    <!-- nngp:login -->
    <div class="flex items-center justify-start pl-10">
        <div class="text-right mr-3">
            <h6 class="font-bold text-sm lg:text-base"><?= $data_user['surname'] . ' ' . $data_user['firstname'] ?></h6>
            <p class="font-light text-[8px] lg:text-xs text-stone-400"><?= $data_user['department'] ?></p>
            <p class="font-light text-[8px] lg:text-xs text-stone-400"><?= $data_user['job'] ?></p>
        </div>
        <div class="w-[40px] lg:w-[61px] h-[40px] lg:h-[61px] rounded-full border-solid border border-main-red bg-no-repeat bg-center bg-cover relative" style="background-image: url('<?= Url::to([$data_user['avatar']]) ?>');">
            <?php if ( $data_user['in_work'] == 1 ): ?>
                <i class="block w-4 h-4 bg-lime-500 rounded-full absolute right-0 bottom-0"></i>
            <?php else: ?>
                <i class="block w-4 h-4 bg-main-red rounded-full absolute right-0 bottom-0"></i>
            <?php endif; ?>
        </div>
    </div>
    <!-- /nngp:login -->

    <!-- nngp:profile_menu -->
    <div class="w-full h-auto mt-16">
        <a href="<?= Url::to(['/profile/index']) ?>" id="a_index" data-mdb-ripple="true" class="block text-left w-full py-3 px-3 pl-10 rounded-r-xl font-light text-xl">
            Мой профиль
        </a>
        <a href="<?= Url::to(['/profile/profile-edit']) ?>" id="a_profile-edit" data-mdb-ripple="true" class="block text-left w-full py-3 px-3 pl-10 rounded-r-xl font-light text-xl">
            Настрйки профиля
        </a>
        <?php if ( \frontend\tools\tools::isCan('adminHonor') || \frontend\tools\tools::isCan('adminBar') || \frontend\tools\tools::isCan('adminDepartment') || \frontend\tools\tools::idUser() == 1 ): ?>
            <a href="<?= Url::to(['/tools/index']) ?>" id="a_tools" data-mdb-ripple="true" class="block text-left w-full py-3 px-3 pl-10 rounded-r-xl font-light text-xl">
                Инструменты
            </a>
        <?php endif; ?>
        <a href="<?= Url::to(['/appeals/index']) ?>" id="a_appeals" data-mdb-ripple="true" class="block text-left w-full py-3 px-3 pl-10 rounded-r-xl font-light text-xl">
            Обращения к руководству
        </a>
        <a href="<?= Url::to(['/initiative/index']) ?>" id="a_initiative" data-mdb-ripple="true" class="block text-left w-full py-3 px-3 pl-10 rounded-r-xl font-light text-xl">
            Инициативы
        </a>
        <a href="<?= Url::to(['/notification/index']) ?>" id="a_notification" data-mdb-ripple="true" class="block text-left w-full py-3 px-3 pl-10 rounded-r-xl font-light text-xl">
            Уведомления
        </a>
        <?php $form = ActiveForm::begin([
            'method' => 'post',
            'action' => Url::to(['/site/logout'])
        ]); ?>
            <button type="submit" data-mdb-ripple="true" class="block text-left w-full py-3 px-3 pl-10 rounded-r-xl font-light text-xl">
                Выход
            </button>
        <?php $form = ActiveForm::end(); ?>
    </div>
    <!-- /nngp:profile_menu -->
</div>
<!-- /nngp:profile_bar -->

<main role="main" class="w-full h-auto pl-0 lg:pl-[120px] pt-[86px] lg:pt-[150px] min-h-screen">
    <?= $content ?>
</main>

<footer class="w-full h-auto bg-main-gray pl-5 lg:pl-[120px] pt-14 static sm:relative bottom-0 z-[60] px-5 mb-[72px] lg:mb-0">
    <div class="container">
        <div class="w-full h-auto block lg:flex items-start justify-start">
            <div>
                <a href="" class="flex items-center justify-start">
                    <img src="<?= Url::to(['/image/logo/mainlogo 1.png']) ?>" class="w-[74px]">
                    <p class="font-bold text-xs text-white ml-2 uppercase pr-2">
                        Корпоративный портал «Нижегороднефтегазпроект»
                    </p>
                </a>
                <div class="pt-7 pb-7 lg:pb-0">
                    <a href="">
                        <img src="<?= Url::to(['/image/elements/vk.png']) ?>" class="h-[30px]">
                    </a>
                </div>
            </div>

            <div class="pr-0 lg:pr-[65px]">
                <?php foreach ( \frontend\models\Navbar::find()->where(['status' => 1])->all() as $item ): ?>
                    <?php $data = \frontend\models\NavbarContent::find()->where(['navbar_id' => $item['id']])->one(); ?>
                    <?php if ( $data['data_key'] == 'bottom_01' ): ?>
                        <a href="<?= $data['href'] ?>" class="block font-light text-[11px] uppercase text-white hover:text-main-red whitespace-nowrap mb-4 lg:last:mb-0">
                            <?= $data['title'] ?>
                        </a>
                    <?php endif; ?>
                <?php endforeach; ?>
            </div>

            <div class="pr-0 lg:pr-[65px]">
                <?php foreach ( \frontend\models\Navbar::find()->where(['status' => 1])->all() as $item ): ?>
                    <?php $data = \frontend\models\NavbarContent::find()->where(['navbar_id' => $item['id']])->one(); ?>
                    <?php if ( $data['data_key'] == 'bottom_02' ): ?>
                        <a href="<?= $data['href'] ?>" class="block font-light text-[11px] uppercase text-white hover:text-main-red whitespace-nowrap mb-4 lg:last:mb-0">
                            <?= $data['title'] ?>
                        </a>
                    <?php endif; ?>
                <?php endforeach; ?>
            </div>

            <div class="pr-0 lg:pr-[55px]">
                <?php foreach ( \frontend\models\Navbar::find()->where(['status' => 1])->all() as $item ): ?>
                    <?php $data = \frontend\models\NavbarContent::find()->where(['navbar_id' => $item['id']])->one(); ?>
                    <?php if ( $data['data_key'] == 'bottom_03' ): ?>
                        <a href="<?= $data['href'] ?>" class="block font-light text-[11px] uppercase text-white hover:text-main-red whitespace-nowrap mb-4 lg:last:mb-0">
                            <?= $data['title'] ?>
                        </a>
                    <?php endif; ?>
                <?php endforeach; ?>
            </div>

            <div>
                <?php foreach ( \frontend\models\Navbar::find()->where(['status' => 1])->all() as $item ): ?>
                    <?php $data = \frontend\models\NavbarContent::find()->where(['navbar_id' => $item['id']])->one(); ?>
                    <?php if ( $data['data_key'] == 'bottom_04' ): ?>
                        <a href="<?= $data['href'] ?>" class="block font-light text-[11px] uppercase text-white hover:text-main-red whitespace-nowrap mb-4 lg:last:mb-0">
                            <?= $data['title'] ?>
                        </a>
                    <?php endif; ?>
                <?php endforeach; ?>
            </div>

        </div>

        <i class="block w-full h-px bg-stone-500 my-5"></i>

        <p class="w-full pb-5 font-light text-xs uppercase text-white text-center">
            «НИЖЕГОРОДНЕФТЕГАЗПРОЕКТ» © 2019 — 2022 ООО «ННГП»
        </p>
    </div>
</footer>

<script>

</script>

<?php

$script = <<<JS
    let type_search = 'users';
    $('button[name^=\'main_type_search_\']').on('click', function (){
        $('button[name^=\'main_type_search_\']').each(function (){
            $(this).removeClass('font-bold').removeClass('text-main-red').addClass('text-stone-500');
        });
        type_search = $(this).attr('name').replace('main_type_search_', '');
        $(this).addClass('text-main-red').addClass('font-bold').removeClass('text-stone-500');
    });

    $('input[name=\'main_search\']').on('input, keyup', function (){
        let value = $(this).val();
        let setAjax = $.ajax();
        if ( value.length >= 3 ){
            setAjax.abort();
            $.ajax({
                url: '/frontend/web/home/search',
                type: 'post',
                dataType: 'html',
                data: { 'type': type_search, 'value': value },
                beforeSend: function (){
                    $('#main_search_loader').show();
                    $('#main_search_container').show();
                },
                success: function (response){
                    $('#main_search_loader').hide();
                    $('#main_search_container').html(response);
                },
                error: function (response){
                    alert("Упс! Кажется произошла ошибка при загрузке данных. Пожалуйста, перезагрузите страницу или попробуйте позже!\\n\\nОтвет ошибки:\\n" + response['responseText']);
                    console.log(response);
                }
            });
        } else{
            $('#main_search_loader').hide();
            $('#main_search_container').hide();
        }
    });
JS;

$this->registerJs($script, \yii\web\View::POS_READY);

$this->endBody()
?>
</body>
</html>
<?php $this->endPage();
