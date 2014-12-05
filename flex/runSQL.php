<?php
try{
    $user = $_GET['user'];
    echo "1";
    $pass = $_GET['password'];
    echo "2";

    $DBH = new PDO('pgsql:dbname=gru;host=localhost;port=5432;user=' .$user .';password=' . $pass);
    echo "3";
    
    if($DBH)
    {
        $sql = $_GET['sql'];
        echo "4";
        $STH = $DBH->prepare($sql);
        echo "5";
        $STH->execute();
        echo "6";
        print_r($STH->errorInfo());
    }
}
catch(PDOException $e){
    //echo 'Error: ' . $e->GetMessage();
}
?>