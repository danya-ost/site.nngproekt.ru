<?php

/** @var \frontend\controllers\NewsController $data */

?>
    <label for="update-category-<?= $data['id'] ?>" class="block font-light text-xs text-stone-500">
        Наименование категории новостей
    </label>
    <input type="text"
           id="new-category-<?= $data['id'] ?>"
           name="update-category"
           placeholder="<?= $data['name'] ?>"
           value="<?= $data['name'] ?>"
           class="block w-full py-2 font-medium text-sm border-b border-solid border-b-stone-300 bg-white focus:border-b-main-red focus:outline-none">
<?php
