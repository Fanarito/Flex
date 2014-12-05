<?php
    try{
        $user = "gru";
        $pass = "scribblefusionhedonismpothead";

        $DBH = new PDO('pgsql:dbname=gru;host=localhost;port=5432;user=' .$user .';password=' . $pass);
    }
    catch(PDOException $e){
        //echo 'Error: ' . $e->GetMessage();
    }
?>