<?php get_header(); ?>


<section id="header">
    <div class="hero-header">
        <h1>Photographe event</h1>
        <?php
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

<section id="containerPhoto" class="blockCatalogue">
    <?php
        // Récupération de 8 photos aléatoires pour le bloc initial
        $args = array(
            'post_type' => 'photos',
            'posts_per_page' => 8,
            'orderby' => 'rand',
        );
        $photo_block = new WP_Query($args);

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
        <button id="plusDImage">Charger plus</button>
    </div>
</section>

<?php get_footer(); ?>