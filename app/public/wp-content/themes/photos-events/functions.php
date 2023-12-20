<?php

/**
 * photos-events Fonctions et définitions du thème
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package photos-events
 */

if (!defined('_S_VERSION')) {
	// Remplacez le numéro de version du thème à chaque mise à jour.
	define('_S_VERSION', '1.0.0');
}

/**
 * Paramètre les configurations du thème et enregistre le support de diverses fonctionnalités WordPress.
 *
 * Remarque : Cette fonction est accrochée à l'action 'after_setup_theme', qui s'exécute avant l'action 'init'.
 */
function photos_events_setup()
{
	load_theme_textdomain('photos-events', get_template_directory() . '/languages');

	add_theme_support('automatic-feed-links');

	add_theme_support('title-tag');

	add_theme_support('post-thumbnails');
	register_nav_menus(
		array(
			'topbar_menu' => esc_html__('Barre supérieure', 'your_theme_textdomain'),
			'main_menu'   => esc_html__('Main', 'your_theme_textdomain'),
			'footer_menu' => esc_html__('Footer', 'your_theme_textdomain'),
			'mobile_menu' => esc_html__('Mobile (optional)', 'your_theme_textdomain'),

		)
	);
	function register_my_footer_menu()
	{
		register_nav_menu('footer', __('footer'));
	}

	add_action('after_setup_theme', 'register_my_footer_menu');
	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'style',
			'script',
		)
	);

	add_theme_support(
		'custom-background',
		apply_filters(
			'photos_events_custom_background_args',
			array(
				'default-color' => 'ffffff',
				'default-image' => '',
			)
		)
	);

	add_theme_support('customize-selective-refresh-widgets');

	add_theme_support(
		'custom-logo',
		array(
			'height' => 250,
			'width' => 250,
			'flex-width' => true,
			'flex-height' => true,
		)
	);
}
add_action('after_setup_theme', 'photos_events_setup');

/**
 * Définit la largeur du contenu en pixels, en fonction de la conception et de la feuille de style du thème.
 *
 * Priorité 0 pour le rendre disponible pour les rappels de priorité inférieure.
 *
 * @global int $content_width
 */
function photos_events_content_width()
{
	$GLOBALS['content_width'] = apply_filters('photos_events_content_width', 640);
}
add_action('after_setup_theme', 'photos_events_content_width', 0);

/**
 * Enregistre la zone de widgets.
 */
function photos_events_widgets_init()
{
	register_sidebar(
		array(
			'name' => esc_html__('Sidebar', 'photos-events'),
			'id' => 'sidebar-1',
			'description' => esc_html__('Ajoutez des widgets ici.', 'photos-events'),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget' => '</section>',
			'before_title' => '<h2 class="widget-title">',
			'after_title' => '</h2>',
		)
	);
}
add_action('widgets_init', 'photos_events_widgets_init');

/**
 * Ajoute des scripts et des styles.
 */
function photos_events_scripts()
{
	wp_enqueue_style('photos-events-style', get_stylesheet_uri(), array(), _S_VERSION);
	wp_style_add_data('photos-events-style', 'rtl', 'replace');

	wp_enqueue_script('photos-events-navigation', get_template_directory_uri() . '/js/navigation.js', array(), _S_VERSION, true);

	if (is_singular() && comments_open() && get_option('thread_comments')) {
		wp_enqueue_script('comment-reply');
	}
}
add_action('wp_enqueue_scripts', 'photos_events_scripts');


/***ajouter le js script  */

function enqueue_custom_script()
{
	wp_enqueue_script('custom-script', get_template_directory_uri() . '/script.js', array('jquery'), '1.0', true);
	wp_localize_script('custom-script', 'ajax_object', array('ajaxurl' => admin_url('admin-ajax.php')));
}
add_action('wp_enqueue_scripts', 'enqueue_custom_script');


/**
 * Implémente la fonctionnalité d'en-tête personnalisé.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Balises de modèle personnalisées pour ce thème.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Fonctions améliorant le thème en se branchant sur WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Ajouts du personnalisateur.
 */
require get_template_directory() . '/inc/customizer.php';





//Actions WordPress pour les requêtes AJAX : 
add_action('wp_ajax_load_more_photos', 'load_more_photos');
add_action('wp_ajax_nopriv_load_more_photos', 'load_more_photos');

function load_more_photos()
{
	$page = $_POST['page']; // Récupère le numéro de la page depuis la requête AJAX

	$args = array(
		'post_type' => 'photos',
		'posts_per_page' => 8,
		'paged' => $page // Utilisation de la pagination pour récupérer les prochaines photos
	);

	$photos_query = new WP_Query($args); // Requête pour récupérer les photos

	if ($photos_query->have_posts()) {
		while ($photos_query->have_posts()) {
			$photos_query->the_post();
			if (has_post_thumbnail()) {
				$image_url = wp_get_attachment_image_src(get_post_thumbnail_id(), 'full');
				echo '<div class="gallery-item"><img src="' . $image_url[0] . '" alt="' . get_the_title() . '"></div>';
			}
		}
		wp_reset_postdata(); // Réinitialise les données des requêtes WordPress
	} else {
		echo ''; // Si aucune photo n'est trouvée, renvoie une chaîne vide
	}
	wp_die(); // Termine le processus PHP proprement
}


/*charger plus pour single page */
/*Ajout de l'action WordPress pour la requête AJAX :*/

add_action('wp_ajax_load_more_single_photos', 'load_more_single_photos');
add_action('wp_ajax_nopriv_load_more_single_photos', 'load_more_single_photos');

/*La fonction pour charger plus de photos dans une page "single" :*/


function load_more_single_photos()
{
	$page = $_POST['page']; // Récupère le numéro de la page depuis la requête AJAX

	$args = array(
		'post_type'      => 'photos', // Assurez-vous que le type de publication est correct
		'posts_per_page' => 8,
		'paged'          => $page // Utilisation de la pagination pour récupérer les prochaines photos
	);

	$photos_query = new WP_Query($args); // Requête pour récupérer les photos

	if ($photos_query->have_posts()) {
		while ($photos_query->have_posts()) {
			$photos_query->the_post();
			if (has_post_thumbnail()) {
				$image_url = wp_get_attachment_image_src(get_post_thumbnail_id(), 'full');
				echo '<div class="gallery-item"><img src="' . $image_url[0] . '" alt="' . get_the_title() . '"></div>';
			}
		}
		wp_reset_postdata(); // Réinitialise les données des requêtes WordPress
	} else {
		echo ''; // Si aucune photo n'est trouvée, renvoie une chaîne vide
	}
	wp_die(); // Termine le processus PHP proprement
}
/*miniature*/
