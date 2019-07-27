<?php

	session_start();
	
	$_SESSION['calendar_menu'] = "date_period";
	header('Location: balance.php');
	exit();

?>