<?php

/** @var \yii\web\View $this */
/** @var \frontend\controllers\ProjectsController $data */

$this->title = $data['title'];
?>
<div class="container h-auto">

    <div class="w-full ha-auto">
        <h1 class="font-bold text-4xl uppercase">ПРОЕКТ</h1>
    </div>

    <div class="w-full h-auto pt-14 pb-24">
        <h1 class="font-semibold text-lg md:text-2xl text-black">
            <?= $data['title'] ?>
        </h1>
        <p class="mt-8 font-light text-base md:text-xl text-black">
            <?= $data['customer'] ?>
        </p>
        <p class="mt-6 font-light text-base md:text-xl text-black">
            № договора Заказчика: <span class="font-semibold"><?= $data['number_customer'] ?></span>
        </p>
        <p class="mt-5 font-light text-base md:text-xl text-black">
            № договора внутренний: <span class="font-semibold"><?= $data['number_in'] ?></span>
        </p>
        <p class="mt-5 font-light text-base md:text-xl text-black">
            Дата заключения/завершения: <span class="font-semibold"><?= $data['date'] ?></span>
        </p>
        <p class="mt-5 font-light text-base md:text-xl text-black">
            Примечания: <span class="font-semibold">
                            <?= $data['text'] ?>
                        </span>
        </p>
    </div>

</div>
