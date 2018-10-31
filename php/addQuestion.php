<!DOCTYPE html>
<html>
	<head>
		<title>Add question</title>
	</head>
	
	<body>
		<a id="backButton" href=javascript:history.go(-1);> <img src="../images/atrás.png" width="40" height="40"></a>
		<?php
			$eposta = trim($_POST['eposta']);
			$galdera = preg_replace('/\s\s+/', ' ', trim($_POST['galdera']));
			$erantzunZuzena = $_POST['erantzunZuzena'];
			$erantzunOkerra1 = $_POST['erantzunOkerra1'];
			$erantzunOkerra2 = $_POST['erantzunOkerra2'];
			$erantzunOkerra3 = $_POST['erantzunOkerra3'];
			$zailtasuna = $_POST['zailtasuna'];
			$arloa = $_POST['arloa'];
			$irudiTamaina = $_FILES['fitxategia']['size'];
			if($irudiTamaina > 0) {
				$irudiIzena = $_FILES['fitxategia']['name'];
				$irudia = addslashes(file_get_contents($_FILES['fitxategia']['tmp_name']));
			}

			
			$erroreak = "";
			if (!preg_match("/^[a-zA-Z]{3,}[0-9]{3}@ikasle\.ehu\.eus$/", $eposta)) $erroreak = $erroreak . "<br>(*) Eposta okerra"; 
			if (empty($galdera)) $erroreak = $erroreak . "<br>(*) Galderaren testua zehaztu gabe dago";
			else if (strlen($galdera) < 10) $erroreak = $erroreak . "<br>(*) Galderaren testua motzegia da, 10 ko luzera ez du gainditzen";
			if (empty($erantzunZuzena)) $erroreak = $erroreak . "<br>(*) Erantzun zuzena zehaztu gabe dago";
			if (empty($erantzunOkerra1)) $erroreak = $erroreak . "<br>(*) Erantzun okerra1 zehaztu gabe dago";
			if (empty($erantzunOkerra2)) $erroreak = $erroreak . "<br>(*) Erantzun okerra2 zehaztu gabe dago";
			if (empty($erantzunOkerra3)) $erroreak = $erroreak . "<br>(*) Erantzun okerra3 zehaztu gabe dago";
			if (empty($arloa)) $erroreak = $erroreak . "<br>(*) Gai-arloa zehaztu gabe dago";
			if ($irudiTamaina > 0) {
				$contains_jpg = preg_match("/\.jpg$/", $irudiIzena);
				$contains_jpeg = preg_match("/\.jpeg$/", $irudiIzena);
				$contains_png = preg_match("/\.png$/", $irudiIzena);
				$contains_JPG = preg_match("/\.JPG$/", $irudiIzena);
				$contains_JPEG = preg_match("/\.JPEG$/", $irudiIzena);
				$contains_PNG = preg_match("/\.PNG$/", $irudiIzena);
			
				if (!$contains_jpg && !$contains_jpeg && !$contains_png && !$contains_JPG && !$contains_JPEG && !$contains_PNG)
					$erroreak = $erroreak . "<br>(hautazkoa) Irudiaren formatua okerra, irudiak '.jpg', '.jpeg', '.png', '.JPG', '.JPEG' edo '.PNG' luzapena eduki behar du";
			}

			if (!empty($erroreak)) echo $erroreak;
			else {				
				include("dbConfig.php");
				$linki= mysqli_connect($zerbitzaria,$erabiltzailea,$gakoa,$db);				
				if(!$linki) echo "<br>Konexio errorea";
				else {
					$linki->query("INSERT INTO questions(eposta, galderaTestua, erantzunZuzena, erantzunOkerra1, erantzunOkerra2, erantzunOkerra3, zailtasuna, arloa, irudia) 
					values ('$eposta', '$galdera', '$erantzunZuzena', '$erantzunOkerra1', '$erantzunOkerra2', '$erantzunOkerra3', '$zailtasuna', '$arloa', '$irudia')");
					
					$linki = 0;
					echo "<br>Zure galdera datu basera gehitu da<br>";
					echo "<a href='showQuestions.php'>Ikusi galderen zerrenda</a>";
				}
			}
		?>
	</body>
</html>