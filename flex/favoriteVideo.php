<?php
    require("login/db.php");
    session_start();
    
    try{
    $id = $_POST['videoID'];

        $sql = "INSERT INTO videofavorites VALUES (:uid, :vid)";
        $STH = $DBH->prepare($sql);
        $STH->execute(
            array(
                ':uid'=>$_SESSION['login_user'],
                ':vid'=>$id
            )
        );
    }
    catch(PDOException $e){
        echo "I'm sorry, Dave. I'm afraid I can't do that.";
        file_put_contents('PDOErrors.txt', $e->getMessage(), FILE_APPEND);
    }
    echo "success";
?>