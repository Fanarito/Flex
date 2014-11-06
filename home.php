<?php require("include/head.php"); ?>
<?php require("login/db.php"); ?>
<?php include("scripts/images.php"); ?>
    <body ng-app>
        <script src="scripts/caption.js"></script>
        <?php require("include/menu.php"); ?>
        <div class="pure-g">
            <div id="main" class="pure-u-sm-1 pure-u-md-1 pure-u-lg-1">
                <div id="news" class="pure-u-sm-1 pure-u-md-7-24 pure-u-lg-7-24 home-card">
                    
                    <h1>News</h1>
                    <div class="panel">
                        <h3>Lorem thingum</h3>
                        <p class="pure-u-lg-1">Thing is a thing is a thing is a thing is a thing is a thing</p>
                        <button class="pure-button pure-u-lg-1">Read</button>
                    </div>
                    <div class="panel">
                        <h3>Lorem thingum</h3>
                        <p class="pure-u-lg-1">Thing is a thing is a thing is a thing is a thing is a thing</p>
                        <button class="pure-button pure-u-lg-1">Read</button>
                    </div>
                    <div class="panel">
                        <h3>Lorem thingum</h3>
                        <p class="pure-u-lg-1">Thing is a thing is a thing is a thing is a thing is a thing</p>
                        <button class="pure-button pure-u-lg-1">Read</button>
                    </div>
                    <div class="panel">
                        <h3>Lorem thingum</h3>
                        <p class="pure-u-lg-1">Thing is a thing is a thing is a thing is a thing is a thing</p>
                        <button class="pure-button pure-u-lg-1">Read</button>
                    </div>
                </div>
                <div id="music_favorites" class="pure-u-sm-1 pure-u-md-7-24 pure-u-lg-7-24 home-card">
                    <h1>Favorite Music</h1>
                    <table class="pure-table">
                        <thead>
                            <tr>
                                <th>Thumbnail</th>
                                <th>Artist</th>
                                <th>Album</th>
                                <th>Song</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><img class="thumbnailMusic" src="default/thumbnail.jpg"/></td>
                                <td>Darude</td>
                                <td></td>
                                <td>Sandstorm</td>
                            </tr>
                            <tr>
                                <td><img class="thumbnailMusic" src="default/thumbnail.jpg"/></td>
                                <td>Darude</td>
                                <td></td>
                                <td>Sandstorm</td>
                            </tr>
                            <tr>
                                <td><img class="thumbnailMusic" src="default/thumbnail.jpg"/></td>
                                <td>Darude</td>
                                <td></td>
                                <td>Sandstorm</td>
                            </tr>
                            <tr>
                                <td><img class="thumbnailMusic" src="default/thumbnail.jpg"/></td>
                                <td>Darude</td>
                                <td></td>
                                <td>Sandstorm</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div id="video_favorites" class="pure-u-sm-1 pure-u-md-7-24 pure-u-lg-7-24 home-card">
                    <h1>Favorite Movies/TV Shows</h1>
                    <div ng-init="favoriteMovies = [
                      <?php
                        if($DBH)
                        {
                            echo $string;
                            $sql = "SELECT nafn FROM videos";
                            $STH = $DBH->prepare($sql);
                            $STH->setFetchMode(PDO::FETCH_ASSOC);
                            $STH->execute();
                            $row = $STH->fetchAll();
                            $count = $STH->rowCount();

                            foreach($row as $thing){
                                $string .= "{";
                                $string .= "name:'";
                                $string .= $thing['nafn'];
                                $string .= "', thumb:'";
                                $string .= getImage($thing['nafn']);
                                $string .= "'}";
                                $string .= ",";
                            }
                        
                            echo substr($string, 0, -1);
                        }
                    ?>
                ]"></div>
                    <div class="thumbnailWrapper">
                        <ul>
                            <li ng-repeat="name in favoriteMovies">
                                <a href="#"><img class="" src="{{name.thumb}}"/></a>
                                <div class="caption">
                                    <p class="captionInside">{{name.name}}</p>
                                </div>
                            </li>
                            <div class='clear'></div><!-- clear the float -->
                        </ul>
                    </div>
                </div>
                <div id="playlists" class="pure-u-sm-1 pure-u-md-7-24 pure-u-lg-7-24 home-card lower">
                    <h1>Playlists</h1>
                    <table class="pure-table">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Length</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Thing</td>
                                <td>300</td>
                            </tr>
                            <tr>
                                <td>Thing</td>
                                <td>300</td>
                            </tr>
                            <tr>
                                <td>Thing</td>
                                <td>300</td>
                            </tr>
                            <tr>
                                <td>Thing</td>
                                <td>300</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div id="recently_watched" class="pure-u-sm-1 pure-u-md-7-24 pure-u-lg-7-24 home-card lower">
                    <h1>Recently Watched</h1>
                    <table class="pure-table">
                        <thead>
                            <tr>
                                <th>Thumbnail</th>
                                <th>Name</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><img class="thumbnailMovie" src="default/300.jpg"/></td>
                                <td>3 fucking hundred</td>
                            </tr>
                            <tr>
                                <td><img class="thumbnailMovie" src="default/300.jpg"/></td>
                                <td>3 fucking hundred</td>
                            </tr>
                            <tr>
                                <td><img class="thumbnailMovie" src="default/300.jpg"/></td>
                                <td>3 fucking hundred</td>
                            </tr>
                            <tr>
                                <td><img class="thumbnailMovie" src="default/300.jpg"/></td>
                                <td>3 fucking hundred</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div id="recently_listened" class="pure-u-sm-1 pure-u-md-7-24 pure-u-lg-7-24 home-card lower">
                    <h1>Recently Listened</h1>
                    <table class="pure-table">
                        <thead>
                            <tr>
                                <th>Thumbnail</th>
                                <th>Artist</th>
                                <th>Album</th>
                                <th>Song</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><img class="thumbnailMusic" src="default/thumbnail.jpg"/></td>
                                <td>Darude</td>
                                <td></td>
                                <td>Sandstorm</td>
                            </tr>
                            <tr>
                                <td><img class="thumbnailMusic" src="default/thumbnail.jpg"/></td>
                                <td>Darude</td>
                                <td></td>
                                <td>Sandstorm</td>
                            </tr>
                            <tr>
                                <td><img class="thumbnailMusic" src="default/thumbnail.jpg"/></td>
                                <td>Darude</td>
                                <td></td>
                                <td>Sandstorm</td>
                            </tr>
                            <tr>
                                <td><img class="thumbnailMusic" src="default/thumbnail.jpg"/></td>
                                <td>Darude</td>
                                <td></td>
                                <td>Sandstorm</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!--script src="scripts/caption.js"></script-->
        <script>
            $(document).ready(function(){
                var windowHeight = $(window).height();
                $('.home-card').css({height: windowHeight/2.11});
            });
            $(window).resize(function() {
                var windowHeight = $(window).height();
                $('.home-card').css({height: windowHeight/2.11});
            });
        </script>
    </body>
</html>
