/*jslint browser: true*/
/*global $, jQuery*/
        
$(document).ready(function()
{
    $('#username, #password').keypress(function(){
        $("#login").html('Login');
        $("#login").removeClass('alert');
    });

    $('#login').click(function()
    {
        var username = $("#username").val();
        var password = $("#password").val();
        var dataString = 'username='+username+'&password='+password;
        if($.trim(username).length>0 && $.trim(password).length>0)
        {
            $.ajax({
                type: "POST",
                url: "ajaxlogin.php",
                data: dataString,
                cache: false,
                beforeSend: function(){ $("#login").html('Connecting...');},    
                success: function(data){
                    if (data=="correct")
                    {
                        $("#content").empty();
                        window.location.replace("/home");
                    }
                    else if (data=="notActive")
                    {
                        $("#login").addClass('alert');
                        $("#login").html('Account not activated!');
                    }
                    else if (data=="incorrectLogin")
                    {
                        $("#login").addClass('alert');
                        $("#login").html('Incorrect login');
                    }
                    else
                    {
                        $("#login").addClass('alert');
                        $("#login").html('Unknown error');
                    }
            }
        });

        }
        return false;
    });
    
    $('#signUp').click(function()
    {
        alert("shite");
        var username = $("#signUpUsername").val();
        var email = $("#signUpEmail").val();
        var password = $("#signUpPassword").val();
        var dataString = 'username='+username+'&password='+password+'&email='+email;
        alert(dataString);
        if($.trim(username).length>0 && $.trim(password).length>0)
        {
            $.ajax({
                type: "POST",
                url: "createUser.php",
                data: dataString,
                cache: false,
                beforeSend: function(){ $("#login").html('Connecting...');},    
                success: function(data){
                    if (data=="success")
                    {
                        alert("Account created, but it needs to be activated.");
                    }
                    else if (data=="userExists")
                    {
                        $("#signUp").addClass('alert');
                        $("#signUp").html('User already exists');
                    }
                    else
                    {
                        $("#signUp").addClass('alert');
                        $("#signUp").html('Unknown error');
                    }
                }
            });

        }
        return false;
    });

});