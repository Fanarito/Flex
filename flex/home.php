<!DOCTYPE html>
<?php
session_start();
if(empty($_SESSION['login_user']))
{
    header('Location: index.php');
}
?>
<html lang="en">
<head>
	<!-- META's -->
    <meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- TITLE -->
	<title>Flex | Home</title>
	<!-- ICON -->
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
    <link rel="icon" href="favicon.ico" type="image/x-icon">
	<!-- PURE GRID -->
    <link rel="stylesheet" href="css/pure/pure-min.css">
    <link href="css/pure/grids-responsive-min.css" rel="stylesheet">
	<!-- FONT AWESOME / ICON -->
    <link rel="stylesheet" href="css/font-awesome.min.css">
	<!-- VIDEO PLAYER STYLESHEET -->
    <link href="js/video-js/video-js.css" rel="stylesheet">
    <link href="css/videojs.playlist.css" rel="stylesheet">
	<!-- CUSTOM SCROLLBAR STYLE -->
    <link href="css/scrollbar.css" rel="stylesheet">
	<!-- MAIN STYLESHEET -->
    <link href="css/homeTest.css" rel="stylesheet"/>
	<!-- MAIN SCRIPTS -->
    <script type="text/javascript" src="js/jquery.js"></script>
    <script type="text/javascript" src="js/scrollbar.js"></script>
    <script type="text/javascript" src="js/mousewheel.js"></script>
	<!-- VIDEO PLAYER SCRIPTS -->
    <script src="js/video-js/video.js"></script>
    <script src="js/videojs.playlist.js"></script>
</head>

<body>
	<!-- ASIDE -> MENU -->
    <aside class="menu pure-u-lg-1-12 pure-u-md-1-6 pure-u-sm-1-2">
        <h1 class="menuHeading menuItem" data-menulink="main.php" data-typeofmedia="videos">Flex</h1>
        <h2 class="menuItem" data-menulink="videos.php" data-typeofmedia="videos">Videos</h2>
        <h2 class="menuItem" data-menulink="music.php" data-typeofmedia="music">Music</h2>
        <h2 class="menuItem" data-menulink="playlists.php">Playlists</h2>
        <h2 class="menuItem" data-menulink="settings.php">Settings</h2>
        <h2 class="menuItem"><a href="include/logout.php">Logout</a></h2>
    </aside>
    <button id="menuHide"><i class="fa fa-bars"></i></button>
    <button id="playerHide"><i class="fa fa-play"></i></button>
    <div class="pure-u-lg-1-12 pure-u-md-1-6"></div>
    <div class="mainView pure-u-lg-3-4 pure-u-md-2-3">
        <iframe id="iframe" name="iframe" src="main.php" width="100%" height="100%"></iframe>
        <script>
            var iframe = document.getElementById('iframe');
        </script>
    </div>
	<!-- ASIDE -> PLAYER -->
    <aside class="player pure-u-lg-1-6 pure-u-md-1-6 pure-u-1">
        <!-- VIDEO PLAYER CONTAINER -->
		<div id="videoPlayer">
            <video id="video" class="video-js vjs-default-skin vjs-big-play-centered pure-u-1"
                controls preload="auto" width="100%"
                poster="http://video-js.zencoder.com/oceans-clip.png"
                data-setup=''>
                <source src="http://video-js.zencoder.com/oceans-clip.mp4" type='video/mp4' />
                <source src="http://video-js.zencoder.com/oceans-clip.webm" type='video/webm' />
                <source src="http://video-js.zencoder.com/oceans-clip.ogv" type='video/ogg' />
                <p class="vjs-no-js">To view this video please enable JavaScript, and consider upgrading to a web browser that <a href="http://videojs.com/html5-video-support/" target="_blank">supports HTML5 video</a></p>
            </video>
            <div id="video-vjs-playlist" class='vjs-playlist' style='width:100%'>
                <ul id="list">
                    <li class='pure-u-1'><a class='pure-u-5-6 vjs-track' data-index='0' data-src='http://video-js.zencoder.com/oceans-clip'>Ocean Clip</a><span class="pure-u-1-6 outerDeleteFromPlaylist"><i class='pure-u-1 fa fa-close deleteFromPlaylist'></i></span></li>
                </ul>
                <button class="pure-button pure-u-1 saveVideoPlaylist">Save Playlist</button>
            </div>
            <script type="text/javascript">
                var myPlayer;
                var myPlayer = videojs('video');
                
                var videoPlaylist=myPlayer.playlist({
                    "continuous": true,
                    'setTrack': 0
                });
                
                myPlayer.volume(0.8);
            </script>
            <a class="pure-u-1 pure-button" style="background-color:rgba(31, 141, 214, 0.33)" id="fallback" href="play.php?vid=">If you can't play the video press me!</a>
        </div>
		<!-- MUSIC PLAYER CONTAINER -->
        <div id="musicPlayer">
            <audio id="audio" class="video-js vjs-default-skin pure-u-1" controls 
                preload="auto" width="100%"
                poster="default/300.jpg" data-setup='{}'>
            </audio>
            <div id="audio-vjs-playlist" class='vjs-playlist' style='width:100%'>
                <ul id="list">
                    <li class='pure-u-1'><a class='pure-u-5-6 vjs-track' data-index='0' data-src='music/01%Chandelier'>Born to Die</a><span class="pure-u-1-6 outerDeleteFromPlaylist"><i class='pure-u-1 fa fa-close deleteFromPlaylist'></i></span></li>
                </ul>
                <button class="pure-button pure-u-1 saveMusicPlaylist">Save Playlist</button>
            </div>
            <script>
                var musicPlayer;
                var musicPlayer = videojs('audio');
                
                var musicPlaylist=musicPlayer.playlist({
                    'mediaType': 'audio',
                    'continuous': true,
                    'setTrack': 0
                });
                
                musicPlayer.volume(0.8);
            </script>
        </div>
    </aside>
    <script>
        $('#musicPlayer').hide();
        $('.music').hide();
        responsive();
        var menuOn = true;
        var playerOn = true;
        var videoPlaylistArray = [];
        var musicPlaylistArray = [];
        
        var videoPlaylistIndex = 0;
        var musicPlaylistIndex = 0;
        
        $(window).resize(function(){
            responsive();
        });
        
        function addToVideoFavorites(videoID){
            $.ajax({
                type: "POST",
                url: "favoriteVideo.php",
                data: {videoID: videoID},
                cache: false,
                success: function(data){
                    iframe.src = iframe.src;
                    iframe.switchTabVideo();
                }
            });
        }
        
        function addToMusicFavorites(musicID){
            $.ajax({
                type: "POST",
                url: "favoriteMusic.php",
                data: {musicID: musicID},
                cache: false,
                success: function(data){
                    iframe.src = iframe.src;
                    iframe.onload(function(){
                        document.getElementById('myFrame').contentWindow.switchTabVideo();
                    });
                }
            });
        }
        
        function responsive(){
            var width = $(document).width();
            var height = $(document).height();
            var menuWidth = $('.menu').width();
            var playerWidth = $('.player').width();
            $('iframe').height(height-5);
            
            if(width < 768){
                $('.menu').css({marginLeft:-menuWidth});
                $('.player').css({marginRight:-playerWidth});
                $('#playerHide').css({marginRight:0});
                $('#menuHide').css({marginLeft:0});
                menuOn = false;
                playerOn = false;
            }
            else{
                $('.menu').css({marginLeft:0});
                $('.player').css({marginRight:0});
                menuOn = true;
                playerOn = true;
            }
        }
        
        $('.saveVideoPlaylist').click(function(){
            
        });
        
        $('.menuItem').click(function(){
            var link = $(this).data('menulink');
            var mediaType = $(this).data('typeofmedia');
            $(iframe).attr('src',link);
            
            if(mediaType == "videos"){
                switchPlayerVideo();
            }
            else if(mediaType == "music"){
                switchPlayerMusic();
            }
        });
        
        $('#menuHide').click(function(){
            var menuWidth = $('.menu').width();
            
            if(menuOn){
                $('.menu').css({marginLeft:-menuWidth});
                $('#menuHide').css({marginLeft:0});
                menuOn = false;
            }
            else{
                $('.menu').css({marginLeft:0});
                $('#menuHide').css({marginLeft:menuWidth});
                menuOn = true;
            }
        });
        
        $('#playerHide').click(function(){
            var playerWidth = $('.player').width();
            
            if(playerOn){
                $('.player').css({marginRight:-playerWidth, position:"fixed"});
                $('#playerHide').css({marginRight:0});
                playerOn = false;
            }
            else{
                $('.player').css({marginRight:0, position:"absolute", top:0});
                $('#playerHide').css({marginRight:playerWidth-37});
                playerOn = true;
            }
        });
        
        function deleteFromPlaylist(){
            $('.deleteFromPlaylist').click(function(){
                $(this).closest('li').remove();
            });
        }
        
        deleteFromPlaylist();
        
        function switchPlayerMusic(){
            $('#videoPlayer').slideUp();
            $('#musicPlayer').slideDown();
        }
        
        function switchPlayerVideo(){
            $('#musicPlayer').slideUp();
            $('#videoPlayer').slideDown();
        }
        
        function setVideo(video, name, thumb){
            $("#fallback").attr("href", "play.php?vid=" + video);
            $('#videoPlayer ul').empty();
            videoPlaylistIndex = 0;
            $('#videoPlayer ul').append("<li class='pure-u-1'><a class='pure-u-11-12 vjs-track' data-index='" + videoPlaylistIndex + "' data-src='" + video + "'>" + name + "</a><span class='pure-u-1-6 outerDeleteFromPlaylist'><i class='pure-u-1 fa fa-close deleteFromPlaylist'></i></span></li>");
            var videoPlaylist=myPlayer.playlist({
                'setTrack':0
            });
            myPlayer.play();
            myPlayer.poster(thumb);
            iframe.src = iframe.src;
            //document.getElementById("thumbnail").src = thumbnail;
        }
        
        function setMusic(music, name, thumb){
            $("#fallback").attr("href", "play.php?vid=" + music);
            $('#musicPlayer ul').empty();
            musicPlaylistIndex = 0;
            $('#musicPlayer ul').append("<li class='pure-u-1'><a class='pure-u-11-12 vjs-track' data-index='" + musicPlaylistIndex + "' data-src='" + music + "'>" + name + "</a><span class='pure-u-1-6 outerDeleteFromPlaylist'><i class='pure-u-1 fa fa-close deleteFromPlaylist'></i></span></li>");
            var musicPlaylist=musicPlayer.playlist({
                'setTrack':0
            });
            musicPlayer.play();
            musicPlayer.poster(thumb);
            iframe.src = iframe.src;
            //document.getElementById("thumbnail").src = thumbnail;
        }
        
        function addToVideoPlaylist(video, name, playID){
            videoPlaylistIndex++;
            $('#videoPlayer ul').append("<li class='pure-u-1'><a class='pure-u-11-12 vjs-track' data-index='" + videoPlaylistIndex + "' data-src='" + video + "'>" + name + "</a><span class='pure-u-1-6 outerDeleteFromPlaylist'><i class='pure-u-1 fa fa-close deleteFromPlaylist'></i></span></li>");
            videoPlaylistArray[videoPlaylistArray.length] = playID;
            var videoPlaylist=myPlayer.playlist({
            });
        }
        
        function addToMusicPlaylist(music, name, playID){
            musicPlaylistIndex++;
            $('#musicPlayer ul').append("<li><a class='pure-u-11-12 vjs-track' data-index='" + musicPlaylistIndex + "' data-src='" + music + "'>" + name + "</a><span class='pure-u-1-6 outerDeleteFromPlaylist'><i class='pure-u-1 fa fa-close deleteFromPlaylist'></i></span></li>");
            musicPlaylistArray[musicPlaylistArray.length] = playID;
            var musicPlaylist=musicPlayer.playlist({
            });
        }
        
        (function($){
                $(document).ready(function(){
                    $(".player").mCustomScrollbar({
                        scrollInertia: 300,
                        mouseWheel:{ scrollAmount: 150 }
                    });
                });
            })(jQuery);
    </script>
</body>
</html>