<?php

/** @var yii\web\View $this */
/** @var $data */
/** @var $telephones */
/** @var $departments */

use yii\helpers\Url;

$this->title = 'Настройки профиля';

?>

<div class="container">
    <div class="max-w-[865px]">

        <!-- nngp:page-name -->
        <h1 class="font-semibold text-2xl">
            Настройки профиля
        </h1>
        <!-- /nngp:page-name -->

        <!-- nngp:profile-foto -->
        <div  class="py-8">
            <div class="w-[115px] h-[115px] rounded-full bg-no-repeat bg-center bg-cover relative left-2/4 sm:left-0 -translate-x-2/4 sm:-translate-x-0" style="background-image: url('<?= Url::to([$data['avatar']]) ?>');">
                <!-- image via css -->

                <button type="button" data-bs-toggle="modal" data-bs-target="#imageModal" class="w-[45px] h-[45px] bg-main-red hover:bg-white text-white hover:text-main-red rounded-full flex items-center justify-center absolute right-0 bottom-0 duration-300 ease-in-out">
                    <svg width="24" height="20" viewBox="0 0 24 20" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                        <path d="M12 16C14.7615 16 17 13.7614 17 11C17 8.23858 14.7615 6 12 6C9.23858 6 7 8.23858 7 11C7 13.7614 9.23858 16 12 16Z"/>
                        <path d="M22 3H18.8286C18.4277 3 18.0513 2.84377 17.7676 2.56055L15.9395 0.732422C15.4673 0.26025 14.8394 0 14.1714 0H9.82861C9.16064 0 8.5327 0.26025 8.06053 0.732422L6.23241 2.56055C5.94872 2.84377 5.57227 3 5.17139 3H2.00002C0.896953 3 0 3.89695 0 4.99997V18C0 19.103 0.896953 20 2.00002 20H22C23.103 20 24 19.103 24 18V4.99997C24 3.89695 23.103 3 22 3ZM12 17C8.69142 17 6 14.3085 6 11C6 7.69139 8.69142 4.99997 12 4.99997C15.3086 4.99997 18 7.69139 18 11C18 14.3085 15.3086 17 12 17ZM20 7.99997C19.4488 7.99997 19 7.55124 19 6.99999C19 6.44874 19.4488 6 20 6C20.5513 6 21 6.44874 21 6.99999C21 7.55124 20.5513 7.99997 20 7.99997Z"/>
                    </svg>
                </button>
            </div>
        </div>
        <!-- /nngp:profile-foto -->

        <div class="modal fade fixed top-0 left-0 hidden w-full h-full outline-none overflow-x-hidden overflow-y-auto" id="imageModal" tabindex="-1" aria-labelledby="exampleModalCenterTitle" aria-modal="true" role="dialog">
            <div class="modal-dialog modal-dialog-centered relative w-auto pointer-events-none">
                <div class="modal-content border-none shadow-lg relative flex flex-col w-full pointer-events-auto bg-white bg-clip-padding rounded-md outline-none text-current">
                    <div class="modal-header flex flex-shrink-0 items-top justify-between p-4 border-b border-gray-200 rounded-t-md">
                        <h5 class="text-xl font-medium leading-normal text-gray-800" id="exampleModalScrollableLabel">
                            Загрузка изображения профиля
                        </h5>
                        <button type="button"
                                id="closeModal"
                                class="btn-close text-black text-xs hover:opacity-80"
                                data-bs-dismiss="modal" aria-label="Close">Закрыть</button>
                    </div>
                    <div class="modal-body relative p-4">

                        <div id="selected_file">
                            <p class="text-base text-black">
                                Допустимые форматы изображения: jpg, png <br> <br>
                            </p>
                            <input class="form-control block w-full px-3 py-1.5 text-xs sm:text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-main-red focus:bg-white focus:border-main-red focus:outline-none"
                                   type="file"
                                   name="imageFile"
                                   accept=".jpg, .jpeg, .png"
                                   id="imageFile">
                        </div>

                        <div id="loader_image" class="w-full h-auto flex items-center justify-center hidden">
                            <div class="spinner-border animate-spin inline-block w-10 h-10 border-4 rounded-full text-main-red mb-24" role="status">
                                <span class="visually-hidden">Loading...</span>
                            </div>
                        </div>

                        <div id="frame" class="frame hidden">
                            <p class="text-base text-black">
                                Разместите лицо в центре <br> <br>
                            </p>
                            <img id="sample_picture">
                        </div>

                        <div id="controls" class="hidden flex items-center justify-between pt-5">
                            <button id="zoom_in" type="button" class="text-black hover:text-main-red">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 3v18m9-9H3" />
                                </svg>
                            </button>
                            <button id="fit" type="button"class="text-black hover:text-main-red">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 3.75v4.5m0-4.5h4.5m-4.5 0L9 9M3.75 20.25v-4.5m0 4.5h4.5m-4.5 0L9 15M20.25 3.75h-4.5m4.5 0v4.5m0-4.5L15 9m5.25 11.25h-4.5m4.5 0v-4.5m0 4.5L15 15" />
                                </svg>
                            </button>
                            <button id="zoom_out" type="button" class="text-black hover:text-main-red">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" d="M3 12h18" />
                                </svg>
                            </button>
                        </div>


                    </div>
                    <div
                            class="modal-footer flex flex-shrink-0 flex-wrap items-center justify-end p-4 border-t border-gray-200 rounded-b-md">
                        <button type="button"
                                onclick="getFile()"
                                id="imageFile_next"
                                class="inline-block px-6 py-2.5 bg-main-red text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-white hover:text-main-red hover:shadow-lg transition duration-150 ease-in-out">
                            Далее
                        </button>
                        <button type="button"
                                onclick="getAvatar()"
                                id="imageFile_save"
                                class="hidden inline-block px-6 py-2.5 bg-main-red text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-white hover:text-main-red hover:shadow-lg transition duration-150 ease-in-out">
                            Сохранить
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- nngp:form -->
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-10 md:gap-x-28 gap-y-9">

            <div>
                <label for="profile-fullname" class="font-light text-xs text-stone-500">
                    Фамилия Имя Отчество
                </label>
                <input type="text"
                       id="profile-fullname"
                       placeholder="Иванов Иван Иванович"
                       disabled
                       value="<?= $data['fullname'] ?>"
                       class="block w-full py-2 font-medium text-sm border-b border-solid border-b-stone-300 bg-[#F8F8F8] focus:border-b-main-red focus:outline-none">
            </div>

            <?php
                $i = 1;
                $count = count( $telephones );
                foreach ( $telephones as $item ) :
            ?>

                <div>
                    <div>
                        <label for="profile-tel-<?= $i ?>" class="inline-block align-middle font-light text-xs text-stone-500">
                            Номер телефона <?php if ( $count > 1 ) : ?>[ <?= $i ?> ]<?php endif; ?>
                        </label>
                        <?php if ( $item['telephone'] ) : ?>
                            <button type="button" onclick="getDeleteTel(<?= $item['id'] ?>)" class="inline-block align-middle float-right mr-1 font-light text-xs text-stone-400 hover:text-main-red">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                </svg>
                            </button>
                        <?php endif; ?>

                        <?php if ( $i == 1 && $count < 3 && $item['telephone']) : ?>
                            <button type="button" class="inline-block align-middle float-right mr-2 font-light text-xs text-stone-400 hover:text-main-red"
                                    data-bs-toggle="modal"
                                    data-bs-target="#telephoneModal">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 3v18m9-9H3" />
                                </svg>
                            </button>
                        <?php endif; ?>
                    </div>
                    <input type="text"
                           id="profile-tel-<?= $i ?>"
                           placeholder="+7 987 654 32 10"
                           onfocusout="getTel(<?= $i ?>, <?= $item['id'] ?>)"
                           value="<?= $item['telephone'] ?>"
                           class="block w-full py-2 font-medium text-sm border-b border-solid border-b-stone-300 bg-[#F8F8F8] focus:border-b-main-red focus:outline-none">
                </div>

            <?php
                $i++;
                endforeach;
            ?>

            <div class="modal fade fixed top-0 left-0 hidden w-full h-full outline-none overflow-x-hidden overflow-y-auto" id="telephoneModal" tabindex="-1" aria-labelledby="exampleModalCenterTitle" aria-modal="true" role="dialog">
                <div class="modal-dialog modal-dialog-centered relative w-auto pointer-events-none">
                    <div class="modal-content border-none shadow-lg relative flex flex-col w-full pointer-events-auto bg-white bg-clip-padding rounded-md outline-none text-current">
                        <div class="modal-header flex flex-shrink-0 items-top justify-between p-4 border-b border-gray-200 rounded-t-md">
                            <h5 class="text-xl font-medium leading-normal text-gray-800" id="exampleModalScrollableLabel">
                                Добавление нового номера
                            </h5>
                            <button type="button"
                                    id="closeModal"
                                    class="btn-close text-black text-xs hover:opacity-80"
                                    data-bs-dismiss="modal" aria-label="Close">Закрыть</button>
                        </div>
                        <div class="modal-body relative p-4">

                            <div>
                                <div>
                                    <label for="profile-tel-<?= $i ?>" class="inline-block align-middle font-light text-xs text-stone-500">
                                        Новый номер телефона
                                    </label>
                                </div>
                                <input type="text"
                                       id="profile-new-tel"
                                       placeholder="+7 987 654 32 10"
                                       class="block w-full py-2 font-medium text-sm border-b border-solid border-b-stone-300 bg-white focus:border-b-main-red focus:outline-none">
                            </div>

                        </div>
                        <div
                                class="modal-footer flex flex-shrink-0 flex-wrap items-center justify-end p-4 border-t border-gray-200 rounded-b-md">
                            <button type="button"
                                    onclick="getNewTel()"
                                    class="inline-block px-6 py-2.5 bg-main-red text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-white hover:text-main-red hover:shadow-lg transition duration-150 ease-in-out"
                                    data-bs-dismiss="modal">
                                Сохранить
                            </button>
                        </div>
                    </div>
                </div>
            </div>


            <?php if ($data['department']['id'] != 0) : ?>
                <div>
                    <label for="profile-department" class="font-light text-xs text-stone-500">
                        Подразделение
                    </label>
                    <select name=""
                            id="profile-department"
                            disabled
                            class="block w-full py-2 font-medium text-sm border-b border-solid border-b-stone-300 bg-[#F8F8F8] focus:border-b-main-red focus:outline-none">
                        <option value="<?= $data['department']['id'] ?>">
                            <?= $data['department']['name'] ?>
                        </option>

                        <?php foreach ( $departments as $item ) : ?>

                            <?php if ( !($item['id'] == $data['department']['id']) ) : ?>
                                <option value="<?= $item['id'] ?>">
                                    <?= $item['title'] ?>
                                </option>
                            <?php endif; ?>

                        <?php endforeach; ?>

                    </select>
                </div>
            <?php endif; ?>

            <div>
                <label for="profile-email" class="font-light text-xs text-stone-500">
                    E-mail
                </label>
                <input type="text"
                       id="profile-email"
                       placeholder="ivanov@nngp.com"
                       disabled
                       value="<?= $data['email'] ?>"
                       class="block w-full py-2 font-medium text-sm border-b border-solid border-b-stone-300 bg-[#F8F8F8] focus:border-b-main-red focus:outline-none">
            </div>

            <div>
                <label for="profile-work" class="font-light text-xs text-stone-500">
                    Должность
                </label>
                <input type="text"
                       id="profile-work"
                       placeholder="Инженер"
                       disabled
                       value="<?= $data['job'] ?>"
                       class="block w-full py-2 font-medium text-sm border-b border-solid border-b-stone-300 bg-[#F8F8F8] focus:border-b-main-red focus:outline-none">
            </div>

            <div>
                <div>
                    <label for="profile-work" class="inline-block align-middle mr-6 font-light text-xs text-stone-500">
                        Дата рождения
                    </label>
                    <div class="inline-block align-middle">
                        <h1 class="inline-block align-middle mr-1 font-light text-xs text-stone-400">
                            Сделать публичным
                        </h1>

                        <div class="inline-block align-middle form-check form-switch">
                            <input id="profile-old-view" name="profile_sw_old" value="<?= $data['birthday_view'] == 1 ? '1' : '0' ?>" <?= $data['birthday_view'] == 1 ? 'checked' : '' ?> oninput="getView()" class="form-check-input appearance-none w-7 -ml-10 rounded-full float-left h-4 align-top bg-white bg-no-repeat bg-contain bg-gray-300 focus:outline-none cursor-pointer shadow-sm checked:bg-main-red" type="checkbox" role="switch">
                        </div>
                    </div>
                </div>

                <div>
                    <input type="text"
                           id="profile-old-day"
                           placeholder="01"
                           disabled
                           value="<?= $data['birthday_day'] ?>"
                           class="inline-block align-middle mr-3 w-[35px] py-2 px-1 font-medium text-sm text-center border-b border-solid border-b-stone-300 bg-[#F8F8F8] focus:border-b-main-red focus:outline-none">

                    <input type="text"
                           id="profile-old-month"
                           placeholder="01"
                           disabled
                           value="<?= $data['birthday_month'] ?>"
                           class="inline-block align-middle mr-3 w-[35px] py-2 px-1 font-medium text-sm text-center border-b border-solid border-b-stone-300 bg-[#F8F8F8] focus:border-b-main-red focus:outline-none">

                    <input type="text"
                           id="profile-old-year"
                           placeholder="2022"
                           disabled
                           value="<?= $data['birthday_year'] ?>"
                           class="inline-block align-middle mr-3 w-[50px] py-2 px-1 font-medium text-sm text-center border-b border-solid border-b-stone-300 bg-[#F8F8F8] focus:border-b-main-red focus:outline-none">
                </div>
            </div>

            <div>
                <label for="profile-address" class="font-light text-xs text-stone-500">
                    Рабочий адрес
                </label>
                <input type="text"
                       id="profile-address"
                       disabled
                       placeholder="г. Н. Новгород, ул. Максима Горького, д. 147А"
                       value="<?= $data['address'] ?>"
                       class="block w-full py-2 font-medium text-sm border-b border-solid border-b-stone-300 bg-[#F8F8F8] focus:border-b-main-red focus:outline-none">
            </div>


        </div>
        <!-- /nngp:form -->

        <!-- nngp:line -->
        <i class="block h-px bg-stone-500 my-9"></i>
        <!-- /nngp:line -->

        <!-- nngp:data-login -->
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-10 md:gap-x-28 gap-y-9">

            <div>
                <label for="profile-login" class="font-light text-xs text-stone-500">
                    Логин для входа на сайт
                </label>
                <input type="text"
                       id="profile-login"
                       value="<?= $data['login'] ?>"
                       disabled
                       class="block w-full py-2 font-medium text-sm border-b border-solid border-b-stone-300 bg-[#F8F8F8] focus:border-b-main-red focus:outline-none">
            </div>

            <div class="relative">
                <label for="profile-password" class="font-light text-xs text-stone-500">
                    Изменить пароль
                </label>
                <input type="text"
                       id="profile-password"
                       onfocusout="getSecurityPassword()"
                       placeholder="••••••••••••"
                       class="block w-full py-2 font-medium text-sm border-b border-solid border-b-stone-300 bg-[#F8F8F8] focus:border-b-main-red focus:outline-none">
                <button id="setPassword" type="button" onclick="getPassword()" class="text-xs px-3 py-1 bg-black rounded text-white absolute right-0" style="bottom: 6px; display: none;">Подтвердить</button>
            </div>

        </div>
        <!-- /nngp:data-login -->

        <!-- nngp:data-view -->
        <div class="py-14">
            <div class="inline-block align-middle">
                <h1 class="inline-block align-middle mr-2 font-light text-xs uppercase">
                    МЕНЯ НЕТ НА РАБОЧЕМ МЕСТЕ
                </h1>

                <div class="inline-block align-middle form-check form-switch">
                    <input id="profile-in_work" name="profile_sw_in_work" value="<?= $data['in_work'] ?>" <?= $data['in_work'] == 0 ? 'checked' : '' ?> oninput="getInWork()" class="form-check-input appearance-none w-10 -ml-10 rounded-full float-left h-5 align-top bg-white bg-no-repeat bg-contain bg-gray-300 focus:outline-none cursor-pointer shadow-sm checked:bg-main-red" type="checkbox" role="switch">
                </div>
            </div>
        </div>
        <!-- /nngp:data-view -->

        <div id="notification" class="w-auto sm:w-96 fixed top-5 sm:top-auto right-2 sm:right-10 bottom-auto sm:bottom-5 left-2 sm:left-auto z-[9999]">

            <div id="loader_notification" class="bg-white shadow-lg mx-auto w-96 max-w-full text-sm pointer-events-auto bg-clip-padding rounded-lg block" role="alert" aria-live="assertive" aria-atomic="true" data-mdb-autohide="false">
                <div class=" bg-white flex justify-between items-center py-2 px-3 bg-clip-padding border-b border-gray-200 rounded-t-lg">
                    <p class="font-bold text-gray-500">
                        ОБНОВЛЕНИЕ ДАННЫХ
                    </p>
                    <div class="flex items-center">
                        <p class="text-gray-600 text-xs"></p>
                        <button type="button" class=" btn-close box-content w-4 h-4 ml-2 text-black border-none rounded-none opacity-50 focus:shadow-none focus:outline-none focus:opacity-100 hover:text-black hover:opacity-75 hover:no-underline" data-mdb-dismiss="toast" aria-label="Close"></button>
                    </div>
                </div>
                <div class="p-3 bg-white rounded-b-lg break-words text-gray-700">
                    Подождите запрос обрабатывается!
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

    $('#loader_notification').hide();

    let location = 'profile-edit';
    $('#a_'+location).attr('class', 'block text-left w-full py-3 px-3 pl-10 rounded-r-xl font-bold text-main-red text-xl bg-[#F8F8F8] border-t border-r border-b border-solid border-stone-300 relative after:absolute after:content-[\'\'] after:bg-[#F8F8F8] after:w-4 after:-top-px after:-bottom-px after:-left-px after:border-t after:border-b after:border-solid after:border-stone-300');
JS;

$script_ajax = <<<JS
    let __loader = $('#loader_notification');

     function requestAjax(__input, __key)
    {
        $.ajax({
            url: '/frontend/web/profile/'+__key,
            method: 'POST',
            dataType: 'html',
            data: {
                '__val': $('#'+__input).val()
            },
            beforeSend: function (){
                console.log($('#'+__input).val());
                __loader.show(200);
            },
            success: function(response){
                $('#notification').append(response);
                __loader.hide(200);
            },
            error: function(response){
                console.log(response['responseText']);
                alert('Произршла ошибка обработке AJAX-запроса. Обновите страницу!');
            }
        });
    }

    function getJob() { requestAjax('profile-work', 'update-job'); }
    function getAddress() { requestAjax('profile-address', 'update-address'); }
    function getEmail() { requestAjax('profile-email', 'update-email'); }
    function getDay() { requestAjax('profile-old-day', 'update-birthday-day'); }
    function getMonth() { requestAjax('profile-old-month', 'update-birthday-month'); }
    function getYear() { requestAjax('profile-old-year', 'update-birthday-year'); }
    // function getPassword() { requestAjax('profile-password', 'update-password'); }
    function getSecurityPassword() {
         if ( $('#profile-password').val().length > 2 ){
            $('#setPassword').show();   
         } else{
            $('#setPassword').hide();   
         }
    }
    
    function getPassword(){
        $.ajax({
            url: '/frontend/web/profile/update-password',
            method: 'POST',
            dataType: 'html',
            data: {
                '__val': $('#profile-password').val()
            },
            beforeSend: function (){
                $('#setPassword').hide(); 
                console.log($('#profile-password').val());
                __loader.show(200);
            },
            success: function(response){
                $('#notification').append(response);
                __loader.hide(200);
                setTimeout(function (){
                    location.reload();
                }, 1000);
            },
            error: function(response){
                console.log(response['responseText']);
                alert('Произршла ошибка обработке AJAX-запроса. Обновите страницу!');
            }
        });
    }
    
    function getView() {
        let __input = 'profile-old-view';
        if ( $('#'+__input).val() == 1 ){
            $('#'+__input).val('0').removeAttr('checked', false);
        } else{
            $('#'+__input).val('1').attr('checked', true);
        }
         requestAjax(__input, 'update-birthday-view'); 
     }
     function getDepartment() {
         requestAjax('profile-department', 'update-department');
     }
     
     function getFullname() {
         requestAjax('profile-fullname', 'update-fullname');
     }
     
     function getNewTel() {
         $('#closeModal').trigger('click');
         requestAjax('profile-new-tel', 'add-telephones');
         setTimeout(function (){
            location.reload();
         }, 1000);
     }
     
     function getDeleteTel(__id){
          $.ajax({
            url: '/frontend/web/profile/delete-telephone',
            method: 'POST',
            dataType: 'html',
            data: {
                '__id': __id
            },
            beforeSend: function (){
                __loader.show(200);
            },
            success: function(response){
                $('#notification').append(response);
                __loader.hide(200);
                setTimeout(function (){
                    location.reload();
                }, 1000);
            },
            error: function(response){
                alert('Произршла ошибка обработке AJAX-запроса. Обновите страницу!');
            }
        });
     }
     
     function getTel(__key, __id){
         $.ajax({
            url: '/frontend/web/profile/update-telephone',
            method: 'POST',
            dataType: 'html',
            data: {
                '__id': __id, 
                '__val': $('#profile-tel-'+__key).val()
            },
            beforeSend: function (){
                __loader.show(200);
            },
            success: function(response){
                $('#notification').append(response);
                __loader.hide(200);
            },
            error: function(response){
                alert('Произршла ошибка обработке AJAX-запроса. Обновите страницу!');
            }
        });
     }
     
     function getInWork() {
        let __input = 'profile-in_work';
        if ( $('#'+__input).val() == 1 ){
            $('#'+__input).val('0').removeAttr('checked', false);
        } else{
            $('#'+__input).val('1').attr('checked', true);
        }
         requestAjax(__input, 'update-in-work'); 
     }
JS;

$script_file = <<<JS
    function getFile(){
        let select_file = $('#imageFile').prop('files')[0];
        if( typeof select_file == 'undefined' ) return;
        let select_data = new FormData();
        select_data.append( 'imageFile', select_file );
        $.ajax({
            url: '/frontend/web/profile/upload-image',
            type: 'POST',
            data: select_data,
            cache: false,
            dataType: 'text',
            processData: false,
            contentType: false, 
            beforeSend: function (){
                $('#loader_image').removeClass('hidden');
            },
            success: function(response){
                $('#loader_image').addClass('hidden');
                let __dir = response;
                $('#imageFile_next').hide(200);
                $('#imageFile_save').removeClass('hidden');
                $('#selected_file').addClass('hidden');
                $('#frame').removeClass('hidden').attr('data-src', __dir);
                $('#controls').removeClass('hidden');
                $('#sample_picture').attr('src', '/frontend/web/'+__dir);
                
            },
            error: function(response){
                alert('Произршла ошибка обработке AJAX-запроса. Обновите страницу!');
            }
	    });
        
    };
JS;

$script_crop = <<<JS
    let __loader_image = $('#loader_image');
    
    let picture = $('#sample_picture');
    picture.on('load', function(){
        picture.guillotine({eventOnChange: 'guillotinechange', width: 400, height: 400});

        let data = picture.guillotine('getData');
        
        $('#fit').click(function(){ picture.guillotine('fit'); }).trigger('click');
        $('#zoom_in').click(function(){ picture.guillotine('zoomIn'); });
        $('#zoom_out').click(function(){ picture.guillotine('zoomOut'); });
    });
    
    function getAvatar(){
        let data = $('#sample_picture').guillotine('getData');
        
        let data_image = {
            'x': data['x'],
            'y': data['y'],
            'w': data['w'],
            'h': data['h'],
            'scale': data['scale'],
            'src': $('#frame').attr('data-src')
        };
        $.ajax({
            url: '/frontend/web/profile/update-avatar',
            method: 'POST',
            dataType: 'html',
            data: {
                'data_image': data_image
            },
            beforeSend: function (){
                __loader_image.removeClass('hidden');
                $('#imageFile_next').hide(200);
                $('#imageFile_save').addClass('hidden');
                $('#frame').addClass('hidden');
                $('#controls').addClass('hidden');
            },
            success: function(response){
                location.reload(true);
            },
            error: function(response){
                alert('Произршла ошибка обработке AJAX-запроса. Обновите страницу!');
            }
        });
    }
JS;



$this->registerJs($script, \yii\web\View::POS_READY);
$this->registerJs($script_ajax, \yii\web\View::POS_HEAD);
$this->registerJs($script_file, \yii\web\View::POS_HEAD);
$this->registerJs($script_crop, \yii\web\View::POS_END);