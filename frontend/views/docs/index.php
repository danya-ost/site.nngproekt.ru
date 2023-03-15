<?php

/** @var \yii\web\View $this */
/** @var  */
/** @var \frontend\controllers\DocsController $permission */

use yii\helpers\Url;

$this->title = 'Документы';
?>
<div class="container h-auto">
    <div class="w-full ha-auto mb-6">
        <h1 class="font-bold text-4xl uppercase">ДОКУМЕНТЫ</h1>
    </div>

    <?php if ( $permission['addDocs'] ): ?>
        <div class="relative rounded overflow-hidden my-5 bg-white shadow-sm hover:shadow-lg px-2 py-3 border border-solid border-stone-200 duration-200 ease-in-out transition-all pb-10 sm:pb-3">
            <div class="rounded-tl bg-stone-200 text-xs text-white font-bold absolute right-0 bottom-0 px-5 py-1 border-t border-l border-solid border-stone-200">NNGP ADMIN</div>
            <?php if ( $permission['addDocs'] ): ?>
                <button data-bs-toggle="modal" data-bs-target="#pdfModal" class="block sm:inline-block align-middle text-center rounded px-6 py-2.5 ml-1 mt-1 md:mt-0 bg-stone-300 text-white font-medium text-xs leading-tight uppercase hover:bg-gray-900 hover:shadow-lg focus:bg-gray-900 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-gray-900 active:shadow-lg transition duration-150 ease-in-out">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 inline-block align-middle">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 5v14m7-7H5" />
                    </svg>
                    <span class="ml-1 inline-block align-middle">Добавить документ</span>
                </button>
            <?php endif; ?>
        </div>
    <?php endif; ?>

    <div id="container" class="w-full h-auto grid grid-cols-1 md:grid-cols-2 gap-6 mb-24"></div>
    <div id="loader" class="w-full h-auto flex items-center justify-center py-10">
        <div class="spinner-border animate-spin inline-block w-10 h-10 border-4 rounded-full text-main-red mb-24" role="status">
            <span class="visually-hidden">Loading...</span>
        </div>
    </div>

    <div class="modal fade fixed top-0 left-0 hidden w-full h-full outline-none overflow-x-hidden overflow-y-auto" id="pdfModal" tabindex="-1" aria-labelledby="exampleModalCenterTitle" aria-modal="true" role="dialog">
        <div class="modal-dialog modal-dialog-centered relative w-auto pointer-events-none">
            <div class="modal-content border-none shadow-lg relative flex flex-col w-full pointer-events-auto bg-white bg-clip-padding rounded-md outline-none text-current">
                <div class="modal-header flex flex-shrink-0 items-top justify-between p-4 border-b border-gray-200 rounded-t-md">
                    <h5 class="text-xl font-medium leading-normal text-gray-800" id="exampleModalScrollableLabel">
                        Добавление документа
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
                    <div id="containerFile">
                        <div class="mb-5">
                            <div>
                                <label for="pdfName" class="inline-block align-middle font-light text-xs text-stone-500">
                                    Наименование файла
                                </label>
                            </div>
                            <input type="text"
                                   id="pdfName"
                                   name="title"
                                   placeholder="Ввведите наименование файла"
                                   class="block w-full py-2 font-medium text-sm border-b border-solid border-b-stone-300 bg-white focus:border-b-main-red focus:outline-none">
                        </div>

                        <p class="text-sm text-black">
                            Допустимые форматы: pdf<br> <br>
                        </p>
                        <input class="form-control block w-full px-3 py-1.5 text-xs sm:text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-main-red focus:bg-white focus:border-main-red focus:outline-none"
                               type="file"
                               name="pdfFile"
                               accept=".pdf"
                               id="pdfFile">
                    </div>
                    <div id="loaderFile" class="w-full h-auto flex items-center justify-center py-10" style="display: none;">
                        <div class="spinner-border animate-spin inline-block w-10 h-10 border-4 rounded-full text-main-red mb-24" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                    </div>
                </div>
                <div class="modal-footer flex flex-shrink-0 flex-wrap items-center justify-end p-4 border-t border-gray-200 rounded-b-md">
                    <button type="button"
                            id="pdfUpload"
                            class="inline-block align-middle rounded px-6 py-2.5 ml-1 bg-gray-800 text-white font-medium text-xs leading-tight uppercase shadow-md hover:bg-gray-900 hover:shadow-lg focus:bg-gray-900 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-gray-900 active:shadow-lg transition duration-150 ease-in-out">
                        Сохранить
                    </button>
                </div>
            </div>
        </div>
    </div>

</div>
<?php
$script = <<<JS
    let location = 'docs';
    $('#a_'+location).removeClass('text-black').addClass('text-main-red').removeClass('font-medium').addClass('font-bold');
    
    let e = {
        container: $('#container'),
        loader: $('#loader'),
        upload_container: $('#containerFile'),
        upload_loader: $('#loaderFile'),
        upload_btn: $('#pdfUpload'),
        btn_delete_mode: $('#deleteMode'),
        btn_delete_mode_close: $('#deleteModeClose')
    }
    
    function getLastId(){ let last_id = 0; $('a[name^=\'item_doc_\']').each(function (){ last_id = $(this).attr('data-doc');  }); return last_id; }
    
    function getDocs(last_id, onload, reloaded){
        $.ajax({
            url: '/frontend/web/docs/view-docs-all',
            type: 'post',
            dataType: 'html',
            data: { 'id': last_id, 'onload': onload },
            beforeSend: function (){
                e.container.hide();
                e.loader.show();
            },
            success: function (response){
                reloaded ? e.container.html(response) : e.container.append(response);
                e.loader.hide();
                e.container.show();
                getLogs('docs', 'loaded', 'Loading docs on ajax (pagination) - '+last_id, 1, false);
                return true;
            },
            error: function (response){
                getLogs('docs', 'loaded', 'Loading docs on ajax (pagination) - '+last_id, 0, response['responseText']);
                alert("Упс! Кажется произошла ошибка при загрузке данных. Пожалуйста, перезагрузите страницу или попробуйте позже!\\n\\nОтвет ошибки:\\n" + response['responseText']);
                console.log(response);
                return false;
            }
        });
    }
    
    getDocs(0, true, false);
    
    e.upload_btn.on('click', function(){
        let _file = $('input[name=\'pdfFile\']').prop('files')[0];
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
                e.upload_container.hide();
                e.upload_loader.show();
                e.upload_btn.hide();
            },
            success: function (response){
                let src = response;
                $.ajax({
                    url: '/frontend/web/docs/add-file',
                    type: 'post',
                    dataType: 'html',
                    data: { 'src': src, 'title': $('input[name=\'title\']').val() },
                    success: function (response){
                        getDocs(0, true, true);
                        e.upload_container.show();
                        e.upload_loader.hide();
                        e.upload_btn.show();
                        getLogs('docs', 'add-file', 'save_data_file - '+src, 1, false);
                    },
                    error: function (response){
                        getLogs('docs', 'add-file', 'save_data_file - '+src, 0, response['responseText']);
                        alert("Упс! Кажется произошла ошибка при загрузке данных. Пожалуйста, перезагрузите страницу или попробуйте позже!\\n\\nОтвет ошибки:\\n" + response['responseText']);
                        console.log(response);
                    }
                });
                getLogs('docs', 'uploaded', 'uploaded file - '+response, 1, false);
            },
            error: function (response){
                getLogs('docs', 'uploaded', 'uploaded file - '+response, 0, response['responseText']);
                alert("Упс! Кажется произошла ошибка при загрузке данных. Пожалуйста, перезагрузите страницу или попробуйте позже!\\n\\nОтвет ошибки:\\n" + response['responseText']);
                console.log(response);
            }
        });
    });
    
    e.btn_delete_mode.on('click', function (){
        $('a[name^=\'doc_item_\']').each(function (){ $(this).removeAttr('href'); });
        $('button[name^=\'doc_delete_\']').each(function (){ $(this).fadeIn(); });
        $(this).hide();
        e.btn_delete_mode_close.show();
    });
    
    e.container.on('click', 'button[name^=\'doc_delete_\']', function (){
        let id = $(this).attr('name').replace('doc_delete_', '');
        $.ajax({
            url: '/frontend/web/docs/delete-docs',
            type: 'post',
            dataType: 'html',
            data: { 'id': id },
            beforeSend: function (){
                e.container.hide();
                e.loader.show();
            },
            success: function (response){
                getDocs(0, true, true);
                e.loader.hide();
                e.container.show();
                getLogs('docs', 'remove-file', 'remove_data_file - '+id, 1, false);
            },
            error: function (response){
                getLogs('docs', 'remove-file', 'remove_data_file - '+id, 0, response['responseText']);
                alert("Упс! Кажется произошла ошибка при загрузке данных. Пожалуйста, перезагрузите страницу или попробуйте позже!\\n\\nОтвет ошибки:\\n" + response['responseText']);
                console.log(response);
            }
        });
    });
JS;

$this->registerJs($script, \yii\web\View::POS_READY);