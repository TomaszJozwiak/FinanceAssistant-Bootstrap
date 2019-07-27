<?php

	session_start();
	
	$_SESSION['calendar_menu'] = "previous_month";
	header('Location: balance.php');
	exit();

?>