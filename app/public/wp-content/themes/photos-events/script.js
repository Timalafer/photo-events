jQuery(document).ready(function ($) {
    var page = 1;
    var canLoadMore = true;

    $('#load-more').on('click', function (e) {
        e.preventDefault();
        if (!canLoadMore) {
            return;
        }

        page++;
        var data = {
            'action': 'load_more_photos',
            'page': page
        };

        $.ajax({
            url: ajax_object.ajaxurl, // Utilisation de ajax_object.ajaxurl au lieu de ajaxurl
            data: data,
            type: 'POST',
            success: function (response) {
                $('.gallery-grid').append(response);
                if (response === '') {
                    canLoadMore = false;
                    $('#load-more').hide();
                }
            }
        });
    });
    console.log()
});
/*charger plus single page */

jQuery(document).ready(function ($) {
    var page = 1;
    var canLoadMore = true;

    $('.view-more-link').on('click', function (e) {
        e.preventDefault();
        if (!canLoadMore) {
            return;
        }

        page++;
        var data = {
            'action': 'load_more_single_photos',
            'page': page
        };

        $.ajax({
            url: ajax_object.ajaxurl,
            data: data,
            type: 'POST',
            success: function (response) {
                if (response.trim() !== '') {
                    $('.gallery-grid').append(response);
                } else {
                    $('.more-photos-button').hide(); // Cacher le bouton s'il n'y a plus de photos à charger
                    canLoadMore = false; // Mettre à jour le drapeau pour empêcher le chargement supplémentaire
                }
            }
        });
    });
});


$(document).ready(function () {
    $('.contact-button').click(function (e) {
        e.preventDefault(); // Empêche le comportement par défaut du lien (redirection)

        // Ouvrir le modal avec l'ID spécifié
        $('#popup-overlay').show();
    });

    $('.popup-close').click(function () {
        $('.popup-overlay').hide();
    });
});

jQuery(document).ready(function ($) {
    $('.arrow-left').mouseenter(function () {
        // Changer l'image de la miniature précédente
        $('.previous-thumbnail').attr('src', 'URL_de_l_image_precedente');
    }).mouseleave(function () {
        // Remettre l'image d'origine
        $('.previous-thumbnail').attr('src', 'URL_de_l_image_d_origine');
    });

    $('.arrow-right').mouseenter(function () {
        // Changer l'image de la miniature suivante
        $('.next-thumbnail').attr('src', 'URL_de_l_image_suivante');
    }).mouseleave(function () {
        // Remettre l'image d'origine
        $('.next-thumbnail').attr('src', 'URL_de_l_image_d_origine');
    });
});


/*miniature*/
// JavaScript pour gérer le changement d'image
document.addEventListener('DOMContentLoaded', function () {
    var mainPhoto = document.querySelector('.main-photo img');
    var thumbnailLinks = document.querySelectorAll('.thumbnail-link');

    thumbnailLinks.forEach(function (link) {
        link.addEventListener('click', function (event) {
            event.preventDefault(); // Empêche le comportement par défaut du lien

            var imageUrl = this.getAttribute('data-image-url');
            mainPhoto.setAttribute('src', imageUrl);
        });
    });
});

