<?php

/** @var \frontend\controllers\TalentsController $data */

foreach ( $data as $item ):
?>
<a href="<?= $item['href'] ?>" class="grid grid-cols-[40%_60%] grid-rows-1 bg-white">
    <div class="bg-no-repeat bg-center bg-cover" style="background-image: url('/frontend/web/<?= $item['image_src'] ?>');">
        <div class="py-1 px-5 bg-main-red font-light text-xs text-white inline-block mt-4">
            <?= $item['category'] ?>
        </div>
    </div>
    <div class="p-6">

        <div class="flex items-center justify-start mb-3">
            <span class="font-light text-xs text-stone-400 mr-3"><?= $item['date_add'] ?></span>
            <span class="flex items-center justify-start">
                <svg width="14" height="9" viewBox="0 0 14 9" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M7 9C11.1794 9 14 5.56268 14 4.49738C14 3.43732 11.1743 0 7 0C2.88235 0 0 3.43732 0 4.49738C0 5.56268 2.87721 9 7 9ZM7.00515 7.36268C5.43529 7.36268 4.18456 6.05598 4.17941 4.50262C4.17426 2.89679 5.43529 1.63732 7.00515 1.63732C8.56471 1.63732 9.82574 2.90204 9.82574 4.50262C9.82574 6.05598 8.56471 7.36268 7.00515 7.36268ZM7.00515 5.56793C7.58162 5.56793 8.06029 5.08513 8.06029 4.50262C8.06029 3.91487 7.58162 3.42682 7.00515 3.42682C6.41838 3.42682 5.94485 3.91487 5.94485 4.50262C5.94485 5.08513 6.41838 5.56793 7.00515 5.56793Z" fill="#D7D5D5"/>
                </svg>
                <span class="font-light text-xs text-stone-400 ml-1"><?= $item['views'] ?></span>
            </span>
        </div>

        <h1 class="font-light text-xl leading-6 mt-5">
            <?= $item['title'] ?>
        </h1>

        <p class="font-light text-xs leading-3 mt-4">
            <?= $item['annotation'] ?>
        </p>

        <div class="inline-block font-light text-md text-black uppercase mt-6 relative after:block after:content-[''] after:absolute after:left-0 after:-bottom-px after:bg-black after:h-px after:w-full">
            ЧИТАТЬ
        </div>

    </div>
</a>
<?php
endforeach;
