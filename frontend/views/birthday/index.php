<?php

/** @var \yii\web\View $this */

$month = [ '1' => 'января', '2' => 'февраля', '3' => 'марта', '4' => 'апреля', '5' => 'мая', '6' => 'июня', '7' => 'июля', '8' => 'августа', '9' => 'сентября', '10' => 'октября', '11' => 'ноября', '12' => 'декабря' ];

$this->title = 'Дни рождения сотрудников';
?>
<div class="container h-auto pb-14">
    <div class="w-full ha-auto mb-14">
        <h1 class="font-bold text-4xl uppercase">ДНИ РОЖДЕНИЯ</h1>
    </div>

    <!-- nngp:result_now -->
    <div class="w-full h-auto font-semibold text-2xl text-black mb-6">
        Сегодня празднуют День Рождения:
    </div>
    <!-- /nngp:result_now -->

    <!-- nngp:workers -->
    <div class="w-full h-auto grid grid-cols-1 lg:grid-cols-2 gap-3 mb-10">

        <?php foreach ( \frontend\models\UserData::find()->where(['birthday_day' => (int) date('j')])->andWhere(['birthday_month' => (int) date('n')])->all() as $item ): ?>
            <div class="bg-white shadow-[0px_0px_10px_0px_#00000017] px-4 py-6">
                <div class="w-full h-auto grid grid-cols-[25%_75%] grid-rows-1">
                    <div>
                        <div class="w-[50px] md:w-[118px] h-[50px] md:h-[118px] border-2 md:border-[6px] border-solid border-[#C4C4C4] rounded-full bg-no-repeat bg-center bg-cover" style="background-image: url('/frontend/web/<?= \frontend\models\UserAvatar::find()->where(['user_id' => $item['user_id']])->one()['src'] ?>');"></div>
                    </div>
                    <div class="flex items-center justify-start">
                        <div>
                            <h1 class="font-light text-xl text-main-red">
                                <?= $item['fullname'] ?>
                            </h1>
                            <p class="font-medium text-sm text-black mt-1">
                                <?= $item['job'] ?>
                            </p>
                            <p class="inline-block font-light text-sm text-stone-400 mt-[10px] relative after:block after:content-[''] after:absolute after:left-0 after:-bottom-px after:bg-stone-300 after:h-px after:w-full">
                                <?php $department = \frontend\models\DepartmentWorker::find()->where(['user_id' => $item['user_id']])->one() ?>
                                <?php
                                    if ( $department['data_key'] == 'top' ){
                                        echo \frontend\models\DepartmentContent::find()->where(['department_id' => $department['department_id']])->one()['title'];
                                    } elseif ( $department['data_key'] == 'middle' ){
                                        echo \frontend\models\DepartmentContent::find()->where(['middle_id' => $department['middle_id']])->one()['title'];
                                    } else{
                                        echo \frontend\models\DepartmentContent::find()->where(['bottom_id' => $department['bottom_id']])->one()['title'];
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
                            <?= \common\models\User::find()->where(['id' => $item['user_id']])->one()['email'] ?>
                        </div>
                    </div>

                    <?php if ( strlen(\frontend\models\UserTelephone::find()->where(['user_id' => $item['user_id']])->one()['telephone']) > 0 ): ?>
                        <div class="grid grid-cols-[15%_85%] md:grid-cols-[5%_95%] grid-rows-1 mt-3">
                            <div>
                                <svg width="21" height="21" viewBox="0 0 21 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M16.6934 0H4.30664C1.93196 0 0 1.93196 0 4.30664V16.6934C0 19.068 1.93196 21 4.30664 21H16.6934C19.068 21 21 19.068 21 16.6934V4.30664C21 1.93196 19.068 0 16.6934 0ZM16.05 15.1712L15.7205 15.7204C14.4391 17.0018 11.063 15.7033 8.17983 12.8202C5.29668 9.93702 3.99816 6.56098 5.27957 5.27953L5.82877 4.95001C6.32633 4.6515 6.97171 4.81281 7.27022 5.31038L8.0478 6.6063C8.29586 7.0197 8.23069 7.54884 7.88981 7.88977C7.40927 8.37031 7.40927 9.1494 7.88981 9.62989L11.3701 13.1102C11.8506 13.5907 12.6297 13.5907 13.1102 13.1102C13.4511 12.7693 13.9803 12.7041 14.3937 12.9522L15.6896 13.7297C16.1871 14.0283 16.3485 14.6737 16.05 15.1712Z" fill="#868686"/>
                                </svg>
                            </div>
                            <div class="font-medium text-sm text-stone-400">
                                <?= \frontend\models\UserTelephone::find()->where(['user_id' => $item['user_id']])->one()['telephone'] ?>
                            </div>
                        </div>
                    <?php endif; ?>

                    <div class="grid grid-cols-[15%_85%] md:grid-cols-[5%_95%] grid-rows-1 mt-3">
                        <div>
                            <svg width="19" height="21" viewBox="0 0 19 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M9.49553 5.72728C10.5503 5.72728 11.4046 4.87297 11.4046 3.81817C11.4046 3.46021 11.3044 3.12137 11.1326 2.835L9.49553 0L7.85847 2.835C7.68665 3.12137 7.58643 3.46021 7.58643 3.81817C7.58643 4.87297 8.44077 5.72728 9.49553 5.72728Z" fill="#868686"/>
                                <path d="M15.223 8.59075H10.4502V6.68164H8.54112V8.59075H3.76842C2.18863 8.59075 0.904785 9.8746 0.904785 11.4544V12.9244C0.904785 13.9553 1.74477 14.7953 2.77568 14.7953C3.27682 14.7953 3.74453 14.5996 4.09774 14.2464L6.14046 12.2084L8.17843 14.2416C8.8848 14.948 10.1162 14.948 10.8225 14.2416L12.8652 12.2084L14.9032 14.2416C15.2564 14.5948 15.7241 14.7905 16.2252 14.7905C17.2562 14.7905 18.0961 13.9505 18.0961 12.9196V11.4544C18.0866 9.8746 16.8028 8.59075 15.223 8.59075Z" fill="#868686"/>
                                <path d="M13.8819 15.2581L12.8557 14.232L11.8248 15.2581C10.5791 16.5038 8.40278 16.5038 7.15709 15.2581L6.13093 14.232L5.10002 15.2581C4.48433 15.8833 3.65867 16.227 2.77568 16.227C2.08362 16.227 1.4393 16.0074 0.904785 15.6399V20.0452C0.904785 20.5702 1.33433 20.9997 1.85932 20.9997H17.132C17.657 20.9997 18.0866 20.5702 18.0866 20.0452V15.64C17.552 16.0075 16.9125 16.227 16.2157 16.227C15.3327 16.227 14.5071 15.8834 13.8819 15.2581Z" fill="#868686"/>
                            </svg>
                        </div>
                        <div class="font-medium text-sm text-stone-400">
                            <?php echo $item['birthday_day'] . ' ' . $month[$item['birthday_month']]; ?>
                        </div>
                    </div>

                </div>
            </div>
        <?php endforeach; ?>

        <?php if ( count(\frontend\models\UserData::find()->where(['birthday_day' => (int) date('j')])->andWhere(['birthday_month' => (int) date('n')])->all()) == 0 ): ?>
            <div>Сегодня день рождение ни кто не празднует!</div>
        <?php endif; ?>

    </div>
    <!-- /nngp:workers -->

    <!-- nngp:result_tomorrow -->
    <div class="w-full h-auto font-semibold text-2xl text-black mb-6">
        Завтра празднуют День Рождения:
    </div>
    <!-- /nngp:result_tomorrow -->

    <!-- nngp:workers -->
    <div class="w-full h-auto grid grid-cols-1 lg:grid-cols-2 gap-3 mb-10">

        <?php foreach ( \frontend\models\UserData::find()->where(['birthday_day' => (int) date('j') + 1])->andWhere(['birthday_month' => (int) date('n')])->all() as $item ): ?>
            <div class="bg-white shadow-[0px_0px_10px_0px_#00000017] px-4 py-6">
                <div class="w-full h-auto grid grid-cols-[25%_75%] grid-rows-1">
                    <div>
                        <div class="w-[50px] md:w-[118px] h-[50px] md:h-[118px] border-2 md:border-[6px] border-solid border-[#C4C4C4] rounded-full bg-no-repeat bg-center bg-cover" style="background-image: url('/frontend/web/<?= \frontend\models\UserAvatar::find()->where(['user_id' => $item['user_id']])->one()['src'] ?>');"></div>
                    </div>
                    <div class="flex items-center justify-start">
                        <div>
                            <h1 class="font-light text-xl text-main-red">
                                <?= $item['fullname'] ?>
                            </h1>
                            <p class="font-medium text-sm text-black mt-1">
                                <?= $item['job'] ?>
                            </p>
                            <p class="inline-block font-light text-sm text-stone-400 mt-[10px] relative after:block after:content-[''] after:absolute after:left-0 after:-bottom-px after:bg-stone-300 after:h-px after:w-full">
                                <?php $department = \frontend\models\DepartmentWorker::find()->where(['user_id' => $item['user_id']])->one() ?>
                                <?php
                                if ( $department['data_key'] == 'top' ){
                                    echo \frontend\models\DepartmentContent::find()->where(['department_id' => $department['department_id']])->one()['title'];
                                } elseif ( $department['data_key'] == 'middle' ){
                                    echo \frontend\models\DepartmentContent::find()->where(['middle_id' => $department['middle_id']])->one()['title'];
                                } else{
                                    echo \frontend\models\DepartmentContent::find()->where(['bottom_id' => $department['bottom_id']])->one()['title'];
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
                            <?= \common\models\User::find()->where(['id' => $item['user_id']])->one()['email'] ?>
                        </div>
                    </div>

                    <?php if ( strlen(\frontend\models\UserTelephone::find()->where(['user_id' => $item['user_id']])->one()['telephone']) > 0 ): ?>
                        <div class="grid grid-cols-[15%_85%] md:grid-cols-[5%_95%] grid-rows-1 mt-3">
                            <div>
                                <svg width="21" height="21" viewBox="0 0 21 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M16.6934 0H4.30664C1.93196 0 0 1.93196 0 4.30664V16.6934C0 19.068 1.93196 21 4.30664 21H16.6934C19.068 21 21 19.068 21 16.6934V4.30664C21 1.93196 19.068 0 16.6934 0ZM16.05 15.1712L15.7205 15.7204C14.4391 17.0018 11.063 15.7033 8.17983 12.8202C5.29668 9.93702 3.99816 6.56098 5.27957 5.27953L5.82877 4.95001C6.32633 4.6515 6.97171 4.81281 7.27022 5.31038L8.0478 6.6063C8.29586 7.0197 8.23069 7.54884 7.88981 7.88977C7.40927 8.37031 7.40927 9.1494 7.88981 9.62989L11.3701 13.1102C11.8506 13.5907 12.6297 13.5907 13.1102 13.1102C13.4511 12.7693 13.9803 12.7041 14.3937 12.9522L15.6896 13.7297C16.1871 14.0283 16.3485 14.6737 16.05 15.1712Z" fill="#868686"/>
                                </svg>
                            </div>
                            <div class="font-medium text-sm text-stone-400">
                                <?= \frontend\models\UserTelephone::find()->where(['user_id' => $item['user_id']])->one()['telephone'] ?>
                            </div>
                        </div>
                    <?php endif; ?>

                    <div class="grid grid-cols-[15%_85%] md:grid-cols-[5%_95%] grid-rows-1 mt-3">
                        <div>
                            <svg width="19" height="21" viewBox="0 0 19 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M9.49553 5.72728C10.5503 5.72728 11.4046 4.87297 11.4046 3.81817C11.4046 3.46021 11.3044 3.12137 11.1326 2.835L9.49553 0L7.85847 2.835C7.68665 3.12137 7.58643 3.46021 7.58643 3.81817C7.58643 4.87297 8.44077 5.72728 9.49553 5.72728Z" fill="#868686"/>
                                <path d="M15.223 8.59075H10.4502V6.68164H8.54112V8.59075H3.76842C2.18863 8.59075 0.904785 9.8746 0.904785 11.4544V12.9244C0.904785 13.9553 1.74477 14.7953 2.77568 14.7953C3.27682 14.7953 3.74453 14.5996 4.09774 14.2464L6.14046 12.2084L8.17843 14.2416C8.8848 14.948 10.1162 14.948 10.8225 14.2416L12.8652 12.2084L14.9032 14.2416C15.2564 14.5948 15.7241 14.7905 16.2252 14.7905C17.2562 14.7905 18.0961 13.9505 18.0961 12.9196V11.4544C18.0866 9.8746 16.8028 8.59075 15.223 8.59075Z" fill="#868686"/>
                                <path d="M13.8819 15.2581L12.8557 14.232L11.8248 15.2581C10.5791 16.5038 8.40278 16.5038 7.15709 15.2581L6.13093 14.232L5.10002 15.2581C4.48433 15.8833 3.65867 16.227 2.77568 16.227C2.08362 16.227 1.4393 16.0074 0.904785 15.6399V20.0452C0.904785 20.5702 1.33433 20.9997 1.85932 20.9997H17.132C17.657 20.9997 18.0866 20.5702 18.0866 20.0452V15.64C17.552 16.0075 16.9125 16.227 16.2157 16.227C15.3327 16.227 14.5071 15.8834 13.8819 15.2581Z" fill="#868686"/>
                            </svg>
                        </div>
                        <div class="font-medium text-sm text-stone-400">
                            <?php echo $item['birthday_day'] . ' ' . $month[$item['birthday_month']]; ?>
                        </div>
                    </div>

                </div>
            </div>
        <?php endforeach; ?>

        <?php if ( count(\frontend\models\UserData::find()->where(['birthday_day' => (int) date('j') + 1])->andWhere(['birthday_month' => (int) date('n')])->all()) == 0 ): ?>
            <div>Завтра день рождение ни кто не празднует!</div>
        <?php endif; ?>

    </div>
    <!-- /nngp:workers -->

</div>
