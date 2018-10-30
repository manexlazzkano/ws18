<!DOCTYPE html>
<html>
	<head>
		<title>Add question</title>
	</head>
	
	<body>
		<a id="backButton" href=javascript:history.go(-1);> <img src="../images/atrás.png" width="40" height="40"></a>
		<?php
			$eposta = $_POST['eposta'];
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
			if (!preg_match("/^[a-zA-Z]{3,}[0-9]{3}@ikasle\.ehu\.eus$/", $eposta)) $erroreak = $erroreak . "<br>(*) Eposta okerra<br>"; 
			if (empty($galdera)) $erroreak = $erroreak . "(*) Galderaren testua zehaztu gabe dago<br>";
			else if (strlen($galdera) < 10) $erroreak = $erroreak . "(*) Galderaren testua motzegia da, 10 ko luzera ez du gainditzen<br>";
			if (empty($erantzunZuzena)) $erroreak = $erroreak . "(*) Erantzun zuzena zehaztu gabe dago<br>";
			if (empty($erantzunOkerra1)) $erroreak = $erroreak . "(*) Erantzun okerra1 zehaztu gabe dago<br>";
			if (empty($erantzunOkerra2)) $erroreak = $erroreak . "(*) Erantzun okerra2 zehaztu gabe dago<br>";
			if (empty($erantzunOkerra3)) $erroreak = $erroreak . "(*) Erantzun okerra3 zehaztu gabe dago<br>";
			if (empty($arloa)) $erroreak = $erroreak . "(*) Gai-arloa zehaztu gabe dago<br>";
			if ($irudiTamaina > 0) {
				$contains_jpg = preg_match("/\.jpg$/", $irudiIzena);
				$contains_jpeg = preg_match("/\.jpeg$/", $irudiIzena);
				$contains_png = preg_match("/\.png$/", $irudiIzena);
				$contains_bmp = preg_match("/\.bmp$/", $irudiIzena);
				$contains_gif = preg_match("/\.gif$/", $irudiIzena);
			
				if (!$contains_jpg && !$contains_jpeg && !$contains_png && !$contains_bmp && !$contains_gif)
					$erroreak = $erroreak . "(hautazkoa) Irudiaren formatua okerra, irudiak '.jpg', '.jpeg', '.png', '.bmp', edo '.gif' luzapena eduki behar du<br>";
			}

			if (!empty($erroreak)) echo $erroreak;
			else {				
				include("dbConfig.php");
				$linki= mysqli_connect($zerbitzaria,$erabiltzailea,$gakoa,$db);				
				if(!$linki) echo "Konexio errorea</br>";
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