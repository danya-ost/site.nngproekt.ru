<?php

/** @var \yii\web\View $this */

$this->title = 'ADLDAP to RBAC';
?>
<div class="container h-auto pb-24">
    <div class="w-full ha-auto mb-12">
        <a onclick="javascript:history.back(); return false;" class="inline-block align-middle px-2.5 py-2 mr-2 border-2 border-gray-800 text-gray-800 font-medium text-xs leading-tight uppercase rounded hover:bg-black hover:bg-opacity-5 focus:outline-none focus:ring-0 transition duration-150 ease-in-out">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 inline-block align-middle">
                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 12h-15m0 0l6.75 6.75M4.5 12l6.75-6.75" />
            </svg>
        </a>

        <h1 class="inline-block align-middle font-semibold text-2xl">
            Выгрзука пользователей из Active Directory (ADLDAP)
        </h1>
    </div>

    <div id="success" style="display: none;" class="bg-white shadow-[0px_0px_10px_0px_#00000017] h-[110px] grid grid-cols-[25%_75%] grid-rows-1 text-black duration-300 ease-in-out">
        <div class="relative">
            <div class="w-[45px] h-[45px] text-green-500 flex items-center justify-center rounded-full absolute top-2/4 -translate-y-2/4 left-2/4 -translate-x-2/4">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-14 h-14">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />
                </svg>
            </div>
        </div>
        <div class="flex items-center justify-start">
                <span>
                    <div class="text-xs text-green-500 font-bold">Успешно</div>
                    <div class="font-medium text-sm md:text-md uppercase">Данные из Active Directory (ADLDAP) успешно получены. База пользователей обновлена.</div>
                </span>
        </div>
    </div>

    <div class="mt-10 flex items-center">
        <button type="button" id="ldap" class="inline-block align-middle rounded px-6 py-2.5 bg-gray-800 text-white font-medium text-xs leading-tight uppercase shadow-md hover:bg-gray-900 hover:shadow-lg focus:bg-gray-900 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-gray-900 active:shadow-lg transition duration-150 ease-in-out">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 inline-block align-middle">
                <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5m-13.5-9L12 3m0 0l4.5 4.5M12 3v13.5" />
            </svg>
            <span class="ml-1 inline-block align-middle">Обновить базу пользователей</span>
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
    $('#ldap').on('click', function (){
        $(this).hide();
        $.ajax({
            url: '/frontend/web/rbac/connection-ldap',
            type: 'post',
            dataType: 'html',
            data: 1,
            beforeSend: function (){
                $('#loader').show();
            },
            success: function (){
                $('#success').show();
                $('#loader').hide();
                getLogs('rbac', 'LDAP', 'Uploading users to RBAC from ADLDAP', 1, false);
            },
            error: function (response){
                getLogs('rbac', 'LDAP', 'Uploading users to RBAC from ADLDAP', 0, true);
                alert("Упс! Кажется произошла ошибка при загрузке данных. Пожалуйста, перезагрузите страницу или попробуйте позже!\\n\\nОтвет ошибки:\\n" + response['responseText']);
                console.log(response);
            }
        });
    });
JS;

$this->registerJs($script, \yii\web\View::POS_READY);

