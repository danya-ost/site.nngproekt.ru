<?php

/** @var \yii\web\View $this */

$this->title = 'Добавление на доску почета';
?>
<div class="container h-auto pb-24">
    <div class="w-full ha-auto mb-12">
        <a onclick="javascript:history.back(); return false;" class="inline-block align-middle px-2.5 py-2 mr-2 border-2 border-gray-800 text-gray-800 font-medium text-xs leading-tight uppercase rounded hover:bg-black hover:bg-opacity-5 focus:outline-none focus:ring-0 transition duration-150 ease-in-out">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 inline-block align-middle">
                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 12h-15m0 0l6.75 6.75M4.5 12l6.75-6.75" />
            </svg>
        </a>

        <h1 class="inline-block align-middle font-semibold text-2xl">
            Добавление опроса
        </h1>
    </div>

    <div class="grid grid-cols-1 gap-10 md:gap-x-28 gap-y-9">

        <div class="relative">
            <label for="user_id" class="font-light text-xs text-stone-500">
                Сотрудник компании
            </label>
            <input type="text"
                   id="user_id"
                   name="user_id"
                   placeholder="Начните вводить фамилию..."
                   class="block w-full py-2 font-medium text-sm border-b border-solid border-b-stone-300 bg-[#F8F8F8] focus:border-b-main-red focus:outline-none">
            <div id="helper_container" style="display: none;" class="w-full h-auto absolute z-[999] top-full bg-white shadow-lg border-r border-b border-l border-solid border-stone-300"></div>
            <div id="helper_loader" style="display: none;" class="w-full h-auto absolute z-[999] top-full bg-white shadow-lg border-r border-b border-l border-solid border-stone-300">
                <div class="w-full h-auto flex items-center justify-center p-1">
                    <div class="spinner-border animate-spin inline-block w-5 h-5 border-2 rounded-full text-main-red" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                </div>
            </div>
        </div>

        <div>
            <label for="text" class="font-light text-xs text-stone-500">
                Обоснование
            </label>
            <textarea type="text"
                    id="text"
                    name="text"
                    placeholder="Обоснуйте помещения на доску..."
                    maxlength="100"
                    rows="3"
                    class="block w-full py-2 font-medium text-sm border-b border-solid border-b-stone-300 bg-[#F8F8F8] focus:border-b-main-red focus:outline-none"></textarea>
        </div>

    </div>

    <div class="mt-10 flex items-center justify-end">
        <button type="button" id="btn_save" class="inline-block align-middle rounded px-6 py-2.5 bg-gray-800 text-white font-medium text-xs leading-tight uppercase shadow-md hover:bg-gray-900 hover:shadow-lg focus:bg-gray-900 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-gray-900 active:shadow-lg transition duration-150 ease-in-out">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 inline-block align-middle">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
            </svg>
            <span class="ml-1 inline-block align-middle">Поместить</span>
        </button>
    </div>

    <div id="loader" style="display: none;" class="w-full h-auto flex items-center justify-center py-10">
        <div class="spinner-border animate-spin inline-block w-10 h-10 border-4 rounded-full text-main-red mb-24" role="status">
            <span class="visually-hidden">Loading...</span>
        </div>
    </div>
</div>
<?php
$script = <<<JS
    $('input[name=\'user_id\']').on('input keyup', function (){
        let value = $(this).val();
        let setAjax = $.ajax();
        if ( value.length >= 3 ){
            setAjax.abort();
            $.ajax({
                url: '/frontend/web/initiative/users-search',
                type: 'post',
                dataType: 'html',
                data: { 'value': value },
                beforeSend: function (){
                    $('#helper_loader').show();
                    $('#helper_container').show();
                },
                success: function (response){
                    $('#helper_loader').hide();
                    $('#helper_container').html(response);
                    getLogs('initiative', 'searching', 'searching on users data - '+value, 1, false);
                },
                error: function (response){
                    getLogs('initiative', 'searching', 'searching on users data - '+value, 0, response['responseText']);
                    alert("Упс! Кажется произошла ошибка при загрузке данных. Пожалуйста, перезагрузите страницу или попробуйте позже!\\n\\nОтвет ошибки:\\n" + response['responseText']);
                    console.log(response);
                }
            });
        } else{
            $('#helper_loader').hide();
            $('#helper_container').hide();
        }
    });

    let user_id;
    $('#helper_container').on('click', 'button[name^=\'selected_user_id_\']', function (){
        $('input[name=\'user_id\']').val($(this).text().trim());
        user_id = $(this).attr('name').replace('selected_user_id_', '');
        $('#helper_container').hide();
    });
    
    $('#btn_save').on('click', function (){
        $.ajax({
            url: '/frontend/web/honor/add-honor',
            type: 'post',
            dataType: 'html',
            data: { 'id': user_id, 'text': $('textarea[name=\'text\']').val() },
            beforeSend: function (){
                $('#btn_save').hide();
                $('#loader').show();
            },
            success: function (){
                window.location.href = '/frontend/web/honor/index';
            },
            error: function (response){
                alert("Упс! Кажется произошла ошибка при загрузке данных. Пожалуйста, перезагрузите страницу или попробуйте позже!\\n\\nОтвет ошибки:\\n" + response['responseText']);
                console.log(response);
            }
        });
    });
JS;

$this->registerJs($script, \yii\web\View::POS_READY);
