$(document).ready(function(){
    //Scoll top of field with invalid input 
    if($('.is-invalid')[0])
    {
        console.log($('.is-invalid:first').offset().top - 10);
        console.log($('.is-invalid:first').offset().top + 10);
        setTimeout( function(){ 
            $('html, body').animate({
                scrollTop: ($('.is-invalid:first').offset().top - 60)
            },1500);
            $('.is-invalid:first').focus();
        },3500);
    }
});