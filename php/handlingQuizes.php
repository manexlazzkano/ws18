<?php
	session_start();
	if(!isset($_SESSION['sid'])) {
		echo "<script> window.location.href='layout.php'; </script>";
		die();
	}
?>

<!DOCTYPE html>
<html>
	<head>
		<meta name="eduki-mota" content="text/html;" http-equiv="content-type" charset="utf-8">
		<title>Handling quizzes</title>
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
		<script src="../js/showMeMyQuestionsAJAX.js"></script>
		<script src="../js/addQuestionAJAX.js"></script>
		<script src="../js/refreshQuestionsTable.js"></script>
		
	</head>
	<body>
		<div id='page-wrap'>
			<header class='main' id='h1'>
				<span class="loginekoak"><a href="logOut.php">LogOut</a> </span>
				<a id="backButton" href=javascript:history.go(-1);> <img src="../images/atrás.png" width="40" height="40"></a>
				<div id="logInfo"></div>
				<h2>Handling quizzes</h2>
			</header>
			
			<nav class='main' id='n1' role='navigation'>
				<span><a href='layout.php'>Home</a></span>
				<span><a href='credits.php'>Credits</a></span>
				<span><a href='layout.php'>Quizzes</a></span>
				<br><br>
				<span><a href='getQuestionWZ.php'>Get question</a></span>
				<span><a href='showQuestions.php'>Show questions</a></span>
				<span><a href='showXMLQuestions.php'>Questions in XML</a></span>			
			</nav>
			
			<section class="main" id="s1">
				<div>
				<form id="formularioa" name="formularioa" action="<?php echo "addQuestion.php?logged=$id"?>" method="post" enctype="multipart/form-data">
					<input type="button" value="   Nire galderak erakutsi   " class="botoia" onclick="datuakErakutsi(false, false)"/>
					<input type="button" value="   Galdera gehitu   " class="botoia" id="galderaGehitu"/>
					<input type="reset" value="   Garbitu   "/> </br></br>
				
					Galderaren testua (*): <input type="text" class="input" id="galdera" name="galdera" size="110"/> </br></br>
					Erantzun zuzena (*): <input type="text" class="input" id="erantzunZuzena" name="erantzunZuzena" size="110"/> </br></br>
					Erantzun okerra1 (*): <input type="text" class="input" id="erantzunOkerra1" name="erantzunOkerra1" size="110"/> </br></br>
					Erantzun okerra2 (*): <input type="text" class="input" id="erantzunOkerra2" name="erantzunOkerra2" size="110"/> </br></br>
					Erantzun okerra3 (*): <input type="text" class="input" id="erantzunOkerra3" name="erantzunOkerra3" size="110"/> </br></br>
					Galderaren zailtasuna (0 eta 5 artekoa) (*): <select class="input" id="zailtasuna" name="zailtasuna">
																	<option value="0">0</option>
																	<option value="1">1</option>
																	<option value="2">2</option>
																	<option value="3">3</option>
																	<option value="4">4</option>
																	<option value="5">5</option>
																</select> <br><br>
					Galderaren gai-arloa (*): <input type="text" class="input" id="arloa" name="arloa"/> </br></br>
					Irudia (hautazkoa): <input type="file" class="input" id="fitxategia" name="fitxategia"/> </br></br>
					<div id="divIrudi"></div>
				</form>
				</div>
				<div id="divFeedbackAjax"></div>
				<div id="divTaulaAjax"></div>
				
			</section>

			<footer class='main' id='f1'>
				<a href='https://github.com'>Link GITHUB</a>
			</footer>
		</div>	
	</body>
</html>

<?php
	include("userInfo.php");
?>