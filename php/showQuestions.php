<!DOCTYPE html>
<html>
	<head>
		<title>Show questions</title>
		<script src="../js/jquery-3.2.1.js"></script>
		<style>
			#eremuak {font-weight: bold;}
			td		 {text-align: center;}
			
			#logInfo				{float:right; margin-top: -5px;}
			#deitura				{float:left; margin-right: 20px; margin-top: 8%;}
			#argazkia				{float:right;}

			ul		 {list-style: none; margin-left: 500px; float:right;}
			ul li	 {display: inline;}
		</style>
	</head>
	
	<body>
		<a id="backButton" href=javascript:history.go(-1);> <img src="../images/atrás.png" width="40" height="40"></a>
		<ul>
			<li><a href='<?php $id=$_GET['logged']; echo "layout.php?logged=$id"; ?>'>Home</a></li>
			<li><a href='<?php $id=$_GET['logged']; echo "layout.php?logged=$id"; ?>'>Quizzes</a></li>			
			<li><a href='<?php $id=$_GET['logged']; echo "addQuestion.php?logged=$id"; ?>'>Add question</a></li>
			<li><a href='<?php $id=$_GET['logged']; echo "credits.php?logged=$id"; ?>'>Credits</a></li>
			<li><a href='layout.php'>LogOut</a></li>
		</ul>
		<div id="logInfo">
			<p id='deitura'></p>
		</div>
		<table border="1">
			<tr id="eremuak">
				<td> ID </td>
				<td> Eposta </td>
				<td> Galdera </td>
				<td> Erantzun zuzena </td>
				<td> 1. erantzun okerra </td>
				<td> 2. erantzun okerra </td>
				<td> 3. erantzun okerra </td>
				<td> Zailtasuna </td>
				<td> Arloa </td>
				<td> Irudia </td>
			</tr>
			
			<?php
				if (!empty($_GET['logged'])) {
					echo '<script> $(".logeatuGabeak").hide(); </script>';
					
					include("dbConfig.php");
					$linki= mysqli_connect($zerbitzaria,$erabiltzailea,$gakoa,$db);
					
					if(!$linki) echo '<script> alert("Konexio errorea"); </script>';
					else {
						
						$id = $_GET['logged'];
						$data = $linki->query("SELECT * FROM users WHERE ID='".$id."'");		
						if($data->num_rows != 0) {		
						
							$erabiltzailea = $data->fetch_assoc();
							if (!empty($erabiltzailea['argazkia'])) {
								$deitura = $erabiltzailea['deitura'];
								$argazkia = "<img id='argazkia' border='1' width='50' height='50' src='data:image/*;base64,".base64_encode($erabiltzailea['argazkia'])."'>";
								echo '<script> $("#deitura").text("'.$deitura.'") </script>';
								echo '<script> $("#logInfo").append("'.$argazkia.'") </script>';
								
							}
							else {
								$deitura = $erabiltzailea['deitura'];
								echo '<script> $("#deitura").text(" '.$deitura.'") </script>';
							}
						}
					}
				}
				else
					echo '<script> $(".logeatuak").hide(); </script>';
			
				// include("dbConfig.php");
				// $linki= mysqli_connect($zerbitzaria,$erabiltzailea,$gakoa,$db);
				
				if(!$linki) echo "Konexio errorea</br>";
				else {			
					$galderenTaula = $linki->query("SELECT * FROM questions");
					
					if($galderenTaula->num_rows == 0) echo "Ez dago galderarik<br>";
					while ($galdera = $galderenTaula->fetch_assoc()) {
						echo "<tr>"; 
							echo "<td>".$galdera['ID']."</td>";
							echo "<td>".$galdera['eposta']."</td>";
							echo "<td>".$galdera['galderaTestua']."</td>";
							echo "<td>".$galdera['erantzunZuzena']."</td>";
							echo "<td>".$galdera['erantzunOkerra1']."</td>";
							echo "<td>".$galdera['erantzunOkerra2']."</td>";
							echo "<td>".$galdera['erantzunOkerra3']."</td>";
							echo "<td>".$galdera['zailtasuna']."</td>";
							echo "<td>".$galdera['arloa']."</td>";
							if($galdera['irudia'] != "")
								echo "<td><img width='100' height='100' src='data:image/*;base64,".base64_encode($galdera['irudia'])."'></td>";
							else
								echo "<td><img width='100' height='100' src='../images/x.png'></td>";
						echo "</tr>";
					}
				}
			?>
		</table>
	</body>
</html>