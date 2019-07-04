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
						<li><a href="income.html"><span class="glyphicon glyphicon-plus"></span> Dodaj przychód </a></li>
						<li><a href="expense.html"><span class="glyphicon glyphicon-minus"></span> Dodaj wydatek </a></li>
						<li><a href="balance.html"><span class="glyphicon glyphicon-stats"></span> Przeglądaj bilans </a></li>
						<li><a href="settings.html"><span class="glyphicon glyphicon-wrench"></span> Ustawienia </a></li>
						<li><a href="index.html"><span class="glyphicon glyphicon-log-out"></span> Wyloguj</a></li>
					</ul>
				</div>
			</nav>
		</header>
	  
		 <main>
			<div class="container">    
				<div class="row text-center">
					<div class="col-sm-5 col-sm-offset-1">
						<img src="img/money.jpg" width="100%"height="100%" class="img-fluid" style="padding-top: 20px" alt="money">
					</div>
					<div class="col-sm-5"> 

						</br><h1><b><?php		
								session_start();
							
								if (isset($_SESSION['user']))
								{
										echo 'Witaj '.$_SESSION['user'].'!';
								}
							?>
						</b></h1>
						<h1><b>Udało Ci się zalogować!</b></h1><br/><br/>
							
						<p>Teraz możesz się cieszyć z oszczędzania!</p></br>
						<p>Wybierz jedną z opcji z górnego menu</p>
								
					</div>
				</div>
			</div>
		</main>

		<script src="finance_assistant.js"></script>
	</body>
</html>