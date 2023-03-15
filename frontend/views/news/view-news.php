<?php

/** @var \yii\web\View $this */
/** @var \frontend\controllers\NewsController $data */
/** @var \frontend\controllers\NewsController $breadcrumbs */
/** @var \frontend\controllers\NewsController $liked */
/** @var \frontend\controllers\NewsController $permission */
/** @var \frontend\controllers\NewsController $user_avatar */

use yii\helpers\Url;

$this->title = $data['title'];
?>

<div class="container h-auto">

    <div class="w-full h-auto hidden sm:flex items-center justify-start">
        <a href="<?= $breadcrumbs[0] ?>" class="block font-light text-sm text-stone-500">
            Главная
        </a>
        <i class="w-px h-5 bg-stone-300 block mx-2"></i>
        <a href="<?= $breadcrumbs[1] ?>" class="block font-light text-sm text-main-red">
            Новости
        </a>
        <i class="w-px h-5 bg-stone-300 block mx-2"></i>
        <a href="<?= $breadcrumbs[3] ?>" class="block font-light text-sm text-stone-500">
            <?= $data['title'] ?>
        </a>
    </div>

    <?php if ( $permission['addNews'] || $permission['updateNews'] || $permission['deleteNews'] ): ?>
        <div class="relative rounded overflow-hidden my-5 bg-white shadow-sm hover:shadow-lg px-2 py-3 border border-solid border-stone-200 duration-200 ease-in-out transition-all pb-10 sm:pb-3">
            <div class="text-xs rounded-tl bg-stone-200 text-white font-bold absolute right-0 bottom-0 px-5 py-1 border-t border-l border-solid border-stone-200">NNGP ADMIN</div>
            <?php if ( $permission['updateNews'] ): ?>
                <a href="<?= Url::to(['/news/update-news-form', 'n' => $data['id']]) ?>" class="block sm:inline-block align-middle text-center rounded px-6 py-2.5 ml-1 mt-1 md:mt-0 bg-stone-300 text-white font-medium text-xs leading-tight uppercase hover:bg-gray-900 hover:shadow-lg focus:bg-gray-900 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-gray-900 active:shadow-lg transition duration-150 ease-in-out">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 inline-block align-middle">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                    </svg>
                    <span class="ml-1 inline-block align-middle">Редактировать</span>
                </a>
            <?php endif; ?>
            <?php if ( $permission['deleteNews'] ): ?>
                <button type="button" name="delete_news_<?= $data['id'] ?>" data-id="<?= $data['id'] ?>" title="Удалить" class="block sm:inline-block w-full sm:w-auto align-middle text-center rounded px-6 py-2.5 ml-1 mt-1 md:mt-0 bg-stone-300 text-white font-medium text-xs leading-tight uppercase hover:bg-gray-900 hover:shadow-lg focus:bg-gray-900 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-gray-900 active:shadow-lg transition duration-150 ease-in-out">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 inline-block align-middle">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                    </svg>
                    <span class="ml-1 inline-block align-middle">Удалить</span>
                </button>
                <div class="modal fade fixed top-0 left-0 hidden w-full h-full outline-none overflow-x-hidden overflow-y-auto" id="modalDelete" tabindex="-1" aria-labelledby="exampleModalCenterTitle" aria-modal="true" role="dialog">
                    <div class="modal-dialog modal-dialog-centered relative w-auto pointer-events-none">
                        <div class="modal-content border-none shadow-lg relative flex flex-col w-full pointer-events-auto bg-white bg-clip-padding outline-none text-current">
                            <div class="modal-header flex flex-shrink-0 items-center justify-between p-4 border-b border-gray-200">
                                <h5 class="text-xl font-medium leading-normal text-gray-800" id="exampleModalScrollableLabel">
                                    Подтверждение действия
                                </h5>
                            </div>
                            <div class="modal-body relative p-4">
                                <p id="deleteContent" class="font-medium text-xl text-black text-center">
                                    Вы уверены, что хотите удалить эту новость?
                                </p>
                                <div id="deleteLoader" class="w-full h-auto flex items-center justify-center py-5" style="display: none;">
                                    <div class="spinner-border animate-spin inline-block w-10 h-10 border-4 rounded-full text-main-red mb-24" role="status">
                                        <span class="visually-hidden">Loading...</span>
                                    </div>
                                </div>
                            </div>
                            <div id="deleteButtons" class="modal-footer flex flex-shrink-0 flex-wrap items-center justify-center p-4 border-t border-gray-200">
                                <button type="button" id="deleteModalClose" data-bs-dismiss="modal" aria-label="Close" class="inline-block align-middle rounded px-3 py-2.5 ml-1 bg-gray-800 text-white font-medium text-xs leading-tight uppercase shadow-md hover:bg-gray-900 hover:shadow-lg focus:bg-gray-900 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-gray-900 active:shadow-lg transition duration-150 ease-in-out">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="inline-block align-middle w-4 h-4">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15M12 9l-3 3m0 0l3 3m-3-3h12.75" />
                                    </svg>
                                </button>
                                <button type="button" id="btnDelete" data-id="0" class="inline-block align-middle rounded px-6 py-2.5 ml-1 bg-gray-800 text-white font-medium text-xs leading-tight uppercase shadow-md hover:bg-gray-900 hover:shadow-lg focus:bg-gray-900 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-gray-900 active:shadow-lg transition duration-150 ease-in-out">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="inline-block align-middle w-4 h-4">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                    </svg>
                                    <span class="ml-1 inline-block align-middle">Удалить</span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <button type="button" id="openDeleteNews" data-bs-toggle="modal" data-bs-target="#modalDelete" class="hidden"></button>
            <?php endif; ?>
        </div>
    <?php endif; ?>

    <div id="containerNews" data-news="<?= $data['id'] ?>" class="max-w-[1100px] h-auto bg-white px-5 sm:px-14 md:px-24 py-8 mt-8 mb-8 m-auto">
        <div class="block sm:flex items-center justify-between">

            <div class="flex items-center justify-start">
                <div class="font-medium text-xs sm:text-sm text-stone-400">
                    <?= $data['date_add'] ?>
                </div>

                <button type="button" id="liked" data-liked="<?= $liked ?>" class="ml-3 <?= $liked == 0 ? 'text-stone-300' : 'text-main-red' ?>">
                    <svg width="20" height="18" viewBox="0 0 20 18" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                        <path d="M14.6875 0.171875C13.6022 0.171875 12.6072 0.515781 11.7302 1.19406C10.8894 1.84434 10.3296 2.67258 10 3.27484C9.67043 2.67254 9.11063 1.84434 8.2698 1.19406C7.39277 0.515781 6.39777 0.171875 5.3125 0.171875C2.28391 0.171875 0 2.6491 0 5.93414C0 9.48312 2.84934 11.9113 7.16285 15.5872C7.89535 16.2114 8.72563 16.919 9.58859 17.6737C9.70234 17.7733 9.84844 17.8281 10 17.8281C10.1516 17.8281 10.2977 17.7733 10.4114 17.6737C11.2745 16.9189 12.1047 16.2114 12.8376 15.5868C17.1507 11.9113 20 9.48312 20 5.93414C20 2.6491 17.7161 0.171875 14.6875 0.171875Z"/>
                    </svg>
                </button>
            </div>

            <h1 class="font-medium text-xs sm:text-sm uppercase text-stone-400">
                <?= $data['department'] ?>
            </h1>

        </div>

        <?php if ( $data['video_src'] ): ?>
            <video src="/frontend/web/<?= $data['video_src'] ?>" controls class="w-full mt-5 mb-9 bg-no-repeat bg-center bg-cover">
                <source src="/frontend/web/<?= $data['video_src'] ?>" type="video/mp4">
            </video>
        <?php else: ?>
            <div class="w-full h-[350px] lg:h-[500px] mt-5 mb-9 bg-no-repeat bg-center bg-cover" style="background-image: url('/frontend/web/<?= $data['image_src'] ?>');"></div>
        <?php endif; ?>

        <h1 class="text-3xl lg:text-4xl font-bold mb-8">
            <?= $data['title'] ?>
        </h1>

        <div class="w-full h-auto">
            <?= $data['annotation'] ?>
            <hr class="my-10">
            <?= $data['content'] ?>
        </div>
    </div>

    <div id="caseComment" class="max-w-[1100px] h-auto bg-white px-5 sm:px-14 md:px-24 py-8 mb-20 m-auto">
        <h2 class="font-bold text-xl">Комментарии</h2>
        <div class="grid grid-cols-[auto_80px] sm:grid-cols-[120px_auto_80px] grid-rows-1 mt-4">
            <div class="hidden sm:block">
                <div class="inline-block w-[64px] h-[64px] border border-solid border-main-red rounded-full relative left-2/4 -translate-x-2/4 bg-center bg-no-repeat bg-cover" style="background-image: url('/frontend/web/<?= $user_avatar ?>');"></div>
            </div>
            <div>
                <textarea type="text" id="textComment" placeholder="Комментировать" rows="3" class="h-16 w-full px-6 py-5 bg-gray-100/80 rounded-3xl focus:outline-none"></textarea>
                <button id="responseUser" class="font-bold text-main-red pl-5" style="display: none;">
                    <span class="inline-block align-middle">ответ пользователю <span></span></span>
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="inline-block align-middle w-5 h-5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
            <div>
                <button id="sendComment" class="inline-block w-[64px] h-[64px] hover:text-main-red" disabled>
                    <div class="w-full h-full flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-8 h-8">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 12L3.269 3.126A59.768 59.768 0 0121.485 12 59.77 59.77 0 013.27 20.876L5.999 12zm0 0h7.5" />
                        </svg>
                    </div>
                </button>
                <div id="loaderComment" class="inline-block w-[64px] h-[64px]" style="display: none;">
                    <div class="w-full h-full flex items-center justify-center">
                        <div class="spinner-border animate-spin inline-block w-5 h-5 border-4 rounded-full text-main-red" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div id="comments" class="mt-10"></div>
        <div id="onloadCommetns" class="w-full h-auto flex items-center justify-center py-10">
            <div class="spinner-border animate-spin inline-block w-10 h-10 border-4 rounded-full text-main-red" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
        </div>
    </div>

    <div id="relevantNews" class="w-full h-auto mb-16">
        <h1 class="font-bold text-4xl mb-9">
            ДРУГИЕ НОВОСТИ
        </h1>

        <div id="containerRelevantNews" class="w-full h-auto grid grid-cols-1 md:grid-cols-2 grid-rows-2 md:grid-rows-1 gap-5"></div>
    </div>

</div>
<?php
$script = <<<JS
    $("textarea").keyup(function(e) {
        while($(this).outerHeight() < this.scrollHeight + parseFloat($(this).css("borderTopWidth")) + parseFloat($(this).css("borderBottomWidth"))) {
            $(this).height($(this).height()+1);
        }
    });

    let e = {
        btn_liked: $('#liked'),
        id_news: $('#containerNews').attr('data-news'),
        relevant_container: $('#containerRelevantNews'),
        loader_relevant: $('#relevantNews')
    }
    
    e.loader_relevant.hide();
    
    $.ajax({
        url: '/frontend/web/news/views',
        type: 'post',
        dataType: 'html',
        data: { 'id': e.id_news },
        error: function (response){
            alert("Упс! Кажется произошла ошибка при загрузке данных. Пожалуйста, перезагрузите страницу или попробуйте позже!\\n\\nОтвет ошибки:\\n" + response['responseText']);
            console.log(response);
        }
    });

    $.ajax({
        url: '/frontend/web/news/relevant-news',
        type: 'post',
        dataType: 'html',
        data: { 'id': e.id_news },
        success: function (response){
            e.relevant_container.html(response);
            e.loader_relevant.show();
        },
        error: function (response){
            alert("Упс! Кажется произошла ошибка при загрузке данных. Пожалуйста, перезагрузите страницу или попробуйте позже!\\n\\nОтвет ошибки:\\n" + response['responseText']);
            console.log(response);
        }
    });

    e.btn_liked.on('click', function (){
        $(this).hide();
        let status = $(this).attr('data-liked');
        if( status == 0 ){
            $(this).removeClass('text-stone-300').addClass('text-main-red').attr('data-liked', 1);
        } else{
            $(this) .removeClass('text-main-red').addClass('text-stone-300').attr('data-liked', 0);
        }
        $.ajax({
            url: '/frontend/web/news/liked',
            type: 'post',
            dataType: 'html',
            data: { 'id': e.id_news, 'status': status },
            error: function (response){
                alert("Упс! Кажется произошла ошибка при загрузке данных. Пожалуйста, перезагрузите страницу или попробуйте позже!\\n\\nОтвет ошибки:\\n" + response['responseText']);
                console.log(response);
            }
        });
        $(this).show();
    });
    
    let delete_id = 0;
    
    $('button[name^=\'delete_news_\']').on('click', function (){
        $('#openDeleteNews').trigger('click');
        delete_id = $(this).attr('data-id');
    });
    
    $('#btnDelete').on('click', function (){
        $.ajax({
            url: '/frontend/web/news/delete-news',
            type: 'post',
            data: { 'id': delete_id },
            dataType: 'html',
            beforeSend: function (){
                $('#deleteContent').hide();
                $('#deleteLoader').show();
            },
            success: function (response){
                window.location.href = '/frontend/web/news/index';
            },
            error: function (response){
                alert("Упс! Кажется произошла ошибка при загрузке данных. Пожалуйста, перезагрузите страницу или попробуйте позже!\\n\\nОтвет ошибки:\\n" + response['responseText']);
                console.log(response);
            }
        }); 
    });
    
    let get_comment_type = 0; 
    let get_comment_id = 0; 
    
    $.ajax({
        url: '/frontend/web/news/view-comments',
        type: 'post',
        dataType: 'html',
        data: { 'id': e.id_news },
        success: function (response){
            $('#comments').html(response);
            $('#onloadCommetns').hide();
        },
        error: function (response){
            alert("Упс! Кажется произошла ошибка при загрузке данных. Пожалуйста, перезагрузите страницу или попробуйте позже!\\n\\nОтвет ошибки:\\n" + response['responseText']);
            console.log(response);
        }
    });
    
    $('#textComment').on('input, keyup', function (){
        if ( $(this).val().length > 0 ){
            $('#sendComment').removeAttr('disabled');
        } else{
            $('#sendComment').attr('disabled', true);
        }
    });
    
    $('#sendComment').on('click', function (){
        let text_comment = $('#textComment').val();
        if ( get_comment_type == 0 ){
            $.ajax({
                url: '/frontend/web/news/add-comment',
                type: 'post',
                data: { 'comment': text_comment, 'id': e.id_news },
                dataType: 'html',
                beforeSend: function (){
                    $('#sendComment').hide();
                    $('#loaderComment').show();
                },
                success: function (){
                    $('#sendComment').show();
                    $('#loaderComment').hide();
                    $('#textComment').val('');
                    $('#sendComment').attr('disabled', true);
                    $.ajax({
                        url: '/frontend/web/news/view-comments',
                        type: 'post',
                        dataType: 'html',
                        data: { 'id': e.id_news },
                        beforeSend: function (){
                            $('#onloadCommetns').show();
                            $('#comments').html('');
                        },
                        success: function (response){
                            $('#comments').html(response);
                            $('#onloadCommetns').hide();
                        },
                        error: function (response){
                            alert("Упс! Кажется произошла ошибка при загрузке данных. Пожалуйста, перезагрузите страницу или попробуйте позже!\\n\\nОтвет ошибки:\\n" + response['responseText']);
                            console.log(response);
                        }
                    });
                },
                error: function (response){
                    alert("Упс! Кажется произошла ошибка при загрузке данных. Пожалуйста, перезагрузите страницу или попробуйте позже!\\n\\nОтвет ошибки:\\n" + response['responseText']);
                    console.log(response);
                }
            });
        } else{
            console.log('send_get')
            $.ajax({
                url: '/frontend/web/news/add-comment',
                type: 'post',
                data: { 'comment': text_comment, 'id': e.id_news, 'response': get_comment_id },
                dataType: 'html',
                beforeSend: function (){
                    $('#sendComment').hide();
                    $('#loaderComment').show();
                },
                success: function (){
                    $('#sendComment').show();
                    $('#loaderComment').hide();
                    $('#textComment').val('');
                    $('#sendComment').attr('disabled', true);
                    get_comment_type = 0;
                    get_comment_id = 0;
                    $.ajax({
                        url: '/frontend/web/news/view-comments',
                        type: 'post',
                        dataType: 'html',
                        data: { 'id': e.id_news },
                        beforeSend: function (){
                            $('#onloadCommetns').show();
                            $('#comments').html('');
                        },
                        success: function (response){
                            $('#comments').html(response);
                            $('#onloadCommetns').hide();
                            $('#responseUser').hide();
                        },
                        error: function (response){
                            alert("Упс! Кажется произошла ошибка при загрузке данных. Пожалуйста, перезагрузите страницу или попробуйте позже!\\n\\nОтвет ошибки:\\n" + response['responseText']);
                            console.log(response);
                        }
                    });
                },
                error: function (response){
                    alert("Упс! Кажется произошла ошибка при загрузке данных. Пожалуйста, перезагрузите страницу или попробуйте позже!\\n\\nОтвет ошибки:\\n" + response['responseText']);
                    console.log(response);
                }
            });
        }
    });
    
    $('#comments').on('click', '#responseComment', function (){
        let id_response = $(this).attr('comment-id');
        $.ajax({
            url: '/frontend/web/news/view-user-news',
            type: 'post',
            dataType: 'html',
            data: { 'id': id_response },
            success: function (response){
                $('#responseUser').show();
                get_comment_type = 1;
                get_comment_id = id_response;
                $('#responseUser>span>span').html(response);
                $('html, body').animate({
                    scrollTop:  $('#caseComment').offset().top
                }, 500);
            },
            error: function (response){
                alert("Упс! Кажется произошла ошибка при загрузке данных. Пожалуйста, перезагрузите страницу или попробуйте позже!\\n\\nОтвет ошибки:\\n" + response['responseText']);
                console.log(response);
            }
        });
    });
    
    $('#responseUser').on('click', function (){
        $(this).hide();
        get_comment_type = 0;
        get_comment_id = 0;
    });
    
    $('#comments').on('click', '#deleteComment', function (){
        $.ajax({
            url: '/frontend/web/news/delete-comment',
            type: 'post',
            dataType: 'html',
            data: { 'id': $(this).attr('comment-id') },
            beforeSend: function (){
                $('#onloadCommetns').show();
                $('#comments').html('');
            },
            success: function (response){
                $.ajax({
                    url: '/frontend/web/news/view-comments',
                    type: 'post',
                    dataType: 'html',
                    data: { 'id': e.id_news },
                    success: function (response){
                        $('#comments').html(response);
                        $('#onloadCommetns').hide();
                    },
                    error: function (response){
                        alert("Упс! Кажется произошла ошибка при загрузке данных. Пожалуйста, перезагрузите страницу или попробуйте позже!\\n\\nОтвет ошибки:\\n" + response['responseText']);
                        console.log(response);
                    }
                });
            },
            error: function (response){
                alert("Упс! Кажется произошла ошибка при загрузке данных. Пожалуйста, перезагрузите страницу или попробуйте позже!\\n\\nОтвет ошибки:\\n" + response['responseText']);
                console.log(response);
            }
        });
    });

JS;

$this->registerJs($script, \yii\web\View::POS_READY);