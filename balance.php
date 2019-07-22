<?php

	session_start();
	
	if (!isset($_SESSION['zalogowany']))
	{
		header('Location: index.php');
		exit();
	}
	
?>

<!DOCTYPE html>
<html lang="en">
	<head>
	
	  <title>Bootstrap Example</title>
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
						<li><a href="homepage.php"><span class="glyphicon glyphicon-home"></span> Strona główna </a></li>
						<li><a href="income.php"><span class="glyphicon glyphicon-plus"></span> Dodaj przychód </a></li>
						<li><a href="expense.php"><span class="glyphicon glyphicon-minus"></span> Dodaj wydatek </a></li>
						<li><a href="balance.php"><span class="glyphicon glyphicon-stats"></span> Przeglądaj bilans </a></li>
						<li><a href="settings.php"><span class="glyphicon glyphicon-wrench"></span> Ustawienia </a></li>
						<li><a href="index.php"><span class="glyphicon glyphicon-log-out"></span> Wyloguj</a></li>
					</ul>
				</div>
			</nav>
		</header>
	  
		 <main>
			<div class="container"> 
				<article>			
					<div class="row text-center">
						<div class="col-sm-8 col-sm-offset-2"> 
							<h1><b>Bilans</b></h1></br>
							
							<div class="row income">
								
								<div class="col-sm-1" style="margin-top: 20px;">
									<div style="font-size: 40px;"><span class="glyphicon glyphicon-plus"></span></div>
								</div>
											
								<div class="col-sm-2" style="margin-top: 27px;">
									<div style="font-size: 25px;"><b>5000.00</b></div>
								</div> 
								
								<div class="col-sm-6">
									<div  style="font-size: 25px; margin-top: 15px;"><b>Wynagrodzenie</b></div>
									<div  style="font-size: 15px; margin-top: 5px;">Za sprzedanie szafy</div>
								</div> 
								
								<div class="col-sm-2" style="margin-top: 30px;">
									<div>01.02.2019</div>
								</div> 
								
								<div class="col-sm-1" style="margin-top: 15px;">
									<span class="glyphicon glyphicon-pencil"></span>
									<span class="glyphicon glyphicon-trash"></span>
								</div>
							
							</div>	
							
							<div class="row expense">
								
								<div class="col-sm-1" style="margin-top: 20px;">
									<div style="font-size: 40px;"><span class="glyphicon glyphicon-minus"></span></div>
								</div>
											
								<div class="col-sm-2" style="margin-top: 27px;">
									<div style="font-size: 25px;"><b>69.00</b></div>
								</div> 
								
								<div class="col-sm-6">
									<div  style="font-size: 25px; margin-top: 15px;"><b>Zakupy Kaśki</b></div>
									<div  style="font-size: 15px; margin-top: 5px;">Kupno sukienek w H & M</div>
								</div> 
								
								<div class="col-sm-2" style="margin-top: 30px;">
									<div>01.02.2019</div>
								</div> 
								
								<div class="col-sm-1" style="margin-top: 15px;">
									<span class="glyphicon glyphicon-pencil"></span>
									<span class="glyphicon glyphicon-trash"></span>
								</div>
							
							</div>
		
						</div> 
					
					</article>
				</div>
			</main>

		<script src="finance_assistant.js"></script>
	</body>
</html>