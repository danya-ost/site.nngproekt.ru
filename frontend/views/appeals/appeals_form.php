<?php

/** @var \yii\web\View $this */
/** @var \frontend\controllers\AppealsController $management */

$this->title = 'Подача обращения';
?>
<div class="container">
    <div class="max-w-[865px]">
        <h1 class="font-semibold text-2xl mb-8">
            Подача обращения
        </h1>
        <div id="form" class="block">
            <div class="mb-8">
                <label for="theme" class="text-xs font-light text-black">
                    Тема обращения
                </label>
                <input type="text"
                       id="theme"
                       name="theme"
                       required
                       placeholder="Сотрудничество с образовательными учреждениями."
                       class="block w-full h-auto text-sm font-medium py-2 border-b border-solid border-b-stone-300 focus:border-b-main-red bg-[#F8F8F8] focus:outline-none">
            </div>

            <div class="mb-8">
                <label for="management_id" class="text-xs font-light text-black">
                    Кому
                </label>
                <select name="management_id" id="management_id" class="block w-full h-auto text-sm font-medium py-2 border-b border-solid border-b-stone-300 focus:border-b-main-red bg-[#F8F8F8] focus:outline-none">
                    <?php foreach ( $management as $item ): ?>
                        <option value="<?= $item['id'] ?>">
                            <?= $item['fullname'] ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="mb-8">
                <label for="msg" class="text-xs font-light text-black">
                    Текст обращения
                </label>
                <textarea name="msg" id="msg" rows="5" required placeholder="Введите содержание обращения" class="block w-full h-auto text-sm font-medium p-5 border border-solid border-stone-300 focus:border-main-red bg-[#F8F8F8] focus:outline-none cust-scroll"></textarea>
            </div>

            <div id="container_file" class="grid grid-cols-1 sm:grid-cols-2 gap-8 mb-8"></div>

            <div class="mb-3">
                <label for="management_id" class="text-xs font-light text-black">
                    Прикрепить файл (Допустимые форматы: .pdf, .docx, .xlsx, .pptx)
                </label>
                <input class="form-control block w-full px-3 py-1.5 mb-7 text-xs sm:text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-main-red focus:bg-white focus:border-main-red focus:outline-none"
                       type="file"
                       name="add_file"
                       accept=".pdf, .docx, .xlsx, .pptx">
                <div id="add_loader_file" class="w-full h-auto flex items-center justify-center py-2" style="display: none;">
                    <div class="spinner-border animate-spin inline-block w-5 h-5 border-2 rounded-full text-main-red mb-7" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                </div>
            </div>

            <button id="btn_send" style="display: none;" class="bg-black w-full md:w-auto px-9 py-3 rounded-xl text-white uppercase cursor-pointer duration-300 ease-in-out mt-6 mb-5 md:mb-10">
                ОТПРАВИТЬ
            </button>
        </div>

        <div id="loader" style="display: none;" class="w-full h-auto flex items-center justify-center py-24">
            <div class="spinner-border animate-spin inline-block w-10 h-10 border-4 rounded-full text-main-red" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
        </div>

        <div id="success" style="display: none;" class="bg-white shadow-[0px_0px_10px_0px_#00000017] h-[110px] grid grid-cols-[25%_75%] grid-rows-1 text-black duration-300 ease-in-out">
            <div class="relative">
                <div class="w-[45px] h-[45px] text-green-500 flex items-center justify-center rounded-full absolute top-2/4 -translate-y-2/4 left-2/4 -translate-x-2/4">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-14 h-14">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />
                    </svg>
                </div>
            </div>
            <div class="flex items-center justify-start">
                <span>
                    <div class="text-xs text-green-500 font-bold">Успешно</div>
                    <div class="font-medium text-sm md:text-md uppercase">Обращение успешно подано! Ожидайте ответа от руководства.</div>
                    <div class="text-xs text-stone-300 font-bold">
                        Перенаправление через: <span id="sec">3</span> сек...
                    </div>
                </span>
            </div>
        </div>

    </div>
</div>
<?php
$script = <<<JS
    $('#profile_bar').css({ visibility: 'visible' }).animate({
        opacity: 1
    }, 300);

    let location = 'appeals';
    $('#a_'+location).attr('class', 'block text-left w-full py-3 px-3 pl-10 rounded-r-xl font-bold text-main-red text-xl bg-[#F8F8F8] border-t border-r border-b border-solid border-stone-300 relative after:absolute after:content-[\'\'] after:bg-[#F8F8F8] after:w-4 after:-top-px after:-bottom-px after:-left-px after:border-t after:border-b after:border-solid after:border-stone-300');
    
    let add = {
        container_file: $('#container_file'),
        loader_file: $('#add_loader_file'),
        form: $('#form'),
        loader: $('#loader'),
        success: $('#success'),
        required_title: false,
        required_msg: false,
        btn_send: $('#btn_send')
    }
    
    function getRequired(){ if ( add.required_title == true && add.required_msg == true ){ add.btn_send.show(); } else{ add.btn_send.hide(); } }
    
    $('input[name=\'theme\']').on('input, keyup', function (){
        let length = $(this).val().length;
        if ( length > 0 ){ add.required_title = true; } else{ add.required_title = false; }
        getRequired();
    });
    
    $('textarea[name=\'msg\']').on('input, keyup', function (){
        let length = $(this).val().length;
        if ( length > 0 ){ add.required_msg = true; } else{ add.required_msg = false; }
        getRequired();
    });
    
    $('input[name=\'add_file\']').on('change', function (){
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
                    url: '/frontend/web/appeals/add-file-form',
                    type: 'post',
                    dataType: 'html',
                    data: { 'src': src },
                    success: function (response){
                        add.container_file.append(response).show();
                        $('input[name=\'add_file\'').val('').show();
                        add.loader_file.hide();
                        getLogs('appeals', 'view-file-form', 'returned data file - '+src, 1, false);
                    },
                    error: function (response){
                        getLogs('appeals', 'view-file-form', 'returned data file - '+src, 0, response['responseText']);
                        alert("Упс! Кажется произошла ошибка при загрузке данных. Пожалуйста, перезагрузите страницу или попробуйте позже!\\n\\nОтвет ошибки:\\n" + response['responseText']);
                        console.log(response);
                    }
                });
                getLogs('appeals', 'uploaded', 'uploaded file - '+response, 1, false);
            },
            error: function (response){
                getLogs('appeals', 'uploaded', 'uploaded file - '+response, 0, response['responseText']);
                alert("Упс! Кажется произошла ошибка при загрузке данных. Пожалуйста, перезагрузите страницу или попробуйте позже!\\n\\nОтвет ошибки:\\n" + response['responseText']);
                console.log(response);
            }
        }); 
    });
    
    add.container_file.on('click', 'button[name^=\'remove_file_\']', function (){
        $(this).parent().remove();
    });
    
    add.btn_send.on('click', function (){
        let title = $('input[name=\'theme\']').val();
        let msg = $('textarea[name=\'msg\']').val();
        let user_id = $('select[name=\'management_id\']').val();
        let files = [];
        $('#container_file div[name^=\'add_file_\']').each(function (){
            files.push($(this).attr('data-src'));
        });
        let files_isset = $('#container_file div[name^=\'add_file_\']').length;
        $.ajax({
            url: '/frontend/web/appeals/add-appeals',
            type: 'post',
            dataType: 'html',
            data: { 'title': title, 'user_id': user_id, 'msg':msg, 'files': files_isset > 0 ? files : 0 },
            beforeSend: function (){
                add.form.hide();
                add.loader.show();
            },
            success: function (){
                add.loader.hide();
                add.success.show();
                $('html, body').animate({ scrollTop: 0 }, 500);
                let sec = 3;
                setInterval(function (){
                    sec = sec - 1;
                    $('#sec').text(sec);
                }, 1000);
                setTimeout(function (){
                    window.location.href = '/frontend/web/appeals/index';
                }, 3000);
                getLogs('appeals', 'add-appeals', 'adding appeals - '+title, 1, false);
            },
            error: function (response){
                getLogs('appeals', 'add-appeals', 'adding appeals - '+title, 0, response['responseText']);
                alert("Упс! Кажется произошла ошибка при загрузке данных. Пожалуйста, перезагрузите страницу или попробуйте позже!\\n\\nОтвет ошибки:\\n" + response['responseText']);
                console.log(response);
            }
        });
    });
    
JS;

$this->registerJs($script, \yii\web\View::POS_READY);
