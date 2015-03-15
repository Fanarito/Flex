<?php /*error_reporting(E_ALL); ini_set( 'display_errors', 1);*/ require_once "../loginCheck.php"; require_once "php/userdata.php"; ?>
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
                    <a href="#" data-reveal-id="userProfile" class="button" style="top: 0;height: 45px;vertical-align: middle;line-height: 30px;">
                        <?php echo $user[ 'username']; ?>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
    
    <div id="view" class="row">
        <div class="icon-bar vertical toTheLeft">
            <div class="item">
            </div>
            <a class="item">
                <i class="fi-home"></i>
                <label>Home</label>
            </a>
            <a class="item">
                <i class="fi-video"></i>
                <label>Videos</label>
            </a>
            <a class="item">
                <i class="fi-music"></i>
                <label>Music</label>
            </a>
            <a class="item">
                <i class="fi-widget"></i>
                <label>Settings</label>
            </a>
        </div>

        <div id="content" class="toTheLeft">
            <div class="row">
                <div class="newShowcase large-4 column small-centered">
                    <div class="newVideos">
                        <div>your1 content</div>
                        <div>your2 content</div>
                        <div>your3 content</div>
                        <div>your4 content</div>
                        <div>your5 content</div>
                        <div>your6 content</div>
                        <div>your7 content</div>
                        <div>your8 content</div>
                        <div>your9 content</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="userProfile" class="reveal-modal tiny" data-reveal>
        <h1><?php echo $user['username']; ?></h1>
        <p>
            <?php echo $user[ 'email']; ?>
        </p>
        <a href="#" onclick="signOut()" id="signOut" class="secondary button">Sign Out</a>
        <a class="close-reveal-modal">&#215;</a>
    </div>

    <script src="../js/vendor/jquery.js"></script>
    <script src="../js/foundation.min.js"></script>
    <script src="../slick/slick.min.js"/>
    <script>
        $(document).foundation();
    </script>
    <script type="text/javascript">
    </script>
    <script type="text/javascript" src="js/ui.js"></script>
</body>

</html>