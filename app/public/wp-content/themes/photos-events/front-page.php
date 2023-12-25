<?php get_header(); ?>


<!-- Bannière et titre de la page -->
<section class="banner">
    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/Photoheader.png" alt="image banniere" class="img-banner">
    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/Titreheader.png" alt="Titre du site" class="site-title">
</section>

<!-- Galerie de photos triable -->
<section id="gallery" class="gallery">
    <div class="gallery-filters">
        <select id="category-filter">
            <option value="all"> CATÉGORIES</option>
            <?php
            $categories = get_terms(array(
                'taxonomy' => 'categorie',
                'hide_empty' => false, // Afficher les catégories même si elles sont vides
            ));

            foreach ($categories as $category) {
                echo '<option value="' . $category->slug . '">' . $category->name . '</option>';
            }
            ?>
        </select>

        <select id="format-filter">
            <option value="all"> FORMATS</option>
            <?php
            $formats = get_terms(array(
                'taxonomy' => 'format',
                'hide_empty' => true,
            ));

            foreach ($formats as $format) {
                echo '<option value="' . $format->slug . '">' . $format->name . '</option>';
            }
            ?>
        </select>
        <select id="date-filter">
            <option value="all">TRIER PAR</option>
            <?php
            // Récupérer les termes de la taxonomie 'dates'
            $dates = get_terms(array(
                'taxonomy' => 'date',
                'hide_empty' => true,
            ));

            foreach ($dates as $date) {
                echo '<option value="' . $date->slug . '">' . $date->name . '</option>';
            }
            ?>
        </select>
    </div>

    <div class="gallery-grid">
        <?php
        // Query pour récupérer les posts de votre Custom Post Type 'photos'
        $args = array(
            'post_type' => 'photos',
            'posts_per_page' => 8,
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
                        <a href="<?php the_permalink(); ?>">
                            <img src="<?php echo $image_url[0]; ?>" alt="<?php the_title(); ?>">
                            <div class="overlay">
                                <div class="icons">
                                    <a href="<?php the_permalink(); ?>" class="info-icon"><i class="fas fa-eye"></i></a>
                                    <a href="<?php echo $image_url[0]; ?>" class="fullscreen-icon" data-lightbox="image"><i class="fas fa-expand"></i></a>
                                </div>
                            </div>
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



    <button id="load-more">Charger plus </button>
</section>



<?php get_footer(); ?>