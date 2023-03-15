<?php

/** @var \frontend\controllers\InitiativeController $data */

use yii\helpers\Url;

foreach ( $data as $item ):
?>
<a href="<?= Url::to(['/initiative/response', 'i' => $item['id']]) ?>" id="initiative_01" type="button" class="block h-[250px] sm:h-[220px] text-left align-top bg-white shadow-[0px_0px_10px_0px_#00000017] px-6 py-5 relative">
    <p class="font-light text-xs uppercase mb-3" style="color: <?= $item['status_color'] ?>">
        <?= $item['status'] ?>
    </p>
    <p class="font-medium text-sm mb-3">
        <?= $item['title'] ?>
    </p>
    <p class="font-light text-xs text-stone-400 absolute bottom-5 left-6">
        <?= $item['date'] ?> <br>
        Подразделение: <?= $item['department'] ?> <br>
        <?= $item['author'] ?><?= strlen($item['supportive']) > 0 ? ', ' : ' ' ?><?= $item['supportive'] ?>
    </p>
</a>
<?php
endforeach;
if ( count($data) == 0 ):
?>
    <div class="text-sm text-black font-bold">Ничего не найдено...</div>
<?php
endif;