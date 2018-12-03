<?php
	header("Control-cache: no-store, no-cache, must-revalidate");
	
	session_start();
	$id = $_SESSION['id'];
	
	$xml = simplexml_load_file("../xml/counter.xml");
	$loggedUserList = $xml->loggedUser;
	
	foreach ($loggedUserList as $loggedUser){
		
		if ($loggedUser[0]->attributes()->id == $id){		
			$loggedUserDom = dom_import_simplexml($loggedUser[0]);
			$loggedUserDom->parentNode->removeChild($loggedUserDom);
			break;
		}
	}	
	$xml->asXML("../xml/counter.xml");

	session_unset();
	session_destroy();	
	
	echo "<script> window.location.replace('layout.php'); </script>";
	
?>