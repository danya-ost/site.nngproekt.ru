<?php

/** @var \yii\web\View $this */
/** @var \frontend\controllers\BarController $data */

$id = $_GET['lbi'];

$this->title = 'Редактирование элемента бара (левый)'
?>
<div class="container h-auto pb-24">
    <div class="w-full ha-auto mb-12">
        <a onclick="javascript:history.back(); return false;" class="inline-block align-middle px-2.5 py-2 mr-2 border-2 border-gray-800 text-gray-800 font-medium text-xs leading-tight uppercase rounded hover:bg-black hover:bg-opacity-5 focus:outline-none focus:ring-0 transition duration-150 ease-in-out">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 inline-block align-middle">
                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 12h-15m0 0l6.75 6.75M4.5 12l6.75-6.75" />
            </svg>
        </a>

        <h1 class="inline-block align-middle font-semibold text-2xl">
            Редактор элемента бара (левый)
        </h1>
    </div>

    <div class="mt-5">
        <label for="title" class="font-light text-xs text-stone-500">
            Наименование
        </label>
        <input type="text"
               name="title"
               id="title"
               value="<?= $data['title'] ?>"
               placeholder="Введите наименование элемента..."
               class="block w-full py-2 font-medium text-sm border-b border-solid border-b-stone-300 bg-[#F8F8F8] focus:border-b-main-red focus:outline-none">
    </div>

    <div class="mt-5">
        <label for="href" class="font-light text-xs text-stone-500">
            Ссылка
        </label>
        <input type="text"
               name="href"
               id="href"
               value="<?= $data['href'] ?>"
               placeholder="Введите ссылку..."
               class="block w-full py-2 font-medium text-sm border-b border-solid border-b-stone-300 bg-[#F8F8F8] focus:border-b-main-red focus:outline-none">
    </div>

    <div class="mt-5">
        <label for="svg" class="font-light text-xs text-stone-500">
            Иконка (SVG)
        </label>
        <textarea
                name="svg"
                maxlength="200"
                rows="10"
                placeholder="Добавьте SVG элемент..."
                class="block w-full py-2 font-medium text-sm border-b border-solid border-b-stone-300 bg-[#F8F8F8] focus:border-b-main-red focus:outline-none"><?= $data['svg'] ?></textarea>
    </div>

    <div class="mt-5">
        <label for="on_off_1" class="text-sm text-stone-500 cursor-pointer">
            <input type="radio"
                   name="on_off"
                   id="on_off_1"
                   <?= \frontend\models\Navbar::find()->where(['id' => $_GET['lbi']])->one()['status'] == 1 ? 'checked' : '' ?>
                   value="1" class="inline-block align-middle">
            <span class="inline-block align-middle">Включить</span>
        </label>
        <label for="on_off_0" class="text-sm text-stone-500 cursor-pointer ml-5">
            <input type="radio"
                   name="on_off"
                   id="on_off_0"
                    <?= \frontend\models\Navbar::find()->where(['id' => $_GET['lbi']])->one()['status'] == 0 ? 'checked' : '' ?>
                   value="0" class="inline-block align-middle">
            <span class="inline-block align-middle">Отключить</span>
        </label>
    </div>

    <div class="mt-10 flex items-center justify-end">
        <button type="button" id="btn_save" class="inline-block align-middle rounded px-6 py-2.5 bg-gray-800 text-white font-medium text-xs leading-tight uppercase shadow-md hover:bg-gray-900 hover:shadow-lg focus:bg-gray-900 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-gray-900 active:shadow-lg transition duration-150 ease-in-out">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 inline-block align-middle">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 9.75v6.75m0 0l-3-3m3 3l3-3m-8.25 6a4.5 4.5 0 01-1.41-8.775 5.25 5.25 0 0110.233-2.33 3 3 0 013.758 3.848A3.752 3.752 0 0118 19.5H6.75z" />
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
            url: '/frontend/web/bar/update-left-item',
            type: 'post',
            dataType: 'html',
            data: { 'id': '$id', 'title': $('input[name=\'title\']').val(), 'href': $('input[name=\'href\']').val(), 'svg': $('textarea[name=\'svg\']').val(), 'on_off': $('input[name=\'on_off\']:checked').val() },
            beforeSend: function (){
                $('#btn_save').hide();
                $('#loader').show();  
            },
             success: function (){
                window.location.href = '/frontend/web/bar/edit-left';
            },
            error: function (response){
                alert("Упс! Кажется произошла ошибка при загрузке данных. Пожалуйста, перезагрузите страницу или попробуйте позже!\\n\\nОтвет ошибки:\\n" + response['responseText']);
                console.log(response);
            }
        });
    });
JS;

$this->registerJs($script, \yii\web\View::POS_READY);