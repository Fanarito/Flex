<?php
    require("login/db.php");
    session_start();
    
    try{
        //Get variables
        $playlist = $_POST['playlist'];
        $playlistName = $_POST['playlistName'];
        $uid = $_SESSION['login_user'];
        
        //select the id for playlist deletion
        $sql = "SELECT id FROM playlists WHERE name = :playlistName AND notendur_id = :uid";
        $STH = $DBH->prepare($sql);
        $STH->bindParam(':playlistName', $playlistName, PDO::PARAM_STR); 
        $STH->bindParam(':uid', $uid, PDO::PARAM_INT); 
        $STH->execute();
        $playlistID = $STH->fetchAll();
        
        //delete videos from playlist
        $sql = "DELETE FROM videoplaylists WHERE playlist_id = :playlistID";
        $STH = $DBH->prepare($sql);
        $STH->execute(
            array(
                ':playlistID'=>$playlistID[0]['id']
            )
        );
        
        //delete playlist
        $sql = "DELETE FROM playlists WHERE id = :playlistID";
        $STH = $DBH->prepare($sql);
        $STH->execute(
            array(
                ':playlistID'=>$playlistID[0]['id']
            )
        );
        
        //create new playlist
        $sql = "INSERT INTO playlists (notendur_id, name) VALUES (:uid, :playlistName)";
        $STH = $DBH->prepare($sql);
        $STH->execute(
            array(
                ':uid'=>$uid,
                ':playlistName'=>$playlistName
            )
        );
        
        //get new playlist id
        $sql = "SELECT id FROM playlists WHERE name = :playlistName AND notendur_id = :uid";
        $STH = $DBH->prepare($sql);
        $STH->bindParam(':playlistName', $playlistName, PDO::PARAM_STR); 
        $STH->bindParam(':uid', $uid, PDO::PARAM_INT); 
        $STH->execute();
        $row = $STH->fetchAll();
        
        //insert new songs into playlist
        foreach($playlist as $value){
            $sql = "INSERT INTO videoplaylists (playlist_id, video_id) VALUES (:playlistId, :track)";
            $STH = $DBH->prepare($sql);
            $STH->execute(
                array(
                    ':playlistId'=>$row[0]['id'],
                    ':track'=>$value
                )
            );
        }
    }
    catch(PDOException $e){
        echo "I'm sorry, Dave. I'm afraid I can't do that.";
        file_put_contents('PDOErrors.txt', $e->getMessage(), FILE_APPEND);
    }
    echo "success";
?>