<?php

/** @var \frontend\controllers\AbsController $permission */
/** @var \frontend\controllers\AbsController $data */
/** @var \yii\web\View $this */

?>
<div name="main_container_<?= $data['id'] ?>" class="relative">
    <button type="button" class="owl-abs-prev hidden absolute left-4 top-2/4 -translate-y-2/4 z-30 bg-white hover:bg-main-red text-black hover:text-white w-[37px] h-[37px] sm:flex items-center justify-center rounded-full">
        <svg class="rotate-180" width="21" height="8" viewBox="0 0 21 8" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
            <path d="M20.3536 4.35355C20.5488 4.15829 20.5488 3.84171 20.3536 3.64645L17.1716 0.464466C16.9763 0.269204 16.6597 0.269204 16.4645 0.464466C16.2692 0.659728 16.2692 0.976311 16.4645 1.17157L19.2929 4L16.4645 6.82843C16.2692 7.02369 16.2692 7.34027 16.4645 7.53553C16.6597 7.7308 16.9763 7.7308 17.1716 7.53553L20.3536 4.35355ZM0 4.5H20V3.5H0V4.5Z"/>
        </svg>
    </button>
    <button type="button" class="owl-abs-next hidden absolute right-4 top-2/4 -translate-y-2/4 z-30 bg-white hover:bg-main-red text-black hover:text-white w-[37px] h-[37px] sm:flex items-center justify-center rounded-full">
        <svg width="21" height="8" viewBox="0 0 21 8" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
            <path d="M20.3536 4.35355C20.5488 4.15829 20.5488 3.84171 20.3536 3.64645L17.1716 0.464466C16.9763 0.269204 16.6597 0.269204 16.4645 0.464466C16.2692 0.659728 16.2692 0.976311 16.4645 1.17157L19.2929 4L16.4645 6.82843C16.2692 7.02369 16.2692 7.34027 16.4645 7.53553C16.6597 7.7308 16.9763 7.7308 17.1716 7.53553L20.3536 4.35355ZM0 4.5H20V3.5H0V4.5Z"/>
        </svg>
    </button>
    <div class="owl-carousel owl-carousel-abs_<?= $data['id'] ?> owl-theme w-full h-full">
        <?php foreach ( $data['files'] as $file ): ?>
            <div class="h-[150px] md:h-[336px] bg-no-repeat bg-center bg-cover" style="background-image: url('/frontend/web/<?= $file['src'] ?>');"></div>
        <?php endforeach; ?>
    </div>
</div>
<div class="px-5 md:px-14 py-2 sm:py-5">
    <div class="flex items-center justify-between mb-9">
        <div class="font-light text-xl text-stone-400">
            <?= $data['user'] ?>
        </div>
        <div class="font-light text-xl text-stone-400">
            <?= $data['date'] ?>
        </div>
        <?php if ( $permission ): ?>
            <button type="button" data-nngp-funct="absModalUpdateOpen" class="text-[#868686] hover:text-main-red">
                <svg width="13" height="13" viewBox="0 0 13 13" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                    <g clip-path="url(#clip0_1127_8460)">
                        <path d="M12.5952 1.5818L11.4172 0.403682C10.8789 -0.134573 10.0032 -0.134548 9.465 0.403682L9.00391 0.8648L12.1342 3.99531L12.5952 3.53419C13.1347 2.99466 13.1348 2.12138 12.5952 1.5818Z"/>
                        <path d="M0.558895 9.56567L0.00637087 12.5496C-0.0164553 12.6729 0.0228494 12.7996 0.111539 12.8883C0.200329 12.9771 0.327028 13.0163 0.450198 12.9935L3.4339 12.4409L0.558895 9.56567Z"/>
                        <path d="M8.46574 1.40332L0.970215 8.89943L4.10047 12.0299L11.596 4.53383L8.46574 1.40332Z"/>
                    </g>
                    <defs>
                        <clipPath id="clip0_1127_8460">
                            <rect width="13" height="13" fill="white"/>
                        </clipPath>
                    </defs>
                </svg>
            </button>
        <?php endif; ?>
    </div>
    <h1 class="font-semibold text-2xl text-black">
        <?= $data['title'] ?>
    </h1>
    <p class="my-11 font-medium text-sm text-black">
        <?= $data['content'] ?>
    </p>
</div>
<?php
$script = <<<JS
    $('.owl-carousel-abs_'+$('div[name^=\'main_container_\']').attr('name').replace('main_container_', '')).owlCarousel({
        items: 1,
        margin: 0,
        loop: true,
        dots: false,
        nav: false,
        autoplay:true,
        autoplayTimeout:5000,
        autoplayHoverPause:true
    });
    $('.owl-abs-next').on('click', function(){
        $('.owl-carousel-abs_'+$('div[name^=\'main_container_\']').attr('name').replace('main_container_', '')).trigger("next.owl.carousel");
    });
    $('.owl-abs-prev').on('click', function(){
        $('.owl-carousel-abs_'+$('div[name^=\'main_container_\']').attr('name').replace('main_container_', '')).trigger("prev.owl.carousel");
    });

    $('.owl-carousel-abs_'+$('div[name^=\'main_container_\']').attr('name').replace('main_container_', '')).on('mousewheel', '.owl-stage', function (e) {
        if (e.deltaY>0) {
            $('.owl-carousel-abs_'+$('div[name^=\'main_container_\']').attr('name').replace('main_container_', '')).trigger('next.owl');
        } else {
            $('.owl-carousel-abs_'+$('div[name^=\'main_container_\']').attr('name').replace('main_container_', '')).trigger('prev.owl');
        }
        e.preventDefault();
    });
JS;

$this->registerJs($script, \yii\web\View::POS_LOAD);