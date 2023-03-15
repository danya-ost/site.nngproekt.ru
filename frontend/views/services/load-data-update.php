<?php

/** @var \frontend\controllers\ServicesController $data */

?>

<div>
    <label for="updateName" class="inline-block align-middle font-light text-xs text-stone-500">
        Наименование сервиса
    </label>
</div>
<input type="text"
       id="updateName"
       name="up_title"
       placeholder="Ввведите наименование сервиса",
       value="<?= $data['title'] ?>"
       class="block w-full py-2 mb-5 font-medium text-sm border-b border-solid border-b-stone-300 bg-white focus:border-b-main-red focus:outline-none">
<div class="mb-5">
    <label for="updateType" class="inline-block align-middle text-xs text-black cursor-pointer">
        <?php if ( $data['type_id'] == 1 ): ?>
            <input class="inline-block align-middle mr-1" id="updateType" type="checkbox" name="up_type">
        <?php else: ?>
            <input class="inline-block align-middle mr-1" id="updateType" type="checkbox" checked name="up_type">
        <?php endif; ?>
        <span class="inline-block align-middle">Новому сотруднику</span>
    </label>
</div>
<div>
    <label for="updateSrc" class="inline-block align-middle font-light text-xs text-stone-500">
        Ссылка (если есть)
    </label>
</div>
<input type="text"
       id="updateSrc"
       name="up_src"
       placeholder="Укажите полную ссылку (если есть)",
       value="<?= $data['href_src'] ?>"
       class="block w-full py-2 font-medium text-sm border-b border-solid border-b-stone-300 bg-white focus:border-b-main-red focus:outline-none">