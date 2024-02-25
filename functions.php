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
   
    wp_enqueue_script('modale', get_theme_file_uri() . '/assets/js/modale.js', array('jquery'), time(), true);
    wp_enqueue_script('thumbnail', get_theme_file_uri() . '/assets/js/thumbnail.js', array('jquery'), time(), true);
    wp_enqueue_script('load', get_theme_file_uri() . '/assets/js/load.js', array('jquery'), time(), true);
    wp_enqueue_script('filtres', get_theme_file_uri() . '/assets/js/filtres.js', array('jquery'), time(), true);
    wp_enqueue_script('lightbox', get_theme_file_uri() . '/assets/js/lightbox.js', array('jquery'), time(), true);
    wp_enqueue_script('select', get_theme_file_uri() . '/assets/js/select.js', array('jquery'), time(), true);
    wp_enqueue_script('select2-js', 'https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js', array('jquery'), '4.0.13', true);
    wp_enqueue_style('select2-css', 'https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css', array());


    $ajax_data=[
        'ajaxurl'=> admin_url('admin-ajax.php'),
    ];
    
    wp_add_inline_script('load', 'let ajax_data=' . wp_json_encode($ajax_data) . ';', 'before');


}
add_action( 'wp_enqueue_scripts', 'mota_js' );

// ------------------------- Fonction de chargement des photos -------------------------
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

// ------------------------- Fonction des filtres de triage des photos -------------------------

function filter_photos_function(){

    $filter = $_POST['filter'];

    $args = array(
        'post_type' => 'photos',
        'posts_per_page' => -1,
        'tax_query' => array(
            'relation' => 'AND',
        )
    );

    // Ajoute chaque filtre a la tax query si elle est definie
    if(!empty($filter['categorie'])){
        $args['tax_query'][] = array(
            'taxonomy' => 'categorie',
            'field'    => 'slug',
            'terms'    => $filter['categorie'],
        );
    }

    if(!empty($filter['format'])){
        $args['tax_query'][] = array(
            'taxonomy' => 'format',
            'field'    => 'slug',
            'terms'    => $filter['format'],
        );
    }

    if(!empty($filter['annee'])){
        $args['tax_query'][] = array(
            'taxonomy' => 'annee',
            'field'    => 'slug',
            'terms'    => $filter['annee'],
        );
    }

    $query = new WP_Query($args);

    if($query->have_posts()){
        while($query->have_posts()){
            $query->the_post();

            get_template_part('templates_part/photo_block', null);
        }
        wp_reset_postdata();
    } else {
        echo '<p class="critereFiltrage">Aucune photo ne correspond aux critères de filtrage</p>';
    }

    die();
}

add_action('wp_ajax_filter_photos', 'filter_photos_function');
add_action('wp_ajax_nopriv_filter_photos', 'filter_photos_function');
