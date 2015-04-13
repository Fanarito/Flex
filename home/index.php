<?php /*error_reporting(E_ALL); ini_set( 'display_errors', 1);*/ require_once "../db.php"; require_once "../loginCheck.php"; require_once "php/userdata.php"; require_once "php/userFiles.php"; ?>
<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Flex | Home</title>
    <link rel="stylesheet" href="../css/foundation.css" />
    <link rel="stylesheet" href="../css/foundation-icons.css" />
    <link rel="stylesheet" href="../slick/slick.css"/>
    <link rel="stylesheet" href="../slick/slick-theme.css"/>
    <link rel="stylesheet" href="css/home.css" />
    <script src="../js/vendor/modernizr.js"></script>
</head>

<body>
    <div class="fakeNavbar"></div>
    <div class="fixed">
        <nav class="top-bar">
            <ul class="left">
                <li class="name">
                    <h1 class="toTheLeft"><a href="#">Flex</a></h1>
                </li>
                <li class="toggle-topbar">
                    <a href="#"></a>
                </li>
            </ul>
            <ul class="right">
                <li>
                    <a href="#UserProfile" data-reveal-id="userProfile" class="button" style="top: 0;height: 45px;vertical-align: middle;line-height: 30px;">
                        <?php echo $user['username']; ?>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
    
    <a href="#Upload" data-reveal-id="uploadModal" class="button primary">Upload</a>
    
    <div>
    <?php
        foreach($files as $row){
            echo "<li>{$row['filmName']}</li>";
            echo "<a href='" . $row['path'] . "'>" . $row['name'] . "</a><br>";
        }
    ?>
    </div>

    <div id="userProfile" class="reveal-modal tiny" data-reveal>
        <h1><?php echo $user['username']; ?></h1>
        <p>
            <?php echo $user['email']; ?>
        </p>
        <a href="#" onclick="signOut()" id="signOut" class="secondary button">Sign Out</a>
        <a class="close-reveal-modal">&#215;</a>
    </div>
    
    <div id="uploadModal" class="reveal-modal tiny" data-reveal>
        <form id="uploadForm" action="php/uploadTest.php" method="post" enctype="multipart/form-data">
            <div id="filesThingy">
                <input type="file" name="files[]" class="filesToUpload">
            </div>
            <input type="submit" value="Upload Image" class="button primary">
            <a class="button secondary" id="addFile">Add Another File</a>
        </form>
    </div>

    <script src="../js/vendor/jquery.js"></script>
    <!--script src="http://malsup.github.com/jquery.form.js"></script--> 
    <script src="../js/foundation.min.js"></script>
    <script>
        $(document).foundation();
    </script>
    <script type="text/javascript" src="js/ui.js"></script>
</body>

</html>