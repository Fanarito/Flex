<?php
    /*error_reporting(E_ALL);
    ini_set('display_errors', 1);*/
    require 'db.php';

    $sql = "SELECT username, email FROM user WHERE username=:username OR email = :email";
    $STH = $DBH->prepare($sql);
    $STH->setFetchMode(PDO::FETCH_ASSOC);
    $STH->bindParam(':username', $a = $_POST['username'], PDO::PARAM_STR);
    $STH->bindParam(':email', $a = $_POST['email'], PDO::PARAM_STR);
    $STH->execute();
    $existingUsers = $STH->fetch();

    if($existingUsers['username'] == $_POST['username'] && $existingUsers['email'] == $_POST['email'])
        echo "userExists";
    elseif(strlen($_POST['password']) > 4 && strlen($_POST['username']) > 2)
    {
        $path = "/home/mediaserver/www/home/users/";
	    $path .= $_POST['username'];

        if(mkdir($path)){
            $sql = "INSERT INTO user (`username`, `email`, `password`, `path`) VALUES (:username, :email, :password, :path)";
            $STH = $DBH->prepare($sql);
            $STH->setFetchMode(PDO::FETCH_ASSOC);
            $STH->bindParam(':username', $_POST['username'], PDO::PARAM_STR);
            $STH->bindParam(':email', $_POST['email'], PDO::PARAM_STR);
            $STH->bindParam(':password', openssl_digest($_POST['password'], 'sha512'), PDO::PARAM_STR);
            $STH->bindParam(':path', $a = "users/" . $_POST['username'], PDO::PARAM_STR);
            $STH->execute();
            echo "success";
        }
        else{
            echo "failure";
        }
    }
?>
