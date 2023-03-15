<?php

/* @var yii\web\View $this */
/* @var frontend\controllers\NewsController $data */
/* @var frontend\controllers\NewsController $lastNews */
/* @var frontend\controllers\NewsController $permission */

use yii\helpers\Url;

$this->title = 'Новости портала';
?>

<div class="container h-auto">

    <div class="w-full ha-auto">
        <h1 class="font-bold text-4xl uppercase">НОВОСТИ</h1>
    </div>

    <?php if ( $permission['addNews'] || $permission['updateNewsCategory'] ): ?>
        <div class="relative rounded overflow-hidden my-5 bg-white shadow-sm hover:shadow-lg px-2 py-3 border border-solid border-stone-200 duration-200 ease-in-out transition-al pb-10 sm:pb-3">
            <div class="text-xs rounded-tl bg-stone-200 text-white font-bold absolute right-0 bottom-0 px-5 py-1 border-t border-l border-solid border-stone-200">NNGP ADMIN</div>
            <?php if ( $permission['addNews'] ): ?>
                <a href="<?= Url::to(['/news/add-news-form']) ?>" class="block sm:inline-block align-middle text-center rounded px-6 py-2.5 ml-1 mt-1 md:mt-0 bg-stone-300 text-white font-medium text-xs leading-tight uppercase hover:bg-gray-900 hover:shadow-lg focus:bg-gray-900 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-gray-900 active:shadow-lg transition duration-150 ease-in-out">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 inline-block align-middle">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 5v14m7-7H5" />
                    </svg>
                    <span class="ml-1 inline-block align-middle">Добавить новость</span>
                </a>
            <?php endif; ?>
            <?php if ( $permission['updateNewsCategory'] ): ?>
                <a href="<?= Url::to(['/news/admin-category']) ?>" type="button" class="block sm:inline-block align-middle text-center rounded px-6 py-2.5 ml-1 mt-1 md:mt-0 bg-stone-300 text-white font-medium text-xs leading-tight uppercase hover:bg-gray-900 hover:shadow-lg focus:bg-gray-900 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-gray-900 active:shadow-lg transition duration-150 ease-in-out">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 inline-block align-middle">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 6.878V6a2.25 2.25 0 012.25-2.25h7.5A2.25 2.25 0 0118 6v.878m-12 0c.235-.083.487-.128.75-.128h10.5c.263 0 .515.045.75.128m-12 0A2.25 2.25 0 004.5 9v.878m13.5-3A2.25 2.25 0 0119.5 9v.878m0 0a2.246 2.246 0 00-.75-.128H5.25c-.263 0-.515.045-.75.128m15 0A2.25 2.25 0 0121 12v6a2.25 2.25 0 01-2.25 2.25H5.25A2.25 2.25 0 013 18v-6c0-.98.626-1.813 1.5-2.122" />
                    </svg>
                    <span class="ml-1 inline-block align-middle">Редактор категорий</span>
                </a>
            <?php endif; ?>
        </div>
    <?php endif; ?>

    <div class="w-full h-auto mt-6 mb-8">
        <form action="" class="w-full h-auto">
            <div class="block sm:inline-block w-full sm:w-[150px] md:w-[214px] lg:w-[344px] relative">
                <input name="sort_value" type="text" placeholder="Поиск по новостям" class="border-solid border-b border-stone-300 py-1 w-full focus:outline-none focus:border-main-red text-black font-light text-sm bg-[#F8F8F8]">
                <svg class="absolute right-0 top-2/4 -translate-y-2/4" width="16" height="16" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M17.8901 17.3599L12.4133 11.883C13.5509 10.6199 14.25 8.95461 14.25 7.12498C14.25 3.1963 11.0537 0 7.12501 0C3.1963 0 0 3.1963 0 7.12501C0 11.0537 3.1963 14.25 7.12501 14.25C8.95465 14.25 10.6199 13.5509 11.883 12.4133L17.3599 17.8901C17.4331 17.9634 17.5291 18 17.625 18C17.721 18 17.8169 17.9634 17.8902 17.8901C18.0366 17.7436 18.0366 17.5063 17.8901 17.3599ZM7.12501 13.5C3.61013 13.5 0.750023 10.6403 0.750023 7.12501C0.750023 3.60977 3.61013 0.749988 7.12501 0.749988C10.6399 0.749988 13.5 3.60974 13.5 7.12501C13.5 10.6403 10.6399 13.5 7.12501 13.5Z" fill="black"/>
                </svg>
                <div id="searchError" class="py-1 text-xs text-black font-bold hidden">
                    Ксожалению, ничего не найдено...
                </div>
            </div>
        </form>
    </div>

    <div id="newsView" class="w-full h-auto grid grid-cols-1 md:grid-cols-2 grid-rows-3 md:grid-rows-2 gap-x-5 gap-y-3">

        <?php if ( !isset($data['0']) ): ?>
            <div class="font-bold text-sm">
                Ничего не найдено...
            </div>
        <?php endif; ?>

        <?php if ( isset($data['0']) ): ?>
            <a href="<?= $data['0']['url'] ?>" name="news-item_<?= $data['0']['id'] ?>" data-news="<?= $data['0']['id'] ?>" class="row-span-2 grid grid-cols-1 grid-rows-2 bg-white border border-solid border-stone-100">
                <div class="bg-no-repeat bg-center bg-cover" style="background-image: url('/frontend/web/<?= $data['0']['image_src'] ?>');">
                    <div class="py-1 px-5 bg-main-red font-light text-xs text-white inline-block mt-4">
                        <?= $data['0']['category'] ?>
                    </div>
                </div>
                <div class="p-6 pb-12">
                    <div class="flex items-center justify-start mb-3">
                        <span class="font-light text-xs text-stone-400 mr-3"><?= $data['0']['date_add'] ?></span>
                        <span class="flex items-center justify-start">
                        <svg width="14" height="9" viewBox="0 0 14 9" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M7 9C11.1794 9 14 5.56268 14 4.49738C14 3.43732 11.1743 0 7 0C2.88235 0 0 3.43732 0 4.49738C0 5.56268 2.87721 9 7 9ZM7.00515 7.36268C5.43529 7.36268 4.18456 6.05598 4.17941 4.50262C4.17426 2.89679 5.43529 1.63732 7.00515 1.63732C8.56471 1.63732 9.82574 2.90204 9.82574 4.50262C9.82574 6.05598 8.56471 7.36268 7.00515 7.36268ZM7.00515 5.56793C7.58162 5.56793 8.06029 5.08513 8.06029 4.50262C8.06029 3.91487 7.58162 3.42682 7.00515 3.42682C6.41838 3.42682 5.94485 3.91487 5.94485 4.50262C5.94485 5.08513 6.41838 5.56793 7.00515 5.56793Z" fill="#D7D5D5"/>
                        </svg>
                        <span class="font-light text-xs text-stone-400 ml-1"><?= $data['0']['views'] ?></span>
                    </span>
                </div>
                    <h1 class="font-semibold text-2xl mt-6">
                        <?= $data['0']['title'] ?>
                    </h1>
                    <p class="font-medium text-sm mt-4">
                        <?= $data['0']['annotation'] ?>
                    </p>
                    <div class="inline-block font-light text-xl text-black uppercase mt-8 relative after:block after:content-[''] after:absolute after:left-0 after:-bottom-px after:bg-black after:h-px after:w-full">
                        ЧИТАТЬ
                    </div>
                </div>
            </a>
        <?php endif; ?>

        <?php if ( isset($data['1']) ): ?>
            <a href="<?= $data['1']['url'] ?>" name="news-item_<?= $data['1']['id'] ?>" data-news="<?= $data['1']['id'] ?>" class="grid grid-cols-[40%_60%] grid-rows-1 bg-white border border-solid border-stone-100">
                <div class="bg-no-repeat bg-center bg-cover" style="background-image: url('/frontend/web/<?= $data['1']['image_src'] ?>');">
                    <div class="py-1 px-5 bg-main-red font-light text-xs text-white inline-block mt-4">
                        <?= $data['1']['category'] ?>
                    </div>
                </div>
                <div class="p-6">

                    <div class="flex items-center justify-start mb-3">
                        <span class="font-light text-xs text-stone-400 mr-3"><?= $data['1']['date_add'] ?></span>
                        <span class="flex items-center justify-start">
                            <svg width="14" height="9" viewBox="0 0 14 9" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M7 9C11.1794 9 14 5.56268 14 4.49738C14 3.43732 11.1743 0 7 0C2.88235 0 0 3.43732 0 4.49738C0 5.56268 2.87721 9 7 9ZM7.00515 7.36268C5.43529 7.36268 4.18456 6.05598 4.17941 4.50262C4.17426 2.89679 5.43529 1.63732 7.00515 1.63732C8.56471 1.63732 9.82574 2.90204 9.82574 4.50262C9.82574 6.05598 8.56471 7.36268 7.00515 7.36268ZM7.00515 5.56793C7.58162 5.56793 8.06029 5.08513 8.06029 4.50262C8.06029 3.91487 7.58162 3.42682 7.00515 3.42682C6.41838 3.42682 5.94485 3.91487 5.94485 4.50262C5.94485 5.08513 6.41838 5.56793 7.00515 5.56793Z" fill="#D7D5D5"/>
                            </svg>
                            <span class="font-light text-xs text-stone-400 ml-1"><?= $data['1']['views'] ?></span>
                        </span>
                    </div>

                    <h1 class="font-light text-xl leading-6 mt-5">
                        <?= $data['1']['title'] ?>
                    </h1>

                    <p class="font-light text-xs leading-3 mt-4">
                        <?= $data['1']['annotation'] ?>
                    </p>

                    <div class="inline-block font-light text-md text-black uppercase mt-6 relative after:block after:content-[''] after:absolute after:left-0 after:-bottom-px after:bg-black after:h-px after:w-full">
                        ЧИТАТЬ
                    </div>

                </div>
            </a>
        <?php endif; ?>

        <?php if ( isset($data['2']) ): ?>
            <a href="<?= $data['2']['url'] ?>" name="news-item_<?= $data['2']['id'] ?>" data-news="<?= $data['2']['id'] ?>" class="grid grid-cols-[40%_60%] grid-rows-1 bg-white border border-solid border-stone-100">
                <div class="bg-no-repeat bg-center bg-cover" style="background-image: url('/frontend/web/<?= $data['2']['image_src'] ?>');">
                    <div class="py-1 px-5 bg-main-red font-light text-xs text-white inline-block mt-4">
                        <?= $data['2']['category'] ?>
                    </div>
                </div>
                <div class="p-6">

                    <div class="flex items-center justify-start mb-3">
                        <span class="font-light text-xs text-stone-400 mr-3"><?= $data['2']['date_add'] ?></span>
                        <span class="flex items-center justify-start">
                            <svg width="14" height="9" viewBox="0 0 14 9" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M7 9C11.1794 9 14 5.56268 14 4.49738C14 3.43732 11.1743 0 7 0C2.88235 0 0 3.43732 0 4.49738C0 5.56268 2.87721 9 7 9ZM7.00515 7.36268C5.43529 7.36268 4.18456 6.05598 4.17941 4.50262C4.17426 2.89679 5.43529 1.63732 7.00515 1.63732C8.56471 1.63732 9.82574 2.90204 9.82574 4.50262C9.82574 6.05598 8.56471 7.36268 7.00515 7.36268ZM7.00515 5.56793C7.58162 5.56793 8.06029 5.08513 8.06029 4.50262C8.06029 3.91487 7.58162 3.42682 7.00515 3.42682C6.41838 3.42682 5.94485 3.91487 5.94485 4.50262C5.94485 5.08513 6.41838 5.56793 7.00515 5.56793Z" fill="#D7D5D5"/>
                            </svg>
                            <span class="font-light text-xs text-stone-400 ml-1"><?= $data['2']['views'] ?></span>
                        </span>
                    </div>

                    <h1 class="font-light text-xl leading-6 mt-5">
                        <?= $data['2']['title'] ?>
                    </h1>

                    <p class="font-light text-xs leading-3 mt-4">
                        <?= $data['2']['annotation'] ?>
                    </p>

                    <div class="inline-block font-light text-md text-black uppercase mt-6 relative after:block after:content-[''] after:absolute after:left-0 after:-bottom-px after:bg-black after:h-px after:w-full">
                        ЧИТАТЬ
                    </div>

                </div>
            </a>
        <?php endif; ?>

    </div>

    <div id="newsContainer" data-last-news="<?= $lastNews ?>" class="w-full h-auto grid grid-cols-1 lg:grid-cols-2 gap-x-5 gap-y-3 mt-4 mb-24"></div>
    <div id="newsSearch" class="w-full h-auto grid grid-cols-1 lg:grid-cols-2 gap-x-5 gap-y-3 mt-4 mb-24"></div>
    <div id="loader" class="w-full h-auto flex items-center justify-center py-10">
        <div class="spinner-border animate-spin inline-block w-10 h-10 border-4 rounded-full text-main-red mb-24" role="status">
            <span class="visually-hidden">Loading...</span>
        </div>
    </div>

</div>

<?php
$script = <<<JS
    $('#page_news').removeClass('text-stone-400').addClass('text-main-red').addClass('font-bold');

    let elements = {
        container: $('#newsContainer'),
        container_main: $('#newsView'),
        search_container: $('#newsSearch'),
        loader: $('#loader'),
        query: true,
        stop_pagination: $('#newsContainer').attr('data-last-news'),
        search_input: $('input[name=\'sort_value\']'),
        search_error: $('#searchError')
    }
    
    elements.search_container.hide();

    function getPagination(){ return elements.container.height() / 2; }
    
    function getLastId(){ let last_id = 0; $('a[name^=\'news-item_\']').each(function (){ last_id = $(this).attr('data-news'); }); return last_id; }
    
    function getNews(last_id){
        $.ajax({
            url: '/frontend/web/news/index-view-news',
            type: 'post',
            dataType: 'html',
            data: { 'last_id': last_id },
            beforeSend: function (){
                elements.container.hide();
                elements.loader.show();
            },
            success: function (response){
                elements.container.append(response).show();
                elements.loader.hide();
                if( getLastId() >= elements.stop_pagination ){ elements.query = false; } else{ elements.query = true; }
            },
            error: function (response){
                elements.loader.hide();
                elements.query = false;
                alert("Упс! Кажется произошла ошибка при загрузке данных. Пожалуйста, перезагрузите страницу или попробуйте позже!\\n\\nОтвет ошибки:\\n" + response['responseText']);
                console.log(response);
            }
        });
    }
    
    getNews(getLastId());
    
    $(window).on('scroll', function (){
        if( $(this).scrollTop >= getPagination() && elements.query ){
            getNews(getLastId());
        } 
    });
    
    elements.search_input.bind('input, keyup', function (){
        let value = $(this).val();
        let query_ajax = $.ajax();
        if( value.length > 3 ){
            query_ajax.abort();
            query_ajax = $.ajax({
                url: '/frontend/web/news/index-search',
                type: 'post',
                dataType: 'html',
                data: { 'value': value },
                beforeSend: function (){
                    elements.query = false;
                    elements.container.hide();
                    elements.container_main.hide();
                    elements.loader.show();
                },
                success: function (response){
                    if( response ){
                        if( value.length > 3 ){
                            elements.search_container.html(response).show();
                            elements.loader.hide();
                            elements.query = false
                        } else{
                            elements.search_container.hide();
                            elements.loader.hide();
                            elements.container.show();
                            elements.container_main.show();
                            elements.query = true;
                        }
                        elements.search_error.hide();
                    } else{ elements.search_error.show(); }
                },
                error: function (response){ 
                    elements.query = true;
                    alert("Упс! Кажется произошла ошибка при загрузке данных. Пожалуйста, перезагрузите страницу или попробуйте позже!\\n\\nОтвет ошибки:\\n" + response['responseText']);
                    console.log(response);
                }
            });
        } else{
            elements.search_container.hide();
            elements.loader.hide();
            elements.container.show();
            elements.container_main.show();
            elements.search_error.hide()
            elements.query = true;
        }
    });
    
JS;

$this->registerJs($script, \yii\web\View::POS_READY);
