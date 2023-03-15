<?php

/** @var \yii\web\View $this */
/** @var \frontend\controllers\ProjectsController $stop_pagination */
/** @var \frontend\controllers\ProjectsController $groups */
/** @var \frontend\controllers\ProjectsController $permission */
/** @var \frontend\controllers\ProjectsController $permission_cust */

use yii\helpers\Url;

$this->title = 'Проекты';
?>
<div class="container h-auto">
    <div class="w-full ha-auto">
        <h1 class="font-bold text-4xl uppercase">ПРОЕКТЫ</h1>
    </div>

    <?php if ( $permission['addProjects'] || $permission['addProjectsGroup'] || $permission['updateProjectsGroup'] || $permission['deleteProjectsGroup'] || $permission_cust['addCust'] || $permission_cust['updateCust'] || $permission_cust['deleteCust'] ): ?>
        <div class="relative rounded overflow-hidden my-5 bg-white shadow-sm hover:shadow-lg px-2 py-3 border border-solid border-stone-200 duration-200 ease-in-out transition-all pb-10 sm:pb-3">
            <div class="rounded-tl bg-stone-200 text-xs text-white font-bold absolute right-0 bottom-0 px-5 py-1 border-t border-l border-solid border-stone-200">NNGP ADMIN</div>
            <?php if ( $permission['addProjects'] ): ?>
                <a href="<?= Url::to(['/projects/add-projects-form']) ?>" class="block sm:inline-block align-middle text-center rounded px-6 py-2.5 ml-1 mt-1 md:mt-0 bg-stone-300 text-white font-medium text-xs leading-tight uppercase hover:bg-gray-900 hover:shadow-lg focus:bg-gray-900 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-gray-900 active:shadow-lg transition duration-150 ease-in-out">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 inline-block align-middle">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 5v14m7-7H5" />
                    </svg>
                    <span class="ml-1 inline-block align-middle">Добавить проект</span>
                </a>
            <?php endif; ?>
            <?php if ( $permission['addProjectsGroup'] || $permission['updateProjectsGroup'] || $permission['deleteProjectsGroup'] ): ?>
                <a href="<?= Url::to(['/projects/admin-projects-group']) ?>" type="button" class="block sm:inline-block text-center align-middle rounded px-6 py-2.5 ml-1 mt-1 md:mt-0 bg-stone-300 text-white font-medium text-xs leading-tight uppercase hover:bg-gray-900 hover:shadow-lg focus:bg-gray-900 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-gray-900 active:shadow-lg transition duration-150 ease-in-out">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 inline-block align-middle">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 7.125C2.25 6.504 2.754 6 3.375 6h6c.621 0 1.125.504 1.125 1.125v3.75c0 .621-.504 1.125-1.125 1.125h-6a1.125 1.125 0 01-1.125-1.125v-3.75zM14.25 8.625c0-.621.504-1.125 1.125-1.125h5.25c.621 0 1.125.504 1.125 1.125v8.25c0 .621-.504 1.125-1.125 1.125h-5.25a1.125 1.125 0 01-1.125-1.125v-8.25zM3.75 16.125c0-.621.504-1.125 1.125-1.125h5.25c.621 0 1.125.504 1.125 1.125v2.25c0 .621-.504 1.125-1.125 1.125h-5.25a1.125 1.125 0 01-1.125-1.125v-2.25z" />
                    </svg>
                    <span class="ml-1 inline-block align-middle">Редактор групп</span>
                </a>
            <?php endif; ?>
            <?php if ( $permission_cust['addCust'] || $permission_cust['updateCust'] || $permission_cust['deleteCust'] ): ?>
                <a href="<?= Url::to(['/projects/admin-customer']) ?>" type="button" class="block sm:inline-block text-center align-middle rounded px-6 py-2.5 ml-1 mt-1 md:mt-0 bg-stone-300 text-white font-medium text-xs leading-tight uppercase hover:bg-gray-900 hover:shadow-lg focus:bg-gray-900 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-gray-900 active:shadow-lg transition duration-150 ease-in-out">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 inline-block align-middle">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M18 18.72a9.094 9.094 0 003.741-.479 3 3 0 00-4.682-2.72m.94 3.198l.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0112 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 016 18.719m12 0a5.971 5.971 0 00-.941-3.197m0 0A5.995 5.995 0 0012 12.75a5.995 5.995 0 00-5.058 2.772m0 0a3 3 0 00-4.681 2.72 8.986 8.986 0 003.74.477m.94-3.197a5.971 5.971 0 00-.94 3.197M15 6.75a3 3 0 11-6 0 3 3 0 016 0zm6 3a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0zm-13.5 0a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0z" />
                    </svg>
                    <span class="ml-1 inline-block align-middle">Редактор клиентов</span>
                </a>
            <?php endif; ?>
        </div>
    <?php endif; ?>

    <div class="w-full h-auto mt-6 mb-8">
        <form action="" class="w-full h-auto">
            <div class="block sm:inline-block w-full sm:w-[150px] md:w-[214px] lg:w-[344px] relative">
                <input type="text" name="search_text" placeholder="Поиск по названию" class="border-solid border-b border-stone-300 py-1 w-full focus:outline-none focus:border-main-red text-black font-light text-sm bg-[#F8F8F8]">

                <svg class="absolute right-0 top-2/4 -translate-y-2/4" width="16" height="16" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M17.8901 17.3599L12.4133 11.883C13.5509 10.6199 14.25 8.95461 14.25 7.12498C14.25 3.1963 11.0537 0 7.12501 0C3.1963 0 0 3.1963 0 7.12501C0 11.0537 3.1963 14.25 7.12501 14.25C8.95465 14.25 10.6199 13.5509 11.883 12.4133L17.3599 17.8901C17.4331 17.9634 17.5291 18 17.625 18C17.721 18 17.8169 17.9634 17.8902 17.8901C18.0366 17.7436 18.0366 17.5063 17.8901 17.3599ZM7.12501 13.5C3.61013 13.5 0.750023 10.6403 0.750023 7.12501C0.750023 3.60977 3.61013 0.749988 7.12501 0.749988C10.6399 0.749988 13.5 3.60974 13.5 7.12501C13.5 10.6403 10.6399 13.5 7.12501 13.5Z" fill="black"/>
                </svg>
            </div>

            <div class="block sm:inline-block w-full sm:w-[150px] md:w-[214px] relative ml-0 sm:ml-5 md:ml-12">
                <input type="text" placeholder="гггг" name="search_date" class="border-solid border-b border-stone-300 py-1 w-full focus:outline-none focus:border-main-red text-black font-light text-sm bg-[#F8F8F8]">
            </div>
        </form>
    </div>

    <div class="w-full h-auto">
        <button type="button" id="btn_tab_current" data-tab="current" class="inline-block shadow-[0px_0px_4px_0px_#00000040] rounded-md bg-main-red text-white font-light text-xs uppercase py-3 px-6">
            ТЕКУЩИЕ
        </button>

        <button type="button" id="btn_tab_archive" data-tab="archive" class="inline-block shadow-[0px_0px_4px_0px_#00000040] rounded-md bg-white text-black font-light text-xs uppercase py-3 px-6 ml-4">
            АРХИВ
        </button>
    </div>

    <div id="tab_current" class="w-full h-auto">
        <div class="w-full h-auto my-6 relative">
            <div class="font-light text-xs text-black">
                Выберите группу проектов:
            </div>
            <button type="button" id="projectSelect" class="block w-full text-left h-auto font-medium ml-5 my-2 text-xs">
                Нажмите для выбора
            </button>
            <div id="projectSelectBlock" class="block sm:inline-block w-full max-w-[430px] shadow-[0px_0px_4px_0px_#00000040] rounded-md overflow-hidden absolute top-[50px] z-[888]" style="visibility: hidden; opacity: 0;">
                <select name="group" id="" size="3" class="h-auto py-1 w-full focus:outline-none text-black font-light text-xs bg-[#F8F8F8]">
                    <option value="0" class="whitespace-pre-wrap p-3 font-medium border-b border-solid border-stone-200 last:border-none">
                        Показать все
                    </option>
                    <?php foreach ( $groups as $group ): ?>
                        <option value="<?= $group['id'] ?>" class="whitespace-pre-wrap p-3 font-medium border-b border-solid border-stone-200 last:border-none">
                            <?= $group['name'] ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>

        <div id="container" data-pagination="<?= $stop_pagination ?>" class="w-full h-auto grid grid-cols-1 md:grid-cols-2 gap-3 pb-24 duration-200 ease-in-out transition-all"></div>
        <div id="container_sort" data-pagination="<?= $stop_pagination ?>" class="w-full h-auto grid grid-cols-1 md:grid-cols-2 gap-3 pb-24"></div>
        <div id="container_search" data-pagination="<?= $stop_pagination ?>" class="w-full h-auto grid grid-cols-1 md:grid-cols-2 gap-3 pb-24"></div>
        <div id="error" class="font-bold text-xs py-5 text-black italic">Ничего не найдено...</div>
    </div>

    <div id="tab_archive" class="w-full h-auto my-6" style="display: none;">
        <div class="flex flex-col mt-6 mb-14">
            <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="py-2 inline-block min-w-full sm:px-6 lg:px-8">
                    <div class="overflow-hidden">
                        <table class="min-w-full border text-center">
                            <thead class="border-b">
                            <tr>
                                <th scope="col" class="text-xl font-light text-black text-left px-2 py-1 border-r last:border-none">
                                    №
                                </th>
                                <th scope="col" class="text-xl font-light text-black text-left px-2 py-1 border-r last:border-none">
                                    Наименование проекта
                                </th>
                                <th scope="col" class="text-xl font-light text-black text-left px-2 py-1 border-r last:border-none">
                                    Заказчик
                                </th>
                                <th scope="col" class="text-xl font-light text-black text-left px-2 py-1 border-r last:border-none">
                                    Дата
                                </th>
                                <th scope="col" class="text-xl font-light text-black text-left px-2 py-1 border-r last:border-none">
                                    Примечание
                                </th>
                            </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="loader" class="w-full h-auto flex items-center justify-center py-10">
        <div class="spinner-border animate-spin inline-block w-10 h-10 border-4 rounded-full text-main-red mb-24" role="status">
            <span class="visually-hidden">Loading...</span>
        </div>
    </div>
</div>


<?php
$script = <<<JS
    let location = 'projects';
    $('#a_'+location).removeClass('text-black').addClass('text-main-red').removeClass('font-medium').addClass('font-bold');
    
    let e = {
        container: $('#container'),
        container_sort: $('#container_sort'),
        container_search: $('#container_search'),
        btn_tab_current: $('#btn_tab_current'),
        btn_tab_archive: $('#btn_tab_archive'),
        tab_current: $('#tab_current'),
        tab_archive: $('#tab_archive'),
        loader: $('#loader'),
        error: $('#error'),
        query: true
    }
    
    e.btn_tab_current.on('click', function (){
        $(this).removeClass('bg-white').addClass('bg-main-red').removeClass('text-black').addClass('text-white');
        e.btn_tab_archive.addClass('bg-white').removeClass('bg-main-red').addClass('text-black').removeClass('text-white');
        e.tab_archive.hide(); 
        e.tab_current.show();
    });
    
    e.btn_tab_archive.on('click', function (){
        $(this).removeClass('bg-white').addClass('bg-main-red').removeClass('text-black').addClass('text-white');
        e.btn_tab_current.addClass('bg-white').removeClass('bg-main-red').addClass('text-black').removeClass('text-white');
        e.tab_current.hide();
        e.tab_archive.show(); 
    });
    
    e.container_sort.hide();
    e.error.hide();
    
    let stop_pagination = e.container.attr('data-pagination');
    
    function getPositionLoad(){ return e.container.height() / 2; }
    
    function getLastId(){ let last_id = 0; $('div[name^=\'projects_item_\']').each(function (){ last_id = $(this).attr('data-projects'); }); console.log(last_id); return last_id; }
    
    function getProjects(last_id, onload){
        $.ajax({
            url: '/frontend/web/projects/view-all-projects',
            type: 'post',
            dataType: 'html',
            data: { 'last_id': last_id, 'onload': onload },
            beforeSend: function (){
                e.loader.show();
                e.loader.hide();
                e.query = false;
            },
            success: function (response){
                e.container.append(response);
                e.loader.hide();
                if ( getLastId() == stop_pagination ){ e.query = false; } else{ e.query = true; }
            },
            error: function (response){
                alert("Упс! Кажется произошла ошибка при загрузке данных. Пожалуйста, перезагрузите страницу или попробуйте позже!\\n\\nОтвет ошибки:\\n" + response['responseText']);
                console.log(response);
            }
        });
    }
    
    getProjects(0, true);
    
    $.ajax({
            url: '/frontend/web/projects/view-archive-projects',
            type: 'post',
            dataType: 'html',
            data: 1,
            success: function (response){
                $('#tab_archive tbody').html(response);
            },
            error: function (response){
                alert("Упс! Кажется произошла ошибка при загрузке данных. Пожалуйста, перезагрузите страницу или попробуйте позже!\\n\\nОтвет ошибки:\\n" + response['responseText']);
                console.log(response);
            }
        });
    
    $('select[name=\'group\']').on('input', function (){
        let value = $(this).val();
        if ( value == 0 ){
            e.container_sort.hide();
            e.container.show();
            e.container_search.hide();
        } else{
            $.ajax({
                url: '/frontend/web/projects/sort-group',
                type: 'post',
                dataType: 'html',
                data: { 'value': value },
                beforeSend: function (){
                    e.container.hide();
                    e.container_search.hide();
                    e.loader.show();
                    e.loader.hide();
                },
                success: function (response){
                    e.container_sort.html(response).show();
                    e.loader.hide();
                },
                error: function (response){
                    alert("Упс! Кажется произошла ошибка при загрузке данных. Пожалуйста, перезагрузите страницу или попробуйте позже!\\n\\nОтвет ошибки:\\n" + response['responseText']);
                    console.log(response);
                }
            });
        }
    });
    
    function getSearch(){
        let value_text = $('input[name=\'search_text\']').val();
        let value_date = $('input[name=\'search_date\']').val();
        if ( value_text.length > 0 || value_date.length > 0 ){
            let setAjax = $.ajax();
            setAjax.abort();
            setAjax = $.ajax({
                url: '/frontend/web/projects/search',
                type: 'post',
                dataType: 'html',
                data: { 'value_text': value_text, 'value_date': value_date },
                beforeSend: function (){
                    e.container.hide();
                    e.container_sort.hide();
                    e.container_search.hide();
                    e.tab_archive.hide();
                    e.tab_current.show();
                    e.btn_tab_current.removeClass('bg-white').addClass('bg-main-red').removeClass('text-black').addClass('text-white');
                    e.btn_tab_archive.addClass('bg-white').removeClass('bg-main-red').addClass('text-black').removeClass('text-white');
                    e.loader.show();
                    e.error.hide();
                },
                success: function (response){
                    if( response ){
                        e.container_search.html(response).show();
                        e.loader.hide();
                    } else{
                        e.error.show();
                    }
                },
                error: function (response){
                    alert("Упс! Кажется произошла ошибка при загрузке данных. Пожалуйста, перезагрузите страницу или попробуйте позже!\\n\\nОтвет ошибки:\\n" + response['responseText']);
                    console.log(response);
                }
            });
        } else{
            e.container_search.hide();
            e.container_sort.hide();
            e.container.show();
            e.loader.hide();
            e.error.hide();
        }
    }
    
    $('input[name=\'search_text\']').bind('input, keyup', function (){
        getSearch();
    });
    
    $('input[name=\'search_date\']').datepicker({ 
        changeYear: true,
        showButtonPanel: true,
        dateFormat: 'yy',
        closeText: 'Применить',
        currentText: 'Сегодня',
        onClose: function(dateText, inst) {
          var year = $("#ui-datepicker-div .ui-datepicker-year :selected").val();
          $(this).datepicker('setDate', new Date(year, 1));
          getSearch();
        }
    })
    
    $('input[name=\'search_date\']').focus(function() {
        $(".ui-datepicker-month").hide();
        $(".ui-datepicker-calendar").hide();
    });
    
    $(window).on('scroll', function (){
        if( $(this).scrollTop() >= getPositionLoad() && e.query ){
            if( getLastId() !== stop_pagination ){
                getProjects(getLastId(), false);
            }
        }
    });
    
JS;

$this->registerJs($script, \yii\web\View::POS_READY);
