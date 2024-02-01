(function($){
    $('.contact-modale').on('click',function(e){
        e.preventDefault();
        $('#contact').css('display','flex');
    });
    $('#contact').on('click',function(e){
        if(e.target!==this) return;
        $('#contact').css('display','none');
    })
})(jQuery);