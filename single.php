<?php get_header(); ?>

<?php if ( have_posts() ) : ?>

<?php 
	while ( have_posts() ) :
		the_post();

	endwhile;
?>

<?php endif; ?>

<?php get_template_part( 'single-photo' ); ?>

<?php get_footer(); ?>