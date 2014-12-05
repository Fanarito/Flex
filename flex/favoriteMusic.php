<?php
    require("login/db.php");
    session_start();
    
    try{
        $id = $_POST['musicID'];

        $sql = "INSERT INTO musicfavorites VALUES (:uid, :mid)";
        $STH = $DBH->prepare($sql);
        $STH->execute(
            array(
                ':uid'=>$_SESSION['login_user'],
                ':mid'=>$id
            )
        );
    }
    catch(PDOException $e){
        echo "I'm sorry, Dave. I'm afraid I can't do that.";
        file_put_contents('PDOErrors.txt', $e->getMessage(), FILE_APPEND);
    }
    echo "success";
?>