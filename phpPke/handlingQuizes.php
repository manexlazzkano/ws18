<?php
	session_start();
	if(!isset($_SESSION['sid'])) {
		echo "<script> window.location.href='layout.php'; </script>";
		die();
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
	<script src="../js/showMeMyQuestionsAJAX.js"></script>
	<script src="../js/addQuestionAJAX.js"></script>
	<script src="../js/refreshQuestionsTable.js"></script>
	
    <link rel="icon" href="../images/quizz.png">

    <title>Sign up</title>

    <!-- Bootstrap core CSS -->
    <link href="../bootstrap/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="../bootstrap/logIn.css" rel="stylesheet">
  </head>

  <body class="text-center" style="background-color:rgb(200,200,255);">
  
	<form class="form-signin" name="formularioa" action="addQuestion.php" method="post" enctype="multipart/form-data">
	
		<a id="backButton" href=javascript:history.go(-1);>
	      <img class="rounded-circle" style="border:2px solid" src="../images/atras.png" width="40px" height="40px">
	    </a> <br><br>
	    <img src="../images/quizz.png" width="200px" height="200px">
		
		<h1 class="h3 mb-3 font-weight-normal">Handling quizzes</h1>

		<label style='float:left;'>Question (*):</label> <input type="text" class="form-control" id="galdera" name="galdera"> <br>
		<label style='float:left;'>Correct answer (*):</label> <input type="text" class="form-control" id="erantzunZuzena" name="erantzunZuzena"> <br>
		<label style='float:left;'>First incorrect answer (*):</label> <input type="text" class="form-control" id="erantzunOkerra1" name="erantzunOkerra1"> <br>
		<label style='float:left;'>Second incorrect answer (*):</label> <input type="text" class="form-control" id="erantzunOkerra2" name="erantzunOkerra2"> <br>
		<label style='float:left;'>Third incorrect answer (*):</label> <input type="text" class="form-control" id="erantzunOkerra3" name="erantzunOkerra3"> <br>
		<label style='float:left;'>Difficulty (*):</label> <select class="custom-select d-block w-100" id="zailtasuna" name="zailtasuna">
			<option>0</option>
			<option>1</option>
			<option>2</option>
			<option>3</option>
			<option>4</option>
			<option>5</option>
		</select> <br>
		<label style='float:left;'>Subject (*):</label> <input type="text" class="form-control" id="arloa" name="arloa"> <br>
		
		<label style='float:left;'>Photo (optional):</label> <br><div class="rounded" style="background-color:rgb(200,255,200);"> <br>
		   <input class="file" type="file" id="fitxategia" name="fitxategia"/> <br><br>
		   <div id="divIrudi"></div>
		</div> <br>
		
		<button class="btn btn-lg btn-block" type="reset">Reset</button>
		<button class="btn btn-lg btn-secondary btn-block" type="button" onclick="datuakErakutsi(false, false)">Show my questions</button>
		<button id="galderaGehitu" class="btn btn-lg btn-primary btn-block" type="button">Add question</button>

		<p class="mt-5 mb-3 text-muted">&copy; 2018 Crazzy questions games</p>
		<a href='https://github.com'>Link GITHUB</a>
	</form>
	<div id="divFeedbackAjax"></div>
	<div id="divTaulaAjax"></div>
  </body>
</html>

<?php
	include("userInfo.php");
?>