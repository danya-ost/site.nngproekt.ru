<?php

/** @var \frontend\controllers\DocsController $data */

use yii\helpers\Url;

foreach ( $data as $item ):
?>
<div class="relative">
    <?php if ( \frontend\tools\tools::isPermission('docs')['deleteDocs'] ): ?>
        <button type="button" name="doc_delete_<?= $item['id'] ?>" class="inline-block align-middle float-right mr-1 font-light text-xs text-stone-400 hover:text-main-red absolute top-5 right-5">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
            </svg>
        </button>
    <?php endif; ?>
    <a href="<?= $item['href'] ?>" target="_blank" name="doc_item_<?= $item['id'] ?>" class="h-[110px] w-full bg-white hover:bg-[#E5E5E5] shadow-[0px_0px_10px_0px_#00000017] grid grid-cols-[20%_80%] grid-rows-1">
        <div class="flex items-center justify-center">
            <img src="/frontend/web/image/elements/doc.svg">
        </div>
        <div class="flex items-center justify-start">
            <div class="font-medium text-sm text-black">
                <?= $item['title'] ?>
            </div>
        </div>
    </a>
</div>
<?php
endforeach;
if ( count($data) == 0 ):
?>
    <div class="font-bold text-sm">Ничего не найдено...</div>
<?php
endif;