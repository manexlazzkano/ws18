<!DOCTYPE html>
<html>
	<head>
		<meta name="eduki-mota" content="text/html;" http-equiv="content-type" charset="utf-8">
		<title>Sign up</title>
		<link rel='stylesheet' type='text/css' href='../styles/style.css' />
		<link rel='stylesheet' 
			   type='text/css' 
			   media='only screen and (min-width: 530px) and (min-device-width: 481px)'
			   href='../styles/wide.css' />
		<link rel='stylesheet' 
			   type='text/css' 
			   media='only screen and (max-width: 480px)'
			   href='../styles/smartphone.css' />
		<script src="../js/jquery-3.2.1.js"></script>
		<script src="../js/addImage.js"></script>
		<script src="../js/removeImage.js"></script>
	</head>
	<body>
		<div id='page-wrap'>
			<header class='main' id='h1'>
				<span class="right"><a href="logIn.php">LogIn</a> </span>
				<a id="backButton" href=javascript:history.go(-1);> <img src="../images/atrás.png" width="40" height="40"></a>
				<h2>Sign up</h2>
			</header>
			
			<nav class='main' id='n1' role='navigation'>
				<span><a href='layout.php'>Home</a></span>
				<span><a href='layout.php'>Quizzes</a></span>
				<span><a href='credits.php'>Credits</a></span>
				
			</nav>
			
			<section class="main" id="s1">
				<div>				
				<form id="formularioa" action="signUp.php" method="post" enctype="multipart/form-data">
					Eposta (*): <input type="text" class="input" name="eposta" size="50"/> <br><br>
					Deitura (*): <input type="text" class="input" name="deitura" size="50"/> <br><br>
					Pasahitza (*): <input type="password" class="input" name="pasahitza" size="50"/> <br><br>
					Pasahitza errepikatu (*): <input type="password" class="input" name="pasahitzaErrepikatu" size="50"/> <br><br>
					Argazkia (hautazkoa): <input type="file" class="input" id="fitxategia" name="fitxategia"/> <br><br>
					<div id="divIrudi"></div>
					
					<input type="submit" name="erregistratu" value="     Erregistratu     "/>
					<input type="reset" name="garbitu" value="     Garbitu     "/>
				</form>
				</div>
				
			</section>

			<footer class='main' id='f1'>
				<a href='https://github.com/manexlazzkano/ws18'>Link GITHUB</a>
			</footer>
		</div>	
	</body>
</html>

<?php
	if (isset($_POST['eposta'])) {
		$eposta = $_POST['eposta'];				
		$deitura = $_POST['deitura'];
		$pasahitza = $_POST['pasahitza'];
		$pasahitzaErrepikatu = $_POST['pasahitzaErrepikatu'];
		
		$argazkiTamaina = $_FILES['fitxategia']['size'];
		if($argazkiTamaina > 0) {
			$argazkiIzena = $_FILES['fitxategia']['name'];
			$argazkia = addslashes(file_get_contents($_FILES['fitxategia']['tmp_name']));
		}
		
		$erroreak = "";
		if (!preg_match("/^[a-zA-Z]{3,}[0-9]{3}@ikasle\.ehu\.eus$/", $eposta)) $erroreak = $erroreak . "(*) Eposta okerra\\n";
		if (!preg_match("/^[A-Z][a-z]+\s[A-Z][a-z]+(\s[A-Z][a-z]+)?$/", $deitura)) $erroreak = $erroreak . "(*) Deitura zehaztu gabe dago\\n";
		
		if (empty($pasahitza)) $erroreak = $erroreak . "(*) Pasahitza zehaztu gabe dago\\n";
		else if (strlen($pasahitza) < 8) $erroreak = $erroreak . "(*) Pasahitza motzegia da, 8 ko luzera ez du gainditzen\\n";
		
		if (empty($pasahitzaErrepikatu)) $erroreak = $erroreak . "(*) Pasahitza errepikatu mesedez\\n";
		else if ($pasahitza != $pasahitzaErrepikatu) $erroreak = $erroreak . "(*) Pasahitza eta errepikatutako pasahitza ez datoz bat\\n";
		
		if ($argazkiTamaina > 0) {
			$contains_jpg = preg_match("/\.jpg$/", $argazkiIzena);
			$contains_jpeg = preg_match("/\.jpeg$/", $argazkiIzena);
			$contains_png = preg_match("/\.png$/", $argazkiIzena);
			$contains_bmp = preg_match("/\.bmp$/", $argazkiIzena);
			$contains_gif = preg_match("/\.gif$/", $argazkiIzena);
		
			if (!$contains_jpg && !$contains_jpeg && !$contains_png && !$contains_bmp && !$contains_gif)
				$erroreak = $erroreak . "(hautazkoa) Irudiaren formatua okerra, irudiak '.jpg', '.jpeg', '.png', '.bmp', edo '.gif' luzapena eduki behar du\\n";
		}
		
		if (!empty($erroreak)) echo '<script> alert("'.$erroreak.'"); </script>';
		else {
			
			include("dbConfig.php");
			$linki= mysqli_connect($zerbitzaria,$erabiltzailea,$gakoa,$db);
			
			if(!$linki) echo '<script> alert("Konexio errorea"); </script>';
			else {
				
				
				$data = $linki->query("SELECT eposta FROM users WHERE eposta='".$eposta."'");			
				if($data->num_rows != 0) echo '<script> alert("Eposta hori duen erabiltzailea jada erregistratuta dago"); </script>';
				else {
					$linki->query("INSERT INTO users(eposta, deitura, pasahitza, argazkia) values ('$eposta', '$deitura', '$pasahitza', '$argazkia')");
					
					$linki = 0;
					echo '<script> alert("Erregistratu zara"); </script>';
					header("location: layout.php");
				}
			}
		}
	}
?>
