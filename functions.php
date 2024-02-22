<?php
//------------------------- Enqueue du style -------------------------

function mota_style() {
	wp_enqueue_style('theme', get_theme_file_uri() . '/assets/css/theme', time());
}
add_action('wp_enqueue_scripts', 'mota_style');

//------------------------- Enqueue des menus ------------------------- 

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

//------------------------- Enqueue des différents scripts -------------------------

function mota_js() {
   
    wp_enqueue_script('theme-script', get_theme_file_uri() . '/assets/js/script.js', array('jquery'), time(), true);
    wp_enqueue_script('thumbnail', get_theme_file_uri() . '/assets/js/thumbnail.js', array('jquery'), time(), true);
    wp_enqueue_script('load', get_theme_file_uri() . '/assets/js/load.js', array('jquery'), time(), true);

    $ajax_data=[
        'ajaxurl'=> admin_url('admin-ajax.php'),
    ];
    
    wp_add_inline_script('load', 'let ajax_data=' . wp_json_encode($ajax_data) . ';', 'before');


}
add_action( 'wp_enqueue_scripts', 'mota_js' );

function load_more() {
    $paged = $_POST['page'] + 1;
    $query_vars = json_decode(stripslashes($_POST['query']), true);
    $query_vars['paged'] = $paged;
    $query_vars['posts_per_page'] = 8;
    $query_vars['orderby'] = 'date';

    $photos = new WP_Query($query_vars);
    if ($photos->have_posts()) {
        ob_start();
        while ($photos->have_posts()) {
            $photos->the_post();
            get_template_part('templates_part/photo_block', null);
        }
        wp_reset_postdata();

        $output = ob_get_clean();
        echo $output;
    }
    else {
        ob_clean();
        echo 'no_posts';
    }
        die();

}
add_action('wp_ajax_nopriv_load_more', 'load_more');
add_action('wp_ajax_load_more', 'load_more');

// function load_more() {
//     $offset=$_POST['offset'];
//     $current=$_POST['current'];
//     $test=[
//         'clef-1' => $offset,
//         'clef-2' => $current,
//     ];
//     wp_send_json($test);
// }