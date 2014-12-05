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
    <link rel="stylesheet" href="css/pure/pure-min.css">
    <link href="css/pure/grids-responsive-min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <link href="css/scrollbar.css" rel="stylesheet">
    <link href="css/homeTest.css" rel="stylesheet"/>
    <script type="text/javascript" src="js/jquery.js"></script>
    <script type="text/javascript" src="js/scrollbar.js"></script>
    <script type="text/javascript" src="js/mousewheel.js"></script>
    <script src="js/angular.js"></script>
</head>
<?php require("login/db.php"); ?>
<?php require("scripts/images.php"); ?>
<body ng-app class="pure-g">
    <div class="main">
        <h1 id="videoButton" class="pure-u-1-2 playerSelector selected">Video</h1>
        <h1 id="musicButton" class="pure-u-1-2 playerSelector">Music</h1>
        <div class="homeCard pure-u-lg-1-2 pure-u-md-1-2 pure-u-1">
            <h1 class="recentlyAdded homeCardHeading pure-u-1">Recently Added</h1>
            <div class="panelView">
                <div class="videos">
                    <div ng-init="recentlyAddedVideos = [
                        <?php
                            if($DBH)
                            {
                                $string ="";
                                $uid = $_SESSION['login_user'];
                                $sql = "SELECT * FROM videos
                                            JOIN useraccess ON useraccess.accessgroup = videos.accessgroup
                                            JOIN notendur ON notendur.id = useraccess.notendur_id
                                        LIMIT 10";
                                $STH = $DBH->prepare($sql);
                                $STH->setFetchMode(PDO::FETCH_ASSOC);
                                $STH->execute();
                                $row = $STH->fetchAll();
                                $count = $STH->rowCount();

                                foreach($row as $thing){
                                    $name = str_replace(".", " ", $thing['nafn']);
                                    $string .= "{name:" . "'" . $name . "'" . ", thumb:" . "'" . $thing['thumbnail'] . "', path:" . "'" . $thing['path'] . "'" . ", id:" . "'" . $thing['id'] . "'" . "},";
                                }

                                echo substr($string, 0, -1);
                            }
                        ?>]">
                    </div>
                    <div class="search">Search: <input class="searchbox" id="recentlyAddedVideosSearch" ng-model="recentlyAddedVideosSearch"><br></div>
                    <div class="scrollbar">
                        <ul class="pure-u-1">
                            <li ng-repeat="name in recentlyAddedVideos | filter:recentlyAddedVideosSearch" class="pure-u-1 panel">
                                <div class="information pure-u-5-6">
                                    <img class="pure-img pure-u-lg-1-2 thumbnail" src="{{name.thumb}}"/>
                                    <h4 class="playHeading pure-u-lg-1-2">{{name.name}}</h4>
                                </div>
                                <div class="sideOptions pure-u-1-6">
                                    <button class="options play playVid pure-button pure-u-1" data-playid="{{name.id}}" data-video="{{name.path}}" data-name="{{name.name}}" data-thumbnail="{{name.thumb}}"><i class="fa fa-play"></i></button>
                                    <button class="options addToPlaylist middleOption addToVideoPlaylist pure-button pure-u-1" data-playid="{{name.id}}" data-video="{{name.path}}" data-name="{{name.name}}" data-thumbnail="{{name.thumb}}"><i class="fa fa-plus"></i></button>
                                    <button class="options addToFavorites addToVideoFavorites pure-button pure-u-1" data-playid="{{name.id}}" data-video="{{name.path}}" data-name="{{name.name}}" data-thumbnail="{{name.thumb}}"><i class="fa fa-star"></i></button>
                                </div>
                                <br><div class="pure-u-1 betweener"></div><br>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="music">
                    <div ng-init="recentlyAddedMusic = [
                        <?php
                            if($DBH)
                            {
                                $string ="";
                                $uid = $_SESSION['login_user'];
                                $sql = "SELECT * FROM music 
                                            JOIN useraccess ON useraccess.accessgroup = music.accessgroup
                                            JOIN notendur ON notendur.id = useraccess.notendur_id
                                        LIMIT 10";
                                $STH = $DBH->prepare($sql);
                                $STH->setFetchMode(PDO::FETCH_ASSOC);
                                $STH->execute();
                                $row = $STH->fetchAll();
                                $count = $STH->rowCount();

                                foreach($row as $thing){
                                    $name = str_replace(".", " ", $thing['nafn']);
                                    $string .= "{name:" . "'" . $name . "'" . ", thumb:" . "'" . $thing['thumbnail'] . "', path:" . "'" . $thing['path'] . "'" . ", id:" . "'" . $thing['id'] . "'" . "},";
                                }

                                echo substr($string, 0, -1);
                            }
                        ?>
                    ]"></div>
                    <div class="search">Search: <input class="searchbox" id="recentlyAddedMusicSearch" ng-model="recentlyAddedMusicSearch"><br></div>
                </div>
            </div>
        </div>
        <div class="homeCard pure-u-lg-1-2 pure-u-md-1-2 pure-u-1">
            <h1 class="favorite homeCardHeading pure-u-1">Favorites</h1>
            <div class="panelView">
                <div class="videos">
                    <div ng-init="favoriteMovies = [
                        <?php
                            if($DBH)
                            {
                                $string ="";
                                $uid = $_SESSION['login_user'];
                                $sql = "SELECT videos.id, videos.nafn, videos.path, videos.thumbnail FROM videofavorites 
                                        JOIN notendur 
                                        ON notendur_id = notendur.id
                                        JOIN videos 
                                        ON videos_id = videos.id
                                        WHERE notendur.id = $uid";
                                $STH = $DBH->prepare($sql);
                                $STH->setFetchMode(PDO::FETCH_ASSOC);
                                $STH->execute();
                                $row = $STH->fetchAll();
                                $count = $STH->rowCount();

                                foreach($row as $thing){
                                    $name = str_replace(".", " ", $thing['nafn']);
                                    $string .= "{name:" . "'" . $name . "'" . ", thumb:" . "'" . $thing['thumbnail'] . "', path:" . "'" . $thing['path'] . "'" . ", id:" . "'" . $thing['id'] . "'" . "},";
                                }

                                echo substr($string, 0, -1);
                            }
                        ?>]">
                    </div>
                    <div class="search">Search: <input class="searchbox" id="favVidSearch" ng-model="favVidSearch"><br></div>
                </div>
                <div class="music">
                    <div ng-init="favoriteMusic = [
                          <?php
                            if($DBH)
                            {
                                $string ="";
                                $uid = $_SESSION['login_user'];
                                $sql = "SELECT music.nafn, music.path, music.thumbnail, music.id FROM musicfavorites 
                                            JOIN notendur 
                                                ON notendur_id = notendur.id
                                            JOIN music 
                                                ON music_id = music.id
                                            WHERE notendur.id = $uid";
                                $STH = $DBH->prepare($sql);
                                $STH->setFetchMode(PDO::FETCH_ASSOC);
                                $STH->execute();
                                $row = $STH->fetchAll();
                                $count = $STH->rowCount();

                                foreach($row as $thing){
                                    $name = str_replace(".", " ", $thing['nafn']);
                                    $string .= "{name:" . "'" . $name . "'" . ", thumb:" . "'" . $thing['thumbnail'] . "', path:" . "'" . $thing['path'] . "'" . ", id:" . "'" . $thing['id'] . "'" . "},";
                                }

                                echo substr($string, 0, -1);
                            }
                        ?>
                    ]"></div>
                    <div class="search">Search: <input class="searchbox" id="favMusicSearch" ng-model="favMusicSearch"><br></div>
                    <div class="scrollbar">
                        <ul class="pure-u-1">
                            <li ng-repeat="name in favoriteMusic | filter:favMusicSearch" class="pure-u-1 panel">
                                <div class="information pure-u-5-6">
                                    <img class="pure-img pure-u-lg-1-2 thumbnail" src="{{name.thumb}}"/>
                                    <h4 class="playHeading pure-u-lg-1-2">{{name.name}}</h4>
                                </div>
                                <div class="sideOptions pure-u-1-6">
                                    <button class="options play playMusic pure-button pure-u-1" data-playid="{{name.id}}" data-name="{{name.name}}" data-music="{{name.path}}" data-thumbnail="{{name.thumb}}"><i class="fa fa-play"></i></button>
                                    <button class="options addToPlaylist middleOption addToMusicPlaylist pure-button pure-u-1" data-playid="{{name.id}}" data-name="{{name.name}}" data-music="{{name.path}}" data-thumbnail="{{name.thumb}}"><i class="fa fa-plus"></i></button>
                                    <button class="options addToFavorites addToVideoFavorites pure-button pure-u-1" data-playid="{{name.id}}" data-name="{{name.name}}" data-music="{{name.path}}" data-thumbnail="{{name.thumb}}"><i class="fa fa-star"></i></button>
                                </div>
                                <br><div class="pure-u-1 betweener"></div><br>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        var windowHeight = $(document).height();
        var windowWidth = $(document).width();
        
        function mediaButtons(){
            $('.playVid').click(function(){
                var video = $(this).data('video');
                var vidId = $(this).data('playid');
                var name = $(this).data('name');
                //var thumb = $(this).data('thumbnail');
                parent.setVideo(video.substring(0,video.length-4), name.substring(0,name.length-4));
                
                $.ajax({
                    type: "POST",
                    url: "watch.php",
                    data: {videoID: vidId},
                    cache: false,
                    success: function(data){
                    }
                });
            });
            
            $('.addToVideoFavorites').click(function(){
                var video = $(this).data('video');
                var vidId = $(this).data('playid');
                //var thumb = $(this).data('thumbnail');
                
                $.ajax({
                    type: "POST",
                    url: "favoriteVideo.php",
                    data: {videoID: vidId},
                    cache: false,
                    success: function(data){
                    }
                });
            });
            
            $('.addToVideoPlaylist').click(function(){
                var video = $(this).data('video');
                var name = $(this).data('name');
                var videoId = $(this).data('playid');
                //var thumb = $(this).data('thumbnail');
                parent.addToVideoPlaylist(video.substring(0,video.length-4), name.substring(0,name.length-4), videoId);
                parent.deleteFromPlaylist();

                //parent.myPlayer.play();
            });
            
            $('.playMusic').click(function(){
                var music = $(this).data('music');
                var musicId = $(this).data('playid');
                var name = $(this).data('name');
                //var thumb = $(this).data('thumbnail');
                parent.setMusic(music.substring(0,music.length-4), name.substring(0,name.length-4), musicId);
                
                $.ajax({
                    type: "POST",
                    url: "listen.php",
                    data: {musicID: musicId},
                    cache: false,
                    success: function(data){
                    }
                });
            });
            
            $('.addToMusicPlaylist').click(function(){
                var music = $(this).data('music');
                var name = $(this).data('name');
                var musicId = $(this).data('playid');
                //var thumb = $(this).data('thumbnail');
                parent.addToMusicPlaylist(music.substring(0,music.length-4), name.substring(0,name.length-4), musicId);
                parent.deleteFromPlaylist();

                //parent.musicPlayer.play();
            });
        }
        
        function optionsResize(){
            $('.options').css({height: $('.panel').height()/3});
            $('.thumbnail').removeAttr( 'style' );

            if(windowWidth < 569){
                $('.thumbnail').css({maxHeight:$('.panel').height()/2});
            }
        }
        
        $(document).ready(function () {
            mediaButtons();
            $(".music").hide();
            var expanded = false;
            
            optionsResize();
            
            homeCardSize();
            
            $(window).resize(function(){
                $('.homeCard').removeAttr( 'style' );
                homeCardSize();
                optionsResize();
            });
            
            function homeCardSize(){
                windowHeight = $(document).height();
                windowWidth = $(document).width();
                
                if(windowWidth > 1024){
                    $('.scrollbar').css({maxHeight: (windowHeight/3), minHeight: (windowHeight/3)});
                }
            
                if(windowWidth < 569){
                    $('.panelView').slideUp();
                }
            }
            
            $('.homeCardHeading').click(function(){
                $(this).next('.panelView').slideToggle();
                
                if(windowWidth < 569 && !expanded){
                    $(this).closest('.homeCard').css({height: windowHeight, position: 'fixed', left:0,zIndex:100,backgroundColor:"black"});
                    expanded = true;
                }
                else if(expanded){
                    $(this).closest('.homeCard').removeAttr( 'style' );
                    expanded = false;
                }
            });
            
            
            $('#musicButton').click(function(){
                $('#videoButton').removeClass('selected');
                $('#musicButton').addClass('selected');
                parent.switchPlayerMusic();
                $('.videos').slideUp();
                $('.music').slideDown();
            });
            
            $('#videoButton').click(function(){
                $('#musicButton').removeClass('selected');
                $('#videoButton').addClass('selected');
                parent.switchPlayerVideo();
                $('.music').slideUp();
                $('.videos').slideDown();
            });
            
            (function($){
                $(document).ready(function(){
                    $(".scrollbar").mCustomScrollbar({
                        scrollInertia: 300,
                        mouseWheel:{ scrollAmount: 150 }
                    });
                });
            })(jQuery);
        });
        
        $( ".searchbox" ).keypress(function() {
            mediaButtons();
            optionsResize();
        });
    </script>
</body>
</html>