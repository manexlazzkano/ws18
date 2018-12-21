<?php
	session_start();
	if(isset($_SESSION['sid'])) {
		echo '<script> history.go(1); </script>';
	}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
	<title>Sign up</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
	<script src="../js/jquery-3.2.1.js"></script>
	<script src="../js/addImage.js"></script>
	<script src="../js/removeImage.js"></script>
	<script src="../js/passwordRecovery.js"></script>
	<script src="../bootstrap/jquery.min.js"></script>
	
    <link rel="icon" href="../images/quizz.png">
    <link href="../bootstrap/bootstrap.min.css" rel="stylesheet">
	<link href="../bootstrap/sticky-footer-navbar.css" rel="stylesheet">
    <link href="../bootstrap/logIn.css" rel="stylesheet">
  </head>

  <body class="text-center" style="background-color:rgb(200,200,255);">
	<nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark" style="background-color:rgb(0,0,255);">

		<a class="navbar-brand" id="backButton" style="text-decoration:none;" href=javascript:history.go(-1);>
		<img class="rounded-circle" src="../images/atras.png" width="36px" height="36px"></a>		
		<a class="navbar-brand" href="signUp.php"><strong class="rounded" style="font-size:22px; color:rgb(224,224,224);">Sign up</strong></a>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
		<span class="navbar-toggler-icon"></span></button>
		
        <div class="collapse navbar-collapse" id="navbarCollapse">
          <ul class="navbar-nav mr-auto">
            <li class="nav-item">
              <a class="nav-link" href="layout.php">Home</a>
            </li>	
			<li class="nav-item">
              <a class="nav-link" href="credits.php">Credits</a>
            </li>
		  </ul>
		  
		  <button id='login' class='btn btn btn-primary'>Log in</button>
        </div>
    </nav>
	<script> $("#signup").click(function(){window.location.href = 'logIn.php';}); </script>
	
    <form class="form-signin" id="formularioa" action="signUp.php" method="post" enctype="multipart/form-data">
	
	  <br><br><br>
	  <img src="../images/signup.png" width="100px" height="100px">	  
      <h1 class="h3 mb-3 font-weight-normal">Please sign up</h1>
	  
      <input type="email" id="inputEmail" name="eposta" class="form-control" placeholder="Email address (*)" required autofocus>
	  <input type="text" id="inputSurname" name="deitura" class="form-control" placeholder="Surnames (*)" required>
	  <input type="password" id="inputPassword" name="pasahitza" class="form-control" placeholder="Password (*)" required>
	  <input type="text" id="inputPasswordRepeat" name="pasahitzaErrepikatu" class="form-control" placeholder="Repeat the password (*)" required> <br>
	
	  <div class="rounded" style="background-color:rgb(200,255,200);">
	     <p style="text-align:left; color:rgb(96,96,96);"> &nbsp Photo (optional)</p>
	     <input type="file" id="fitxategia" class="form-control" name="fitxategia" /> <br><br>
	     <div id="divIrudi"></div>
	  </div> <br>
		
	  <button class="btn btn-lg btn-block" type="reset">Reset</button>
      <button class="btn btn-lg btn-primary btn-block" type="submit">Sign up</button> <br>
	  
    </form>
  </body>
  
    <footer class="footer">
      <div class="container" style="text-align:center;">
        <span class="text-muted">© 2018 Crazzy questions games</span><br>
		<span class="text-muted"><a href="https://github.com">Link GITHUB</a></span>
      </div>
    </footer>
  
  <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="../bootstrap/slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script>window.jQuery || document.write('<script src="../bootstrap/slim.min.js"><\/script>')</script>
    <script src="../bootstrap/popper.min.js"></script>
    <script src="../bootstrap/bootstrap.min.js"></script>
	
</html>

<?php
	if (isset($_POST['eposta'])) {
		
		$_SESSION['sid'] = rand(0,10);
		
		$eposta = trim($_POST['eposta']);				
		$deitura = $galdera = preg_replace('/\s\s+/', ' ', trim($_POST['deitura']));
		$pasahitza = $_POST['pasahitza'];
		$pasahitzaErrepikatu = $_POST['pasahitzaErrepikatu'];
		
		$argazkiTamaina = $_FILES['fitxategia']['size'];
		if($argazkiTamaina > 0) {
			$argazkiIzena = $_FILES['fitxategia']['name'];
			$argazkia = addslashes(file_get_contents($_FILES['fitxategia']['tmp_name']));
		}
		
		$erroreak = "";
		if (empty($eposta)) $erroreak = $erroreak . "(*) Eposta zehaztu gabe dago\\n";
		else if (!preg_match("/^[a-zA-Z]{3,}[0-9]{3}@ikasle\.ehu\.eus$/", $eposta)) $erroreak = $erroreak . "(*) Eposta okerra\\n";
		
		if (empty($deitura)) $erroreak = $erroreak . "(*) Deitura zehaztu gabe dago\\n";
		else if (!preg_match("/^[A-ZÁÉÍÓÚÑ][a-záéíóúñ]+\s([a-záéíóúñ]+\s)*[A-ZÁÉÍÓÚÑ][a-záéíóúñ]+(\s([a-záéíóúñ]+\s)*[A-ZÁÉÍÓÚÑ][a-záéíóúñ]+)?$/", $deitura))
			$erroreak = $erroreak . "(*) Deitura oker zehaztuta dago\\n";
		
		if (empty($pasahitza)) $erroreak = $erroreak . "(*) Pasahitza zehaztu gabe dago\\n";
		else if (strlen($pasahitza) < 8) $erroreak = $erroreak . "(*) Pasahitza motzegia da, 8 ko luzera ez du gainditzen\\n";
		
		if (empty($pasahitzaErrepikatu)) $erroreak = $erroreak . "(*) Pasahitza errepikatu mesedez\\n";
		else if ($pasahitza != $pasahitzaErrepikatu) $erroreak = $erroreak . "(*) Pasahitza eta errepikatutako pasahitza ez datoz bat\\n";
		
		if ($argazkiTamaina > 0) {
			$contains_jpg = preg_match("/\.jpg$/", $argazkiIzena);
			$contains_jpeg = preg_match("/\.jpeg$/", $argazkiIzena);
			$contains_png = preg_match("/\.png$/", $argazkiIzena);
			$contains_JPG = preg_match("/\.JPG$/", $argazkiIzena);
			$contains_JPEG = preg_match("/\.JPEG$/", $argazkiIzena);
			$contains_PNG = preg_match("/\.PNG$/", $argazkiIzena);
		
			if (!$contains_jpg && !$contains_jpeg && !$contains_png && !$contains_JPG && !$contains_JPEG && !$contains_PNG)
				$erroreak = $erroreak . "(hautazkoa) Irudiaren formatua okerra, irudiak '.jpg', '.jpeg', '.png', '.JPG', '.JPEG' edo '.PNG' luzapena eduki behar du";
		}
		
		if (!empty($erroreak)) echo '<script> alert("'.$erroreak.'"); </script>';
		else {
			include("dbConfig.php");
			$linki= mysqli_connect($zerbitzaria,$erabiltzailea,$gakoa,$db);
			
			if(!$linki) echo '<script> alert("Konexio errorea"); </script>';
			else {
				$data = $linki->query("SELECT eposta FROM users WHERE eposta='".$eposta."'");			
				if($data->num_rows != 0) echo '<script> alert("Eposta hori duen erabiltzailea jada erregistratuta dago"); </script>';
				else include("verifyUserAndPasswordWZ.php");
			}
		}
	}
?>