<?php
    $sql = "SELECT * FROM user JOIN flex.files ON files.iduser = user.iduser WHERE user.iduser=:userid";
    $STH = $DBH->prepare($sql);
    $STH->setFetchMode(PDO::FETCH_ASSOC);
    session_start();
    $STH->bindParam(':userid', $_SESSION['login_user'], PDO::PARAM_INT);
    session_write_close();
    $STH->execute();
    $fileCount = $STH->rowCount();
    $files = $STH->fetchAll();
?>