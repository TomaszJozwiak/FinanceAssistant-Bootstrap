<?php

	session_start();
	
	if ((isset($_SESSION['loged_in'])) && ($_SESSION['loged_in']==true))
	{
		header('Location: homepage.php');
		exit();
	}

?>


<!DOCTYPE html>
<html lang="en">
	<head>
	
	  <title>Finance Assistant</title>
	  <meta charset="utf-8">
	  <meta name="viewport" content="width=device-width, initial-scale=1">
	  <meta name="description" content="Web application that will help you plan your home budget">
	  <meta name="keywords" content="finance, assistant, help, home, budget, money, save">
	  <meta name="author" content="Tomasz Jóźwiak">
	  
	  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
	  <link rel="stylesheet" href="main.css">
	  
	  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
	  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
	  <link href="https://fonts.googleapis.com/css?family=Ubuntu:300i,400,700" rel="stylesheet">
	    
	</head>

	<body>
	
		<header>
			<div class="jumbotron">
				<h1><b><a href="index.php"> <img src="img/saving-pig.png"  width="100w"height="100vw" alt="brand-pig" >  FINANCE ASSISTANT </b><i><p>Twoj domowy doradca oszczędzania</p></i></a></h1> 
			</div>
			
			<nav class="navbar">
				<div class="container-fluid">
					<div class="navbar-header">
						<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#mainmenu">
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>                        
						</button>
					</div>
				</div>
				<div class="collapse navbar-collapse" id="mainmenu">
					<ul class="nav nav-pills navbar-center">
						<li><a href="login.php"><span class="glyphicon glyphicon-log-in"></span> Logowanie </a></li>
						<li><a href="registration.php"><span class="glyphicon glyphicon-hand-right"></span> Rejestracja</a></li>
					</ul>
				</div>
			</nav>
		</header>
	  
		 <main>
			<div class="container">    
				<div class="row text-center">
					<div class="col-sm-5 col-sm-offset-1"> 
						<h1><b>Witaj w aplikacji Finance Assistant</b></h1><br/>
							
						<p class="text-justify">Czy miałeś/aś kiedyś problem z planowaniem swoich wydatków? Ciekawi Cię, na co wydajesz najwięcej? Chcesz zwiększyć efektywność oszczędzania? Dzięki aplikacji Finance Assistant zaplanujesz swój budżet dużo wygodniej! Sprawdzaj swoje przychody i wydatki! Porównaj bilans z ostatniego miesiąca, roku lub dowlonego okresu! Zacznij oszczędzać dzięki aplikacji Finance Assistant i zmień swoje życie na lepsze!</p>
								
						<p class="text-justify">Aby rozpocząć pracę z aplikacją, należy się najpierw zalogować. Jeśli nie masz jeszcze konta zapraszam do rejestracji.</p>
					</div>
					<div class="col-sm-5"> 
						<img src="img/swinka2.jpg" width="100%"height="100%" class="img-fluid" alt="pig">
						<b>Nie masz jeszcze konta?</b> 
						<a href="registration.php" class="nounderline"><button type="button" class="btn btn-warning btn-block custom-btn"><b><span class="glyphicon glyphicon-hand-right"></span> Rejestracja</b></button></a>
						<br/>
						<b>Posiadasz konto?</b>
						<a href="login.php" class="nounderline"><button type="button" class="btn btn-warning btn-block custom-btn"><b> <span class="glyphicon glyphicon-log-in"></span> Logowanie</b></button></a>
					</div>
				</div>
			</div>
		</main>

		<script src="finance_assistant.js"></script>
	</body>
</html>