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
		<title>Questions in XML</title>
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
				<h2>Questions in XML</h2>
			</header>
			
			<nav class='main' id='n1' role='navigation'>
				<span><a href='layout.php'>Home</a></span>
				<span><a href='credits.php'>Credits</a></span>
				<span><a href='layout.php'>Quizzes</a></span>
				<br><br>
				<span><a href='getQuestionWZ.php'>Get question</a></span>
				<span><a href='showQuestions.php'>Show questions</a></span>
				<br><br>
				<span><a href='handlingQuizes.php'>Handling quizzes</a></span>
			</nav>
			
			<section class="main" id="s1">
			<div>
				<style>
					th, td {text-align: center;}
				</style>
				
				<table border="1">
				<tr>
					<th> Egilea </th>
					<th> Enuntziatua </th>
					<th> Erantzun zuzena </th>
				</tr>
				
				<?php		
					$height = 240;
					$galderak = new SimpleXMLElement('../xml/questions.xml', null, true);
					foreach($galderak->assessmentItem as $galdera) {
						echo '<tr>';
							echo '<td>' .$galdera['author']. '</td>';
							echo '<td>' .$galdera->itemBody->p. '</td>';
							echo '<td>' .$galdera->correctResponse->value. '</td>';				
						echo '</tr>';
						$height += 50;
					}
					echo '<style> #n1,#s1 {height: '.$height.'px;}; </style>';
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