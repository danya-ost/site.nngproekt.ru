<?php

/** @var \frontend\controllers\NewsController $data */
/** @var \frontend\controllers\NewsController $user_id */
/** @var \frontend\controllers\NewsController $permission */

foreach ( $data  as $item ):
    ?>

    <div class="mb-6 last:mb-0">
        <div>
            <div class="inline-block align-middle w-[45px] h-[45px] border border-solid border-main-red rounded-full bg-center bg-no-repeat bg-cover" style="background-image: url('/frontend/web/<?= \frontend\models\UserAvatar::find()->where(['user_id' => $item['user_id']])->one()['src'] ?>');"></div>
            <h3 class="inline-block align-middle text-base font-bold pl-2"><?= \frontend\models\UserData::find()->where(['user_id' => $item['user_id']])->one()['fullname'] ?></h3>
            <h4 class="inline-block align-middle text-xs text-gray-300 pl-5"><?= Yii::$app->formatter->asDate($item['date_add'], 'dd.MM.yyyy') ?></h4>
        </div>
        <div class="py-3 pl-2 text-sm">
            <?= $item['comment'] ?>
        </div>
        <div>
            <button id="responseComment" comment-id="<?= $item['id'] ?>" class="inline-block align-middle text-sm hover:underline text-gray-500 mr-2 last:mr-0">Ответить</button>
            <?php if ( $permission['updateNews'] || $item['user_id'] == $user_id ): ?>
                <button id="deleteComment" comment-id="<?= $item['id'] ?>" class="inline-block align-middle text-sm hover:underline text-gray-500 mr-2 last:mr-0">Удалить</button>
            <?php endif; ?>
        </div>
        <?php $responsesComment = \frontend\models\NewsComments::find()->where(['status' => 1])->andWhere(['parent_comment_id' => $item['id']])->orderBy(['date_add' => SORT_DESC])->all(); ?>
        <?php if ( $responsesComment ): ?>
            <?php foreach ( $responsesComment as $rescomment ): ?>
                <div class="mt-4 grid grid-cols-[60px_auto]">
                    <div></div>
                    <div>
                        <div class="mb-4 last:mb-0">
                            <div>
                                <div class="inline-block align-middle w-[45px] h-[45px] border border-solid border-main-red rounded-full bg-center bg-no-repeat bg-cover" style="background-image: url('/frontend/web/<?= \frontend\models\UserAvatar::find()->where(['user_id' => $rescomment['user_id']])->one()['src'] ?>');"></div>
                                <h3 class="inline-block align-middle text-base font-bold pl-2"><?= \frontend\models\UserData::find()->where(['user_id' => $rescomment['user_id']])->one()['fullname'] ?></h3>
                                <h4 class="inline-block align-middle text-xs text-gray-300 pl-5"><?= Yii::$app->formatter->asDate($rescomment['date_add'], 'dd.MM.yyyy') ?></h4>
                                <h4 class="inline-block align-middle text-xs text-gray-300 pl-5 font-bold">ответ пользователю <?= \frontend\models\UserData::find()->where(['user_id' => $item['user_id']])->one()['fullname'] ?></h4>
                            </div>
                            <div class="py-3 pl-2 text-sm">
                                <?= $rescomment['comment'] ?>
                            </div>
                            <div>
                                <?php if ( $permission['updateNews'] || $rescomment['user_id'] == $user_id ): ?>
                                    <button id="deleteComment" comment-id="<?= $rescomment['id'] ?>" class="inline-block align-middle text-sm hover:underline text-gray-500 mr-2 last:mr-0">Удалить</button>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>

<?php
endforeach;