let modal_app = (function (){

    function modal_open(__modal, __body){
        __modal.css('visibility', 'visible').animate({
            opacity: 1
        }, 200);

        __body.css('overflow-y', 'hidden');
    }

    function modal_close(__modal, __body){
        __modal.animate({
            opacity: 0
        }, 200);
        setTimeout(function (){
            __modal.css('visibility', 'hidden');
        }, 200);

        __body.removeAttr('style');
    }

    function init(){
        let __body = $('body');
        let __modal = $('#templateModal');
        $('#my_appeals').on('click', 'button[id^=\'appeals_\']', function (){
            modal_open(__modal, __body);
        });

        $('#search_appeals').on('click', 'button[id^=\'appeals_\']', function (){
            modal_open(__modal, __body);
        });

        $('#closeModal').on('click', function (){
            modal_close(__modal, __body);
        });
    }

    return{
        init: init
    }

})();


doc.ready(modal_app.init);