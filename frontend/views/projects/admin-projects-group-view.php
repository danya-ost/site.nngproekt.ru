<?php

/** @var \frontend\controllers\ProjectsController $data */

foreach ( $data  as $item ):
    ?>

    <div type="button" data-group="<?= $item['id'] ?>" name="projects_group_view_<?= $item['id'] ?>" class="bg-white hover:bg-[#F8F8F8] shadow-[0px_0px_10px_0px_#00000017] h-[110px] grid grid-cols-[20%_80%] grid-rows-1 cursor-pointer">
        <div class="relative">
            <div class="w-[45px] h-[45px] bg-stone-300 flex items-center justify-center rounded-full absolute top-2/4 -translate-y-2/4 left-2/4 -translate-x-2/4">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 7.125C2.25 6.504 2.754 6 3.375 6h6c.621 0 1.125.504 1.125 1.125v3.75c0 .621-.504 1.125-1.125 1.125h-6a1.125 1.125 0 01-1.125-1.125v-3.75zM14.25 8.625c0-.621.504-1.125 1.125-1.125h5.25c.621 0 1.125.504 1.125 1.125v8.25c0 .621-.504 1.125-1.125 1.125h-5.25a1.125 1.125 0 01-1.125-1.125v-8.25zM3.75 16.125c0-.621.504-1.125 1.125-1.125h5.25c.621 0 1.125.504 1.125 1.125v2.25c0 .621-.504 1.125-1.125 1.125h-5.25a1.125 1.125 0 01-1.125-1.125v-2.25z" />
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
