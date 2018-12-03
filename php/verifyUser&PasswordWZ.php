<?php
	/*** SOAP ***/
	require_once('../lib/nusoap.php');
	require_once('../lib/class.wsdlcache.php');
	
	$soapclient = new nusoap_client('http://ehusw.es/rosa/webZerbitzuak/egiaztatuMatrikula.php?wsdl', true);					
	$matrikulaturik = $soapclient->call('egiaztatuE', array('x'=>$eposta));
	
	$soapclient2 = new nusoap_client('http://localhost/ws18/wz/egiaztatuPasahitza.php?wsdl', true);
	$pasahitzaBaliozkoa = $soapclient2->call('baliozkatu', array('x'=>$pasahitza, 'y'=>1010));
	
	$erroreak = "";
	
	if($matrikulaturik == "BAI" && $pasahitzaBaliozkoa == "BALIOZKOA") {
		$aukerak = [
			'cost' => 12,
			'salt' => random_bytes(22),
		];
		$hashedPassword = password_hash($pasahitza, PASSWORD_BCRYPT, $aukerak);
		
		$egoera = "aktibo";
		$_SESSION['register'] = 1;
		$linki->query("INSERT INTO users(eposta, deitura, pasahitza, argazkia, egoera) values ('$eposta', '$deitura', '$hashedPassword', '$argazkia', '$egoera')");
		echo "<script>location.href='layout.php';</script>";
	}
	else if($matrikulaturik == "EZ") {
		$erroreak = $erroreak ."Eposta hori duen erabiltzailea ez dago WS n matrikulaturik\\n";
	}
	else if($pasahitzaBaliozkoa == "BALIOGABEA") {
		$erroreak = $erroreak ."Zure pasahitza proposamena ez da baliozkoa\\n";
	}
	else if($pasahitzaBaliozkoa == "ZERBITZURIK GABE") {
		$erroreak = $erroreak ."Une honetan pasahitzak balioztatzeko web zerbitzurik ez dago\\n";
	}

	echo '<script> alert("'.$erroreak.'"); </script>';
?>