<?php

function mota_style() {
	wp_enqueue_style('theme', get_theme_file_uri() . '/assets/css/theme', time());
}
add_action('wp_enqueue_scripts', 'mota_style');

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

function mota_js() {
    wp_enqueue_script('theme-script', get_theme_file_uri() . '/assets/js/script.js', array('jquery'), time(), true);
    wp_enqueue_script('thumbnail', get_theme_file_uri() . '/assets/js/thumbnail.js', array('jquery'), time(), true);
}
add_action( 'wp_enqueue_scripts', 'mota_js' );

?>