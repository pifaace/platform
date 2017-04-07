$(function () {

    $('[data-toggle="save-advs"]').tooltip();

    $(".save-adv").click(function (event) {
        event.preventDefault();
    });

    $(".save-adv i").click(function (event) {
        event.preventDefault();

        if ($(this).hasClass("fa-heart-o")) {
            $(this).removeClass("fa-heart-o").addClass("fa-heart");
            $('[data-toggle="save-advs"]').attr('data-original-title', 'Annonce sauvegardée');
        } else {
            $(this).removeClass("fa-heart").addClass("fa-heart-o");
            $('[data-toggle="save-advs"]').attr('data-original-title', 'Sauvegarder l\'annonce');
        }

    });
});
