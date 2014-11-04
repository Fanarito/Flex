<!DOCTYPE html>
<html>
    <?php
        session_start();
        if(empty($_SESSION['login_user']))
        {
            header('Location: index.php');
        }
    ?>
    <head>
        <meta charset="utf-8">
        <link href="css/pure/grids-responsive-min.css" rel="stylesheet">
        <link href="css/home.css" rel="stylesheet">
        <link href="video-js/video-js.css" rel="stylesheet">
        <script src="video-js/video.jsv"></script>
        <script type="text/javascript">
            document.createElement('video');document.createElement('audio');document.createElement('track');
            videojs.options.flash.swf = "video-js/video.swf"
        </script>
        <title>Home</title>
    </head>
    
    <body>
        
    </body>
</html>
