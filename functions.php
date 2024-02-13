<?php

function theme_enqueue_style() {
	wp_enqueue_style('theme', get_theme_file_uri() . '/assets/css/theme', time());
}
add_action('wp_enqueue_scripts', 'theme_enqueue_style');

function mota_js() {
    wp_enqueue_script('theme-script', get_theme_file_uri() . '/assets/js/script.js', array('jquery'), time(), true);
    wp_enqueue_script('thumbnail', get_theme_file_uri() . '/assets/js/thumbnail.js', array('jquery'), time(), true);
}
add_action( 'wp_enqueue_scripts', 'mota_js' );

function mota_setup() {
    register_nav_menus(
        array(
            'header-menu' => __('Menu En-tête'),
            'footer-menu' => __('Menu Pied-de-page'),
        )
    );
    add_theme_support('title-tag');
    add_theme_support('custom-logo');
}
add_action('after_setup_theme', 'mota_setup');

?>

<?php function motaphoto_request_photos()
{
    $query = new WP_Query([
        'post_type' => 'photos',
        'posts_per_page' => 1
    ]);

    if ($query->have_posts()) {
        wp_send_json($query);
    } else {
        wp_send_json(false);
    }

    wp_die();
}

add_action('wp_ajax_request_photos', 'motaphoto_request_photos');
add_action('wp_ajax_nopriv_request_photos', 'motaphoto_request_photos');
?>