<!DOCTYPE html>
<html>
	<head>
		<title>Add question</title>
	</head>
	
	<body>
		<a id="backButton" href=javascript:history.go(-1);> <img src="../images/atrás.png" width="40" height="40"></a>
		<?php
			include("dbConfig.php");
			$linki= mysqli_connect($zerbitzaria,$erabiltzailea,$gakoa,$db);
			
			if(!$linki) echo "Konexio errorea</br>";
			else {
				$eposta = $_POST['eposta'];
				$galdera = $_POST['galdera'];
				$erantzunZuzena = $_POST['erantzunZuzena'];
				$erantzunOkerra1 = $_POST['erantzunOkerra1'];
				$erantzunOkerra2 = $_POST['erantzunOkerra2'];
				$erantzunOkerra3 = $_POST['erantzunOkerra3'];
				$zailtasuna = $_POST['zailtasuna'];
				$arloa = $_POST['arloa'];		
				$irudia = addslashes(file_get_contents($_FILES['fitxategia']['tmp_name']));
				
				list($width, $height) = $this->getDimensions($newWidth, $newHeight, $option);
				$this->imageResized = imagecreatetruecolor($width, $height);
        imagecopyresampled($this->imageResized, $this->image, 0, 0, 0, 0, $width, $height, $this->width, $this->height);
				
				$sql = "INSERT INTO QUESTIONS (eposta, galderaTestua, erantzunZuzena, erantzunOkerra1, erantzunOkerra2, erantzunOkerra3, zailtasuna, arloa, irudia) VALUES ('$eposta', '$galdera', '$erantzunZuzena', '$erantzunOkerra1', '$erantzunOkerra2', '$erantzunOkerra3', '$zailtasuna', '$arloa', '$irudia')";
				if(mysqli_query($linki, $sql)) {
					echo "Zure galdera datu basera gehitu da</br>";
				}
				else {
					echo "Zure galdera datu basera ez da gehitu, baliteke irudia handiegia izatea</br>";
				}
				
				$linki = 0;
			}
		?>
		<a href='showQuestions.php'>Ikusi galderen zerrenda irudirik gabe</a> </br>
		<a href='showQuestionswithImages.php'>Ikusi galderen zerrenda irudiekin</a>
	</body>
</html>