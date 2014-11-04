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
        <link href="css/pure/grids-responsive-min.css" rel="stylesheet">
        <link href="css/pass.css" rel="stylesheet">
    </head>

    <body>
        <div class="center loginWindow">
            <div class="center login">
                <form>
                    User: <br><input id="username" type="text" name="user"><br>
                    Pass: <br><input id="password" type="password" name="pass">
                    <input id="login" class="submit" type="button" name="submit" value="Submit">
                </form>
            </div>
        </div>

        <script src="js/jquery.min.js"></script>
        <script src="js/jquery.ui.shake.js"></script>
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
                            //Shake animation effect.
                            $('#box').shake();
                            $("#login").val('Login')
                            $("#error").html("<span style='color:#cc0000'>Error:</span> Invalid username and password. ");
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
