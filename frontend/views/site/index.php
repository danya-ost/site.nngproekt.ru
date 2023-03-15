<?php

/** @var yii\web\View $this */
/** @var \common\models\LoginForm $model */

$this->title = 'NNGP ID';

use yii\widgets\ActiveForm;

?>
<div class="w-full h-screen bg-[#00000080] px-5 relative">
    <div class="max-w-[710px] relative top-2/4 -translate-y-2/4 left-2/4 -translate-x-2/4 bg-white shadow-[0px_0px_20px_0px_#0000008A]">
        <div class="w-full h-auto bg-main-red px-8 md:px-16 py-11">
            <h1 class="text-xl md:text-4xl font-bold text-white text-center">
                Войдите на сайт с помощью своего логина и пароля
            </h1>
        </div>

        <?php $form = ActiveForm::begin([
            'id' => 'login-form',
            'options' => ['class' => 'w-full h-auto px-8 md:px-16 py-10'],
            'fieldConfig' => [
                'template' => "{label}{input}{error}",
            ],
        ]); ?>
            <div>
                <?= $form->field($model, 'username', [
                    'template' => '{label}'
                ])->label('Ваш логин', [
                    'class' => 'text-sm font-medium text-black'
                ]) ?>
                <?= $form->field($model, 'username', [
                    'template' => '{input}'
                ])->textInput([
                    'autofocus' => true,
                    'placeholder' => 'ivanov@nngp.com',
                    'value' => 'demo',
                    'class' => 'w-full h-auto text-xl font-light py-2 border-b border-solid border-b-stone-300 focus:border-b-main-red focus:outline-none',
                ]) ?>
                <?= $form->field($model, 'username', [
                    'template' => '{error}'
                ])->error([
                    'tag' => 'div',
                    'class' => 'text-main-red text-xs italic'
                ]) ?>
            </div>

            <div class="mt-12">
                <?= $form->field($model, 'password', [
                    'template' => '{label}'
                ])->label('Ваш пароль', [
                    'class' => 'text-sm font-medium text-black'
                ]) ?>
                <?= $form->field($model, 'password', [
                    'template' => '{input}'
                ])->passwordInput([
                    'placeholder' => '123456789',
                    'value' => 'demo12345',
                    'class' => 'w-full h-auto text-xl font-light py-2 border-b border-solid border-b-stone-300 focus:border-b-main-red focus:outline-none',
                ]) ?>
                <?= $form->field($model, 'password', [
                    'template' => '{error}'
                ])->error([
                    'tag' => 'div',
                    'class' => 'text-main-red text-xs italic'
                ]) ?>
            </div>

            <div class="mt-12 block md:flex items-center justify-between">
                <label class="text-sm font-medium text-black flex items-center justify-start cursor-pointer">
                    <?= $form->field($model, 'rememberMe', [
                        'template' => '{input}'
                    ])->checkbox([
                        'class' => 'mr-2',
                        'checked' => true,
                        'label' => 'Запомнить меня на этом компьютере'
                    ]) ?>
                    <?= $form->field($model, 'rememberMe', [
                        'template' => '{error}'
                    ])->error([
                        'tag' => 'div',
                        'class' => 'text-main-red text-xs italic'
                    ]) ?>
                </label>

                <a href="<?= \yii\helpers\Url::to(['/site/request-password-reset']) ?>" class="text-sm font-medium text-main-red hover:underline">
                    Забыли пароль?
                </a>
            </div>

            <div class="mt-8 block md:flex items-center justify-center">
                <button type="submit" name="login-button" class="w-full md:w-auto px-10 py-4 bg-main-red hover:bg-main-red-900 text-white font-light uppercase text-xl rounded-xl">
                    ВОЙТИ
                </button>
            </div>
        <?php ActiveForm::end(); ?>
    </div>
</div>