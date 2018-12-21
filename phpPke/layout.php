<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">
  <head>
	<title>Quizzes</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">	
	<script src="../js/jquery-3.2.1.js"></script>
	<script src="../bootstrap/jquery.min.js"></script>

    <link rel="icon" href="../images/quizz.png">
    <link href="../bootstrap/bootstrap.min.css" rel="stylesheet">
    <link href="../bootstrap/sticky-footer-navbar.css" rel="stylesheet">
  </head>

  <body style="background-color:rgb(200,200,264);">
	<input type="hidden" id="logInfo">
    <header>
      <!-- Fixed navbar -->
      <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark" role='navigation'>
	  
		<a class="navbar-brand" id="backButton" style="text-decoration:none;" href=javascript:history.go(-1);>
		<img class="rounded-circle" src="../images/atras.png" width="36px" height="36px"></a>		

		<a class="navbar-brand" href="layout.php"><strong class="rounded" style="font-size:22px; color:rgb(224,224,224);">Quizzes</strong></a>
		
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
          <ul class="navbar-nav mr-auto">
            <li class="nav-item">
              <a class="nav-link" color='red' href="layout.php">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="credits.php">Credits</a>
            </li>
			
			<?php
			if (isset($_SESSION['rola']) && $_SESSION['rola'] == 'ikaslea') {
				echo "<li class='nav-item'><a class='nav-link' href='getQuestionWZ.php'>Get question</a></li>
					  <li class='nav-item'><a class='nav-link' href='showQuestions.php'>Show questions</a></li>
					  <li class='nav-item'><a class='nav-link' href='showXMLQuestions.php'>Questions in XML</a></li>
					  <li class='nav-item'><a class='nav-link' href='handlingQuizes.php'>Handling quizzes</a></li>";
			}
			else if (isset($_SESSION['rola']) && $_SESSION['rola'] == 'admin')
				echo "<li class='nav-item'><a class='nav-link' href='handlingAccounts.php'>Handling accounts</a></li>";
			?>
			
			</ul>
		  
			<?php
			if (!isset($_SESSION['sid'])) {
				echo "<button id='login' class='btn btn-primary'>Log in</button>&nbsp&nbsp
					  <button id='signup' class='btn btn-secondary'>Sign up</button></li>";
			}
			else if (isset($_SESSION['sid']))
				echo
					'<div class="dropdown">
					<button class="btn btn-dark" type="button" id="menu1" data-toggle="dropdown"></button>
					<ul style="background-color:rgb(64,64,64);" class="dropdown-menu" role="menu" aria-labelledby="menu1">
					  <li style="text-align:center;" role="presentation">
						<button id="logout" class="btn btn-danger">Log out</button>
					  </li>
					</ul>
				  </div>';
			?>
        </div>
      </nav>
	  <script>
	  $(document).ready(function(){
		  $("#login").click(function(){window.location.href = 'logIn.php';});
		  $("#signup").click(function(){window.location.href = 'signUp.php';});
		  $("#logout").click(function(){window.location.href = 'logOut.php';});
	  });					
	</script>
    </header>

    <!-- Begin page content -->
    <main role="main" class="container">
      <h1 class="mt-5" style="text-align: center;"><strong>Welcome to crazy question webpage!</strong></h1>
      <p class="lead" style="text-align: center;"> Quizzes and credits will be displayed in this spot in future laboratories ... </p>

	  <img class="rounded" style="display:block; margin-left:auto; margin-right:auto; width:50%;" src="../images/owl.gif">
    </main>

    <footer class="footer">
      <div class="container" style="text-align:center;">
        <span class="text-muted">© 2018 Crazzy questions games</span><br>
		<span class="text-muted"><a href="https://github.com/twbs/bootstrap">Link GITHUB</a></span>
      </div>
    </footer>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="../bootstrap/slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script>window.jQuery || document.write('<script src="../bootstrap/slim.min.js"><\/script>')</script>
    <script src="../bootstrap/popper.min.js"></script>
    <script src="../bootstrap/bootstrap.min.js"></script>
  </body>
</html>

<?php
	if (isset($_SESSION['register']) && $_SESSION['register'] == 1) {
		echo "sdsafh";
		echo '<script> $("#s1").find("div").text("Zure erregistratzea arazorik gabe gauzatu da, egin login saioa hasteko"); </script>';
		
		session_unset();
		session_destroy();
	}
	
	if(isset($_SESSION['sid'])) {
		include("userInfo.php");
		echo '<script> $("#logInfo").find("img").attr("class", "rounded-circle"); </script>';
		echo '<script> $("#menu1").append("'.$loggedEmail.'"); </script>';
		echo '<script> $("#menu1").append($("#logInfo").find("img")); </script>';
		echo '<script> $("#menu1").append("<span class="caret"></span></button>"); </script>';
	}
?>