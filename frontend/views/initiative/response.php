<?php

/** @var \yii\web\View $this */
/** @var \frontend\controllers\InitiativeController $data */
/** @var \frontend\controllers\InitiativeController $status_s */

use yii\helpers\Url;

$this->title = $data['title'];
?>
<div id="container" data-id="<?= $data['id'] ?>" class="container">
    <div class="max-w-[865px]">
        <h1 class="font-semibold text-2xl mb-4"><?= $data['title'] ?></h1>
        <h1 class="font-medium text-main-red uppercase text-sm mb-1"><?= $data['category'] ?></h1>
        <h1 class="font-medium text-stone-400 text-sm mb-2"><?= $data['date'] ?></h1>
        <h1 class="font-medium text-stone-400 text-sm mb-2">
            АВТОР: <a href="<?= Url::to(['/profile/view-user', 'u' => $data['author_id']]) ?>" class="ml-2 text-black relative after:block after:content-[''] after:absolute after:left-0 after:-bottom-px after:bg-black after:h-px after:w-full"><?= $data['author'] ?></a>
        </h1>
        <?php if ( strlen($data['supportive']) > 0 ): ?>
            <h1 class="font-medium text-stone-400 text-sm mb-2">
                СОДЕЙСТВУЮЩИЙ: <a href="<?= Url::to(['/profile/view-user', 'u' => $data['supportive_id']]) ?>" class="ml-2 text-black relative after:block after:content-[''] after:absolute after:left-0 after:-bottom-px after:bg-black after:h-px after:w-full"><?= $data['supportive'] ?></a>
            </h1>
        <?php endif; ?>
        <i class="block h-px bg-stone-200 mt-4 mb-8"></i>

        <div>
            <label class="font-light text-xs text-stone-500 uppercase">Выявленная проблема:</label>
            <div class="font-medium text-sm text-black pt-2 pb-6">
                <?= $data['problem'] ?>
            </div>
        </div>

        <div>
            <label class="font-light text-xs text-stone-500 uppercase">Предлагаемое решение:</label>
            <div class="font-medium text-sm text-black pt-2 pb-6">
                <?= $data['solution'] ?>
            </div>
        </div>

        <div>
            <label class="font-light text-xs text-stone-500 uppercase">Ожидаемый эффект:</label>
            <div class="font-medium text-sm text-black pt-2 pb-6">
                <?= $data['effect'] ?>
            </div>
        </div>

        <i class="block h-px bg-stone-200 mt-4 mb-8"></i>

        <div>
            <?php foreach ( $status_s as $status ): ?>
                <label for="status_<?= $status['id'] ?>" class="mb-3 block cursor-pointer">
                    <input type="radio" id="status_<?= $status['id'] ?>" name="status" value="<?= $status['id'] ?>" <?= $status['id'] == 1 ? 'checked' : ''; ?> class="text-sm font-medium inline-block align-middle">
                    <span class="text-sm font-medium inline-block align-middle"><?= $status['name'] ?></span>
                </label>
            <?php endforeach; ?>
        </div>

        <div class="mt-8 mb-5">
            <label for="response" class="text-xs font-light text-black">
                Оставить комментарий к инициативе:
            </label>
            <textarea type="text"
                      id="response"
                      name="response"
                      rows="5"
                      placeholder="Комментарий"
                      class="block w-full h-auto text-sm font-medium py-2 border-b border-solid border-b-stone-300 focus:border-b-main-red bg-[#F8F8F8] focus:outline-none" ></textarea>
        </div>

        <button id="btn_send" class="bg-black text-center block md:inline-block align-middle mr-6 w-full md:w-auto px-9 py-3 rounded-xl text-white uppercase cursor-pointer duration-300 ease-in-out mt-6 mb-5 md:mb-10">
            СОХРАНИТЬ
        </button>

        <div id="loader" style="display: none;" class="w-full h-auto flex items-center justify-center py-24">
            <div class="spinner-border animate-spin inline-block w-10 h-10 border-4 rounded-full text-main-red" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
        </div>

    </div>
</div>
<?php
$script = <<<JS
    $('#profile_bar').css({ visibility: 'visible' }).animate({
        opacity: 1
    }, 300);

    let location = 'initiative';
    $('#a_'+location).attr('class', 'block text-left w-full py-3 px-3 pl-10 rounded-r-xl font-bold text-main-red text-xl bg-[#F8F8F8] border-t border-r border-b border-solid border-stone-300 relative after:absolute after:content-[\'\'] after:bg-[#F8F8F8] after:w-4 after:-top-px after:-bottom-px after:-left-px after:border-t after:border-b after:border-solid after:border-stone-300');

    $('#btn_send').on('click', function (){
        let id = $('#container').attr('data-id');
        let status = $('input[name=\'status\']:checked').val();
        let response = $('textarea[name=\'response\']').val();
        $.ajax({
            url: '/frontend/web/initiative/add-response',
            type: 'post',
            dataType: 'html',
            data: { 'id': id, 'status': status, 'response': response },
            beforeSend: function (){
                $('#btn_send').hide();
                $('#loader').show();
            },
            success: function (response){
                getLogs('initiative', 'add-response', 'adding response to'+id, 1, false);
                window.location.href = '/frontend/web/initiative/view-initiative?i='+id;
            },
            error: function (response){
                getLogs('initiative', 'add-response', 'adding response to'+id, 0, response['responseText']);
                alert("Упс! Кажется произошла ошибка при загрузке данных. Пожалуйста, перезагрузите страницу или попробуйте позже!\\n\\nОтвет ошибки:\\n" + response['responseText']);
                console.log(response);
            }
        });
    });
    
JS;

$this->registerJs($script, \yii\web\View::POS_READY);