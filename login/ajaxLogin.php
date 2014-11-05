<?php
    session_start();
    require("db.php");
    if($DBH)
    {
        $sql= "SELECT id FROM notendur WHERE notandanafn=:username AND password=:password";
        $STH = $DBH->prepare($sql);
        $STH->setFetchMode(PDO::FETCH_ASSOC);
        $STH->bindParam(':username', $_POST['user'], PDO::PARAM_STR);
        $STH->bindParam(':password', $_POST['pass'], PDO::PARAM_STR);
        $STH->execute();
        $count = $STH->rowCount();
        $row = $STH->fetch();
        if($count==1)
        {
            $_SESSION['login_user']=$row['id'];
            echo $row['id'];
        }
    }
?>