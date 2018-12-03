<?php
	$eragiketa = $_POST['eragiketa'];
	$userId = $_POST['userId'];
	
	include("dbConfig.php");
	$linki= mysqli_connect($zerbitzaria,$erabiltzailea,$gakoa,$db);
	
	if ($eragiketa == "aktibatu") $linki->query("UPDATE users SET egoera = 'aktibo' WHERE ID = $userId");
	else if ($eragiketa == "blokeatu") $linki->query("UPDATE users SET egoera = 'blokeatuta' WHERE ID = $userId");
	else if ($eragiketa == "ezabatu") $linki->query("DELETE FROM users WHERE ID = $userId");
	
	else if ($eragiketa == "aktibatuAukeratuak") {
		$userIDs = $_POST['userId'];
		for($i=0; $i < count($userIDs); $i++) {
			$userId = $userIDs[$i];
			$linki->query("UPDATE users SET egoera = 'aktibo' WHERE ID = $userId");
		}
	}
	else if ($eragiketa == "blokeatuAukeratuak") {
		$userIDs = $_POST['userId'];
		for($i=0; $i < count($userIDs); $i++) {
			$userId = $userIDs[$i];
			$linki->query("UPDATE users SET egoera = 'blokeatuta' WHERE ID = $userId");
		}
	}
	else if ($eragiketa == "ezabatuAukeratuak") {
		$userIDs = $_POST['userId'];
		for($i=0; $i < count($userIDs); $i++) {
			$userId = $userIDs[$i];
			$linki->query("DELETE FROM users WHERE ID = $userId");
		}
	}
?>