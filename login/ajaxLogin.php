<?php
    session_start();
    require("db.php");

    if(isset($_POST['user']) && isset($_POST['pass']))
    {
        $username = $_POST['user'];
        $password = $_POST['pass'];
        $sql= "SELECT id FROM user WHERE notandanafn=:username AND password=:password";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':username', $username, PDO::PARAM_STRING);
        $stmt->bindParam(':password', $password, PDO::PARAM_STRING);
        $stmt->execute();
        $count = $stmt->rowCount();
    }

    if($count==1)
    {
        $_SESSION['login_user']=$row['id']; //Storing user session value.
        echo $row['id'];
    }

    }
?>
