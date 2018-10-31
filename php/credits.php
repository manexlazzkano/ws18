<!DOCTYPE html>
<html>
  <head>
    <meta name="tipo_contenido" content="text/html;" http-equiv="content-type" charset="utf-8">
	<title>Credits</title>
    <link rel='stylesheet' type='text/css' href='../styles/style.css' />
	<link rel='stylesheet' 
		   type='text/css' 
		   media='only screen and (min-width: 530px) and (min-device-width: 481px)'
		   href='../styles/wide.css' />
	<link rel='stylesheet' 
		   type='text/css' 
		   media='only screen and (max-width: 480px)'
		   href='styles/smartphone.css' />
	<script src="../js/jquery-3.2.1.js"></script>
  </head>
  <body>
  <div id='page-wrap'>
	<header class='main' id='h1'>
		<span class='logeatuGabeak'><a href="logIn.php">LogIn</a> </span>
		<span class='logeatuGabeak'><a href="signUp.php">SignUp</a> </span>
		<span class='logeatuak'><a href="layout.php">LogOut</a> </span>
		<a id="backButton" href=javascript:history.go(-1);> <img src="../images/atrás.png" width="40" height="40"></a>
		<div id="logInfo">
			<p id='deitura'></p>
		</div>
		<h2>Credits</h2>
    </header>
	<nav class='main' id='n1' role='navigation'>
		<span><a href='<?php if (!empty($_GET['logged'])) {$id = $_GET['logged']; echo "layout.php?logged=$id";} else {echo "layout.php";} ?>'>Home</a></span>
		<span><a href='<?php if (!empty($_GET['logged'])) {$id = $_GET['logged']; echo "layout.php?logged=$id";} else {echo "layout.php";} ?>'>Quizzes</a></span>
		<span class='logeatuak'><a href='<?php if (!empty($_GET['logged'])) {$id = $_GET['logged']; echo "addQuestion.php?logged=$id";} ?>'>Add question</a></span>
		<span class='logeatuak'><a href='<?php if (!empty($_GET['logged'])) {$id = $_GET['logged']; echo "showQuestions.php?logged=$id";} ?>'>Show questions</a></span>
	</nav>
    <section class="main" id="s1">
		<div id="Ikaslea1">
			<h2>Ikaslea1</h2> </br>
			<strong>Izen-abizenak:</strong> Manex Lazkano </br>
			<strong>Espezielitatea:</strong> Konputazioa </br>
			<strong>Bizilekua:</strong> Albiztur </br>
			<strong>Argazkia:</strong> </br>
			<img class="irudiak" src="../images/ikasle1.jpg" width="175" height="175">
		</div>
		
		<div id="Ikaslea1">
			<h2>Ikaslea2</h2> </br>
			<strong>Izen-abizenak:</strong> Mikel Oiarbide </br>
			<strong>Espezielitatea:</strong> Konputazioa </br>
			<strong>Bizilekua:</strong> Alegia </br>
			<strong>Argazkia:</strong> </br>
			<img class="irudiak" src="../images/ikasle2.jpg" width="175" height="175">
		</div>
    </section>
	<footer class='main' id='f1'>
		 <a href='https://github.com/manexlazzkano/ws18'>Link GITHUB</a>
	</footer>
  </div>
</body>
</html>

<?php
	if (!empty($_GET['logged'])) {
		echo '<script> $(".logeatuGabeak").hide(); </script>';
		
		include("dbConfig.php");
		$linki= mysqli_connect($zerbitzaria,$erabiltzailea,$gakoa,$db);
		
		if(!$linki) echo '<script> alert("Konexio errorea"); </script>';
		else {
			
			$id = $_GET['logged'];
			$data = $linki->query("SELECT * FROM users WHERE ID='".$id."'");		
			if($data->num_rows != 0) {		
			
				$erabiltzailea = $data->fetch_assoc();
				if (!empty($erabiltzailea['argazkia'])) {
					$deitura = $erabiltzailea['deitura'];
					$argazkia = "<img id='argazkia' border='1' width='50' height='50' src='data:image/*;base64,".base64_encode($erabiltzailea['argazkia'])."'>";
					echo '<script> $("#deitura").text("'.$deitura.'") </script>';
					echo '<script> $("#logInfo").append("'.$argazkia.'") </script>';
					
				}
				else {
					$deitura = $erabiltzailea['deitura'];
					echo '<script> $("#deitura").text("'.$deitura.'") </script>';
				}
			}
		}
	}
	else
		echo '<script> $(".logeatuak").hide(); </script>';
?>