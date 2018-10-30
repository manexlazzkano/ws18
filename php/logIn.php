<!DOCTYPE html>
<html>
	<head>
		<meta name="eduki-mota" content="text/html;" http-equiv="content-type" charset="utf-8">
		<title>Log in</title>
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
				<span class="right"><a href="/login">LogIn</a> </span>
				<span class="right" style="display:none;"><a href="/logout">LogOut</a> </span>
				<a id="backButton" href=javascript:history.go(-1);> <img src="../images/atrás.png" width="40" height="40"></a>
				<h2>Log in</h2>
			</header>
			
			<nav class='main' id='n1' role='navigation'>
				<span><a href='../layout.html'>Home</a></span>
				<span><a href='/quizzes'>Quizzes</a></span>
				<span><a href='showQuestions.php'>Show questions</a></span>
				<span><a href='../credits.html'>Credits</a></span>
				
			</nav>
			
			<section class="main" id="s1">
				<div>				
				<form id="formularioa" action="signUp.php" method="post" enctype="multipart/form-data">
					Eposta (*): <input type="text" class="input" name="eposta" size="50"/> <br><br>
					Pasahitza (*): <input type="password" class="input" name="pasahitza" size="50"/> <br><br>
					
					<input type="submit" name="erregistratu" value="   Saioa hasi   "/>
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
		$pasahitza = $_POST['pasahitza'];
		$pasahitzaErrepikatu = $_POST['pasahitzaErrepikatu'];
		
		include("dbConfig.php");
			$linki= mysqli_connect($zerbitzaria,$erabiltzailea,$gakoa,$db);
			
			if(!$linki) echo '<script> alert("Konexio errorea"); </script>';
			else {
				$linki->query("INSERT INTO users(eposta, deitura, pasahitza, argazkia) values ('$eposta', '$deitura', '$pasahitza', '$argazkia')");
				
				$linki = 0;
				echo '<script> alert("Erregistratu zara"); </script>';
			}
		
		$erroreak = "";
		if (!preg_match("/^[a-zA-Z]{3,}[0-9]{3}@ikasle\.ehu\.eus$/", $eposta)) $erroreak = $erroreak . "(*) Eposta okerra\\n";
		if (!preg_match("/^[A-Z][a-z]+\s[A-Z][a-z]+(\s[A-Z][a-z]+)?$/", $deitura)) $erroreak = $erroreak . "(*) Deitura zehaztu gabe dago\\n";
		
		if (empty($pasahitza)) $erroreak = $erroreak . "(*) Pasahitza zehaztu gabe dago\\n";
		else if (strlen($pasahitza) < 8) $erroreak = $erroreak . "(*) Pasahitza motzegia da, 8 ko luzera ez du gainditzen\\n";
		
		if (empty($pasahitzaErrepikatu)) $erroreak = $erroreak . "(*) Pasahitza errepikatu mesedez\\n";
		else if ($pasahitza != $pasahitzaErrepikatu) $erroreak = $erroreak . "(*) Pasahitza eta errepikatutako pasahitza ez datoz bat\\n";
		
		if (!empty($erroreak)) echo '<script> alert("'.$erroreak.'"); </script>';
		else {
			
			
		}
	}
?>