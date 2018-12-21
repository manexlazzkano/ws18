<?php
	session_start();
	if(!isset($_SESSION['sid'])) {
		echo "<script> window.location.href='layout.php'; </script>";
		die();
	}
?>

<!DOCTYPE html>
<html>
  <head>
    <meta name="tipo_contenido" content="text/html;" http-equiv="content-type" charset="utf-8">
	<title>Get specific question</title>
    <link rel='stylesheet' type='text/css' href='../styles/style.css' />
	<link rel='stylesheet' 
		   type='text/css' 
		   media='only screen and (min-width: 530px) and (min-device-width: 481px)'
		   href='../styles/wide.css' />
	<link rel='stylesheet' 
		   type='text/css' 
		   media='only screen and (max-width: 480px)'
		   href='../styles/smartphone.css' />
	<style> th, td {text-align: center;} </style>
	<script src="../js/jquery-3.2.1.js"></script>
	
  </head>
  <body>
  <div id='page-wrap'>
	<header class='main' id='h1'>
		<span class='logeatuak'><a href="logOut.php">LogOut</a> </span>
		<div id="logInfo"></div>
		<h2>Get specific question</h2>
    </header>
	<nav class='main' id='n1' role='navigation'>
		<span><a href='layout.php'>Home</a></span>
		<span><a href='credits.php'>Credits</a></span>
		<span><a href='layout.php'>Quizzes</a></span>
		<br><br>
		<span><a href='showQuestions.php'>Show questions</a></span>
		<span><a href='showXMLQuestions.php'>Questions in XML</a></span>
		<br><br>
		<span><a href='handlingQuizes.php'>Handling quizzes</a></span>
	</nav>
    <section class="main" id="s1">
		<div>
		<form action='getQuestionWZ.php' method="post" >
			Galderaren identifikadorea (ID): &nbsp <input type="text" id="ident" name="ident" size="5"/> </br></br>
			<input type="submit" value="   Erakutsi galdera   "/>
		</form>
		
			<?php
				if(isset($_POST['ident'])) {
					
					include("dbConfig.php");
					
					/*** SOAP ***/
					require_once('../lib/nusoap.php');
					require_once('../lib/class.wsdlcache.php');

					$idGaldera = $_POST['ident'];
					
					$soapclient = new nusoap_client('http://'.$soaperakoUrlZatia.'/ws18/wz/getQuestion.php?wsdl', true);
					$galdera = $soapclient->call('galderaLortu', array('idGaldera'=>$idGaldera));
					
					/****************/
			
					echo "<br>Hona hemen ID = " .$idGaldera ." duen galderaren datuak:<br><br>";
				
					echo '<table border="1">';
						echo '<tr>';
							echo '<th> Egilea </th>';
							echo '<th> Enuntziatua </th>';
							echo '<th> Erantzun zuzena </th>';
						echo '</tr>';
				
						echo '<tr>';
							echo '<td>' .$galdera['egilea']. '</td>';
							echo '<td>' .$galdera['galderaTestua']. '</td>';
							echo '<td>' .$galdera['erantzunZuzena']. '</td>';				
						echo '</tr>';
					echo '</table>';
				}
			?>
		</div>
    </section>
	<footer class='main' id='f1'>
		 <a href='https://github.com'>Link GITHUB</a>
	</footer>
  </div>
</body>
</html>

<?php include("userInfo.php"); ?>