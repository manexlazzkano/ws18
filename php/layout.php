<!DOCTYPE html>
<html>
  <head>
    <meta name="tipo_contenido" content="text/html;" http-equiv="content-type" charset="utf-8">
	<title>Quizzes</title>
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
	
  </head>
  <body>
  <div id='page-wrap'>
	<header class='main' id='h1'>
		<span class='logeatuGabeak'><a href="logIn.php">LogIn</a> </span>
		<span class='logeatuGabeak'><a href="signUp.php">SignUp</a> </span>
		<span class='logeatuak'><a href="layout.php">LogOut</a> </span>
		<div id="logInfo">
			<p id='deitura'></p>
		</div>
		<h2>Quiz: crazy questions</h2>
    </header>
	<nav class='main' id='n1' role='navigation'>
		<span><a href='<?php if (!empty($_GET['logged'])) {$id = $_GET['logged']; echo "layout.php?logged=$id";} else {echo "layout.php";} ?>'>Home</a></span>
		<span><a href='<?php if (!empty($_GET['logged'])) {$id = $_GET['logged']; echo "layout.php?logged=$id";} else {echo "layout.php";} ?>'>Quizzes</a></span>
		<span class='logeatuak'><a href='<?php if (!empty($_GET['logged'])) {$id = $_GET['logged']; echo "addQuestion.php?logged=$id";} ?>'>Add question</a></span>
		<span class='logeatuak'><a href='<?php if (!empty($_GET['logged'])) {$id = $_GET['logged']; echo "showQuestions.php?logged=$id";} ?>'>Show questions</a></span>
		<span><a href='<?php if (!empty($_GET['logged'])) {$id = $_GET['logged']; echo "credits.php?logged=$id";} else {echo "credits.php";} ?>'>Credits</a></span>
	</nav>
    <section class="main" id="s1">
		<div>
		Quizzes and credits will be displayed in this spot in future laboratories ...
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