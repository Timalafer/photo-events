<?php

/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package photos-events
 */

?>

<!doctype html>
<html lang="fr">

<head>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300&family=Space+Mono&display=swap" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Space+Mono&display=swap" rel="stylesheet">
	<script src="https://kit.fontawesome.com/6417d2c820.js" crossorigin="anonymous"></script>

	<title>NathalieMota</title>
	<?php wp_head() ?>
</head>

<body <?php body_class(); ?>>
	<?php wp_body_open(); ?>
	<div id="page" class="site">

		<header id="masthead" class="site-header">
			<div class="logo">
				<?php the_custom_logo(); ?>
			</div>

			<nav id="site-navigation" class="main-navigation">
				<?php
				wp_nav_menu(
					array(
						'theme_location' => 'Main Menu',
						'menu_class' => '.menu-navigation',
						// Vous pouvez ajouter d'autres paramètres ici en fonction de vos besoins
					)
				);
				?>
			</nav>
		</header><!-- #masthead -->