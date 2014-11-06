<?php
    session_start();
    require("db.php");
    require '../include/scrypt.php';
    if($DBH)
    {
        //$sql = "SELECT id FROM notendur WHERE notandanafn=:username AND password=:password";
        $sql = "SELECT id, password FROM notendur WHERE notandanafn=:username";
        $STH = $DBH->prepare($sql);
        $STH->setFetchMode(PDO::FETCH_ASSOC);
        $STH->bindParam(':username', $_POST['user'], PDO::PARAM_STR);
        //$STH->bindParam(':password', $_POST['pass'], PDO::PARAM_STR);
        $STH->execute();
        $count = $STH->rowCount();
        $row = $STH->fetch();
        if($count==1)
        {
            if(Password::check($_POST['pass'],$row['password'])){
            $_SESSION['login_user']=$row['id'];
            echo $row['id'];
            }
        }
    }
?>