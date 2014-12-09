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
    <script type="text/javascript" src="js/underscore-min.js"></script>
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
                    <li class='pure-u-1'><a class='pure-u-5-6 vjs-track' data-index='0' data-src='http://video-js.zencoder.com/oceans-clip' data-thumbnail='http://video-js.zencoder.com/oceans-clip.png'>Ocean Clip</a><span class="pure-u-1-6 outerDeleteFromPlaylist"><i class='pure-u-1 fa fa-close deleteFromPlaylist deleteFromVideoPlaylist'></i></span></li>
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
                    <li class='pure-u-1'><a class='pure-u-5-6 vjs-track' data-index='0' data-src='music/01%Chandelier' data-thumbnail='thumbnails/01%Chandelier.mp3.jpg'>Born to Die</a><span class="pure-u-1-6 outerDeleteFromPlaylist"><i class='pure-u-1 fa fa-close deleteFromPlaylist deleteFromMusicPlaylist'></i></span></li>
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
        //hide the music
        $('#musicPlayer').hide();
        $('.music').hide();
        
        //check if you were using music or video
        if(location.hash == "#video"){
            $('#musicPlayer').hide();
            $('.music').hide();
            $('#videoPlayer').show();
            $('.video').show();
        }
        else if(location.hash == "#music"){
            $('#videoPlayer').hide();
            $('.video').hide();
            $('#musicPlayer').show();
            $('.music').show();
        }
        
        //make variables and run responsive function
        responsive();
        var menuOn = true;
        var playerOn = true;
        var videoPlaylistArray = [];
        var musicPlaylistArray = [];
        var videoPlaylistIndex = 0;
        var musicPlaylistIndex = 0;
        
        //on resize rerun responsive function
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
        
        function playMusicPlaylist(playlistID, playlistName){
            //run php script
            $.ajax({
                type: "POST",
                url: "playMusicPlaylist.php",
                data: {playlistID: playlistID},
                cache: false,
                success: function(data){
                    //parse php return data into json
                    var json = JSON.parse(data);
                    //empty musicplaylist
                    $('#musicPlayer ul').empty();
                    //reset playlistindex counter
                    musicPlaylistIndex = 0;
                    //reset playlist array
                    musicPlaylistArray = [];
                    for (x in json){
                        var music = json[x]['path'];
                        music = music.substring(0,music.length-4);
                        var thumb = json[x]['thumbnail'];
                        var name = json[x]['nafn'];
                        name = name.replace(/\./g, ' ');
                        var playID = json[x]['music_id'];
                        //add song to playlist
                        $('#musicPlayer ul').append("<li class='pure-u-1'><a class='pure-u-11-12 vjs-track' data-index='" + musicPlaylistIndex + "' data-src='" + music + "' data-thumbnail='" + thumb +  "'>" + name + "</a><span class='pure-u-1-6 outerDeleteFromPlaylist'><i class='pure-u-1 fa fa-close deleteFromPlaylist deleteFromMusicPlaylist'></i></span></li>");
                        musicPlaylistIndex++;
                        musicPlaylistArray[musicPlaylistArray.length] = playID;
                    }
                    
                    //reset videoplaylist and set player to play. Also rerun deleteFromPlaylist function
                    var musicPlaylist=musicPlayer.playlist({
                        'setTrack':0
                    });
                    musicPlayer.play();
                    deleteFromPlaylist();
                }
            });
        }
        
        function deletePlaylist(playlistID){
            $.ajax({
                type: "POST",
                url : "deletePlaylist.php",
                data: {playlistID: playlistID},
                cache: false,
                success: function(data){
                    iframe.src = iframe.src;
                }
            });
        }
        
        function playVideoPlaylist(playlistID, playlistName){
            //run php script
            $.ajax({
                type: "POST",
                url: "playVideoPlaylist.php",
                data: {playlistID: playlistID},
                cache: false,
                success: function(data){
                    //parse php return data into json
                    var json = JSON.parse(data);
                    //empty videoplaylist
                    $('#videoPlayer ul').empty();
                    //reset playlistindex counter
                    videoPlaylistIndex = 0;
                    //reset playlist array
                    videoPlaylistArray = [];
                    for (x in json){
                        var video = json[x]['path'];
                        video = video.substring(0,video.length-4);
                        var thumb = json[x]['thumbnail'];
                        var name = json[x]['nafn'];
                        name = name.replace(/\./g, " ");
                        var playID = json[x]['video_id'];
                        //add video to playlist
                        $('#videoPlayer ul').append("<li class='pure-u-1'><a class='pure-u-11-12 vjs-track' data-index='" + videoPlaylistIndex + "' data-src='" + video + "' data-thumbnail='" + thumb +  "'>" + name + "</a><span class='pure-u-1-6 outerDeleteFromPlaylist'><i class='pure-u-1 fa fa-close deleteFromPlaylist deleteFromVideoPlaylist'></i></span></li>");
                        videoPlaylistIndex++;
                        videoPlaylistArray[videoPlaylistArray.length] = playID;
                        deleteFromPlaylist();
                    }
                    //reset videoplaylist and set player to play. Also rerun deleteFromPlaylist function
                    var videoPlaylist=myPlayer.playlist({
                        'setTrack':0
                    });
                    myPlayer.play();
                    deleteFromPlaylist();
                }
            });
        }
        
        //make site responsive by resizing most elements
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
        
        //save musicplaylist
        $('.saveMusicPlaylist').click(function(){
            var playlistName = prompt("Name your playlist");
            
            if(playlistName){
                $.ajax({
                    type: "POST",
                    url: "saveMusicPlaylist.php",
                    data: {playlist: musicPlaylistArray,playlistName:playlistName},
                    cache: false,
                    success: function(data){
                    }
                });
            }
        });
        
        //save videoplaylist
        $('.saveVideoPlaylist').click(function(){
            var playlistName = prompt("Name your playlist");
            
            if(playlistName){
                $.ajax({
                    type: "POST",
                    url: "saveVideoPlaylist.php",
                    data: {playlist: videoPlaylistArray,playlistName:playlistName},
                    cache: false,
                    success: function(data){
                    }
                });
            }
        });
        
        //goto other pages on website
        $('.menuItem').click(function(){
            var link = $(this).data('menulink');
            var mediaType = $(this).data('typeofmedia');
            $(iframe).attr('src',link);
            
            if(mediaType == "videos"){
                switchPlayerVideo();
                location.hash = "video";
            }
            else if(mediaType == "music"){
                switchPlayerMusic();
                location.hash = "music";
            }
        });
        
        //when in mobile view hide and show menu by clicking on menuHide button
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
        
        //when in mobile view hide and show player by clicking on playerHide button
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
        
        //delete from playlist
        function deleteFromPlaylist(){
            $('.deleteFromVideoPlaylist').click(function(){
                $(this).closest('li').remove();
                var id = $(this).data('playid');
                
                videoPlaylistArray = _.without(videoPlaylistArray, id);
            });
            
            $('.deleteFromMusicPlaylist').click(function(){
                $(this).closest('li').remove();
                var id = $(this).data('playid');
                
                musicPlaylistArray = _.without(musicPlaylistArray, id);
            });
        }
        
        deleteFromPlaylist();
        
        //switch players
        function switchPlayerMusic(){
            $('#videoPlayer').slideUp();
            $('#musicPlayer').slideDown();
        }
        
        //switch players
        function switchPlayerVideo(){
            $('#musicPlayer').slideUp();
            $('#videoPlayer').slideDown();
        }
        
        //set video
        function setVideo(video, name, thumb, playID){
            $("#fallback").attr("href", "play.php?vid=" + video);
            //empty playlist
            $('#videoPlayer ul').empty();
            videoPlaylistIndex = 0;
            //add video to playlist
            $('#videoPlayer ul').append("<li class='pure-u-1'><a class='pure-u-11-12 vjs-track' data-index='" + videoPlaylistIndex + "' data-src='" + video + "' data-thumbnail='" + thumb + "'>" + name + "</a><span class='pure-u-1-6 outerDeleteFromPlaylist'><i class='pure-u-1 fa fa-close deleteFromPlaylist deleteFromVideoPlaylist'></i></span></li>");
            //register new video in playlist
            var videoPlaylist=myPlayer.playlist({
                'setTrack':0
            });
            myPlayer.play();
            myPlayer.poster(thumb);
            iframe.src = iframe.src;
            videoPlaylistArray = [];
            videoPlaylistArray[videoPlaylistArray.length] = playID;
            //document.getElementById("thumbnail").src = thumbnail;
        }
        
        function setMusic(music, name, thumb, playID){
            $("#fallback").attr("href", "play.php?vid=" + music);
            //empty playlist
            $('#musicPlayer ul').empty();
            musicPlaylistIndex = 0;
            //add music to playlist
            $('#musicPlayer ul').append("<li class='pure-u-1'><a class='pure-u-11-12 vjs-track' data-index='" + musicPlaylistIndex + "' data-src='" + music + "' data-thumbnail='" + thumb +  "'>" + name + "</a><span class='pure-u-1-6 outerDeleteFromPlaylist'><i class='pure-u-1 fa fa-close deleteFromPlaylist deleteFromMusicPlaylist'></i></span></li>");
            //register new music in playlist
            var musicPlaylist=musicPlayer.playlist({
                'setTrack':0
            });
            musicPlayer.play();
            musicPlayer.poster(thumb);
            iframe.src = iframe.src;
            musicPlaylistArray = [];
            musicPlaylistArray[musicPlaylistArray.length] = playID;
            //document.getElementById("thumbnail").src = thumbnail;
        }
        
        function addToVideoPlaylist(video, name, playID, thumb){
            videoPlaylistIndex++;
            $('#videoPlayer ul').append("<li class='pure-u-1'><a class='pure-u-11-12 vjs-track' data-index='" + videoPlaylistIndex + "' data-src='" + video + "' data-thumbnail='" + thumb +  "'>" + name + "</a><span class='pure-u-1-6 outerDeleteFromPlaylist'><i class='pure-u-1 fa fa-close deleteFromPlaylist deleteFromVideoPlaylist' data-playid='" + playID + "'></i></span></li>");
            videoPlaylistArray[videoPlaylistArray.length] = playID;
            var videoPlaylist=myPlayer.playlist({
            });
        }
        
        function addToMusicPlaylist(music, name, playID, thumb){
            musicPlaylistIndex++;
            $('#musicPlayer ul').append("<li><a class='pure-u-11-12 vjs-track' data-index='" + musicPlaylistIndex + "' data-src='" + music + "' data-thumbnail='" + thumb +  "'>" + name + "</a><span class='pure-u-1-6 outerDeleteFromPlaylist'><i class='pure-u-1 fa fa-close deleteFromPlaylist deleteFromMusicPlaylist' data-playid='" + playID + "'></i></span></li>");
            musicPlaylistArray[musicPlaylistArray.length] = playID;
            var musicPlaylist=musicPlayer.playlist({
            });
        }
        
        //intialize custom scrollbars
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