<?php

/** @var \yii\web\View $this */
/** @var \frontend\controllers\FotoController $data */

use yii\helpers\Url;

foreach ( $data as $item ):
?>
    <div class="relative h-[390px]">
        <div class="absolute top-4 right-4 z-[999]">
            <?php if ( \frontend\tools\tools::isPermission('foto')['updateFoto'] ): ?>
                <a href="<?= Url::to(['/foto/update-form', 'g' => $item['gallery_id']]) ?>" type="button" class="inline-block align-middle mr-1 font-light text-xs text-white hover:text-main-red">
                    <svg width="14" height="14" viewBox="0 0 13 13" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
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
                </a>
            <?php endif; ?>
            <?php if ( \frontend\tools\tools::isPermission('foto')['deleteFoto'] ): ?>
                <button type="button" name="album_delete_<?= $item['id'] ?>" class="inline-block align-middle font-light text-xs text-white hover:text-main-red">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                    </svg>
                </button>
            <?php endif; ?>
        </div>
        <a href="<?= Url::to(['/foto/view-gallery', 'g' => $item['id']]) ?>" class="block w-full h-full bg-no-repeat bg-cover bg-center" style="background-image: url('/frontend/web/<?= $item['cover_src'] ?>');">
            <div class="w-full h-full bg-[#0000007D] relative hover:opacity-70 transition-all duration-300 ease-in-out">
                <h1 class="font-semibold text-lg sm:text-2xl text-white absolute bottom-8 left-8">
                    <?= $item['title'] ?>
                </h1>
            </div>
        </a>
    </div>
<?php
endforeach;
if ( count($data) == 0 ):
?>
    <div class="font-bold text-sm">
        Ничего не найдено...
    </div>
<?php
endif;
