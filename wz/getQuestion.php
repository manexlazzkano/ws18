<?php
	require_once('../lib/nusoap.php');
	require_once('../lib/class.wsdlcache.php');
	
	$ns = "getQuestion.php?wsdl";
	$server = new soap_server;
	$server->configureWSDL('galderaLortu', $ns);
	$server->wsdl->schemaTargetNamespace = $ns;
	
	$server->wsdl->addComplexType('galdera', 'complexType', 'struct', 'all', '',
	array('egilea'=>array('name'=>'egilea', 'type'=>'xsd:string'),
		  'galderaTestua'=>array('name'=>'galderaTestua', 'type'=>'xsd:string'),
		  'erantzunZuzena'=>array('name'=>'erantzunZuzena', 'type'=>'xsd:string')));
	
	$server->register('galderaLortu',
		array('idGaldera'=>'xsd:int'),
		array('return'=>'tns:galdera'),
		'getQuestion.php?wsdl',
		'getQuestion.php?wsdl#galdera',
		'rpc',
		'encoded',
		'Zerbitzu honek galderak itzultzen ditu');
		
	function galderaLortu($idGaldera) {
		
		include("../php/dbConfig.php");

		$linki= mysqli_connect($zerbitzaria,$erabiltzailea,$gakoa,$db);	
		$galderenTaula = $linki->query("SELECT * FROM questions WHERE ID='".$idGaldera."'");

		if($galderenTaula->num_rows == 0) {
			return array('egilea'=>null, 'galderaTestua'=>null, 'erantzunZuzena'=>null);
		}
		
		$galdera = $galderenTaula->fetch_assoc();
		
		$egilea = $galdera['eposta'];
		$galderaTestua = $galdera['galderaTestua'];
		$erantzunZuzena = $galdera['erantzunZuzena'];

		return array('egilea'=>$egilea, 'galderaTestua'=>$galderaTestua, 'erantzunZuzena'=>$erantzunZuzena);
	}
	
	
	if (!isset($HTTP_RAW_POST_DATA)){
		$HTTP_RAW_POST_DATA = file_get_contents('php://input');
		
	}
	$server->service($HTTP_RAW_POST_DATA);
	
?>