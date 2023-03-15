<?php

/** @var \yii\web\View $this */
/** @var \frontend\controllers\HomeController $data */
/** @var \frontend\controllers\HomeController $permission */

$this->title = 'О компании [РЕДАкТИРОВАНИЕ]';
?>
    <div class="w-full h-[510px] bg-no-repeat bg-center bg-cover relative" data-template="<?= $data['about_banner_image']['id'] ?>" style="background-image: url('/frontend/web/<?= $data['about_banner_image']['text'] ?>');">
        <button data-bs-toggle="modal" data-bs-target="#pdfModal" class="absolute top-5 right-5 inline-block align-middle text-center rounded px-6 py-2.5 ml-1 mt-1 md:mt-0 bg-black text-white font-medium text-xs leading-tight uppercase hover:bg-gray-900 hover:shadow-lg focus:bg-gray-900 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-gray-900 active:shadow-lg transition duration-150 ease-in-out">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 inline-block align-middle">
                <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
            </svg>
            <span class="ml-1 inline-block align-middle">Сохранить</span>
        </button>
        <div class="w-full h-full bg-[#0000008F] px-11 flex items-center justify-start">
            <div>
                <div contenteditable="true" data-template="<?= $data['about_title']['id'] ?>" class="border-4 border-blue-500 border-dashed inline-block font-bold text-xl md:text-3xl lg:text-5xl text-white mb-4">
                    <?= $data['about_title']['text'] ?>
                </div>
                <br>
                <div contenteditable="true" data-template="<?= $data['about_title_2']['id'] ?>" class="border-4 border-blue-500 border-dashed inline-block font-bold text-base md:text-xl lg:text-3xl text-white">
                    <?= $data['about_title_2']['text'] ?>
                </div>
            </div>
        </div>
    </div>

    <div class="container h-auto px-5 lg:px-0">
        <div class="w-full h-auto relative">
            <div contenteditable="true" data-template="<?= $data['about_description']['id'] ?>" class="border-4 border-blue-500 border-dashed max-w-[1040px] bg-main-gray p-6 font-light text-xl text-white relative -top-20 left-2/4 -translate-x-2/4 whitespace-pre-wrap"><?= $data['about_description']['text'] ?></div>
        </div>
        <div class="w-full h-auto grid grid-cols-1 md:grid-cols-[40%_60%] grid-rows-2 md:grid-rows-1">
            <div class="bg-no-repeat bg-center bg-cover" data-template="<?= $data['about_company_image']['id'] ?>" style="background-image: url('/frontend/web/<?= $data['about_company_image']['text'] ?>');"></div>
            <div class="px-0 md:px-8 py-5">
                <div contenteditable="true" data-template="<?= $data['about_company_title']['id'] ?>" class="border-4 border-blue-500 border-dashed inline-block font-bold text-4xl text-white bg-main-red px-10 py-2 mb-10 relative left-0 md:-left-1/4">
                    <?= $data['about_company_title']['text'] ?>
                </div>
                <div contenteditable="true" data-template="<?= $data['about_company_description']['id'] ?>" class="border-4 border-blue-500 border-dashed font-medium text-sm text-black whitespace-pre-wrap"><?= $data['about_company_description']['text'] ?></div>
            </div>
        </div>
        <div class="w-full h-auto py-11">
            <div class="max-w-[1040px] m-auto bg-main-red block md:grid grid-cols-[20%_80%] grid-rows-1">
                <div class="hidden md:flex items-center justify-center">
                    <img src="/frontend/web/<?= $data['about_mission_image']['text'] ?>">
                </div>
                <div class="py-6 pr-5 pl-5 md:pl-0">
                    <div contenteditable="true" data-template="<?= $data['about_mission_title']['id'] ?>" class="border-4 border-blue-500 border-dashed font-bold text-4xl text-white mb-6">
                        <?= $data['about_mission_title']['text'] ?>
                    </div>
                    <div contenteditable="true" data-template="<?= $data['about_mission_description']['id'] ?>" class="border-4 border-blue-500 border-dashed font-light text-xl text-white">
                        <?= $data['about_mission_description']['text'] ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="w-full h-auto grid grid-cols-1 md:grid-cols-[40%_60%] grid-rows-2 md:grid-rows-1">
            <div class="bg-no-repeat bg-center bg-cover" data-template="<?= $data['about_worker_image']['id'] ?>" style="background-image: url('/frontend/web/<?= $data['about_worker_image']['text'] ?>');"></div>
            <div class="px-0 md:px-8 py-5">
                <div data-template="<?= $data['about_worker_title']['id'] ?>" class="inline-block font-bold text-4xl text-white bg-main-red px-10 py-2 mb-10 relative left-0 md:-left-1/4">
                    <?= $data['about_worker_title']['text'] ?>
                </div>
                <div data-template="<?= $data['about_worker_description']['id'] ?>" class="font-medium text-sm text-black whitespace-pre-wrap"><?= $data['about_worker_description']['text'] ?></div>
            </div>
        </div>
        <div class="w-full h-auto py-10">
            <div class="w-full h-full bg-[#F1F1F1] px-16 py-9">
                <div data-template="<?= $data['about_number_title']['id'] ?>" class="font-bold text-4xl text-black mb-11">
                    <?= $data['about_number_title']['text'] ?>
                </div>

                <div class="w-full h-auto grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-y-14">
                    <div>
                        <div data-template="<?= $data['about_number_01']['id'] ?>" class="font-extrabold text-4xl lg:text-[56px] text-main-red">
                            <?= $data['about_number_01']['text'] ?>
                        </div>
                        <div data-template="<?= $data['about_number_01_text']['id'] ?>" class="font-semibold text-lg lg:text-2xl text-black">
                            <?= $data['about_number_01_text']['text'] ?>
                        </div>
                    </div>
                    <div>
                        <div data-template="<?= $data['about_number_02']['id'] ?>" class="font-extrabold text-4xl lg:text-[56px] text-main-red">
                            <?= $data['about_number_02']['text'] ?>
                        </div>
                        <div data-template="<?= $data['about_number_02_text']['id'] ?>" class="font-semibold text-lg lg:text-2xl text-black">
                            <?= $data['about_number_02_text']['text'] ?>
                        </div>
                    </div>
                    <div>
                        <div data-template="<?= $data['about_number_03']['id'] ?>" class="font-extrabold text-4xl lg:text-[56px] text-main-red">
                            <?= $data['about_number_03']['text'] ?>
                        </div>
                        <div data-template="<?= $data['about_number_03_text']['id'] ?>" class="font-semibold text-lg lg:text-2xl text-black">
                            <?= $data['about_number_03_text']['text'] ?>
                        </div>
                    </div>
                    <div>
                        <div data-template="<?= $data['about_number_04']['id'] ?>" class="font-extrabold text-4xl lg:text-[56px] text-main-red">
                            <?= $data['about_number_04']['text'] ?>
                        </div>
                        <div data-template="<?= $data['about_number_04_text']['id'] ?>" class="font-semibold text-lg lg:text-2xl text-black">
                            <?= $data['about_number_04_text']['text'] ?>
                        </div>
                    </div>

                    <div>
                        <div data-template="<?= $data['about_number_05']['id'] ?>" class="font-extrabold text-4xl lg:text-[56px] text-main-red">
                            <?= $data['about_number_05']['text'] ?>
                        </div>
                        <div data-template="<?= $data['about_number_05_text']['id'] ?>" class="font-semibold text-lg lg:text-2xl text-black">
                            <?= $data['about_number_05_text']['text'] ?>
                        </div>
                    </div>

                    <div>
                        <div data-template="<?= $data['about_number_06_title']['id'] ?>" class="font-semibold text-lg lg:text-2xl text-main-red leading-3">
                            <?= $data['about_number_06_title']['text'] ?>
                        </div>
                        <div data-template="<?= $data['about_number_06']['id'] ?>" class="font-extrabold text-4xl lg:text-[56px] text-main-red">
                            <?= $data['about_number_06']['text'] ?>
                        </div>
                        <div data-template="<?= $data['about_number_06_text']['id'] ?>" class="font-semibold text-lg lg:text-2xl text-black">
                            <?= $data['about_number_06_text']['text'] ?>
                        </div>
                    </div>

                </div>
            </div>
        </div>

    </div>
<?php
$script = <<<JS
    let location = 'about';
    $('#a_'+location).removeClass('text-black').addClass('text-main-red').removeClass('font-medium').addClass('font-bold');
JS;

$this->registerJs($script, \yii\web\View::POS_READY);