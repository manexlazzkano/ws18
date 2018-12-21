<?php
	session_start();
	if(!isset($_SESSION['sid'])) {
		echo "<script> window.location.href='layout.php'; </script>";
		die();
	}
		
	$goitizena = preg_replace('/\s\s+/', ' ', trim($_POST['goitizena']));
		
	include("dbConfig.php");
	$linki= mysqli_connect($zerbitzaria,$erabiltzailea,$gakoa,$db);				

	$players = simplexml_load_file("../xml/players.xml");
	$players->addChild('player', $goitizena);
	$players->asXML("../xml/players.xml");
	
?>