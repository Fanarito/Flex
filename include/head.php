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
        <link href="video-js/video-js.css" rel="stylesheet">
        <script src="video-js/video.jsv"></script>
        <script type="text/javascript">
            document.createElement('video');document.createElement('audio');document.createElement('track');
            videojs.options.flash.swf = "video-js/video.swf"
        </script>
        <title>Home</title>
        <script src="//ajax.googleapis.com/ajax/libs/angularjs/1.3.1/angular.min.js"></script>
        <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="http://yui.yahooapis.com/pure/0.5.0/pure-min.css">
        <!--[if lte IE 8]>
            <link rel="stylesheet" href="css/layouts/side-menu-old-ie.css">
        <![endif]-->
        <!--[if gt IE 8]><!-->
            <link rel="stylesheet" href="css/pure/side-menu.css">
        <!--<![endif]-->
        <!--[if lte IE 8]>
            <link rel="stylesheet" href="css/pure/grids-responsive-old-ie-min.css">
        <![endif]-->
        <link href="css/pure/grids-responsive-min.css" rel="stylesheet">
        <link href="css/pure/pure-skin-mine.css" rel="stylesheet">
        <link href="css/all.css" rel="stylesheet">
        <link href="css/home.css" rel="stylesheet">
    </head>