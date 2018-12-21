<?php
	if(!isset($_SESSION['sid']) && !isset($baimena)) {
		echo "<script> window.location.href='layout.php'; </script>";
		die();
	}

	$lokal=0; // hodeian 1, lokalean gauedenean 0


	if ($lokal) {
	   $zerbitzaria="localhost";
	   $erabiltzailea="id7197603_manexlazkano";
	   $gakoa="Sistemasweb99";  // GitHub-en eremu hau EZABATU
	   $db="id7197603_quiz";        // hodeiko db izena: hodeiko aurrizkia + zuek adierazitako db izena atzizki moduan
	   
	   $soaperakoUrlZatia="wsmlazcano011.000webhostapp.com";

	} else {
	   $zerbitzaria="localhost";
	   $erabiltzailea="root";   // lokalean erabiltzailea root izan ohi da
	   $gakoa="";               // eta ez da pasahitzarik jartzen
	   $db="quiz";
	   
	   $soaperakoUrlZatia="localhost";
	}

?>