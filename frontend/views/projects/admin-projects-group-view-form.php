<?php

/** @var \frontend\controllers\ProjectsController $data */

?>
<label for="update_projects_group_name-<?= $data['id'] ?>" class="block font-light text-xs text-stone-500">
    Наименование клиента
</label>
<input type="text"
       id="update_projects_group_name-<?= $data['id'] ?>"
       name="update_projects_group_name"
       placeholder="<?= $data['name'] ?>"
       value="<?= $data['name'] ?>"
       class="block w-full py-2 font-medium text-sm border-b border-solid border-b-stone-300 bg-white focus:border-b-main-red focus:outline-none">
