$(function () {

    var isSubmitted = false;

    $('#addAdvert').click(function (event) {
        event.preventDefault();
        if (isSubmitted == false) {
            isSubmitted = true;
            $('#addAdvertForm').submit();
        }
    })
});
