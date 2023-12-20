<footer class="site-footer">
    <div class="footer-content">
        <!-- Autres contenus de votre footer ici -->

        <!-- Afficher le menu du footer -->
        <?php
        wp_nav_menu(array(
            'theme_location' => 'footer_menu', // Utilisez l'emplacement déclaré pour le menu de pied de page
            'container' => 'nav',
            'container_class' => 'footer-menu'
        ));
        ?>
    </div>
    <div class="footer-line"></div>
</footer>




<?php wp_footer(); ?>
</body>

</html>