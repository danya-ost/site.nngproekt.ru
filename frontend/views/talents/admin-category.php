<?php
/** @var yii\web\View $this */
/** @var frontend\controllers\TalentsController $permission */

use yii\helpers\Url;

$this->title = 'КАТЕГОРИИ НОВОСТЕЙ [Администрирование]';
?>

<div id="main-div" class="container h-auto">

    <div class="w-full ha-auto mb-6">
        <h1 class="font-bold text-4xl uppercase">КАТЕГОРИИ ПОСТОВ "ТАЛАНТЫ"</h1>
    </div>

    <a onclick="javascript:history.back(); return false;" class="inline-block align-middle px-2.5 py-2 border-2 border-gray-800 text-gray-800 font-medium text-xs leading-tight uppercase rounded hover:bg-black hover:bg-opacity-5 focus:outline-none focus:ring-0 transition duration-150 ease-in-out">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 inline-block align-middle">
            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 12h-15m0 0l6.75 6.75M4.5 12l6.75-6.75" />
        </svg>
    </a>

    <?php if ( $permission['addTalentsCategory'] ) : ?>
        <button data-bs-toggle="modal" data-bs-target="#modalAddCategory" class="inline-block align-middle rounded px-6 py-2.5 ml-1 bg-gray-800 text-white font-medium text-xs leading-tight uppercase shadow-md hover:bg-gray-900 hover:shadow-lg focus:bg-gray-900 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-gray-900 active:shadow-lg transition duration-150 ease-in-out">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 inline-block align-middle">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 5v14m7-7H5" />
            </svg>
            <span class="ml-1 inline-block align-middle">Добавить категорию</span>
        </button>
    <?php endif; ?>

    <div id="containerCategory" class="w-full h-auto grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-3 mb-24 mt-5"></div>

    <div id="loader" class="w-full h-auto flex items-center justify-center py-10">
        <div class="spinner-border animate-spin inline-block w-10 h-10 border-4 rounded-full text-main-red mb-24 mt-5" role="status">
            <span class="visually-hidden">Loading...</span>
        </div>
    </div>

    <button type="button" id="newsCategory" data-bs-toggle="modal" data-bs-target="#modalInfoCategory" class="hidden"></button>

</div>

<div class="modal fade fixed top-0 left-0 hidden w-full h-full outline-none overflow-x-hidden overflow-y-auto" id="modalAddCategory" tabindex="-1" aria-labelledby="exampleModalCenteredScrollable" aria-modal="true" role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable relative w-auto pointer-events-none">
        <div class="modal-content border-none shadow-lg relative flex flex-col w-full pointer-events-auto bg-white bg-clip-padding outline-none text-current">
            <div class="modal-header flex flex-shrink-0 items-center justify-between p-4 border-b border-gray-200">
                <h5 class="text-xl font-medium leading-normal text-gray-800" id="exampleModalCenteredScrollableLabel">
                    Добавление категории
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
            <div id="modalContentAdd" class="modal-body relative p-4 cust-scroll">
                <label for="add-category" class="block font-light text-xs text-stone-500">
                    Наименование категории постов
                </label>
                <input type="text"
                       id="add-category"
                       name="new-category"
                       placeholder="Нижегороднефтегазпроект"
                       class="block w-full py-2 font-medium text-sm border-b border-solid border-b-stone-300 bg-white focus:border-b-main-red focus:outline-none">
                <div id="modalLoaderAdd" class="w-full h-auto flex items-center justify-center py-5" style="display: none;">
                    <div class="spinner-border animate-spin inline-block w-10 h-10 border-4 rounded-full text-main-red mb-24" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                </div>
            </div>
            <div id="modelFooterAdd" class="modal-footer flex flex-shrink-0 flex-wrap items-center justify-center p-4 border-t border-gray-200">
                <?php if ( $permission['addTalentsCategory'] ): ?>
                    <button type="button" id="btnSaveNewCategory" data-id="0" class="inline-block align-middle rounded px-6 py-2.5 ml-1 bg-gray-800 text-white font-medium text-xs leading-tight uppercase shadow-md hover:bg-gray-900 hover:shadow-lg focus:bg-gray-900 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-gray-900 active:shadow-lg transition duration-150 ease-in-out">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 inline-block align-middle">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 9.75v6.75m0 0l-3-3m3 3l3-3m-8.25 6a4.5 4.5 0 01-1.41-8.775 5.25 5.25 0 0110.233-2.33 3 3 0 013.758 3.848A3.752 3.752 0 0118 19.5H6.75z" />
                        </svg>
                        <span class="ml-1 inline-block align-middle">Сохранить</span>
                    </button>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<div class="modal fade fixed top-0 left-0 hidden w-full h-full outline-none overflow-x-hidden overflow-y-auto" id="modalInfoCategory" tabindex="-1" aria-labelledby="exampleModalCenteredScrollable" aria-modal="true" role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable relative w-auto pointer-events-none">
        <div class="modal-content border-none shadow-lg relative flex flex-col w-full pointer-events-auto bg-white bg-clip-padding outline-none text-current">
            <div class="modal-header flex flex-shrink-0 items-center justify-between p-4 border-b border-gray-200">
                <h5 class="text-xl font-medium leading-normal text-gray-800" id="exampleModalCenteredScrollableLabel">
                    Категория
                </h5>
            </div>
            <div id="modalContent" class="modal-body relative p-4 cust-scroll">
                <div id="modalLoader" class="w-full h-auto flex items-center justify-center py-5" style="display: none;">
                    <div class="spinner-border animate-spin inline-block w-10 h-10 border-4 rounded-full text-main-red mb-24" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                </div>
            </div>
            <div id="modelFooter" class="modal-footer flex flex-shrink-0 flex-wrap items-center justify-center p-4 border-t border-gray-200">
                <button type="button" id="modalClose" data-bs-dismiss="modal" aria-label="Close" class="inline-block align-middle rounded px-3 py-2.5 ml-1 bg-gray-800 text-white font-medium text-xs leading-tight uppercase shadow-md hover:bg-gray-900 hover:shadow-lg focus:bg-gray-900 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-gray-900 active:shadow-lg transition duration-150 ease-in-out">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="inline-block align-middle w-4 h-4">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15M12 9l-3 3m0 0l3 3m-3-3h12.75" />
                    </svg>
                </button>

                <?php if ( $permission['deleteTalentsCategory'] ): ?>
                    <button type="button" id="btnDelete" data-id="0" class="inline-block align-middle rounded px-3 py-2.5 ml-1 bg-gray-800 text-white font-medium text-xs leading-tight uppercase shadow-md hover:bg-gray-900 hover:shadow-lg focus:bg-gray-900 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-gray-900 active:shadow-lg transition duration-150 ease-in-out">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="inline-block align-middle w-4 h-4">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                        </svg>
                    </button>
                <?php endif; ?>

                <?php if ( $permission['updateTalentsCategory'] ): ?>
                    <button type="button" id="btnSave" data-id="0" class="inline-block align-middle rounded px-6 py-2.5 ml-1 bg-gray-800 text-white font-medium text-xs leading-tight uppercase shadow-md hover:bg-gray-900 hover:shadow-lg focus:bg-gray-900 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-gray-900 active:shadow-lg transition duration-150 ease-in-out">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 inline-block align-middle">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 9.75v6.75m0 0l-3-3m3 3l3-3m-8.25 6a4.5 4.5 0 01-1.41-8.775 5.25 5.25 0 0110.233-2.33 3 3 0 013.758 3.848A3.752 3.752 0 0118 19.5H6.75z" />
                        </svg>
                        <span class="ml-1 inline-block align-middle">Сохранить</span>
                    </button>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<?php
$script = <<<JS
    let elements = {
        loader: $('#loader'),
        container: $('#containerCategory'),
        view_category: $('#newsCategory'),
        view_content: $('#modalContent'),
        view_loader: $('#modalLoader'),
        view_footer: $('#modelFooter'),
        view_close: $('#modalClose'),
        update_category: $('#btnSave'),
        delete_category: $('#btnDelete'),
        add_category: $('#btnSaveNewCategory'),
        add_value: $('input[name=\'new-category\']'),
        add_loader: $('#modalLoaderAdd'),
        add_close: $('#modelAddClose')
    }
    
    function getCategory(){
        $.ajax({
            url: '/frontend/web/talents/view-category',
            type: 'post',
            dataType: 'html',
            data: 1,
            beforeSend: function (){
                elements.container.hide();
                elements.loader.show();
            },
            success: function (response){
                elements.container.html(response).show();
                elements.loader.hide();
            },
            error: function (response){
                alert("Упс! Кажется произошла ошибка при загрузке данных. Пожалуйста, перезагрузите страницу или попробуйте позже!\\n\\nОтвет ошибки:\\n" + response['responseText']);
                console.log(response);
            }
        });
    }
    
    getCategory();

    let current_id = 0;
    
    elements.container.on('click', 'div[name^=\'category_view_\']', function (){
        elements.view_category.trigger('click');
        current_id = $(this).attr('data-category');
        console.log(current_id);
        $.ajax({
            url: '/frontend/web/talents/view-current-category',
            type: 'post',
            dataType: 'html',
            data: { 'id': current_id },
            beforeSend: function (){
                elements.view_content.hide();
                elements.view_loader.show();
            },
            success: function (response){
                elements.view_content.html(response).show();
                elements.view_loader.hide();
            },
            error: function (response){
                alert("Упс! Кажется произошла ошибка при загрузке данных. Пожалуйста, перезагрузите страницу или попробуйте позже!\\n\\nОтвет ошибки:\\n" + response['responseText']);
                console.log(response);
            }
        });
    });
    
    elements.update_category.on('click', function (){
        let value = $('input[name=\'update-category\']').val();
        $.ajax({
            url: '/frontend/web/talents/update-category',
            type: 'post',
            dataType: 'html',
            data: { 'id': current_id, 'value': value },
            beforeSend: function (){
                elements.view_footer.hide();
                elements.view_content.hide();
                elements.view_loader.show();
            },
            success: function (response){
                elements.view_close.trigger('click');
                elements.view_content.html(response).show();
                elements.view_loader.hide();
                elements.view_footer.show();
                getCategory();
            },
            error: function (response){
                alert("Упс! Кажется произошла ошибка при загрузке данных. Пожалуйста, перезагрузите страницу или попробуйте позже!\\n\\nОтвет ошибки:\\n" + response['responseText']);
                console.log(response);
            }
        });
    });
    
    elements.delete_category.on('click', function (){
        $.ajax({
            url: '/frontend/web/talents/delete-category',
            type: 'post',
            dataType: 'html',
            data: { 'id': current_id },
            beforeSend: function (){
                elements.view_footer.hide();
                elements.view_content.hide();
                elements.view_loader.show();
            },
            success: function (response){
                elements.view_close.trigger('click');
                elements.view_content.html(response).show();
                elements.view_loader.hide();
                elements.view_footer.show();
                getCategory();
            },
            error: function (response){
                alert("Упс! Кажется произошла ошибка при загрузке данных. Пожалуйста, перезагрузите страницу или попробуйте позже!\\n\\nОтвет ошибки:\\n" + response['responseText']);
                console.log(response);
            }
        });
    }); 
    
    elements.add_category.on('click', function (){
       let value = elements.add_value.val();
       $.ajax({
            url: '/frontend/web/talents/add-category',
            type: 'post',
            dataType: 'html',
            data: { 'value': value },
            beforeSend: function (){
                $(this).hide();
                elements.add_value.hide();
                elements.add_loader.show();
            },
            success: function (response){
                elements.add_close.trigger('click');
                elements.add_value.show().val('');
                elements.add_loader.hide();
                $(this).show();
                getCategory();
            },
            error: function (response){
                alert("Упс! Кажется произошла ошибка при загрузке данных. Пожалуйста, перезагрузите страницу или попробуйте позже!\\n\\nОтвет ошибки:\\n" + response['responseText']);
                console.log(response);
            }
        });
    });
JS;

$this->registerJs($script, \yii\web\View::POS_READY);
