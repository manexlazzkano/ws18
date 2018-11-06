<!DOCTYPE html>
<html>
	<head>
		<title>show XML questions</title>
		<style>
			td		 {text-align: center;}
		</style>
	</head>
	
	<body>
		<?php
			$galderak = new SimpleXMLElement('../xml/questions.xml', null, true);
			echo '<table border="1" align="center">';
			echo '<tr>';
				echo '<th>Egilea</th><th>Enuntziatua</th><th>Erantzun zuzena</th>';
			echo '</tr>';
			foreach($galderak->assessmentItem as $galdera) {
				echo '<tr>';
					echo '<td>' .$galdera['author']. '</td>';
					echo '<td>' .$galdera->itemBody->p. '</td>';
					echo '<td>' .$galdera->correctResponse->value. '</td>';				
				echo '</tr>';
			}
			echo '</table>';
		?>
	</body>
</html>