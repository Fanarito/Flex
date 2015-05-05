<?php
    try{
        $user = "USERNAME";
        $pass = "PASSWORD";
        $DBH = new PDO('mysql:host=localhost;dbname=flex', $user, $pass);
    }
    catch(PDOException $e){
        echo 'Error: ' . $e->GetMessage();
    }
?>