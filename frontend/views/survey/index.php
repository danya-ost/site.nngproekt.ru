<?php

/** @var \yii\web\View $this */
/** @var \frontend\controllers\SurveyController $data */
/** @var \frontend\controllers\SurveyController $permission */

use yii\helpers\Url;

$this->title = 'Опросы';
?>
<div class="container h-auto">
    <div class="w-full ha-auto">
        <h1 class="font-bold text-4xl uppercase">ОПРОСЫ</h1>
    </div>

    <?php if ( $permission['addSurvey'] ): ?>
        <div class="relative rounded overflow-hidden my-5 bg-white shadow-sm hover:shadow-lg px-2 py-3 border border-solid border-stone-200 duration-200 ease-in-out transition-all pb-10 sm:pb-3">
            <div class="rounded-tl bg-stone-200 text-xs text-white font-bold absolute right-0 bottom-0 px-5 py-1 border-t border-l border-solid border-stone-200">NNGP ADMIN</div>
            <?php if ( $permission['addSurvey'] ): ?>
                <a href="<?= Url::to(['/survey/add-form']) ?>" class="block sm:inline-block align-middle text-center rounded px-6 py-2.5 ml-1 mt-1 md:mt-0 bg-stone-300 text-white font-medium text-xs leading-tight uppercase hover:bg-gray-900 hover:shadow-lg focus:bg-gray-900 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-gray-900 active:shadow-lg transition duration-150 ease-in-out">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 inline-block align-middle">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 5v14m7-7H5" />
                    </svg>
                    <span class="ml-1 inline-block align-middle">Добавить опрос</span>
                </a>
            <?php endif; ?>
        </div>
    <?php endif; ?>

    <div class="w-full h-auto mt-6 mb-8">
        <form action="" class="w-full h-auto">
            <div class="block sm:inline-block w-full sm:w-[150px] md:w-[214px] lg:w-[344px] relative">
                <input type="text" placeholder="Поиск по названию" name="search" class="border-solid border-b border-stone-300 py-1 w-full focus:outline-none focus:border-main-red text-black font-light text-sm bg-[#F8F8F8]">

                <svg class="absolute right-0 top-2/4 -translate-y-2/4" width="16" height="16" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M17.8901 17.3599L12.4133 11.883C13.5509 10.6199 14.25 8.95461 14.25 7.12498C14.25 3.1963 11.0537 0 7.12501 0C3.1963 0 0 3.1963 0 7.12501C0 11.0537 3.1963 14.25 7.12501 14.25C8.95465 14.25 10.6199 13.5509 11.883 12.4133L17.3599 17.8901C17.4331 17.9634 17.5291 18 17.625 18C17.721 18 17.8169 17.9634 17.8902 17.8901C18.0366 17.7436 18.0366 17.5063 17.8901 17.3599ZM7.12501 13.5C3.61013 13.5 0.750023 10.6403 0.750023 7.12501C0.750023 3.60977 3.61013 0.749988 7.12501 0.749988C10.6399 0.749988 13.5 3.60974 13.5 7.12501C13.5 10.6403 10.6399 13.5 7.12501 13.5Z" fill="black"/>
                </svg>
            </div>
        </form>
    </div>

    <div id="container" class="w-full h-auto grid grid-cols-1 md:grid-cols-2 gap-2 mb-24">
        <?php foreach ( $data as $item ): ?>
            <div class="h-[200px] sm:h-[140px] bg-white  relative">
                <div class="absolute top-4 right-4 z-[999]">
                    <?php if ( \frontend\tools\tools::isPermission('survey')['updateSurvey'] ): ?>
                        <a href="<?= Url::to(['/survey/update-form', 's' => $item['survey_id']]) ?>" type="button" class="inline-block align-middle mr-1 font-light text-xs text-stone-400 hover:text-main-red">
                            <svg width="14" height="14" viewBox="0 0 13 13" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                <g clip-path="url(#clip0_1127_8460)">
                                    <path d="M12.5952 1.5818L11.4172 0.403682C10.8789 -0.134573 10.0032 -0.134548 9.465 0.403682L9.00391 0.8648L12.1342 3.99531L12.5952 3.53419C13.1347 2.99466 13.1348 2.12138 12.5952 1.5818Z"/>
                                    <path d="M0.558895 9.56567L0.00637087 12.5496C-0.0164553 12.6729 0.0228494 12.7996 0.111539 12.8883C0.200329 12.9771 0.327028 13.0163 0.450198 12.9935L3.4339 12.4409L0.558895 9.56567Z"/>
                                    <path d="M8.46574 1.40332L0.970215 8.89943L4.10047 12.0299L11.596 4.53383L8.46574 1.40332Z"/>
                                </g>
                                <defs>
                                    <clipPath id="clip0_1127_8460">
                                        <rect width="13" height="13" fill="white"/>
                                    </clipPath>
                                </defs>
                            </svg>
                        </a>
                    <?php endif; ?>
                    <?php if ( \frontend\tools\tools::isPermission('survey')['deleteSurvey'] ): ?>
                        <button type="button" name="services_delete_<?= $item['survey_id'] ?>" class="inline-block align-middle font-light text-xs text-stone-400 hover:text-main-red">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                            </svg>
                        </button>
                    <?php endif; ?>
                </div>
                <?php if ( $item['response'] ): ?>
                    <a href="<?= $item['response_href'] ?>" class="grid grid-cols-[25%_75%] shadow-[0px_0px_10px_0px_#00000017] grid-rows-1 w-full h-full">
                        <div class="bg-no-repeat bg-center bg-cover" style="background-image: url('/frontend/web/<?= $item['cover_src'] ?>');"></div>
                        <div class="p-6">
                            <h1 class="font-medium text-xs sm:text-sm text-black">
                                <?= $item['title'] ?>
                            </h1>
                            <div class="inline-block font-medium text-[8px] sm:text-[10px] text-main-red uppercase relative after:block after:content-[''] after:absolute after:left-0 after:-bottom-px after:bg-main-red after:h-px after:w-full">
                                СМОТРЕТЬ РЕЗУЛЬТАТЫ
                            </div>
                        </div>
                    </a>
                <?php else: ?>
                    <a href="<?= $item['href'] ?>" class="grid grid-cols-[25%_75%] shadow-[0px_0px_10px_0px_#00000017] grid-rows-1 w-full h-full">
                        <div class="bg-no-repeat bg-center bg-cover" style="background-image: url('/frontend/web/<?= $item['cover_src'] ?>');"></div>
                        <div class="p-6">
                            <h1 class="font-medium text-xs sm:text-sm text-black">
                                <?= $item['title'] ?>
                            </h1>
                            <div class="inline-block font-medium text-[8px] sm:text-[10px] text-main-red uppercase relative after:block after:content-[''] after:absolute after:left-0 after:-bottom-px after:bg-main-red after:h-px after:w-full">
                                ПРОЙТИ ОПРОС
                            </div>
                        </div>
                    </a>
                <?php endif; ?>
            </div>
        <?php endforeach; ?>
        <?php if ( count($data) == 0 ): ?>
            <div class="font-bold text-sm">
                Ничего не найдено...
            </div>
        <?php endif; ?>
    </div>

    <div id="search_container" class="w-full h-auto grid grid-cols-1 md:grid-cols-2 gap-2 mb-24"></div>

    <div id="loader" style="display: none;" class="w-full h-auto flex items-center justify-center py-10">
        <div class="spinner-border animate-spin inline-block w-10 h-10 border-4 rounded-full text-main-red mb-24" role="status">
            <span class="visually-hidden">Loading...</span>
        </div>
    </div>

</div>

<div class="modal fade fixed top-0 left-0 hidden w-full h-full outline-none overflow-x-hidden overflow-y-auto" id="modalDelete" tabindex="-1" aria-labelledby="exampleModalCenterTitle" aria-modal="true" role="dialog">
    <div class="modal-dialog modal-dialog-centered relative w-auto pointer-events-none">
        <div class="modal-content border-none shadow-lg relative flex flex-col w-full pointer-events-auto bg-white bg-clip-padding outline-none text-current">
            <div class="modal-header flex flex-shrink-0 items-center justify-between p-4 border-b border-gray-200">
                <h5 class="text-xl font-medium leading-normal text-gray-800" id="exampleModalScrollableLabel">
                    Подтверждение действия
                </h5>
            </div>
            <div class="modal-body relative p-4">
                <p id="deleteContent" class="font-medium text-xl text-black text-center">
                    Вы уверены, что хотите удалить этот опрос?
                </p>
                <div id="deleteLoader" class="w-full h-auto flex items-center justify-center py-5" style="display: none;">
                    <div class="spinner-border animate-spin inline-block w-10 h-10 border-4 rounded-full text-main-red mb-24" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                </div>
            </div>
            <div id="deleteButtons" class="modal-footer flex flex-shrink-0 flex-wrap items-center justify-center p-4 border-t border-gray-200">
                <button type="button" id="deleteModalClose" data-bs-dismiss="modal" aria-label="Close" class="inline-block align-middle rounded px-3 py-2.5 ml-1 bg-gray-800 text-white font-medium text-xs leading-tight uppercase shadow-md hover:bg-gray-900 hover:shadow-lg focus:bg-gray-900 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-gray-900 active:shadow-lg transition duration-150 ease-in-out">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="inline-block align-middle w-4 h-4">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15M12 9l-3 3m0 0l3 3m-3-3h12.75" />
                    </svg>
                </button>
                <button type="button" id="btnDelete" class="inline-block align-middle rounded px-6 py-2.5 ml-1 bg-gray-800 text-white font-medium text-xs leading-tight uppercase shadow-md hover:bg-gray-900 hover:shadow-lg focus:bg-gray-900 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-gray-900 active:shadow-lg transition duration-150 ease-in-out">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="inline-block align-middle w-4 h-4">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                    </svg>
                    <span class="ml-1 inline-block align-middle">Удалить</span>
                </button>
            </div>
        </div>
    </div>
</div>
<button type="button" id="openDelete" data-bs-toggle="modal" data-bs-target="#modalDelete" class="hidden"></button>

<?php
$script = <<<JS
    let delete_id;
    $('button[name^=\'services_delete_\']').on('click', function (){
        delete_id = $(this).attr('name').replace('services_delete_', '');
        $('#openDelete').trigger('click');
    });
    
    $('#btnDelete').on('click', function (){
        $.ajax({
            url: '/frontend/web/survey/delete-survey',
            type: 'post',
            dataType: 'html',
            data: { 'id': delete_id },
            beforeSend: function (){
                $(this).hide();
                $('#deleteLoader').show();
            },
            success: function (){
                getLogs('survey', 'delete', 'deleting survey: '+delete_id, 1, false);
                window.location.reload();
            },
            error: function (response){
                getLogs('survey', 'delete', 'deleting survey: '+delete_id, 0, response['responseText']);
                alert("Упс! Кажется произошла ошибка при загрузке данных. Пожалуйста, перезагрузите страницу или попробуйте позже!\\n\\nОтвет ошибки:\\n" + response['responseText']);
                console.log(response);
            }
        });  
    });
    
    $('input[name=\'search\']').bind('input, keyup', function (){
        let value = $(this).val();
        let setAjax = $.ajax();
        if ( value.length > 3 ){
            setAjax = $.ajax({
                url: '/frontend/web/survey/search',
                type: 'post',
                dataType: 'html',
                data: { 'value': value },
                beforeSend: function (){
                    $('#container').hide();
                    $('#loader').show();
                },
                success: function (response){
                    $('#search_container').html(response).show();
                    $('#loader').hide();
                    getLogs('survey', 'search', 'searching survey: '+value, 1, false);
                },
                error: function (response){
                    getLogs('survey', 'search', 'searching survey: '+value, 0, response['responseText']);
                    alert("Упс! Кажется произошла ошибка при загрузке данных. Пожалуйста, перезагрузите страницу или попробуйте позже!\\n\\nОтвет ошибки:\\n" + response['responseText']);
                    console.log(response);
                }
            });
        } else{
            $('#container').show();
            $('#loader').hide();
            $('#search_container').hide();
        }
    });
JS;

$this->registerJs($script, \yii\web\View::POS_READY);