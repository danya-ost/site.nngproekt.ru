<?php

/** @var \frontend\controllers\AbsController $data */
/** @var \frontend\controllers\AbsController $permission */

use frontend\models\Abs;
use frontend\tools\tools;

foreach ( $data as $item ):
?>
<div class="bg-white h-[195px] shadow-[0px_0px_10px_0px_#00000017] grid grid-cols-[30%_70%] grid-rows-1">
    <div class="bg-no-repeat bg-center bg-cover" style="background-image: url('/frontend/web/<?= $item['files']['0']['src'] ?>');"></div>
    <div class="px-4 py-6 relative">
        <div class="absolute top-3 right-3">
            <?php if ( Abs::find()->where(['id' => $item['id']])->one()['user_id'] == tools::idUser() || $permission['updateAbs'] ): ?>
                <button type="button" data-nngp-funct="absModalUpdateOpen" name="btn_update_<?= $item['id'] ?>" class="inline-block align-middle text-[#868686] hover:text-main-red">
                    <svg width="13" height="13" viewBox="0 0 13 13" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                        <g clip-path="url(#clip0_1127_8460)">
                            <path d="M12.5952 1.5818L11.4172 0.403682C10.8789 -0.134573 10.0032 -0.134548 9.465 0.403682L9.00391 0.8648L12.1342 3.99531L12.5952 3.53419C13.1347 2.99466 13.1348 2.12138 12.5952 1.5818Z"/>
                            <path d="M0.558895 9.56567L0.00637087 12.5496C-0.0164553 12.6729 0.0228494 12.7996 0.111539 12.8883C0.200329 12.9771 0.327028 13.0163 0.450198 12.9935L3.4339 12.4409L0.558895 9.56567Z"/>
                            <path d="M8.46574 1.40332L0.970215 8.89943L4.10047 12.0299L11.596 4.53383L8.46574 1.40332Z"/>
                        </g>
                        <defs>
                            <clipPath id="clip0_1127_8460">
                                <rect width="13" height="13" fill="white"/>
                            </clipPath>
                        </defs>
                    </svg>
                </button>
            <?php endif; ?>
            <?php if (  Abs::find()->where(['id' => $item['id']])->one()['user_id'] == tools::idUser() || $permission['deleteAbs'] ): ?>
                <button type="button" name="btn_delete_<?= $item['id'] ?>" class="inline-block align-middle font-light text-xs text-stone-400 hover:text-main-red">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                    </svg>
                </button>
            <?php endif; ?>
        </div>

        <div class="font-medium text-[10px] text-stone-300 mb-2">
            <?= $item['date'] ?>
        </div>
        <h1 class="font-medium text-sm text-black">
            <?= $item['title'] ?>
        </h1>
        <div class="inline-block font-medium text-[10px] text-stone-300 mb-4 relative after:block after:content-[''] after:absolute after:left-0 after:-bottom-px after:bg-stone-300 after:h-px after:w-full">
            <?= $item['user'] ?>
        </div> <br>
        <button type="button" name="selected_abs_<?= $item['id'] ?>" class="font-medium text-[10px] text-main-red uppercase relative after:block after:content-[''] after:absolute after:left-0 after:-bottom-px after:bg-main-red after:h-px after:w-full">
            СМОТРЕТЬ ОБЪЯВЛЕНИЕ
        </button>
    </div>
</div>
<?php
endforeach;
if  ( count($data) == 0 ):
?>
    <div class="font-bold text-sm">Ничего не найдено...</div>
<?php
endif;