    <?php get_template_part("templates_part/modale_contact") ?>

    <?php get_template_part("templates_part/lightbox") ?>
    
    </main>

    <footer>
    <?php if (has_nav_menu('footer-menu')): ?>
    <?php wp_nav_menu(
        array(
            'theme_location' => 'footer-menu',
            'container' => 'false',
            'menu_class' => 'my-footer-menu',
        )
    ); ?>
    <?php endif;
    ?>
    </footer>
<?php wp_footer(); ?>

</body>
</html>