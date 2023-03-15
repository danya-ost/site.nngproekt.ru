<?php

/** @var yii\web\View $this */
/** @var common\models\User $user */

use yii\helpers\Html;

?>
Здравствуйте, <?= Html::encode($fullname) ?>
Вам предоставлен доступ к порталу ННГП.
Данные для входа:
E-mail: <?= Html::encode($email) ?>
Пароль: <?= Html::encode($password) ?>
Пожалуйста, не отвечайте на это письмо. Оно сгенерировано автоматически
