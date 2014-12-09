<?php
    require("login/db.php");
    session_start();
    
    try{
        //get variables
        $playlistID = $_POST['playlistID'];
        
        $sql = "SELECT videoplaylists.video_id, videos.path, videos.thumbnail, videos.nafn FROM videoplaylists JOIN videos ON video_id = videos.id WHERE playlist_id = :playlistID";
        $STH = $DBH->prepare($sql);
        $STH->bindParam(':playlistID', $playlistID, PDO::PARAM_INT);
        $STH->execute();
        $row = $STH->fetchAll();
        //encode sql result into json and send it back to user
        echo json_encode($row);
    }
    catch(PDOException $e){
        echo "I'm sorry, Dave. I'm afraid I can't do that.";
        file_put_contents('PDOErrors.txt', $e->getMessage(), FILE_APPEND);
    }
?>