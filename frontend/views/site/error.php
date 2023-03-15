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
                Error
            </h1>
        </div>
        <div class="px-8 md:px-16 py-11 border-b border-solid border-stone-400">
            <h1 class="font-bold text-2xl"><?= Html::encode($this->title) ?></h1>
            <br>
            <h2 class="font-bold text-base">Error response:</h2>
            <h2 class="text-base"><?= nl2br(Html::encode($message)) ?></h2>
            <br><br>
            <p class="text-sm">The above error occurred while the Web server was processing your request.</p>
            <p class="text-sm">Please contact us if you think this is a server error. Thank you.</p>
        </div>
        <a onclick="javascript:history.back(); return false;" class="block text-sm font-medium text-center px-8 md:px-16 py-5 cursor-pointer">
            Come back
        </a>
    </div>
</div>
