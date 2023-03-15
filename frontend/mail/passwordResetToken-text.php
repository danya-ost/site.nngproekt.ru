<?php

/** @var yii\web\View $this */
/** @var common\models\User $user */

$resetLink = Yii::$app->urlManager->createAbsoluteUrl(['site/reset-password', 'token' => $user->password_reset_token]);
?>
Здравствуйте, <?= $user->username . '\n' ?>
Ваша персональная ссылка для сброса пароля: <?= '\n' ?>
<?= $resetLink ?>
Пожалуйста, не отвечайте на это письмо. Оно сгенерировано автоматически