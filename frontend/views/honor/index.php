<?php

/** @var \yii\web\View $this */
/** @var \frontend\controllers\DepartmentController $data */

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
            Доска почета
        </h1>
    </div>

    <div class="mt-10">
        <h1 class="font-bold text-lg italic inline-block align-middle">Размещенные сотрудники</h1>
        <a href="<?= Url::to(['/honor/add-form', 't' => 't']) ?>" class="text-xs text-stone-500 hover:text-black hover:font-bold block inline-block align-middle md:float-right">
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
                                    ФИО
                                </th>
                                <th scope="col" class="text-sm font-medium px-6 py-2 border-r">
                                    Должность
                                </th>
                                <th scope="col" class="text-sm font-medium px-6 py-2 border-r">
                                    Обоснование
                                </th>
                                <th scope="col" class="text-sm font-medium px-6 py-2">
                                    Функции
                                </th>
                            </tr>
                        </thead>
                        <tbody id="container">
                            <?php foreach ( $data as $index => $item ): ?>
                                <tr class="border-b hover:bg-stone-200">
                                    <td class="text-sm px-4 py-1 whitespace-nowrap border-r">
                                        <?= $index + 1 ?>
                                    </td>
                                    <td class="text-sm px-4 py-1 whitespace-nowrap border-r">
                                        <?= \frontend\models\UserData::find()->where(['user_id' => $item['user_id']])->one()['fullname'] ?>
                                    </td>
                                    <td class="text-sm px-4 py-1 whitespace-nowrap border-r">
                                        <?= \frontend\models\UserData::find()->where(['user_id' => $item['user_id']])->one()['job'] ?>
                                    </td>
                                    <td class="text-sm px-4 py-1 whitespace-nowrap border-r">
                                        <?= $item['text'] ?>
                                    </td>
                                    <td class="text-sm px-4 py-1 whitespace-nowrap">
                                        <button type="button" name="delete_item_<?= $item['honor_id'] ?>" class="text-xs text-stone-500 hover:text-black hover:font-bold block">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-3 h-3 inline-block align-middle">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                            </svg>
                                            <span class="inline-block align-middle">Удалить</span>
                                        </button>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                            <?php if ( count($data) == 0 ): ?>
                                <tr class="col-span-5">
                                    <td class="text-sm px-4 py-1 whitespace-nowrap font-bold text-sm">
                                        Ничего не найдено...
                                    </td>
                                </tr>
                            <?php endif; ?>
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
            url: '/frontend/web/honor/delete-honor',
            type: 'post',
            dataType: 'html',
            data: { 'delete_id': delete_id },
            success: function (response){
                window.location.reload();
            },
            error: function (response){
                alert("Упс! Кажется произошла ошибка при загрузке данных. Пожалуйста, перезагрузите страницу или попробуйте позже!\\n\\nОтвет ошибки:\\n" + response['responseText']);
                console.log(response);
            }
        });
    });
JS;

$this->registerJs($script, \yii\web\View::POS_READY);