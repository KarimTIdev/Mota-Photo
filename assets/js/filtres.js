(function($){

    function fetchFilteredPhotos(){
        var filter = {
            'categorie': $('#categorie').val(),
            'format': $('#format').val(),
            'annee': $('#annee').val(),
        };

        $.ajax({
            url: ajax_data.ajaxurl,
            data: {
                'action': 'filter_photos',
                'filter': filter
            },
            type: 'POST',
            beforeSend: function(){
                $('#containerPhoto').html('<div class="loading">Chargement...</div>');
            },
            success: function(data) {
                $('#containerPhoto').html(data);
                setTimeout(function() {
                document.getElementById('containerPhoto').scrollIntoView();
            }, 0);
        }})
    }

    $('#filtrePhoto select').on('change', function(event){
        event.preventDefault();
        fetchFilteredPhotos();
    });
})(jQuery);