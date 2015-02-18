<?php
    require("db.php");
    //require '../include/scrypt.php';
    if($DBH)
    {
        //$sql = "SELECT id FROM notendur WHERE notandanafn=:username AND password=:password";
        $sql = "SELECT iduser, username, password FROM user WHERE username=:username AND password=:password";
        $STH = $DBH->prepare($sql);
        $STH->setFetchMode(PDO::FETCH_ASSOC);
        $STH->bindParam(':username', $_GET['username'], PDO::PARAM_STR);
        $STH->bindParam(':password', $_GET['password'], PDO::PARAM_STR);
        $STH->execute();
        $count = $STH->rowCount();
        $row = $STH->fetch();
        if($count==1)
        {
            session_start();
            $_SESSION['login_user']=$row['iduser'];
            session_write_close();
            echo $row['iduser'];
            die();
        }
    }
?>