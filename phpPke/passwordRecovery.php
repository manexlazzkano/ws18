<?php
	session_start();
	if(!isset($_SESSION['sid'])) {
		echo "<script> window.location.href='layout.php'; </script>";
		die();
	}
	
	$eposta = $_POST['eposta'];
	
	$bytes = openssl_random_pseudo_bytes(6, $crypto_strong);
	$pasahitza = bin2hex($bytes);	//Pasahitza berria
	
	include("verifyUserAndPassword");
	
	while($pasahitzaBaliozkoa != "BALIOZKOA") {
		$bytes = openssl_random_pseudo_bytes(6, $crypto_strong);
		$pasahitza = bin2hex($bytes);	//Pasahitza berria
		
		include("verifyUserAndPassword");
	}
	
	$aukerak = ['cost' => 12, 'salt' => random_bytes(22),];
	$hashedPassword = password_hash($pasahitza, PASSWORD_BCRYPT, $aukerak);
	
	include("dbConfig.php");
	$linki->query("UPDATE users SET pasahitza = $hashedPassword WHERE eposta = $eposta");

	$to = $eposta;
	$subject = "Reset password";
	$message = "Hona hemen zure pasahitza berria Quizz jokorako: ".$pasahitza;
	$headers = "From: admin000@ehu.eus";

	mail($to, $subject, $message, $headers);
	
?>