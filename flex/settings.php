<!doctype html>
<?php
session_start();
if(empty($_SESSION['login_user']))
{
    header('Location: index.php');
}
?>
<html>
<head>
    <meta charset="UTF-8">
    <title>Flex | Home</title>
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
    <link rel="icon" href="favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="css/pure/pure-min.css">
    <link href="css/pure/grids-responsive-min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <link href="video-js/video-js.css" rel="stylesheet">
    <link href="css/panel.css" rel="stylesheet">
    <link href="css/scrollbar.css" rel="stylesheet">
    <link href="css/settings.css" rel="stylesheet"/>
    <script type="text/javascript" src="js/jquery.js"></script>
    <script type="text/javascript" src="js/scrollbar.js"></script>
    <script type="text/javascript" src="js/mousewheel.js"></script>
    <script src="js/angular.js"></script>
    <script src="video-js/video.js"></script>
    <script type="text/javascript">
        document.createElement('video');document.createElement('audio');document.createElement('track');
        videojs.options.flash.swf = "video-js/video.swf"
    </script>
</head>
<?php require("login/db.php"); ?>
<?php require("scripts/images.php"); ?>
<body ng-app class="pure-g">
    <div id="main" class="pure-u-lg-17-24 pure-u-1">
    </div>
</body>
</html>