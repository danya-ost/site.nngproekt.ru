<?php

/** @var yii\web\View $this */
/** @var string $name */
/** @var string $message */
/** @var Exception $exception */

use yii\helpers\Html;

$this->title = $name;
?>
<div class="w-full h-screen px-5 relative">
    <div class="max-w-[710px] relative top-2/4 -translate-y-2/4 left-2/4 -translate-x-2/4 bg-white shadow-[0px_0px_20px_0px_#0000008A]">
        <div class="w-full h-auto bg-white px-8 md:px-16 py-11 flex items-center justify-between border-b border-solid border-stone-400">
            <img src="/frontend/web/image/logo/mainlogo 1.png">
            <h1 class="text-xl md:text-4xl uppercase font-bold text-black text-center">
                STOP
            </h1>
        </div>
        <div class="px-8 md:px-16 py-11 border-b border-solid border-stone-400">
            <h1 class="font-bold text-2xl"><?= Html::encode($this->title) ?></h1>
            <br>
            <h2 class="font-bold text-base">Остановка перехода:</h2>
            <h2 class="text-base">Ксожалению в демо-версии данная страница не доступна! :)</h2>
            <br><br>
            <p class="text-sm">Обратитесь к администратору для просмотратра данной страницы.</p>
            <p class="text-sm">Приносим извенения за доставленные неудобства!</p>
        </div>
        <a onclick="javascript:history.back(); return false;" class="block text-sm font-medium text-center px-8 md:px-16 py-5 cursor-pointer">
            Come back
        </a>
    </div>
</div>
