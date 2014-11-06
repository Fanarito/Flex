<!DOCTYPE html>
<html>
    <?php
        session_start();
        if(isset($_SESSION['login_user']) && !empty($_SESSION['login_user']))
        {
            header('Location: home.php');
        }
    ?>
    <head>
        <meta charset="utf-8">
        <title>Login</title>
        <link href="css/reset.css" rel="stylesheet">
        <link href="css/pass.css" rel="stylesheet">
        <meta name="viewport" content="width=device-width, initial-scale=1">
    </head>
    
    <body>
        <div id="loginWindow" class="center">
            <div class="center login">
                <form action="" method="post">
                    User: <br><input id="username" type="text" name="user"><br>
                    Pass: <br><input id="password" type="password" name="pass">
                    <input id="login" class="submit" type="button" name="submit" value="Login">
                    <div id="error"></div>
                </form>
            </div>
        </div>
        <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
        <script type="text/javascript" src="js/jquery.jrumble.1.3.min.js"></script>
        <script>
            $(document).ready(function()
            {
                $('#username').focus();
                
                function login(){
                    var notandanafn=$("#username").val();
                    var lykilord=$("#password").val();
                    //window.confirm(user + " " + pass);
                    if($.trim(username).length>0 && $.trim(password).length>0)
                    {
                        $.ajax({
                            type: "POST",
                            url: "login/ajaxLogin.php",
                            data: {user: notandanafn, pass: lykilord},
                            cache: false,
                            beforeSend: function(){ $("#login").val('Connecting...');},
                            success: function(data){
                                if(data)
                                {
                                    $("body").slideUp("slow", function(){
                                    });
                                    $("body").load("home.php").hide();
                                    //or
                                    window.location.href = "home.php";
                                }
                                else
                                {
                                    var demoTimeout;
                                    //Shake animation effect.
                                    $('#loginWindow').jrumble();
                                    $('#loginWindow').trigger('startRumble');
                                    $("#login").val('Login');
                                    $("#username").addClass('error');
                                    $("#password").addClass('error');
                                    //$("#error").html("<span class='error' style='color:#cc0000'>Error:</span> <p class='error'>Invalid username and password.</p>");
                                    demoTimeout = setTimeout(function(){$('#loginWindow').trigger('stopRumble');}, 500)
                                }
                            }
                        });
                    }
                    return false;
                }
                
                $('#login').click(function()
                {
                    login();
                });
                
                $('#password').keypress(function(e) {
                    if(e.which == 13) {
                        login();
                    }
                });
                
                $( "input" ).keydown(function() {
                    $("#username").removeClass('error');
                    $("#password").removeClass('error');
                });
            });
        </script>
    </body>
</html>
