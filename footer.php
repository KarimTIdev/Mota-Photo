    <?php get_template_part("templates_part/modale_contact") ?>
    
    
    
    <?php if (has_nav_menu('footer-menu')): ?>

    <?php wp_nav_menu(
        array(
            'theme_location' => 'footer-menu',
            'menu_class' => 'my-footer-menu',
        )
    ); ?>
<?php endif;
?>
    
<?php wp_footer(); ?>

</body>
</html>