<?php
	if(!isset($_SESSION['sid'])) {
		echo "<script> window.location.href='layout.php'; </script>";
		die();
	}

	$id = $erabiltzailea['ID'];
	$_SESSION['id'] = $id;

	if ($eposta == 'admin000@ehu.eus') $_SESSION['rola'] = "admin";
	else $_SESSION['rola'] = "ikaslea";
	
	/*xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx*/
	/*xxx  Logeatu den erabiltzailea counter.xml -an gehitu beste nonbait logeatu gabe bazegoen   xxx*/
	/*xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx*/
	/*xxx*/																						/*xxx*/
	/*xxx*/		$aurkitua = false;																/*xxx*/
	/*xxx*/		$loggedUsers = simplexml_load_file("../xml/counter.xml");						/*xxx*/
	/*xxx*/		$numberOfUsers = count($loggedUsers->loggedUser);								/*xxx*/
	/*xxx*/																						/*xxx*/
	/*xxx*/		for ($i=0; $i < $numberOfUsers && !$aurkitua; $i++) {							/*xxx*/
	/*xxx*/			if($loggedUsers->loggedUser[$i] == $eposta) {								/*xxx*/
	/*xxx*/				$aurkitua = true;														/*xxx*/
	/*xxx*/				break;																	/*xxx*/
	/*xxx*/			}																			/*xxx*/
	/*xxx*/			$i++;																		/*xxx*/
	/*xxx*/		}																				/*xxx*/
	/*xxx*/																						/*xxx*/
	/*xxx*/		if(!$aurkitua) {																/*xxx*/
	/*xxx*/			$newLoggedUser = $loggedUsers->addChild('loggedUser', $eposta);				/*xxx*/
	/*xxx*/			$newLoggedUser->addAttribute('id', $id);									/*xxx*/
	/*xxx*/			$loggedUsers->asXML("../xml/counter.xml");									/*xxx*/
	/*xxx*/		}																				/*xxx*/
	/*xxx*/																						/*xxx*/
	/*xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx*/
	/*xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx*/
	
	
	if ($_SESSION['rola'] == "admin") {
		echo "<script> window.location.href='handlingAccounts.php'; </script>";
	}
	else if ($_SESSION['rola'] == "ikaslea") {
		echo "<script> window.location.href='handlingQuizes.php'; </script>";
	}
?>