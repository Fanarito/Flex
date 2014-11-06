<?php
	include 'scrypt.php';
	//echo 'sest'."\n";

	$pass = "asdf";
	$salt = Password::generateSalt();
	$hashPass = Password::hash($pass,$salt);
	//echo $hashPass;
	
	if(Password::check($pass, $hashPass)){
		echo $hashPass;
	}
?>