<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php wp_head(); ?>
</head>

<body>
<header class="site-header">
	<nav id="site-navigation" class="siteNavigation" role="navigation">
		<div class="logo">
			<?php the_custom_logo(); ?>
		</div>
	
		<div class="burgerMenu">
			<span class="bar"></span>
			<span class="bar"></span>
			<span class="bar"></span>
		</div>
								
		<div class="navigation">
			<?php
			wp_nav_menu(
				array(
					'theme_location' => 'header-menu',
					'container'      => 'false',
					'menu_class'     => 'menuNavigation',
				)
            );
			?>
		</div>	
	</nav>

</header>
<main>


