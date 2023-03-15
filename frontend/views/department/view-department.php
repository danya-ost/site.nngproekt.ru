<?php

/** @var \yii\web\View $this */
/** @var \frontend\controllers\DepartmentController $departments_top */
/** @var \frontend\controllers\DepartmentController $director */

use yii\helpers\Url;

$first_middle = 0;

$this->title = $departments_top['title'];
?>
<div class="container h-auto pb-14">

    <div class="w-full ha-auto mb-6">
        <h1 class="font-bold text-2xl sm:text-4xl">
            <?= $departments_top['title'] ?>
        </h1>
    </div>

    <?php if ( $director ): ?>
        <div class="px-6 py-9 mb-9">
            <div class="inline-block align-middle pr-6 relative">
                <div class="w-[120px] sm:w-[160px] h-[120px] sm:h-[160px] rounded-full bg-no-repeat bg-cover bg-center" style="background-image: url('/frontend/web/<?= $director['avatar'] ?>');"></div>
            </div>
            <div class="inline-block align-middle">
                <h1 class="font-light text-xl text-main-red mb-1">
                    Руководитель департамента
                </h1>
                <h2 class="font-medium text-sm text-black mb-3">
                    <?= $director['fullname'] ?>
                </h2>

                <div class="mb-3">
                    <div class="inline-block align-middle mr-2">
                        <svg width="21" height="21" viewBox="0 0 21 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M20.8149 4.17212L14.446 10.5L20.8149 16.8278C20.93 16.5872 20.9999 16.3212 20.9999 16.0371V4.96286C20.9999 4.67874 20.93 4.41276 20.8149 4.17212Z" fill="#868686"/>
                            <path d="M19.1543 3.11719H1.84567C1.56156 3.11719 1.29557 3.18704 1.05493 3.30217L9.19502 11.4012C9.91476 12.121 11.0852 12.121 11.8049 11.4012L19.945 3.30217C19.7044 3.18704 19.4384 3.11719 19.1543 3.11719Z" fill="#868686"/>
                            <path d="M0.18498 4.17212C0.0698496 4.41276 0 4.67874 0 4.96286V16.0371C0 16.3212 0.0698496 16.5872 0.18498 16.8278L6.55385 10.5L0.18498 4.17212Z" fill="#868686"/>
                            <path d="M13.5761 11.3699L12.6749 12.2712C11.4756 13.4704 9.52425 13.4704 8.32499 12.2712L7.4238 11.3699L1.05493 17.6978C1.29557 17.8129 1.56156 17.8828 1.84567 17.8828H19.1543C19.4384 17.8828 19.7044 17.8129 19.945 17.6978L13.5761 11.3699Z" fill="#868686"/>
                        </svg>
                    </div>
                    <a href="mailto:<?= $director['email'] ?>" class="font-medium text-sm text-stone-400 inline-block align-middle">
                        <?= $director['email'] ?>
                    </a>
                </div>

                <div>
                    <div class="inline-block align-middle mr-2">
                        <svg width="21" height="21" viewBox="0 0 21 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M16.6934 0H4.30664C1.93196 0 0 1.93196 0 4.30664V16.6934C0 19.068 1.93196 21 4.30664 21H16.6934C19.068 21 21 19.068 21 16.6934V4.30664C21 1.93196 19.068 0 16.6934 0ZM16.05 15.1712L15.7205 15.7204C14.4391 17.0018 11.063 15.7033 8.17983 12.8202C5.29668 9.93702 3.99816 6.56098 5.27957 5.27953L5.82877 4.95001C6.32633 4.6515 6.97171 4.81281 7.27022 5.31038L8.0478 6.6063C8.29586 7.0197 8.23069 7.54884 7.88981 7.88977C7.40927 8.37031 7.40927 9.1494 7.88981 9.62989L11.3701 13.1102C11.8506 13.5907 12.6297 13.5907 13.1102 13.1102C13.4511 12.7693 13.9803 12.7041 14.3937 12.9522L15.6896 13.7297C16.1871 14.0283 16.3485 14.6737 16.05 15.1712Z" fill="#868686"/>
                        </svg>
                    </div>
                    <div class="font-medium text-sm text-stone-400 inline-block align-middle">
                        <?= $director['telephone'] ?>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>

    <?php if ( count(\frontend\models\DepartmentChildren::find()->where(['parent_key' => 'top'])->andWhere(['parent_id' => $departments_top['id']])->andWhere(['child_key' => 'middle'])->all()) > 0 ): ?>
        <div class="pt-6 pb-9 mb-9">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

                <?php foreach ( \frontend\models\DepartmentChildren::find()->where(['parent_key' => 'top'])->andWhere(['parent_id' => $departments_top['id']])->andWhere(['child_key' => 'middle'])->all() as $index => $middle ): ?>
                    <?php if ( isset($_GET['m']) ): ?>
                        <?php if ( $_GET['m'] == $middle['child_id'] ): ?>
                            <a href="<?= Url::to(['/department/view', 'd' => $departments_top['id'], 'm' => $middle['child_id'], 't' => 'm']) ?>" class="flex items-center h-[90px] bg-main-red text-white shadow-[0px_0px_10px_0px_#00000017] px-7 duration-300 ease-in-out">
                                <h1 class="text-base md:text-2xl font-semibold">
                                    <?= \frontend\models\DepartmentContent::find()->where(['middle_id' => $middle['child_id']])->one()['title'] ?>
                                </h1>
                            </a>
                        <?php else: ?>
                            <a href="<?= Url::to(['/department/view', 'd' => $departments_top['id'], 'm' => $middle['child_id'], 't' => 'm']) ?>" class="flex items-center h-[90px] bg-main-milk shadow-[0px_0px_10px_0px_#00000017] px-7 hover:text-main-red duration-300 ease-in-out">
                                <h1 class="text-base md:text-2xl font-semibold">
                                    <?= \frontend\models\DepartmentContent::find()->where(['middle_id' => $middle['child_id']])->one()['title'] ?>
                                </h1>
                            </a>
                        <?php endif; ?>
                    <?php else: ?>
                        <?php if ( $index == 0 ): ?>
                            <?php $first_middle = $middle['child_id']; ?>
                            <a href="<?= Url::to(['/department/view', 'd' => $departments_top['id'], 'm' => $middle['child_id'], 't' => 'm']) ?>" class="flex items-center h-[90px] bg-main-red text-white shadow-[0px_0px_10px_0px_#00000017] px-7 duration-300 ease-in-out">
                                <h1 class="text-base md:text-2xl font-semibold">
                                    <?= \frontend\models\DepartmentContent::find()->where(['middle_id' => $middle['child_id']])->one()['title'] ?>
                                </h1>
                            </a>
                        <?php else: ?>
                            <a href="<?= Url::to(['/department/view', 'd' => $departments_top['id'], 'm' => $middle['child_id'], 't' => 'm']) ?>" class="flex items-center h-[90px] bg-main-milk shadow-[0px_0px_10px_0px_#00000017] px-7 hover:text-main-red duration-300 ease-in-out">
                                <h1 class="text-base md:text-2xl font-semibold">
                                    <?= \frontend\models\DepartmentContent::find()->where(['middle_id' => $middle['child_id']])->one()['title'] ?>
                                </h1>
                            </a>
                        <?php endif; ?>
                    <?php endif; ?>
                <?php endforeach; ?>

            </div>
        </div>
    <?php endif; ?>

    <?php foreach ( \frontend\models\DepartmentChildren::find()->where(['parent_key' => 'middle'])->andWhere(['parent_id' => isset($_GET['m']) ? $_GET['m'] : $first_middle])->andWhere(['child_key' => 'bottom'])->all() as $bottom ): ?>
        <div class="mb-9">
            <div class="h-[90px] px-5 md:px-16 flex items-center bg-white shadow-[0px_0px_10px_0px_#00000017]">
                <h1 class="font-bold text-3xl">
                    <?= \frontend\models\DepartmentContent::find()->where(['bottom_id' => $bottom['child_id']])->one()['title'] ?>
                </h1>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                <?php foreach ( \frontend\models\DepartmentWorker::find()->where(['data_key' => 'bottom'])->andWhere(['bottom_id' => $bottom['child_id']])->all() as $worker ): ?>
                    <div class="px-6 py-6 md:py-9">
                        <div class="inline-block align-middle pr-6 relative">
                            <div class="w-[80px] sm:w-[120px] h-[80px] sm:h-[120px] rounded-full bg-no-repeat bg-cover bg-center" style="background-image: url('/frontend/web/<?= \frontend\models\UserAvatar::find()->where(['user_id' => $worker['user_id']])->one()['src'] ?>');"></div>
                        </div>
                        <div class="inline-block align-middle">
                            <h1 class="font-light text-xl text-main-red mb-1">
                                <?= \frontend\models\UserData::find()->where(['user_id' => $worker['user_id']])->one()['job'] ?>
                            </h1>
                            <h2 class="font-medium text-sm text-black mb-3">
                                <?= \frontend\models\UserData::find()->where(['user_id' => $worker['user_id']])->one()['fullname'] ?>
                            </h2>

                            <div class="mb-3">
                                <div class="inline-block align-middle mr-2">
                                    <svg width="16" height="16" viewBox="0 0 21 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M20.8149 4.17212L14.446 10.5L20.8149 16.8278C20.93 16.5872 20.9999 16.3212 20.9999 16.0371V4.96286C20.9999 4.67874 20.93 4.41276 20.8149 4.17212Z" fill="#868686"/>
                                        <path d="M19.1543 3.11719H1.84567C1.56156 3.11719 1.29557 3.18704 1.05493 3.30217L9.19502 11.4012C9.91476 12.121 11.0852 12.121 11.8049 11.4012L19.945 3.30217C19.7044 3.18704 19.4384 3.11719 19.1543 3.11719Z" fill="#868686"/>
                                        <path d="M0.18498 4.17212C0.0698496 4.41276 0 4.67874 0 4.96286V16.0371C0 16.3212 0.0698496 16.5872 0.18498 16.8278L6.55385 10.5L0.18498 4.17212Z" fill="#868686"/>
                                        <path d="M13.5761 11.3699L12.6749 12.2712C11.4756 13.4704 9.52425 13.4704 8.32499 12.2712L7.4238 11.3699L1.05493 17.6978C1.29557 17.8129 1.56156 17.8828 1.84567 17.8828H19.1543C19.4384 17.8828 19.7044 17.8129 19.945 17.6978L13.5761 11.3699Z" fill="#868686"/>
                                    </svg>
                                </div>
                                <a href="mailto:<?= \common\models\User::find()->where(['id' => $worker['user_id']])->one()['email'] ?>" class="font-medium text-sm text-stone-400 inline-block align-middle">
                                    <?= \common\models\User::find()->where(['id' => $worker['user_id']])->one()['email'] ?>
                                </a>
                            </div>

                            <div>
                                <div class="inline-block align-middle mr-2">
                                    <svg width="16" height="16" viewBox="0 0 21 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M16.6934 0H4.30664C1.93196 0 0 1.93196 0 4.30664V16.6934C0 19.068 1.93196 21 4.30664 21H16.6934C19.068 21 21 19.068 21 16.6934V4.30664C21 1.93196 19.068 0 16.6934 0ZM16.05 15.1712L15.7205 15.7204C14.4391 17.0018 11.063 15.7033 8.17983 12.8202C5.29668 9.93702 3.99816 6.56098 5.27957 5.27953L5.82877 4.95001C6.32633 4.6515 6.97171 4.81281 7.27022 5.31038L8.0478 6.6063C8.29586 7.0197 8.23069 7.54884 7.88981 7.88977C7.40927 8.37031 7.40927 9.1494 7.88981 9.62989L11.3701 13.1102C11.8506 13.5907 12.6297 13.5907 13.1102 13.1102C13.4511 12.7693 13.9803 12.7041 14.3937 12.9522L15.6896 13.7297C16.1871 14.0283 16.3485 14.6737 16.05 15.1712Z" fill="#868686"/>
                                    </svg>
                                </div>
                                <div class="font-medium text-sm text-stone-400 inline-block align-middle">
                                    <?= \frontend\models\UserTelephone::find()->where(['user_id' => $worker['user_id']])->one()['telephone'] ?>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>

            </div>
        </div>
    <?php endforeach; ?>

    <?php if ( count(\frontend\models\DepartmentChildren::find()->where(['parent_key' => 'middle'])->andWhere(['parent_id' => isset($_GET['m']) ? $_GET['m'] : $first_middle])->andWhere(['child_key' => 'bottom'])->all()) == 0 ): ?>
        <div class="mb-9">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                <?php foreach ( \frontend\models\DepartmentWorker::find()->where(['data_key' => 'middle'])->andWhere(['middle_id' => isset($_GET['m']) ? $_GET['m'] : $first_middle])->all() as $worker ): ?>
                    <div class="px-6 py-6 md:py-9">
                        <div class="inline-block align-middle pr-6 relative">
                            <div class="w-[80px] sm:w-[120px] h-[80px] sm:h-[120px] rounded-full bg-no-repeat bg-cover bg-center" style="background-image: url('/frontend/web/<?= \frontend\models\UserAvatar::find()->where(['user_id' => $worker['user_id']])->one()['src'] ?>');"></div>
                        </div>
                        <div class="inline-block align-middle">
                            <h1 class="font-light text-xl text-main-red mb-1">
                                <?= \frontend\models\UserData::find()->where(['user_id' => $worker['user_id']])->one()['job'] ?>
                            </h1>
                            <h2 class="font-medium text-sm text-black mb-3">
                                <?= \frontend\models\UserData::find()->where(['user_id' => $worker['user_id']])->one()['fullname'] ?>
                            </h2>

                            <div class="mb-3">
                                <div class="inline-block align-middle mr-2">
                                    <svg width="16" height="16" viewBox="0 0 21 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M20.8149 4.17212L14.446 10.5L20.8149 16.8278C20.93 16.5872 20.9999 16.3212 20.9999 16.0371V4.96286C20.9999 4.67874 20.93 4.41276 20.8149 4.17212Z" fill="#868686"/>
                                        <path d="M19.1543 3.11719H1.84567C1.56156 3.11719 1.29557 3.18704 1.05493 3.30217L9.19502 11.4012C9.91476 12.121 11.0852 12.121 11.8049 11.4012L19.945 3.30217C19.7044 3.18704 19.4384 3.11719 19.1543 3.11719Z" fill="#868686"/>
                                        <path d="M0.18498 4.17212C0.0698496 4.41276 0 4.67874 0 4.96286V16.0371C0 16.3212 0.0698496 16.5872 0.18498 16.8278L6.55385 10.5L0.18498 4.17212Z" fill="#868686"/>
                                        <path d="M13.5761 11.3699L12.6749 12.2712C11.4756 13.4704 9.52425 13.4704 8.32499 12.2712L7.4238 11.3699L1.05493 17.6978C1.29557 17.8129 1.56156 17.8828 1.84567 17.8828H19.1543C19.4384 17.8828 19.7044 17.8129 19.945 17.6978L13.5761 11.3699Z" fill="#868686"/>
                                    </svg>
                                </div>
                                <a href="mailto:<?= \common\models\User::find()->where(['id' => $worker['user_id']])->one()['email'] ?>" class="font-medium text-sm text-stone-400 inline-block align-middle">
                                    <?= \common\models\User::find()->where(['id' => $worker['user_id']])->one()['email'] ?>
                                </a>
                            </div>

                            <div>
                                <div class="inline-block align-middle mr-2">
                                    <svg width="16" height="16" viewBox="0 0 21 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M16.6934 0H4.30664C1.93196 0 0 1.93196 0 4.30664V16.6934C0 19.068 1.93196 21 4.30664 21H16.6934C19.068 21 21 19.068 21 16.6934V4.30664C21 1.93196 19.068 0 16.6934 0ZM16.05 15.1712L15.7205 15.7204C14.4391 17.0018 11.063 15.7033 8.17983 12.8202C5.29668 9.93702 3.99816 6.56098 5.27957 5.27953L5.82877 4.95001C6.32633 4.6515 6.97171 4.81281 7.27022 5.31038L8.0478 6.6063C8.29586 7.0197 8.23069 7.54884 7.88981 7.88977C7.40927 8.37031 7.40927 9.1494 7.88981 9.62989L11.3701 13.1102C11.8506 13.5907 12.6297 13.5907 13.1102 13.1102C13.4511 12.7693 13.9803 12.7041 14.3937 12.9522L15.6896 13.7297C16.1871 14.0283 16.3485 14.6737 16.05 15.1712Z" fill="#868686"/>
                                    </svg>
                                </div>
                                <div class="font-medium text-sm text-stone-400 inline-block align-middle">
                                    <?= \frontend\models\UserTelephone::find()->where(['user_id' => $worker['user_id']])->one()['telephone'] ?>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>

            </div>
        </div>
    <?php endif; ?>

    <?php foreach ( \frontend\models\DepartmentChildren::find()->where(['parent_key' => 'top'])->andWhere(['parent_id' => $_GET['d']])->andWhere(['child_key' => 'bottom'])->all() as $bottom ): ?>
        <div class="mb-9">
            <div class="h-[90px] px-5 md:px-16 flex items-center bg-white shadow-[0px_0px_10px_0px_#00000017]">
                <h1 class="font-bold text-3xl">
                    <?= \frontend\models\DepartmentContent::find()->where(['bottom_id' => $bottom['child_id']])->one()['title'] ?>
                </h1>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                <?php foreach ( \frontend\models\DepartmentWorker::find()->where(['data_key' => 'bottom'])->andWhere(['bottom_id' => $bottom['child_id']])->all() as $worker ): ?>
                    <div class="px-6 py-6 md:py-9">
                        <div class="inline-block align-middle pr-6 relative">
                            <div class="w-[80px] sm:w-[120px] h-[80px] sm:h-[120px] rounded-full bg-no-repeat bg-cover bg-center" style="background-image: url('/frontend/web/<?= \frontend\models\UserAvatar::find()->where(['user_id' => $worker['user_id']])->one()['src'] ?>');"></div>
                        </div>
                        <div class="inline-block align-middle">
                            <h1 class="font-light text-xl text-main-red mb-1">
                                <?= \frontend\models\UserData::find()->where(['user_id' => $worker['user_id']])->one()['job'] ?>
                            </h1>
                            <h2 class="font-medium text-sm text-black mb-3">
                                <?= \frontend\models\UserData::find()->where(['user_id' => $worker['user_id']])->one()['fullname'] ?>
                            </h2>

                            <div class="mb-3">
                                <div class="inline-block align-middle mr-2">
                                    <svg width="16" height="16" viewBox="0 0 21 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M20.8149 4.17212L14.446 10.5L20.8149 16.8278C20.93 16.5872 20.9999 16.3212 20.9999 16.0371V4.96286C20.9999 4.67874 20.93 4.41276 20.8149 4.17212Z" fill="#868686"/>
                                        <path d="M19.1543 3.11719H1.84567C1.56156 3.11719 1.29557 3.18704 1.05493 3.30217L9.19502 11.4012C9.91476 12.121 11.0852 12.121 11.8049 11.4012L19.945 3.30217C19.7044 3.18704 19.4384 3.11719 19.1543 3.11719Z" fill="#868686"/>
                                        <path d="M0.18498 4.17212C0.0698496 4.41276 0 4.67874 0 4.96286V16.0371C0 16.3212 0.0698496 16.5872 0.18498 16.8278L6.55385 10.5L0.18498 4.17212Z" fill="#868686"/>
                                        <path d="M13.5761 11.3699L12.6749 12.2712C11.4756 13.4704 9.52425 13.4704 8.32499 12.2712L7.4238 11.3699L1.05493 17.6978C1.29557 17.8129 1.56156 17.8828 1.84567 17.8828H19.1543C19.4384 17.8828 19.7044 17.8129 19.945 17.6978L13.5761 11.3699Z" fill="#868686"/>
                                    </svg>
                                </div>
                                <a href="mailto:<?= \common\models\User::find()->where(['id' => $worker['user_id']])->one()['email'] ?>" class="font-medium text-sm text-stone-400 inline-block align-middle">
                                    <?= \common\models\User::find()->where(['id' => $worker['user_id']])->one()['email'] ?>
                                </a>
                            </div>

                            <div>
                                <div class="inline-block align-middle mr-2">
                                    <svg width="16" height="16" viewBox="0 0 21 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M16.6934 0H4.30664C1.93196 0 0 1.93196 0 4.30664V16.6934C0 19.068 1.93196 21 4.30664 21H16.6934C19.068 21 21 19.068 21 16.6934V4.30664C21 1.93196 19.068 0 16.6934 0ZM16.05 15.1712L15.7205 15.7204C14.4391 17.0018 11.063 15.7033 8.17983 12.8202C5.29668 9.93702 3.99816 6.56098 5.27957 5.27953L5.82877 4.95001C6.32633 4.6515 6.97171 4.81281 7.27022 5.31038L8.0478 6.6063C8.29586 7.0197 8.23069 7.54884 7.88981 7.88977C7.40927 8.37031 7.40927 9.1494 7.88981 9.62989L11.3701 13.1102C11.8506 13.5907 12.6297 13.5907 13.1102 13.1102C13.4511 12.7693 13.9803 12.7041 14.3937 12.9522L15.6896 13.7297C16.1871 14.0283 16.3485 14.6737 16.05 15.1712Z" fill="#868686"/>
                                    </svg>
                                </div>
                                <div class="font-medium text-sm text-stone-400 inline-block align-middle">
                                    <?= \frontend\models\UserTelephone::find()->where(['user_id' => $worker['user_id']])->one()['telephone'] ?>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>

            </div>
        </div>
    <?php endforeach; ?>

</div>
