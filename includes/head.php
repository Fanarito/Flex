<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title><?php echo rand(0,20000); ?></title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="apple-touch-icon" href="apple-touch-icon.png">

    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link href="css/jasny-bootstrap.min.css" rel="stylesheet" media="screen">
    <style>
        body {
            padding-top: 50px;
            padding-bottom: 20px;
        }
    </style>
    <style type="text/css">
        .background-image {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: -10;
            display: block;
            height: 100%;
            background: url(<?php 
                    $random = rand(0,$counter-1);
                    $image = $imgArray[$random];
                    setcookie("image", $image);
                    while ($_COOKIE["image"] == $image){
                        $random = rand(0,$counter-1);
                        $image = $imgArray[$random];
                        setcookie("image", $image);
                    }
                    echo $image;
                ?>) no-repeat center center fixed;
            -webkit-background-size: cover;
            -moz-background-size: cover;
            -o-background-size: cover;
            background-size: cover;
            -webkit-filter: blur(1px);
            -moz-filter: blur(1px);
            -o-filter: blur(1px);
            -ms-filter: blur(1px);
            filter: blur(1px)
        }
        
        .transparentBackground {
            background-color: transparent;
        }
    </style>
    <link rel="stylesheet" href="css/bootstrap-theme.min.css">
    <link rel="stylesheet" href="css/main.css">

    <script src="js/vendor/modernizr-2.8.3-respond-1.4.2.min.js"></script>
</head>