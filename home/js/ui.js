/*jslint browser: true*/
/*global $, jQuery*/

$(document).ready(function () {
    "use strict";
    $('.newVideos').slick({
        infinite: true,
        slidesToShow: 3,
        slidesToScroll: 3
    });
    document.signOut = function () {
        $.ajax({
            type: 'GET',
            url: "php/signOut.php",
            cache: false,
            beforeSend: function(){ $("#signOut").html('Signing Out...');},    
            success: function(msg){
                if(msg=='signedOut')
                {
                    window.location.replace("/");
                }
            }
        });
    };
});