$(function () {

    var isSubmitted = false;

    $('#addAdvert').click(function () {
        if (isSubmitted == false) {
            isSubmitted = true;
            $('#addAdvert').submit();
        }
    })
});
