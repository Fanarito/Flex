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
<body ng-app class="pure-g">
    <div class="main pure-u-1">
        <div class="allVideos pure-u-1">
            <div ng-init="allMusics = [
                <?php
                    if($DBH)
                    {
                        $string ="";
                        $uid = $_SESSION['login_user'];
                        $sql = "SELECT music.id, music.nafn, music.thumbnail, music.path FROM music
                                    JOIN useraccess ON useraccess.accessgroup = music.accessgroup
                                    JOIN notendur ON notendur.id = useraccess.notendur_id";
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
            <div class="search">Search: <input class="searchBox" id="allMusic" ng-model="allMusic"><br></div>
            <div class="scrollbar">
                <ul class="pure-u-1">
                    <li ng-repeat="name in allMusics | filter:allMusic" class="pure-u-1 panel">
                        <div class="information pure-u-5-6">
                            <div class="image pure-u-1-2">
                                <img class="thumbnail" src="{{name.thumb}}"/>
                            </div>
                            <h4 class="playHeading pure-u-1-2">{{name.name}}</h4>
                        </div>
                        <div class="sideOptions pure-u-1-6">
                            <button class="options play playMusic pure-button pure-u-1" data-playid="{{name.id}}" data-music="{{name.path}}" data-name="{{name.name}}" data-thumbnail="{{name.thumb}}"><i class="fa fa-play"></i></button>
                            <button class="options addToPlaylist middleOption addToMusicPlaylist pure-button pure-u-1" data-playid="{{name.id}}" data-music="{{name.path}}" data-name="{{name.name}}" data-thumbnail="{{name.thumb}}"><i class="fa fa-plus"></i></button>
                            <button class="options addToFavorites addToMusicFavorites pure-button pure-u-1" data-playid="{{name.id}}" data-music="{{name.path}}" data-name="{{name.name}}" data-thumbnail="{{name.thumb}}"><i class="fa fa-star"></i></button>
                        </div>
                        <br><div class="pure-u-1 betweener"></div><br>
                    </li>
                </ul>
            </div>
        </div> 
    </div>
    <script>
        var windowHeight = $(window).height();
        var windowWidth = $(window).width();
        
        function mediaButtons(){
            $('.addToMusicFavorites').click(function(){
                var video = $(this).data('video');
                var vidId = $(this).data('playid');
                //var thumb = $(this).data('thumbnail');
                
                $.ajax({
                    type: "POST",
                    url: "favoriteMusic.php",
                    data: {musicID: vidId},
                    cache: false,
                    success: function(data){
                    }
                });
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
                var thumb = $(this).data('thumbnail');
                var musicId = $(this).data('playid');
                //var thumb = $(this).data('thumbnail');
                parent.addToMusicPlaylist(music.substring(0,music.length-4), name.substring(0,name.length-4), musicId ,thumb);
                parent.deleteFromPlaylist();

                //parent.musicPlayer.play();
            });
        }
        
        function optionsResize(){
            $('.options').css({height: $('.panel').height()/3});
            $('.thumbnail').removeAttr( 'style' );
            $('.image').css({height:$('.panel').height()});

            if(windowWidth < 569){
                $('.thumbnail').css({maxHeight:$('.panel').height()/2});
            }
        }
        
        $(document).ready(function(){
            mediaButtons();

            $('.scrollbar').css({height:windowHeight-30,maxHeight:windowHeight});
            $('.panelView').css({height:windowHeight-30,maxHeight:windowHeight});
            optionsResize();

            (function($){
                $(document).ready(function(){
                    $(".scrollbar").mCustomScrollbar({
                        scrollInertia: 300,
                        mouseWheel:{ scrollAmount: 150 }
                    });
                });
            })(jQuery);
            
            $( ".searchbox" ).keypress(function() {
                mediaButtons();
                optionsResize();
            });
        });
    </script>
</body>
</html>