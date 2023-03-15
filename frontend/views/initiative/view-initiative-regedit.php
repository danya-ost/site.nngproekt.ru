<?php

/** @var \frontend\controllers\InitiativeController $data */
/** @var \frontend\controllers\InitiativeController $i */

use yii\helpers\Url;

foreach ( $data as $key => $item ):
?>
<tr name="initiative_item_<?= $item['id'] ?>" class="border-b-2 border-stone-200 border-solid hover:bg-stone-200">
    <td class="text-xs font-light text-black leading-[14.4px] py-5 text-left px-2 py-1 border-r-2 border-stone-200 border-solid last:border-none">
        <?= $i++ ?>
    </td>
    <td class="text-xs font-light text-black leading-[14.4px] py-5 text-left px-2 py-1 border-r-2 border-stone-200 border-solid last:border-none">
        <?= $item['date'] ?>
    </td>
    <td class="text-xs font-light text-black leading-[14.4px] py-5 text-left px-2 py-1 border-r-2 border-stone-200 border-solid last:border-none">
        <?= $item['abbreviation'] ?>
    </td>
    <td class="text-xs font-light text-black leading-[14.4px] py-5 text-left px-2 py-1 border-r-2 border-stone-200 border-solid last:border-none whitespace-nowrap">
        <?= $item['author'] ?> <br>
        <?= $item['supportive'] ?>
    </td>
    <td class="text-xs font-light text-black leading-[14.4px] py-5 text-left px-2 py-1 border-r-2 border-stone-200 border-solid last:border-none">
        <?= $item['status'] ?>
    </td>
    <td class="text-xs font-light text-black leading-[14.4px] py-5 text-left px-2 py-1 border-r-2 border-stone-200 border-solid last:border-none">
        <?= $item['title'] ?>
    </td>
    <td class="text-xs font-light text-black leading-[14.4px] py-5 text-left px-2 py-1 border-r-2 border-stone-200 border-solid last:border-none">
        <?= $item['effect_meta'] == NULL ? '-' : $item['effect_meta'] ?>
    </td>
    <td class="text-xs font-light text-black leading-[14.4px] py-5 text-left px-2 py-1 border-r-2 border-stone-200 border-solid last:border-none">
        <?= $item['rewarded'] == NULL ? '-' : $item['rewarded'] . 'руб.' ?>
    </td>
    <td class="text-xs font-light text-black leading-[14.4px] py-5 text-left px-2 py-1 border-r-2 border-stone-200 border-solid last:border-none text-center">
        <?php if ( $item['status_id'] == 1 || $item['status_id'] == 5 ): ?>
            <button type="button" disabled class="font-light text-xs text-stone-300">
                <svg width="13" height="14" viewBox="0 0 13 14" class="inline-block align-middle" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                    <g clip-path="url(#clip0_1658_8681)">
                        <path d="M12.5952 2.0818L11.4172 0.903682C10.8789 0.365427 10.0032 0.365452 9.465 0.903682L9.00391 1.3648L12.1342 4.49531L12.5952 4.03419C13.1347 3.49466 13.1348 2.62138 12.5952 2.0818Z"/>
                        <path d="M0.558895 10.0659L0.00637087 13.0498C-0.0164553 13.1732 0.0228494 13.2998 0.111539 13.3885C0.200329 13.4773 0.327028 13.5165 0.450198 13.4937L3.4339 12.9411L0.558895 10.0659Z"/>
                        <path d="M8.46525 1.90332L0.969727 9.39943L4.09998 12.5299L11.5955 5.03383L8.46525 1.90332Z"/>
                    </g>
                    <defs>
                        <clipPath id="clip0_1658_8681">
                            <rect width="13" height="13" fill="white" transform="translate(0 0.5)"/>
                        </clipPath>
                    </defs>
                </svg>
                <span class="inline-block align-middle">Редактировать</span>
            </button>
        <?php else: ?>
            <a href="<?= Url::to(['/initiative/update', 'i' => $item['id']]) ?>" class="font-light text-xs text-black hover:text-main-red">
                <svg width="13" height="14" viewBox="0 0 13 14" class="inline-block align-middle" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                    <g clip-path="url(#clip0_1658_8681)">
                        <path d="M12.5952 2.0818L11.4172 0.903682C10.8789 0.365427 10.0032 0.365452 9.465 0.903682L9.00391 1.3648L12.1342 4.49531L12.5952 4.03419C13.1347 3.49466 13.1348 2.62138 12.5952 2.0818Z"/>
                        <path d="M0.558895 10.0659L0.00637087 13.0498C-0.0164553 13.1732 0.0228494 13.2998 0.111539 13.3885C0.200329 13.4773 0.327028 13.5165 0.450198 13.4937L3.4339 12.9411L0.558895 10.0659Z"/>
                        <path d="M8.46525 1.90332L0.969727 9.39943L4.09998 12.5299L11.5955 5.03383L8.46525 1.90332Z"/>
                    </g>
                    <defs>
                        <clipPath id="clip0_1658_8681">
                            <rect width="13" height="13" fill="white" transform="translate(0 0.5)"/>
                        </clipPath>
                    </defs>
                </svg>
                <span class="inline-block align-middle">Редактировать</span>
            </a>
        <?php endif; ?>
    </td>
</tr>
<?php
endforeach;
if ( count($data) == 0 ):
?>
<tr>
    <td colspan="9" class="text-sm text-black font-bold text-left px-2 py-1">
        Ничего не найдено...
    </td>
</tr>
<?php
endif;