<?php session_start(); ?>

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
		<?php
			if (!isset($_SESSION['id'])) {
				echo "<span><a href='logIn.php'>LogIn</a> </span>
				<span><a href='signUp.php'>SignUp</a> </span>";
			}
			else if (isset($_SESSION['id']))
				echo "<span><a href='logOut.php'>LogOut</a> </span>";
		?>		
		<div id="logInfo"></div>
		<h2>Quiz: crazy questions</h2>
    </header>
	<nav class='main' id='n1' role='navigation'>
		<span><a href='layout.php'>Home</a></span>
		<span><a href='credits.php'>Credits</a></span>
		<span><a href='layout.php'>Quizzes</a></span>
		<br><br>	
		<?php
			if (isset($_SESSION['rola']) && $_SESSION['rola'] == 'ikaslea') {
				echo "<span><a href='getQuestionWZ.php'>Get question</a></span>
				<span><a href='showQuestions.php'>Show questions</a></span>
				<span><a href='showXMLQuestions.php'>Questions in XML</a></span>
				<br><br>
				<span><a href='handlingQuizes.php'>Handling quizzes</a></span>";
			}
			else if (isset($_SESSION['rola']) && $_SESSION['rola'] == 'admin')
				echo "<span><a href='handlingAccounts.php'>Handling accounts</a></span>";
		?>	
	</nav>
    <section class="main" id="s1">
		<div>
		Quizzes and credits will be displayed in this spot in future laboratories ...
		</div>
    </section>
	<footer class='main' id='f1'>
		 <a href='https://github.com'>Link GITHUB</a>
	</footer>
  </div>
</body>
</html>

<?php
	if (isset($_SESSION['register']) && $_SESSION['register'] == 1) {
		echo "sdsafh";
		echo '<script> $("#s1").find("div").text("Zure erregistratzea arazorik gabe gauzatu da, egin login saioa hasteko"); </script>';
		
		session_unset();
		session_destroy();
	}
	
	if(isset($_SESSION['id'])) include("userInfo.php");
?>