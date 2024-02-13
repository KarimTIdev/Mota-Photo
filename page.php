<?php get_header(); ?>


    <?php if ( have_posts() ) : ?>

    <?php 
	    while ( have_posts() ) :
		    the_post(); 
    ?>
            <h1><?php get_the_title(); ?></h1>
            <section class="container">
                <?php the_content(); ?>


            </section>

	<?php endwhile; ?>
    
    <?php endif; ?>
    
<?php get_footer(); ?>