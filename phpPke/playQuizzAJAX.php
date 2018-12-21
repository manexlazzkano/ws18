<?php
	if ($_POST['option'] == "onePlay") {
		echo '<script> alert("One-play"); </script>';
	}
	else if ($_POST['option'] == "playingBySubject") {
		echo '<script> alert("Playing-by-subject"); </script>';
	}
?>