<?php
	header("Control-cache: no-store, no-cache, must-revalidate");

	if (strpos($_SERVER['REQUEST_URI'], "logged=".$id."&removeUser=1")) {

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
		
		echo "<script> window.location.href='layout.php'; </script>";
		die();
	}

?>