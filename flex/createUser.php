<?php
echo "a";
require("login/db.php");
echo "b";
require './include/scrypt.php';
echo "c";
if($DBH)
{
    try{
        //$sql = "SELECT id FROM notendur WHERE notandanafn=:username AND password=:password";
        $sql = "INSERT INTO notendur (notandanafn, email, password) VALUES (:username, :email, :password);";
        echo "1";
        $STH = $DBH->prepare($sql);
        echo "2";
        $STH->setFetchMode(PDO::FETCH_ASSOC);
        echo "3";
        $STH->bindParam(':username', $_GET['user'], PDO::PARAM_STR);
        echo "4";
        $STH->bindParam(':email', $_GET['email'], PDO::PARAM_STR);
        echo "5";
        $STH->bindParam(':password', Password::hash($_GET['password']), PDO::PARAM_STR);
        echo "6";
        $STH->execute();
        echo "7";
    }
    catch(PDOException $e){
        echo 'Error: ' . $e->GetMessage();
    }
}
?>
