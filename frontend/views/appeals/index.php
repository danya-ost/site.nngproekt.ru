<?php

/** @var \yii\web\View $this */
/** @var \frontend\controllers\AppealsController $permission */

use yii\helpers\Url;

$this->title = 'Обращения к руководству';
?>
<div class="container">
    <div class="max-w-[865px]">
        <h1 class="font-semibold text-2xl">
            Обращения к руководству
        </h1>
        <a href="<?= Url::to(['/appeals/add-form-appeals']) ?>" class="inline-block bg-black w-full md:w-auto px-9 py-3 rounded-lg text-white uppercase cursor-pointer duration-300 ease-in-out mt-6 mb-5 md:mb-10">
            ЗАДАТЬ ВОПРОС
        </a>
        <div>
            <?php if ( $permission ): ?>
                <button type="button" name="tab_my" class="block md:inline-block align-middle w-full md:w-auto mb-5 md:mb-0 mr-4 px-5 h-[50px] bg-main-red shadow-[0px_0px_4px_0px_#00000040] rounded-xl md:rounded-lg text-white font-light text-xs">
                    МОИ ОБРАЩЕНИЯ
                </button>
                <button type="button" name="tab_me" class="block md:inline-block align-middle w-full md:w-auto mb-5 md:mb-0 mr-4 px-5 h-[50px] bg-white shadow-[0px_0px_4px_0px_#00000040] rounded-xl md:rounded-lg text-black font-light text-xs">
                    ОБРАЩЕНИЯ КО МНЕ
                </button>
            <?php endif; ?>

            <div class="block md:inline-block align-bottom w-full sm:w-[150px] md:w-[214px] lg:w-[344px] relative">
                <input type="text" name="search" placeholder="Автоматическая нумерация разделов" class="border-solid border-b border-stone-300 py-1 w-full focus:outline-none focus:border-main-red text-black font-light text-sm bg-[#F8F8F8]">

                <svg class="absolute right-0 top-2/4 -translate-y-2/4" width="16" height="16" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M17.8901 17.3599L12.4133 11.883C13.5509 10.6199 14.25 8.95461 14.25 7.12498C14.25 3.1963 11.0537 0 7.12501 0C3.1963 0 0 3.1963 0 7.12501C0 11.0537 3.1963 14.25 7.12501 14.25C8.95465 14.25 10.6199 13.5509 11.883 12.4133L17.3599 17.8901C17.4331 17.9634 17.5291 18 17.625 18C17.721 18 17.8169 17.9634 17.8902 17.8901C18.0366 17.7436 18.0366 17.5063 17.8901 17.3599ZM7.12501 13.5C3.61013 13.5 0.750023 10.6403 0.750023 7.12501C0.750023 3.60977 3.61013 0.749988 7.12501 0.749988C10.6399 0.749988 13.5 3.60974 13.5 7.12501C13.5 10.6403 10.6399 13.5 7.12501 13.5Z" fill="black"/>
                </svg>
            </div>
        </div>

        <div>
            <div id="my_appeals" style="display: none;" class="grid grid-cols-1 md:grid-cols-2 gap-x-11 gap-y-6 py-7"></div>
            <div id="my_loader" style="display: none;" class="w-full h-auto flex items-center justify-center p-24">
                <div class="spinner-border animate-spin inline-block w-10 h-10 border-4 rounded-full text-main-red" role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>
            </div>
        </div>

        <div>
            <div id="me_appeals" style="display: none;" class="grid grid-cols-1 md:grid-cols-2 gap-x-11 gap-y-6 py-7"></div>
            <div id="me_loader" style="display: none;" class="w-full h-auto flex items-center justify-center p-24">
                <div class="spinner-border animate-spin inline-block w-10 h-10 border-4 rounded-full text-main-red" role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>
            </div>
        </div>

        <div>
            <div id="search_appeals" style="display: none;" class="grid grid-cols-1 md:grid-cols-2 gap-x-11 gap-y-6 py-7"></div>
            <div id="search_loader" style="display: none;" class="w-full h-auto flex items-center justify-center p-24">
                <div class="spinner-border animate-spin inline-block w-10 h-10 border-4 rounded-full text-main-red" role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>
            </div>
        </div>

        <div id="templateModal" class="fixed top-0 right-0 bottom-0 left-0 z-[999]" style="visibility: hidden; opacity: 0;">
            <div class="max-w-[515px] relative top-2/4 -translate-y-2/4 left-2/4 -translate-x-2/4 bg-white shadow-[0px_0px_20px_0px_#00000040] rounded-xl px-11 py-12">
                <button id="closeModal" type="button" class="absolute top-4 right-4 text-black hover:text-main-red">
                    <svg width="19" height="19" viewBox="0 0 19 19" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                        <path d="M9.99541 9.00092L17.7958 1.20046C18.0705 0.925833 18.0705 0.480571 17.7958 0.205974C17.5212 -0.0686229 17.0759 -0.068658 16.8013 0.205974L9.00088 8.00643L1.20047 0.205974C0.925833 -0.068658 0.480571 -0.068658 0.205974 0.205974C-0.0686229 0.480606 -0.068658 0.925868 0.205974 1.20046L8.00639 9.00088L0.205974 16.8013C-0.068658 17.076 -0.068658 17.5212 0.205974 17.7958C0.343273 17.9331 0.523255 18.0018 0.703237 18.0018C0.883219 18.0018 1.06317 17.9331 1.2005 17.7958L9.00088 9.99541L16.8013 17.7958C16.9386 17.9331 17.1186 18.0018 17.2986 18.0018C17.4785 18.0018 17.6585 17.9331 17.7958 17.7958C18.0705 17.5212 18.0705 17.0759 17.7958 16.8013L9.99541 9.00092Z"/>
                    </svg>
                </button>
                <div id="container_view" style="display: none;"></div>
                <div id="loader_view" style="display: none;" class="w-full h-auto flex items-center justify-center p-24">
                    <div class="spinner-border animate-spin inline-block w-10 h-10 border-4 rounded-full text-main-red" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                </div>
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
    
    let current_tab = 'my';
    
    let my = {
        tab: $('#my_appeals'),
        loader: $('#my_loader'),
        container_view: $('#container_view'),
        loader_view: $('#loader_view')
    }
    
    let me = {
        tab: $('#me_appeals'),
        loader: $('#me_loader'),
    }
    
    let search = {
        tab: $('#search_appeals'),
        loader: $('#search_loader'),
    }
    
    $('button[name^=\'tab_\']').on('click', function (){
        if ( current_tab == 'my' ){
            my.tab.hide();
            me.tab.show();
            current_tab = 'me';
            $('button[name=\'tab_me\']').addClass('bg-main-red').removeClass('bg-white').addClass('text-white').removeClass('text-black');
            $('button[name=\'tab_my\']').removeClass('bg-main-red').addClass('bg-white').removeClass('text-white').addClass('text-black');
        } else{
            me.tab.hide();
            my.tab.show();
            current_tab = 'my';
            $('button[name=\'tab_my\']').addClass('bg-main-red').removeClass('bg-white').addClass('text-white').removeClass('text-black');
            $('button[name=\'tab_me\']').removeClass('bg-main-red').addClass('bg-white').removeClass('text-white').addClass('text-black');
        }
    });
    
    function getMeAppeals(){
        $.ajax({
            url: '/frontend/web/appeals/view-me-appeals',
            type: 'post',
            dataType: 'html',
            data: 1,
            beforeSend: function (){
                me.loader.show();
            },
            success: function (response){
                me.tab.html(response);
                me.loader.hide();
                getLogs('appeals', 'load-my-appeals', 'loaded to tab my appeals', 1, false);
            },
            error: function (response){
                getLogs('appeals', 'load-my-appeals', 'loaded to tab my appeals', 0, response['responseText']);
                alert("Упс! Кажется произошла ошибка при загрузке данных. Пожалуйста, перезагрузите страницу или попробуйте позже!\\n\\nОтвет ошибки:\\n" + response['responseText']);
                console.log(response);
            }
        });
    }
    
    function getMyAppeals(){
        $.ajax({
            url: '/frontend/web/appeals/view-my-appeals',
            type: 'post',
            dataType: 'html',
            data: 1,
            beforeSend: function (){
                my.loader.show();
            },
            success: function (response){
                my.tab.html(response);
                my.loader.hide();
                getLogs('appeals', 'load-my-appeals', 'loaded to tab my appeals', 1, false);
            },
            error: function (response){
                getLogs('appeals', 'load-my-appeals', 'loaded to tab my appeals', 0, response['responseText']);
                alert("Упс! Кажется произошла ошибка при загрузке данных. Пожалуйста, перезагрузите страницу или попробуйте позже!\\n\\nОтвет ошибки:\\n" + response['responseText']);
                console.log(response);
            }
        });
    }
    
    getMyAppeals();
    my.tab.show();
    getMeAppeals();
    
    function viewAppeals(view_id){
        $.ajax({
            url: '/frontend/web/appeals/view-current-appeals',
            type: 'post',
            dataType: 'html',
            data: { 'id': view_id },
            beforeSend: function (){
                my.loader_view.show();
            },
            success: function (response){
                my.container_view.html(response).show();
                my.loader_view.hide();
                getLogs('appeals', 'load-current-appeals', 'loaded to model current appeals - '+view_id, 1, false);
            },
            error: function (response){
                getLogs('appeals', 'load-current-appeals', 'loaded to model current appeals - '+view_id, 0, response['responseText']);
                alert("Упс! Кажется произошла ошибка при загрузке данных. Пожалуйста, перезагрузите страницу или попробуйте позже!\\n\\nОтвет ошибки:\\n" + response['responseText']);
                console.log(response);
            }
        });
    }
    
    let view_id  = 0;
    my.tab.on('click', 'button[id^=\'appeals_\']', function (){
        view_id = $(this).attr('id').replace('appeals_', '');
        viewAppeals(view_id);
    });
    
    search.tab.on('click', 'button[id^=\'appeals_\']', function (){
        view_id = $(this).attr('id').replace('appeals_', '');
        viewAppeals(view_id);
    });
    
    $('#templateModal').on('click', 'button[name^=\'responseOk_\']', function (){
        let id = $(this).attr('name').replace('responseOk_', '');
        $.ajax({
            url: '/frontend/web/appeals/responsing-appeals',
            type: 'post',
            dataType: 'html',
            data: { 'id': id },
            beforeSend: function (){
                my.loader_view.show();
            },
            success: function (response){
                my.container_view.html(response).show();
                my.loader_view.hide();
                getMyAppeals();
                my.tab.show();
                getLogs('appeals', 'response ok', 'loaded to model current appeals - '+id, 1, false);
            },
            error: function (response){
                getLogs('appeals', 'response ok', 'loaded to model current appeals - '+id, 0, response['responseText']);
                alert("Упс! Кажется произошла ошибка при загрузке данных. Пожалуйста, перезагрузите страницу или попробуйте позже!\\n\\nОтвет ошибки:\\n" + response['responseText']);
                console.log(response);
            }
        });
    });
    
    let search_query = true;
    
    $('input[name=\'search\']').on('input, keyup', function (){
        let value = $(this).val();
        let set_ajax = $.ajax();
        if ( value.length >= 3 ){
            set_ajax.abort();
            $.ajax({
                url: '/frontend/web/appeals/search',
                type: 'post',
                dataType: 'html',
                data: { 'value': value },
                beforeSend: function (){
                    my.tab.hide();
                    me.tab.hide();
                    search.loader.show();
                },
                success: function (response){
                    search.tab.html(response).show();
                    search.loader.hide();
                    getLogs('appeals', 'searching', 'searching on appeals from value - '+value, 1, false);
                },
                error: function (response){
                    getLogs('appeals', 'searching', 'searching on appeals from value - '+value, 0, response['responseText']);
                    alert("Упс! Кажется произошла ошибка при загрузке данных. Пожалуйста, перезагрузите страницу или попробуйте позже!\\n\\nОтвет ошибки:\\n" + response['responseText']);
                    console.log(response);
                }
            });
        } else{
            set_ajax.abort();
            search.tab.hide();
            search.loader.hide();
            if ( current_tab == 'my' ){ my.tab.show(); } else{ me.tab.show(); }
        }
    });
    
JS;

$this->registerJs($script, \yii\web\View::POS_READY);