<?php
    error_reporting(E_ALL); ini_set( 'display_errors', 1);
    require "../../db.php";
    $fileName = $_FILES['files']['name'];
    $fileSize = $_FILES['files']['size'];
    session_start();
    $userId = $_SESSION['login_user'];
    session_write_close();

    try{
        $sql = "SELECT username FROM user WHERE iduser = :iduser";
        $STH = $DBH->prepare($sql);
        $STH->setFetchMode(PDO::FETCH_ASSOC);
        $STH->bindParam(':iduser', $userId, PDO::PARAM_INT);
        $STH->execute();
        $username = $STH->fetch();
    } catch(PDOException $e){
        echo 'Error: ' . $e->GetMessage();
    }

    for($i = 0; $i < count($fileName); $i++){
        require "userdata.php";
        
        $target_dir = "../" . $user['path'] . "/";
        $target_file = $target_dir . basename($fileName[$i]);
        $fileType = pathinfo($target_file,PATHINFO_EXTENSION);
        $uploadOk = 1;
        
        // Check if file already exists
        if (file_exists($target_file)) {
            echo "Sorry, file already exists.";
            $uploadOk = 0;
        }
        
        // Check file size 
        if ($_FILES["files"]["size"][$i] > 50000000) {
            echo "Sorry, your file is too large.<br>";
            $uploadOk = 0;
        } 
        
        // Allow certain file formats
        if($fileType == "php" || $fileType == "html" || $fileType == "js" || $fileType == "css") {
            echo "Sorry invalid file type<br>";
            $uploadOk = 0;
        } 
        
        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            echo "Sorry, your file was not uploaded.";
        // if everything is ok, try to upload file
        } else {
            if (move_uploaded_file($_FILES["files"]["tmp_name"][$i], $target_file)) {
                echo "The file ". basename( $_FILES["files"]["name"][$i]). " has been uploaded.";
                
                echo $fileName[$i] . "<br>";
                $path = "users/" . $username['username'] . "/" . $fileName[$i];
                echo $path . "<br>";

                $sql = "INSERT INTO files (`iduser`, `path`, `name`, `size`) VALUES (:userID,:path,:name,:size)";
                $STH = $DBH->prepare($sql);
                $STH->setFetchMode(PDO::FETCH_ASSOC);
                $STH->bindParam(':userID', $userId, PDO::PARAM_INT);
                $STH->bindParam(':path', $path, PDO::PARAM_STR);
                $STH->bindParam(':name', $fileName[$i], PDO::PARAM_STR);
                $STH->bindParam(':size', $fileSize[$i], PDO::PARAM_STR);
                $STH->execute();
                echo "INSERT success <br>";
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        }
    }
?>