<?php

function theme_enqueue_scripts()
{
    wp_enqueue_script('jquery');
    wp_enqueue_script('theme-script', get_template_directory_uri() . '/js/script.js');
}

add_action('wp_enqueue_scripts', 'theme_enqueue_scripts');



function theme_enqueue_style() {
	wp_enqueue_style('style', get_stylesheet_uri() );
    wp_enqueue_style('google-fonts', 'https://fonts.googleapis.com/css2?family=Space+Mono:ital,wght@0,400;0,700;1,400;1,700&display=swap');
    wp_enqueue_style('google-fonts-poppins', 'https://fonts.googleapis.com/css2?family=Poppins:wght@300&display=swap');
}
add_action('wp_enqueue_scripts', 'theme_enqueue_style');



function register_my_menus() {
    register_nav_menus(
        array(
            'header-menu' => __('Menu En-tête'),
            'footer-menu' => __('Menu Pied-de-page'),
        )
    );
}
add_action('init', 'register_my_menus');

?>