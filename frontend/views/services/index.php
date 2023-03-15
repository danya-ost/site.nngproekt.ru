<?php

/** @var \yii\web\View $this */
/** @var \frontend\controllers\ServicesController $permission */

use yii\helpers\Url;

$tab = isset($_GET['tab']) ? $_GET['tab'] : 'main';

$this->title = 'Сервисы';
?>
<div class="container h-auto">
    <div class="w-full ha-auto mb-12">
        <h1 class="font-bold text-4xl uppercase">СЕРВИСЫ</h1>
    </div>

    <?php if ( $permission['addServices'] ): ?>
        <div class="relative rounded overflow-hidden my-5 bg-white shadow-sm hover:shadow-lg px-2 py-3 border border-solid border-stone-200 duration-200 ease-in-out transition-all pb-10 sm:pb-3">
            <div class="rounded-tl bg-stone-200 text-xs text-white font-bold absolute right-0 bottom-0 px-5 py-1 border-t border-l border-solid border-stone-200">NNGP ADMIN</div>
            <?php if ( $permission['addServices'] ): ?>
                <button data-bs-toggle="modal" data-bs-target="#servicesModal" class="block sm:inline-block align-middle text-center rounded px-6 py-2.5 ml-1 mt-1 md:mt-0 bg-stone-300 text-white font-medium text-xs leading-tight uppercase hover:bg-gray-900 hover:shadow-lg focus:bg-gray-900 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-gray-900 active:shadow-lg transition duration-150 ease-in-out">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 inline-block align-middle">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 5v14m7-7H5" />
                    </svg>
                    <span class="ml-1 inline-block align-middle">Добавить сервис</span>
                </button>
            <?php endif; ?>
        </div>
    <?php endif; ?>

    <div class="w-full h-auto mb-14">
        <button type="button" name="tab_btn_general" id="1" class="block md:inline-block w-full md:w-auto mb-5 md:mb-0 shadow-[0px_0px_4px_0px_#00000040] rounded-md bg-main-red text-white font-light text-xs uppercase py-3 px-6">
            ВНУТРЕННИЕ АДРЕСА СЕРВЕРОВ
        </button>

        <button type="button" name="tab_btn_new" id="2" class="block md:inline-block w-full md:w-auto mb-5 md:mb-0 shadow-[0px_0px_4px_0px_#00000040] rounded-md bg-white text-black font-light text-xs uppercase py-3 px-6 ml-0 md:ml-4">
            НОВОМУ СОТРУДНИКУ
        </button>

        <a href="<?= Url::to(['/abs/index']) ?>" class="block md:inline-block w-full md:w-auto shadow-[0px_0px_4px_0px_#00000040] rounded-md bg-white text-black font-light text-xs uppercase py-3 px-6 ml-0 md:ml-4">
            ОБЪЯВЛЕНИЯ СОТРУДНИКОВ
        </a>
    </div>
    <div id="tab_General" style="display: none;" class="w-full h-auto grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-3 mb-24"></div>
    <div id="tab_NewEmployee" style="display: none;" class="w-full h-auto grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-3 mb-24"></div>
    <div id="loader" class="w-full h-auto flex items-center justify-center py-10">
        <div class="spinner-border animate-spin inline-block w-10 h-10 border-4 rounded-full text-main-red mb-24" role="status">
            <span class="visually-hidden">Loading...</span>
        </div>
    </div>

</div>

<?php if ( $permission['addServices'] ): ?>
    <div class="modal fade fixed top-0 left-0 hidden w-full h-full outline-none overflow-x-hidden overflow-y-auto" id="servicesModal" tabindex="-1" aria-labelledby="exampleModalCenterTitle" aria-modal="true" role="dialog">
        <div class="modal-dialog modal-dialog-centered relative w-auto pointer-events-none">
            <div class="modal-content border-none shadow-lg relative flex flex-col w-full pointer-events-auto bg-white bg-clip-padding outline-none text-current rounded">
                <div class="modal-header flex flex-shrink-0 items-top justify-between p-4 border-b border-gray-200 rounded">
                    <h5 class="text-xl font-medium leading-normal text-gray-800" id="exampleModalScrollableLabel">
                        Добавление сервиса
                    </h5>
                    <button type="button"
                            id="modelAddClose"
                            class="inline-block px-3 py-2.5 bg-transparent text-blue-600 font-medium text-xs leading-tight uppercase rounded hover:text-blue-700 hover:bg-gray-100 focus:bg-gray-100 focus:outline-none focus:ring-0 active:bg-gray-200 transition duration-150 ease-in-out"
                            data-bs-dismiss="modal" aria-label="Close">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 19.5l15-15m-15 0l15 15" />
                        </svg>
                    </button>
                </div>
                <div class="modal-body relative p-4">
                    <div id="containerSevices">
                        <div>
                            <label for="servicesName" class="inline-block align-middle font-light text-xs text-stone-500">
                                Наименование сервиса
                            </label>
                        </div>
                        <input type="text"
                               id="servicesName"
                               name="title"
                               placeholder="Ввведите наименование сервиса"
                               class="block w-full py-2 mb-5 font-medium text-sm border-b border-solid border-b-stone-300 bg-white focus:border-b-main-red focus:outline-none">
                        <div class="mb-5">
                            <label for="servicesType" class="inline-block align-middle text-xs text-black cursor-pointer">
                                <input class="inline-block align-middle mr-1" id="servicesType" type="checkbox" name="type">
                                <span class="inline-block align-middle">Новому сотруднику</span>
                            </label>
                        </div>
                        <div>
                            <label for="servicesSrc" class="inline-block align-middle font-light text-xs text-stone-500">
                                Ссылка (если есть)
                            </label>
                        </div>
                        <input type="text"
                               id="servicesSrc"
                               name="src"
                               placeholder="Укажите полную ссылку (если есть)"
                               class="block w-full py-2 font-medium text-sm border-b border-solid border-b-stone-300 bg-white focus:border-b-main-red focus:outline-none">
                    </div>
                    <div id="loaderServices" class="w-full h-auto flex items-center justify-center py-10" style="display: none;">
                        <div class="spinner-border animate-spin inline-block w-10 h-10 border-4 rounded-full text-main-red mb-24" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                    </div>
                </div>
                <div class="modal-footer flex flex-shrink-0 flex-wrap items-center justify-end p-4 border-t border-gray-200 rounded-b-md">
                    <button type="button"
                            id="servicesUpload"
                            class="inline-block align-middle rounded px-6 py-2.5 ml-1 bg-gray-800 text-white font-medium text-xs leading-tight uppercase shadow-md hover:bg-gray-900 hover:shadow-lg focus:bg-gray-900 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-gray-900 active:shadow-lg transition duration-150 ease-in-out">
                        Сохранить
                    </button>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>

<?php if ( $permission['deleteServices'] ): ?>
    <div class="modal fade fixed top-0 left-0 hidden w-full h-full outline-none overflow-x-hidden overflow-y-auto" id="modalDelete" tabindex="-1" aria-labelledby="exampleModalCenterTitle" aria-modal="true" role="dialog">
        <div class="modal-dialog modal-dialog-centered relative w-auto pointer-events-none">
            <div class="modal-content border-none shadow-lg relative flex flex-col w-full pointer-events-auto bg-white bg-clip-padding outline-none rounded text-current">
                <div class="modal-header flex flex-shrink-0 items-center justify-between p-4 border-b border-gray-200">
                    <h5 class="text-xl font-medium leading-normal text-gray-800" id="exampleModalScrollableLabel">
                        Подтверждение действия
                    </h5>
                </div>
                <div class="modal-body relative p-4">
                    <p id="deleteContent" class="font-medium text-xl text-black text-center">
                        Вы уверены, что хотите удалить эту запись базе данных?
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
    <button type="button" id="openDelete" data-bs-toggle="modal" data-bs-target="#modalDelete" class="hidden"></button>
<?php endif; ?>

<?php if ( $permission['updateServices'] ): ?>
    <div class="modal fade fixed top-0 left-0 hidden w-full h-full outline-none overflow-x-hidden overflow-y-auto" id="updateModal" tabindex="-1" aria-labelledby="exampleModalCenterTitle" aria-modal="true" role="dialog">
        <div class="modal-dialog modal-dialog-centered relative w-auto pointer-events-none">
            <div class="modal-content border-none shadow-lg relative flex flex-col w-full pointer-events-auto bg-white bg-clip-padding outline-none text-current rounded">
                <div class="modal-header flex flex-shrink-0 items-top justify-between p-4 border-b border-gray-200 rounded">
                    <h5 class="text-xl font-medium leading-normal text-gray-800" id="exampleModalScrollableLabel">
                        Обновление данных
                    </h5>
                    <button type="button"
                            id="modelUpdateClose"
                            class="inline-block px-3 py-2.5 bg-transparent text-blue-600 font-medium text-xs leading-tight uppercase rounded hover:text-blue-700 hover:bg-gray-100 focus:bg-gray-100 focus:outline-none focus:ring-0 active:bg-gray-200 transition duration-150 ease-in-out"
                            data-bs-dismiss="modal" aria-label="Close">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 19.5l15-15m-15 0l15 15" />
                        </svg>
                    </button>
                </div>
                <div class="modal-body relative p-4">
                    <div id="containerUpdate"></div>
                    <div id="loaderUpdate" class="w-full h-auto flex items-center justify-center py-10" style="display: none;">
                        <div class="spinner-border animate-spin inline-block w-10 h-10 border-4 rounded-full text-main-red mb-24" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                    </div>
                </div>
                <div class="modal-footer flex flex-shrink-0 flex-wrap items-center justify-end p-4 border-t border-gray-200 rounded-b-md">
                    <button type="button"
                            id="updateBtnServices"
                            class="inline-block align-middle rounded px-6 py-2.5 ml-1 bg-gray-800 text-white font-medium text-xs leading-tight uppercase shadow-md hover:bg-gray-900 hover:shadow-lg focus:bg-gray-900 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-gray-900 active:shadow-lg transition duration-150 ease-in-out">
                        Сохранить
                    </button>
                </div>
            </div>
        </div>
    </div>
    <button type="button" id="openUpdate" data-bs-toggle="modal" data-bs-target="#updateModal" class="hidden"></button>
<?php endif; ?>

<?php
$script = <<<JS
    let location_page = 'services';
    $('#a_'+location_page).removeClass('text-black').addClass('text-main-red').removeClass('font-medium').addClass('font-bold');
    
    let e = {
        tab_general: $('#tab_General'),
        tab_new: $('#tab_NewEmployee'), 
        current_tab: 1,
        loader: $('#loader'),
        add_container: $('#containerSevices'),
        add_loader: $('#loaderServices'),
        add_btn: $('#servicesUpload'),
        add_btn_close: $('#modelAddClose'),
        del_container: $('#deleteContent'),
        del_loader: $('#deleteLoader'),
        del_btn: $('#btnDelete'),
        del_btn_close: $('#deleteModalClose'),
        up_container: $('#containerUpdate'),
        up_loader: $('#loaderUpdate'),
        up_btn: $('#updateBtnServices'),
        up_btn_close: $('#modelUpdateClose')
    };
    
    function getServices(type, show){
        $.ajax({
            url: '/frontend/web/services/view-services',
            type: 'post',
            dataType: 'html',
            async: false,
            data: { 'type': type },
            beforeSend: function (){
                e.loader.show();
                e.tab_general.hide();
                e.tab_new.hide();
            },
            success: function (response){
                e.loader.hide();
                if ( type == 1 ){ e.tab_general.html(response); show ? e.tab_general.show() : ''; } else{ e.tab_new.html(response); show ? e.tab_new.show() : ''; }
                getLogs('services', 'pagination', 'loaded_items_type - '+type, 1, false);
            },
            error: function (response){
                getLogs('services', 'pagination', 'loaded_items_type - '+type, 0, response['responseText']);
                alert("Упс! Кажется произошла ошибка при загрузке данных. Пожалуйста, перезагрузите страницу или попробуйте позже!\\n\\nОтвет ошибки:\\n" + response['responseText']);
                console.log(response);
            }
        });
    }
    
    getServices(1, true);
    getServices(2, false);
    
    $('button[name^=\'tab_\']').on('click', function (){
        $('button[name^=\'tab_\']').each(function (){
            $(this).removeClass('bg-main-red').addClass('bg-white').removeClass('text-white').addClass('text-black');
        });
        $(this).addClass('bg-main-red').removeClass('bg-white').addClass('text-white').removeClass('text-black');
        let tab = $(this).attr('id');
        if ( tab == 1 ){
            e.tab_general.show();
            e.tab_new.hide();
            e.current_tab = 1;
            $('input[name=\'type\']').prop('checked', false);
        } else{
            e.tab_general.hide();
            e.tab_new.show();
            e.current_tab = 2;
            $('input[name=\'type\']').prop('checked', true);
        }
    });
    
    e.add_btn.on('click', function (){
        let title = $('input[name=\'title\']').val(); 
        let src = $('input[name=\'src\']').val().trim();
        let type = 1;
        if( $('input[name=\'type\']').is(':checked') ){ type = 2; } else{ type = 1; }
        $.ajax({
            url: '/frontend/web/services/add-services',
            type: 'post',
            dataType: 'html',
            data: { 'title': title, 'src': src, 'type': type },
            beforeSend: function (){
                e.add_container.hide();
                e.add_loader.show();
                if ( e.current_tab == 1 ){ e.tab_general.hide(); } else{ e.tab_new.hide(); }
            },
            success: function (){
                if ( e.current_tab == 1 ){ getServices(1); e.tab_general.show(); } else{ getServices(2); e.tab_new.show(); }
                e.add_btn_close.trigger('click');
                e.add_container.show();
                e.add_loader.hide();
                $('input[name=\'title\']').val('');
                $('input[name=\'type\']').prop('checked', false);
                $('input[name=\'src\']').val('');
                getLogs('services', 'add-services', 'add-services-data - '+title+' // '+src, 1, false);
            },
            error: function (response){
                getLogs('services', 'add-services', 'add-services-data - '+title+' // '+src, 0, response['responseText']);
                alert("Упс! Кажется произошла ошибка при загрузке данных. Пожалуйста, перезагрузите страницу или попробуйте позже!\\n\\nОтвет ошибки:\\n" + response['responseText']);
                console.log(response);
            }
        });
    });
    
    let delete_id = 0;
    
    e.tab_general.on('click', 'button[name^=\'services_delete_\']', function (){
        $('#openDelete').trigger('click');
        delete_id = $(this).attr('name').replace('services_delete_', '');
    });
    
    e.tab_new.on('click', 'button[name^=\'services_delete_\']', function (){
        $('#openDelete').trigger('click');
        delete_id = $(this).attr('name').replace('services_delete_', '');
    });
    
    e.del_btn.on('click', function (){
        $.ajax({
            url: '/frontend/web/services/delete-services',
            type: 'post',
            dataType: 'html',
            data: { 'id': delete_id },
            beforeSend: function (){
                if ( e.current_tab == 1 ){ e.tab_general.hide(); } else{ e.tab_new.hide(); }
            },
            success: function (){
                if ( e.current_tab == 1 ){ getServices(1); e.tab_general.show(); } else{ getServices(2); e.tab_new.show(); }
                e.del_btn_close.trigger('click');
                getLogs('services', 'delete-services', 'delete-services-data - '+delete_id+' // '+src, 1, false);
            },
            error: function (response){
                getLogs('services', 'delete-services', 'delete-services-data - '+delete_id+' // '+src, 0, response['responseText']);
                alert("Упс! Кажется произошла ошибка при загрузке данных. Пожалуйста, перезагрузите страницу или попробуйте позже!\\n\\nОтвет ошибки:\\n" + response['responseText']);
                console.log(response);
            }
        });
    });
    
    function updateData(id){
        $.ajax({
            url: '/frontend/web/services/load-data-services',
            type: 'post',
            dataType: 'html',
            data: { 'id': id },
            beforeSend: function (){
                e.up_container.hide();
                e.up_loader.show();
            },
            success: function (response){
                e.up_loader.hide();
                e.up_container.html(response).show();
                getLogs('services', 'update-services', 'loaded-services-data - '+update_id, 1, false);
            },
            error: function (response){
                getLogs('services', 'update-services', 'loaded-services-data - '+update_id, 0, response['responseText']);
                alert("Упс! Кажется произошла ошибка при загрузке данных. Пожалуйста, перезагрузите страницу или попробуйте позже!\\n\\nОтвет ошибки:\\n" + response['responseText']);
                console.log(response);
            }
        });
    }
    
    let update_id = 0;
    
    e.tab_general.on('click', 'button[name^=\'update_services_\']', function (){
        $('#openUpdate').trigger('click');
        update_id = $(this).attr('name').replace('update_services_', '');
        updateData(update_id);
    });
    
    e.tab_new.on('click', 'button[name^=\'update_services_\']', function (){
        $('#openUpdate').trigger('click');
        update_id = $(this).attr('name').replace('update_services_', '');
        updateData(update_id);
    });
    
    e.up_btn.on('click', function (){
        let title = $('input[name=\'up_title\']').val();
        let src = $('input[name=\'up_src\']').val().trim();
        let type = 1;
        if( $('input[name=\'up_type\']').is(':checked') ){ type = 2; } else{ type = 1; }
        $.ajax({
            url: '/frontend/web/services/update-services',
            type: 'post',
            dataType: 'html',
            data: { 'id': update_id, 'title': title, 'src': src, 'type': type },
            beforeSend: function (){
                e.up_container.hide();
                e.up_loader.show();
                if ( e.current_tab == 1 ){ e.tab_general.hide(); } else{ e.tab_new.hide(); }
            },
            success: function (){
                if ( e.current_tab == 1 ){ getServices(1); e.tab_general.show(); } else{ getServices(2); e.tab_new.show(); }
                e.up_btn_close.trigger('click');
                e.up_container.show();
                e.up_loader.hide();
                getLogs('services', 'update-services', 'update-services-data - '+update_id, 1, false);
            },
            error: function (response){
                getLogs('services', 'update-services', 'update-services-data - '+update_id, 0, response['responseText']);
                alert("Упс! Кажется произошла ошибка при загрузке данных. Пожалуйста, перезагрузите страницу или попробуйте позже!\\n\\nОтвет ошибки:\\n" + response['responseText']);
                console.log(response);
            }
        });
    });

    if ('$tab' != 'main'){
        if ('$tab' == 'new_worker'){
            $('button[name^=\'tab_\']').each(function ( index ){
                $(this).removeClass('bg-main-red').addClass('bg-white').removeClass('text-white').addClass('text-black');
                if ( index == 1 ){
                    $(this).addClass('bg-main-red').removeClass('bg-white').addClass('text-white').removeClass('text-black');
                    e.tab_general.hide();
                    e.tab_new.show();
                    e.current_tab = 2;
                    $('input[name=\'type\']').prop('checked', true);
                }
            });
        }
    }
JS;

$this->registerJs($script, \yii\web\View::POS_READY);