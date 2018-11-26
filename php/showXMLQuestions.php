<!DOCTYPE html>
<html>
	<head>
		<title>Show questions</title>
		<script src="../js/jquery-3.2.1.js"></script>
		<style>
			td		 				{text-align: center;}
			
			#logInfo				{float:right; margin-top: -45px;}
			#loggedEmail			{float:left; margin-right: 20px; margin-top: 6%;}
			#argazkia				{float:right;}

			#menua					{float: center;}
			#backButton				{float: left;}
			ul		 				{list-style: none; margin-left: 400px;}
			ul li	 			    {display: inline;}
			table					{margin-left: 400px;}
		</style>
	</head>
	
	<body>
		<a id="backButton" href=javascript:history.go(-1);> <img src="../images/atrás.png" width="40" height="40"></a>
		<div id="menua">
		<ul>
			<li><a href='<?php $id=$_GET['logged']; echo "layout.php?logged=$id"; ?>'>Home</a></li>
			<li><a href='<?php $id=$_GET['logged']; echo "layout.php?logged=$id"; ?>'>Quizzes</a></li>			
			<li><a href='<?php $id=$_GET['logged']; echo "handlingQuizesAJAX.php?logged=$id"; ?>'>Handling quizzes</a></li>
			<li><a href='<?php $id=$_GET['logged']; echo "showQuestions.php?logged=$id"; ?>'>Show questions</a></li>
			<li><a href='<?php $id=$_GET['logged']; echo "getQuestionWZ.php?logged=$id"; ?>'>Get specific question</a></li>
			<li><a href='<?php $id=$_GET['logged']; echo "credits.php?logged=$id"; ?>'>Credits</a></li>
			<li><a href="<?php $id=$_GET['logged']; echo "showXMLQuestions.php?logged=$id&removeUser=1"; ?>">LogOut</a></li>
		</ul>
		</div>
		<div id="logInfo"></div>
		<table border="1">
			<tr>
				<th> Egilea </th>
				<th> Enuntziatua </th>
				<th> Erantzun zuzena </th>
			</tr>
			
			<?php
				header("Control-cache: no-store, no-cache, must-revalidate");
			
				include("userInfo.php");
				include("removeLoggedUser.php");
			
				$galderak = new SimpleXMLElement('../xml/questions.xml', null, true);
				foreach($galderak->assessmentItem as $galdera) {
					echo '<tr>';
						echo '<td>' .$galdera['author']. '</td>';
						echo '<td>' .$galdera->itemBody->p. '</td>';
						echo '<td>' .$galdera->correctResponse->value. '</td>';				
					echo '</tr>';
				}
			?>
				
		</table>
	</body>
</html>