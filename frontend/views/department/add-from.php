<?php

/** @var \yii\web\View $this */

$this->title = 'Доваление департамента, подразделения или отдела';
?>
<div class="container h-auto">
    <div class="w-full ha-auto mb-12">
        <a onclick="javascript:history.back(); return false;" class="inline-block align-middle px-2.5 py-2 mr-2 border-2 border-gray-800 text-gray-800 font-medium text-xs leading-tight uppercase rounded hover:bg-black hover:bg-opacity-5 focus:outline-none focus:ring-0 transition duration-150 ease-in-out">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 inline-block align-middle">
                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 12h-15m0 0l6.75 6.75M4.5 12l6.75-6.75" />
            </svg>
        </a>

        <h1 class="inline-block align-middle font-semibold text-2xl">
            Добавление в структуру компании
        </h1>
    </div>

    <div class="mt-5">
        <label for="type" class="font-light text-xs text-stone-500">
            Типо структуры
        </label>
        <select type="text"
               name="type"
               id="type"
               class="block w-full py-2 font-medium text-sm border-b border-solid border-b-stone-300 bg-[#F8F8F8] focus:border-b-main-red focus:outline-none">
            <?php if ( $_GET['t'] == 't' ): ?>
                <option value="top">Департамент</option>
                <option value="middle">Подразделение</option>
                <option value="bottom">Отдел</option>
            <?php elseif ( $_GET['t'] == 'm' ): ?>
                <option value="middle">Подразделение</option>
                <option value="top">Департамент</option>
                <option value="bottom">Отдел</option>
            <?php else: ?>
                <option value="bottom">Отдел</option>
                <option value="top">Департамент</option>
                <option value="middle">Подразделение</option>
            <?php endif; ?>
        </select>
    </div>

    <div class="mt-5">
        <label for="title" class="font-light text-xs text-stone-500">
            Наименование
        </label>
        <input type="text"
               name="title"
               placeholder="Введите наименование"
               id="title"
               class="block w-full py-2 font-medium text-sm border-b border-solid border-b-stone-300 bg-[#F8F8F8] focus:border-b-main-red focus:outline-none">
    </div>

    <div class="mt-5">
        <label for="abbreviation" class="font-light text-xs text-stone-500">
            Абривиатуру
        </label>
        <input type="text"
               name="abbreviation"
               placeholder="Укажите абривиатуру"
               id="abbreviation"
               class="block w-full py-2 font-medium text-sm border-b border-solid border-b-stone-300 bg-[#F8F8F8] focus:border-b-main-red focus:outline-none">
    </div>

    <div class="mt-5">
        <label for="telephone" class="font-light text-xs text-stone-500">
            Телефон
        </label>
        <input type="text"
               name="telephone"
               placeholder="Введите телефон"
               id="telephone"
               class="block w-full py-2 font-medium text-sm border-b border-solid border-b-stone-300 bg-[#F8F8F8] focus:border-b-main-red focus:outline-none">
    </div>
    <div class="py-5 text-main-red italic text-xs">
        Внимание! Редактирование стуктуры вновь созданого департамента (подразделения или отдела) производиться на странице обновления данных. На данную страницу можно попасть кликнув по
        кнопке изменить в таблице на главное страницы администратора или после клика по кнопке сохранить на данной странице.
    </div>
    <div>
        <button type="button" style="display: none;" id="btn_save" class="inline-block align-middle rounded px-6 py-2.5 bg-gray-800 text-white font-medium text-xs leading-tight uppercase shadow-md hover:bg-gray-900 hover:shadow-lg focus:bg-gray-900 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-gray-900 active:shadow-lg transition duration-150 ease-in-out">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 inline-block align-middle">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
            </svg>
            <span class="ml-1 inline-block align-middle">Сохранить</span>
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
    let e = {
        btn_send: $('#btn_save'),
        loader: $('#loader')
    },
    params = {
        params_01: false,
        params_02: false,
        params_03: false
    }
    
    function isSend(){
        let params_lock = 0;
        for (let key in params){
            if ( params[key] ){
                params_lock++;
            }
        }
        if ( params_lock == 3 ){ e.btn_send.show() } else{ e.btn_send.hide() };
    }
    
    $('input[name=\'title\']').bind('input, keyup', function (){ if ( $(this).val().length > 0 ){ params.params_01 = true; } else{ params.params_01 = false; } isSend(); });
    $('input[name=\'abbreviation\']').bind('input, keyup', function (){ if ( $(this).val().length > 0 ){ params.params_02 = true; } else{ params.params_02 = false; } isSend(); });
    $('input[name=\'telephone\']').bind('input, keyup', function (){ if ( $(this).val().length > 0 ){ params.params_03 = true; } else{ params.params_03 = false; } isSend(); });
    
    e.btn_send.on('click', function (){
        $.ajax({
            url: '/frontend/web/department/add',
            type: 'post',
            dataType: 'html',
            data: { 'type': $('select[name=\'type\']').val(), 'title': $('input[name=\'title\']').val(), 'abbreviation': $('input[name=\'abbreviation\']').val(), 'telephone': $('input[name=\'telephone\']').val() },
            beforeSend: function (){
                $(this).hide();
                e.loader.show();
            },
            success: function (response){
                let type = 't';
                if ( $('select[name=\'type\']').val() == 'top' ){
                    type = 't';
                } else if ( $('select[name=\'type\']').val() == 'middle' ){
                    type = 'm';
                } else{
                    type = 'b';
                }
                window.location.href = '/frontend/web/department/update-form?d='+response+'&t='+type;
                getLogs('department', 'add', 'adding data to database: '+$('select[name=\'type\']').val(), 1, false);
            },
            error: function (response){
                getLogs('department', 'add', 'adding data to database: '+$('select[name=\'type\']').val(), 0, response['responseText']);
                alert("Упс! Кажется произошла ошибка при загрузке данных. Пожалуйста, перезагрузите страницу или попробуйте позже!\\n\\nОтвет ошибки:\\n" + response['responseText']);
                console.log(response);
            }
        });
    });
JS;

$this->registerJs($script, \yii\web\View::POS_READY);