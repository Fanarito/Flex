<?php
    require("db.php");
    //require '../include/scrypt.php';
    if($DBH)
    {
        //$sql = "SELECT id FROM notendur WHERE notandanafn=:username AND password=:password";
        $sql = "SELECT iduser, username, password, active FROM user WHERE username=:username AND password=:password";
        $STH = $DBH->prepare($sql);
        $STH->setFetchMode(PDO::FETCH_ASSOC);
        $STH->bindParam(':username', $_POST['username'], PDO::PARAM_STR);
        $STH->bindParam(':password', openssl_digest($_POST['password'], 'sha512'), PDO::PARAM_STR);
        $STH->execute();
        $count = $STH->rowCount();
        $row = $STH->fetch();
        
        if($count==1 && $row['active']==1)
        {
            session_start();
            $_SESSION['login_user']=$row['iduser'];
            session_write_close();
            echo "correct";
            die();
        }
        else if($count==1 && $row['active']==0)
        {
            echo "notActive";
        }
        else if($count==0)
        {
            echo "incorrectLogin";
        }
        else
        {
            echo "unknownError";
        }
    }
?>