<?php

/** @var yii\web\View $this */
/** @var string $name */
/** @var string $message */
/** @var Exception $exception */

use yii\helpers\Html;

$this->title = 'NNGP ID';
?>
<div class="w-full h-screen px-5 relative">
    <div class="max-w-[710px] relative top-2/4 -translate-y-2/4 left-2/4 -translate-x-2/4 bg-white shadow-[0px_0px_20px_0px_#0000008A]">
        <div class="w-full h-auto bg-white px-8 md:px-16 py-11 flex items-center justify-between border-b border-solid border-stone-400">
            <img src="/frontend/web/image/logo/mainlogo 1.png">
            <h1 class="text-xl md:text-4xl uppercase font-bold text-black text-center">
                NNGP
            </h1>
        </div>
        <div class="px-8 md:px-16 py-11 border-b border-solid border-stone-400">
            <h1 class="font-bold text-2xl">Система восстановления</h1>
            <br>
            <h2 class="font-bold text-base">Даанные для востановления отправлены вам на почту.</h2>
            <br>
        </div>
        <a href="<?= \yii\helpers\Url::to(['/site/index']) ?>" class="block text-sm font-medium text-center px-8 md:px-16 py-5 cursor-pointer">
            Вернуться на вход
        </a>
    </div>
</div>
