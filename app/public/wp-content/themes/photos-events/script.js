jQuery(document).ready(function ($) {
    var page = 1;
    var canLoadMore = true;

    // Fonction pour charger plus de photos dans la galerie principale
    $('#load-more').on('click', function (e) {
        e.preventDefault();
        if (!canLoadMore) {
            return;
        }

        // Logique pour charger plus de photos ici...
        page++;
        var data = {
            'action': 'load_more_photos',
            'page': page
        };

        $.ajax({
            url: ajax_object.ajaxurl,
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

    // Fonction pour charger plus de photos dans une page individuelle
    $('.view-more-link').on('click', function (e) {
        e.preventDefault();
        if (!canLoadMore) {
            return;
        }

        // Logique pour charger plus de photos dans une page individuelle ici...
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
                    $('.more-photos-button').hide();
                    canLoadMore = false;
                }
            }
        });
    });

    // Fonctionnalité du modal
    $('.contact-button').click(function (e) {
        e.preventDefault();
        $('#popup-overlay').show();
    });

    $('.popup-close').click(function () {
        $('.popup-overlay').hide();
    });
});


