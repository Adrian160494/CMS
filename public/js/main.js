$(document).ready(function () {
    $('.close-popup').bind('click',function () {
        $(this).parent().parent().fadeOut();
    })
});
setTimeout(function () {
    $('.message').fadeOut();
},5000);

$(document).ready(function () {
   $('select[name="url"]').on('change',function () {
       var value = $(this).val();
       console.log(value);
       if(value != ''){
           $('input[name="url"]').attr('disabled','disabled');
       } else {
           $('input[name="url"]').removeAttr('disabled');
       }
   })
});
