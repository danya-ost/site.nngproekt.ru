<?php

/** @var \yii\web\View $this */
/** @var \frontend\controllers\FotoController $data */
/** @var \frontend\controllers\FotoController $data_items */

?>
<div data-nngp-name="galleryModal" class="w-full h-screen fixed top-0 right-0 bottom-0 left-0 z-[999] bg-[#00000087]" style="visibility: hidden; opacity:0">
    <div class="max-w-[1085px] h-[600px] bg-white relative left-2/4 -translate-x-2/4 top-2/4 -translate-y-2/4">

        <button type="button" data-nngp-slide="0" id="galleryPrev" class="absolute left-4 top-2/4 -translate-y-2/4 z-30 bg-main-red w-[37px] h-[37px] flex items-center justify-center rounded-full">
            <svg class="rotate-180" width="21" height="8" viewBox="0 0 21 8" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M20.3536 4.35355C20.5488 4.15829 20.5488 3.84171 20.3536 3.64645L17.1716 0.464466C16.9763 0.269204 16.6597 0.269204 16.4645 0.464466C16.2692 0.659728 16.2692 0.976311 16.4645 1.17157L19.2929 4L16.4645 6.82843C16.2692 7.02369 16.2692 7.34027 16.4645 7.53553C16.6597 7.7308 16.9763 7.7308 17.1716 7.53553L20.3536 4.35355ZM0 4.5H20V3.5H0V4.5Z" fill="white"/>
            </svg>
        </button>

        <button type="button" data-nngp-slide="0" id="galleryNext" class="absolute right-4 top-2/4 -translate-y-2/4 z-30 bg-main-red w-[37px] h-[37px] flex items-center justify-center rounded-full">
            <svg width="21" height="8" viewBox="0 0 21 8" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M20.3536 4.35355C20.5488 4.15829 20.5488 3.84171 20.3536 3.64645L17.1716 0.464466C16.9763 0.269204 16.6597 0.269204 16.4645 0.464466C16.2692 0.659728 16.2692 0.976311 16.4645 1.17157L19.2929 4L16.4645 6.82843C16.2692 7.02369 16.2692 7.34027 16.4645 7.53553C16.6597 7.7308 16.9763 7.7308 17.1716 7.53553L20.3536 4.35355ZM0 4.5H20V3.5H0V4.5Z" fill="white"/>
            </svg>
        </button>

        <button type="button" id="galleryModalClose" class="absolute right-0 lg:right-auto left-auto lg:left-full -top-[35px] lg:-top-[26px]">
            <svg width="26" height="26" viewBox="0 0 26 26" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M13 0C20.1714 0 26 5.82864 26 13C26 20.1714 20.1714 26 13 26C5.82864 26 0 20.1714 0 13C0 5.82864 5.82864 0 13 0ZM13 24.6878C19.439 24.6878 24.6878 19.439 24.6878 13C24.6878 6.56103 19.439 1.31221 13 1.31221C6.56103 1.31221 1.3122 6.56103 1.3122 13C1.3122 19.439 6.56103 24.6878 13 24.6878Z" fill="white"/>
                <path d="M12.0848 12.939L8.27026 9.12447C8.02613 8.88034 8.02613 8.45311 8.27026 8.20898C8.51439 7.96485 8.94162 7.96485 9.18576 8.20898L13.0003 12.0235L16.8149 8.20898C17.059 7.96485 17.4862 7.96485 17.7304 8.20898C17.9745 8.45311 17.9745 8.88034 17.7304 9.12447L13.9158 12.939L17.7304 16.7231C17.9745 16.9672 17.9745 17.3944 17.7304 17.6385C17.6083 17.7606 17.4252 17.8216 17.2726 17.8216C17.12 17.8216 16.9369 17.7606 16.8149 17.6385L13.0003 13.824L9.18576 17.6385C9.06369 17.7606 8.88059 17.8216 8.72801 17.8216C8.57543 17.8216 8.39233 17.7606 8.27026 17.6385C8.02613 17.3944 8.02613 16.9672 8.27026 16.7231L12.0848 12.939Z" fill="white"/>
            </svg>
        </button>

        <div class="max-w-[950px] h-full m-auto bg-no-repeat bg-center bg-contain" style="background-image: url('#');"></div>

    </div>
</div>

<div class="container h-auto pb-14">

    <div class="w-full ha-auto mb-10">
        <h1 class="font-bold text-4xl uppercase"><?= $data['title'] ?></h1>
    </div>

    <div data-nngp-name="#galleryModal" class="w-full h-auto grid grid-cols-2 sm:grid-cols-3 gap-5">
        <?php foreach ( $data_items as $index => $item ): ?>
            <button type="button" data-nngp-id="<?= $index ?>" data-nngp-src="/frontend/web/<?= $item['src'] ?>" class="h-[270px] bg-no-repeat bg-cover bg-center" style="background-image: url('/frontend/web/<?= $item['src'] ?>');">
                <div class="w-full h-full bg-[#0000007D] opacity-0 hover:opacity-50 duration-300 ease-in-out"></div>
            </button>
        <?php endforeach; ?>
    </div>

</div>
