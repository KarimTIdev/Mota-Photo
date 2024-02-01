<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php wp_head(); ?>
</head>

<body>
<header class="site-header">
    <div class="logo-nav">
        <div class="logo">
            <?php the_custom_logo(); ?>
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
<main>


