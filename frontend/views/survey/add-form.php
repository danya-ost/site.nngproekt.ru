<?php

/** @var \yii\web\View $this */

$this->title = 'Добавление опроса';
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

    <div class="grid grid-cols-1 sm:grid-cols-2 gap-10 md:gap-x-28 gap-y-9">

        <div>
            <label for="title" class="font-light text-xs text-stone-500">
                Нимаенование
            </label>
            <input type="text"
                   id="title"
                   name="title"
                   placeholder="Введите наименование..."
                   class="block w-full py-2 font-medium text-sm border-b border-solid border-b-stone-300 bg-[#F8F8F8] focus:border-b-main-red focus:outline-none">
        </div>

        <div>
            <label for="href" class="font-light text-xs text-stone-500">
                Ссылка на опрос
            </label>
            <input type="text"
                   id="href"
                   name="href"
                   placeholder="Введите ссылку на опрос..."
                   class="block w-full py-2 font-medium text-sm border-b border-solid border-b-stone-300 bg-[#F8F8F8] focus:border-b-main-red focus:outline-none">
        </div>

        <div class="sm:col-span-2 relative">
            <label for="href" class="font-light text-xs text-stone-500">
                Прикрепите обложку
            </label>
            <input type="hidden" name="cover_src" value="false">
            <input class="form-control block w-full px-3 py-1.5 mb-7 text-xs sm:text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-main-red focus:bg-white focus:border-main-red focus:outline-none"
                   type="file"
                   name="cover"
                   accept=".jpeg, .png, .jpg, .webmp">
            <div id="loader_cover" style="display: none;" class="flex items-center justify-content absolute top-[37%] right-2 z-[999]">
                <div class="spinner-border animate-spin inline-block w-5 h-5 border-4 rounded-full text-main-red mb-24" role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>
            </div>
            <div id="success_cover" style="display: none;" class="flex items-center justify-content absolute top-[37%] right-2 z-[999]">
                <div class="inline-block w-5 h-5 text-green-500 mb-24" role="status">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12c0 1.268-.63 2.39-1.593 3.068a3.745 3.745 0 01-1.043 3.296 3.745 3.745 0 01-3.296 1.043A3.745 3.745 0 0112 21c-1.268 0-2.39-.63-3.068-1.593a3.746 3.746 0 01-3.296-1.043 3.745 3.745 0 01-1.043-3.296A3.745 3.745 0 013 12c0-1.268.63-2.39 1.593-3.068a3.745 3.745 0 011.043-3.296 3.746 3.746 0 013.296-1.043A3.746 3.746 0 0112 3c1.268 0 2.39.63 3.068 1.593a3.746 3.746 0 013.296 1.043 3.746 3.746 0 011.043 3.296A3.745 3.745 0 0121 12z" />
                    </svg>
                </div>
            </div>
        </div>

    </div>

    <div class="mt-10 flex items-center justify-end">
        <button type="button" id="btn_save" style="display: none;" class="inline-block align-middle rounded px-6 py-2.5 bg-gray-800 text-white font-medium text-xs leading-tight uppercase shadow-md hover:bg-gray-900 hover:shadow-lg focus:bg-gray-900 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-gray-900 active:shadow-lg transition duration-150 ease-in-out">
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
    let params = {
        params_01: false,
        params_02: false,
        params_03: false
    }
    
    function lockSend(){
        let params_lock = 0;
        for (let key in params){
                if( params[key] ){
                    params_lock++
                }
            }
        if( params_lock >= 3 ){ $('#btn_save').show(); } else{ $('#btn_save').hide(); } 
        console.log(params_lock);
    }
    
    $('input[name=\'title\']').bind('input, keyup', function (){
        if ( $(this).val().length > 0 ){
            params.params_01 = true;
            lockSend();
        } else{
            params.params_01 = false;
            lockSend();
        }
    });

    $('input[name=\'href\']').bind('input, keyup', function (){
        if ( $(this).val().length > 0 ){
            params.params_02 = true;
            lockSend();
        } else{
            params.params_02 = false;
            lockSend();
        }
    });
    
    $('input[name=\'cover\']').on('change', function (){
        let _file = $('input[name=\'cover\']').prop('files')[0];
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
                $('#loader_cover').show();
                $('#success_cover').hide();
                $('input[name=\'cover\']').attr('disabled', true);
            },
            success: function (response){
                $('input[name=\'cover_src\'').val(response);
                $('input[name=\'cover\']').attr('disabled', false);
                $('#loader_cover').hide();
                $('#success_cover').show();
                params.params_03 = true;
                lockSend();
                getLogs('survey', 'uploaded', 'uploaded file - '+response, 1, false);
            },
            error: function (response){
                getLogs('survey', 'uploaded', 'uploaded file - '+response, 0, response['responseText']);
                alert("Упс! Кажется произошла ошибка при загрузке данных. Пожалуйста, перезагрузите страницу или попробуйте позже!\\n\\nОтвет ошибки:\\n" + response['responseText']);
                console.log(response);
            }
        }); 
    });
    
    $('#btn_save').on('click', function (){
        $.ajax({
            url: '/frontend/web/survey/add-survey',
            type: 'post',
            dataType: 'html',
            data: { 'title': $('input[name=\'title\']').val(), 'href': $('input[name=\'href\']').val(), 'cover_src': $('input[name=\'cover_src\']').val() },
            beforeSend: function (){
                $(this).hide();
            },
            success: function (response){
                $('#loader').show();
                getLogs('survey', 'add', 'adding new survey: '+$('input[name=\'title\']').val(), 1, false);
                window.location.href = '/frontend/web/survey/update-form?s='+response+'&success=true';
            },
            error: function (response){
                getLogs('survey', 'add', 'adding new survey: '+$('input[name=\'title\']').val(), 0, response['responseText']);
                alert("Упс! Кажется произошла ошибка при загрузке данных. Пожалуйста, перезагрузите страницу или попробуйте позже!\\n\\nОтвет ошибки:\\n" + response['responseText']);
                console.log(response);
            }
        }); 
    });
JS;

$this->registerJs($script, \yii\web\View::POS_READY);