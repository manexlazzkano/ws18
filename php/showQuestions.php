<!DOCTYPE html>
<html>
	<head>
		<title>Show questions</title>
	</head>
	<style>
		#eremuak {font-weight: bold;}
		td		 {text-align: center;}
	</style>
	
	<body>
		<a id="backButton" href=javascript:history.go(-1);> <img src="../images/atrás.png" width="40" height="40"></a>
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
			</tr>
			
			<?php
				include("dbConfig.php");
				$linki= mysqli_connect($zerbitzaria,$erabiltzailea,$gakoa,$db);
				
				if(!$linki) echo "Konexio errorea</br>";
				else {
					$galderenTaula = "questions";				
					$galderenTaula = $linki->query("SELECT * FROM questions");
					
					if($galderenTaula->num_rows == 0) echo "Ez dago galderarik</br>";
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
						echo "</tr>";
					}
				}
			?>
		</table>
	</body>
</html>