<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\User $user */

?>
<div class="verify-email">
    <h2>Здравствуйте, <?= Html::encode($fullname_to) ?></h2>
    <h3>Поступило новое обращение от сотрудника</h3>
    <p>
        Данные обращения:<br>
        От кого: <?= Html::encode($fullname) ?> <br>
        Тема: <?= Html::encode($theme) ?> <br>
        Наличие файлов: <?= Html::encode($file) ?> <br>
        Ссылка на обращение: <br><br>
        <a href="<?= Html::encode($href) ?>"><?= Html::encode($href) ?></a>
    </p> <br><br>
    <p style="font-weight: bold; font-size: 18px;">
        Пожалуйста, не отвечайте на это письмо. Оно сгенерировано автоматически
    </p>
</div>
