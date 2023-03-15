<?php

/** @var \yii\web\View $this */
/** @var \frontend\controllers\ProjectsController $customers */
/** @var \frontend\controllers\ProjectsController $groups */
/** @var \frontend\controllers\ProjectsController $data */

use yii\helpers\Url;

$this->title = $data['title']
?>
<div class="container h-auto">
    <div class="w-full ha-auto mb-12">
        <a onclick="javascript:history.back(); return false;" class="inline-block align-middle px-2.5 py-2 mr-2 border-2 border-gray-800 text-gray-800 font-medium text-xs leading-tight uppercase rounded hover:bg-black hover:bg-opacity-5 focus:outline-none focus:ring-0 transition duration-150 ease-in-out">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 inline-block align-middle">
                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 12h-15m0 0l6.75 6.75M4.5 12l6.75-6.75" />
            </svg>
        </a>

        <h1 class="inline-block align-middle font-semibold text-2xl">
            Редактирование проекта
        </h1>
    </div>

    <div id="result" class="w-full" style="display: none;"></div>

    <form id="container" data-project="<?= $data['id'] ?>" class="w-full h-auto max-w-[620px]">

        <label for="" class="block font-light text-xs text-stone-500 mb-4">Наименование проекта:</label>
        <textarea name="title" id="" placeholder="Введите наименование проекта" class="w-full h-auto bg-[#F8F8F8] text-left font-medium text-sm mb-8 border-b border-solid border-stone-300 pb-2 focus:outline-none focus:border-main-red"><?= $data['title'] ?></textarea>

        <label for="" class="block font-light text-xs text-stone-500 mb-4">Заказчик:</label>
        <select name="customer" id="" class="w-full h-auto bg-[#F8F8F8] text-left font-medium text-sm mb-8 border-b border-solid border-stone-300 pb-2 focus:outline-none focus:border-main-red">
            <option value="<?= $data['customer_id'] ?>">
                <?= $data['customer'] ?>
            </option>

            <?php foreach ( $customers as $customer ): ?>
                <option value="<?= $customer['id'] ?>">
                    <?= $customer['name'] ?>
                </option>
            <?php endforeach; ?>
        </select>

        <label for="" class="block font-light text-xs text-stone-500 mb-4">Группа проекта:</label>
        <select name="group" id="" class="w-full h-auto bg-[#F8F8F8] text-left font-medium text-sm mb-8 border-b border-solid border-stone-300 pb-2 focus:outline-none focus:border-main-red">
            <option value="<?= $data['group_id'] ?>">
                <?= $data['group'] ?>
            </option>

            <?php foreach ( $groups as $group ): ?>
                <option value="<?= $group['id'] ?>">
                    <?= $group['name'] ?>
                </option>
            <?php endforeach; ?>
        </select>

        <label for="" class="block font-light text-xs text-stone-500 mb-4">№ договора Заказчика:</label>
        <input type="text" value="<?= $data['number_customer'] ?>" name="number_customer" placeholder="000-000-001" class="w-full h-auto bg-[#F8F8F8] text-left font-medium text-sm mb-8 border-b border-solid border-stone-300 pb-2 focus:outline-none focus:border-main-red">

        <label for="" class="block font-light text-xs text-stone-500 mb-4">№ договора внутренний:</label>
        <input type="text" value="<?= $data['number_in'] ?>" name="number_in" placeholder="000-000-001" class="w-full h-auto bg-[#F8F8F8] text-left font-medium text-sm mb-8 border-b border-solid border-stone-300 pb-2 focus:outline-none focus:border-main-red">

        <label for="" class="block font-light text-xs text-stone-500 mb-4">Дата заключения договора:</label>
        <input type="text" value="<?= $data['date'] ?>" name="date" placeholder="2021-2022" class="w-full h-auto bg-[#F8F8F8] text-left font-medium text-sm mb-8 border-b border-solid border-stone-300 pb-2 focus:outline-none focus:border-main-red">

        <label for="" class="block font-light text-xs text-stone-500 mb-4">Примечания:</label>
        <textarea name="text" id="" placeholder="Введите описание" class="w-full h-auto bg-[#F8F8F8] text-left font-medium text-sm border-b border-solid border-stone-300 pb-2 focus:outline-none focus:border-main-red"><?= $data['text'] ?></textarea>

        <div class="w-full h-auto my-5 block sm:flex items-stretch justify-start">
            <button type="button" id="sendingForm" class="py-3 px-9 bg-black rounded-xl text-white font-medium text-xs uppercase">
                СОХРАНИТЬ
            </button>

            <?php if ( $data['status'] == 1 ): ?>
                <button type="button" id="archive" data-archive="<?= $data['status'] ?>" class="py-3 px-9 mt-5 sm:mt-0 ml-0 sm:ml-5 border border-solid border-main-red rounded-xl text-black font-medium text-xs uppercase flex items-center justify-between">
                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M15.5807 19.414H1.78939C1.51971 19.414 1.30029 19.1946 1.30029 18.9249V10.9919C1.30029 10.8301 1.16916 10.699 1.00732 10.699C0.845488 10.699 0.714355 10.8301 0.714355 10.9919V18.9249C0.714355 19.5177 1.19662 19.9999 1.78939 19.9999H15.5807C15.7426 19.9999 15.8737 19.8687 15.8737 19.7069C15.8737 19.5451 15.7425 19.414 15.5807 19.414Z" fill="black"/>
                        <path d="M7.35385 9.74277C7.4044 9.83937 7.50439 9.89992 7.61346 9.89992H18.2122C18.4818 9.89992 18.7012 10.1193 18.7012 10.389V18.925C18.7012 19.1946 18.4819 19.4141 18.2122 19.4141H16.9479C16.7861 19.4141 16.6549 19.5452 16.6549 19.707C16.6549 19.8688 16.7861 20 16.9479 20H18.2122C18.8049 20 19.2872 19.5178 19.2872 18.925V10.389C19.2872 9.79621 18.8049 9.31394 18.2122 9.31394H17.3487V4.95824C17.3487 4.88355 17.3196 4.80777 17.263 4.75109L15.593 3.08113V0.879492C15.593 0.394531 15.1985 0 14.7135 0H3.29299C2.80803 0 2.41354 0.394531 2.41354 0.879492V7.37531H1.59385C1.10889 7.37531 0.714355 7.76984 0.714355 8.2548V9.62047C0.714355 9.78227 0.845488 9.91344 1.00732 9.91344C1.16916 9.91344 1.30029 9.78227 1.30029 9.62047V8.2548C1.30029 8.09293 1.43197 7.96125 1.59385 7.96125H6.244C6.35361 7.96125 6.45326 8.02156 6.50408 8.11871C6.89162 8.85934 6.97764 9.02375 7.35385 9.74277ZM13.9923 2.30906C14.2631 2.57984 15.9827 4.29941 16.3485 4.66523H14.5101C14.2246 4.66523 13.9923 4.43297 13.9923 4.14746V2.30906ZM2.99947 0.879492C2.99947 0.717617 3.13115 0.585938 3.29303 0.585938H14.7135C14.8754 0.585938 15.0071 0.717617 15.0071 0.879492V2.49516L13.9065 1.39461C13.8547 1.34273 13.7799 1.30879 13.6994 1.30879H5.54342C4.93482 1.30879 4.43971 1.80391 4.43971 2.4125V7.37531H2.99947V0.879492ZM7.7908 9.31398L7.48807 8.73539H15.1272C15.289 8.73539 15.4202 8.60422 15.4202 8.44242C15.4202 8.28063 15.289 8.14945 15.1272 8.14945H7.1815L7.0233 7.84707C6.87107 7.55609 6.57244 7.37531 6.24404 7.37531H5.02568V2.41254C5.02568 2.12703 5.25795 1.89477 5.54346 1.89477H13.4064V4.1475C13.4064 4.75609 13.9015 5.25121 14.5101 5.25121H16.7629V9.31398H7.7908Z" fill="black"/>
                        <path d="M15.1274 6.20923H6.6958C6.53396 6.20923 6.40283 6.3404 6.40283 6.5022C6.40283 6.66399 6.53396 6.79517 6.6958 6.79517H15.1274C15.2893 6.79517 15.4204 6.66399 15.4204 6.5022C15.4204 6.3404 15.2893 6.20923 15.1274 6.20923Z" fill="black"/>
                    </svg>
                    <span class="ml-5">АРХИВИРОВАТЬ</span>
                </button>
            <?php else: ?>
                <button type="button" id="archive" data-archive="<?= $data['status'] ?>" class="py-3 px-9 mt-5 sm:mt-0 ml-0 sm:ml-5 border border-solid border-main-red rounded-xl text-black font-medium text-xs uppercase flex items-center justify-between">
                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M15.5807 19.414H1.78939C1.51971 19.414 1.30029 19.1946 1.30029 18.9249V10.9919C1.30029 10.8301 1.16916 10.699 1.00732 10.699C0.845488 10.699 0.714355 10.8301 0.714355 10.9919V18.9249C0.714355 19.5177 1.19662 19.9999 1.78939 19.9999H15.5807C15.7426 19.9999 15.8737 19.8687 15.8737 19.7069C15.8737 19.5451 15.7425 19.414 15.5807 19.414Z" fill="black"/>
                        <path d="M7.35385 9.74277C7.4044 9.83937 7.50439 9.89992 7.61346 9.89992H18.2122C18.4818 9.89992 18.7012 10.1193 18.7012 10.389V18.925C18.7012 19.1946 18.4819 19.4141 18.2122 19.4141H16.9479C16.7861 19.4141 16.6549 19.5452 16.6549 19.707C16.6549 19.8688 16.7861 20 16.9479 20H18.2122C18.8049 20 19.2872 19.5178 19.2872 18.925V10.389C19.2872 9.79621 18.8049 9.31394 18.2122 9.31394H17.3487V4.95824C17.3487 4.88355 17.3196 4.80777 17.263 4.75109L15.593 3.08113V0.879492C15.593 0.394531 15.1985 0 14.7135 0H3.29299C2.80803 0 2.41354 0.394531 2.41354 0.879492V7.37531H1.59385C1.10889 7.37531 0.714355 7.76984 0.714355 8.2548V9.62047C0.714355 9.78227 0.845488 9.91344 1.00732 9.91344C1.16916 9.91344 1.30029 9.78227 1.30029 9.62047V8.2548C1.30029 8.09293 1.43197 7.96125 1.59385 7.96125H6.244C6.35361 7.96125 6.45326 8.02156 6.50408 8.11871C6.89162 8.85934 6.97764 9.02375 7.35385 9.74277ZM13.9923 2.30906C14.2631 2.57984 15.9827 4.29941 16.3485 4.66523H14.5101C14.2246 4.66523 13.9923 4.43297 13.9923 4.14746V2.30906ZM2.99947 0.879492C2.99947 0.717617 3.13115 0.585938 3.29303 0.585938H14.7135C14.8754 0.585938 15.0071 0.717617 15.0071 0.879492V2.49516L13.9065 1.39461C13.8547 1.34273 13.7799 1.30879 13.6994 1.30879H5.54342C4.93482 1.30879 4.43971 1.80391 4.43971 2.4125V7.37531H2.99947V0.879492ZM7.7908 9.31398L7.48807 8.73539H15.1272C15.289 8.73539 15.4202 8.60422 15.4202 8.44242C15.4202 8.28063 15.289 8.14945 15.1272 8.14945H7.1815L7.0233 7.84707C6.87107 7.55609 6.57244 7.37531 6.24404 7.37531H5.02568V2.41254C5.02568 2.12703 5.25795 1.89477 5.54346 1.89477H13.4064V4.1475C13.4064 4.75609 13.9015 5.25121 14.5101 5.25121H16.7629V9.31398H7.7908Z" fill="black"/>
                        <path d="M15.1274 6.20923H6.6958C6.53396 6.20923 6.40283 6.3404 6.40283 6.5022C6.40283 6.66399 6.53396 6.79517 6.6958 6.79517H15.1274C15.2893 6.79517 15.4204 6.66399 15.4204 6.5022C15.4204 6.3404 15.2893 6.20923 15.1274 6.20923Z" fill="black"/>
                    </svg>
                    <span class="ml-5">РАЗАРХИВИРОВАТЬ</span>
                </button>
            <?php endif; ?>

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
    let e = { container: $('#container'), container_result: $('#result'), loader: $('#loader'), btn_send: $('#sendingForm'), btn_archive: $('#archive') }
    
    e.btn_send.on('click', function (){
        $.ajax({
            url: '/frontend/web/projects/update-projects',
            type: 'post',
            dataType: 'html',
            data: { 'id': e.container.attr('data-project'), 'title': inputs.title.val(), 'customer': inputs.customer.val(), 'group': inputs.group.val(), 'number_customer': inputs.number_customer.val(), 'number_in': inputs.number_in.val(), 'date': inputs.date.val(), 'text': inputs.text.val() },
            beforeSend: function (){
                e.btn_send.hide();
                e.loader.show();
            },
            success: function (response){
                e.container.hide();
                e.container_result.html(response).show();
                e.loader.hide();
                $('html, body').animate({ scrollTop: 0 }, 1000);
                getLogs('projects', 'update', 'UPDATE PROJECT - '+e.container.attr('data-project'), 1, false);
            }, 
            error: function (response){
                getLogs('projects', 'update', 'UPDATE PROJECT - '+e.container.attr('data-project'), 0, response['responseText']);
                alert("Упс! Кажется произошла ошибка при загрузке данных. Пожалуйста, перезагрузите страницу или попробуйте позже!\\n\\nОтвет ошибки:\\n" + response['responseText']);
                console.log(response);
            }
        }); 
    });

    e.btn_archive.on('click', function (){
        if( e.btn_archive.attr('data-archive') == 1 ){ e.btn_archive.children('span').text('РАЗАРХИВИРОВАТЬ'); } else{ e.btn_archive.children('span').text('АРХИВИРОВАТЬ'); }
        $.ajax({
            url: '/frontend/web/projects/archive-projects',
            type: 'post',
            dataType: 'html',
            data: { 'id': e.container.attr('data-project'), 'value': e.btn_archive.attr('data-archive') },
            beforeSend: function (){
                e.btn_send.hide();
                e.btn_archive.hide();
                e.loader.show();
            },
            success: function (response){
                e.btn_send.show();
                e.btn_archive.show();
                e.loader.hide();
                getLogs('projects', 'to_archive', 'Sending projects to archive - '+e.container.attr('data-project'), 1, false);
            }, 
            error: function (response){
                getLogs('projects', 'to_archive', 'Sending projects to archive - '+e.container.attr('data-project'), 0, response['responseText']);
                alert("Упс! Кажется произошла ошибка при загрузке данных. Пожалуйста, перезагрузите страницу или попробуйте позже!\\n\\nОтвет ошибки:\\n" + response['responseText']);
                console.log(response);
            }
        }); 
    }); 
    
JS;

$this->registerJs($script, \yii\web\View::POS_READY);
