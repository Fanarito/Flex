<?php
    try{
        $user = "USERNAME";
        $pass = "PASSWORDD";
        $DBH = new PDO('mysql:host=localhost;dbname=flex', $user, $pass);
    }
    catch(PDOException $e){
        echo 'Error: ' . $e->GetMessage();
    }
?>
