<?php

/** @var \yii\web\View $this */
/** @var \frontend\controllers\InitiativeController $first_id */

$this->title = 'Реестр инициатив'
?>
<div class="container pb-10">
    <h1 class="font-semibold text-2xl">
        Реестр инициатив
    </h1>
    <div>
        <div class="block md:inline-block align-bottom w-full sm:w-[150px] md:w-[214px] lg:w-[344px] mt-6 relative">
            <input type="text" name="main_search" placeholder="Автоматическая нумерация разделов" class="border-solid border-b border-stone-300 py-1 w-full focus:outline-none focus:border-main-red text-black font-light text-sm bg-[#F8F8F8]">

            <svg class="absolute right-0 top-2/4 -translate-y-2/4" width="16" height="16" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M17.8901 17.3599L12.4133 11.883C13.5509 10.6199 14.25 8.95461 14.25 7.12498C14.25 3.1963 11.0537 0 7.12501 0C3.1963 0 0 3.1963 0 7.12501C0 11.0537 3.1963 14.25 7.12501 14.25C8.95465 14.25 10.6199 13.5509 11.883 12.4133L17.3599 17.8901C17.4331 17.9634 17.5291 18 17.625 18C17.721 18 17.8169 17.9634 17.8902 17.8901C18.0366 17.7436 18.0366 17.5063 17.8901 17.3599ZM7.12501 13.5C3.61013 13.5 0.750023 10.6403 0.750023 7.12501C0.750023 3.60977 3.61013 0.749988 7.12501 0.749988C10.6399 0.749988 13.5 3.60974 13.5 7.12501C13.5 10.6403 10.6399 13.5 7.12501 13.5Z" fill="black"/>
            </svg>
        </div>
    </div>
    <div class="flex flex-col mt-6 mb-14">
        <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="py-2 inline-block min-w-full sm:px-6 lg:px-8">
                <div class="overflow-hidden">
                    <table class="min-w-full border-2 border-solid border-stone-200 text-center">
                        <thead class="border-b-2 border-solid border-stone-200">
                            <tr class="">
                                <th scope="col" class="text-sm font-medium text-main-red text-left px-2 py-1 border-r-2 border-stone-200 border-solid last:border-none py-4">
                                    №ППУ
                                </th>
                                <th scope="col" class="text-sm font-medium text-main-red text-left px-2 py-1 border-r-2 border-stone-200 border-solid last:border-none py-4">
                                    Дата
                                </th>
                                <th scope="col" class="text-sm font-medium text-main-red text-left px-2 py-1 border-r-2 border-stone-200 border-solid last:border-none py-4">
                                    <button type="button" name="sort_department" class="hover:underline">Подразделение</button>
                                </th>
                                <th scope="col" class="text-sm font-medium text-main-red text-left px-2 py-1 border-r-2 border-stone-200 border-solid last:border-none py-4">
                                    <button type="button" name="sort_author" class="hover:underline">ФИО</button>
                                </th>
                                <th scope="col" class="text-sm font-medium text-main-red text-left px-2 py-1 border-r-2 border-stone-200 border-solid last:border-none py-4">
                                    <button type="button" name="sort_status" class="hover:underline">Статус</button>
                                </th>
                                <th scope="col" class="text-sm font-medium text-main-red text-left px-2 py-1 border-r-2 border-stone-200 border-solid last:border-none py-4">
                                    Предложение
                                </th>
                                <th scope="col" class="text-sm font-medium text-main-red text-left px-2 py-1 border-r-2 border-stone-200 border-solid last:border-none py-4">
                                    Ожидаемый <br>
                                    эффект
                                </th>
                                <th scope="col" class="text-sm font-medium text-main-red text-left px-2 py-1 border-r-2 border-stone-200 border-solid last:border-none whitespace-nowrap py-4">
                                    Сумма <br>
                                    к поощрению
                                </th><th scope="col" class="text-sm font-medium text-main-red text-left px-2 py-1 border-r-2 border-stone-200 border-solid last:border-none py-4">
                                    Редактирование
                                </th>
                            </tr>
                        </thead>
                        <tbody id="container" style="display: none;">

                        </tbody>
                        <tbody id="container_search" style="display: none;">

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div id="loader" style="display: none;" class="w-full h-auto flex items-center justify-center py-24">
        <div class="spinner-border animate-spin inline-block w-10 h-10 border-4 rounded-full text-main-red" role="status">
            <span class="visually-hidden">Loading...</span>
        </div>
    </div>
</div>

<div id="modal" style="display: none; position: fixed;" class="top-0 right-0 bottom-0 left-0 z-[9999] relative">
    <div class="max-w-[356px] h-auto bg-white px-5 py-7 shadow-[0px_0px_6px_0px_#00000040] rounded-lg relative top-2/4 -translate-y-2/4 left-2/4 -translate-x-2/4">
        <div class="flex items-center justify-end">
            <button type="button" id="closeModal">
                <svg width="21" height="21" viewBox="0 0 21 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <g clip-path="url(#clip0_1127_12053)">
                        <path d="M10.5 0C16.2923 0 21 4.70775 21 10.5C21 16.2923 16.2923 21 10.5 21C4.70775 21 0 16.2923 0 10.5C0 4.70775 4.70775 0 10.5 0ZM10.5 19.9401C15.7007 19.9401 19.9401 15.7007 19.9401 10.5C19.9401 5.2993 15.7007 1.05986 10.5 1.05986C5.2993 1.05986 1.05986 5.2993 1.05986 10.5C1.05986 15.7007 5.2993 19.9401 10.5 19.9401Z" fill="#868686"/>
                        <path d="M9.761 10.4507L6.68002 7.36975C6.48284 7.17256 6.48284 6.82749 6.68002 6.63031C6.8772 6.43313 7.22227 6.43313 7.41946 6.63031L10.5004 9.71129L13.5814 6.63031C13.7786 6.43313 14.1237 6.43313 14.3209 6.63031C14.518 6.82749 14.518 7.17256 14.3209 7.36975L11.2399 10.4507L14.3209 13.5071C14.518 13.7042 14.518 14.0493 14.3209 14.2465C14.2223 14.3451 14.0744 14.3944 13.9511 14.3944C13.8279 14.3944 13.68 14.3451 13.5814 14.2465L10.5004 11.1655L7.41946 14.2465C7.32086 14.3451 7.17298 14.3944 7.04974 14.3944C6.9265 14.3944 6.77861 14.3451 6.68002 14.2465C6.48284 14.0493 6.48284 13.7042 6.68002 13.5071L9.761 10.4507Z" fill="#868686"/>
                    </g>
                    <defs>
                        <clipPath id="clip0_1127_12053">
                            <rect width="21" height="21" fill="white" transform="matrix(-1 0 0 1 21 0)"/>
                        </clipPath>
                    </defs>
                </svg>
            </button>
        </div>

        <div>
            <div class="grid grid-cols-2 grid-rows-1 gap-2 mt-2 mb-5">
                <button type="button" name="type_sort_asc" data-select="1" class="bg-stone-100 py-2 underline">
                    по возрастанию
                </button>
                <button type="button" name="type_sort_desk" data-select="1" class="bg-stone-100 py-2">
                    по убыванию
                </button>
            </div>
            <input type="text" name="search" placeholder="Введите выбранные данные" class="border-solid bg-white border-b border-stone-300 py-1 w-full focus:outline-none focus:border-main-red text-black font-light text-sm">
        </div>
    </div>
</div>
<?php
$script = <<<JS
    let load = {
        container: $('#container'),
        loader: $('#loader'),
        query: true
    }
    
    let search = {
        container: $('#container_search')
    }
    
    function getInitiative(last_id, key){
        $.ajax({
            url: '/frontend/web/initiative/view-regedit-items',
            type: 'post',
            dataType: 'html',
            data: { 'last_id': last_id, 'key': key },
            beforeSend: function (){
                load.loader.show();
                load.query = false;
            },
            success: function (response){
                load.container.append(response).show();
                load.loader.hide();
                load.query = true;
                getLogs('initiative', 'view-regedit-initiative', 'Onload pagination', 1, false);
            },
            error: function (response){
                getLogs('initiative', 'view-regedit-initiative', 'Onload pagination', 0, response['responseText']);
                alert("Упс! Кажется произошла ошибка при загрузке данных. Пожалуйста, перезагрузите страницу или попробуйте позже!\\n\\nОтвет ошибки:\\n" + response['responseText']);
                console.log(response);
            }
        });
    }
    
    function getLastId(){ let last_id = 0; $('#container > tr[name^=\'initiative_item_\']').each(function (){ last_id = $(this).attr('name').replace('initiative_item_', ''); }); return last_id; }
    
    function getPagination(){ let h = load.container.height(); return h/2; }
    
    function getKey(){ let key = 0; $('tr[name^=\'initiative_item_\']').each(function (){ key++; }); return key+1; }
    
    getInitiative(0, 1);

    $(window).on('scroll', function (){
        if ( $(window).scrollTop() >= getPagination() && load.query == true && getLastId() != $first_id ){
            getInitiative(getLastId(), getKey());
        } 
    });
    
    let sort = 'department';
    let type_sort = 'asc';
    
    $('button[name^=\'type_sort_\']').on('click', function (){
        type_sort = $(this).attr('name').replace('type_sort_');
        $('button[name^=\'type_sort_\']').each(function (){
            $(this).removeClass('underline');
        });
        $(this).addClass('underline');
    });
    
    $('button[name^=\'sort_\']').on('click', function(){
        $('#modal').show();
        sort = $(this).attr('name').replace('sort_', '');
    });
    
    $('#closeModal').on('click', function(){
        $('#modal').hide();
    });
    
    $('input[name=\'search\']').bind('input, keyup', function (){
        let value = $(this).val();
        let setAjax = $.ajax();
        if ( value.length >= 3 ){
            setAjax.abort();
            $.ajax({
                url: '/frontend/web/initiative/sort-regedit',
                type: 'post',
                dataType: 'html',
                data: { 'value': value, 'sort': sort, 'type_sort': type_sort },
                beforeSend: function (){
                    load.loader.show();
                    load.container.hide();
                    load.query = false;
                },
                success: function (response){
                    search.container.html(response).show();
                    load.loader.hide();
                    getLogs('initiative', 'sort-initiative', 'Sorting data - '+value, 1, false);
                },
                error: function (response){
                    getLogs('initiative', 'sort-initiative', 'Sorting data - '+value, 0, response['responseText']);
                    alert("Упс! Кажется произошла ошибка при загрузке данных. Пожалуйста, перезагрузите страницу или попробуйте позже!\\n\\nОтвет ошибки:\\n" + response['responseText']);
                    console.log(response);
                }
            });
        } else{
            search.container.hide();
            load.container.show();
            load.loader.hide();
            load.query = true;
        }
    });
    
    $('input[name=\'main_search\']').bind('input, keyup', function (){
        let value = $(this).val();
        let setAjax = $.ajax();
        if ( value.length >= 3 ){
            setAjax.abort();
            $.ajax({
                url: '/frontend/web/initiative/search-regedit',
                type: 'post',
                dataType: 'html',
                data: { 'value': value },
                beforeSend: function (){
                    load.loader.show();
                    load.container.hide();
                    load.query = false;
                },
                success: function (response){
                    search.container.html(response).show();
                    load.loader.hide();
                    getLogs('initiative', 'search-initiative', 'Searching data - '+value, 1, false);
                },
                error: function (response){
                    getLogs('initiative', 'search-initiative', 'Searching data - '+value, 0, response['responseText']);
                    alert("Упс! Кажется произошла ошибка при загрузке данных. Пожалуйста, перезагрузите страницу или попробуйте позже!\\n\\nОтвет ошибки:\\n" + response['responseText']);
                    console.log(response);
                }
            });
        } else{
            search.container.hide();
            load.container.show();
            load.loader.hide();
            load.query = true;
        }
    });
    
JS;

$this->registerJs($script, \yii\web\View::POS_READY);
