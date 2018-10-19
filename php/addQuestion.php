<!DOCTYPE html>
<html>
	<head>
		<title>Show questions</title>
	</head>
	
	<body>
		<a id="backButton" href=javascript:history.go(-1);> <img src="../images/atrás.png" width="40" height="40"></a>
		<?php
			include("dbConfig.php");
			$linki= mysqli_connect($zerbitzaria,$erabiltzailea,$gakoa,$db);
			
			if(!$linki) echo "Konexio errorea</br>";
			else {
				$galderenTaula = "questions";
				
				$eposta = $_POST['eposta'];
				$galdera = $_POST['galdera'];
				$erantzunZuzena = $_POST['erantzunZuzena'];
				$erantzunOkerra1 = $_POST['erantzunOkerra1'];
				$erantzunOkerra2 = $_POST['erantzunOkerra2'];
				$erantzunOkerra3 = $_POST['erantzunOkerra3'];
				$zailtasuna = $_POST['zailtasuna'];
				$arloa = $_POST['arloa'];
				
				$linki->query("INSERT INTO $galderenTaula(eposta, galderaTestua, erantzunZuzena, erantzunOkerra1, erantzunOkerra2, erantzunOkerra3, zailtasuna, arloa) 
				values ('$eposta', '$galdera', '$erantzunZuzena', '$erantzunOkerra1', '$erantzunOkerra2', '$erantzunOkerra3', '$zailtasuna', '$arloa')");
				
				$linki = 0;
				echo "Zure galdera datu basera gehitu da</br>";
			}
		?>
		<a href='showQuestions.php'>Ikusi galderen zerrenda</a>
	</body>
</html>