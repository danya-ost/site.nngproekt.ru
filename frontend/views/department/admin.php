<?php

/** @var \yii\web\View $this */
/** @var \frontend\controllers\DepartmentController $top */
/** @var \frontend\controllers\DepartmentController $middle */
/** @var \frontend\controllers\DepartmentController $bottom */
/** @var \frontend\controllers\DepartmentController $director */

use yii\helpers\Url;

$this->title = 'Управление департаментами';
?>
<div class="container h-auto pb-24">
    <div class="w-full ha-auto mb-12">
        <a onclick="javascript:history.back(); return false;" class="inline-block align-middle px-2.5 py-2 mr-2 border-2 border-gray-800 text-gray-800 font-medium text-xs leading-tight uppercase rounded hover:bg-black hover:bg-opacity-5 focus:outline-none focus:ring-0 transition duration-150 ease-in-out">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 inline-block align-middle">
                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 12h-15m0 0l6.75 6.75M4.5 12l6.75-6.75" />
            </svg>
        </a>

        <h1 class="inline-block align-middle font-semibold text-2xl">
            Структура компании
        </h1>
    </div>

    <div class="w-full h-auto bg-main-milk px-6 py-9 relative">
        <button type="button" data-bs-toggle="modal" data-bs-target="#modalAddDirector" class="text-xs text-stone-500 hover:text-black hover:font-bold block absolute top-4 right-4">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-3 h-3 inline-block align-middle">
                <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L6.832 19.82a4.5 4.5 0 01-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 011.13-1.897L16.863 4.487zm0 0L19.5 7.125" />
            </svg>
            <span class="inline-block align-middle">Изменить</span>
        </button>
        <div class="inline-block align-middle pr-6 relative">
            <div class="w-[120px] sm:w-[160px] h-[120px] sm:h-[160px] rounded-full bg-no-repeat bg-cover bg-center" style="background-image: url('/frontend/web/<?= $director['avatar'] ?>');"></div>
        </div>
        <div class="inline-block align-middle">
            <h1 class="font-light text-xl text-main-red mb-1">
                Генеральный директор
            </h1>
            <h2 class="font-medium text-sm text-black mb-3">
                <?= $director['fullname'] ?>
            </h2>

            <div class="mb-3">
                <div class="inline-block align-middle mr-2">
                    <svg width="21" height="21" viewBox="0 0 21 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M20.8149 4.17212L14.446 10.5L20.8149 16.8278C20.93 16.5872 20.9999 16.3212 20.9999 16.0371V4.96286C20.9999 4.67874 20.93 4.41276 20.8149 4.17212Z" fill="#868686"/>
                        <path d="M19.1543 3.11719H1.84567C1.56156 3.11719 1.29557 3.18704 1.05493 3.30217L9.19502 11.4012C9.91476 12.121 11.0852 12.121 11.8049 11.4012L19.945 3.30217C19.7044 3.18704 19.4384 3.11719 19.1543 3.11719Z" fill="#868686"/>
                        <path d="M0.18498 4.17212C0.0698496 4.41276 0 4.67874 0 4.96286V16.0371C0 16.3212 0.0698496 16.5872 0.18498 16.8278L6.55385 10.5L0.18498 4.17212Z" fill="#868686"/>
                        <path d="M13.5761 11.3699L12.6749 12.2712C11.4756 13.4704 9.52425 13.4704 8.32499 12.2712L7.4238 11.3699L1.05493 17.6978C1.29557 17.8129 1.56156 17.8828 1.84567 17.8828H19.1543C19.4384 17.8828 19.7044 17.8129 19.945 17.6978L13.5761 11.3699Z" fill="#868686"/>
                    </svg>
                </div>
                <a href="mailto:<?= $director['email'] ?>" class="font-medium text-sm text-stone-400 inline-block align-middle">
                    <?= $director['email'] ?>
                </a>
            </div>

            <div>
                <div class="inline-block align-middle mr-2">
                    <svg width="21" height="21" viewBox="0 0 21 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M16.6934 0H4.30664C1.93196 0 0 1.93196 0 4.30664V16.6934C0 19.068 1.93196 21 4.30664 21H16.6934C19.068 21 21 19.068 21 16.6934V4.30664C21 1.93196 19.068 0 16.6934 0ZM16.05 15.1712L15.7205 15.7204C14.4391 17.0018 11.063 15.7033 8.17983 12.8202C5.29668 9.93702 3.99816 6.56098 5.27957 5.27953L5.82877 4.95001C6.32633 4.6515 6.97171 4.81281 7.27022 5.31038L8.0478 6.6063C8.29586 7.0197 8.23069 7.54884 7.88981 7.88977C7.40927 8.37031 7.40927 9.1494 7.88981 9.62989L11.3701 13.1102C11.8506 13.5907 12.6297 13.5907 13.1102 13.1102C13.4511 12.7693 13.9803 12.7041 14.3937 12.9522L15.6896 13.7297C16.1871 14.0283 16.3485 14.6737 16.05 15.1712Z" fill="#868686"/>
                    </svg>
                </div>
                <div class="font-medium text-sm text-stone-400 inline-block align-middle">
                    <?= $director['telephone'] ?>
                </div>
            </div>
        </div>
    </div>

    <div class="mt-10">
        <h1 class="font-bold text-lg italic inline-block align-middle">Департаменты</h1>
        <a href="<?= Url::to(['/department/add-form', 't' => 't']) ?>" class="text-xs text-stone-500 hover:text-black hover:font-bold block inline-block align-middle md:float-right">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-3 h-3 inline-block align-middle">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
            </svg>
            <span class="inline-block align-middle">Добавить</span>
        </a>
    </div>
    <div class="flex flex-col">
        <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="py-2 inline-block min-w-full sm:px-6 lg:px-8">
                <div class="overflow-hidden">
                    <table class="min-w-full border">
                        <thead class="border-b">
                            <tr class="bg-main-red text-white">
                                <th scope="col" class="text-sm font-medium px-6 py-2 border-r">
                                    #
                                </th>
                                <th scope="col" class="text-sm font-medium px-6 py-2 border-r">
                                    Наименование
                                </th>
                                <th scope="col" class="text-sm font-medium px-6 py-2 border-r">
                                    Сокращение
                                </th>
                                <th scope="col" class="text-sm font-medium px-6 py-2">
                                    Функции
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ( $top as $index => $item ): ?>
                                <tr class="border-b hover:bg-stone-200">
                                    <td class="text-sm px-4 py-1 whitespace-nowrap border-r">
                                        <?= $index + 1 ?>
                                    </td>
                                    <td class="text-sm px-4 py-1 whitespace-nowrap border-r">
                                        <?= $item['title'] ?>
                                    </td>
                                    <td class="text-sm px-4 py-1 whitespace-nowrap border-r">
                                        <?= $item['abbreviation'] ?>
                                    </td>
                                    <td class="text-sm px-4 py-1 whitespace-nowrap">
                                        <a href="<?= Url::to(['/department/update-form', 'd' => $item['id'], 't' => 't']) ?>" class="text-xs text-stone-500 hover:text-black hover:font-bold block">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-3 h-3 inline-block align-middle">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L6.832 19.82a4.5 4.5 0 01-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 011.13-1.897L16.863 4.487zm0 0L19.5 7.125" />
                                            </svg>
                                            <span class="inline-block align-middle">Изменить</span>
                                        </a>
                                        <button type="button" name="delete_item_t_<?= $item['id'] ?>" class="text-xs text-stone-500 hover:text-black hover:font-bold block">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-3 h-3 inline-block align-middle">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                            </svg>
                                            <span class="inline-block align-middle">Удалить</span>
                                        </button>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="mt-10">
        <h1 class="font-bold text-lg italic inline-block align-middle">Подразделения</h1>
        <a href="<?= Url::to(['/department/add-form', 't' => 'm']) ?>" class="text-xs text-stone-500 hover:text-black hover:font-bold block inline-block align-middle md:float-right">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-3 h-3 inline-block align-middle">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
            </svg>
            <span class="inline-block align-middle">Добавить</span>
        </a>
    </div>
    <div class="flex flex-col">
        <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="py-2 inline-block min-w-full sm:px-6 lg:px-8">
                <div class="overflow-hidden">
                    <table class="min-w-full border">
                        <thead class="border-b">
                        <tr class="bg-main-red text-white">
                            <th scope="col" class="text-sm font-medium px-6 py-2 border-r">
                                #
                            </th>
                            <th scope="col" class="text-sm font-medium px-6 py-2 border-r">
                                Наименование
                            </th>
                            <th scope="col" class="text-sm font-medium px-6 py-2 border-r">
                                Сокращение
                            </th>
                            <th scope="col" class="text-sm font-medium px-6 py-2">
                                Функции
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ( $middle as $index => $item ): ?>
                            <tr class="border-b hover:bg-stone-200">
                                <td class="text-sm px-4 py-1 whitespace-nowrap border-r">
                                    <?= $index + 1 ?>
                                </td>
                                <td class="text-sm px-4 py-1 whitespace-nowrap border-r">
                                    <?= $item['title'] ?>
                                </td>
                                <td class="text-sm px-4 py-1 whitespace-nowrap border-r">
                                    <?= $item['abbreviation'] ?>
                                </td>
                                <td class="text-sm px-4 py-1 whitespace-nowrap">
                                    <a href="<?= Url::to(['/department/update-form', 'd' => $item['id'], 't' => 'm']) ?>" class="text-xs text-stone-500 hover:text-black hover:font-bold block">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-3 h-3 inline-block align-middle">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L6.832 19.82a4.5 4.5 0 01-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 011.13-1.897L16.863 4.487zm0 0L19.5 7.125" />
                                        </svg>
                                        <span class="inline-block align-middle">Изменить</span>
                                    </a>
                                    <button type="button" name="delete_item_m_<?= $item['id'] ?>" class="text-xs text-stone-500 hover:text-black hover:font-bold block">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-3 h-3 inline-block align-middle">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                        </svg>
                                        <span class="inline-block align-middle">Удалить</span>
                                    </button>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="mt-10">
        <h1 class="font-bold text-lg italic inline-block align-middle">Отделы</h1>
        <a href="<?= Url::to(['/department/add-form', 't' => 'b']) ?>" class="text-xs text-stone-500 hover:text-black hover:font-bold block inline-block align-middle md:float-right">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-3 h-3 inline-block align-middle">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
            </svg>
            <span class="inline-block align-middle">Добавить</span>
        </a>
    </div>
    <div class="flex flex-col">
        <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="py-2 inline-block min-w-full sm:px-6 lg:px-8">
                <div class="overflow-hidden">
                    <table class="min-w-full border">
                        <thead class="border-b">
                        <tr class="bg-main-red text-white">
                            <th scope="col" class="text-sm font-medium px-6 py-2 border-r">
                                #
                            </th>
                            <th scope="col" class="text-sm font-medium px-6 py-2 border-r">
                                Наименование
                            </th>
                            <th scope="col" class="text-sm font-medium px-6 py-2 border-r">
                                Сокращение
                            </th>
                            <th scope="col" class="text-sm font-medium px-6 py-2">
                                Функции
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ( $bottom as $index => $item ): ?>
                            <tr class="border-b hover:bg-stone-200">
                                <td class="text-sm px-4 py-1 whitespace-nowrap border-r">
                                    <?= $index + 1 ?>
                                </td>
                                <td class="text-sm px-4 py-1 whitespace-nowrap border-r">
                                    <?= $item['title'] ?>
                                </td>
                                <td class="text-sm px-4 py-1 whitespace-nowrap border-r">
                                    <?= $item['abbreviation'] ?>
                                </td>
                                <td class="text-sm px-4 py-1 whitespace-nowrap">
                                    <a href="<?= Url::to(['/department/update-form', 'd' => $item['id'], 't' => 'b']) ?>" class="text-xs text-stone-500 hover:text-black hover:font-bold block">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-3 h-3 inline-block align-middle">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L6.832 19.82a4.5 4.5 0 01-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 011.13-1.897L16.863 4.487zm0 0L19.5 7.125" />
                                        </svg>
                                        <span class="inline-block align-middle">Изменить</span>
                                    </a>
                                    <button type="button" name="delete_item_b_<?= $item['id'] ?>" class="text-xs text-stone-500 hover:text-black hover:font-bold block">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-3 h-3 inline-block align-middle">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                        </svg>
                                        <span class="inline-block align-middle">Удалить</span>
                                    </button>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
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
                    Вы уверены, что хотите удалить эту запись?
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

<div class="modal fade fixed top-0 left-0 hidden w-full h-full outline-none overflow-x-hidden overflow-y-auto" id="modalAddDirector" tabindex="-1" aria-labelledby="exampleModalCenterTitle" aria-modal="true" role="dialog">
    <div class="modal-dialog modal-dialog-centered relative w-auto pointer-events-none">
        <div class="modal-content border-none shadow-lg relative flex flex-col w-full pointer-events-auto bg-white bg-clip-padding outline-none text-current">
            <div class="modal-header flex flex-shrink-0 items-center justify-between p-4 border-b border-gray-200">
                <h5 class="text-xl font-medium leading-normal text-gray-800" id="exampleModalScrollableLabel">
                    Главный директор
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
    let delete_type, delete_id;
    $('button[name^=\'delete_item_\']').on('click', function (){
        delete_type = $(this).attr('name').replace('delete_item_', '')[0],
        delete_id =  $(this).attr('name').replace('delete_item_', '').replace(delete_type+'_', '');
        $('#openDelete').trigger('click');
    });

    $('#btnDelete').on('click', function (){
        $.ajax({
            url: '/frontend/web/department/delete',
            type: 'post',
            dataType: 'html',
            data: { 'delete_type': delete_type, 'delete_id': delete_id },
            success: function (response){
                getLogs('department', 'delete', 'logical deleting department from id: '+'delete_id', 1, false);
                window.location.reload();
            },
            error: function (response){
                getLogs('department', 'delete', 'logical deleting department from id: '+'delete_id', 0, response['responseText']);
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
            url: '/frontend/web/department/add-director',
            type: 'post',
            dataType: 'html',
            data: { 'director_id': director_id  },
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