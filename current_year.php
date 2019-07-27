<?php

	session_start();
	
	$_SESSION['calendar_menu'] = "current_year";
	header('Location: balance.php');
	exit();

?>