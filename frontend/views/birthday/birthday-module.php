<?php

/** @var \yii\web\View $this */
/** @var \frontend\controllers\BirthdayController $data_nearest */
/** @var \frontend\controllers\BirthdayController $data_nearest_next */
/** @var \frontend\controllers\BirthdayController $found_dmy */
/** @var \frontend\controllers\BirthdayController $found_dmy_next */

use frontend\models\UserAvatar;
use yii\helpers\Url;

$month = [ '1' => 'января', '2' => 'февраля', '3' => 'марта', '4' => 'апреля', '5' => 'мая', '6' => 'июня', '7' => 'июля', '8' => 'августа', '9' => 'сентября', '10' => 'октября', '11' => 'ноября', '12' => 'декабря' ];

?>
<h1 class="font-light text-xl text-main-red text-center mb-5">
    <?php
        $today_d = date('j');
        $today_m = date('n');
        $dmy = explode('~', $found_dmy);
        $dmy_d = $dmy[0];
        $dmy_m = $dmy[1];
        $dmy_y = $dmy[2];
        if ( $today_d == $dmy_d && $today_m == $dmy_m ){
            if ( count($data_nearest) > 0 ){
                echo 'СЕГОДНЯ - ' . date('d') . ' ' . $month[$dmy_m];
            }
        } else{
            if ( count($data_nearest) > 0 ){
                echo $dmy_d  . ' ' . $month[$dmy_m] . ' ' . $dmy_y;
            } else{
                echo 'В ближайшие дни дней раждений нет';
            }
        }
    ?>
</h1>

<div class="flex items-center justify-start">
    <div class="w-[74px] h-[74px] rounded-full bg-no-repeat bg-center bg-[length:100%_auto]" style="background-image: url('/frontend/web/<?= UserAvatar::find()->where(['user_id' => $data_nearest[0]['user_id']])->one()['src'] ?>');"></div>
    <div class="ml-5">
        <h3 class="font-medium text-sm"><?= $data_nearest[0]['fullname'] ?></h3>
        <p class="font-light text-xs text-stone-400"><?= $data_nearest[0]['job'] ?></p>
        <button type="button" name="sending_b_<?= $data_nearest[0]['user_id'] ?>" class="font-medium text-[10px] text-main-red uppercase mt-3 relative after:block after:content-[''] after:absolute after:left-0 after:-bottom-px after:bg-main-red after:h-px after:w-full">ПОЗДРАВИТЬ</button>
    </div>
</div>

<?php if ( count($data_nearest_next) > 0 && count($data_nearest) > 0 ): ?>
    <i class="block w-full h-px bg-stone-200 my-4"></i>

    <h1 class="font-light text-xl text-main-red text-center mb-5">
        <?php
            $today_d = (int) date('j');
            $today_m = date('n');
            $dmy = explode('~', $found_dmy_next);
            $dmy_d = (int) $dmy[0];
            $dmy_m = $dmy[1];
            $dmy_y = $dmy[2];
            if ( $today_d + 1 == $dmy_d && $today_m == $dmy_m ){
                if ( count($data_nearest_next) > 0 ){
                    echo 'ЗАВТРА - ' . ((int)date('d') + 1) . ' ' . $month[$dmy_m];
                }
            } else{
                if ( count($data_nearest_next) > 0 ){
                    echo $dmy_d . ' ' . $month[$dmy_m] . ' ' . $dmy_y;
                } else{
                    echo 'В ближайшие дни дней раждений нет';
                }
            }
        ?>
    </h1>

    <div class="flex items-center justify-start">
        <div class="w-[74px] h-[74px] rounded-full bg-no-repeat bg-center bg-[length:100%_auto]" style="background-image: url('/frontend/web/<?= UserAvatar::find()->where(['user_id' => $data_nearest_next[0]['user_id']])->one()['src'] ?>');"></div>
        <div class="ml-5">
            <h3 class="font-medium text-sm"><?= $data_nearest_next[0]['fullname'] ?></h3>
            <p class="font-light text-xs text-stone-400"><?= $data_nearest_next[0]['job'] ?></p>
            <button type="button" name="sending_b_<?= $data_nearest[0]['user_id'] ?>" class="font-medium text-[10px] text-main-red uppercase mt-3 relative after:block after:content-[''] after:absolute after:left-0 after:-bottom-px after:bg-main-red after:h-px after:w-full">ПОЗДРАВИТЬ</button>
        </div>
    </div>
<?php endif; ?>

<a href="<?= Url::to(['/birthday/index']) ?>" class="inline-block font-medium text-xs text-main-red mt-5 py-3 px-5 rounded-xl border-solid border-2 border-main-red relative left-2/4 -translate-x-2/4">
    ВСЕ ДНИ РОЖДЕНИЯ
</a>
