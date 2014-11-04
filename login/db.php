<?php
    try{
        $user = "root";
        $pass = "";

        $conn = new PDO('mysql:host=localhost;dbname=GRU',$user,$pass);
    }
    catch(PDOException $e){
        echo 'Error: ' . $e->GetMessage();
    }
?>
