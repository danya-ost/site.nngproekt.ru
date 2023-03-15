let app_main_banner = (function(){

    function main_banner(__owl_block){
        $('.owl-main-banner-next').on('click', function(){
            __owl_block.trigger("next.owl.carousel");
        });
        $('.owl-main-banner-prev').on('click', function(){
            __owl_block.trigger("prev.owl.carousel");
        });
        
        __owl_block.on('mousewheel', '.owl-stage', function (e) {
            if (e.deltaY>0) {
                __owl_block.trigger('next.owl');
            } else {
                __owl_block.trigger('prev.owl');
            }
            e.preventDefault();
        });
    }

    function init(){
        __owl_block = $('.owl-carousel-main-banner');
        main_banner(__owl_block);
    }

    return {
        init: init
    }

})();

let app_honor_banner = (function(){

    function honor_banner(__owl_block){
        __owl_block.owlCarousel({
            items: 1,
            margin: 0,
            loop: true,
            dots: false,
            nav: false,
            autoplay:true,
            autoplayTimeout:5000,
            autoplayHoverPause:true
        });
        $('.owl-honor-banner-next').on('click', function(){
            __owl_block.trigger("next.owl.carousel");
        });
        $('.owl-honor-banner-prev').on('click', function(){
            __owl_block.trigger("prev.owl.carousel");
        });

        __owl_block.on('mousewheel', '.owl-stage', function (e) {
            if (e.deltaY>0) {
                __owl_block.trigger('next.owl');
            } else {
                __owl_block.trigger('prev.owl');
            }
            e.preventDefault();
        });
    }

    function init(){
        __owl_block = $('.owl-carousel-honor');
        honor_banner(__owl_block);
    }

    return {
        init: init
    }

})();

let app_abs_gallery = (function(){

    function abs_gallery(__owl_block){
        __owl_block.owlCarousel({
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
            __owl_block.trigger("next.owl.carousel");
        });
        $('.owl-abs-prev').on('click', function(){
            __owl_block.trigger("prev.owl.carousel");
        });

        __owl_block.on('mousewheel', '.owl-stage', function (e) {
            if (e.deltaY>0) {
                __owl_block.trigger('next.owl');
            } else {
                __owl_block.trigger('prev.owl');
            }
            e.preventDefault();
        });
    }

    function init(){
        __owl_block = $('.owl-carousel-abs');
        abs_gallery(__owl_block);
    }

    return {
        init: init
    }

})();



doc.ready(app_main_banner.init);
doc.ready(app_honor_banner.init);
// doc.ready(app_abs_gallery.init);