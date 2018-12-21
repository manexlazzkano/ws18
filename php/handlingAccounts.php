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
		<title>Handling accounts</title>
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
		<script src="../js/adminControl.js"></script>
		
	</head>
	<body>
		<div id='page-wrap'>
			<header class='main' id='h1'>
				<span class="loginekoak"><a href="logOut.php">LogOut</a> </span>
				<a id="backButton" href=javascript:history.go(-1);> <img src="../images/atrás.png" width="40" height="40"></a>
				<div id="logInfo"></div>
				<h2>Handling accounts</h2>
			</header>
			
			<nav class='main' id='n1' role='navigation'>
				<span><a href='layout.php'>Home</a></span>
				<span><a href='credits.php'>Credits</a></span>
				<span><a href='layout.php'>Quizzes</a></span>
			</nav>
			
			<section class="main" id="s1">
			<div>
				<style>
					th, td {text-align: center;}
					.blokeatuta {background-color: rgb(255,0,0);}
					.aktibatuta {background-color: rgb(0,255,0);}
				</style>
				
				<table border="1">
				<tr>
					<th> &nbsp <input type='checkbox' id='firstCheckbox'> &nbsp </th>
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
						$height = 430;
						while ($erabiltzailea = $erabiltzaileTaula->fetch_assoc()) {
							echo "<tr'>";
								if ($i > 1) {$disabled = ""; echo "<td> &nbsp <input type='checkbox' class='checkbox'> &nbsp </td>";}
								else echo "<td> &nbsp <input type='checkbox' disabled> &nbsp </td>";
					
								echo "<td id='".$i."'> &nbsp ".$erabiltzailea['ID']." &nbsp </td>";
								echo "<td> &nbsp ".$erabiltzailea['eposta']." &nbsp </td>";
								echo "<td> &nbsp&nbsp <marquee width=250px>" .$erabiltzailea['pasahitza']. "</marquee> &nbsp&nbsp </td>";
								
								if($erabiltzailea['argazkia'] != "")
									echo "<td><img style='display:block' width='100' height='100' src='data:image/*;base64,".base64_encode($erabiltzailea['argazkia'])."'></td>";	
								else
									echo "<td><img style='display:block' width='100' height='100' src='../images/avatar.jpeg'></td>";
								
								if ($erabiltzailea['egoera'] == "aktibo") {
									echo "<td class='aktibatuta'> &nbsp&nbsp " .$erabiltzailea['egoera'] ." &nbsp&nbsp <br><br>
									&nbsp <input type='button' value='Blokeatu' class='blokeatu' ".$disabled."/> &nbsp </td>";
								}
								else if ($erabiltzailea['egoera'] == "blokeatuta") {
									echo "<td class='blokeatuta'> &nbsp&nbsp " .$erabiltzailea['egoera'] ." &nbsp&nbsp <br><br>
									&nbsp <input type='button' value='Aktibatu' class='aktibatu' ".$disabled."/> &nbsp </td>";
								}
									
								echo "<td> &nbsp <input type='button' value='Ezabatu' class='ezabatu' ".$disabled."/> &nbsp </td>";
								
							echo "</tr>";
							
							if($i > 3) $height += 105;
							$i++;
						}
						echo '<style> #n1,#s1 {height: '.$height.'px;}; </style>';
					}
				?>
				</table>
				<?php
					echo "<br><br>";
					echo "<input type='button' value='  Aktibatu aukeratuak  ' id='aktibatuAukeratuak'/>   ";
					echo "<input type='button' value='  Blokeatu aukeratuak  ' id='blokeatuAukeratuak'/>   ";
					echo "<input type='button' value='  Ezabatu aukeratuak  ' id='ezabatuAukeratuak'/>";
				?>
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