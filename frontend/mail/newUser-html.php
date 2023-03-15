<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\User $user */

?>
<div class="verify-email">
    <h2>Здравствуйте, <?= Html::encode($fullname) ?></h2>
    <p>
        Вам предоставлен доступ к порталу ННГП. <br>
        Данные для входа: <br>
        E-mail: <?= Html::encode($email) ?>
        Пароль: <?= Html::encode($password) ?>
    </p> <br><br>
    <p style="font-weight: bold; font-size: 18px;">
        Пожалуйста, не отвечайте на это письмо. Оно сгенерировано автоматически
    </p>
</div>
