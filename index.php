<?php require 'loginCheck.php'; ?>
<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Flex | Welcome</title>
    <link rel="stylesheet" href="css/foundation.css" />
    <link rel="stylesheet" href="css/foundation-icons.css" />
    <link rel="stylesheet" href="css/main.css" />
    <script src="js/vendor/modernizr.js"></script>
</head>

<body>
    <div class="fakeNavbar"></div>
    <div class="fixed">
        <nav class="top-bar">
            <ul class="left">
                <li class="name">
                    <h1><a href="#">Flex</a></h1>
                </li>
                <li class="toggle-topbar">
                    <a href="#"></a>
                </li>
            </ul>
            <ul class="right">
                <li>
                    <a href="#" data-reveal-id="loginUp" class="button" style="top: 0;height: 45px;vertical-align: middle;line-height: 30px;">Login</a>
                </li>
            </ul>
        </nav>
    </div>
    
    <div id="content">
        <div class="row greyBackground">
            <div class="small-12 medium-6 large-6 column small-centered">
                <ul class="introduction" data-orbit>
                    <li>
                        <img class="centerImage" src="http://lorempicsum.com/simpsons/1000/500/1" alt="slide 1" />
                        <div class="orbit-caption">
                            Caption Uno.
                        </div>
                    </li>
                    <li>
                        <img class="centerImage" src="http://lorempicsum.com/simpsons/1000/500/2" alt="slide 2" />
                        <div class="orbit-caption">
                            Caption Dos.
                        </div>
                    </li>
                    <li>
                        <img class="centerImage" src="http://lorempicsum.com/simpsons/1000/500/3" alt="slide 3" />
                        <div class="orbit-caption">
                            Caption Tres.
                        </div>
                    </li>
                    <li>
                        <img class="centerImage" src="http://lorempicsum.com/simpsons/1000/500/4" alt="slide 3" />
                        <div class="orbit-caption">
                            Caption Cuatro.
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <div id="loginUp" class="reveal-modal tiny" data-reveal>
        <form>
            <h2 class="center">Login</h2>
            <div class="row">
                <div class="large-8 columns small-centered">
                    <label>Username:
                        <input type="text" placeholder="Username" id="username"/>
                    </label>
                </div>
            </div>
            <div class="row">
                <div class="large-8 columns small-centered">
                    <label>Password:
                        <input type="password" placeholder="Password" id="password"/>
                    </label>
                </div>
            </div>
            <div class="row">
                <div class="large-8 column small-centered">
                    <div class="large-6 small-12 columns">
                        <a href="#" class="button" id="login">Login</a>
                    </div>
                    <div class="large-6 small-12 columns">
                        <a href="#" data-reveal-id="secondModal" class="button">Sign Up</a>
                    </div>
                </div>
            </div>
        </form>
        <a class="close-reveal-modal">&#215;</a>
    </div>
    
    <div id="secondModal" class="reveal-modal tiny" data-reveal>
        <form data-abide>
            <h2 class="center">Sign Up</h2>
            <div class="row">
                <div class="large-8 columns small-centered">
                    <label>Email:
                        <input type="email" placeholder="email@email.com" id="signUpEmail" required/>
                    </label>
                    <small class="error">An email address is required.</small>
                </div>
            </div>
            <div class="row">
                <div class="large-8 columns small-centered name-field">
                    <label>Username:
                        <input type="text" placeholder="Username" id="signUpUsername" required pattern="[a-zA-Z]+"/>
                    </label>
                    <small class="error">Name is required and must be a string.</small>
                </div>
            </div>
            <div class="row">
                <div class="large-8 columns small-centered password-field">
                    <label>Password:
                        <input placeholder="Password" type="password" id="signUpPassword" required pattern="[a-zA-Z]+">
                    </label>
                </div>
            </div>
            <div class="row">
                <div class="large-8 columns small-centered password-confirmation-field">
                    <label>Retype Password:
                        <input type="password" required pattern="[a-zA-Z]+" data-equalto="signUpPassword" placeholder="Password">
                    </label>
                    <small class="error">The password did not match</small>
                </div>
            </div>
            <div class="row center">
                <div class="large-6 columns small-centered">
                    <a href="#" class="button" id="signUp">Sign Up</a>
                </div>
            </div>
        </form>
        <a class="close-reveal-modal">&#215;</a>
    </div>

    <script src="js/vendor/jquery.js"></script>
    <script src="js/foundation.min.js"></script>
    <script>
        $(document).foundation();
    </script>
    <script type="text/javascript" src="js/ui.js"></script>
</body>

</html>