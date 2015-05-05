<?php
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
    require '../../db.php';

    $newName = $_POST['newName'];
    $fileID = $_POST['fileID'];

    $sql = "UPDATE files SET name=:newName WHERE idfiles=:fileID";
    $STH = $DBH->prepare($sql);
    $STH->setFetchMode(PDO::FETCH_ASSOC);
    $STH->bindParam(':newName', $newName, PDO::PARAM_STR);
    $STH->bindParam(':fileID', $fileID, PDO::PARAM_INT);
    $STH->execute();
    $existingUsers = $STH->fetch();

    echo "success";
?>