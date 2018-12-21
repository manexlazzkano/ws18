<!DOCTYPE html>
<html>
  <head>
    <meta name="tipo_contenido" content="text/html;" http-equiv="content-type" charset="utf-8">
	<title>Play quizz</title>
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
	<script src="../js/playQuizz.js"></script>
	
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
		<h2>Play quizz</h2>
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
		<?php
			//$goitizena = preg_replace('/\s\s+/', ' ', trim($_POST['goitizena']));
			$goitizena = $_POST['goitizena'];

			$players = simplexml_load_file("../xml/players.xml");
			$players->addChild('player', $goitizena);
			$players->asXML("../xml/players.xml");
			
			echo "Jokalaria: ".$goitizena;
			
		?>
		<br><br>
		
		<input type="button" id="onePlay" value="   One-play   "/>
		<input type="button" id="playingBySubject" value="   Playing-by-subject   "/>
		
		</div>
    </section>
	<footer class='main' id='f1'>
		 <a href='https://github.com'>Link GITHUB</a>
	</footer>
  </div>
</body>
</html>

<?php
	if(isset($_SESSION['id'])) include("userInfo.php");
?>