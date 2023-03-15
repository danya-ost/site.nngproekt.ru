<?php

/** @var \yii\web\View $this */
/** @var \frontend\controllers\RbacController $user */
/** @var \frontend\controllers\RbacController $role */

$user_id = $user['user_id'];

$this->title = 'Назначение роли';
?>
<div class="container h-auto pb-24">
    <div class="w-full ha-auto mb-12">
        <a onclick="javascript:history.back(); return false;" class="inline-block align-middle px-2.5 py-2 mr-2 border-2 border-gray-800 text-gray-800 font-medium text-xs leading-tight uppercase rounded hover:bg-black hover:bg-opacity-5 focus:outline-none focus:ring-0 transition duration-150 ease-in-out">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 inline-block align-middle">
                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 12h-15m0 0l6.75 6.75M4.5 12l6.75-6.75" />
            </svg>
        </a>

        <h1 class="inline-block align-middle font-semibold text-2xl">
            Назначение роли
        </h1>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 gap-10 md:gap-x-28 gap-y-9">

        <div>
            <label for="name" class="font-light text-xs text-stone-500">
                Пользователь
            </label>
            <input type="text"
                   id="name"
                   name="name"
                   value="<?= $user['fullname'] ?> [<?= $user['job'] ?>]"
                   disabled
                   class="block w-full py-2 font-medium text-sm border-b border-solid border-b-stone-300 bg-[#F8F8F8] focus:border-b-main-red focus:outline-none">
        </div>

        <div>
            <label for="role" class="font-light text-xs text-stone-500">
                Назначенная роль
            </label>
            <select type="text"
                    name="role"
                    class="block w-full py-2 font-medium text-sm border-b border-solid border-b-stone-300 bg-[#F8F8F8] focus:border-b-main-red focus:outline-none">
                <option value="<?= $role['item_name'] ?>"><?= $role['item_name'] ?></option>
                <?php foreach ( \frontend\models\AuthItem::find()->where(['type' => 1])->andWhere(['!=', 'name', 'admin'])->all() as $item ): ?>
                    <?php if ( $item['name'] != $role['item_name'] ): ?>
                        <option value="<?= $item['name'] ?>"><?= $item['name'] ?></option>
                    <?php endif; ?>
                <?php endforeach; ?>
            </select>
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
    $('#btn_save').on('click', function (){
        $.ajax({
            url: '/frontend/web/rbac/update-role-user',
            type: 'post',
            dataType: 'html',
            data: { 'user_id': '$user_id', 'new_role': $('select[name=\'role\']').val() },
            beforeSend: function (){
                $('#btn_save').hide();
                $('#loader').show();  
            },
             success: function (response){
                getLogs('rbac', 'update-role', 'updating role for user: '+'$user_id$', 1, false);
                window.location.href = '/frontend/web/rbac/index';
            },
            error: function (response){
                getLogs('rbac', 'update-role', 'updating role for user: '+'$user_id', 0, response['responseText']);
                alert("Упс! Кажется произошла ошибка при загрузке данных. Пожалуйста, перезагрузите страницу или попробуйте позже!\\n\\nОтвет ошибки:\\n" + response['responseText']);
                console.log(response);
            }
        }); 
    });
JS;

$this->registerJs($script, \yii\web\View::POS_READY);