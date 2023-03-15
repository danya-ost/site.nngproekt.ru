<?php

/** @var \frontend\controllers\AppealsController $data */

foreach ( $data as $item ):
?>
<button id="appeals_<?= $item['id'] ?>" type="button" class="block text-left bg-white shadow-[0px_0px_10px_0px_#00000017] px-6 py-5">
    <span class="hidden text-green-500 text-red-500 text-stone-500"></span>
    <p class="font-light text-xs uppercase <?= $item['status_id'] == 1 ? 'text-green-500' : ( $item['status_id'] == 2 ? 'text-red-500' : 'text-stone-500' ); ?> mb-5"><?= $item['status'] ?></p>
    <p class="font-medium text-sm mb-3"><?= $item['title'] ?></p>
    <p class="font-light text-xs uppercase"><?= $item['msg_preview'] ?>...</p>
</button>
<?php
endforeach;
if ( count($data) == 0 ):
?>
<div class="text-black font-bold text-base">
    Ничего не найдено...
</div>
<?php
endif;