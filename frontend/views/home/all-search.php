<?php

/** @var \frontend\controllers\InitiativeController $data */

foreach ( $data as $item ):
?>
<a href="<?= $item['href'] ?>" class="block w-full border-b border-solid border-stone-300 last:border-none text-left px-2 py-1 text-main-red font-bold text-xs hover:bg-stone-100">
    <?= $item['title'] ?>
</a>
<?php
endforeach;