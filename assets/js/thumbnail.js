jQuery(document).ready(function($) {
    const miniPicture = $('#miniPicture');

    $('.arrow-left, .arrow-right').hover(
        function() {
            // On rend l'apercu de la photo visible lors du hover
            miniPicture.css({
                visibility: 'visible',
                opacity: 1
            // On récupère le thumbnail de l'élément ciblé
            }).html(`<a href="${$(this).data('target-url')}">
                        <img src="${$(this).data('thumbnail-url')}" alt="${$(this).hasClass('arrow-left') ? 'Photo précédente' : 'Photo suivante'}">
                    </a>`);
        },
        function() {
            // On repasse en non-visible
            miniPicture.css({
                visibility: 'hidden',
                opacity: 0
            });
        }
    );
        // On se rend sur l'URL de la l'élément ciblé lors du click
    $('.arrow-left, .arrow-right').click(function() {
        window.location.href = $(this).data('target-url');
    });
});