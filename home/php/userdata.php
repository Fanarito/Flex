<?php
    require '../db.php';

    $sql = "SELECT username, email FROM user WHERE iduser=:userid";
    $STH = $DBH->prepare($sql);
    $STH->setFetchMode(PDO::FETCH_ASSOC);
    session_start();
    $STH->bindParam(':userid', $_SESSION['login_user'], PDO::PARAM_INT);
    session_write_close();
    $STH->execute();
    $count = $STH->rowCount();
    $user = $STH->fetch();
?>