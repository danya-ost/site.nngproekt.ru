<?php

/** @var \yii\web\View $this */
/** @var \frontend\controllers\InitiativeController $permission */

use yii\helpers\Url;
use frontend\tools\tools;
$permission = tools::isPermission('initiative');

$this->title = 'Инициативы';
?>
<div class="container">
    <div class="max-w-[865px]">
        <h1 class="font-semibold text-2xl">
            Инициативы
        </h1>
        <div>
            <a href="<?= Url::to(['/initiative/add-form-initiative']) ?>" class="bg-black text-center block md:inline-block align-middle mr-6 w-full md:w-auto px-9 py-3 rounded-xl text-white uppercase cursor-pointer duration-300 ease-in-out mt-6 mb-5 md:mb-10">
                ПОДАТЬ ИНИЦИАТИВУ
            </a>
            <a href="<?= Url::to(['/initiative/index-regedit']) ?>" class="bg-white text-center block md:inline-block align-middle w-full md:w-auto px-9 py-3 rounded-xl border border-solid border-main-red text-black uppercase cursor-pointer hover:bg-white duration-300 ease-in-out mt-6 mb-5 md:mb-10">
                <svg class="inline-block align-middle mr-2" width="20" height="20" viewBox="0 0 20 20" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                    <path d="M15.5805 19.4142H1.78915C1.51946 19.4142 1.30005 19.1948 1.30005 18.9252V10.9922C1.30005 10.8304 1.16892 10.6992 1.00708 10.6992C0.845244 10.6992 0.714111 10.8304 0.714111 10.9922V18.9252C0.714111 19.5179 1.19638 20.0002 1.78915 20.0002H15.5805C15.7423 20.0002 15.8734 19.869 15.8734 19.7072C15.8734 19.5454 15.7423 19.4142 15.5805 19.4142Z"/>
                    <path d="M7.3536 9.74277C7.40415 9.83937 7.50415 9.89992 7.61321 9.89992H18.2119C18.4816 9.89992 18.701 10.1193 18.701 10.389V18.925C18.701 19.1946 18.4816 19.4141 18.2119 19.4141H16.9477C16.7858 19.4141 16.6547 19.5452 16.6547 19.707C16.6547 19.8688 16.7858 20 16.9477 20H18.2119C18.8047 20 19.2869 19.5178 19.2869 18.925V10.389C19.2869 9.79621 18.8047 9.31394 18.2119 9.31394H17.3485V4.95824C17.3485 4.88355 17.3194 4.80777 17.2627 4.75109L15.5927 3.08113V0.879492C15.5927 0.394531 15.1982 0 14.7133 0H3.29274C2.80778 0 2.41329 0.394531 2.41329 0.879492V7.37531H1.5936C1.10864 7.37531 0.714111 7.76984 0.714111 8.2548V9.62047C0.714111 9.78227 0.845244 9.91344 1.00708 9.91344C1.16892 9.91344 1.30005 9.78227 1.30005 9.62047V8.2548C1.30005 8.09293 1.43173 7.96125 1.5936 7.96125H6.24376C6.35337 7.96125 6.45302 8.02156 6.50384 8.11871C6.89138 8.85934 6.97739 9.02375 7.3536 9.74277ZM13.9921 2.30906C14.2629 2.57984 15.9824 4.29941 16.3483 4.66523H14.5099C14.2243 4.66523 13.9921 4.43297 13.9921 4.14746V2.30906ZM2.99923 0.879492C2.99923 0.717617 3.13091 0.585938 3.29278 0.585938H14.7133C14.8752 0.585938 15.0068 0.717617 15.0068 0.879492V2.49516L13.9063 1.39461C13.8544 1.34273 13.7797 1.30879 13.6991 1.30879H5.54317C4.93458 1.30879 4.43946 1.80391 4.43946 2.4125V7.37531H2.99923V0.879492ZM7.79056 9.31398L7.48782 8.73539H15.127C15.2888 8.73539 15.4199 8.60422 15.4199 8.44242C15.4199 8.28063 15.2888 8.14945 15.127 8.14945H7.18126L7.02306 7.84707C6.87083 7.55609 6.5722 7.37531 6.2438 7.37531H5.02544V2.41254C5.02544 2.12703 5.25771 1.89477 5.54321 1.89477H13.4062V4.1475C13.4062 4.75609 13.9013 5.25121 14.5099 5.25121H16.7626V9.31398H7.79056Z"/>
                    <path d="M15.127 6.20898H6.69531C6.53348 6.20898 6.40234 6.34016 6.40234 6.50195C6.40234 6.66375 6.53348 6.79492 6.69531 6.79492H15.127C15.2888 6.79492 15.4199 6.66375 15.4199 6.50195C15.4199 6.34016 15.2888 6.20898 15.127 6.20898Z"/>
                </svg>
                <span class="inline-block align-middle">РЕЕСТР ИНИЦИАТИВ</span>
            </a>
        </div>
        <div>
            <?php if ( $permission['responseInitiative'] ): ?>
                <button type="button" name="tab_my" class="block md:inline-block align-middle w-full md:w-auto mb-5 md:mb-0 mr-4 px-5 h-[50px] bg-main-red shadow-[0px_0px_4px_0px_#00000040] rounded-xl md:rounded-lg text-white font-light text-xs">
                    МОИ ИНИЦИАТИВЫ
                </button>

                <button type="button" name="tab_me" class="block md:inline-block align-middle w-full md:w-auto mb-5 md:mb-0 mr-4 px-5 h-[50px] bg-white shadow-[0px_0px_4px_0px_#00000040] rounded-xl md:rounded-lg text-black font-light text-xs">
                    ИНИЦИАТИВЫ НА РАССМОТРЕНИЕ
                </button>
            <?php endif; ?>

            <div class="block md:inline-block align-bottom w-full sm:w-[150px] md:w-[214px] lg:w-[344px] relative">
                <input type="text" name="search" placeholder="Автоматическая нумерация разделов" class="border-solid border-b border-stone-300 py-1 w-full focus:outline-none focus:border-main-red text-black font-light text-sm bg-[#F8F8F8]">

                <svg class="absolute right-0 top-2/4 -translate-y-2/4" width="16" height="16" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M17.8901 17.3599L12.4133 11.883C13.5509 10.6199 14.25 8.95461 14.25 7.12498C14.25 3.1963 11.0537 0 7.12501 0C3.1963 0 0 3.1963 0 7.12501C0 11.0537 3.1963 14.25 7.12501 14.25C8.95465 14.25 10.6199 13.5509 11.883 12.4133L17.3599 17.8901C17.4331 17.9634 17.5291 18 17.625 18C17.721 18 17.8169 17.9634 17.8902 17.8901C18.0366 17.7436 18.0366 17.5063 17.8901 17.3599ZM7.12501 13.5C3.61013 13.5 0.750023 10.6403 0.750023 7.12501C0.750023 3.60977 3.61013 0.749988 7.12501 0.749988C10.6399 0.749988 13.5 3.60974 13.5 7.12501C13.5 10.6403 10.6399 13.5 7.12501 13.5Z" fill="black"/>
                </svg>
            </div>
        </div>

        <div id="my_initiative">
            <div id="my_container" style="display: none;" class="grid grid-cols-1 md:grid-cols-2 gap-x-11 gap-y-6 py-7"></div>
            <div id="my_loader" style="display: none;" class="w-full h-auto flex items-center justify-center py-24">
                <div class="spinner-border animate-spin inline-block w-10 h-10 border-4 rounded-full text-main-red" role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>
            </div>
        </div>

        <div id="me_initiative">
            <div id="me_container" style="display: none;" class="grid grid-cols-1 md:grid-cols-2 gap-x-11 gap-y-6 py-7"></div>
            <div id="me_loader" style="display: none;" class="w-full h-auto flex items-center justify-center py-24">
                <div class="spinner-border animate-spin inline-block w-10 h-10 border-4 rounded-full text-main-red" role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>
            </div>
        </div>

        <div id="search_initiative">
            <div id="search_container" style="display: none;" class="grid grid-cols-1 md:grid-cols-2 gap-x-11 gap-y-6 py-7"></div>
            <div id="search_loader" style="display: none;" class="w-full h-auto flex items-center justify-center py-24">
                <div class="spinner-border animate-spin inline-block w-10 h-10 border-4 rounded-full text-main-red" role="status">
                    <span class="visually-hidden">Loading...</span>
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

    let location = 'initiative';
    $('#a_'+location).attr('class', 'block text-left w-full py-3 px-3 pl-10 rounded-r-xl font-bold text-main-red text-xl bg-[#F8F8F8] border-t border-r border-b border-solid border-stone-300 relative after:absolute after:content-[\'\'] after:bg-[#F8F8F8] after:w-4 after:-top-px after:-bottom-px after:-left-px after:border-t after:border-b after:border-solid after:border-stone-300');
    
    let my = {
        tab: $('#my_initiative'),
        container: $('#my_container'),
        loader: $('#my_loader')
    };
    
    let me = {
        tab: $('#me_initiative'),
        container: $('#me_container'),
        loader: $('#me_loader')
    };
    
    let search = {
        tab: $('#search_initiative'),
        container: $('#search_container'),
        loader: $('#search_loader')
    };
    
    let current_tab = 'my';
    
    $('button[name^=\'tab_\']').on('click', function (){
        let tab = $(this).attr('name').replace('tab_', '');
        if ( tab == 'my' ){
            me.tab.hide();
            my.tab.show();
            search.tab.hide();
            $(this).addClass('bg-main-red').removeClass('bg-white').addClass('text-white').removeClass('text-black');
            $('button[name=\'tab_me\']').removeClass('bg-main-red').addClass('bg-white').removeClass('text-white').addClass('text-black');
            current_tab = 'my';
        } else{
            my.tab.hide();
            me.tab.show();
            search.tab.hide();
            $(this).addClass('bg-main-red').removeClass('bg-white').addClass('text-white').removeClass('text-black');
            $('button[name=\'tab_my\']').removeClass('bg-main-red').addClass('bg-white').removeClass('text-white').addClass('text-black');
            current_tab = 'me';
        }
    });
    
    function getMyInitiative(){
        $.ajax({
            url: '/frontend/web/initiative/view-my-initiative',
            type: 'post',
            dataType: 'html',
            data: 1,
            beforeSend: function (){
                my.loader.show();
            },
            success: function (response){
                my.container.html(response);
                my.loader.hide();
                getLogs('initiative', 'view-my-initiative', 'View my initiative on index page', 1, false);
            },
            error: function (response){
                getLogs('initiative', 'view-my-initiative', 'View my initiative on index page', 0, response['responseText']);
                alert("Упс! Кажется произошла ошибка при загрузке данных. Пожалуйста, перезагрузите страницу или попробуйте позже!\\n\\nОтвет ошибки:\\n" + response['responseText']);
                console.log(response);
            }
        });
    }
    
    function getMeInitiative(){
        $.ajax({
            url: '/frontend/web/initiative/view-me-initiative',
            type: 'post',
            dataType: 'html',
            data: 1,
            beforeSend: function (){
                me.loader.show();
            },
            success: function (response){
                me.container.html(response);
                me.loader.hide();
                getLogs('initiative', 'view-me-initiative', 'View me initiative on index page', 1, false);
            },
            error: function (response){
                getLogs('initiative', 'view-me-initiative', 'View me initiative on index page', 0, response['responseText']);
                alert("Упс! Кажется произошла ошибка при загрузке данных. Пожалуйста, перезагрузите страницу или попробуйте позже!\\n\\nОтвет ошибки:\\n" + response['responseText']);
                console.log(response);
            }
        });
    }
    
    getMyInitiative();
    my.container.show();
    
    me.tab.hide();
    getMeInitiative();
    me.container.show();
    
    $('input[name=\'search\']').bind('input, keyup', function (){
        let value = $(this).val();
        let setAjax = $.ajax();
        if ( value.length >= 3  ){
            setAjax.abort();
            setAjax = $.ajax({
                url: '/frontend/web/initiative/search',
                type: 'post',
                dataType: 'html',
                data: { 'value': value },
                beforeSend: function (){
                    if ( current_tab == 'my' ){
                        my.tab.hide();
                    } else{
                        me.tab.hide();
                    }
                    search.tab.show();
                    search.loader.show();
                },
                success: function (response){
                    search.container.html(response).show();
                    search.loader.hide();
                    getLogs('initiative', 'search-initiative', 'Searching data -'+value, 1, false);
                },
                error: function (response){
                    getLogs('initiative', 'search-initiative', 'Searching data -'+value, 0, response['responseText']);
                    alert("Упс! Кажется произошла ошибка при загрузке данных. Пожалуйста, перезагрузите страницу или попробуйте позже!\\n\\nОтвет ошибки:\\n" + response['responseText']);
                    console.log(response);
                }
            });
        } else{
            search.tab.hide();
            if ( current_tab == 'my' ){
                my.tab.show();
            } else{
                me.tab.show();
            }
        }
    });
    
JS;

$this->registerJs($script, \yii\web\View::POS_READY);