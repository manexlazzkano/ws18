<!DOCTYPE html>
<html>
	<head>
		<title>Show questions</title>
	</head>
	<style>
		#eremuak {font-weight: bold;}
		td		 {text-align: center;}
		
		ul		 {list-style: none; margin-left: 500px; float:right;}
		ul li	 {display: inline;}
	</style>
	
	<body>
		<a id="backButton" href=javascript:history.go(-1);> <img src="../images/atrás.png" width="40" height="40"></a>
		<ul>
			<li><a href='../layout.html'>Home</a></li>
			<li><a href='../addQuestion.html'>Add question</a></li>
			<li><a href='../credits.html'>Credits</a></li>
		</ul>
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
				include("dbConfig.php");
				$linki= mysqli_connect($zerbitzaria,$erabiltzailea,$gakoa,$db);
				
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