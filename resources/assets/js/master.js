
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');


$(document).ready(function() {

    //Logout user
    $(document).on('click','#nav-logout',function(event) {
        event.preventDefault();
        //modal 
        $('#confirmLogout').modal({ backdrop: true, keyboard: true })
            .on('click', '#logout-btn', function()
            {
                //submit form
                $('#logout-form').submit();
            });
        //
    });

    $(window).scroll(function() {
        if($(this).scrollTop() >= 50)
        {
            $('#return-to-top').fadeIn(200);
        }
        else
        {
            $('#return-to-top').fadeOut(200);
        }
    });

    $(document).on('click','#return-to-top',function() {
        $('body,html').animate({
            scrollTop : 0
        },500);
    });
});
