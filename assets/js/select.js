jQuery(document).ready(function($){
    $('.taxonomy-select').select2({
        dropdownPosition: 'below',
    });
});

jQuery(document).ready(function($){
   // Fonction s'occuppant du changement de couleur au survol
    $(".bouton").hover(
        function(){
            // Début du survol
            $(this).find("a").css("color", "#fff"); // Change la couleur de fond à rouge (#ff0000)
        },
        function(){
            // Fin du survol
            $(this).find("a").css("color", "#000"); // Rétablir la couleur de fond par défaut
        }
    );
});
