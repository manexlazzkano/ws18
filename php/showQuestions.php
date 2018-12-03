<?php
	header("Control-cache: no-store, no-cache, must-revalidate");
	session_start();
	if(!isset($_SESSION['id'])) {
		echo '<script> javascript:history.go(1); </script>';
		die();
	}
?>

<!DOCTYPE html>
<html>
	<head>
		<meta name="eduki-mota" content="text/html;" http-equiv="content-type" charset="utf-8">
		<title>Show questions</title>
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
				<span class="loginekoak"><a href="logOut.php">LogOut</a> </span>
				<a id="backButton" href=javascript:history.go(-1);> <img src="../images/atrás.png" width="40" height="40"></a>
				<div id="logInfo"></div>
				<h2>Show questions</h2>
			</header>
			
			<nav class='main' id='n1' role='navigation'>
				<span><a href='layout.php'>Home</a></span>
				<span><a href='credits.php'>Credits</a></span>
				<span><a href='layout.php'>Quizzes</a></span>
				<br><br>
				<span><a href='showQuestions.php'>Show questions</a></span>
				<span><a href='showXMLQuestions.php'>Questions in XML</a></span>
				<br><br>
				<span><a href='handlingQuizes.php'>Handling quizzes</a></span>
				<span><a href='handlingAccounts.php'>Handling accounts</a></span>		
			</nav>
			
			<section class="main" id="s1">
			<div>
				<style>
					th, td {text-align: center;}
				</style>
				
			<table border="1">
			<tr>
				<th> ID </th>
				<th> Eposta </th>
				<th> Galdera </th>
				<th> Erantzun zuzena </th>
				<th> 1. erantzun okerra </th>
				<th> 2. erantzun okerra </th>
				<th> 3. erantzun okerra </th>
				<th> Zailtasuna </th>
				<th> Arloa </th>
				<th> Irudia </th>
			</tr>
			
			<?php
				include("dbConfig.php");
				$linki= mysqli_connect($zerbitzaria,$erabiltzailea,$gakoa,$db);
				
				if(!$linki) echo "Konexio errorea</br>";
				else {			
					$galderenTaula = $linki->query("SELECT * FROM questions");
					
					$height = 240;
					if($galderenTaula->num_rows == 0) echo "Ez dago galderarik<br>";
					while ($galdera = $galderenTaula->fetch_assoc()) {
						echo "<tr>"; 
							echo "<td>".$galdera['ID']."</td>";
							echo "<td> &nbsp&nbsp <marquee bgcolor=#FFFF00 width=150px>".$galdera['eposta']."</marquee> &nbsp&nbsp </td>";
							echo "<td>".$galdera['galderaTestua']."</td>";
							echo "<td>".$galdera['erantzunZuzena']."</td>";
							echo "<td>".$galdera['erantzunOkerra1']."</td>";
							echo "<td>".$galdera['erantzunOkerra2']."</td>";
							echo "<td>".$galdera['erantzunOkerra3']."</td>";
							echo "<td>".$galdera['zailtasuna']."</td>";
							echo "<td>".$galdera['arloa']."</td>";
							if($galdera['irudia'] != "")
								echo "<td><img style='display:block' width='100' height='100' src='data:image/*;base64,".base64_encode($galdera['irudia'])."'></td>";
							else
								echo "<td><img style='display:block' width='100' height='100' src='../images/x.png'></td>";
						echo "</tr>";
						
						$height += 103;
					}
					echo '<style> #n1,#s1 {height: '.$height.'px;}; </style>';
				}
			?>
			</table>
		
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