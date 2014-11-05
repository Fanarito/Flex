<?php
    echo "dicks";
    session_start();
    require("db.php");

    if(isset($_POST['username']) && isset($_POST['password']))
    {
        $username = $_POST['username'];
        $password = $_POST['password'];
        $sql= "SELECT id FROM notendur WHERE notandanafn=':username' AND password=':password'";
        $STH = $conn->prepare($sql);
        $STH->setFetchMode(PDO::FETCH_ASSOC);
        $STH->bindParam(':username', $username);
        $STH->bindParam(':password', $password);
        $STH->execute();
        $count = $STH->rowCount();
        $row = $STH->fetch();
        echo $sql;
        if($count==1)
        {
            $_SESSION['login_user']=$row['id'];
            echo $row['id'];
        }
    }
?>