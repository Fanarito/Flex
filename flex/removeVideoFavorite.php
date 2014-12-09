<?php
    require("login/db.php");
    session_start();
    
    try{
        //Get variables
        $videoID = $_POST['videoID'];
        $uid = $_SESSION['login_user'];
        
        //delete video from favorites
        $sql = "DELETE FROM videofavorites WHERE videos_id = :videoID AND notendur_id = :uid";
        $STH = $DBH->prepare($sql);
        $STH->execute(
            array(
                ':videoID'=>$videoID,
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