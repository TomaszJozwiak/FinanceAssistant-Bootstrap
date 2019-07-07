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
				<div class="row text-center">
					<div class="col-sm-6 col-sm-offset-3"> 
						<article>
							<h1><b>Dodaj wydatek</b></h1>	
												
							<p>Wpisz poniższe dane, aby dodać wydatek</p></br>
													
								<div class="form-group">
									<label for="kwota">Kwota:</label>
									<div class="input-group">
										<span class="input-group-addon"><i class="glyphicon glyphicon-usd"></i></span>
										<input id="kwota" type="number" class="form-control" name="kwota" placeholder="Kwota">
									 </div>
								</div>
								<div class="form-group">
									 <label for="data">Data:</label>
										<div class="input-group">
											<span class="input-group-addon"><i class="glyphicon glyphicon-hourglass"></i></span>
											<input id="data" type="date" class="form-control" name="data" placeholder="Data">
										</div>
								</div>
								
								<div class="form-group">
									<label for="payment_method">Metoda płatności:</label>
									
									<?php
									require_once "connect.php";
									mysqli_report(MYSQLI_REPORT_STRICT);
									
									try 
									{
										$polaczenie = new mysqli($host, $db_user, $db_password, $db_name);
										$polaczenie->set_charset("utf8");
										if ($polaczenie->connect_errno!=0)
										{
											throw new Exception(mysqli_connect_errno());
										}
										else
										{
											
											$user_ID=$_SESSION['logged_user_ID'];
											
											$method_name_query=$polaczenie->query("SELECT name FROM payment_methods_assigned_to_users WHERE user_id='$user_ID'");
											$row_number=$method_name_query->num_rows;
											
											$i = 1;
											while ($i <= $row_number){
												$method_row=$method_name_query->fetch_assoc();
												$method=$method_row['name'];
												
												echo '<div class="radio">
														<label><input type="radio" value="1" name="payment_method">'.$method.'</label>
														</div>';
												
												$i++;
												}		
										}
									}
									catch(Exception $e)
									{
										echo '<span style="color:red;">Błąd serwera! Przepraszamy za niedogodności i prosimy o rejestrację w innym terminie!</span>';
										echo '<br />Informacja developerska: '.$e;
									}
									?>
								</div>
								
								<div class="form-group">
									<label for="selection_expense">Kategoria:</label>
									<select class="form-control" id="selection_expense">
									
									<?php	
									try 
									{
										if ($polaczenie->connect_errno!=0)
										{
											throw new Exception(mysqli_connect_errno());
										}
										else
										{
											$cathegory_name_query=$polaczenie->query("SELECT name FROM expenses_category_assigned_to_users WHERE user_id='$user_ID'");
											$row_number=$cathegory_name_query->num_rows;
											
											$i = 1;
											while ($i <= $row_number){
												$cathegory_row=$cathegory_name_query->fetch_assoc();
												$cathegory=$cathegory_row['name'];
												
												echo '<option>'.$cathegory.'</option>';
												
												$i++;
												}		
										}
									}
									catch(Exception $e)
									{
										echo '<span style="color:red;">Błąd serwera! Przepraszamy za niedogodności i prosimy o rejestrację w innym terminie!</span>';
										echo '<br />Informacja developerska: '.$e;
									}
									?>
									
									</select>
								</div>
							
								<div class="form-group">
									<label for="comment">Komentarz:</label>
									<textarea class="form-control" rows="3" id="comment"></textarea>
								</div>
												
								<div class="form-group row d-inline-block">
									<div class="col-sm-6">
										<button type="button" class="btn btn-success btn-block"><b><span class="glyphicon glyphicon-ok"></span> Dodaj</b></button>
									</div>
									<div class="col-sm-6">
										<button type="button" class="btn btn-danger btn-block"><b><span class="glyphicon glyphicon-remove"></span> Cancel</b></button>
									</div>
								</div>
														
						</article>
					</div>
				</div>
			</div>
		</main>

		<script src="finance_assistant.js"></script>
	</body>
</html>