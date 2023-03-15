<?php

/** @var \yii\web\View $this */

use yii\helpers\Url;

$this->title = 'Редактор бара'
?>
<div class="container h-auto pb-24">
    <div class="w-full ha-auto mb-12">
        <a onclick="javascript:history.back(); return false;" class="inline-block align-middle px-2.5 py-2 mr-2 border-2 border-gray-800 text-gray-800 font-medium text-xs leading-tight uppercase rounded hover:bg-black hover:bg-opacity-5 focus:outline-none focus:ring-0 transition duration-150 ease-in-out">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 inline-block align-middle">
                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 12h-15m0 0l6.75 6.75M4.5 12l6.75-6.75" />
            </svg>
        </a>

        <h1 class="inline-block align-middle font-semibold text-2xl">
            Редактор бара
        </h1>
    </div>
    <div class="w-full h-auto grid grid-cols-1 gap-3 mb-24">
        <a href="<?= Url::to(['/bar/edit-left']) ?>" class="bg-white hover:bg-main-red shadow-[0px_0px_10px_0px_#00000017] h-[110px] grid grid-cols-[25%_75%] grid-rows-1 text-black hover:text-white duration-300 ease-in-out">
            <div class="relative">
                <div class="w-[45px] h-[45px] flex items-center justify-center rounded-full absolute top-2/4 -translate-y-2/4 left-2/4 -translate-x-2/4">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-8 h-8">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5L8.25 12l7.5-7.5" />
                    </svg>
                </div>
            </div>
            <div class="flex items-center justify-start">
                <span>
                    <div class="text-xs text-gray-400">Бар</div>
                    <div class="font-medium text-sm md:text-md uppercase">Левый</div>
                </span>
            </div>
        </a>
        <a href="<?= Url::to(['/bar/edit-bottom']) ?>" class="bg-white hover:bg-main-red shadow-[0px_0px_10px_0px_#00000017] h-[110px] grid grid-cols-[25%_75%] grid-rows-1 text-black hover:text-white duration-300 ease-in-out">
            <div class="relative">
                <div class="w-[45px] h-[45px] flex items-center justify-center rounded-full absolute top-2/4 -translate-y-2/4 left-2/4 -translate-x-2/4">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-8 h-8">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                    </svg>
                </div>
            </div>
            <div class="flex items-center justify-start">
                <span>
                    <div class="text-xs text-gray-400">Бар</div>
                    <div class="font-medium text-sm md:text-md uppercase">Нижний</div>
                </span>
            </div>
        </a>
    </div>

</div>
