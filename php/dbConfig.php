<?php

	$lokal=0; // hodeian 1, lokalean gauedenean 0


	if ($lokal) {
	   $zerbitzaria="localhost:1234";
	   $erabiltzailea="id7197603_manexlazkano";
	   $gakoa="";  // GitHub-en eremu hau EZABATU
	   $db="id7197603_quiz";        // hodeiko db izena: hodeiko aurrizkia + zuek adierazitako db izena atzizki moduan

	} else {
	   $zerbitzaria="localhost";
	   $erabiltzailea="root";   // lokalean erabiltzailea root izan ohi da
	   $gakoa="";               // eta ez da pasahitzarik jartzen
	   $db="quiz";
	}

?>