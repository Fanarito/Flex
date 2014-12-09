<?php
    require("login/db.php");
    session_start();
    
    try{
        //Get variables
        $musicID = $_POST['musicID'];
        $uid = $_SESSION['login_user'];
        
        //delete song from favorites
        $sql = "DELETE FROM musicfavorites WHERE music_id = :musicID AND notendur_id = :uid";
        $STH = $DBH->prepare($sql);
        $STH->execute(
            array(
                ':musicID'=>$musicID,
                ':uid'=>$uid
            )
        );
    }
    catch(PDOException $e){
        echo "I'm sorry, Dave. I'm afraid I can't do that.";
        file_put_contents('PDOErrors.txt', $e->getMessage(), FILE_APPEND);
    }
    echo "success";
?>