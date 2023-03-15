<?php

/** @var \frontend\controllers\AppealsController $data */
/** @var \yii\web\View $this */

$this->title = 'Ответ на обращение - ' . $data['title'];
?>
<div class="container">
    <div class="max-w-[865px]">
        <h1 class="font-semibold text-2xl mb-8">
            Ответ на обращение
            <?php if ( $data['status_id'] == 1 ): ?>
                <span class="inline-block py-1.5 px-2.5 leading-none text-center whitespace-nowrap align-baseline font-bold bg-green-500 text-white rounded">
                    Ответ отправлен
                </span>
            <?php endif; ?>
            <?php if ( $data['status_id'] == 3 ): ?>
                <span class="inline-block py-1.5 px-2.5 leading-none text-center whitespace-nowrap align-baseline font-bold bg-stone-500 text-white rounded">
                    Закрыто
                </span>
            <?php endif; ?>
        </h1>
        <h1 class="font-light text-xl mb-2">
            <?= $data['title'] ?>
        </h1>
        <pre class="font-medium text-sm font-montserrat whitespace-pre-wrap">
<?= $data['msg'] ?>
        </pre>
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-8 mt-5 mb-8">
            <?php foreach ( $data['files'] as $file ): ?>
                <div class="text-black relative">
                    <div class="inline-block align-middle mr-2 w-[45px] h-[45px] bg-[#E5E5E5] rounded-full relative">
                        <svg class="absolute top-2/4 -translate-y-2/4 left-2/4 -translate-x-2/4" width="12" height="22" viewBox="0 0 12 22" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                            <path d="M5.9999 0.312988C4.55036 0.314605 3.16066 0.891148 2.13568 1.91613C1.1107 2.94111 0.53416 4.33081 0.532542 5.78035V17.7908C0.528296 18.3052 0.625927 18.8152 0.819805 19.2916C1.01368 19.768 1.29997 20.2013 1.66215 20.5665C2.02433 20.9316 2.45523 21.2215 2.93 21.4193C3.40477 21.6171 3.914 21.7189 4.42833 21.7189C4.94266 21.7189 5.45189 21.6171 5.92666 21.4193C6.40143 21.2215 6.83233 20.9316 7.19451 20.5665C7.55669 20.2013 7.84298 19.768 8.03685 19.2916C8.23073 18.8152 8.32836 18.3052 8.32412 17.7908V6.28504C8.32412 5.66861 8.07924 5.07744 7.64337 4.64156C7.20749 4.20569 6.61632 3.96082 5.9999 3.96082C5.38348 3.96082 4.7923 4.20569 4.35643 4.64156C3.92055 5.07744 3.67568 5.66861 3.67568 6.28504V17.2421C3.67568 17.3654 3.72466 17.4836 3.81183 17.5708C3.89901 17.6579 4.01724 17.7069 4.14052 17.7069C4.26381 17.7069 4.38204 17.6579 4.46922 17.5708C4.55639 17.4836 4.60537 17.3654 4.60537 17.2421V6.28504C4.60537 5.91518 4.75229 5.56048 5.01382 5.29895C5.27534 5.03743 5.63005 4.8905 5.9999 4.8905C6.36975 4.8905 6.72445 5.03743 6.98598 5.29895C7.24751 5.56048 7.39443 5.91518 7.39443 6.28504V17.7908C7.39814 18.1827 7.32416 18.5714 7.17676 18.9346C7.02936 19.2977 6.81147 19.628 6.53567 19.9064C6.25988 20.1848 5.93164 20.4058 5.56994 20.5567C5.20823 20.7075 4.82022 20.7852 4.42833 20.7852C4.03644 20.7852 3.64843 20.7075 3.28672 20.5567C2.92501 20.4058 2.59678 20.1848 2.32099 19.9064C2.04519 19.628 1.8273 19.2977 1.6799 18.9346C1.5325 18.5714 1.45852 18.1827 1.46223 17.7908V5.78035C1.46223 4.57688 1.9403 3.42271 2.79128 2.57173C3.64226 1.72075 4.79643 1.24268 5.9999 1.24268C7.20336 1.24268 8.35754 1.72075 9.20852 2.57173C10.0595 3.42271 10.5376 4.57688 10.5376 5.78035V10.9999C10.5376 11.1232 10.5865 11.2414 10.6737 11.3286C10.7609 11.4157 10.8791 11.4647 11.0024 11.4647C11.1257 11.4647 11.2439 11.4157 11.3311 11.3286C11.4183 11.2414 11.4673 11.1232 11.4673 10.9999V5.78035C11.4656 4.33081 10.8891 2.94111 9.86412 1.91613C8.83914 0.891148 7.44943 0.314605 5.9999 0.312988Z"/>
                        </svg>
                    </div>
                    <div class="inline-block align-middle">
                        <a href="/frontend/web/<?= $file['src'] ?>" target="_blank" class="text-sm font-medium text-main-red hover:underline">
                            <?= $file['name'] ?>
                        </a>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
        <div id="form" data-id="<?= $data['id'] ?>" class="block">
            <div class="mb-8">
                <label for="response" class="text-xs font-light text-black">
                    Ответ на обращение
                </label>
                <?php if ( $data['status_id'] == 2 ): ?>
                    <textarea name="response" id="response" placeholder="Введите ответ" rows="5" class="block w-full h-auto text-sm font-medium p-5 border border-solid border-stone-300 focus:border-main-red bg-[#F8F8F8] focus:outline-none cust-scroll"></textarea>
                <?php endif; ?>
                <?php if ( $data['status_id'] != 2 ): ?>
                    <div class="block w-full h-auto text-sm font-medium p-5 border border-solid border-stone-300 focus:border-main-red bg-[#F8F8F8] focus:outline-none cust-scroll">
                        <?= $data['response'] ?>
                    </div>
                <?php endif; ?>
            </div>
            <?php if ( $data['status_id'] != 2 ): ?>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-8 mb-8">
                    <?php foreach ( $data['files_response'] as $file ): ?>
                        <div class="text-black relative">
                            <div class="inline-block align-middle mr-2 w-[45px] h-[45px] bg-[#E5E5E5] rounded-full relative">
                                <svg class="absolute top-2/4 -translate-y-2/4 left-2/4 -translate-x-2/4" width="12" height="22" viewBox="0 0 12 22" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M5.9999 0.312988C4.55036 0.314605 3.16066 0.891148 2.13568 1.91613C1.1107 2.94111 0.53416 4.33081 0.532542 5.78035V17.7908C0.528296 18.3052 0.625927 18.8152 0.819805 19.2916C1.01368 19.768 1.29997 20.2013 1.66215 20.5665C2.02433 20.9316 2.45523 21.2215 2.93 21.4193C3.40477 21.6171 3.914 21.7189 4.42833 21.7189C4.94266 21.7189 5.45189 21.6171 5.92666 21.4193C6.40143 21.2215 6.83233 20.9316 7.19451 20.5665C7.55669 20.2013 7.84298 19.768 8.03685 19.2916C8.23073 18.8152 8.32836 18.3052 8.32412 17.7908V6.28504C8.32412 5.66861 8.07924 5.07744 7.64337 4.64156C7.20749 4.20569 6.61632 3.96082 5.9999 3.96082C5.38348 3.96082 4.7923 4.20569 4.35643 4.64156C3.92055 5.07744 3.67568 5.66861 3.67568 6.28504V17.2421C3.67568 17.3654 3.72466 17.4836 3.81183 17.5708C3.89901 17.6579 4.01724 17.7069 4.14052 17.7069C4.26381 17.7069 4.38204 17.6579 4.46922 17.5708C4.55639 17.4836 4.60537 17.3654 4.60537 17.2421V6.28504C4.60537 5.91518 4.75229 5.56048 5.01382 5.29895C5.27534 5.03743 5.63005 4.8905 5.9999 4.8905C6.36975 4.8905 6.72445 5.03743 6.98598 5.29895C7.24751 5.56048 7.39443 5.91518 7.39443 6.28504V17.7908C7.39814 18.1827 7.32416 18.5714 7.17676 18.9346C7.02936 19.2977 6.81147 19.628 6.53567 19.9064C6.25988 20.1848 5.93164 20.4058 5.56994 20.5567C5.20823 20.7075 4.82022 20.7852 4.42833 20.7852C4.03644 20.7852 3.64843 20.7075 3.28672 20.5567C2.92501 20.4058 2.59678 20.1848 2.32099 19.9064C2.04519 19.628 1.8273 19.2977 1.6799 18.9346C1.5325 18.5714 1.45852 18.1827 1.46223 17.7908V5.78035C1.46223 4.57688 1.9403 3.42271 2.79128 2.57173C3.64226 1.72075 4.79643 1.24268 5.9999 1.24268C7.20336 1.24268 8.35754 1.72075 9.20852 2.57173C10.0595 3.42271 10.5376 4.57688 10.5376 5.78035V10.9999C10.5376 11.1232 10.5865 11.2414 10.6737 11.3286C10.7609 11.4157 10.8791 11.4647 11.0024 11.4647C11.1257 11.4647 11.2439 11.4157 11.3311 11.3286C11.4183 11.2414 11.4673 11.1232 11.4673 10.9999V5.78035C11.4656 4.33081 10.8891 2.94111 9.86412 1.91613C8.83914 0.891148 7.44943 0.314605 5.9999 0.312988Z"/>
                                </svg>
                            </div>
                            <div class="inline-block align-middle">
                                <a href="/frontend/web/<?= $file['src'] ?>" target="_blank" class="text-sm font-medium text-main-red hover:underline">
                                    <?= $file['name'] ?>
                                </a>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
            <?php if ( $data['status_id'] == 2 ): ?>
                <div id="file" class="grid grid-cols-1 sm:grid-cols-2 gap-8 mb-8"></div>
                <div class="mb-3">
                    <input class="form-control block w-full px-3 py-1.5 text-xs sm:text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-main-red focus:bg-white focus:border-main-red focus:outline-none"
                           type="file"
                           name="add_file"
                           id="formFile">
                    <div id="add_loader_file" class="w-full h-auto flex items-center justify-center py-2" style="display: none;">
                        <div class="spinner-border animate-spin inline-block w-5 h-5 border-2 rounded-full text-main-red mb-7" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                    </div>
                </div>
                <button id="btn_send" style="display: none;" class="bg-black w-full md:w-auto px-9 py-3 rounded-xl text-white uppercase cursor-pointer duration-300 ease-in-out mt-6 mb-5 md:mb-10">
                    ОТПРАВИТЬ
                </button>
            <?php endif; ?>

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
                    <div class="font-medium text-sm md:text-md uppercase">Ответ успешно оправлен пользователю!</div>
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
    

    let res = {
        form: $('#form'),
        loader: $('#loader'),
        success: $('#success'),
        container_file: $('#file'),
        loader_file: $('#add_loader_file'),
        btn_send: $('#btn_send')
    }
    
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
                res.loader_file.show();
            },
            success: function (response){
                let src = response;
                $.ajax({
                    url: '/frontend/web/appeals/add-file-form',
                    type: 'post',
                    dataType: 'html',
                    data: { 'src': src },
                    success: function (response){
                        res.container_file.append(response).show();
                        $('input[name=\'add_file\'').val('').show();
                        res.loader_file.hide();
                        getLogs('appeals', 'view-file-form', 'returned data file to response view - '+src, 1, false);
                    },
                    error: function (response){
                        getLogs('appeals', 'view-file-form', 'returned data file to response view - '+src, 0, response['responseText']);
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
    
    res.container_file.on('click', 'button[name^=\'remove_file_\']', function (){
        $(this).parent().remove();
    });
    
    $('textarea[name=\'response\']').on('input, keyup', function (){
        if ( $(this).val().length > 0 ){ res.btn_send.show(); } else{ res.btn_send.hide(); }
    });
    
    res.btn_send.on('click', function (){
        let response = $('textarea[name=\'response\']').val();
        let id = $('#form').attr('data-id');
        let files = [];
        $('#file div[name^=\'add_file_\']').each(function (){
            files.push($(this).attr('data-src'));
        });
        let files_isset = $('#file div[name^=\'add_file_\']').length;
        $.ajax({
            url: '/frontend/web/appeals/response-appeals',
            type: 'post',
            dataType: 'html',
            data: { 'id': id, 'response': response, 'files': files_isset > 0 ? files : 0 },
            beforeSend: function (){
                res.form.hide();
                res.loader.show();
            },
            success: function (){
                res.loader.hide();
                res.success.show();
                $('html, body').animate({ scrollTop: 0 }, 500);
                let sec = 3;
                setInterval(function (){
                    sec = sec - 1;
                    $('#sec').text(sec);
                }, 1000);
                setTimeout(function (){
                    window.location.href = '/frontend/web/appeals/index';
                }, 3000);
                getLogs('appeals', 'response-appeals', 'responsing appeals - '+id, 1, false);
            },
            error: function (response){
                getLogs('appeals', 'response-appeals', 'responsing appeals - '+id, 0, response['responseText']);
                alert("Упс! Кажется произошла ошибка при загрузке данных. Пожалуйста, перезагрузите страницу или попробуйте позже!\\n\\nОтвет ошибки:\\n" + response['responseText']);
                console.log(response);
            }
        });
    });
    
    
JS;

$this->registerJs($script, \yii\web\View::POS_READY);