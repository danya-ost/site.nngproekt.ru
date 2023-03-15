<?php

/** @var \yii\web\View $this */
/** @var \frontend\controllers\HomeController $data */
/** @var \frontend\controllers\HomeController $permission */

$this->title = 'Карьера в ННГП';
?>
<!-- nngp:main-banner -->
<div class="w-full h-[510px] bg-no-repeat bg-center bg-cover relative" id="content_c_b_i" style="background-image: url('/frontend/web/<?= $data['carrier_banner_image']['text'] ?>');">
    <div class="hidden" id="c_b_i" data-template="carrier_<?= $data['carrier_banner_image']['id'] ?>"><?= $data['carrier_banner_image']['text'] ?></div>
    <button name="add_image_c_b_i" style="display: none;" class="absolute right-5 bottom-5 inline-block align-middle text-center rounded px-6 py-2.5 ml-1 mt-1 md:mt-0 bg-black opacity-50 hover:opacity-100 text-white font-medium text-xs leading-tight uppercase hover:bg-gray-900 hover:shadow-lg focus:bg-gray-900 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-gray-900 active:shadow-lg transition duration-150 ease-in-out">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 inline-block align-middle">
            <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 001.5-1.5V6a1.5 1.5 0 00-1.5-1.5H3.75A1.5 1.5 0 002.25 6v12a1.5 1.5 0 001.5 1.5zm10.5-11.25h.008v.008h-.008V8.25zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" />
        </svg>
        <span class="ml-1 inline-block align-middle">Заменить</span>
    </button>
    <?php if ( $permission['adminTemplateCarrier'] ): ?>
        <button id="openEdit" class="absolute top-5 right-5 inline-block align-middle text-center rounded px-6 py-2.5 ml-1 mt-1 md:mt-0 bg-black opacity-50 hover:opacity-100 text-white font-medium text-xs leading-tight uppercase hover:bg-gray-900 hover:shadow-lg focus:bg-gray-900 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-gray-900 active:shadow-lg transition duration-150 ease-in-out">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 inline-block align-middle">
                <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
            </svg>
            <span class="ml-1 inline-block align-middle">Редактировать</span>
        </button>

        <button id="saveEdit" style="display: none;" class="absolute top-5 right-5 inline-block align-middle text-center rounded px-6 py-2.5 ml-1 mt-1 md:mt-0 bg-black opacity-50 hover:opacity-100 text-white font-medium text-xs leading-tight uppercase hover:bg-gray-900 hover:shadow-lg focus:bg-gray-900 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-gray-900 active:shadow-lg transition duration-150 ease-in-out">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 inline-block align-middle">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 9.75v6.75m0 0l-3-3m3 3l3-3m-8.25 6a4.5 4.5 0 01-1.41-8.775 5.25 5.25 0 0110.233-2.33 3 3 0 013.758 3.848A3.752 3.752 0 0118 19.5H6.75z" />
            </svg>
            <span class="ml-1 inline-block align-middle">Сохранить изменения</span>
        </button>

        <button name="add_image_a_b_i" style="display: none;" class="absolute right-5 bottom-5 inline-block align-middle text-center rounded px-6 py-2.5 ml-1 mt-1 md:mt-0 bg-black opacity-50 hover:opacity-100 text-white font-medium text-xs leading-tight uppercase hover:bg-gray-900 hover:shadow-lg focus:bg-gray-900 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-gray-900 active:shadow-lg transition duration-150 ease-in-out">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 inline-block align-middle">
                <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 001.5-1.5V6a1.5 1.5 0 00-1.5-1.5H3.75A1.5 1.5 0 002.25 6v12a1.5 1.5 0 001.5 1.5zm10.5-11.25h.008v.008h-.008V8.25zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" />
            </svg>
            <span class="ml-1 inline-block align-middle">Заменить</span>
        </button>
    <?php endif; ?>
    <div class="w-full h-full bg-[#0000008F] px-11 flex items-center justify-start">
        <div>
            <h1 data-template="carrier_<?= $data['carrier_title']['id'] ?>" class="font-bold text-xl md:text-3xl lg:text-5xl text-white">
                <?= $data['carrier_title']['text'] ?>
            </h1>
        </div>
    </div>
</div>
<!-- /nngp:main-banner -->

<div class="container h-auto px-5 lg:px-0">

    <!-- nngp:principles -->
    <div class="w-full h-auto grid grid-cols-1 lg:grid-cols-2 grid-rows-2 lg:grid-rows-1 gap-8 mt-12 mb-9">
        <div>
            <h1 data-template="carrier_<?= $data['carrier_01_title']['id'] ?>" class="font-bold text-4xl text-black">
                <?= $data['carrier_01_title']['text'] ?>
            </h1>

            <div class="w-full grid grid-cols-[5%_95%] grid-rows-1 mt-10">
                <div>
                    <i class="block w-2 h-2 rounded-full bg-main-red mt-1"></i>
                </div>
                <div data-template="carrier_<?= $data['carrier_01_dot_01']['id'] ?>" class="font-medium text-sm text-black">
                    <?= $data['carrier_01_dot_01']['text'] ?>
                </div>
            </div>

            <div class="w-full grid grid-cols-[5%_95%] grid-rows-1 mt-10">
                <div>
                    <i class="block w-2 h-2 rounded-full bg-main-red mt-1"></i>
                </div>
                <div data-template="carrier_<?= $data['carrier_01_dot_02']['id'] ?>" class="font-medium text-sm text-black">
                    <?= $data['carrier_01_dot_02']['text'] ?>
                </div>
            </div>

            <div class="w-full grid grid-cols-[5%_95%] grid-rows-1 mt-10">
                <div>
                    <i class="block w-2 h-2 rounded-full bg-main-red mt-1"></i>
                </div>
                <div data-template="carrier_<?= $data['carrier_01_dot_03']['id'] ?>" class="font-medium text-sm text-black">
                    <?= $data['carrier_01_dot_03']['text'] ?>
                </div>
            </div>

        </div>
        <div class="bg-no-repeat bg-left-top bg-cover relative" id="content_c_w_i" style="background-image: url('/frontend/web/<?= $data['carrier_work_image']['text'] ?>');">
            <div class="hidden" id="c_w_i" data-template="carrier_<?= $data['carrier_work_image']['id'] ?>"><?= $data['carrier_work_image']['text'] ?></div>
            <button name="add_image_c_w_i" style="display: none;" class="absolute right-5 bottom-5 inline-block align-middle text-center rounded px-6 py-2.5 ml-1 mt-1 md:mt-0 bg-black opacity-50 hover:opacity-100 text-white font-medium text-xs leading-tight uppercase hover:bg-gray-900 hover:shadow-lg focus:bg-gray-900 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-gray-900 active:shadow-lg transition duration-150 ease-in-out">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 inline-block align-middle">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 001.5-1.5V6a1.5 1.5 0 00-1.5-1.5H3.75A1.5 1.5 0 002.25 6v12a1.5 1.5 0 001.5 1.5zm10.5-11.25h.008v.008h-.008V8.25zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" />
                </svg>
                <span class="ml-1 inline-block align-middle">Заменить</span>
            </button>
        </div>
    </div>
    <!-- /nngp:principles -->

    <!-- nngp:education -->
    <div class="w-full h-auto mb-8">
        <h1 data-template="carrier_<?= $data['carrier_02_title']['id'] ?>" class="font-bold text-2xl sm:text-4xl text-black mb-5 sm:mb-7">
            <?= $data['carrier_02_title']['text'] ?>
        </h1>
        <div class="w-full h-auto grid grid-cols-1 md:grid-cols-2 grid-rows-[auto_auto_auto_auto] md:grid-rows-[auto_auto] gap-x-8 gap-y-11">

            <div class="bg-no-repeat bg-center bg-cover min-h-[340px] mzx-h-full relative" id="content_c_e_i" style="background-image: url('/frontend/web/<?= $data['carrier_edu_image']['text'] ?>');">
                <div class="hidden" id="c_e_i" data-template="carrier_<?= $data['carrier_edu_image']['id'] ?>"><?= $data['carrier_edu_image']['text'] ?></div>
                <button name="add_image_c_e_i" style="display: none;" class="absolute right-5 bottom-5 inline-block align-middle text-center rounded px-6 py-2.5 ml-1 mt-1 md:mt-0 bg-black opacity-50 hover:opacity-100 text-white font-medium text-xs leading-tight uppercase hover:bg-gray-900 hover:shadow-lg focus:bg-gray-900 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-gray-900 active:shadow-lg transition duration-150 ease-in-out">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 inline-block align-middle">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 001.5-1.5V6a1.5 1.5 0 00-1.5-1.5H3.75A1.5 1.5 0 002.25 6v12a1.5 1.5 0 001.5 1.5zm10.5-11.25h.008v.008h-.008V8.25zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" />
                    </svg>
                    <span class="ml-1 inline-block align-middle">Заменить</span>
                </button>
            </div>

            <div>
                <p data-template="carrier_<?= $data['carrier_02_text_01']['id'] ?>" class="font-medium text-sm text-black">
                    <?= $data['carrier_02_text_01']['text'] ?>
                </p>

                <div class="w-full grid grid-cols-[5%_95%] grid-rows-1 mt-8">
                    <div>
                        <i class="block w-2 h-2 rounded-full bg-main-red mt-1"></i>
                    </div>
                    <div data-template="carrier_<?= $data['carrier_02_dot_01']['id'] ?>" class="font-medium text-sm text-black">
                        <?= $data['carrier_02_dot_01']['text'] ?>
                    </div>
                </div>

                <div class="w-full grid grid-cols-[5%_95%] grid-rows-1 mt-6">
                    <div>
                        <i class="block w-2 h-2 rounded-full bg-main-red mt-1"></i>
                    </div>
                    <div data-template="carrier_<?= $data['carrier_02_dot_02']['id'] ?>" class="font-medium text-sm text-black">
                        <?= $data['carrier_02_dot_02']['text'] ?>
                    </div>
                </div>

                <div class="w-full grid grid-cols-[5%_95%] grid-rows-1 mt-6">
                    <div>
                        <i class="block w-2 h-2 rounded-full bg-main-red mt-1"></i>
                    </div>
                    <div data-template="carrier_<?= $data['carrier_02_dot_03']['id'] ?>" class="font-medium text-sm text-black">
                        <?= $data['carrier_02_dot_03']['text'] ?>
                    </div>
                </div>

                <p data-template="carrier_<?= $data['carrier_02_text_02']['id'] ?>" class="font-medium text-sm text-black mt-5">
                    <?= $data['carrier_02_text_02']['text'] ?>
                </p>

            </div>

            <div data-template="carrier_<?= $data['carrier_03_text']['id'] ?>" class="font-medium text-sm text-black">
                <?= $data['carrier_03_text']['text'] ?>
            </div>

            <div data-template="carrier_<?= $data['carrier_04_text']['id'] ?>" class="bg-main-gray px-11 py-5 sm:py-12 font-light text-xl text-white leading-8">
                <?= $data['carrier_04_text']['text'] ?>
            </div>

        </div>
    </div>
    <!-- /nngp:education -->

    <!-- nngp:professional -->
    <div class="w-full h-auto bg-[#F1F1F1] px-5 md:px-9 py-11 mb-4">
        <h1 data-template="carrier_<?= $data['carrier_05_title']['id'] ?>" class="font-light text-xl text-black">
            <?= $data['carrier_05_title']['text'] ?>
        </h1>

        <div data-template="carrier_<?= $data['carrier_05_text']['id'] ?>" class="font-medium text-sm text-black">
            <?= $data['carrier_05_text']['text'] ?>
        </div>
    </div>
    <!-- /nngp:professional -->

</div>

<div class="modal fade fixed top-0 left-0 hidden w-full h-full outline-none overflow-x-hidden overflow-y-auto" id="imageModal" tabindex="-1" aria-labelledby="exampleModalCenterTitle" aria-modal="true" role="dialog">
    <div class="modal-dialog modal-dialog-centered relative w-auto pointer-events-none">
        <div class="modal-content border-none shadow-lg relative flex flex-col w-full pointer-events-auto bg-white bg-clip-padding outline-none text-current">
            <div id="add_image_head" class="modal-header flex flex-shrink-0 items-top justify-between p-4 border-b border-gray-200 ">
                <h5 class="text-xl font-medium leading-normal text-gray-800" id="exampleModalScrollableLabel">
                    Загрузка изображения
                </h5>
                <button type="button"
                        id="close_image"
                        class="inline-block px-3 py-2.5 bg-gray-200 text-gray-700 font-medium text-xs leading-tight uppercase shadow-md hover:bg-gray-300 hover:shadow-lg focus:bg-gray-300 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-gray-400 active:shadow-lg transition duration-150 ease-in-out"
                        data-bs-dismiss="modal" aria-label="Close">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 19.5l15-15m-15 0l15 15" />
                    </svg>
                </button>
            </div>
            <div id="content_image" class="modal-body relative p-4">
                <div id="add_image_content">
                    <p class="text-base text-black">
                        Допустимые форматы изображения: jpg, png <br> <br>
                    </p>
                    <input class="form-control block w-full px-3 py-1.5 text-xs sm:text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-main-red focus:bg-white focus:border-main-red focus:outline-none"
                           type="file"
                           name="imageFile"
                           accept=".jpg, .jpeg, .png, .webmp"
                           id="imageFile">
                </div>
                <div id="add_image_loader" style="display: none;" class="w-full h-auto flex items-center justify-center py-10">
                    <div class="spinner-border animate-spin inline-block w-10 h-10 border-4 rounded-full text-main-red" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                </div>
            </div>
            <div id="add_image_footer" class="modal-footer flex flex-shrink-0 flex-wrap items-center justify-end p-4 border-t border-gray-200 rounded-b-md">
                <button type="button" id="imageAdd" class="inline-block align-middle text-center rounded px-6 py-2.5 ml-1 mt-1 md:mt-0 bg-black text-white font-medium text-xs leading-tight uppercase hover:bg-gray-900 hover:shadow-lg focus:bg-gray-900 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-gray-900 active:shadow-lg transition duration-150 ease-in-out">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 inline-block align-middle">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 9.75v6.75m0 0l-3-3m3 3l3-3m-8.25 6a4.5 4.5 0 01-1.41-8.775 5.25 5.25 0 0110.233-2.33 3 3 0 013.758 3.848A3.752 3.752 0 0118 19.5H6.75z" />
                    </svg>
                    <span class="ml-1 inline-block align-middle">Заменить</span>
                </button>
            </div>
        </div>
    </div>
</div>
<button type="button" id="openImageModal" class="hidden" data-bs-toggle="modal" data-bs-target="#imageModal"></button>

<?php
$script = <<<JS
    let location_page = 'carrier';
    $('#a_'+location_page).removeClass('text-black').addClass('text-main-red').removeClass('font-medium').addClass('font-bold');
    
    $('#openEdit').on('click', function (){
        $(this).hide();
        $('*[data-template^=\'carrier_\']').each(function (){
            $(this).attr('contenteditable', true).css({
                borderWidth: '2px',
                borderStyle: 'dashed',
                borderColor: '#3b82f6'
            }); 
        });
        $('button[name=\'add_image_c_b_i\']').show();
        $('button[name=\'add_image_c_w_i\']').show();
        $('button[name=\'add_image_c_e_i\']').show();
        $('#saveEdit').show();
    });
    
    let selected_image;
    $('button[name^=\'add_image_\']').on('click', function (){
        selected_image = $(this).attr('name').replace('add_image_', '');
        $('#openImageModal').trigger('click');
    });
    
    $('#imageAdd').on('click', function (){
        let _file = $('input[name=\'imageFile\']').prop('files')[0];
        if( typeof _file == 'undefined' ) return false;
        let _data = new FormData();
        _data.append('file', _file);
        $.ajax({
            url: '/frontend/web/tools/upload',
            type: 'post',
            data: _data,
            dataType: 'html',
            processData: false,
            contentType: false,
            beforeSend: function (){
                $('#add_image_head').hide();
                $('#add_image_content').hide();
                $('#add_image_footer').hide();
                $('#add_image_loader').show();
            },
            success: function (response){
                $('#'+selected_image).text(response);
                $('#content_'+selected_image).css('background-image', 'url(\'/frontend/web/'+response+'\')');
                $('#close_image').trigger('click');
                setTimeout(function (){
                    $('#add_image_head').show();
                    $('#add_image_content').show();
                    $('#add_image_footer').show();
                    $('#add_image_loader').hide();
                }, 1000);
            },
            error: function (response){
                alert("Упс! Кажется произошла ошибка при загрузке данных. Пожалуйста, перезагрузите страницу или попробуйте позже!\\n\\nОтвет ошибки:\\n" + response['responseText']);
                console.log(response);
            }
        });
    });
    
    $('#saveEdit').on('click', function (){
        $(this).hide();
        let data = [];
        $('*[data-template^=\'carrier_\']').each(function (){
            let id = $(this).attr('data-template').replace('carrier_', '');
            let content = $(this).text();
            data.push([id, content.trim()]);
        });
        $.ajax({
            url: '/frontend/web/home/carrier-update',
            type: 'post',
            dataType: 'html',
            data: { 'data': data },
            beforeSend: function (){
                $('*[data-template^=\'carrier_\']').each(function (){
                    $(this).attr('contenteditable', false).removeAttr('style').addClass('gradient-load');
                });
            },
            success: function (response){
                getLogs('template', 'carrier', 'updating data to about page', 1, false);
                location.reload();
            }, 
            error: function (response){
                getLogs('template', 'carrier', 'updating data to about page', 0, response['responseText']);
                alert("Упс! Кажется произошла ошибка при загрузке данных. Пожалуйста, перезагрузите страницу или попробуйте позже!\\n\\nОтвет ошибки:\\n" + response['responseText']);
                console.log(response);
            } 
        });
    });
JS;

$this->registerJs($script, \yii\web\View::POS_READY);