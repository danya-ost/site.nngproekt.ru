<?php

/** @var \frontend\controllers\ProjectsController $data */

?>
<label for="update_cust_name-<?= $data['id'] ?>" class="block font-light text-xs text-stone-500">
    Наименование клиента
</label>
<input type="text"
       id="update_cust_name-<?= $data['id'] ?>"
       name="update_cust_name"
       placeholder="<?= $data['name'] ?>"
       value="<?= $data['name'] ?>"
       class="block w-full py-2 font-medium text-sm border-b border-solid border-b-stone-300 bg-white focus:border-b-main-red focus:outline-none">

<label for="update_cust_address-<?= $data['id'] ?>" class="block font-light text-xs text-stone-500 mt-5">
    Адрес клиента
</label>
<input type="text"
       id="update_cust_address-<?= $data['id'] ?>"
       name="update_cust_address"
       placeholder="<?= $data['address'] ?>"
       value="<?= $data['address'] ?>"
       class="block w-full py-2 font-medium text-sm border-b border-solid border-b-stone-300 bg-white focus:border-b-main-red focus:outline-none">
