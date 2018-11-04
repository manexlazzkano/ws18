<?php

if (!empty($_GET['logged'])) {
	echo '<script> $(".logeatuGabeak").hide(); </script>';
	
	include("dbConfig.php");
	$linki= mysqli_connect($zerbitzaria,$erabiltzailea,$gakoa,$db);
	
	if(!$linki) echo '<script> alert("Konexio errorea"); </script>';
	else {
		
		$id = $_GET['logged'];
		$data = $linki->query("SELECT * FROM users WHERE ID='".$id."'");		
		if($data->num_rows != 0) {		
			$erabiltzailea = $data->fetch_assoc();
			
			echo '<script> $("#eposta").val("'.$erabiltzailea["eposta"].'") </script>';
			if (!empty($erabiltzailea['argazkia'])) {
				$deitura = $erabiltzailea['deitura'];
				$argazkia = "<img id='argazkia' border='1' width='50' height='50' src='data:image/*;base64,".base64_encode($erabiltzailea['argazkia'])."'>";
				echo '<script> $("#deitura").text("'.$deitura.'") </script>';
				echo '<script> $("#logInfo").append("'.$argazkia.'") </script>';
				
			}
			else {
				$deitura = $erabiltzailea['deitura'];
				echo '<script> $("#deitura").text("'.$deitura.'") </script>';
			}
		}
	}
}
else
	echo '<script> $(".logeatuak").hide(); </script>';

?>