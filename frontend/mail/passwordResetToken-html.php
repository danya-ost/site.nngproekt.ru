<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\User $user */

$resetLink = Yii::$app->urlManager->createAbsoluteUrl(['site/reset-password', 'token' => $user->password_reset_token]);
?>
<div class="verify-email">
    <h2>Здравствуйте, <?= Html::encode($user->username) ?></h2>
    <p>
        Ваша персональная ссылка для сброса пароля: <br>
        <?= Html::a(Html::encode($resetLink), $resetLink) ?>
    </p> <br><br>
    <p style="font-weight: bold; font-size: 18px;">
        Пожалуйста, не отвечайте на это письмо. Оно сгенерировано автоматически
    </p>
</div>

