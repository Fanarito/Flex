<?php
    error_reporting(E_ALL); ini_set( 'display_errors', 1);
    //session_start();
    require "../../db.php";
    $fileName = $_FILES['files']['name'];
    $fileSize = $_FILES['files']['size'];
    //$userId = $_SESSION['login_user'];

    $sql = "SELECT username FROM user WHERE userid = :iduser";
    $STH = $DBH->prepare($sql);
    $STH->setFetchMode(PDO::FETCH_ASSOC);
    $STH->bindParam(':iduser', $userId, PDO::PARAM_STR);
    $STH->execute();
    $username = $STH->fetch();

    for($i = 0; $i < count($fileName); $i++){
        echo $fileName[$i] . "<br>";
        $path = "users/" . $username['name'] . $fileName[$i];
        echo $path . "<br>";
        
        $sql = "INSERT INTO files (`iduser`, `path`, `name`, `size`) VALUES (`:userID`,`:path`,`:name`,`:size`)";
        $STH = $DBH->prepare($sql);
        $STH->setFetchMode(PDO::FETCH_ASSOC);
        $STH->bindParam(':userID', $userId, PDO::PARAM_STR);
        $STH->bindParam(':path', $path], PDO::PARAM_STR);
        $STH->bindParam(':name', $fileName[$i], PDO::PARAM_STR);
        $STH->bindParam(':size', $fileSize[$i], PDO::PARAM_STR);
        echo $sql;
    }
?>