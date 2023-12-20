<?php

/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package photos-events
 */

get_header();
?>

<main id="primary" class="site-main">

	<?php
	while (have_posts()) :
		the_post();
	?>

		<section class="photo-details">

			<div class="photo-info">
				<h2 class="title-container "><?php the_title(); ?></h2>
				<ul class="taxonomies">
					<li>RÉFÉRENCE:
						<?php $reference = get_field('reference');
						echo $reference ? $reference : 'Aucune référence définie'; ?>
					</li>
					<li>CATÉGORIE:
						<?php $categories = get_the_terms($post->ID, 'categorie');
						if ($categories && !is_wp_error($categories)) {
							$category_names = array();
							foreach ($categories as $category) {
								$category_names[] = $category->name;
							}
							echo implode(', ', $category_names);
						} else {
							echo 'Aucune catégorie définie';
						} ?>
					</li>
					<li>FORMAT:
						<?php $formats = get_the_terms($post->ID, 'format');
						if ($formats && !is_wp_error($formats)) {
							$format_names = array();
							foreach ($formats as $format) {
								$format_names[] = $format->name;
							}
							echo implode(', ', $format_names);
						} else {
							echo 'Aucun format défini';
						} ?>
					</li>
					<li>TYPE:
						<?php $type = get_field('type');
						echo $type ? $type : 'Aucun type défini'; ?>
					</li>
					<li>ANNÉE:
						<?php $dates = get_the_terms($post->ID, 'date');
						if ($dates && !is_wp_error($dates)) {
							$date_names = array();
							foreach ($dates as $date) {
								$date_names[] = $date->name;
							}
							echo implode(', ', $date_names);
						} else {
							echo 'Aucune date définie';
						} ?>
					</li>

					<!-- Ajoutez d'autres taxonomies ici -->
				</ul>
				<div class="info">
					<!-- Paragraphe "Cette photo vous intéresse ?" et bouton de contact -->
					<p>Cette photo vous intéresse ?</p>
					<!-- Utilisation d'un lien pour ouvrir le modal au clic -->
					<a href="#" class="contact-button">Contact</a>
				</div>
			</div>

			<div class="photo-container"><!-- Photo principale -->
				<div class="main-photo">
					<?php
					$thumbnail_id = get_post_thumbnail_id($post->ID);
					$image = wp_get_attachment_image_src($thumbnail_id, 'custom-size'); // Remplacez 'custom-size' par le nom de la taille personnalisée
					if ($image) {
						echo '<img src="' . esc_url($image[0]) . '" alt="' . esc_attr(get_the_title()) . '">';
					} else {
						// Si l'image n'est pas disponible, affichez un espace réservé ou un message par défaut
						echo 'Image non disponible';
					}
					?>
				</div>
				<div class="thumbnail-image">
					<?php
					$previous_post = get_adjacent_post(false, '', true, 'categorie');
					$next_post = get_adjacent_post(false, '', false, 'categorie');

					if ($previous_post) {
						$prev_thumbnail = get_the_post_thumbnail($previous_post->ID, 'thumbnail');
					?>
						<div class="previous-photo">
							<?php previous_post_link('%link', $prev_thumbnail); ?>
						</div>
					<?php
					}

					if ($next_post) {
						$next_thumbnail = get_the_post_thumbnail($next_post->ID, 'thumbnail');
					?>
						<!-- Ajout des flèches supplémentaires -->
						<div class="thumbnail-image">
							<div class="additional-arrows" data-category="<?php echo $current_category; ?>">
								<?php
								$previous_post = get_adjacent_post(false, '', true, 'categorie');
								$next_post = get_adjacent_post(false, '', false, 'categorie');

								if ($previous_post) {
									$prev_thumbnail = get_the_post_thumbnail($previous_post->ID, 'thumbnail');
								?>
									<div class="arrow-left">
										<a href="<?php echo esc_url(get_permalink($previous_post->ID)); ?>">
											<i class="fa-solid fa-right-long"></i>
										</a>
									</div>
								<?php
								}

								if ($next_post) {
									$next_thumbnail = get_the_post_thumbnail($next_post->ID, 'thumbnail');
								?>
									<div class="arrow-right">
										<a href="<?php echo esc_url(get_permalink($next_post->ID)); ?>">
											<i class="fa-solid fa-left-long"></i>
										</a>
									</div>
								<?php
								}
								?>
							</div>
						</div>


					<?php } ?>
				</div>
			</div>



		</section>






		<section class="random-photos">
			<p class="related-photos-p"> VOUS AIMEREZ AUSSI</p>
			<div class="gallery-grid">

				<?php
				// Récupérer les catégories de la photo actuelle
				$categories = get_the_terms($post->ID, 'categorie');
				$current_category = !empty($categories) ? $categories[0]->term_id : 0;

				// Query pour récupérer deux posts de votre Custom Post Type 'photos' de la même catégorie
				$args = array(
					'post_type' => 'photos',
					'posts_per_page' => 2,
					'tax_query' => array(
						array(
							'taxonomy' => 'categorie',
							'field' => 'term_id',
							'terms' => $current_category,
						),
					),
				);

				$photos_query = new WP_Query($args);


				if ($photos_query->have_posts()) {
					while ($photos_query->have_posts()) {
						$photos_query->the_post();
						// Vérifier si le post a une image mise en avant
						if (has_post_thumbnail()) {
							// Récupérer l'URL de l'image mise en avant du post actuel
							$image_url = wp_get_attachment_image_src(get_post_thumbnail_id(), 'full');
				?>
							<div class="gallery-item">
								<a href="<?php the_permalink(); ?>"> <!-- Ajout du lien vers la page single -->
									<img src="<?php echo $image_url[0]; ?>" alt="<?php the_title(); ?>">
								</a>
							</div>
				<?php
						}
					}
					wp_reset_postdata(); // Réinitialiser la requête
				} else {
					echo 'Aucune photo trouvée.';
				}
				?>

			</div>
			<!-- Bouton "Voir plus de photos" -->
			<div class="more-photos-button">
				<a href="#gallery" class="view-more-link">
					<span class="button-text">Voir plus de photos</span>
				</a>
			</div>

		</section>


	<?php endwhile; // End of the loop. 
	?>

</main><!-- #main -->

<?php
get_footer();
