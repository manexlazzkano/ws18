<!DOCTYPE html>
<html>
	<head>
		<title>Show questions</title>
		<script src="../js/jquery-3.2.1.js"></script>
		<style>
			td		 				{text-align: center;}
			
			#logInfo				{float:right; margin-top: -5px;}
			#loggedEmail			{float:left; margin-right: 20px; margin-top: 6%;}
			#argazkia				{float:right;}

			#menua					{float: left; }
			#backButton				{float: left;}
			ul		 				{list-style: none; margin-left: 400px;}
			ul li	 			    {display: inline;}
		</style>
	</head>
	
	<body>
		<a id="backButton" href=javascript:history.go(-1);> <img src="../images/atrás.png" width="40" height="40"></a>
		<div id="menua">
		<ul>
			<li><a href='<?php $id = $_GET['logged']; echo "layout.php?logged=$id"; ?>'>Home</a></li>
			<li><a href='<?php $id = $_GET['logged']; echo "layout.php?logged=$id"; ?>'>Quizzes</a></li>			
			<li><a href='<?php $id = $_GET['logged']; echo "handlingQuizesAJAX.php?logged=$id"; ?>'>Handling quizzes</a></li>
			<li><a href='<?php $id = $_GET['logged']; echo "showXMLQuestions.php?logged=$id"; ?>'>Questions in XML</a></li>
			<li><a href='<?php $id = $_GET['logged']; echo "getQuestionWZ.php?logged=$id"; ?>'>Get specific question</a></li>
			<li><a href='<?php $id = $_GET['logged']; echo "credits.php?logged=$id"; ?>'>Credits</a></li>
			<li><a href="<?php $id = $_GET['logged']; echo "showQuestions.php?logged=$id&removeUser=1"; ?>">LogOut</a></li>
		</ul>
		</div>
		<div id="logInfo"></div>
		<table border="1">
			<tr id="eremuak">
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
				include("userInfo.php");
				include("removeLoggedUser.php");
			
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
								echo "<td><img style='display:block' width='100' height='100' src='data:image/*;base64,".base64_encode($galdera['irudia'])."'></td>";
							else
								echo "<td><img style='display:block' width='100' height='100' src='../images/x.png'></td>";
						echo "</tr>";
					}
				}
			?>
		</table>
	</body>
</html>