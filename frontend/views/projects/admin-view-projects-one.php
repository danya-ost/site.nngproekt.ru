<?php

/** @var \frontend\controllers\ProjectsController $data */

use yii\helpers\Url;

?>
<div class="w-full h-[150px] shadow-[0px_0px_10px_0px_#00000017] bg-white grid grid-cols-[15%_85%] grid-rows-1">
    <div class="relative">
        <div class="w-[45px] h-[45px] rounded-full bg-stone-300 flex items-center justify-center absolute top-2/4 -translate-y-2/4 left-2/4 -translate-x-2/4">
            <svg width="19" height="19" viewBox="0 0 19 19" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M18.1094 3.85938H13.9531V1.78125C13.9531 0.962766 13.2872 0.296875 12.4688 0.296875H6.53125C5.71277 0.296875 5.04688 0.962766 5.04688 1.78125V3.85938H0.890625C0.39952 3.85938 0 4.25893 0 4.75V10.6875C0 11.0745 0.248225 11.4045 0.59375 11.5271V17.2188C0.59375 18.0372 1.25964 18.7031 2.07812 18.7031H16.9219C17.7404 18.7031 18.4062 18.0372 18.4062 17.2188V11.5271C18.7518 11.4045 19 11.0745 19 10.6875V4.75C19 4.25893 18.6005 3.85938 18.1094 3.85938ZM5.64062 1.78125C5.64062 1.29018 6.04014 0.890625 6.53125 0.890625H12.4688C12.9599 0.890625 13.3594 1.29018 13.3594 1.78125V3.85938H12.7656V1.78125C12.7656 1.6173 12.6327 1.48438 12.4688 1.48438H6.53125C6.3673 1.48438 6.23438 1.6173 6.23438 1.78125V3.85938H5.64062V1.78125ZM6.82812 3.85938V2.07812H12.1719V3.85938H6.82812ZM17.8125 17.2188C17.8125 17.7098 17.4129 18.1094 16.9219 18.1094H2.07812C1.58706 18.1094 1.1875 17.7098 1.1875 17.2188V11.5781H7.125V12.1719C7.125 12.6629 7.52456 13.0625 8.01562 13.0625H8.3125V13.6562C8.3125 14.311 8.84521 14.8438 9.5 14.8438C10.1548 14.8438 10.6875 14.311 10.6875 13.6562V13.0625H10.9844C11.4754 13.0625 11.875 12.6629 11.875 12.1719V11.5781H17.8125V17.2188ZM11.2812 12.1719C11.2812 12.3356 11.1481 12.4688 10.9844 12.4688C8.78442 12.4688 9.26725 12.4688 8.01562 12.4688C7.85194 12.4688 7.71875 12.3356 7.71875 12.1719V10.3906C7.71875 10.2269 7.85194 10.0938 8.01562 10.0938H10.9844C11.1481 10.0938 11.2812 10.2269 11.2812 10.3906V12.1719ZM8.90625 13.0625H10.0938V13.6562C10.0938 13.9836 9.82738 14.25 9.5 14.25C9.17262 14.25 8.90625 13.9836 8.90625 13.6562V13.0625ZM18.4062 10.6875C18.4062 10.8512 18.2731 10.9844 18.1094 10.9844H11.875V10.3906C11.875 9.89956 11.4754 9.5 10.9844 9.5H8.01562C7.52456 9.5 7.125 9.89956 7.125 10.3906V10.9844H0.890625C0.726936 10.9844 0.59375 10.8512 0.59375 10.6875V4.75C0.59375 4.58631 0.726936 4.45312 0.890625 4.45312H18.1094C18.2731 4.45312 18.4062 4.58631 18.4062 4.75V10.6875Z" fill="black"/>
            </svg>
        </div>
    </div>
    <div class="py-6 pr-6 px-2 relative">
        <p class="font-medium text-sm">
            <?= $data['title'] ?>
        </p>
        <p class="font-light text-[10px] text-stone-400 mt-4">
            <?= $data['customer'] ?>
        </p>

        <div class="absolute right-5 bottom-6 left-0">

            <a href="<?= Url::to(['/projects/view-project', 'p' => $data['id']]) ?>" title="Просмотр" class="inline-block align-middle float-right rounded px-3 py-2.5 ml-1 bg-gray-800 text-white font-medium text-xs leading-tight uppercase shadow-md hover:bg-gray-900 hover:shadow-lg focus:bg-gray-900 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-gray-900 active:shadow-lg transition duration-150 ease-in-out">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 inline-block align-middle">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" />
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                </svg>
            </a>

        </div>
    </div>
</div>