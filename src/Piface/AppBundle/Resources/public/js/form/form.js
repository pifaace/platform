$(function () {

    var isSubmitted = false;

    $('.btn-anti-spam').click(function (event) {
        event.preventDefault();
        if (isSubmitted == false) {
            console.log(isSubmitted);
            isSubmitted = true;
            $('.form-submit').submit();
        }
    })
});
