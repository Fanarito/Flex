<!doctype html>
<html lang="en">
<?php
    $imgArray = array();
    $wordArray = array("Online Video Player","Organizer","Downloader(WIP)");
    $counter = 0;
    
    foreach(glob('./img/*.*') as $filename){
        array_push($imgArray,substr($filename, 2, strlen($filename)));
        $counter++;
    }
?>

<?php include 'includes/head.php'; ?>

<body>
    <div class="header">
        <div class="home-menu pure-menu pure-menu-open pure-menu-horizontal pure-menu-fixed pure-g">
            <a style="font-size:175%;" class="pure-menu-heading pure-u-lg-3-4" href="">Flex</a>
        </div>
    </div>

    <div class="splash-container">
        <div class="splash">
            <form class="pure-form pure-form-aligned pure-u-2-3" action="#">
                <fieldset>
                    <div class="pure-control-group">
                        <h1 class="loginHeading" for="name">Username</h1>
                        <input id="username" type="text" placeholder="Username">
                    </div>

                    <div class="pure-control-group">
                        <h1 class="loginHeading" for="password">Password</h1>
                        <input id="password" type="password" placeholder="Password">
                    </div>

                        <button id="login" type="submit" class="pure-button pure-button-primary">Login</button>
                </fieldset>
            </form>
            <p class="splash-subhead">
                <?php echo $wordArray[rand(0,2)]; ?>
            </p>
        </div>
    </div>

    <div class="content-wrapper">
        <div class="content">
            <h2 class="content-head is-center">Excepteur sint occaecat cupidatat.</h2>

            <div class="pure-g">
                <div class="l-box pure-u-1 pure-u-md-1-2 pure-u-lg-1-4">

                    <h3 class="content-subhead">
                    <i class="fa fa-rocket"></i>
                    Get Started Quickly
                </h3>
                    <p>
                        Phasellus eget enim eu lectus faucibus vestibulum. Suspendisse sodales pellentesque elementum.
                    </p>
                </div>
                <div class="l-box pure-u-1 pure-u-md-1-2 pure-u-lg-1-4">
                    <h3 class="content-subhead">
                    <i class="fa fa-mobile"></i>
                    Responsive Layouts
                </h3>
                    <p>
                        Phasellus eget enim eu lectus faucibus vestibulum. Suspendisse sodales pellentesque elementum.
                    </p>
                </div>
                <div class="l-box pure-u-1 pure-u-md-1-2 pure-u-lg-1-4">
                    <h3 class="content-subhead">
                    <i class="fa fa-th-large"></i>
                    Modular
                </h3>
                    <p>
                        Phasellus eget enim eu lectus faucibus vestibulum. Suspendisse sodales pellentesque elementum.
                    </p>
                </div>
                <div class="l-box pure-u-1 pure-u-md-1-2 pure-u-lg-1-4">
                    <h3 class="content-subhead">
                    <i class="fa fa-check-square-o"></i>
                    Plays Nice
                </h3>
                    <p>
                        Phasellus eget enim eu lectus faucibus vestibulum. Suspendisse sodales pellentesque elementum.
                    </p>
                </div>
            </div>
        </div>

        <div class="ribbon l-box-lrg pure-g">
            <div class="l-box-lrg is-center pure-u-1 pure-u-md-1-2 pure-u-lg-2-5">
                <img class="pure-img-responsive" alt="File Icons" width="300" src="img/common/file-icons.png">
            </div>
            <div class="pure-u-1 pure-u-md-1-2 pure-u-lg-3-5">

                <h2 class="content-head content-head-ribbon">Laboris nisi ut aliquip.</h2>

                <p>
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor.
                </p>
            </div>
        </div>

        <div class="content">
            <h2 class="content-head is-center">Sign Up Here</h2>
            <p class="is-center">
                But remember the admin has to allow you access. So you can sign up but you are not guaranteed to get in.
            </p>
            <div class="pure-g">
                <div class="l-box-lrg pure-u-1 pure-u-md-2-5">
                    <form class="pure-form pure-form-stacked">
                        <fieldset>

                            <label for="name">Your Name</label>
                            <input id="name" type="text" placeholder="Your Name">


                            <label for="email">Your Email</label>
                            <input id="email" type="email" placeholder="Your Email">

                            <label for="password">Your Password</label>
                            <input id="password" type="password" placeholder="Your Password">

                            <button type="submit" class="pure-button">Sign Up</button>
                        </fieldset>
                    </form>
                </div>

                <div class="l-box-lrg pure-u-1 pure-u-md-3-5">
                    <h4>Contact Us</h4>
                    <p>
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
                    </p>

                    <h4>More Information</h4>
                    <p>
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
                    </p>
                </div>
            </div>

        </div>

        <div class="footer l-box is-center">
           &copy; 
            <?php
                $startYear = 2015;
                $thisYear = date('Y');

                if ($startYear == $thisYear) {
                    echo $startYear;
                } else {
                    echo "{$startYear}&ndash;{$thisYear}";
                }
            ?>
            Viktor Saevarsson and everyone else in the world!
        </div>

    </div>
    <script src="//code.jquery.com/jquery-1.11.2.min.js"></script>
    <script src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
    <script type="text/javascript">
        document.getElementById("username").focus();
        
        $(document).ready(function()
        {

            $('#login').click(function()
            {
                var username=$("#username").val();
                var password=$("#password").val();
                var dataString = 'username='+username+'&password='+password;
                if($.trim(username).length>0 && $.trim(password).length>0)
                {
                    $.ajax({
                        type: "POST",
                        url: "ajaxlogin.php",
                        data: dataString,
                        cache: false,
                        beforeSend: function(){ $("#login").text('Connecting...');},
                        success: function(data){
                            if(data)
                            {
                                window.location.href = "home/";
                            }
                            else
                            {
                                $('#login').html("No work");
                            }
                        }
                    });

                }
                return false;
            });

        });
    </script>
</body>

</html>