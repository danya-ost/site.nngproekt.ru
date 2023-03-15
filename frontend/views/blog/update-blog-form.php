<?php

/** @var yii\web\View $this */
/** @var \frontend\controllers\BlogController $data */

$id = $_GET['b'];

$this->title = 'Редактирование поста';
?>
    <div class="container">

        <a onclick="javascript:history.back(); return false;" class="inline-block align-middle mr-2 px-2.5 py-2 border-2 border-gray-800 text-gray-800 font-medium text-xs leading-tight uppercase rounded hover:bg-black hover:bg-opacity-5 focus:outline-none focus:ring-0 transition duration-150 ease-in-out">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 inline-block align-middle">
                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 12h-15m0 0l6.75 6.75M4.5 12l6.75-6.75" />
            </svg>
        </a>

        <h1 class="inline-block align-middle font-semibold text-2xl">
            Редактирование поста
        </h1>

        <form id="newsContainer" class="w-full h-auto">

            <div class="mt-5">
                <label for="title" class="font-light text-xs text-stone-500">
                    Наименование
                </label>
                <input type="text"
                       name="title"
                       maxlength="50"
                       id="title"
                       value="<?= $data['title'] ?>"
                       placeholder="Введите наименование записи"
                       class="block w-full py-2 font-medium text-sm border-b border-solid border-b-stone-300 bg-[#F8F8F8] focus:border-b-main-red focus:outline-none">
            </div>

            <div class="mt-5">
                <label for="annotation" class="font-light text-xs text-stone-500">
                    Аннотация
                </label>
                <textarea
                    name="annotation"
                    maxlength="200"
                    rows="3"
                    placeholder="Введите краткое описание"
                    class="block w-full py-2 font-medium text-sm border-b border-solid border-b-stone-300 bg-[#F8F8F8] focus:border-b-main-red focus:outline-none"><?= $data['annotation'] ?></textarea>
            </div>

            <div class="mt-5">
                <label for="content" class="font-light text-xs text-stone-500">
                    Контент
                </label>
                <textarea name="content" id="content"><?= $data['content'] ?></textarea>
            </div>

            <div id="covers" class="mt-5 grid grid-cols-1 sm:grid-cols-2 grid-rows-1 gap-5">
                <div>
                    <label for="image" class="font-light text-xs text-stone-500">
                        Обложка
                    </label>
                    <input type="hidden" name="image" value="<?= $data['thumb'] ?>" id="image">
                    <div id="imageView" class="min-h-[350px] max-h-full w-full bg-cover bg-center bg-no-repeat" style="background-image: url('/frontend/web/<?= $data['thumb'] ?>');">

                    </div>
                </div>
                <div>
                    <label for="video" class="font-light text-xs text-stone-500">
                        Видео
                    </label>
                    <input type="hidden" name="video" value="<?= $data['video'] ?>" id="video">
                    <video id="videoView" src="/frontend/web/<?= $data['video'] ?>" height="350" controls class="w-full" style="height: 350px;">
                        <source id="videoViewSrc" src="/frontend/web/<?= $data['video'] ?>" type="video/mp4">
                    </video>
                </div>
            </div>

            <div class="py-10">
                <button type="button" id="btnImgReload" data-bs-toggle="modal" data-bs-target="#imageModal" class="inline-block align-middle rounded mt-1 px-6 py-2.5 ml-1 bg-gray-200 text-gray-700 font-medium text-xs leading-tight uppercase shadow-md hover:bg-gray-300 hover:shadow-lg focus:bg-gray-300 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-gray-400 active:shadow-lg transition duration-150 ease-in-out">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 inline-block align-middle">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 001.5-1.5V6a1.5 1.5 0 00-1.5-1.5H3.75A1.5 1.5 0 002.25 6v12a1.5 1.5 0 001.5 1.5zm10.5-11.25h.008v.008h-.008V8.25zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" />
                    </svg>
                    <span class="ml-1 inline-block align-middle">Заменить обложку</span>
                </button>

                <?php if ( $data['video'] != NULL ): ?>
                    <button type="button" id="btnVideoReload" data-bs-toggle="modal" data-bs-target="#videoModal" class="inline-block align-middle rounded mt-1 px-6 py-2.5 ml-1 bg-gray-200 text-gray-700 font-medium text-xs leading-tight uppercase shadow-md hover:bg-gray-300 hover:shadow-lg focus:bg-gray-300 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-gray-400 active:shadow-lg transition duration-150 ease-in-out">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 inline-block align-middle">
                            <path stroke-linecap="round" d="M15.75 10.5l4.72-4.72a.75.75 0 011.28.53v11.38a.75.75 0 01-1.28.53l-4.72-4.72M4.5 18.75h9a2.25 2.25 0 002.25-2.25v-9a2.25 2.25 0 00-2.25-2.25h-9A2.25 2.25 0 002.25 7.5v9a2.25 2.25 0 002.25 2.25z" />
                        </svg>
                        <span class="ml-1 inline-block align-middle">Заменить видео</span>
                    </button>
                <?php else: ?>
                    <button type="button" id="btnVideoAdd" data-bs-toggle="modal" data-bs-target="#videoModal" class="inline-block align-middle rounded mt-1 px-6 py-2.5 ml-1 bg-gray-800 text-white font-medium text-xs leading-tight uppercase shadow-md hover:bg-gray-900 hover:shadow-lg focus:bg-gray-900 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-gray-900 active:shadow-lg transition duration-150 ease-in-out">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 inline-block align-middle">
                            <path stroke-linecap="round" d="M15.75 10.5l4.72-4.72a.75.75 0 011.28.53v11.38a.75.75 0 01-1.28.53l-4.72-4.72M4.5 18.75h9a2.25 2.25 0 002.25-2.25v-9a2.25 2.25 0 00-2.25-2.25h-9A2.25 2.25 0 002.25 7.5v9a2.25 2.25 0 002.25 2.25z" />
                        </svg>
                        <span class="ml-1 inline-block align-middle">Добавить видео</span>
                    </button>
                <?php endif; ?>

                <button type="button" id="sendForm" class="inline-block align-middle mt-1 md:float-right rounded px-6 py-2.5 ml-1 bg-gray-800 text-white font-medium text-xs leading-tight uppercase shadow-md hover:bg-gray-900 hover:shadow-lg focus:bg-gray-900 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-gray-900 active:shadow-lg transition duration-150 ease-in-out">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 inline-block align-middle">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 9.75v6.75m0 0l-3-3m3 3l3-3m-8.25 6a4.5 4.5 0 01-1.41-8.775 5.25 5.25 0 0110.233-2.33 3 3 0 013.758 3.848A3.752 3.752 0 0118 19.5H6.75z" />
                    </svg>
                    <span class="ml-1 inline-block align-middle">Сохранить</span>
                </button>
            </div>

        </form>

        <div id="loader" class="w-full h-auto flex items-center justify-center py-10">
            <div class="spinner-border animate-spin inline-block w-10 h-10 border-4 rounded-full text-main-red mb-24" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
        </div>

    </div>

    <div class="modal fade fixed top-0 left-0 hidden w-full h-full outline-none overflow-x-hidden overflow-y-auto" id="imageModal" tabindex="-1" aria-labelledby="exampleModalCenterTitle" aria-modal="true" role="dialog">
        <div class="modal-dialog modal-dialog-centered relative w-auto pointer-events-none">
            <div class="modal-content border-none shadow-lg relative flex flex-col w-full pointer-events-auto bg-white bg-clip-padding outline-none text-current">
                <div class="modal-header flex flex-shrink-0 items-top justify-between p-4 border-b border-gray-200 ">
                    <h5 class="text-xl font-medium leading-normal text-gray-800" id="exampleModalScrollableLabel">
                        Загрузка обложки
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
                    <div id="selected_file">
                        <p class="text-base text-black">
                            Допустимые форматы изображения: jpg, png <br> <br>
                        </p>
                        <input class="form-control block w-full px-3 py-1.5 text-xs sm:text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-main-red focus:bg-white focus:border-main-red focus:outline-none"
                               type="file"
                               name="imageFile"
                               accept=".jpg, .jpeg, .png, .webmp"
                               id="imageFile">
                    </div>
                    <div id="loader_image" class="w-full h-auto flex items-center justify-center py-5">
                        <div class="spinner-border animate-spin inline-block w-10 h-10 border-4 rounded-full text-main-red mb-24" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                    </div>
                </div>
                <div class="modal-footer flex flex-shrink-0 flex-wrap items-center justify-end p-4 border-t border-gray-200 rounded-b-md">
                    <button type="button" id="imageAdd" class="inline-block px-6 py-2.5 bg-red-600 text-white font-medium text-xs leading-tight uppercase shadow-md hover:bg-red-700 hover:shadow-lg focus:bg-red-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-red-800 active:shadow-lg transition duration-150 ease-in-out">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 inline-block align-middle">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 9.75v6.75m0 0l-3-3m3 3l3-3m-8.25 6a4.5 4.5 0 01-1.41-8.775 5.25 5.25 0 0110.233-2.33 3 3 0 013.758 3.848A3.752 3.752 0 0118 19.5H6.75z" />
                        </svg>
                        <span class="ml-1 inline-block align-middle">Прикрепить</span>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade fixed top-0 left-0 hidden w-full h-full outline-none overflow-x-hidden overflow-y-auto" id="videoModal" tabindex="-1" aria-labelledby="exampleModalCenterTitle" aria-modal="true" role="dialog">
        <div class="modal-dialog modal-dialog-centered relative w-auto pointer-events-none">
            <div class="modal-content border-none shadow-lg relative flex flex-col w-full pointer-events-auto bg-white bg-clip-padding outline-none text-current">
                <div class="modal-header flex flex-shrink-0 items-top justify-between p-4 border-b border-gray-200">
                    <h5 class="text-xl font-medium leading-normal text-gray-800" id="exampleModalScrollableLabel">
                        Загрузка видео
                    </h5>
                    <button type="button"
                            id="close_video"
                            class="inline-block px-3 py-2.5 bg-gray-200 text-gray-700 font-medium text-xs leading-tight uppercase shadow-md hover:bg-gray-300 hover:shadow-lg focus:bg-gray-300 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-gray-400 active:shadow-lg transition duration-150 ease-in-out"
                            data-bs-dismiss="modal" aria-label="Close">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 19.5l15-15m-15 0l15 15" />
                        </svg>
                    </button>
                </div>
                <div id="input_video" class="modal-body relative p-4">
                    <div id="selected_file">
                        <p class="text-base text-black">
                            Допустимые форматы видео: mp4 <br> <br>
                        </p>
                        <input class="form-control block w-full px-3 py-1.5 text-xs sm:text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-main-red focus:bg-white focus:border-main-red focus:outline-none"
                               type="file"
                               name="videoFile"
                               accept="video/mp4"
                               id="videoFile">
                    </div>
                    <div id="loader_video" class="w-full h-auto flex items-center justify-center py-5">
                        <div class="spinner-border animate-spin inline-block w-10 h-10 border-4 rounded-full text-main-red mb-24" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                    </div>
                </div>
                <div class="modal-footer flex flex-shrink-0 flex-wrap items-center justify-end p-4 border-t border-gray-200 rounded-b-md">
                    <button type="button" id="videoAdd" class="inline-block px-6 py-2.5 bg-red-600 text-white font-medium text-xs leading-tight uppercase shadow-md hover:bg-red-700 hover:shadow-lg focus:bg-red-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-red-800 active:shadow-lg transition duration-150 ease-in-out">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 inline-block align-middle">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 9.75v6.75m0 0l-3-3m3 3l3-3m-8.25 6a4.5 4.5 0 01-1.41-8.775 5.25 5.25 0 0110.233-2.33 3 3 0 013.758 3.848A3.752 3.752 0 0118 19.5H6.75z" />
                        </svg>
                        <span class="ml-1 inline-block align-middle">Прикрепить</span>
                    </button>
                </div>
            </div>
        </div>
    </div>

<?php
$script_tinymce  = <<<JS
    tinymce.init({
      selector: 'textarea#content',
      plugins: 'a11ychecker advcode casechange export formatpainter image editimage linkchecker autolink lists checklist media mediaembed pageembed permanentpen powerpaste table advtable tableofcontents tinycomments tinymcespellchecker',
    });
JS;

$script = <<<JS

    let values = {
        'title': $('input[name=\'title\']'),
        'annotation': $('textarea[name=\'annotation\']'),
        'content': tinymce.get("content").getContent(),
        'image': $('input[name=\'image\']'),
        'imageFile': $('input[name=\'imageFile\']'),
        'video': $('input[name=\'video\']'),
        'videoFile': $('input[name=\'videoFile\']'),
    }
    let elements = {
        'container': $('#newsContainer'),
        'loader_image': $('#loader_image'),
        'loader_video': $('#loader_video'),
        'btn_img_reload_modal': $('#btnImgReload'),
        'btn_video_add_modal': $('#btnVideoAdd'),
        'btn_video_reload_modal': $('#btnVideoReload'),
        'btn_img_add': $('#imageAdd'),
        'btn_video_add': $('#videoAdd'),
        'btn_close_img_modal': $('#close_image'),
        'btn_close_video_modal': $('#close_video'),
        'loader': $('#loader'),
        'img_view': $('#imageView'),
        'video_view': $('#videoView'),
        'video_src': $('#videoViewSrc'),
        'covers': $('#covers'),
        'btnSave': $('#sendForm'),
        'container_adding': $('#newsView')
    }
    
    elements.loader.hide();
    elements.loader_image.hide();
    elements.loader_video.hide();
    
    elements.btn_img_add.on('click', function (){
        let _file = values.imageFile.prop('files')[0];
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
                elements.loader_image.show();
                $(this).hide();
                values.imageFile.hide();
            },
            success: function (response){
                elements.img_view.css('background-image', 'url(\'/frontend/web/'+response+'\')');
                values.image.val(response);
                elements.covers.show();
                elements.btn_img_reload_modal.show();
                $(this).show();
                elements.loader_image.hide();
                values.imageFile.show();
                elements.btn_close_img_modal.trigger('click');
            },
            error: function (response){
                alert("Упс! Кажется произошла ошибка при загрузке данных. Пожалуйста, перезагрузите страницу или попробуйте позже!\\n\\nОтвет ошибки:\\n" + response['responseText']);
                console.log(response);
            }
        });
    });
    
    elements.btn_video_add.on('click', function (){
        let _file = values.videoFile.prop('files')[0];
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
                elements.loader_video.show();
                $(this).hide();
                values.videoFile.hide();
            },
            success: function (response){
                elements.video_view.attr('src', '/frontend/web/'+response);
                elements.video_src.attr('src', '/frontend/web/'+response);
                values.video.val(response);
                elements.covers.show();
                elements.btn_video_add_modal.hide();
                elements.btn_video_reload_modal.show();
                $(this).show();
                elements.loader_video.hide();
                values.videoFile.show();
                elements.btn_close_video_modal.trigger('click');
            },
            error: function (response){
                alert("Упс! Кажется произошла ошибка при загрузке данных. Пожалуйста, перезагрузите страницу или попробуйте позже!\\n\\nОтвет ошибки:\\n" + response['responseText']);
                console.log(response);
            }
        });
    });
    
    elements.btnSave.on('click', function (){
        $.ajax({
            url: '/frontend/web/blog/update-post',
            type: 'post',
            dataType: 'html',
            data: {
                'id': '$id',
                'title': values.title.val(),
                'annotation': values.annotation.val(),
                'content': tinymce.get("content").getContent(),
                'image_src': values.image.val(),
                'video_src': values.video.val(),
            },
            beforeSend: function (){
                elements.loader.show();
                elements.container.hide();
            },
            success: function (response){
                window.location.href = '/frontend/web/blog/view-post?b='+response;
                getLogs('blog', 'update', 'updating blog post id: '+'$id', 1, false);
            },
            error: function (response){
                getLogs('blog', 'update', 'updating blog post id: '+'$id', 0, response['responseText']);
                alert("Упс! Кажется произошла ошибка при загрузке данных. Пожалуйста, перезагрузите страницу или попробуйте позже!\\n\\nОтвет ошибки:\\n" + response['responseText']);
                console.log(response);
            }
        }) 
    });
JS;


$this->registerJs($script_tinymce, \yii\web\View::POS_READY);
$this->registerJs($script, \yii\web\View::POS_READY);
