<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="A layout example that shows off a responsive product landing page.">

    <title>Landing Page &ndash; Layout Examples &ndash; Pure</title>

    <link rel="stylesheet" href="css/pure/pure-min.css">

    <!--[if lte IE 8]>
  
    <link rel="stylesheet" href="http://yui.yahooapis.com/pure/0.5.0/grids-responsive-old-ie-min.css">
  
<![endif]-->
    <!--[if gt IE 8]><!-->

    <link rel="stylesheet" href="css/pure/grids-responsive-min.css">

    <!--<![endif]-->
    
    <link rel="stylesheet" href="css/pure/font-awesome.min.css">

    <!--[if lte IE 8]>
        <link rel="stylesheet" href="css/layouts/marketing-old-ie.css">
    <![endif]-->
    <!--[if gt IE 8]><!-->
    <link rel="stylesheet" href="css/layouts/marketing.css">
    <!--<![endif]-->
    <link rel="stylesheet" href="css/main.css">
    
    <style type="text/css">
        .splash-container{
            background:url(<?php 
                        $random = rand(0,$counter-1);
                        $image = $imgArray[$random];
                        setcookie("image", $image);
                        while ($_COOKIE["image"] == $image){
                            $random = rand(0,$counter-1);
                            $image = $imgArray[$random];
                            setcookie("image", $image);
                        }
                        echo $image;
                ?>);
            background-repeat:no-repeat;
            background-position:center;
        }
    </style>
</head>