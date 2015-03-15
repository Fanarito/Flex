<?php
session_start();
// curPageURL returns the current URL
function curPageURL() {
    $pageURL = 'http';
    if ($_SERVER["HTTPS"] == "on") {$pageURL .= "s";}
    
    $pageURL .= "://";
    
    if ($_SERVER["SERVER_PORT"] != "80")
    {
        $pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
    }
    else
    {
        $pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
    }
    return $pageURL;
}

//Check if your on landingpage and redirect to home if you are on it and logged in
if(curPageURL() == "http://fanarito.duckdns.org/" || curPageURL() == "https://fanarito.duckdns.org/")
{
    if(isset($_SESSION['login_user']) || !empty($_SESSION['login_user']))
    {
        header("Location: /home/");
    }
} 
else if(empty($_SESSION['login_user']) || !isset($_SESSION['login_user']))
{
    header("Location: /");
}
session_write_close();
?>