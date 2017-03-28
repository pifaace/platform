$(function () {

    var isSubmitted = false;

    $('#delete-advert').click(function (event) {
        event.preventDefault();
        var word = $('#word-confirmation').val();

        if ("SUPPRIMER" == word) {
            if (false == isSubmitted) {
                $('#delete-advert-form').submit();
                isSubmitted = true;
            }
        } else {
            $('span.label-error').addClass("visible")
        }

        $('#word-confirmation').on("input", function () {
            $('span.label-error').removeClass("visible")
        });
    })
});
