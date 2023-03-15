<?php

/** @var \frontend\controllers\InitiativeController $data */

foreach ( $data as $item ):
?>
<button type="button" name="selected_user_id_<?= $item['user_id'] ?>" class="w-full border-b border-solid border-stone-300 last:border-none text-left px-2 py-1 text-main-red font-bold text-xs hover:bg-stone-100">
    <?= $item['fullname'] ?> <span class="text-stone-400 font-medium">[<?= $item['job'] ?>]</span>
</button>
<?php
endforeach;