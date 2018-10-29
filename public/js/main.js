$(document).ready(function () {
    $('.close-popup').bind('click',function () {
        $(this).parent().parent().fadeOut();
    })
})
setTimeout(function () {
    $('.message').fadeOut();
},5000);
