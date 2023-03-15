<?php

/** @var \yii\web\View $this */
/** @var \frontend\controllers\BlogController $permission */
/** @var \frontend\controllers\BlogController $first_post_id */

use yii\helpers\Url;

$this->title = 'Блог Руководствва';
?>
<div class="container h-auto">

    <!-- nngp:title_page -->
    <div class="w-full ha-auto">
        <h1 class="font-bold text-4xl uppercase">БЛОГ РУКОВОДСТВА</h1>
    </div>
    <!-- /nngp:title_page -->

    <!-- nngp:sort -->
    <div class="w-full h-auto mt-6 mb-8">
        <form action="" class="w-full h-auto">
            <div class="block sm:inline-block w-full sm:w-[150px] md:w-[214px] lg:w-[344px] relative">
                <input type="text" name="search" placeholder="Поиск по поста" class="border-solid border-b border-stone-300 py-1 w-full focus:outline-none focus:border-main-red text-black font-light text-sm bg-[#F8F8F8]">

                <svg class="absolute right-0 top-2/4 -translate-y-2/4" width="16" height="16" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M17.8901 17.3599L12.4133 11.883C13.5509 10.6199 14.25 8.95461 14.25 7.12498C14.25 3.1963 11.0537 0 7.12501 0C3.1963 0 0 3.1963 0 7.12501C0 11.0537 3.1963 14.25 7.12501 14.25C8.95465 14.25 10.6199 13.5509 11.883 12.4133L17.3599 17.8901C17.4331 17.9634 17.5291 18 17.625 18C17.721 18 17.8169 17.9634 17.8902 17.8901C18.0366 17.7436 18.0366 17.5063 17.8901 17.3599ZM7.12501 13.5C3.61013 13.5 0.750023 10.6403 0.750023 7.12501C0.750023 3.60977 3.61013 0.749988 7.12501 0.749988C10.6399 0.749988 13.5 3.60974 13.5 7.12501C13.5 10.6403 10.6399 13.5 7.12501 13.5Z" fill="black"/>
                </svg>
            </div>
        </form>
    </div>
    <!-- /nngp:sort -->

    <?php if ( $permission['addBlog'] ): ?>
        <div class="relative rounded overflow-hidden my-5 bg-white shadow-sm hover:shadow-lg px-2 py-3 border border-solid border-stone-200 duration-200 ease-in-out transition-al pb-10 sm:pb-3">
            <div class="text-xs rounded-tl bg-stone-200 text-white font-bold absolute right-0 bottom-0 px-5 py-1 border-t border-l border-solid border-stone-200">NNGP ADMIN</div>
                <a href="<?= Url::to(['/blog/add-form']) ?>" class="block sm:inline-block align-middle text-center rounded px-6 py-2.5 ml-1 mt-1 md:mt-0 bg-stone-300 text-white font-medium text-xs leading-tight uppercase hover:bg-gray-900 hover:shadow-lg focus:bg-gray-900 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-gray-900 active:shadow-lg transition duration-150 ease-in-out">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 inline-block align-middle">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 5v14m7-7H5" />
                    </svg>
                    <span class="ml-1 inline-block align-middle">Разместить пост</span>
                </a>
        </div>
    <?php endif; ?>

    <div id="container_search" style="display: none;" class="w-full h-auto grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-12 pb-24"></div>
    <div id="container" style="display: none;" class="w-full h-auto grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-12 pb-24"></div>

    <div id="loader" style="display: none;" class="w-full h-auto flex items-center justify-center">
        <div class="spinner-border animate-spin inline-block w-10 h-10 border-4 rounded-full text-main-red my-24" role="status">
            <span class="visually-hidden">Loading...</span>
        </div>
    </div>

</div>
<?php
$script = <<<JS
    let e = {
        container: $('#container'),
        container_search: $('#container_search'),
        loader: $('#loader'),
        query: true
    }
    
    function getLastPost(){ let id = 0; $('a[name^=\'post_\']').each(function (){ id = $(this).attr('name').replace('post_', ''); }); return id; }
    
    function getPaginationPosition(){ return $('#container').height() / 2 }
    
    function getPosts(onload, last_id){
        $.ajax({
            url: '/frontend/web/blog/pagination-post',
            type: 'post',
            dataType: 'html',
            data: { 'onload': onload, 'last_id': last_id },
            beforeSend: function (){
                e.loader.show();
                e.query = false;
            },
            success: function (response){
                e.container.append(response).show();
                e.loader.hide();
                if ( getLastPost() == $first_post_id ){ 
                    e.query = false; 
                } else{
                    e.query = true;
                }
                getLogs('blog', 'pagination', 'pagination position id: '+last_id, 1, false);
            },
            error: function (response){
                getLogs('blog', 'pagination', 'pagination position id: '+last_id, 0, response['responseText']);
                alert("Упс! Кажется произошла ошибка при загрузке данных. Пожалуйста, перезагрузите страницу или попробуйте позже!\\n\\nОтвет ошибки:\\n" + response['responseText']);
                console.log(response);
            }
        });
    }
    
    e.container.hide();
    getPosts(true, 0);

    $(window).on('scroll', function (event){
        console.log($(window).scrollTop()+' | '+getPaginationPosition()+' | '+e.query);
        if( $(window).scrollTop() >= getPaginationPosition() && e.query ){
            getPosts(false, getLastPost());
        } 
    });
    
    $('input[name=\'search\']').bind('input, keyup', function (){
        let value = $(this).val(),
            setAjax = $.ajax();
        if ( value.length > 3 ){
            setAjax.abort();
            setAjax = $.ajax({
                url: '/frontend/web/blog/search',
                type: 'post',
                dataType: 'html',
                data: { 'value': value },
                beforeSend: function (){
                    e.loader.show();
                    e.container.hide();
                },
                success: function (response){
                    e.container_search.html(response).show();
                    e.loader.hide();
                    getLogs('blog', 'search', 'searching data to value: '+value, 1, false);
                },
                error: function (response){
                    getLogs('blog', 'search', 'searching data to value: '+value, 0, response['responseText']);
                    alert("Упс! Кажется произошла ошибка при загрузке данных. Пожалуйста, перезагрузите страницу или попробуйте позже!\\n\\nОтвет ошибки:\\n" + response['responseText']);
                    console.log(response);
                }
            });
        } else{
            e.container_search.html('').hide();
            e.container.show();
            e.loader.hide();
        }
    });
    
JS;

$this->registerJs($script, \yii\web\View::POS_READY);