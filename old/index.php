<?php
    $imgArray = array();
    $wordArray = array("wow","svakalegt","veit ekki");
    $counter = 0;
    
    foreach(glob('./img/*.*') as $filename){
        array_push($imgArray,substr($filename, 2, strlen($filename)));
        $counter++;
    }
?>
<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js" lang="">
<!--<![endif]-->

<?php require 'includes/head.php'; ?>

<body class="canvas">
    <!--[if lt IE 8]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->

    <?php require 'includes/nav.php'; ?>

    <button type="button" class="btn btn-default menuToggler" data-toggle="offcanvas" data-target=".navmenu" data-canvas="body">Login</button>
    
    <div class="background-image"></div>
    <h1>Velkominn í Flex. Þetta er WIP... Mjög stutt komið á leið</h1>
    <h2><?php echo $wordArray[$random]; ?></h2>
    
    <nav class="navbar navbar-default navbar-fixed-bottom">
        <div class="container">
            <?php require 'includes/footer.php'; ?>
        </div>
    </nav>

    <!-- /container -->
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <script>
        window.jQuery || document.write('<script src="js/vendor/jquery-1.11.2.min.js"><\/script>')
    </script>

    <script src="js/vendor/bootstrap.min.js"></script>
    <script src="js/jasny-bootstrap.min.js"></script>

    <script src="js/main.js"></script>
</body>

</html>