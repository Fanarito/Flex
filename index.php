<!DOCTYPE html>
<html>
    <?php
        session_start();
        if(!empty($_SESSION['login_user']))
        {
            header('Location: home.php');
        }
    ?>
    <head>
        <meta charset="utf-8">
        <link href="css/pass.css" rel="stylesheet">
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
                $('#login').click(function()
                {
                    var username=$("#username").val();
                    var password=$("#password").val();
                    var dataString = 'username='+username+'&password='+password;
                    if($.trim(username).length>0 && $.trim(password).length>0)
                    {
                        $.ajax({
                            type: "POST",
                            url: "ajaxLogin.php",
                            data: dataString,
                            cache: false,
                            beforeSend: function(){ $("#login").val('Connecting...');},
                            success: function(data){
                                if(data)
                                {
                                    $("body").load("home.php").hide().fadeIn(1500).delay(6000);
                                    //or
                                    window.location.href = "home.php";
                                }
                                else
                                {
                                    var demoTimeout;
                                    //Shake animation effect.
                                    $('#loginWindow').jrumble();
                                    $('#loginWindow').trigger('startRumble');
                                    $("#login").val('Login')
                                    $("#error").html("<span class='error' style='color:#cc0000'>Error:</span> <p class='error'>Invalid username and password.</p>");
                                    demoTimeout = setTimeout(function(){$('#loginWindow').trigger('stopRumble');}, 500)
                                }
                            }
                        });
                    }
                    return false;
                });

            });
        </script>
    </body>
</html>