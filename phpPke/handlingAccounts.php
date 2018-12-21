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
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<meta name="description" content="">
		<meta name="author" content="">
		<title>Handling accounts</title>

		<script src="../js/jquery-3.2.1.js"></script>
		<script src="../js/addImage.js"></script>
		<script src="../js/removeImage.js"></script>
		<script src="../js/showMeMyQuestionsAJAX.js"></script>
		<script src="../js/addQuestionAJAX.js"></script>
		<script src="../js/refreshQuestionsTable.js"></script>
		<script src="../js/adminControl.js"></script>
		
		<script src="../bootstrap/jquery.min.js"></script>
		
		
		<!-- Bootstrap core CSS -->
		<link href="../bootstrap/bootstrap.min.css" rel="stylesheet">

		<!-- Custom styles for this template -->
		<link href="../bootstrap/sticky-footer-navbar.css" rel="stylesheet">
		
	</head>
	
	<body class="text-center" style="background-color:rgb(200,200,255);">
		<input type="hidden" id="logInfo">
		<header>
      <!-- Fixed navbar -->
      <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark" role='navigation'>
	  
		<a class="navbar-brand" id="backButton" style="text-decoration:none;" href=javascript:history.go(-1);>
		<img class="rounded-circle" src="../images/atras.png" width="36px" height="36px"></a>		

		<a class="navbar-brand" href="handlingAccounts.php"><strong style="font-size:22px; color:rgb(224,224,224);">Handling accounts</strong></a>
		
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
		<span class="navbar-toggler-icon"></span></button>
		
        <div class="collapse navbar-collapse" id="navbarCollapse">
          <ul class="navbar-nav mr-auto">
            <li class="nav-item"><a class="nav-link" color='red' href="layout.php">Home</a></li>
            <li class="nav-item"><a class="nav-link" href="credits.php">Credits</a></li>
			
		    <li class='nav-item'><a class='nav-link' href='getQuestionWZ.php'>Get question</a></li>
		    <li class='nav-item'><a class='nav-link' href='showQuestions.php'>Show questions</a></li>
		    <li class='nav-item'><a class='nav-link' href='showXMLQuestions.php'>Questions in XML</a></li>
		    <li class='nav-item'><a class='nav-link' href='handlingQuizes.php'>Handling quizzes</a></li>

		  </ul>

			<div class="dropdown">
				<button class="btn btn-dark" type="button" id="menu1" data-toggle="dropdown"></button>
				<ul style="background-color:rgb(64,64,64);" class="dropdown-menu" role="menu" aria-labelledby="menu1">
					<li style="text-align:center;" role="presentation">
					<button id="logout" class="btn btn-danger">Log out</button>
					</li>
				</ul>
			</div>
			
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
			<style>
				table {width: 85%;margin: 0px auto;}
				th, td {text-align: center;}
				.blokeatuta {background-color: rgb(255,96,96);}
				.aktibatuta {background-color: rgb(96,255,96);}
			</style>
			
			<br><br><br><br>
			<div class="table-responsive">
			<table class="table-condensed table-hover table-bordered" border='3' style="background-color:white;">
			<tr>
				<th> &nbsp<input class='checkbox' type='checkbox' id='firstCheckbox'>&nbsp </th>
				<th> ID </th>
				<th> Eposta </th>
				<th> Pasahitza </th>
				<th> Argazkia </th>
				<th> Egoera </th>
			</tr>
			
			<?php
				include("dbConfig.php");
				$linki= mysqli_connect($zerbitzaria,$erabiltzailea,$gakoa,$db);
				
				if(!$linki) echo "Konexio errorea</br>";
				else {			
					$erabiltzaileTaula = $linki->query("SELECT * FROM users");								
					if ($erabiltzaileTaula->num_rows == 0) echo "Ez dago erabiltzailearik<br>";
					
					$i = 1;
					$disabled = "disabled";
					while ($erabiltzailea = $erabiltzaileTaula->fetch_assoc()) {
						echo "<tr'>";
							if ($i > 1) {$disabled = ""; echo "<td> <input type='checkbox' class='checkbox'> </td>";}
							else echo "<td> <input type='checkbox' disabled> </td>";
				
							echo "<td id='".$i."'> &nbsp ".$erabiltzailea['ID']." &nbsp </td>";
							echo "<td> &nbsp ".$erabiltzailea['eposta']." &nbsp </td>";
							echo "<td> &nbsp <marquee width='250'>" .$erabiltzailea['pasahitza']. "</marquee> &nbsp </td>";
							
							if($erabiltzailea['argazkia'] != "")
								echo "<td><img class='rounded-circle' width='100' height='100' style='display:block' src='data:image/*;base64,".base64_encode($erabiltzailea['argazkia'])."'></td>";	
							else
								echo "<td><img class='rounded-circle' width='100' height='100' style='display:block' src='../images/avatar.jpeg'></td>";
							
							if ($erabiltzailea['egoera'] == "aktibo") {
								echo "<td class='aktibatuta'>&nbspAKTIBO&nbsp<br><br>
								<input class='btn btn-danger' type='button' value='Blokeatu' class='blokeatu' ".$disabled."/> </td>";
							}
							else if ($erabiltzailea['egoera'] == "blokeatuta") {
								echo "<td class='blokeatuta'>&nbspBLOKEATUTA&nbsp<br><br>
								<input class='btn btn' type='button' style='background-color:rgb(96,255,96);' value='Aktibatu' class='aktibatu' ".$disabled."/> </td>";
							}
								
							echo "<td><br><button class='btn btn' type='button' class='ezabatu' ".$disabled."><img src='../svg/si-glyph-trash.svg' width='20' height='20'/> Ezabatu</button></td>";
							
						echo "</tr>";
						$i++;
					}
				}
			?>
			</table>
			</div>
			<br><br>
			<div class="row">
			<div class="col-sm-2 offset-sm-3"><button class='btn btn' type='button' style='background-color:rgb(96,255,96);' id='aktibatuAukeratuak'>Aktibatu aukeratuak</button><br><br></div>
			<div class="col-sm-2"><button class='btn btn-danger' type='button' id='blokeatuAukeratuak'>Blokeatu aukeratuak</button><br><br></div>
			<div class="col-sm-2"><button class='btn btn' type='button' id='ezabatuAukeratuak'><img src="../svg/si-glyph-trash.svg" width="20" height="20"/> Ezabatu aukeratuak</button><br><br></div></div>
			<div class="col-sm-3"></div></div>
			<br><br><br>
		
			
			<div id="divFeedbackAjax"></div>
			<div id="divTaulaAjax"></div>
		</main>

		<footer class="footer">
		  <div class="container" style="text-align: center;">
			<span class="text-muted">© 2018 Crazzy questions games</span><br>
			<span class="text-muted"><a href='https://github.com'>Link GITHUB</a></span>
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
	include("userInfo.php");
	echo '<script> $("#logInfo").find("img").attr("class", "rounded-circle"); </script>';
	echo '<script> $("#menu1").append("'.$loggedEmail.'"); </script>';
	echo '<script> $("#menu1").append($("#logInfo").find("img")); </script>';
	echo '<script> $("#menu1").append("<span class="caret"></span></button>"); </script>';
?>