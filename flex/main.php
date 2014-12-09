<!doctype html>
<?php
//check if user is logged in
session_start();
if(empty($_SESSION['login_user']))
{
    header('Location: index.php');
}
?>
<html>
<head>
	<!-- META's -->
    <meta charset="UTF-8">
	<!-- PURE GRID -->
    <link rel="stylesheet" href="css/pure/pure-min.css">
    <link href="css/pure/grids-responsive-min.css" rel="stylesheet">
	<!-- FONT AWESOME / ICON -->
    <link rel="stylesheet" href="css/font-awesome.min.css">
	<!-- CUSTOM SCROLLBAR STYLE -->
    <link href="css/scrollbar.css" rel="stylesheet">
	<!-- MAIN STYLESHEET -->
    <link href="css/homeTest.css" rel="stylesheet"/>
	<!-- MAIN SCRIPTS -->
    <script type="text/javascript" src="js/jquery.js"></script>
    <script type="text/javascript" src="js/scrollbar.js"></script>
    <script type="text/javascript" src="js/mousewheel.js"></script>
	<!-- ANGULAR JS -->
    <script src="js/angular.js"></script>
</head>
<?php require("login/db.php"); ?>
<?php require("scripts/images.php"); ?>
<!-- start angular app -->
<body ng-app class="pure-g" style="background: rgba(255, 255, 255, 0)">
    <div class="main">
        <h1 id="videoButton" class="pure-u-1-2 playerSelector selected">Video</h1>
        <h1 id="musicButton" class="pure-u-1-2 playerSelector">Music</h1>
        <div class="homeCard pure-u-lg-1-2 pure-u-md-1-2 pure-u-1">
            <h1 class="recentlyAdded homeCardHeading pure-u-1">Recently Added</h1>
            <div class="panelView">
                <div class="videos">
                    <!-- angular json data thingy -->
                    <div ng-init="recentlyAddedVideos = [
                        <?php
                            if($DBH)
                            {
                                $string ="";
                                $uid = $_SESSION['login_user'];
                                $sql = "SELECT videos.nafn, videos.thumbnail, videos.path, videos.id FROM videos
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
                            <!-- loop through angular json data thingy and create list of items which is filter by search bar -->
                            <li ng-repeat="name in recentlyAddedVideos | filter:recentlyAddedVideosSearch" class="pure-u-1 panel">
                                <div class="information pure-u-5-6">
                                    <div class="image">
                                        <img class="thumbnail" src="{{name.thumb}}"/>
                                    </div>
                                    <h4 class="playHeading pure-u-1-2">{{name.name}}</h4>
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
                    <!-- angular json data thingy -->
                    <div ng-init="recentlyAddedMusic = [
                        <?php
                            if($DBH)
                            {
                                $string ="";
                                $uid = $_SESSION['login_user'];
                                $sql = "SELECT music.nafn, music.thumbnail, music.path, music.id FROM music 
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
                    <div class="scrollbar">
                        <ul class="pure-u-1">
                            <!-- loop through angular json data thingy and create list of items which is filter by search bar -->
                            <li ng-repeat="name in recentlyAddedMusic | filter:recentlyAddedMusicSearch" class="pure-u-1 panel">
                                <div class="information pure-u-5-6">
                                    <div class="image">
                                        <img class="thumbnail" src="{{name.thumb}}"/>
                                    </div>
                                    <h4 class="playHeading pure-u-1-2">{{name.name}}</h4>
                                </div>
                                <div class="sideOptions pure-u-1-6">
                                    <button class="options play playMusic pure-button pure-u-1" data-playid="{{name.id}}" data-name="{{name.name}}" data-music="{{name.path}}" data-thumbnail="{{name.thumb}}"><i class="fa fa-play"></i></button>
                                    <button class="options addToPlaylist middleOption addToMusicPlaylist pure-button pure-u-1" data-playid="{{name.id}}" data-name="{{name.name}}" data-music="{{name.path}}" data-thumbnail="{{name.thumb}}"><i class="fa fa-plus"></i></button>
                                    <button class="options addToFavorites addToMusicFavorites pure-button pure-u-1" data-playid="{{name.id}}" data-name="{{name.name}}" data-music="{{name.path}}" data-thumbnail="{{name.thumb}}"><i class="fa fa-star"></i></button>
                                </div>
                                <br><div class="pure-u-1 betweener"></div><br>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="homeCard pure-u-lg-1-2 pure-u-md-1-2 pure-u-1">
            <h1 class="favorite homeCardHeading pure-u-1">Favorites</h1>
            <div class="panelView">
                <div class="videos">
                    <!-- angular json data thingy -->
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
                    <div class="scrollbar">
                        <ul class="pure-u-1">
                            <!-- loop through angular json data thingy and create list of items which is filter by search bar -->
                            <li ng-repeat="name in favoriteMovies | filter:favVidSearch" class="pure-u-1 panel">
                                <div class="information pure-u-5-6">
                                    <div class="image">
                                        <img class="thumbnail" src="{{name.thumb}}"/>
                                    </div>
                                    <h4 class="playHeading pure-u-1-2">{{name.name}}</h4>
                                </div>
                                <div class="sideOptions pure-u-1-6">
                                    <button class="options play playVid pure-button pure-u-1" data-playid="{{name.id}}" data-video="{{name.path}}" data-name="{{name.name}}" data-thumbnail="{{name.thumb}}"><i class="fa fa-play"></i></button>
                                    <button class="options addToPlaylist middleOption addToVideoPlaylist pure-button pure-u-1" data-playid="{{name.id}}" data-video="{{name.path}}" data-name="{{name.name}}" data-thumbnail="{{name.thumb}}"><i class="fa fa-plus"></i></button>
                                    <button class="options addToFavorites removeFromVideoFavorites pure-button pure-u-1" data-playid="{{name.id}}" data-video="{{name.path}}" data-name="{{name.name}}" data-thumbnail="{{name.thumb}}"><i class="fa fa-star"></i></button>
                                </div>
                                <br><div class="pure-u-1 betweener"></div><br>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="music">
                    <!-- angular json data thingy -->
                    <div ng-init="favoriteMusic = [
                          <?php
                            if($DBH)
                            {
                                $string ="";
                                $uid = $_SESSION['login_user'];
                                $sql = "SELECT * FROM musicfavorites 
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
                            <!-- loop through angular json data thingy and create list of items which is filter by search bar -->
                            <li ng-repeat="name in favoriteMusic | filter:favMusicSearch" class="pure-u-1 panel">
                                <div class="information pure-u-5-6">
                                    <div class="image">
                                        <img class="thumbnail" src="{{name.thumb}}"/>
                                    </div>
                                    <h4 class="playHeading pure-u-1-2">{{name.name}}</h4>
                                </div>
                                <div class="sideOptions pure-u-1-6">
                                    <button class="options play playMusic pure-button pure-u-1" data-playid="{{name.id}}" data-name="{{name.name}}" data-music="{{name.path}}" data-thumbnail="{{name.thumb}}"><i class="fa fa-play"></i></button>
                                    <button class="options addToPlaylist middleOption addToMusicPlaylist pure-button pure-u-1" data-playid="{{name.id}}" data-name="{{name.name}}" data-music="{{name.path}}" data-thumbnail="{{name.thumb}}"><i class="fa fa-plus"></i></button>
                                    <button class="options addToFavorites removeFromMusicFavorites pure-button pure-u-1" data-playid="{{name.id}}" data-name="{{name.name}}" data-music="{{name.path}}" data-thumbnail="{{name.thumb}}"><i class="fa fa-star"></i></button>
                                </div>
                                <br><div class="pure-u-1 betweener"></div><br>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="homeCard pure-u-lg-1-2 pure-u-md-1-2 pure-u-1">
            <h1 class="recentlyWatched homeCardHeading pure-u-1">Recently Watched</h1>
            <div class="panelView">
                <div class="videos">
                    <!-- angular json data thingy -->
                    <div ng-init="recentlyWatched = [
                      <?php
                        if($DBH)
                        {
                            $string ="";
                            $uid = $_SESSION['login_user'];
                            $sql = "SELECT * FROM videouserhistory 
                                        JOIN notendur ON notendur_id = notendur.id
                                        JOIN videos ON video_id = videos.id 
                                        WHERE notendur.id = $uid ORDER BY videouserhistory.id DESC LIMIT 10";
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
                    <div class="search">Search: <input class="searchbox" id="recentlyWatchedSearch" ng-model="recentlyWatchedSearch"><br></div>
                    <div class="scrollbar">
                        <ul class="pure-u-1">
                            <!-- loop through angular json data thingy and create list of items which is filter by search bar -->
                            <li ng-repeat="name in recentlyWatched | filter:recentlyWatchedSearch" class="pure-u-1 panel">
                                <div class="information pure-u-5-6">
                                    <div class="image">
                                        <img class="thumbnail" src="{{name.thumb}}"/>
                                    </div>
                                    <h4 class="playHeading pure-u-1-2">{{name.name}}</h4>
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
                    <!-- angular json data thingy -->
                    <div ng-init="recentlyListened = [
                      <?php
                        if($DBH)
                        {
                            $string ="";
                            $uid = $_SESSION['login_user'];
                            $sql = "SELECT * FROM musicuserhistory 
                                        JOIN notendur ON notendur_id = notendur.id
                                        JOIN music ON music_id = music.id 
                                        WHERE notendur.id = $uid ORDER BY musicuserhistory.id DESC LIMIT 10";
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
                    <div class="search">Search: <input class="searchbox" id="recentlyListenedSearch" ng-model="recentlyListenedSearch"><br></div>
                    <div class="scrollbar">
                        <ul class="pure-u-1">
                            <!-- loop through angular json data thingy and create list of items which is filter by search bar -->
                            <li ng-repeat="name in recentlyListened | filter:recentlyListenedSearch" class="pure-u-1 panel">
                                <div class="information pure-u-5-6">
                                    <div class="image">
                                        <img class="thumbnail" src="{{name.thumb}}"/>
                                    </div>
                                    <h4 class="playHeading pure-u-1-2">{{name.name}}</h4>
                                </div>
                                <div class="sideOptions pure-u-1-6">
                                    <button class="options play playMusic pure-button pure-u-1" data-playid="{{name.id}}" data-name="{{name.name}}" data-music="{{name.path}}" data-thumbnail="{{name.thumb}}"><i class="fa fa-play"></i></button>
                                    <button class="options addToPlaylist middleOption addToMusicPlaylist pure-button pure-u-1" data-playid="{{name.id}}" data-name="{{name.name}}" data-music="{{name.path}}" data-thumbnail="{{name.thumb}}"><i class="fa fa-plus"></i></button>
                                    <button class="options addToFavorites addToMusicFavorites pure-button pure-u-1" data-playid="{{name.id}}" data-name="{{name.name}}" data-music="{{name.path}}" data-thumbnail="{{name.thumb}}"><i class="fa fa-star"></i></button>
                                </div>
                                <br><div class="pure-u-1 betweener"></div><br>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="homeCard pure-u-lg-1-2 pure-u-md-1-2 pure-u-1">
            <h1 class="playlists homeCardHeading pure-u-1">Playlists</h1>
            <div class="panelView">
                <div class="videos">
                    <!-- angular json data thingy -->
                    <div ng-init="videoPlaylists = [
                      <?php
                        if($DBH)
                        {
                            $string ="";
                            $uid = $_SESSION['login_user'];
                            $sql = "SELECT videoplaylists.playlist_id, playlists.name FROM videoplaylists 
                                        JOIN playlists ON playlist_id = playlists.id
                                        JOIN notendur ON notendur_id = notendur.id
                                        WHERE notendur.id = $uid
                                        GROUP BY playlist_id, name";
                            $STH = $DBH->prepare($sql);
                            $STH->setFetchMode(PDO::FETCH_ASSOC);
                            $STH->execute();
                            $row = $STH->fetchAll();
                            $count = $STH->rowCount();

                            foreach($row as $thing){
                                $name = str_replace(".", " ", $thing['name']);
                                $string .= "{name:" . "'" . $name . "'" . ", id:" . "'" . $thing['playlist_id'] . "'" . "},";
                            }
                            
                            echo substr($string, 0, -1);
                        }
                    ?>
                    ]"></div>
                    <div class="search">Search: <input class="searchbox" id="videoPlaylistSearch" ng-model="videoPlaylistSearch"><br></div>
                    <div class="scrollbar">
                        <ul class="pure-u-1">
                            <!-- loop through angular json data thingy and create list of items which is filter by search bar -->
                            <li ng-repeat="name in videoPlaylists | filter:videoPlaylistSearch" class="pure-u-1 panel">
                                <div class="information pure-u-5-6">
                                    <div class="image">
                                        <img class="thumbnail" src="{{name.thumb}}"/>
                                    </div>
                                    <h4 class="playHeading pure-u-1-2">{{name.name}}</h4>
                                </div>
                                <div class="sideOptions pure-u-1-6">
                                    <button class="options play playVideoPlaylist pure-button pure-u-1" data-playid="{{name.id}}" data-name="{{name.name}}"><i class="fa fa-play"></i></button>
                                    <button class="options play deletePlaylist pure-button pure-u-1" data-playid="{{name.id}}" data-name="{{name.name}}"><i class="fa fa-close"></i></button>
                                </div>
                                <br><div class="pure-u-1 betweener"></div><br>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="music">
                    <!-- angular json data thingy -->
                    <div ng-init="musicPlaylists = [
                      <?php
                        if($DBH)
                        {
                            $string ="";
                            $uid = $_SESSION['login_user'];
                            $sql = "SELECT musicplaylists.playlist_id, playlists.name FROM musicplaylists 
                                        JOIN playlists ON playlist_id = playlists.id
                                        JOIN notendur ON notendur_id = notendur.id
                                        WHERE notendur.id = $uid
                                        GROUP BY playlist_id, name";
                            $STH = $DBH->prepare($sql);
                            $STH->setFetchMode(PDO::FETCH_ASSOC);
                            $STH->execute();
                            $row = $STH->fetchAll();
                            $count = $STH->rowCount();

                            foreach($row as $thing){
                                $name = str_replace(".", " ", $thing['name']);
                                $string .= "{name:" . "'" . $name . "'" . ", id:" . "'" . $thing['playlist_id'] . "'" . "},";
                            }
                            
                            echo substr($string, 0, -1);
                        }
                    ?>
                    ]"></div>
                    <div class="search">Search: <input class="searchbox" id="musicPlaylistSearch" ng-model="musicPlaylistSearch"><br></div>
                    <div class="scrollbar">
                        <ul class="pure-u-1">
                            <!-- loop through angular json data thingy and create list of items which is filter by search bar -->
                            <li ng-repeat="name in musicPlaylists | filter:musicPlaylistSearch" class="pure-u-1 panel">
                                <div class="information pure-u-5-6">
                                    <div class="image">
                                        <img class="thumbnail" src="{{name.thumb}}"/>
                                    </div>
                                    <h4 class="playHeading pure-u-1-2">{{name.name}}</h4>
                                </div>
                                <div class="sideOptions pure-u-1-6">
                                    <button class="options play playMusicPlaylist pure-button pure-u-1" data-playid="{{name.id}}" data-name="{{name.name}}"><i class="fa fa-play"></i></button>
                                    <button class="options play deletePlaylist pure-button pure-u-1" data-playid="{{name.id}}" data-name="{{name.name}}"><i class="fa fa-close"></i></button>
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
        //get window height and width
        var windowHeight = $(document).height();
        var windowWidth = $(document).width();
        
        //set mediabuttons up
        function mediaButtons(){
            $('.playMusicPlaylist').click(function(){
                var playlistID = $(this).data('playid');
                var playlistName = $(this).data('name');
                
                parent.playMusicPlaylist(playlistID, playlistName);
            });
            
            $('.deletePlaylist').click(function(){
                var playlistID = $(this).data('playid');
                var playlistName = $(this).data('name');
                
                parent.deletePlaylist(playlistID);
            });
            
            $('.playVideoPlaylist').click(function(){
                var playlistID = $(this).data('playid');
                var playlistName = $(this).data('name');
                
                parent.playVideoPlaylist(playlistID, playlistName);
            });
            
            $('.removeFromMusicFavorites').click(function(){
                var musicId = $(this).data('playid');
                
                $.ajax({
                    type: "POST",
                    url: "removeMusicFavorite.php",
                    data: {musicID: musicId},
                    cache: false,
                    success: function(data){
                    }
                });
            });
            
            $('.removeFromVideoFavorites').click(function(){
                var vidId = $(this).data('playid');
                
                $.ajax({
                    type: "POST",
                    url: "removeVideoFavorite.php",
                    data: {videoID: vidId},
                    cache: false,
                    success: function(data){
                    }
                });
            });
            
            $('.playVid').click(function(){
                var video = $(this).data('video');
                var vidId = $(this).data('playid');
                var thumb = $(this).data('thumbnail');
                var name = $(this).data('name');
                //var thumb = $(this).data('thumbnail');
                parent.setVideo(video.substring(0,video.length-4), name.substring(0,name.length-4), thumb, vidId);
                
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
                var videoID = $(this).data('playid');
                parent.addToVideoFavorites(videoID);
            });
            
            $('.addToMusicFavorites').click(function(){
                var musicID = $(this).data('playid');
                parent.addToMusicFavorites(musicID);
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
                var thumb = $(this).data('thumbnail');
                var name = $(this).data('name');
                //var thumb = $(this).data('thumbnail');
                parent.setMusic(music.substring(0,music.length-4), name.substring(0,name.length-4), thumb, musicId);
                
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
        
        //resize the options panel
        function optionsResize(){
            $('.options').css({height: $('.panel').height()/3});
            $('.thumbnail').removeAttr( 'style' );
            $('.image').css({height:$('.panel').height()});

            if(windowWidth < 569){
                $('.thumbnail').css({maxHeight:$('.panel').height()/2});
            }
        }
        
        //hides music and shows video
        function switchTabVideo(){
            $('#musicButton').removeClass('selected');
            $('#videoButton').addClass('selected');
            parent.switchPlayerVideo();
            $('.music').slideUp();
            $('.videos').slideDown();
            parent.location.hash = "video";
        }
        
        //hides video and shows music
        function switchTabMusic(){
            $('#videoButton').removeClass('selected');
            $('#musicButton').addClass('selected');
            parent.switchPlayerMusic();
            $('.videos').slideUp();
            $('.music').slideDown();
            parent.location.hash = "music";
        }
        
        $(document).ready(function () {
            //intialize document
            mediaButtons();
            $(".music").hide();
            var expanded = false;
            
            //check what type of media the user was on
            if(parent.location.hash == "#video"){
                switchTabVideo();
            }
            else if(parent.location.hash == "#music"){
                $('#videoButton').removeClass('selected');
                $('#musicButton').addClass('selected');
                parent.switchPlayerMusic();
                $('.videos').hide();
                $('.music').show();
            }
            
            //set size of options
            optionsResize();
            
            //set size of homecards
            homeCardSize();
            
            //on resize set size of options and homecards
            $(window).resize(function(){
                $('.homeCard').removeAttr( 'style' );
                homeCardSize();
                optionsResize();
            });
            
            //set homecardsize
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
            
            //hide homecard on homecardHeading click
            $('.homeCardHeading').click(function(){
                $(this).next('.panelView').slideToggle();
                windowHeight = $(document).height();
                windowWidth = $(document).width();
                
                if(windowWidth < 569 && !expanded){
                    $(this).closest('.homeCard').css({height: windowHeight, position: 'fixed', left:0,zIndex:100,backgroundColor:"black"});
                    $(this).next('.scrollbar').css({height: windowHeight});
                    expanded = true;
                }
                else if(expanded){
                    $(this).closest('.homeCard').removeAttr( 'style' );
                    $(this).next('.scrollbar').removeAttr( 'style' );
                    expanded = false;
                }
            });
            
            //switch betweeb music and video
            $('#musicButton').click(function(){
                switchTabMusic();
            });
            $('#videoButton').click(function(){
                switchTabVideo();
            });
            
            //initialize custom scrollbars
            (function($){
                $(document).ready(function(){
                    $(".scrollbar").mCustomScrollbar({
                        scrollInertia: 300,
                        mouseWheel:{ scrollAmount: 150 }
                    });
                });
            })(jQuery);
        });
        
        //on search keypress remake media buttons and resize them
        $( ".searchbox" ).keypress(function() {
            mediaButtons();
            optionsResize();
        });
    </script>
</body>
</html>