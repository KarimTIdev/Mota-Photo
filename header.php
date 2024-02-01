<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mota Photo</title>
    <?php wp_head(); ?>
</head>

<body>
<header class="site-header">
    <div class="logo-nav">
        <div class="logo">
            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/Logo.png" alt="Logo Nathalie Mota" />
        </div>
        <div class="menu">
            <?php
            if (has_nav_menu('header-menu')):
            ?>
            <?php
                wp_nav_menu(
                    array(
                        'theme_location' => 'header-menu',
                        'menu_class' => 'my-header-menu',
                    )
                );
            ?>
        <?php endif; ?>
        </div>
    </div>
</header>

