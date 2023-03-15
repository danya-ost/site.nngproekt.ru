<?php

/** @var \yii\web\View $this */

use yii\helpers\Url;

$this->title = 'Объявления';
?>
<div class="container h-auto">
    <div class="w-full ha-auto mb-12">
        <h1 class="font-bold text-4xl uppercase">СЕРВИСЫ</h1>
    </div>
    <div class="w-full h-auto mb-14">
        <a href="<?= Url::to(['/services/index']) ?>" class="block md:inline-block w-full md:w-auto mb-5 md:mb-0 shadow-[0px_0px_4px_0px_#00000040] rounded-md bg-white text-black font-light text-xs uppercase py-3 px-6">
            CЕРВИСЫ
        </a>
        <button type="button" class="block md:inline-block w-full md:w-auto shadow-[0px_0px_4px_0px_#00000040] rounded-md bg-main-red text-white font-light text-xs uppercase py-3 px-6 ml-0 md:ml-4 mb-5 md:mb-0">
            ОБЪЯВЛЕНИЯ СОТРУДНИКОВ
        </button>
        <button type="button" data-nngp-funct="absModalAddOpen" class="block md:inline-block w-full md:w-auto shadow-[0px_0px_4px_0px_#00000040] rounded-md bg-black text-white font-light text-xs uppercase py-3 px-6 ml-0 md:ml-20">
            ПОДАТЬ ОБЪЯВЛЕНИЕ
        </button>
    </div>
    <div id="loader_onload" class="w-full h-auto flex items-center justify-center py-16" style="display: none;">
        <div class="spinner-border animate-spin inline-block w-10 h-10 border-4 rounded-full text-main-red" role="status">
            <span class="visually-hidden">Loading...</span>
        </div>
    </div>
    <div id="container_onload" class="w-full h-auto grid grid-cols-1 md:grid-cols-2 gap-3 mb-24" style="display: none;"></div>

    <div id="absModal" class="w-full h-screen fixed top-0 right-0 bottom-0 left-0 z-[999] bg-[#00000091]" style="visibility: hidden; opacity: 0;">
        <div class="max-w-[650px] h-auto relative left-2/4 -translate-x-2/4 top-2/4 -translate-y-2/4">

            <button type="button" id="absModalClose" class="absolute right-0 lg:right-auto left-auto lg:left-full -top-[35px] lg:-top-[26px]">
                <svg width="26" height="26" viewBox="0 0 26 26" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M13 0C20.1714 0 26 5.82864 26 13C26 20.1714 20.1714 26 13 26C5.82864 26 0 20.1714 0 13C0 5.82864 5.82864 0 13 0ZM13 24.6878C19.439 24.6878 24.6878 19.439 24.6878 13C24.6878 6.56103 19.439 1.31221 13 1.31221C6.56103 1.31221 1.3122 6.56103 1.3122 13C1.3122 19.439 6.56103 24.6878 13 24.6878Z" fill="white"/>
                    <path d="M12.0848 12.939L8.27026 9.12447C8.02613 8.88034 8.02613 8.45311 8.27026 8.20898C8.51439 7.96485 8.94162 7.96485 9.18576 8.20898L13.0003 12.0235L16.8149 8.20898C17.059 7.96485 17.4862 7.96485 17.7304 8.20898C17.9745 8.45311 17.9745 8.88034 17.7304 9.12447L13.9158 12.939L17.7304 16.7231C17.9745 16.9672 17.9745 17.3944 17.7304 17.6385C17.6083 17.7606 17.4252 17.8216 17.2726 17.8216C17.12 17.8216 16.9369 17.7606 16.8149 17.6385L13.0003 13.824L9.18576 17.6385C9.06369 17.7606 8.88059 17.8216 8.72801 17.8216C8.57543 17.8216 8.39233 17.7606 8.27026 17.6385C8.02613 17.3944 8.02613 16.9672 8.27026 16.7231L12.0848 12.939Z" fill="white"/>
                </svg>
            </button>
            <div id="view_loader" style="display: none;" class="w-full h-auto px-14 py-12 bg-white rounded-xl overflow-hidden">
                <div class="w-full h-auto flex items-center justify-center py-16">
                    <div class="spinner-border animate-spin inline-block w-10 h-10 border-4 rounded-full text-main-red" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                </div>
            </div>
            <div id="container_view" style="display: none;" class="w-full h-auto grid grid-cols-1 grid-rows-[30%_70%] md:grid-rows-2 bg-white rounded-xl overflow-hidden"></div>
        </div>
    </div>

    <div id="absModalUpdate" class="w-full h-screen fixed top-0 right-0 bottom-0 left-0 z-[999] bg-[#00000091]" style="visibility: hidden; opacity: 0;">
        <div class="max-w-[650px] h-auto relative left-2/4 -translate-x-2/4 top-2/4 -translate-y-2/4">
            <button type="button" id="absModalUpdateClose" class="absolute right-0 lg:right-auto left-auto lg:left-full -top-[35px] lg:-top-[26px]">
                <svg width="26" height="26" viewBox="0 0 26 26" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M13 0C20.1714 0 26 5.82864 26 13C26 20.1714 20.1714 26 13 26C5.82864 26 0 20.1714 0 13C0 5.82864 5.82864 0 13 0ZM13 24.6878C19.439 24.6878 24.6878 19.439 24.6878 13C24.6878 6.56103 19.439 1.31221 13 1.31221C6.56103 1.31221 1.3122 6.56103 1.3122 13C1.3122 19.439 6.56103 24.6878 13 24.6878Z" fill="white"/>
                    <path d="M12.0848 12.939L8.27026 9.12447C8.02613 8.88034 8.02613 8.45311 8.27026 8.20898C8.51439 7.96485 8.94162 7.96485 9.18576 8.20898L13.0003 12.0235L16.8149 8.20898C17.059 7.96485 17.4862 7.96485 17.7304 8.20898C17.9745 8.45311 17.9745 8.88034 17.7304 9.12447L13.9158 12.939L17.7304 16.7231C17.9745 16.9672 17.9745 17.3944 17.7304 17.6385C17.6083 17.7606 17.4252 17.8216 17.2726 17.8216C17.12 17.8216 16.9369 17.7606 16.8149 17.6385L13.0003 13.824L9.18576 17.6385C9.06369 17.7606 8.88059 17.8216 8.72801 17.8216C8.57543 17.8216 8.39233 17.7606 8.27026 17.6385C8.02613 17.3944 8.02613 16.9672 8.27026 16.7231L12.0848 12.939Z" fill="white"/>
                </svg>
            </button>
            <div id="update_loader" style="display: none;" class="w-full h-auto px-14 py-12 bg-white rounded-xl overflow-hidden">
                <div class="w-full h-auto flex items-center justify-center py-16">
                    <div class="spinner-border animate-spin inline-block w-10 h-10 border-4 rounded-full text-main-red" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                </div>
            </div>
            <div id="update_container" class="w-full h-auto px-14 py-12 bg-white rounded-xl overflow-hidden"></div>
        </div>
    </div>

    <div id="absModalAdd" class="w-full h-screen fixed top-0 right-0 bottom-0 left-0 z-[999] bg-[#00000091]" style="visibility: hidden; opacity: 0;">
        <div class="max-w-[650px] h-auto relative left-2/4 -translate-x-2/4 top-2/4 -translate-y-2/4">
            <button type="button" id="absModalAddClose" class="absolute right-0 lg:right-auto left-auto lg:left-full -top-[35px] lg:-top-[26px]">
                <svg width="26" height="26" viewBox="0 0 26 26" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M13 0C20.1714 0 26 5.82864 26 13C26 20.1714 20.1714 26 13 26C5.82864 26 0 20.1714 0 13C0 5.82864 5.82864 0 13 0ZM13 24.6878C19.439 24.6878 24.6878 19.439 24.6878 13C24.6878 6.56103 19.439 1.31221 13 1.31221C6.56103 1.31221 1.3122 6.56103 1.3122 13C1.3122 19.439 6.56103 24.6878 13 24.6878Z" fill="white"/>
                    <path d="M12.0848 12.939L8.27026 9.12447C8.02613 8.88034 8.02613 8.45311 8.27026 8.20898C8.51439 7.96485 8.94162 7.96485 9.18576 8.20898L13.0003 12.0235L16.8149 8.20898C17.059 7.96485 17.4862 7.96485 17.7304 8.20898C17.9745 8.45311 17.9745 8.88034 17.7304 9.12447L13.9158 12.939L17.7304 16.7231C17.9745 16.9672 17.9745 17.3944 17.7304 17.6385C17.6083 17.7606 17.4252 17.8216 17.2726 17.8216C17.12 17.8216 16.9369 17.7606 16.8149 17.6385L13.0003 13.824L9.18576 17.6385C9.06369 17.7606 8.88059 17.8216 8.72801 17.8216C8.57543 17.8216 8.39233 17.7606 8.27026 17.6385C8.02613 17.3944 8.02613 16.9672 8.27026 16.7231L12.0848 12.939Z" fill="white"/>
                </svg>
            </button>
            <div id="add_loader" style="display: none;" class="w-full h-auto px-14 py-12 bg-white rounded-xl overflow-hidden">
                <div class="w-full h-auto flex items-center justify-center py-16">
                    <div class="spinner-border animate-spin inline-block w-10 h-10 border-4 rounded-full text-main-red" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                </div>
            </div>
            <div id="add_container" class="w-full h-auto px-14 py-12 bg-white rounded-xl overflow-hidden">
                <h1 class="font-semibold text-2xl text-black mb-7">
                    Создать обявление
                </h1>
                <div>
                    <label for="servicesName" class="inline-block align-middle font-light text-xs text-stone-500">
                        Заголовок объявления:
                    </label>
                </div>
                <input type="text"
                       name="add_title"
                       placeholder="Ввведите наименование объявления"
                       class="block w-full py-2 mb-7 font-medium text-sm border-b border-solid border-b-stone-300 bg-white focus:border-b-main-red focus:outline-none">
                <div>
                    <label for="servicesName" class="inline-block align-middle font-light text-xs text-stone-500">
                        Описание:
                    </label>
                </div>
                <textarea name="add_content" rows="3" placeholder="Введите описание" class="block w-full py-2 mb-7 font-medium text-sm border-b border-solid border-b-stone-300 bg-white focus:border-b-main-red focus:outline-none"></textarea>
                <div id="add_container_file" style="display: none;" class="w-full grid grid-cols-1 gap-8 mb-7"></div>
                <div>
                    <label for="servicesName" class="inline-block align-middle font-light text-xs text-stone-500">
                        Прикрепить файл (Допустимые форматы: jpg, jpeg, png)
                    </label>
                </div>
                <input class="form-control block w-full px-3 py-1.5 mb-7 text-xs sm:text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-main-red focus:bg-white focus:border-main-red focus:outline-none"
                       type="file"
                       name="add_file"
                       accept=".jpg, .jpeg, .png">
                <div id="add_loader_file" class="w-full h-auto flex items-center justify-center py-2" style="display: none;">
                    <div class="spinner-border animate-spin inline-block w-5 h-5 border-2 rounded-full text-main-red mb-7" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                </div>
                <button type="button" id="addAbs" class="block md:inline-block w-full md:w-auto shadow-[0px_0px_4px_0px_#00000040] rounded-xl bg-black text-white font-light text-xs uppercase py-3 px-12">
                    СОЗДАТЬ
                </button>
            </div>
        </div>
    </div>

</div>

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

<?php
$script = <<<JS
    let add = { container: $('#add_container'), container_file: $('#add_container_file'), loader: $('#add_loader'), loader_file: $('#add_loader_file'), btn: $('#addAbs') };
    let on = { container: $('#container_onload'), loader: $('#loader_onload') };
    let view = { container: $('#container_view'), loader: $('#view_loader') };
    let up = { container: $('#update_container'), loader: $('#update_loader') };
    let del = {
        btn_open: $('#openDelete'),
        btn_del: $('#btnDelete'),
        content: $('#deleteContent'),
        loader: $('#deleteLoader'),
        btns: $('#deleteButtons')
    }
    
    $.ajax({
        url: '/frontend/web/abs/view-abs-all',
        type: 'post',
        dataType: 'html',
        data: 1,
        beforeSend: function (){
            on.loader.show();
        },
        success: function (response){
            on.loader.hide();
            on.container.html(response).show();
            getLogs('abs', 'view-abs-all', 'returned data abs', 1, false);
        },
        error: function (response){
            getLogs('abs', 'view-abs-all', 'returned data abs', 0, response['responseText']);
            alert("Упс! Кажется произошла ошибка при загрузке данных. Пожалуйста, перезагрузите страницу или попробуйте позже!\\n\\nОтвет ошибки:\\n" + response['responseText']);
            console.log(response);
        }
    });

    $('input[name=\'add_file\'').on('change', function (){
        let _file = $('input[name=\'add_file\']').prop('files')[0];
        if( typeof _file == 'undefined' ) return false;
        let _data = new FormData();
        _data.append('file', _file);
        $.ajax({
            url: '/frontend/web/tools/upload',
            type: 'post',
            dataType: 'html',
            data: _data,
            cache : false,
            processData: false,
            contentType: false, 
            beforeSend: function (){
                $('input[name=\'add_file\'').hide();
                add.loader_file.show();
            },
            success: function (response){
                let src = response;
                $.ajax({
                    url: '/frontend/web/abs/add-file-form',
                    type: 'post',
                    dataType: 'html',
                    data: { 'src': src },
                    success: function (response){
                        add.container_file.append(response).show();
                        $('input[name=\'add_file\'').val('').show();
                        add.loader_file.hide();
                        getLogs('abs', 'view-file-in-form', 'returned data file - '+src, 1, false);
                    },
                    error: function (response){
                        getLogs('abs', 'view-file-in-form', 'returned data file - '+src, 0, response['responseText']);
                        alert("Упс! Кажется произошла ошибка при загрузке данных. Пожалуйста, перезагрузите страницу или попробуйте позже!\\n\\nОтвет ошибки:\\n" + response['responseText']);
                        console.log(response);
                    }
                });
                getLogs('abs', 'uploaded', 'uploaded file - '+response, 1, false);
            },
            error: function (response){
                getLogs('abs', 'uploaded', 'uploaded file - '+response, 0, response['responseText']);
                alert("Упс! Кажется произошла ошибка при загрузке данных. Пожалуйста, перезагрузите страницу или попробуйте позже!\\n\\nОтвет ошибки:\\n" + response['responseText']);
                console.log(response);
            }
        });
    });

    add.btn.on('click', function (){
        let title = $('input[name=\'add_title\']').val();
        let content = $('textarea[name=\'add_content\']').val();
        let files = [];
        add.container_file.children('div[name^=\'abs_file_\']').each(function (){
            files.push($(this).attr('data-src'));
        });
        $.ajax({
            url: '/frontend/web/abs/add-abs',
            type: 'post',
            dataType: 'html',
            data: { 'title': title, 'content': content, 'files': files },
            beforeSend: function (){
                add.container.hide();
                add.loader.show();
            },
            success: function (response){
                location.reload();
                getLogs('abs', 'add-abs', 'adding abs - '+title, 1, false);
            },
            error: function (response){
                getLogs('abs', 'add-abs', 'adding abs - '+title, 0, response['responseText']);
                alert("Упс! Кажется произошла ошибка при загрузке данных. Пожалуйста, перезагрузите страницу или попробуйте позже!\\n\\nОтвет ошибки:\\n" + response['responseText']);
                console.log(response);
            }
        });
    });
    
    add.container_file.on('click', 'button[name^=\'abs_delete_\']', function (){
        let id = $(this).attr('name').replace('abs_delete_', '');
        $('div[name=\'abs_file_'+id+'\'').remove();
    });
    
    on.container.on('click', 'button[name^=\'selected_abs_\']', function (){
        $('#absModal').css('visibility', 'visible').animate({ opacity: 1 }, 150);
        let id = $(this).attr('name').replace('selected_abs_', '');
        $.ajax({
            url: '/frontend/web/abs/view-abs',
            type: 'post',
            dataType: 'html',
            data: { 'id': id },
            beforeSend: function (){
                view.loader.show();
                view.container.hide();
            },
            success: function (response){
                view.container.html(response).show();
                view.loader.hide();
                getLogs('abs', 'view-abs', 'view abs - '+id, 1, false);
            },
            error: function (response){
                getLogs('abs', 'view-abs', 'view abs - '+id, 0, response['responseText']);
                alert("Упс! Кажется произошла ошибка при загрузке данных. Пожалуйста, перезагрузите страницу или попробуйте позже!\\n\\nОтвет ошибки:\\n" + response['responseText']);
                console.log(response);
            }
        });
    });
    
    let update_id = 0;
    
    $('#container_onload').on('click', 'button[name^=\'btn_update_\']', function (){
        update_id = $(this).attr('name').replace('btn_update_', '');
        $.ajax({
           url: '/frontend/web/abs/view-form-update-abs',
           type: 'post',
           dataType: 'html',
           data: { 'id': update_id },
           beforeSend: function (){
                up.container.hide();
                up.loader.show();
           },
           success: function (response){
               up.container.html(response).show();
               up.loader.hide();
               getLogs('abs', 'view-form-update-abs', 'view abs - '+update_id, 1, false);
           },
           error: function (response){
                getLogs('abs', 'view-form-update-abs', 'view abs - '+update_id, 0, response['responseText']);
                alert("Упс! Кажется произошла ошибка при загрузке данных. Пожалуйста, перезагрузите страницу или попробуйте позже!\\n\\nОтвет ошибки:\\n" + response['responseText']);
                console.log(response);
           }
        });
    });
    
    up.container.on('click', '#updateAbs', function (){
        let title = $('input[name=\'update_title\']').val();
        let content = $('textarea[name=\'update_content\']').val();
        let files = [];
        $('#update_container div[name^=\'abs_file_update_\']').each(function (){
            files.push($(this).attr('data-src'));
        });
        console.log(files);
        $.ajax({
            url: '/frontend/web/abs/update-abs',
            type: 'post',
            dataType: 'html',
            data: { 'id': update_id, 'title': title, 'content': content, 'files': files },
            beforeSend: function (){
                up.container.hide();
                up.loader.show();
            },
            success: function (response){
                location.reload();
                getLogs('abs', 'update-abs', 'updated abs - '+update_id, 1, false);
            },
            error: function (response){
                getLogs('abs', 'update-abs', 'updated abs - '+update_id, 0, response['responseText']);
                alert("Упс! Кажется произошла ошибка при загрузке данных. Пожалуйста, перезагрузите страницу или попробуйте позже!\\n\\nОтвет ошибки:\\n" + response['responseText']);
                console.log(response);
            }
        });
    });
    
    let delete_id = 0;
    
    on.container.on('click', 'button[name^=\'btn_delete_\']', function (){
        delete_id = $(this).attr('name').replace('btn_delete_', '');
        del.btn_open.trigger('click');
    });
    
    del.btn_del.on('click', function (){
        $.ajax({
            url: '/frontend/web/abs/delete-abs',
            type: 'post',
            dataType: 'html',
            data: { 'id': delete_id },
            beforeSend: function (){
                del.content.hide();
                del.btns.hide();
                del.loader.show();
            },
            success: function (response){
                location.reload();
                getLogs('abs', 'delete-abs', 'delete abs - '+delete_id, 1, false);
            },
            error: function (response){
                getLogs('abs', 'delete-abs', 'delete abs - '+delete_id, 0, response['responseText']);
                alert("Упс! Кажется произошла ошибка при загрузке данных. Пожалуйста, перезагрузите страницу или попробуйте позже!\\n\\nОтвет ошибки:\\n" + response['responseText']);
                console.log(response);
            }
        });
    });
    
JS;

$this->registerJs($script, \yii\web\View::POS_READY);
