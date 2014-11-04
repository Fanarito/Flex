<?php
    session_start();
    require("db.php");

    $count = 0;
    $row;

    if(isset($_POST['username']) && isset($_POST['password']))
    {
        $username = $_POST['user'];
        $password = $_POST['pass'];
        $sql= "SELECT id FROM user WHERE notandanafn=:username AND password=:password";
        $STH = $conn->prepare($sql);
        $STH->setFetchMode(PDO::FETCH_ASSOC);
        $STH->bindParam(':username', $username);
        $STH->bindParam(':password', $password);
        $STH->execute();
        $count = $STH->rowCount();
        while($thing = $STH->fetch()) {
            $row = $thing;
        }
    }

    if($count==1)
    {
        $_SESSION['login_user']=$row['id'];
    }
?>
