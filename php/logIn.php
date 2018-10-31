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
				<a id="backButton" href=javascript:history.go(-1);> <img src="../images/atrás.png" width="40" height="40"></a>
				<h2>Log in</h2>
			</header>
			
			<nav class='main' id='n1' role='navigation'>
				<span><a href='../layout.html'>Home</a></span>
				<span><a href='/quizzes'>Quizzes</a></span>
				<span><a href='../credits.html'>Credits</a></span>
				
			</nav>
			
			<section class="main" id="s1">
				<div>				
				<form action="logIn.php" method="post" enctype="multipart/form-data">
					Eposta (*): <input type="text" class="input" name="eposta" size="50"/> <br><br>
					Pasahitza (*): <input type="password" class="input" name="pasahitza" size="50"/> <br><br>
					
					<input type="submit" name="saioaHasi" value="   Saioa hasi   "/>
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
		
		include("dbConfig.php");
		$linki= mysqli_connect($zerbitzaria,$erabiltzailea,$gakoa,$db);
		
		if(!$linki) echo '<script> alert("Konexio errorea"); </script>';
		else {
			
			$data = $linki->query("SELECT eposta, pasahitza FROM users WHERE eposta='".$eposta."'");
			
			if($data->num_rows != 0) {		
				$erabiltzailea = $data->fetch_assoc();
				if($pasahitza != $erabiltzailea['pasahitza']) echo '<script> alert("Pasahitza okerra"); </script>';
				else {
					echo '<script> alert("Logeatu zara"); </script>';
					$deitura = $erabiltzailea['deitura'];
					$deitura = $erabiltzailea['deitura'];
					header("location: ../layout.html?logged=true");
				}
			}
			else echo '<script> alert("Erabiltzaile hori ez da existitzen"); </script>';
		}
	}
?>