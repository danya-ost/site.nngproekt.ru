<?php

/** @var \yii\web\View $this */
/** @var \frontend\controllers\SurveyController $data */

$id = $_GET['s'];

$this->title = 'Редактирование опроса';
?>
<div class="container h-auto pb-24">
    <div class="w-full ha-auto mb-12">
        <a href="<?= \yii\helpers\Url::to(['/survey/index']) ?>" class="inline-block align-middle px-2.5 py-2 mr-2 border-2 border-gray-800 text-gray-800 font-medium text-xs leading-tight uppercase rounded hover:bg-black hover:bg-opacity-5 focus:outline-none focus:ring-0 transition duration-150 ease-in-out">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 inline-block align-middle">
                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 12h-15m0 0l6.75 6.75M4.5 12l6.75-6.75" />
            </svg>
        </a>

        <h1 class="inline-block align-middle font-semibold text-2xl">
            Редактирование опроса
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
                   value="<?= $data['title'] ?>"
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
                   value="<?= $data['href'] ?>"
                   placeholder="Введите ссылку на опрос..."
                   class="block w-full py-2 font-medium text-sm border-b border-solid border-b-stone-300 bg-[#F8F8F8] focus:border-b-main-red focus:outline-none">
        </div>

        <div>
            <label for="response_href" class="font-light text-xs text-stone-500">
                Ссылка на результат
            </label>
            <input type="text"
                   id="response_href"
                   name="response_href"
                   value="<?= $data['response_href'] ?>"
                   placeholder="Введите сылку на результат опроса..."
                   class="block w-full py-2 font-medium text-sm border-b border-solid border-b-stone-300 bg-[#F8F8F8] focus:border-b-main-red focus:outline-none">
        </div>

        <div class="relative">
            <label for="href" class="font-light text-xs text-stone-500">
                Прикрепите обложку
            </label>
            <input type="hidden" name="cover_src" value="<?= $data['cover_src'] ?>">
            <input class="form-control block w-full px-3 py-1.5 text-xs sm:text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-main-red focus:bg-white focus:border-main-red focus:outline-none"
                   type="file"
                   name="cover"
                   accept=".jpeg, .png, .jpg, .webmp">
            <div id="loader_cover" style="display: none;" class="flex items-center justify-content absolute top-[37%] right-2 z-[999]">
                <div class="spinner-border animate-spin inline-block w-5 h-5 border-4 rounded-full text-main-red mb-24" role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>
            </div>
            <div id="success_cover" class="flex items-center justify-content absolute top-[37%] right-2 z-[999]">
                <div class="inline-block w-5 h-5 text-green-500 mb-24" role="status">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12c0 1.268-.63 2.39-1.593 3.068a3.745 3.745 0 01-1.043 3.296 3.745 3.745 0 01-3.296 1.043A3.745 3.745 0 0112 21c-1.268 0-2.39-.63-3.068-1.593a3.746 3.746 0 01-3.296-1.043 3.745 3.745 0 01-1.043-3.296A3.745 3.745 0 013 12c0-1.268.63-2.39 1.593-3.068a3.745 3.745 0 011.043-3.296 3.746 3.746 0 013.296-1.043A3.746 3.746 0 0112 3c1.268 0 2.39.63 3.068 1.593a3.746 3.746 0 013.296 1.043 3.746 3.746 0 011.043 3.296A3.745 3.745 0 0121 12z" />
                    </svg>
                </div>
            </div>
            <div class="overflow-hidden">
                <a href="<?= '/frontend/web/' . $data['cover_src'] ?>" target="_blank" class="text-blue-500 font-bold text-xs whitespace-nowrap"><?= $_SERVER['HTTP_HOST'] . '/frontend/web/' . $data['cover_src'] ?></a>
            </div>
        </div>

    </div>

    <div class="mt-10 flex items-center justify-end">
        <button type="button" id="btn_save" class="inline-block align-middle rounded px-6 py-2.5 bg-gray-800 text-white font-medium text-xs leading-tight uppercase shadow-md hover:bg-gray-900 hover:shadow-lg focus:bg-gray-900 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-gray-900 active:shadow-lg transition duration-150 ease-in-out">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 inline-block align-middle">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 9.75v6.75m0 0l-3-3m3 3l3-3m-8.25 6a4.5 4.5 0 01-1.41-8.775 5.25 5.25 0 0110.233-2.33 3 3 0 013.758 3.848A3.752 3.752 0 0118 19.5H6.75z" />
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
            url: '/frontend/web/survey/update-survey',
            type: 'post',
            dataType: 'html',
            data: { 'id': '$id', 'title': $('input[name=\'title\']').val(), 'href': $('input[name=\'href\']').val(), 'response_href': $('input[name=\'response_href\']').val().trim(), 'cover_src': $('input[name=\'cover_src\']').val() },
            beforeSend: function (){
                $(this).hide();
            },
            success: function (){
                $('#loader').show();
                getLogs('survey', 'add', 'adding new survey: '+$('input[name=\'title\']').val(), 1, false);
                window.location.href = '/frontend/web/survey/index';
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