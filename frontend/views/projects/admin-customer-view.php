<?php

/** @var \frontend\controllers\ProjectsController $data */

foreach ( $data  as $item ):
    ?>

    <div type="button" data-cust="<?= $item['id'] ?>" name="cust_view_<?= $item['id'] ?>" class="bg-white hover:bg-[#F8F8F8] shadow-[0px_0px_10px_0px_#00000017] h-[110px] grid grid-cols-[20%_80%] grid-rows-1 cursor-pointer">
        <div class="relative">
            <div class="w-[45px] h-[45px] bg-stone-300 flex items-center justify-center rounded-full absolute top-2/4 -translate-y-2/4 left-2/4 -translate-x-2/4">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" />
                </svg>
            </div>
        </div>
        <div class="flex items-center justify-start">
            <span class="font-medium text-sm text-black">
                <?= $item['name'] ?>
            </span>
        </div>
    </div>

<?php
endforeach;
