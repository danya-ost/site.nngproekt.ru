<?php

/** @var \frontend\controllers\FotoController $data */

?>
<div class="h-[250px] bg-cover bg-center bg-no-repeat" name="foto_<?= $data ?>" onclick="$(this).remove()" style="background-image: url('/frontend/web/<?= $data ?>');">
    <div class="w-full h-full opacity-0 hover:opacity-70 flex items-center justify-center text-red-400 border-2 border-dashed cursor-pointer border-red-400">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-10 h-10">
            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
        </svg>
    </div>
</div>
<?php
