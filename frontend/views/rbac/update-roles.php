<?php

/** @var \yii\web\View $this */
/** @var \frontend\controllers\RbacController $modelAI */
/** @var \frontend\controllers\RbacController $data */
/** @var \frontend\controllers\RbacController $data_set */

$role = $_GET['role'];
$this->title = 'Добавление роли';
?>
<div class="container h-auto pb-24">
    <div class="w-full ha-auto mb-12">
        <a onclick="javascript:history.back(); return false;" class="inline-block align-middle px-2.5 py-2 mr-2 border-2 border-gray-800 text-gray-800 font-medium text-xs leading-tight uppercase rounded hover:bg-black hover:bg-opacity-5 focus:outline-none focus:ring-0 transition duration-150 ease-in-out">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 inline-block align-middle">
                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 12h-15m0 0l6.75 6.75M4.5 12l6.75-6.75" />
            </svg>
        </a>

        <h1 class="inline-block align-middle font-semibold text-2xl">
            Редактирование роли
        </h1>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 gap-10 md:gap-x-28 gap-y-9">

        <div>
            <label for="name" class="font-light text-xs text-stone-500">
                Ключ роли (латиницей) - изменение невозможно
            </label>
            <input type="text"
                   id="name"
                   name="name"
                   placeholder="Пример: admin_news"
                   disabled
                   value="<?= $modelAI['name'] ?>"
                   class="block w-full py-2 font-medium text-sm border-b border-solid border-b-stone-300 bg-gray-100 shadow focus:border-b-main-red focus:outline-none">
        </div>

        <div>
            <label for="description" class="font-light text-xs text-stone-500">
                Описание роли
            </label>
            <input type="text"
                   name="description"
                   placeholder="Введите описание роли..."
                   value="<?= $modelAI['description'] ?>"
                   class="block w-full py-2 font-medium text-sm border-b border-solid border-b-stone-300 bg-[#F8F8F8] focus:border-b-main-red focus:outline-none">
        </div>

    </div>

    <div class="grid grid-cols-2 grid-rows-[auto_auto] gap-10 md:gap-x-28 mt-10">
        <div class="font-bold text-base text-center">
            Доступные правила >>>
        </div>
        <div class="font-bold text-base text-center">
            >>> Примененные правила
        </div>
        <div id="ai" class="bg-white border border-solid border-stone-300 text-main-red">
            <?php foreach ( $data as $item ): ?>
                <button type="button" name="selected_roles_<?= $item['name'] ?>" class="w-full border-b border-solid border-stone-300 last:border-none text-left px-2 py-1 font-bold text-xs hover:bg-stone-100">
                    <?= $item['description'] ?>
                </button>
            <?php endforeach; ?>
        </div>
        <div id="set_ai" class="bg-white border border-solid border-stone-300 text-green-500">
            <?php foreach ( $data_set as $item ): ?>
                <button type="button" name="selected_roles_<?= $item['name'] ?>" class="w-full border-b border-solid border-stone-300 last:border-none text-left px-2 py-1 font-bold text-xs hover:bg-stone-100">
                    <?= $item['description'] ?>
                </button>
            <?php endforeach; ?>
        </div>
    </div>

    <div class="mt-10 flex items-center justify-end">
        <button type="button" id="btn_save" class="inline-block align-middle rounded px-6 py-2.5 bg-gray-800 text-white font-medium text-xs leading-tight uppercase shadow-md hover:bg-gray-900 hover:shadow-lg focus:bg-gray-900 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-gray-900 active:shadow-lg transition duration-150 ease-in-out">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 inline-block align-middle">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
            </svg>
            <span class="ml-1 inline-block align-middle">Сохранить</span>
        </button>
    </div>

    <div id="loader" style="display: none;" class="w-full h-auto flex items-center justify-center py-10">
        <div class="spinner-border animate-spin inline-block w-10 h-10 border-4 rounded-full text-main-red mb-24" role="status">
            <span class="visually-hidden">Loading...</span>
        </div>
    </div>

</div>

<?php
$script = <<<JS
    $('#ai').on('click', 'button[name^=\'selected_roles_\']', function (){
        $(this).appendTo($('#set_ai')); 
    });
    $('#set_ai').on('click', 'button[name^=\'selected_roles_\']', function (){
        $(this).appendTo($('#ai'));
    });
    
    $('#btn_save').on('click', function (){
        let set_ai = [];
        $('#set_ai > button[name^=\'selected_roles_\']').each(function (){
            set_ai.push($(this).attr('name').replace('selected_roles_', ''));
        });
        $.ajax({
            url: '/frontend/web/rbac/update-roles',
            type: 'post',
            dataType: 'html',
            data: { 'role': '$role', 'name': $('input[name=\'name\']').val(), 'description': $('input[name=\'description\']').val(), 'set_ai': set_ai },
            beforeSend: function (){
                $('#btn_save').hide();
                $('#loader').show();  
            },
             success: function (response){
                getLogs('rbac', 'update', 'updating role to database: '+'$role', 1, false);
                window.location.reload();
            },
            error: function (response){
                getLogs('rbac', 'update', 'updating role to database: '+'$role', 0, response['responseText']);
                alert("Упс! Кажется произошла ошибка при загрузке данных. Пожалуйста, перезагрузите страницу или попробуйте позже!\\n\\nОтвет ошибки:\\n" + response['responseText']);
                console.log(response);
            }
        });
    });
JS;

$this->registerJs($script, \yii\web\View::POS_READY);