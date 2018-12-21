<?php
	session_start();
	if(isset($_SESSION['sid'])) {
		echo '<script> history.go(1); </script>';
	}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
	<title>Log in</title>
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
		<a class="navbar-brand" href="logIn.php"><strong class="rounded" style="font-size:22px; color:rgb(224,224,224);">Log in</strong></a>

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
		  
		  <button id='signup' class='btn btn btn-secondary'>Sign up</button>
        </div>
    </nav>
	<script> $("#signup").click(function(){window.location.href = 'signUp.php';}); </script>
    <form class="form-signin" id="formularioa" action="logIn.php" method="post" enctype="multipart/form-data">
	  <br><br><br>
	  <img src="../images/login.png" width="100px" height="100px">
	  
      <h1 class="h3 mb-3 font-weight-normal">Please log in</h1>
	  
      <input type="email" id="eposta" name="eposta" class="form-control" placeholder="Email address" required autofocus>
      <input type="password" id="pasahitza" name="pasahitza" class="form-control" placeholder="Password" required>

	  <div id="divRecovery">
		 <br>
		 <button id="pasahitzaAhaztu" class="btn btn-lg btn-secondary">Forgot the password?</button>
	  </div> <br>
	  
	  <button class="btn btn-lg btn-block" type="reset">Reset</button>
      <button class="btn btn-lg btn-primary btn-block" type="submit">Log in</button> <br>
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
		
		$eposta = $_POST['eposta'];				
		$pasahitza = $_POST['pasahitza'];
		
		include("dbConfig.php");
		$linki= mysqli_connect($zerbitzaria,$erabiltzailea,$gakoa,$db);
		
		if(!$linki) echo '<script> alert("Konexio errorea"); </script>';
		else {
			
			$data = $linki->query("SELECT * FROM users WHERE eposta='".$eposta."'");
			
			if($data->num_rows != 0) {
				$erabiltzailea = $data->fetch_assoc();
				$hashedPassword = $erabiltzailea['pasahitza'];
				
				if (!password_verify($pasahitza, $hashedPassword)) echo '<script> alert("Pasahitza okerra"); </script>';
				else include("storeLoginInfo.php");			
			}
			else echo '<script> alert("Erabiltzaile hori ez da existitzen"); </script>';
		}
	}
?>