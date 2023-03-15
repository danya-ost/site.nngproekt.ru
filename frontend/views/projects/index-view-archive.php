<?php

/** @var \yii\web\View $this */
/** @var \frontend\controllers\ProjectsController $data */
/** @var \frontend\controllers\ProjectsController $permission */

use yii\helpers\Url;

$i = 1;
foreach ( $data as $item ):
?>
    <tr class="border-b">
        <td class="text-sm text-black font-medium text-left px-2 py-1 border-r last:border-none">
            <?= $i ?>
        </td>
        <td class="text-sm text-black font-medium text-left px-2 py-1 border-r last:border-none">
            <?= $item['title'] ?>
        </td>
        <td class="text-sm text-black font-medium text-left px-2 py-1 border-r last:border-none">
            <?= $item['customer'] ?>, <?= $item['customer_address'] ?>
        </td>
        <td class="w-[100px] text-sm text-black font-medium text-left px-2 py-1 border-r last:border-none">
            <?= $item['date'] ?>
        </td>
        <td class="text-sm text-black font-medium text-left px-2 py-1 border-r last:border-none">
            <?= $item['text'] ?>
        </td>
    </tr>
<?php
$i++;
endforeach;
if ( count($data) == 0 ):
    ?>
    <tr>
        <td colspan="5" class="font-bold text-sm text-left">
            Ничего не найдено...
        </td>
    </tr>
<?php
endif;