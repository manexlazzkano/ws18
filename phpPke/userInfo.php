<?php
	if(!isset($_SESSION['sid'])) {
		echo "<script> window.location.href= javascript:history.go(-1); </script>";
		die();
	}
	
	$id = $_SESSION['id'];
	
	include("dbConfig.php");
	$linki= mysqli_connect($zerbitzaria,$erabiltzailea,$gakoa,$db);
	
	if(!$linki) echo '<script> alert("Konexio errorea"); </script>';
	else {
		
		$data = $linki->query("SELECT * FROM users WHERE ID='".$id."'");	
		if($data->num_rows != 0) {
			$erabiltzailea = $data->fetch_assoc();
			$eposta = $erabiltzailea['eposta'];
			
			$loggedEmail = "<font id='loggedEmail'>".$erabiltzailea['eposta']." &nbsp </font>";
			$argazkia = "<img id='argazkia' border='1' width='50' height='50' src='../images/avatar.jpeg'>";
			
			if (!empty($erabiltzailea['argazkia']))
				$argazkia = "<img id='argazkia' border='1' width='50' height='50' src='data:image/*;base64,".base64_encode($erabiltzailea['argazkia'])."'>";
			
			echo '<script> $("#logInfo").append("'.$loggedEmail.'") </script>';
			echo '<script> $("#logInfo").append("'.$argazkia.'") </script>';
		}
	}
?>