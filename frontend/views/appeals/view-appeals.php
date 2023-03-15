<?php

/** @var \frontend\controllers\AppealsController $data */

use yii\helpers\Url;

?>
<h1 class="font-light text-xl mb-4">
    <?= $data['title'] ?>
</h1>
<p class="block max-h-[150px] font-medium text-sm mb-4 overflow-y-auto cust-scroll">
    <?= $data['msg'] ?>
</p>

<?php if ( $data['response'] ): ?>
<h1 class="font-medium text-sm mb-4 uppercase">
    Ответ на обращение:
</h1>
<p class="block max-h-[150px] font-medium text-sm mb-4 overflow-y-auto cust-scroll">
    <?= $data['response'] ?>
</p>
<?php endif; ?>

<?php if ( count($data['files_response']) > 0 ): ?>
<div id="files_modal" class="w-full grid grid-cols-1 gap-8 my-5">
    <?php foreach ( $data['files_response'] as $file ): ?>
        <div class="text-black relative">
            <div class="inline-block align-middle mr-2 w-[45px] h-[45px] bg-[#E5E5E5] rounded-full relative">
                <svg class="absolute top-2/4 -translate-y-2/4 left-2/4 -translate-x-2/4" width="12" height="22" viewBox="0 0 12 22" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                    <path d="M5.9999 0.312988C4.55036 0.314605 3.16066 0.891148 2.13568 1.91613C1.1107 2.94111 0.53416 4.33081 0.532542 5.78035V17.7908C0.528296 18.3052 0.625927 18.8152 0.819805 19.2916C1.01368 19.768 1.29997 20.2013 1.66215 20.5665C2.02433 20.9316 2.45523 21.2215 2.93 21.4193C3.40477 21.6171 3.914 21.7189 4.42833 21.7189C4.94266 21.7189 5.45189 21.6171 5.92666 21.4193C6.40143 21.2215 6.83233 20.9316 7.19451 20.5665C7.55669 20.2013 7.84298 19.768 8.03685 19.2916C8.23073 18.8152 8.32836 18.3052 8.32412 17.7908V6.28504C8.32412 5.66861 8.07924 5.07744 7.64337 4.64156C7.20749 4.20569 6.61632 3.96082 5.9999 3.96082C5.38348 3.96082 4.7923 4.20569 4.35643 4.64156C3.92055 5.07744 3.67568 5.66861 3.67568 6.28504V17.2421C3.67568 17.3654 3.72466 17.4836 3.81183 17.5708C3.89901 17.6579 4.01724 17.7069 4.14052 17.7069C4.26381 17.7069 4.38204 17.6579 4.46922 17.5708C4.55639 17.4836 4.60537 17.3654 4.60537 17.2421V6.28504C4.60537 5.91518 4.75229 5.56048 5.01382 5.29895C5.27534 5.03743 5.63005 4.8905 5.9999 4.8905C6.36975 4.8905 6.72445 5.03743 6.98598 5.29895C7.24751 5.56048 7.39443 5.91518 7.39443 6.28504V17.7908C7.39814 18.1827 7.32416 18.5714 7.17676 18.9346C7.02936 19.2977 6.81147 19.628 6.53567 19.9064C6.25988 20.1848 5.93164 20.4058 5.56994 20.5567C5.20823 20.7075 4.82022 20.7852 4.42833 20.7852C4.03644 20.7852 3.64843 20.7075 3.28672 20.5567C2.92501 20.4058 2.59678 20.1848 2.32099 19.9064C2.04519 19.628 1.8273 19.2977 1.6799 18.9346C1.5325 18.5714 1.45852 18.1827 1.46223 17.7908V5.78035C1.46223 4.57688 1.9403 3.42271 2.79128 2.57173C3.64226 1.72075 4.79643 1.24268 5.9999 1.24268C7.20336 1.24268 8.35754 1.72075 9.20852 2.57173C10.0595 3.42271 10.5376 4.57688 10.5376 5.78035V10.9999C10.5376 11.1232 10.5865 11.2414 10.6737 11.3286C10.7609 11.4157 10.8791 11.4647 11.0024 11.4647C11.1257 11.4647 11.2439 11.4157 11.3311 11.3286C11.4183 11.2414 11.4673 11.1232 11.4673 10.9999V5.78035C11.4656 4.33081 10.8891 2.94111 9.86412 1.91613C8.83914 0.891148 7.44943 0.314605 5.9999 0.312988Z"/>
                </svg>
            </div>
            <div class="inline-block align-middle">
                <a href="/frontend/web/<?= $file['src'] ?>" target="_blank" class="text-sm font-medium text-main-red hover:underline">
                    <?= $file['name'] ?>
                </a>
                <p class="text-sm font-medium text-stone-400"></p>
            </div>
        </div>
    <?php endforeach; ?>
</div>
<?php endif; ?>

<div class="flex items-center justify-between mt-10">
    <?php if ( $data['status_id'] == 1 ): ?>
        <button name="responseOk_<?= $data['id'] ?>" class="bg-black w-full md:w-auto px-9 py-3 rounded-xl text-white text-xs font-light uppercase cursor-pointer duration-300 ease-in-out">
            ОТВЕТ ПОЛУЧЕН
        </button>
    <?php endif; ?>

    <a href="<?= Url::to(['/appeals/add-form-appeals']) ?>" class="bg-main-red w-full md:w-auto px-6 py-3 rounded-xl text-white text-xs font-light uppercase cursor-pointer duration-300 ease-in-out">
        ЗАДАТЬ ЕЩЕ ВОПРОС
    </a>
</div>
