(function($) {
    $('#plusDImage').click(function() {
        var button = $(this),
            data = {
                'action': 'load_more',
                'query': ajaxloadmore.query_vars,
                'page': button.data('page')
            };

        $.ajax({
            url: ajax_data.ajaxurl,
            data: data,
            type: 'post',
            beforeSend: function(xhr) {
                button.text('Chargement...');
            },
            success: function(data) {
                if (data === 'no_posts') {
                    button.remove();
                } else if(data) {
                    button.data('page', button.data('page') + 1);
                    $('#blockPusdImage').before($(data));
                    button.text('Charger plus');
                }
            }
        });
    });
})(jQuery);


// (function($){
//     function test_ajax(){
//         $.ajax({
//             type : 'post',
//             url : ajax_data.ajaxurl,
//             data : {
//                 action : 'load_more',
//                 offset : 5,
//                 current : 1,
//             },
//             success : function(response){
//                 console.log('Réponse du serveur',response);
//             },
//             error : function(response){
//                 console.log('C"est un échec',response);
//             }
//         })
//     }
// $('#plusDImage').on('click',function(event){
//     console.log(ajax_data);
//     event.preventDefault();
//     test_ajax();
// })
// })(jQuery)