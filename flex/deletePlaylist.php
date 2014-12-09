<?php
    require("login/db.php");
    session_start();
    
    try{
        //Get variables
        $playlistID = $_POST['playlistID'];
        $uid = $_SESSION['login_user'];
        
        //delete songs from playlist
        $sql = "DELETE FROM musicplaylists WHERE playlist_id = :playlistID";
        $STH = $DBH->prepare($sql);
        $STH->execute(
            array(
                ':playlistID'=>$playlistID
            )
        );
        
        //delete videos from playlist
        $sql = "DELETE FROM videoplaylists WHERE playlist_id = :playlistID";
        $STH = $DBH->prepare($sql);
        $STH->execute(
            array(
                ':playlistID'=>$playlistID
            )
        );
        
        //delete playlist
        $sql = "DELETE FROM playlists WHERE id = :playlistID";
        $STH = $DBH->prepare($sql);
        $STH->execute(
            array(
                ':playlistID'=>$playlistID
            )
        );
    }
    catch(PDOException $e){
        echo "I'm sorry, Dave. I'm afraid I can't do that.";
        file_put_contents('PDOErrors.txt', $e->getMessage(), FILE_APPEND);
    }
    echo "success";
?>