<?php
	setcookie("currentUser", "", time()-4000);
	sleep(5);
	header("Location: ../index.php");
	
?>