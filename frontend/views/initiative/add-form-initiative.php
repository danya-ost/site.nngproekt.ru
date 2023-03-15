<?php

/** @var \yii\web\View $this */
/** @var \frontend\controllers\InitiativeController $category_s */
/** @var \frontend\controllers\InitiativeController $user_name */

$this->title = 'Подать инициативу';
?>
<div class="container">
    <div class="max-w-[865px]">
        <h1 class="font-semibold text-2xl">
            Подать инициативу
        </h1>

        <div class="my-6">
            <h1 class="font-light text-xs block mb-1">Выберите категорию</h1>

            <?php foreach ( $category_s as $category ): ?>
                <button type="button" name="selected_category_<?= $category['id'] ?>" class="inline-block align-middle px-7 py-3 mr-3 mt-4 shadow-[0px_0px_4px_0px_#00000040] rounded-xl md:rounded-lg text-black font-light text-xs">
                    <?= $category['name'] ?>
                </button>
            <?php endforeach; ?>
        </div>

        <div class="mb-8">
            <label class="text-xs font-light text-black">
                ФИО автора
            </label>
            <input type="text"
                   id="author_id"
                   name="author_id"
                   disabled
                   value="<?= $user_name ?>"
                   placeholder="Начните вводить ФИО, более 3-х символов..."
                   class="block w-full h-auto text-sm font-medium py-2 border-b border-solid border-b-stone-300 focus:border-b-main-red bg-[#F8F8F8] focus:outline-none">
        </div>

        <div class="mb-8 relative">
            <label for="helper_id" class="text-xs font-light text-black">
                ФИО содействующего
            </label>
            <input type="text"
                   id="helper_id"
                   name="helper_id"
                   data-helper-id="0"
                   placeholder="Начните вводить ФИО, более 3-х символов..."
                   class="block w-full h-auto text-sm font-medium py-2 border-b border-solid border-b-stone-300 focus:border-b-main-red bg-[#F8F8F8] focus:outline-none">

            <div id="helper_container" style="display: none;" class="w-full h-auto absolute z-[999] top-full bg-white shadow-lg border-r border-b border-l border-solid border-stone-300"></div>
            <div id="helper_loader" style="display: none;" class="w-full h-auto absolute z-[999] top-full bg-white shadow-lg border-r border-b border-l border-solid border-stone-300">
                <div class="w-full h-auto flex items-center justify-center p-1">
                    <div class="spinner-border animate-spin inline-block w-5 h-5 border-2 rounded-full text-main-red" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="mb-8 relative">
            <label for="department_id" class="text-xs font-light text-black">
                Структурное подразделение
            </label>
            <input type="text"
                   id="department_id"
                   name="department_id"
                   data-department-id="0"
                   placeholder="Начните вводить подразделение, более 3-х символов..."
                   class="block w-full h-auto text-sm font-medium py-2 border-b border-solid border-b-stone-300 focus:border-b-main-red bg-[#F8F8F8] focus:outline-none">
            <div id="department_container" style="display: none;" class="w-full h-auto absolute top-full bg-white shadow-lg border-r border-b border-l border-solid border-stone-300"></div>
            <div id="department_loader" style="display: none;" class="w-full h-auto absolute top-full bg-white shadow-lg border-r border-b border-l border-solid border-stone-300">
                <div class="w-full h-auto flex items-center justify-center p-1">
                    <div class="spinner-border animate-spin inline-block w-5 h-5 border-2 rounded-full text-main-red" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="mb-8">
            <label for="contacts" class="text-xs font-light text-black">
                Контактная информация
            </label>
            <input type="text"
                   id="contacts"
                   name="contacts"
                   required
                   placeholder="012-34-56"
                   class="block w-full h-auto text-sm font-medium py-2 border-b border-solid border-b-stone-300 focus:border-b-main-red bg-[#F8F8F8] focus:outline-none">
        </div>

        <div class="mb-8">
            <label for="title" class="text-xs font-light text-black">
                Общая тема:
            </label>
            <input type="text"
                   id="title"
                   name="title"
                   required
                   placeholder="Введите тему инициативы"
                   class="block w-full h-auto text-sm font-medium py-2 border-b border-solid border-b-stone-300 focus:border-b-main-red bg-[#F8F8F8] focus:outline-none">
        </div>

        <div class="mb-8">
            <label for="msg_problem" class="text-xs font-light text-black">
                Выявленная проблема:
            </label>
            <textarea type="text"
                   id="msg_problem"
                   name="msg_problem"
                   rows="5"
                   placeholder="Опишите выявленную проблему"
                    class="block w-full h-auto text-sm font-medium py-2 border-b border-solid border-b-stone-300 focus:border-b-main-red bg-[#F8F8F8] focus:outline-none" ></textarea>
        </div>

        <div class="mb-8">
            <label for="msg_answer" class="text-xs font-light text-black">
                Предлагаемое решение:
            </label>
            <textarea type="text"
                      id="msg_answer"
                      name="msg_answer"
                      rows="2"
                      placeholder="Опишите предлагаемое решение"
                      class="block w-full h-auto text-sm font-medium py-2 border-b border-solid border-b-stone-300 focus:border-b-main-red bg-[#F8F8F8] focus:outline-none" ></textarea>
        </div>

        <div class="mb-8">
            <label for="msg_effect" class="text-xs font-light text-black">
                Ожидаемый эффект:
            </label>
            <textarea type="text"
                      id="msg_effect"
                      name="msg_effect"
                      rows="5"
                      placeholder="Опишите ожидаемый эффект"
                      class="block w-full h-auto text-sm font-medium py-2 border-b border-solid border-b-stone-300 focus:border-b-main-red bg-[#F8F8F8] focus:outline-none" ></textarea>
        </div>

        <button type="button" id="btn-send" style="display: none;" class="bg-black block md:inline-block align-middle w-full md:w-auto px-9 py-3 rounded-xl text-white uppercase cursor-pointer duration-300 ease-in-out mb-10">
            ОТПРАВИТЬ
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
    
    let add = {
        btn_send: $('#btn-send')
    }
    
    let selected_id = 0;
    
    let required = { contacts: false, title: false, msg_problem: false, msg_answer: false, msg_effect: false }
    
    function requiredForm(){
        if ( required.contacts == true && required.title == true && required.msg_problem == true && required.msg_answer == true && required.msg_effect == true && $('input[name=\'department_id\']').attr('data-department-id') > 0 && selected_id > 0 ){
            add.btn_send.show();
        } else{ add.btn_send.hide(); }
    }
    
    $('button[name^=\'selected_category_\']').on('click', function (){
        selected_id = $(this).attr('name').replace('selected_category_', '');
        $('button[name^=\'selected_category_\']').each(function (){
            $(this).removeClass('bg-main-red').addClass('bg-white').removeClass('text-white').addClass('text-black'); 
        });
        $(this).addClass('bg-main-red').removeClass('bg-white').addClass('text-white').removeClass('text-black');
        requiredForm();
    });
    
    $('input[name=\'contacts\']').on('input, keyup', function (){
        if ( $('input[name=\'contacts\']').val().length >= 3 ){ required.contacts = true; } else{ required.contacts = false; }
        requiredForm();
    });
    
    $('input[name=\'title\']').on('input, keyup', function (){
        if ( $('input[name=\'title\']').val().length >= 3 ){ required.title = true; } else{ required.title = false; }
        requiredForm();
    });
    
    $('textarea[name=\'msg_problem\']').on('input, keyup', function (){
        if ( $('textarea[name=\'msg_problem\']').val().length >= 3 ){ required.msg_problem = true; } else{ required.msg_problem = false; }
        requiredForm();
    });
    
    $('textarea[name=\'msg_answer\']').on('input, keyup', function (){
        if ( $('textarea[name=\'msg_answer\']').val().length >= 3 ){ required.msg_answer = true; } else{ required.msg_answer = false; }
        requiredForm();
    });
    
    $('textarea[name=\'msg_effect\']').on('input, keyup', function (){
        if ( $('textarea[name=\'msg_effect\']').val().length >= 3 ){ required.msg_effect = true; } else{ required.msg_effect = false; }
        requiredForm();
    });
    
    $('input[name=\'helper_id\']').on('input keyup', function (){
        let value = $(this).val();
        let setAjax = $.ajax();
        if ( value.length >= 3 ){
            setAjax.abort();
            $.ajax({
                url: '/frontend/web/initiative/users-search',
                type: 'post',
                dataType: 'html',
                data: { 'value': value },
                beforeSend: function (){
                    $('#helper_loader').show();
                    $('#helper_container').show();
                },
                success: function (response){
                    $('#helper_loader').hide();
                    $('#helper_container').html(response);
                    getLogs('initiative', 'searching', 'searching on users data - '+value, 1, false);
                },
                error: function (response){
                    getLogs('initiative', 'searching', 'searching on users data - '+value, 0, response['responseText']);
                    alert("Упс! Кажется произошла ошибка при загрузке данных. Пожалуйста, перезагрузите страницу или попробуйте позже!\\n\\nОтвет ошибки:\\n" + response['responseText']);
                    console.log(response);
                }
            });
        } else{
            $('#helper_loader').hide();
            $('#helper_container').hide();
        }
    });
    
    $('#helper_container').on('click', 'button[name^=\'selected_user_id_\']', function (){
        $('input[name=\'helper_id\']').attr('data-helper-id', $(this).attr('name').replace('selected_user_id_', '')).val($(this).text().trim());
        $('#helper_container').hide();
        requiredForm();
    });
    
    $('input[name=\'department_id\']').on('input, keyup', function (){
        let value = $(this).val();
        let setAjax = $.ajax();
        if ( value.length >= 3 ){
            setAjax.abort();
            $.ajax({
                url: '/frontend/web/initiative/department-search',
                type: 'post',
                dataType: 'html',
                data: { 'value': value },
                beforeSend: function (){
                    $('#department_loader').show();
                    $('#department_container').show();
                },
                success: function (response){
                    $('#department_loader').hide();
                    $('#department_container').html(response);
                    getLogs('initiative', 'searching', 'searching on department data - '+value, 1, false);
                },
                error: function (response){
                    getLogs('initiative', 'searching', 'searching on department data - '+value, 0, response['responseText']);
                    alert("Упс! Кажется произошла ошибка при загрузке данных. Пожалуйста, перезагрузите страницу или попробуйте позже!\\n\\nОтвет ошибки:\\n" + response['responseText']);
                    console.log(response);
                }
            });
        } else{
            $('#department_loader').hide();
            $('#department_container').hide();
        }
    });
    
    $('#department_container').on('click', 'button[name^=\'selected_department_id_\']', function (){
        $('input[name=\'department_id\']').attr('data-department-id', $(this).attr('name').replace('selected_department_id_', '')).val($(this).text().trim());
        $('#department_container').hide();
        requiredForm();
    });
    
    add.btn_send.on('click', function (){
        let category_id = selected_id;
        let helper_id = $('input[name=\'helper_id\']').attr('data-helper-id');
        let department_id = $('input[name=\'department_id\']').attr('data-department-id');
        let contacts = $('input[name=\'contacts\']').val();
        let title = $('input[name=\'title\']').val();
        let msg_problem = $('textarea[name=\'msg_problem\']').val();
        let msg_solution = $('textarea[name=\'msg_answer\']').val();
        let msg_effect = $('textarea[name=\'msg_effect\']').val();
        $.ajax({
            url: '/frontend/web/initiative/add-initiative',
            type: 'post',
            dataType: 'html',
            data: { 'category_id': category_id, 'helper_id': helper_id, 'department_id': department_id, 'contacts': contacts, 'title': title, 'msg_problem': msg_problem, 'msg_solution': msg_solution, 'msg_effect': msg_effect },
            beforeSend: function (){
                add.btn_send.hide();
                $('#loader').show();
            },
            success: function (response){
                getLogs('initiative', 'add-initiative', 'adding new initiative', 1, false);
                window.location.href = '/frontend/web/initiative/view-initiative?i='+response;
            },
            error: function (response){
                getLogs('initiative', 'add-initiative', 'adding new initiative', 0, response['responseText']);
                alert("Упс! Кажется произошла ошибка при загрузке данных. Пожалуйста, перезагрузите страницу или попробуйте позже!\\n\\nОтвет ошибки:\\n" + response['responseText']);
                console.log(response);
            }
        });
    });
    
JS;

$this->registerJs($script, \yii\web\View::POS_READY);