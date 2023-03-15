<?php

/** @var \yii\web\View $this */
/** @var \frontend\controllers\ProjectsController $customers */
/** @var \frontend\controllers\ProjectsController $groups */

use yii\helpers\Url;

$this->title = 'Добавление проекта'
?>
<div class="container h-auto">
    <div class="w-full ha-auto mb-12">
        <a onclick="javascript:history.back(); return false;" class="inline-block align-middle px-2.5 py-2 mr-2 border-2 border-gray-800 text-gray-800 font-medium text-xs leading-tight uppercase rounded hover:bg-black hover:bg-opacity-5 focus:outline-none focus:ring-0 transition duration-150 ease-in-out">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 inline-block align-middle">
                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 12h-15m0 0l6.75 6.75M4.5 12l6.75-6.75" />
            </svg>
        </a>

        <h1 class="inline-block align-middle font-semibold text-2xl">
            Добавление проекта
        </h1>
    </div>

    <div id="result" class="w-full" style="display: none;"></div>

    <form id="container" class="w-full h-auto max-w-[620px]">

        <label for="" class="block font-light text-xs text-stone-500 mb-4">Наименование проекта:</label>
        <textarea name="title" id="" placeholder="Введите наименование проекта" class="w-full h-auto bg-[#F8F8F8] text-left font-medium text-sm mb-8 border-b border-solid border-stone-300 pb-2 focus:outline-none focus:border-main-red"></textarea>

        <label for="" class="block font-light text-xs text-stone-500 mb-4">Заказчик:</label>
        <select name="customer" id="" class="w-full h-auto bg-[#F8F8F8] text-left font-medium text-sm mb-8 border-b border-solid border-stone-300 pb-2 focus:outline-none focus:border-main-red">
            <?php foreach ( $customers as $customer ): ?>
                <option value="<?= $customer['id'] ?>">
                    <?= $customer['name'] ?>
                </option>
            <?php endforeach; ?>
        </select>

        <label for="" class="block font-light text-xs text-stone-500 mb-4">Группа проекта:</label>
        <select name="group" id="" class="w-full h-auto bg-[#F8F8F8] text-left font-medium text-sm mb-8 border-b border-solid border-stone-300 pb-2 focus:outline-none focus:border-main-red">
            <?php foreach ( $groups as $group ): ?>
                <option value="<?= $group['id'] ?>">
                    <?= $group['name'] ?>
                </option>
            <?php endforeach; ?>
        </select>

        <label for="" class="block font-light text-xs text-stone-500 mb-4">№ договора Заказчика:</label>
        <input type="text" name="number_customer" placeholder="000-000-001" class="w-full h-auto bg-[#F8F8F8] text-left font-medium text-sm mb-8 border-b border-solid border-stone-300 pb-2 focus:outline-none focus:border-main-red">

        <label for="" class="block font-light text-xs text-stone-500 mb-4">№ договора внутренний:</label>
        <input type="text" name="number_in" placeholder="000-000-001" class="w-full h-auto bg-[#F8F8F8] text-left font-medium text-sm mb-8 border-b border-solid border-stone-300 pb-2 focus:outline-none focus:border-main-red">

        <label for="" class="block font-light text-xs text-stone-500 mb-4">Дата заключения договора:</label>
        <input type="text" name="date" placeholder="2021-2022" class="w-full h-auto bg-[#F8F8F8] text-left font-medium text-sm mb-8 border-b border-solid border-stone-300 pb-2 focus:outline-none focus:border-main-red">

        <label for="" class="block font-light text-xs text-stone-500 mb-4">Примечания:</label>
        <textarea name="text" id="" placeholder="Введите описание" class="w-full h-auto bg-[#F8F8F8] text-left font-medium text-sm border-b border-solid border-stone-300 pb-2 focus:outline-none focus:border-main-red"></textarea>

        <div class="w-full h-auto my-5 block sm:flex items-stretch justify-start">
            <button type="button" id="sendingForm" class="inline-block align-middle rounded px-6 py-2.5 ml-1 bg-gray-800 text-white font-medium text-xs leading-tight uppercase shadow-md hover:bg-gray-900 hover:shadow-lg focus:bg-gray-900 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-gray-900 active:shadow-lg transition duration-150 ease-in-out">
                СОХРАНИТЬ
            </button>

            <div id="loader" class="w-full h-auto flex items-center justify-start" style="display: none;">
                <div class="spinner-border animate-spin inline-block w-10 h-10 border-4 rounded-full text-main-red mb-24" role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>
            </div>
        </div>

    </form>

</div>
<?php
$script = <<<JS
    let inputs = { title: $('textarea[name=\'title\']'), customer: $('select[name=\'customer\']'), group: $('select[name=\'group\']'), number_customer: $('input[name=\'number_customer\']'), number_in: $('input[name=\'number_in\']'), date: $('input[name=\'date\']'), text: $('textarea[name=\'text\']') }
    let e = { container: $('#container'), container_result: $('#result'), loader: $('#loader'), btn_send: $('#sendingForm') }
    
    e.btn_send.on('click', function (){
        $.ajax({
            url: '/frontend/web/projects/add-projects',
            type: 'post',
            dataType: 'html',
            data: { 'title': inputs.title.val(), 'customer': inputs.customer.val(), 'group': inputs.group.val(), 'number_customer': inputs.number_customer.val(), 'number_in': inputs.number_in.val(), 'date': inputs.date.val(), 'text': inputs.text.val() },
            beforeSend: function (){
                e.btn_send.hide();
                e.loader.show();
            },
            success: function (response){
                e.container.hide();
                e.container_result.html(response).show();
                e.loader.hide();
                $('html, body').animate({ scrollTop: 0 }, 1000);
            }, 
            error: function (response){
                alert("Упс! Кажется произошла ошибка при загрузке данных. Пожалуйста, перезагрузите страницу или попробуйте позже!\\n\\nОтвет ошибки:\\n" + response['responseText']);
                console.log(response);
            }
        }); 
    });
    
JS;

$this->registerJs($script, \yii\web\View::POS_READY);
