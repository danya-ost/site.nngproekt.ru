<?php

/** @var \yii\web\View $this */
/** @var \frontend\controllers\DepartmentController $data */
/** @var \frontend\controllers\DepartmentController $dataDM */
/** @var \frontend\controllers\DepartmentController $dataDB */
/** @var \frontend\controllers\DepartmentController $children */
/** @var \frontend\controllers\DepartmentController $supervisor */

$bottoms = isset($data['bottoms']) ? $data['bottoms'] : 2;
$id = $data['id'];
$type = $data['type'];

$this->title = $data['title'];
?>
<div class="container h-auto">
    <div class="w-full ha-auto mb-12">
        <a onclick="javascript:history.back(); return false;" class="inline-block align-middle px-2.5 py-2 mr-2 border-2 border-gray-800 text-gray-800 font-medium text-xs leading-tight uppercase rounded hover:bg-black hover:bg-opacity-5 focus:outline-none focus:ring-0 transition duration-150 ease-in-out">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 inline-block align-middle">
                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 12h-15m0 0l6.75 6.75M4.5 12l6.75-6.75" />
            </svg>
        </a>

        <h1 class="inline-block align-middle font-semibold text-2xl">
            <?php
                if ( $data['type'] == 'top' ){
                    echo 'Департамент компании';
                } elseif ( $data['type'] == 'middle' ){
                    echo 'Подразделение компании';
                } else{
                    echo 'Отдел компании';
                }
            ?>
        </h1>
    </div>

    <?php if ( $data['type'] != 'bottom' ): ?>
        <div class="w-full h-auto bg-main-milk px-6 py-9 mb-10 relative">
            <button type="button" data-bs-toggle="modal" data-bs-target="#modalAddDirector" class="text-xs text-stone-500 hover:text-black hover:font-bold block absolute top-4 right-4">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-3 h-3 inline-block align-middle">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L6.832 19.82a4.5 4.5 0 01-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 011.13-1.897L16.863 4.487zm0 0L19.5 7.125" />
                </svg>
                <span class="inline-block align-middle">Изменить</span>
            </button>
            <div class="inline-block align-middle pr-6 relative">
                <div class="w-[120px] sm:w-[160px] h-[120px] sm:h-[160px] rounded-full bg-no-repeat bg-cover bg-center" style="background-image: url('/frontend/web/<?= $supervisor ? $supervisor['avatar'] : 'image/elements/user.png' ?>');"></div>
            </div>
            <div class="inline-block align-middle">
                <h1 class="font-light text-xl text-main-red mb-1">
                    Руководитель <?= $data['type'] == 'top' ? 'департамента' : 'подразделения' ?>
                </h1>
                <h2 class="font-medium text-sm text-black mb-3">
                    <?php if ( $supervisor ): ?>
                        <?= $supervisor['fullname'] ?>
                    <?php else: ?>
                        <span class="font-bold text-main-red uppercase text-lg">Не назначен</span>
                    <?php endif; ?>
                </h2>

                <?php if ( $supervisor ): ?>
                    <div class="mb-3">
                        <div class="inline-block align-middle mr-2">
                            <svg width="21" height="21" viewBox="0 0 21 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M20.8149 4.17212L14.446 10.5L20.8149 16.8278C20.93 16.5872 20.9999 16.3212 20.9999 16.0371V4.96286C20.9999 4.67874 20.93 4.41276 20.8149 4.17212Z" fill="#868686"/>
                                <path d="M19.1543 3.11719H1.84567C1.56156 3.11719 1.29557 3.18704 1.05493 3.30217L9.19502 11.4012C9.91476 12.121 11.0852 12.121 11.8049 11.4012L19.945 3.30217C19.7044 3.18704 19.4384 3.11719 19.1543 3.11719Z" fill="#868686"/>
                                <path d="M0.18498 4.17212C0.0698496 4.41276 0 4.67874 0 4.96286V16.0371C0 16.3212 0.0698496 16.5872 0.18498 16.8278L6.55385 10.5L0.18498 4.17212Z" fill="#868686"/>
                                <path d="M13.5761 11.3699L12.6749 12.2712C11.4756 13.4704 9.52425 13.4704 8.32499 12.2712L7.4238 11.3699L1.05493 17.6978C1.29557 17.8129 1.56156 17.8828 1.84567 17.8828H19.1543C19.4384 17.8828 19.7044 17.8129 19.945 17.6978L13.5761 11.3699Z" fill="#868686"/>
                            </svg>
                        </div>
                        <a href="mailto:<?= $supervisor['email'] ?>" class="font-medium text-sm text-stone-400 inline-block align-middle">
                            <?= $supervisor['email'] ?>
                        </a>
                    </div>

                    <div>
                        <div class="inline-block align-middle mr-2">
                            <svg width="21" height="21" viewBox="0 0 21 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M16.6934 0H4.30664C1.93196 0 0 1.93196 0 4.30664V16.6934C0 19.068 1.93196 21 4.30664 21H16.6934C19.068 21 21 19.068 21 16.6934V4.30664C21 1.93196 19.068 0 16.6934 0ZM16.05 15.1712L15.7205 15.7204C14.4391 17.0018 11.063 15.7033 8.17983 12.8202C5.29668 9.93702 3.99816 6.56098 5.27957 5.27953L5.82877 4.95001C6.32633 4.6515 6.97171 4.81281 7.27022 5.31038L8.0478 6.6063C8.29586 7.0197 8.23069 7.54884 7.88981 7.88977C7.40927 8.37031 7.40927 9.1494 7.88981 9.62989L11.3701 13.1102C11.8506 13.5907 12.6297 13.5907 13.1102 13.1102C13.4511 12.7693 13.9803 12.7041 14.3937 12.9522L15.6896 13.7297C16.1871 14.0283 16.3485 14.6737 16.05 15.1712Z" fill="#868686"/>
                            </svg>
                        </div>
                        <div class="font-medium text-sm text-stone-400 inline-block align-middle">
                            <?= $supervisor['telephone'] ?>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    <?php endif; ?>

    <div class="grid grid-cols-1 sm:grid-cols-2 gap-10 md:gap-x-28 gap-y-9">

        <div>
            <label for="title" class="font-light text-xs text-stone-500">
                Наименование
            </label>
            <input type="text"
                   id="title"
                   name="title"
                   value="<?= $data['title'] ?>"
                   class="block w-full py-2 font-medium text-sm border-b border-solid border-b-stone-300 bg-[#F8F8F8] focus:border-b-main-red focus:outline-none">
        </div>

        <div>
            <label for="telephone" class="font-light text-xs text-stone-500">
                Телефон
            </label>
            <input type="text"
                   name="telephone"
                   value="<?= $data['telephone'] ?>"
                   class="block w-full py-2 font-medium text-sm border-b border-solid border-b-stone-300 bg-[#F8F8F8] focus:border-b-main-red focus:outline-none">
        </div>

        <?php if ( !$children && isset($data['bottoms']) ): ?>
            <div>
                <div class="inline-block align-middle">
                    <h1 class="inline-block align-middle mr-2 font-light text-xs uppercase">
                        Подразделения
                    </h1>
                    <div class="inline-block align-middle form-check form-switch">
                        <input id="bottoms" name="bottoms" value="<?= $data['bottoms'] ?>" <?= $data['bottoms'] != 0 ? 'checked' : '' ?> class="form-check-input appearance-none w-10 -ml-10 rounded-full float-left h-5 align-top bg-white bg-no-repeat bg-contain bg-gray-300 focus:outline-none cursor-pointer shadow-sm checked:bg-main-red" type="checkbox" role="switch">
                    </div>
                    <h1 class="inline-block align-middle ml-2 font-light text-xs uppercase">
                        Отделы
                    </h1>
                </div>
            </div>
        <?php endif; ?>

    </div>

    <div>
        <div class="pt-6 pb-16">
            <?php if ( $data['type'] == 'top' ):  ?>
                <div class="flex items-center justify-center h-[90px] px-5 bg-main-red shadow-[0px_0px_10px_0px_#00000017] mb-6">
                    <h1 class="font-bold text-lg sm:text-xl lg:text-3xl text-white text-center">
                        <?= $data['title'] ?>
                    </h1>
                </div>
            <?php elseif ( $data['type'] == 'middle' ): ?>
                <div class="flex items-center justify-center h-[90px] bg-main-milk shadow-[0px_0px_10px_0px_#00000017] px-5 mb-6 hover:text-main-red duration-300 ease-in-out">
                    <h1 class="text-base md:text-2xl font-semibold">
                        <?= $data['title'] ?>
                    </h1>
                </div>
            <?php else: ?>
                <div class="flex items-center justify-center h-[90px] bg-white shadow-[0px_0px_10px_0px_#00000017] px-5 mb-6">
                    <h1 class="text-base md:text-2xl font-light">
                        <?= $data['title'] ?>
                    </h1>
                </div>
            <?php endif; ?>
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">
                <?php if ( isset($children) ): ?>
                    <?php foreach ( $children as $item ): ?>
                        <?php if ( $bottoms == 0 ): ?>
                            <div name="department_m_<?= $item['id'] ?>" class="flex items-center h-[90px] bg-main-milk shadow-[0px_0px_10px_0px_#00000017] px-7 hover:text-main-red duration-300 ease-in-out relative">
                                <h1 class="text-base md:text-2xl font-semibold">
                                    <?= $item['title'] ?>
                                </h1>
                                <button type="button" name="delete_department_m_<?= $item['id'] ?>" class="absolute top-4 right-4 text-black hover:text-main-red">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                    </svg>
                                </button>
                            </div>
                        <?php else: ?>
                            <div name="department_b_<?= $item['id'] ?>" class="flex items-center h-[90px] bg-white shadow-[0px_0px_10px_0px_#00000017] px-7 relative">
                                <h1 class="text-base md:text-2xl font-light">
                                    <?= $item['title'] ?>
                                </h1>
                                <button type="button" name="delete_department_b_<?= $item['id'] ?>" class="absolute top-4 right-4 text-black hover:text-main-red">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                    </svg>
                                </button>
                            </div>
                        <?php endif; ?>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
            <?php if ( $data['type'] != 'bottom' ): ?>
                <div class="grid grid-cols-1 gap-6">
                    <button type="button" data-bs-toggle="modal" data-bs-target="#modalAddElement" class="h-[90px] shadow-[0px_0px_5px_0px_#00000017_inset] border-2 border-dashed border-stone-200 hover:border-stone-700 px-7 text-stone-300 hover:text-stone-700 flex justify-center items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-10 h-10">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                        </svg>
                    </button>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<div id="notification" class="w-auto sm:w-96 fixed top-5 sm:top-auto right-2 sm:right-10 bottom-auto sm:bottom-5 left-2 sm:left-auto z-[9999]"></div>

<div class="modal fade fixed top-0 left-0 hidden w-full h-full outline-none overflow-x-hidden overflow-y-auto" id="modalAddElement" tabindex="-1" aria-labelledby="exampleModalScrollableLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable relative w-auto pointer-events-none">
        <div class="modal-content border-none shadow-lg relative flex flex-col w-full pointer-events-auto bg-white bg-clip-padding outline-none text-current">
            <div class="modal-header flex flex-shrink-0 items-center justify-between p-4 border-b border-gray-200">
                <h5 class="text-xl font-medium leading-normal text-gray-800" id="exampleModalScrollableLabel">
                    <?php
                        if ( $data['type'] == 'top' ){
                            echo 'Добваление элемента к департаменту';
                        } elseif ( $data['type'] == 'middle' ){
                            echo 'Добваление элемента к подразделению';
                        }
                    ?>
                </h5>
                <button type="button"
                        id="modelAddClose"
                        class="inline-block px-3 py-2.5 bg-transparent text-blue-600 font-medium text-xs leading-tight uppercase rounded hover:text-blue-700 hover:bg-gray-100 focus:bg-gray-100 focus:outline-none focus:ring-0 active:bg-gray-200 transition duration-150 ease-in-out"
                        data-bs-dismiss="modal" aria-label="Close">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 19.5l15-15m-15 0l15 15" />
                    </svg>
                </button>
            </div>
            <div class="modal-body relative p-4">
                <?php if ( isset($dataDM) ): ?>
                    <div id="middle_container" <?= $bottoms != 0 ? 'style="display: none;"' : '' ?> class="grid grid-cols-1 gap-6">
                        <?php foreach ( $dataDM as $item ): ?>
                            <button type="button" name="selected_department_m_<?= $item['id'] ?>" class="flex items-center h-[90px] bg-main-milk shadow-[0px_0px_10px_0px_#00000017] px-7 hover:text-main-red duration-300 ease-in-out">
                                <h1 class="text-base font-semibold">
                                    <?= $item['title'] ?>
                                </h1>
                            </button>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>

                <?php if ( isset($dataDB) ): ?>
                    <div id="bottom_container" <?= $bottoms == 0 ? 'style="display: none;"' : '' ?> class="grid grid-cols-1 gap-6">
                        <?php foreach ( $dataDB as $item ): ?>
                            <button type="button" name="selected_department_b_<?= $item['id'] ?>" class="flex items-center h-[90px] bg-main-milk shadow-[0px_0px_10px_0px_#00000017] px-7 hover:text-main-red duration-300 ease-in-out">
                                <h1 class="text-base font-semibold">
                                    <?= $item['title'] ?>
                                </h1>
                            </button>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            </div>
            <div class="modal-footer p-4 border-t border-gray-200 rounded-b-md">
                <div class="text-xs text-main-red italic">
                    Выберирите элемент для добавления в структуру. <br>
                    <hr class="my-4">
                    Если данный список пуст, то это означает что все подразделения или отделения уже используются в структуре!
                    Добавте новый департамент (подразделение или отделение) или открепить уже созданное подразделение (отдел).
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade fixed top-0 left-0 hidden w-full h-full outline-none overflow-x-hidden overflow-y-auto" id="modalAddDirector" tabindex="-1" aria-labelledby="exampleModalCenterTitle" aria-modal="true" role="dialog">
    <div class="modal-dialog modal-dialog-centered relative w-auto pointer-events-none">
        <div class="modal-content border-none shadow-lg relative flex flex-col w-full pointer-events-auto bg-white bg-clip-padding outline-none text-current">
            <div class="modal-header flex flex-shrink-0 items-center justify-between p-4 border-b border-gray-200">
                <h5 class="text-xl font-medium leading-normal text-gray-800" id="exampleModalScrollableLabel">
                    Руководитель
                </h5>
                <button type="button"
                        id="modelAddClose"
                        class="inline-block px-3 py-2.5 bg-transparent text-blue-600 font-medium text-xs leading-tight uppercase rounded hover:text-blue-700 hover:bg-gray-100 focus:bg-gray-100 focus:outline-none focus:ring-0 active:bg-gray-200 transition duration-150 ease-in-out"
                        data-bs-dismiss="modal" aria-label="Close">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 19.5l15-15m-15 0l15 15" />
                    </svg>
                </button>
            </div>
            <div class="modal-body relative p-4">
                <div>
                    <label for="user" class="font-light text-xs text-stone-500">
                        Сотрудки компании
                    </label>
                    <div class="relative">
                        <input type="text"
                               id="user"
                               name="user"
                               placeholder="Начните вводить фамилию..."
                               class="block w-full py-2 font-medium text-sm border-b border-solid border-b-stone-300 bg-white focus:border-b-main-red focus:outline-none">
                        <div id="user_container" style="display: none;" class="w-full h-auto absolute z-[999] top-full bg-white shadow-lg border-r border-b border-l border-solid border-stone-300"></div>
                        <div id="user_loader" style="display: none;" class="w-full h-auto absolute z-[999] top-full bg-white shadow-lg border-r border-b border-l border-solid border-stone-300">
                            <div class="w-full h-auto flex items-center justify-center p-1">
                                <div class="spinner-border animate-spin inline-block w-5 h-5 border-2 rounded-full text-main-red" role="status">
                                    <span class="visually-hidden">Loading...</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer flex flex-shrink-0 flex-wrap items-center justify-end p-4 border-t border-gray-200 rounded-b-md">
                <button type="button" id="btn_add_director" class="inline-block align-middle rounded px-6 py-2.5 ml-1 bg-gray-800 text-white font-medium text-xs leading-tight uppercase shadow-md hover:bg-gray-900 hover:shadow-lg focus:bg-gray-900 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-gray-900 active:shadow-lg transition duration-150 ease-in-out">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="inline-block align-middle w-4 h-4">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 13.5l10.5-11.25L12 10.5h8.25L9.75 21.75 12 13.5H3.75z" />
                    </svg>
                    <span class="ml-1 inline-block align-middle">Назначить</span>
                </button>
            </div>
        </div>
    </div>
</div>

<?php
$script = <<<JS
    let structure = '$bottoms'; 
    $('input[name=\'title\']').on('blur', function (){
        if ( $(this).val().length > 0 ){
            $.ajax({
                url: '/frontend/web/department/update-title',
                type: 'post',
                dataType: 'html',
                data: { 'id': '$id', 'type': '$type', 'title': $(this).val() },
                success: function (response){
                    $('#notification').append(response);
                    getLogs('department', 'update-title', 'updating title to database: '+'$id'.val(), 1, false);
                },
                error: function (response){
                    getLogs('department', 'update-title', 'updating title to database: '+'$id'.val(), 0, response['responseText']);
                    alert("Упс! Кажется произошла ошибка при загрузке данных. Пожалуйста, перезагрузите страницу или попробуйте позже!\\n\\nОтвет ошибки:\\n" + response['responseText']);
                    console.log(response);
                }
            });
        } else{
            return false;
        }
    });

    $('input[name=\'telephone\']').on('blur', function (){
        if ( $(this).val().length > 0 ){
            $.ajax({
                url: '/frontend/web/department/update-telephone',
                type: 'post',
                dataType: 'html',
                data: { 'id': '$id', 'type': '$type', 'telephone': $(this).val() },
                success: function (response){
                    $('#notification').append(response);
                    getLogs('department', 'update-telephone', 'updating telephone to database: '+'$id'.val(), 1, false);
                },
                error: function (response){
                    getLogs('department', 'update-telephone', 'updating telephone to database: '+'$id'.val(), 0, response['responseText']);
                    alert("Упс! Кажется произошла ошибка при загрузке данных. Пожалуйста, перезагрузите страницу или попробуйте позже!\\n\\nОтвет ошибки:\\n" + response['responseText']);
                    console.log(response);
                }
            });
        } else{
            return false;
        }
    });
    
    $('input[name=\'bottoms\']').on('input', function (){
        let value = $(this).val();
        $.ajax({
            url: '/frontend/web/department/update-bottoms',
            type: 'post',
            dataType: 'html',
            data: { 'id': '$id' },
            success: function (response){
                $('#notification').append(response);
                if ( structure == 0 ){
                    structure = 1;
                    $('#middle_container').hide();
                    $('#bottom_container').show();
                } else{
                    structure = 0;
                    $('#middle_container').show();
                    $('#bottom_container').hide();
                }
                getLogs('department', 'update-telephone', 'updating telephone to database: '+'$id', 1, false);
            },
            error: function (response){
                getLogs('department', 'update-telephone', 'updating telephone to database: '+'$id', 0, response['responseText']);
                alert("Упс! Кажется произошла ошибка при загрузке данных. Пожалуйста, перезагрузите страницу или попробуйте позже!\\n\\nОтвет ошибки:\\n" + response['responseText']);
                console.log(response);
            }
        });
    });
    
    let selected_type, selected_id;
    $('button[name^=\'selected_department_\']').on('click', function (){
        selected_type = $(this).attr('name').replace('selected_department_', '')[0];
        selected_id = $(this).attr('name').replace('selected_department_', '').replace(selected_type+'_', '');
        $.ajax({
            url: '/frontend/web/department/set-structure',
            type: 'post',
            dataType: 'html',
            data: { 'current_id': '$id', 'current_type': '$type', 'selected_type': selected_type, 'selected_id': selected_id },
            success: function (){
                getLogs('department', 'set-structuring', 'set structure from'+selected_id, 1, false);
                window.location.reload();
            },
            error: function (response){
                getLogs('department', 'set-structuring', 'set structure from'+selected_id, 0, response['responseText']);
                alert("Упс! Кажется произошла ошибка при загрузке данных. Пожалуйста, перезагрузите страницу или попробуйте позже!\\n\\nОтвет ошибки:\\n" + response['responseText']);
                console.log(response);
            }
        });
    });
    
    let delete_type, delete_id;
    $('button[name^=\'delete_department_\']').on('click', function (){
        delete_type = $(this).attr('name').replace('delete_department_', '')[0];
        delete_id = $(this).attr('name').replace('delete_department_', '').replace(delete_type+'_', '');
        $.ajax({
            url: '/frontend/web/department/remove-structure',
            type: 'post',
            dataType: 'html',
            data: { 'delete_type': delete_type, 'delete_id': delete_id },
            success: function (response){
                getLogs('department', 'remove-structuring', 'remove structure from'+selected_id, 1, false);
                window.location.reload();
            },
            error: function (response){
                getLogs('department', 'remove-structuring', 'remove structure from'+selected_id, 0, response['responseText']);
                alert("Упс! Кажется произошла ошибка при загрузке данных. Пожалуйста, перезагрузите страницу или попробуйте позже!\\n\\nОтвет ошибки:\\n" + response['responseText']);
                console.log(response);
            }
        });
    });
    
    $('input[name=\'user\']').bind('input, keyup', function (){
        let value = $(this).val();
        let setAjax = $.ajax();
        if ( value.length > 3 ){
            setAjax.abort();
            $.ajax({
                url: '/frontend/web/initiative/users-search',
                type: 'post',
                dataType: 'html',
                data: { 'value': value },
                beforeSend: function (){
                    $('#user_loader').show();
                    $('#user_container').hide();
                },
                success: function (response){
                    $('#user_loader').hide();
                    $('#user_container').html(response).show();
                    getLogs('department => initiative', 'searching', 'searching on users data - '+value, 1, false);
                },
                error: function (response){
                    getLogs('department => initiative', 'searching', 'searching on users data - '+value, 0, response['responseText']);
                    alert("Упс! Кажется произошла ошибка при загрузке данных. Пожалуйста, перезагрузите страницу или попробуйте позже!\\n\\nОтвет ошибки:\\n" + response['responseText']);
                    console.log(response);
                }
            });
        } else{
            $('#user_loader').hide();
            $('#user_container').hide();
        }
    });
    
    let director_id = false, director_content;
    $('#user_container').on('click', 'button[name^=\'selected_user_id_\']', function (){
        director_id = $(this).attr('name').replace('selected_user_id_', '');
        director_content = $(this).text().trim();
        $('input[name=\'user\']').val(director_content);
        $('#user_container').hide();
    });
    
    $('#btn_add_director').on('click', function (){
        if ( director_id == false ) return false;
        $.ajax({
            url: '/frontend/web/department/add-supervisor',
            type: 'post',
            dataType: 'html',
            data: { 'director_id': director_id, 'id': '$id', 'type': '$type'  },
            beforeSend: function (){
                $(this).hide();
            },
            success: function (){
                getLogs('department', 'add-director', 'adding new director: '+director_id, 1, false);
                window.location.reload();
            },
            error: function (response){
                getLogs('department', 'add-director', 'adding new director: '+director_id, 0, response['responseText']);
                alert("Упс! Кажется произошла ошибка при загрузке данных. Пожалуйста, перезагрузите страницу или попробуйте позже!\\n\\nОтвет ошибки:\\n" + response['responseText']);
                console.log(response);
            }
        });
    });
    
JS;

$this->registerJs($script, \yii\web\View::POS_READY);