<?php
	// //SOAP
	require_once('../lib/nusoap.php');
	require_once('../lib/class.wsdlcache.php');
	
	$ns = "egiaztatuPasahitza.php?wsdl";
	$server = new soap_server;
	$server->configureWSDL('baliozkatu', $ns);
	$server->wsdl->schemaTargetNamespace = $ns;
	
	$server->register('baliozkatu', array('x'=>'xsd:string', 'y'=>'xsd:int'), array('z'=>'xsd:string'), $ns);
	
	function baliozkatu($x, $y) {
		if ($y != 1010) return "ZERBITZURIK GABE";
		else {
			$fp = fopen("toppasswords.txt", "r");
			while ($lerroa = fscanf($fp, "%s")){
				if ($x == $lerroa[0]) return "BALIOGABEA";
			}
			fclose($fp);
			
			return "BALIOZKOA";
		}
	}
	
	if (!isset($HTTP_RAW_POST_DATA)){
		$HTTP_RAW_POST_DATA = file_get_contents('php://input');
		
	}
	$server->service($HTTP_RAW_POST_DATA);
	
?>