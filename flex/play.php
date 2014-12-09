<!DOCTYPE html>
<html>
    <?php 
        session_start();
        if(empty($_SESSION['login_user']))
        {
            header('Location: index.php');
        }

        $video = $_GET["vid"]; 
    ?>
    <head>
        <meta charset="utf-8"/>
        <link href="css/label.css" rel="stylesheet"/>
        <link rel="stylesheet" href="css/pure/pure-min.css">
        <!--[if lte IE 8]>
            <link rel="stylesheet" href="css/layouts/side-menu-old-ie.css">
        <![endif]-->
        <!--[if gt IE 8]><!-->
            <link rel="stylesheet" href="css/pure/side-menu.css">
        <!--<![endif]-->
        <link href="css/pure/pure-skin-mine.css" rel="stylesheet">
    </head>
    
    <body>
        <?php include('include/menu.php'); ?>
        <embed type="application/x-vlc-plugin" pluginspage="http://www.videolan.org"
            version="VideoLAN.VLCPlugin.2"
            width="640"
            height="480"
            id="vlc"
         </embed>

        <script>
            var vlc = document.getElementById("vlc");
            vlc.playlist.add("http://tor01.gw.is:81/~gru/Flex/<?php echo $video; ?>", "live",
            ":network-caching=150");
            vlc.playlist.play();
        </script>
        <script>
            // This block of code must be run _after_ the DOM is ready
            // This will capture the frame at the 10th second and create a poster
            var video = Popcorn( "#video-id" );

            // Once the video has loaded into memory, we can capture the poster
            video.listen( "canplayall", function() {

              this.currentTime( 50 ).capture();

            });
        </script>
    </body>
</html>