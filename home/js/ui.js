/*jslint browser: true*/
/*global $, jQuery*/

$(document).ready(function () {
    "use strict";
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
    
    /*$('#uploadForm').ajaxForm(function() { 
        alert("Thank you for your comment!"); 
    }); */
    
    $('#addFile').click(function(){
        $('#filesThingy').append("<input type='file' name='files[]' class='filesToUpload'>");
    });
    
    $('#uploadFile').click(function(){
        $.post('php/upload.php', $('#uploadForm').serialize());
        $('#uploadFile').text("Uploading");
    });
});