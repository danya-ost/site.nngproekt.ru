<?php

/** @var \yii\web\View $this */
/** @var \frontend\controllers\ManualController $data */

$this->title = 'Справочник сотрудников'
?>
<div class="container h-auto">
    <div class="w-full ha-auto">
        <h1 class="font-bold text-4xl uppercase">СПРАВОЧНИК СОТРУДНИКОВ</h1>
    </div>
    <div class="w-full h-auto mt-6 mb-8">
        <form action="" class="w-full h-auto">
            <div class="block sm:inline-block w-full sm:w-[150px] md:w-[214px] lg:w-[344px] relative">
                <input type="text" name="search_fullname" placeholder="Поиск по ФИО" class="border-solid border-b border-stone-300 py-1 w-full focus:outline-none focus:border-main-red text-black font-light text-sm bg-[#F8F8F8]">

                <svg class="absolute right-0 top-2/4 -translate-y-2/4" width="16" height="16" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M17.8901 17.3599L12.4133 11.883C13.5509 10.6199 14.25 8.95461 14.25 7.12498C14.25 3.1963 11.0537 0 7.12501 0C3.1963 0 0 3.1963 0 7.12501C0 11.0537 3.1963 14.25 7.12501 14.25C8.95465 14.25 10.6199 13.5509 11.883 12.4133L17.3599 17.8901C17.4331 17.9634 17.5291 18 17.625 18C17.721 18 17.8169 17.9634 17.8902 17.8901C18.0366 17.7436 18.0366 17.5063 17.8901 17.3599ZM7.12501 13.5C3.61013 13.5 0.750023 10.6403 0.750023 7.12501C0.750023 3.60977 3.61013 0.749988 7.12501 0.749988C10.6399 0.749988 13.5 3.60974 13.5 7.12501C13.5 10.6403 10.6399 13.5 7.12501 13.5Z" fill="black"/>
                </svg>
            </div>

            <div class="block sm:inline-block w-full sm:w-[150px] md:w-[214px] lg:w-[344px] relative ml-0 sm:ml-5 md:ml-12 relative">
                <input type="text" name="search_department" placeholder="Поиск по подразделению" class="border-solid border-b border-stone-300 py-1 w-full focus:outline-none focus:border-main-red text-black font-light text-sm bg-[#F8F8F8]">

                <svg class="absolute right-0 top-2/4 -translate-y-2/4" width="16" height="16" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M17.8901 17.3599L12.4133 11.883C13.5509 10.6199 14.25 8.95461 14.25 7.12498C14.25 3.1963 11.0537 0 7.12501 0C3.1963 0 0 3.1963 0 7.12501C0 11.0537 3.1963 14.25 7.12501 14.25C8.95465 14.25 10.6199 13.5509 11.883 12.4133L17.3599 17.8901C17.4331 17.9634 17.5291 18 17.625 18C17.721 18 17.8169 17.9634 17.8902 17.8901C18.0366 17.7436 18.0366 17.5063 17.8901 17.3599ZM7.12501 13.5C3.61013 13.5 0.750023 10.6403 0.750023 7.12501C0.750023 3.60977 3.61013 0.749988 7.12501 0.749988C10.6399 0.749988 13.5 3.60974 13.5 7.12501C13.5 10.6403 10.6399 13.5 7.12501 13.5Z" fill="black"/>
                </svg>

                <div id="department_container" style="display: none;" class="w-full h-auto absolute z-[999] top-full bg-white shadow-lg border-r border-b border-l border-solid border-stone-300"></div>
                <div id="department_loader" style="display: none;" class="w-full h-auto absolute z-[999] top-full bg-white shadow-lg border-r border-b border-l border-solid border-stone-300">
                    <div class="w-full h-auto flex items-center justify-center p-1">
                        <div class="spinner-border animate-spin inline-block w-5 h-5 border-2 rounded-full text-main-red" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <div class="w-full h-auto mb-10">
        <button type="button" name="btn_search" class="font-semibold text-2xl text-black inline-block my-2 mr-2 focus:text-main-red">
            А
        </button>
        <button type="button" name="btn_search" class="font-semibold text-2xl text-black inline-block my-2 mr-2 focus:text-main-red">
            Б
        </button>
        <button type="button" name="btn_search" class="font-semibold text-2xl text-black inline-block my-2 mr-2 focus:text-main-red">
            В
        </button>
        <button type="button" name="btn_search" class="font-semibold text-2xl text-black inline-block my-2 mr-2 focus:text-main-red">
            Г
        </button>
        <button type="button" name="btn_search" class="font-semibold text-2xl text-black inline-block my-2 mr-2 focus:text-main-red">
            Д
        </button>
        <button type="button" name="btn_search" class="font-semibold text-2xl text-black inline-block my-2 mr-2 focus:text-main-red">
            Е
        </button>
        <button type="button" name="btn_search" class="font-semibold text-2xl text-black inline-block my-2 mr-2 focus:text-main-red">
            Ё
        </button>
        <button type="button" name="btn_search" class="font-semibold text-2xl text-black inline-block my-2 mr-2 focus:text-main-red">
            Ж
        </button>
        <button type="button" name="btn_search" class="font-semibold text-2xl text-black inline-block my-2 mr-2 focus:text-main-red">
            З
        </button>
        <button type="button" name="btn_search" class="font-semibold text-2xl text-black inline-block my-2 mr-2 focus:text-main-red">
            И
        </button>
        <button type="button" name="btn_search" class="font-semibold text-2xl text-black inline-block my-2 mr-2 focus:text-main-red">
            Й
        </button>
        <button type="button" name="btn_search" class="font-semibold text-2xl text-black inline-block my-2 mr-2 focus:text-main-red">
            К
        </button>
        <button type="button" name="btn_search" class="font-semibold text-2xl text-black inline-block my-2 mr-2 focus:text-main-red">
            Л
        </button>
        <button type="button" name="btn_search" class="font-semibold text-2xl text-black inline-block my-2 mr-2 focus:text-main-red">
            М
        </button>
        <button type="button" name="btn_search" class="font-semibold text-2xl text-black inline-block my-2 mr-2 focus:text-main-red">
            Н
        </button>
        <button type="button" name="btn_search" class="font-semibold text-2xl text-black inline-block my-2 mr-2 focus:text-main-red">
            О
        </button>
        <button type="button" name="btn_search" class="font-semibold text-2xl text-black inline-block my-2 mr-2 focus:text-main-red">
            П
        </button>
        <button type="button" name="btn_search" class="font-semibold text-2xl text-black inline-block my-2 mr-2 focus:text-main-red">
            Р
        </button>
        <button type="button" name="btn_search" class="font-semibold text-2xl text-black inline-block my-2 mr-2 focus:text-main-red">
            С
        </button>
        <button type="button" name="btn_search" class="font-semibold text-2xl text-black inline-block my-2 mr-2 focus:text-main-red">
            Т
        </button>
        <button type="button" name="btn_search" class="font-semibold text-2xl text-black inline-block my-2 mr-2 focus:text-main-red">
            У
        </button>
        <button type="button" name="btn_search" class="font-semibold text-2xl text-black inline-block my-2 mr-2 focus:text-main-red">
            Ф
        </button>
        <button type="button" name="btn_search" class="font-semibold text-2xl text-black inline-block my-2 mr-2 focus:text-main-red">
            Х
        </button>
        <button type="button" name="btn_search" class="font-semibold text-2xl text-black inline-block my-2 mr-2 focus:text-main-red">
            Ц
        </button>
        <button type="button" name="btn_search" class="font-semibold text-2xl text-black inline-block my-2 mr-2 focus:text-main-red">
            Ч
        </button>
        <button type="button" name="btn_search" class="font-semibold text-2xl text-black inline-block my-2 mr-2 focus:text-main-red">
            Ш
        </button>
        <button type="button" name="btn_search" class="font-semibold text-2xl text-black inline-block my-2 mr-2 focus:text-main-red">
            Э
        </button>
        <button type="button" name="btn_search" class="font-semibold text-2xl text-black inline-block my-2 mr-2 focus:text-main-red">
            Ю
        </button>
        <button type="button" name="btn_search" class="font-semibold text-2xl text-black inline-block my-2 mr-2 focus:text-main-red">
            Я
        </button>
    </div>
    <div id="container_search" style="display: none;" class="w-full h-auto grid grid-cols-1 lg:grid-cols-2 gap-3 pb-24"></div>
    <div id="container" class="w-full h-auto grid grid-cols-1 lg:grid-cols-2 gap-3 pb-24">

        <?php foreach ( $data as $item ): ?>

            <div class="bg-white shadow-[0px_0px_10px_0px_#00000017] px-4 py-6">
                <div class="w-full h-auto grid grid-cols-[25%_75%] grid-rows-1">
                    <div>
                        <div class="w-[50px] md:w-[118px] h-[50px] md:h-[118px] border-2 md:border-[6px] border-solid border-[#C4C4C4] rounded-full bg-no-repeat bg-center bg-cover relative" style="background-image: url('/frontend/web/<?= $item['avatar'] ?>');">
                            <?php if ( $item['in_work'] == 1 ): ?>
                                <i class="block w-5 h-5 bg-lime-500 rounded-full absolute right-1 bottom-1"></i>
                            <?php else: ?>
                                <i class="block w-5 h-5 bg-main-red rounded-full absolute right-1 bottom-1"></i>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="flex items-center justify-start">
                        <div>
                            <h1 class="font-light text-xl text-main-red">
                                <?= $item['fullname'] ?>
                            </h1>
                            <p class="font-medium text-sm text-black mt-1">
                                <?= $item['job'] ?>
                            </p>
                            <p class="inline-block font-light text-sm text-stone-400 mt-[10px] relative after:block after:content-[''] after:absolute after:left-0 after:-bottom-px after:bg-stone-300 after:h-px after:w-full">
                                <?= $item['department'] ?>
                            </p>
<!--                            <p class="font-light text-[10px] text-stone-400Группа кадрового обеспечения и документооборота">-->
<!--                                Группа кадрового обеспечения и документооборота-->
<!--                            </p>-->
                        </div>
                    </div>
                </div>

                <div class="w-full h-auto mt-3">

                    <div class="grid grid-cols-[15%_85%] md:grid-cols-[5%_95%] grid-rows-1">
                        <div>
                            <svg width="21" height="21" viewBox="0 0 21 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M20.8149 4.17212L14.446 10.5L20.8149 16.8278C20.93 16.5872 20.9999 16.3212 20.9999 16.0371V4.96286C20.9999 4.67874 20.93 4.41276 20.8149 4.17212Z" fill="#868686"/>
                                <path d="M19.1543 3.11719H1.84567C1.56156 3.11719 1.29557 3.18704 1.05493 3.30217L9.19502 11.4012C9.91476 12.121 11.0852 12.121 11.8049 11.4012L19.945 3.30217C19.7044 3.18704 19.4384 3.11719 19.1543 3.11719Z" fill="#868686"/>
                                <path d="M0.18498 4.17212C0.0698496 4.41276 0 4.67874 0 4.96286V16.0371C0 16.3212 0.0698496 16.5872 0.18498 16.8278L6.55385 10.5L0.18498 4.17212Z" fill="#868686"/>
                                <path d="M13.5761 11.3699L12.6749 12.2712C11.4756 13.4704 9.52425 13.4704 8.32499 12.2712L7.4238 11.3699L1.05493 17.6978C1.29557 17.8129 1.56156 17.8828 1.84567 17.8828H19.1543C19.4384 17.8828 19.7044 17.8129 19.945 17.6978L13.5761 11.3699Z" fill="#868686"/>
                            </svg>
                        </div>
                        <div class="font-medium text-sm text-stone-400">
                            <?= $item['email'] ?>
                        </div>
                    </div>

                    <div class="grid grid-cols-[15%_85%] md:grid-cols-[5%_95%] grid-rows-1 mt-3">
                        <div>
                            <svg width="21" height="21" viewBox="0 0 21 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M16.6934 0H4.30664C1.93196 0 0 1.93196 0 4.30664V16.6934C0 19.068 1.93196 21 4.30664 21H16.6934C19.068 21 21 19.068 21 16.6934V4.30664C21 1.93196 19.068 0 16.6934 0ZM16.05 15.1712L15.7205 15.7204C14.4391 17.0018 11.063 15.7033 8.17983 12.8202C5.29668 9.93702 3.99816 6.56098 5.27957 5.27953L5.82877 4.95001C6.32633 4.6515 6.97171 4.81281 7.27022 5.31038L8.0478 6.6063C8.29586 7.0197 8.23069 7.54884 7.88981 7.88977C7.40927 8.37031 7.40927 9.1494 7.88981 9.62989L11.3701 13.1102C11.8506 13.5907 12.6297 13.5907 13.1102 13.1102C13.4511 12.7693 13.9803 12.7041 14.3937 12.9522L15.6896 13.7297C16.1871 14.0283 16.3485 14.6737 16.05 15.1712Z" fill="#868686"/>
                            </svg>
                        </div>
                        <div class="font-medium text-sm text-stone-400">
                            <?= $item['telephone'] ?>
                        </div>
                    </div>

                    <div class="grid grid-cols-[15%_85%] md:grid-cols-[5%_95%] grid-rows-1 mt-3">
                        <div>
                            <svg width="19" height="21" viewBox="0 0 19 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M9.49553 5.72728C10.5503 5.72728 11.4046 4.87297 11.4046 3.81817C11.4046 3.46021 11.3044 3.12137 11.1326 2.835L9.49553 0L7.85847 2.835C7.68665 3.12137 7.58643 3.46021 7.58643 3.81817C7.58643 4.87297 8.44077 5.72728 9.49553 5.72728Z" fill="#868686"/>
                                <path d="M15.223 8.59075H10.4502V6.68164H8.54112V8.59075H3.76842C2.18863 8.59075 0.904785 9.8746 0.904785 11.4544V12.9244C0.904785 13.9553 1.74477 14.7953 2.77568 14.7953C3.27682 14.7953 3.74453 14.5996 4.09774 14.2464L6.14046 12.2084L8.17843 14.2416C8.8848 14.948 10.1162 14.948 10.8225 14.2416L12.8652 12.2084L14.9032 14.2416C15.2564 14.5948 15.7241 14.7905 16.2252 14.7905C17.2562 14.7905 18.0961 13.9505 18.0961 12.9196V11.4544C18.0866 9.8746 16.8028 8.59075 15.223 8.59075Z" fill="#868686"/>
                                <path d="M13.8819 15.2581L12.8557 14.232L11.8248 15.2581C10.5791 16.5038 8.40278 16.5038 7.15709 15.2581L6.13093 14.232L5.10002 15.2581C4.48433 15.8833 3.65867 16.227 2.77568 16.227C2.08362 16.227 1.4393 16.0074 0.904785 15.6399V20.0452C0.904785 20.5702 1.33433 20.9997 1.85932 20.9997H17.132C17.657 20.9997 18.0866 20.5702 18.0866 20.0452V15.64C17.552 16.0075 16.9125 16.227 16.2157 16.227C15.3327 16.227 14.5071 15.8834 13.8819 15.2581Z" fill="#868686"/>
                            </svg>
                        </div>
                        <div class="font-medium text-sm text-stone-400">
                            <?= $item['birthday'] ?>
                        </div>
                    </div>

                </div>
            </div>

        <?php endforeach; ?>

    </div>

    <div id="loader" style="display: none;" class="w-full h-auto flex items-center justify-center py-24">
        <div class="spinner-border animate-spin inline-block w-10 h-10 border-4 rounded-full text-main-red" role="status">
            <span class="visually-hidden">Loading...</span>
        </div>
    </div>

</div>
<?php
$script = <<<JS
    $('#page_manual').removeClass('text-stone-400').addClass('text-main-red').addClass('font-bold');

    let e = {
        container: $('#container'),
        loader: $('#loader')
    }
    
    let setAjax = $.ajax();
    $('button[name=\'btn_search\']').on('click', function (){
        let alpha = $(this).text().trim();
        setAjax = $.ajax({
            url: '/frontend/web/manual/view-workers',
            type: 'post',
            dataType: 'html',
            data: { 'alpha': alpha },
            beforeSend: function (){
                e.loader.show();
                e.container.hide();
            },
            success: function (response){
                e.container.html(response).show();
                e.loader.hide();
                getLogs('manual', 'load-manual', 'loaded manual to '+alpha, 1, false);
            },
            error: function (response){
                getLogs('manual', 'load-manual', 'loaded manual to '+alpha, 0, response['responseText']);
                alert("Упс! Кажется произошла ошибка при загрузке данных. Пожалуйста, перезагрузите страницу или попробуйте позже!\\n\\nОтвет ошибки:\\n" + response['responseText']);
                console.log(response);
            }
        });
    });
    
    let ajax_department = $.ajax();
    $('input[name=\'search_department\']').bind('input, keyup', function (){
        let value = $(this).val();

        if ( value.length > 3 ){
            ajax_department = $.ajax({
                url: '/frontend/web/manual/view-departments',
                type: 'post',
                dataType: 'html',
                data: { 'value': value },
                beforeSend: function (){
                    $('#department_loader').show();
                    $('#department_container').hide();
                },
                success: function (response){
                    $('#department_container').html(response).show();
                    $('#department_loader').hide();
                    getLogs('manual', 'searching', 'search department on the value: '+value, 1, false);
                },
                error: function (response){
                    getLogs('manual', 'searching', 'search department on the value: '+value, 0, response['responseText']);
                    alert("Упс! Кажется произошла ошибка при загрузке данных. Пожалуйста, перезагрузите страницу или попробуйте позже!\\n\\nОтвет ошибки:\\n" + response['responseText']);
                    console.log(response);
                }
            });
        } else{
            $('#department_loader').hide();
            $('#department_container').hide();
        }
    });
    
    let selected_department = 0;
    
    let ajax_search = $.ajax();
    
    $('#department_container').on('click', 'button[name^=\'selected_department_id_\']', function (){
        selected_department = $(this).attr('name').replace('selected_department_id_', '');
        $('input[name=\'search_department\']').val($(this).text().trim());
        ajax_search = $.ajax({
            url: '/frontend/web/manual/search-in-department',
            type: 'post',
            dataType: 'html',
            data: { 'department_id': selected_department },
            beforeSend: function (){
                e.loader.show();
                e.container.hide();
            },
            success: function (response){
                e.container.html(response).show();
                e.loader.hide();
                $('#department_loader').hide();
                $('#department_container').hide();
                getLogs('manual', 'searching', 'search data for department_id: '+selected_department, 1, false);
            },
            error: function (response){
                getLogs('manual', 'searching', 'search data for department_id: '+selected_department, 0, response['responseText']);
                alert("Упс! Кажется произошла ошибка при загрузке данных. Пожалуйста, перезагрузите страницу или попробуйте позже!\\n\\nОтвет ошибки:\\n" + response['responseText']);
                console.log(response);
            }
        });
    });
    
    let ajax_fullname = $.ajax();
    $('input[name=\'search_fullname\']').bind('input, keyup', function (){
        let value = $(this).val();
        if ( value.length > 3 ){
            ajax_fullname = $.ajax({
                url: '/frontend/web/manual/search-fullname',
                type: 'post',
                dataType: 'html',
                data: { 'value': value },
                beforeSend: function (){
                    e.loader.show();
                    e.container.hide();
                },
                success: function (response){
                    e.loader.hide();
                    e.container.html(response).show();
                    getLogs('manual', 'searching', 'search data on the value: '+value, 1, false);
                },
                error: function (response){
                    getLogs('manual', 'searching', 'search data on the value: '+value, 0, response['responseText']);
                    alert("Упс! Кажется произошла ошибка при загрузке данных. Пожалуйста, перезагрузите страницу или попробуйте позже!\\n\\nОтвет ошибки:\\n" + response['responseText']);
                    console.log(response);
                }
            });
        } else{
            
        }
    });
    
JS;

$this->registerJs($script, \yii\web\View::POS_READY);