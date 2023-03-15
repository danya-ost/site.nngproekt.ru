let doc = $(document);

let app_data_profile_bar = (function(){

    function open_profile_bar(__profile_bar){
        __profile_bar.css('visibility', 'visible').animate({
            opacity: 1
        }, 150);
    }

    function close_profile_bar(__profile_bar){
        __profile_bar.animate({
            opacity: 0
        }, 150);

        setTimeout(function(){
            __profile_bar.css('visibility', 'hidden');
        }, 150);
    }


    function init(){
        $('button[data-nngp-name="#profile_bar"]').on('click', function(){
            let __profile_bar = $('div[data-nngp-name="profile_bar"]');
            open_profile_bar(__profile_bar);
        });

        $('button[data-nngp-name="*profile_bar"]').on('click', function(){
            let __profile_bar = $('div[data-nngp-name="profile_bar"]');
            close_profile_bar(__profile_bar);
        });
    }

    return {
        init: init
    }

})();


doc.ready(app_data_profile_bar.init);



let app_view_foto = (function(){

    function get_id(__id, __count){
        __id = parseInt(__id);
        __count = parseInt(__count) - 1;

        let __id_prev = __id-1;
        let __id_next = __id+1;


        if( __id != 0 ){
            if ( __id == __count ){
                __id_prev = __id-1;
                __id_next = __count;
            } else{
                __id_prev = __id-1;
                __id_next = __id+1;
            }
        } else{
            __id_prev = 0;
            __id_next = __id+1;
        }

        $('#galleryPrev').attr('data-nngp-slide', __id_prev);
        $('#galleryNext').attr('data-nngp-slide', __id_next);
    }

    function open_view_foto(__modal, __src, __id, __count, __body){
        let __content = $('div[data-nngp-name="galleryModal"] > div > div');

        get_id(__id, __count);

        __content.css('background-image', 'url(\''+__src+'\')');

        __body.css('overflow-y', 'hidden');

        __modal.css('visibility', 'visible').animate({
            opacity: 1
        }, 150);
    }

    function close_view_foto(__modal, __body){
        __body.removeAttr('style');

        __modal.animate({
            opacity: 0
        }, 150);

        setTimeout(function(){
            __modal.css('visibility', 'hidden');
        }, 150);
    }

    function slider_foto(__modal, __src, __id, __count){
        let __content = $('div[data-nngp-name="galleryModal"] > div > div');

        get_id(__id, __count);

        __content.css('background-image', 'url(\''+__src+'\')');
    }


    function init(){
        let __count = $('div[data-nngp-name="#galleryModal"] > button').length;
        let __body = $('body');

        $('div[data-nngp-name="#galleryModal"]').on('click', 'button', function(){
            let __modal = $('div[data-nngp-name="galleryModal"]');
            let __src = $(this).attr('data-nngp-src');
            let __id = $(this).attr('data-nngp-id');
            open_view_foto(__modal, __src, __id, __count, __body);
        });

        $('#galleryModalClose').on('click', function(){
            let __modal = $('div[data-nngp-name="galleryModal"]');
            close_view_foto(__modal, __body);
        });

        $('#galleryPrev, #galleryNext').on('click', function(){
            let __modal = $('div[data-nngp-name="galleryModal"]');
            let __id = $(this).attr('data-nngp-slide');
            let __src = $('button[data-nngp-id="'+__id+'"]').attr('data-nngp-src');
            slider_foto(__modal, __src, __id, __count);
        });
    }

    return {
        init: init
    }

})();


doc.ready(app_view_foto.init);


let app_project_select = (function(){

    function open_project_select(__select_block){
        __select_block.css('visibility', 'visible').animate({
            opacity: 1
        }, 150);
    }

    function close_project_select(__select_block){
        __select_block.animate({
            opacity: 0
        }, 150);

        setTimeout(function(){
            __select_block.css('visibility', 'hidden')
        }, 150);
    }

    function selected(__val, __text){
        $('#projectSelect').text(__text);
    }

    function init(){
        let __select_block = $('#projectSelectBlock');

        $('#projectSelect').on('click', function(){
            open_project_select(__select_block);
        });

        $('#projectSelectBlock > select').bind('change', function(){
            let __option = $(this).children('option:selected');
            let __val = __option.val();
            let __text = __option.text();
            selected(__val, __text);
            close_project_select(__select_block);
        });
    }

    return {
        init: init
    }

})();


doc.ready(app_project_select.init);


let app_abs_modal = (function(){
    function open_abs_modal(__modal){ __modal.css('visibility', 'visible').animate({ opacity: 1 }, 150); }
    function close_abs_modal(__modal){ __modal.animate({ opacity: 0 }, 150); setTimeout(function(){ __modal.css('visibility', 'hidden'); }, 150); }
    function init(){
        let __modal = $('#absModal');
        let __modal_up = $('#absModalUpdate');
        let __modal_add = $('#absModalAdd');
        $('button[data-nngp-funct="absModalOpen"]').on('click', function(){ open_abs_modal(__modal); });
        $('#container_onload').on('click', 'button[data-nngp-funct=\'absModalUpdateOpen\']', function(){ open_abs_modal(__modal_up); });
        $('#container_view').on('click', 'button[data-nngp-funct=\'absModalUpdateOpen\']', function(){
            close_abs_modal(__modal);
            open_abs_modal(__modal_up);
        });
        $('button[data-nngp-funct="absModalAddOpen"]').on('click', function(){ open_abs_modal(__modal_add); });
        $('#absModalClose').on('click', function(){ close_abs_modal(__modal); });
        $('#absModalUpdateClose').on('click', function(){ close_abs_modal(__modal_up); });
        $('#absModalAddClose').on('click', function(){ close_abs_modal(__modal_add); });
    }
    return { init: init }
})();
doc.ready(app_abs_modal.init);