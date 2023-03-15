<?php

/** @var \yii\web\View $this */
/** @var \frontend\controllers\ManualController $data */

foreach ( $data as $item ):
?>
    <button type="button" name="selected_department_id_<?= $item['id'] ?>" class="w-full border-b border-solid border-stone-300 last:border-none text-left px-2 py-1 text-main-red font-bold text-xs hover:bg-stone-100">
        <?= $item['title'] ?>
    </button>
<?php
endforeach;
if ( count($data) == 0 ):
?>
    <div class="w-full border-b border-solid border-stone-300 last:border-none text-left px-2 py-1 text-main-black font-bold text-xs">
        Ничего не найдено...
    </div>
<?php
endif;