<?php get_header(); ?>

<!-- Block Hero Header -->

<section id="header">
    <div class="hero-header">
        <h1>Photographe event</h1>
        <?php
        // Séléction d'une photo au hasard dans le CPT 'photos'
        $photo_args = array(
            'post_type' => 'photos',
            'posts_per_page' => 1,
            'orderby' => 'rand',
        );

        $photo_query = new WP_Query($photo_args);

        if ($photo_query->have_posts()) {
            while ($photo_query->have_posts()) {
                $photo_query->the_post();
                echo get_the_post_thumbnail(get_the_ID(), 'full'); 
            }
            wp_reset_postdata();
        }
        ?>
    </div>
</section>

<!-- Block Filtres -->
<section id="filtrePhoto">
    <?php
    // Affichage taxonomies
    $taxonomy = [
        'categorie' => 'CATÉGORIES',
        'format' => 'FORMATS',
    ];

    foreach ($taxonomy as $taxonomy_slug => $label) {
        $terms = get_terms($taxonomy_slug);
        if ($terms && !is_wp_error($terms)) {

            echo "<select id='$taxonomy_slug' class='custom-select taxonomy-select'>";

            echo "<option value=''>$label</option>";
            foreach ($terms as $term) {
                echo "<option value='$term->slug'>$term->name</option>";
            }
            echo "</select>";
        }
    }
    ?>
    <select id="annee" class="custom-select taxonomy-select">
        <option value="DESC">TRIER PAR</option>  
        <option value="DESC">à partir des plus récentes</option>    
        <option value="ASC"> à partir des plus anciennes</option>
    </select>
</section>

<!-- Block Catalogue -->

<section id="containerPhoto" class="blockCatalogue">
    <?php
        // On récupère 8 photos aléatoires pour le bloc de départ
        $args = array(
            'post_type' => 'photos',
            'posts_per_page' => 8,
            'orderby' => 'date',
            'order' => 'ASC',
        );
        $photo_block = new WP_Query($args);

        // On localise le script à executer et son objet
        wp_localize_script('load', 'ajaxloadmore', array(
            'ajaxurl' => admin_url('admin-ajax.php'),
            'query_vars' => json_encode($args)
            )
       );

        if ($photo_block->have_posts()) :
        
        set_query_var('photo_block_args', array('context' => 'front-page'));
            while ($photo_block->have_posts()) :
                $photo_block->the_post();
            get_template_part('templates_part/photo_block', get_post_format()); 
    ?>

    <?php
        endwhile; 
            wp_reset_postdata(); 
        else :
            echo 'Aucune photo trouvée.';
        endif; 
    ?>

    <div id="blockPusdImage">
        <button id="plusDImage" data-page="1" data-url="<?php echo admin_url('admin-ajax.php'); ?>">Charger plus</button>
    </div>
</section>

<?php get_footer(); ?>