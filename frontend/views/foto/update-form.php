<?php

/** @var \yii\web\View $this */
/** @var \frontend\controllers\FotoController $modelGC */
/** @var \frontend\controllers\FotoController $modelGI */

$id = $_GET['g'];

$this->title = $modelGC['title'];
?>
<div class="container h-auto pb-24">
    <div class="w-full ha-auto mb-12">
        <a onclick="javascript:history.back(); return false;" class="inline-block align-middle px-2.5 py-2 mr-2 border-2 border-gray-800 text-gray-800 font-medium text-xs leading-tight uppercase rounded hover:bg-black hover:bg-opacity-5 focus:outline-none focus:ring-0 transition duration-150 ease-in-out">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 inline-block align-middle">
                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 12h-15m0 0l6.75 6.75M4.5 12l6.75-6.75" />
            </svg>
        </a>

        <h1 class="inline-block align-middle font-semibold text-2xl">
            Редактирование галлереии
        </h1>
    </div>

    <div>
        <label for="title" class="font-light text-xs text-stone-500">
            Наименование
        </label>
        <input type="text"
               id="title"
               name="title"
               placeholder="Введите наименование альбома..."
               value="<?= $modelGC['title'] ?>"
               class="block w-full py-2 font-medium text-sm border-b border-solid border-b-stone-300 bg-[#F8F8F8] focus:border-b-main-red focus:outline-none">
    </div>

    <div id="container" class="grid grid-rows-1 sm:grid-cols-2 md:grid-cols-3 mt-10 gap-5">
        <div class="h-[250px]">
            <button type="button" data-bs-toggle="modal" data-bs-target="#modalAddImage" class="w-full h-full shadow-[0px_0px_5px_0px_#00000017_inset] border-2 border-dashed border-stone-200 hover:border-stone-700 px-7 text-stone-300 hover:text-stone-700 flex justify-center items-center">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-10 h-10">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                </svg>
            </button>
        </div>
        <?php foreach ( $modelGI as $item ): ?>
            <div class="h-[250px] bg-cover bg-center bg-no-repeat" name="foto_<?= $item['src'] ?>" onclick="$(this).remove()" style="background-image: url('/frontend/web/<?= $item['src'] ?>');">
                <div class="w-full h-full opacity-0 hover:opacity-70 flex items-center justify-center text-red-400 border-2 border-dashed cursor-pointer border-red-400">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-10 h-10">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </div>
            </div>
        <?php endforeach; ?>
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

<div class="modal fade fixed top-0 left-0 hidden w-full h-full outline-none overflow-x-hidden overflow-y-auto" id="modalAddImage" tabindex="-1" aria-labelledby="exampleModalCenterTitle" aria-modal="true" role="dialog">
    <div class="modal-dialog modal-dialog-centered relative w-auto pointer-events-none">
        <div class="modal-content border-none shadow-lg relative flex flex-col w-full pointer-events-auto bg-white bg-clip-padding outline-none text-current">
            <div class="modal-body relative p-4">
                <div id="content_image">
                    <p class="text-base text-black">
                        Допустимые форматы изображения: jpg, png <br> <br>
                    </p>
                    <input class="form-control block w-full px-3 py-1.5 text-xs sm:text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-main-red focus:bg-white focus:border-main-red focus:outline-none"
                           type="file"
                           name="image_file"
                           accept=".jpg, .jpeg, .png, .webmp"
                           id="image_file">
                </div>
                <div id="loader_image" style="display: none;" class="w-full h-auto flex items-center justify-center py-5">
                    <div class="spinner-border animate-spin inline-block w-10 h-10 border-4 rounded-full text-main-red" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
$script = <<<JS
    $('input[name=\'image_file\']').on('change', function (){
        let _file = $(this).prop('files')[0];
        if( typeof _file == 'undefined' ) return false;
        let _data = new FormData();
        _data.append('file', _file);
        $.ajax({
            url: '/frontend/web/tools/upload',
            type: 'post',
            data: _data,
            dataType: 'html',
            processData: false,
            contentType: false,
            beforeSend: function (){
                $('input[name=\'image_file\']').hide();
                $('#loader_image').show();
            },
            success: function (response){
                $.ajax({
                    url: '/frontend/web/foto/add-foto-form',
                    type: 'post',
                    data: { 'src': response },
                    dataType: 'html',
                    success: function (response){
                        $('#container').append(response);
                        $('#modalAddImage').trigger('click');
                        $('#loader_image').hide();
                        $('input[name=\'image_file\']').val('').show();
                    },
                    error: function (response){
                        alert("Упс! Кажется произошла ошибка при загрузке данных. Пожалуйста, перезагрузите страницу или попробуйте позже!\\n\\nОтвет ошибки:\\n" + response['responseText']);
                        console.log(response);
                    }
                });
            },
            error: function (response){
                alert("Упс! Кажется произошла ошибка при загрузке данных. Пожалуйста, перезагрузите страницу или попробуйте позже!\\n\\nОтвет ошибки:\\n" + response['responseText']);
                console.log(response);
            }
        }); 
    });

    $('#btn_save').on('click', function (){
        let data = [];
        $('#container > div[name^=\'foto_\']').each(function (){
            data.push($(this).attr('name').replace('foto_', ''));
        });
         $.ajax({
            url: '/frontend/web/foto/update-gallery',
            type: 'post',
            data: { 'id': '$id', 'title': $('input[name=\'title\']').val(), 'fotos': data },
            dataType: 'html',
            beforeSend: function (){
                $('#btn_save').hide();
                $('#loader').show();
            },
            success: function (response){
                window.location.href = '/frontend/web/foto/view-gallery?g='+response;
            },
            error: function (response){
                alert("Упс! Кажется произошла ошибка при загрузке данных. Пожалуйста, перезагрузите страницу или попробуйте позже!\\n\\nОтвет ошибки:\\n" + response['responseText']);
                console.log(response);
            }
        });
    });
JS;

$this->registerJs($script, \yii\web\View::POS_READY);