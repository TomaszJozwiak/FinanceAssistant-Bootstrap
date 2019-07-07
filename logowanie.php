<?php

	session_start();
	
	if ((isset($_POST['email'])) || (isset($_POST['password'])))
	{
		$email = $_POST['email'];
		$password = $_POST['password'];		

		$emailB = filter_var($email, FILTER_SANITIZE_EMAIL);
		
		if ((filter_var($emailB, FILTER_VALIDATE_EMAIL)==false) || ($emailB!=$email))
		{
			$wszystko_OK=false;
			$_SESSION['e_email']="Podaj poprawny adres e-mail!";
		}

		if ((strlen($password)<6) || (strlen($password)>20))
			{
				$wszystko_OK=false;
				$_SESSION['e_password']="Hasło musi posiadać od 6 do 20 znaków!";
			}

			require_once "connect.php";
			mysqli_report(MYSQLI_REPORT_STRICT);
					
		try 
		{
			$polaczenie = new mysqli($host, $db_user, $db_password, $db_name);
			
			if ($polaczenie->connect_errno!=0)
			{
				throw new Exception(mysqli_connect_errno());
			}
			else
			{
				if ($rezultat = $polaczenie->query(
				sprintf("SELECT * FROM users WHERE email='%s'",
				mysqli_real_escape_string($polaczenie,$email))))
				{
					$users_number = $rezultat->num_rows;
					if($users_number>0)
					{
						$wiersz = $rezultat->fetch_assoc();
						
						if (password_verify($password, $wiersz['password']))
						{
							$_SESSION['zalogowany'] = true;
							$_SESSION['id'] = $wiersz['id'];
							$_SESSION['user'] = $wiersz['username'];
							$_SESSION['email'] = $wiersz['email'];
							
							$_SESSION['logged_user_ID']=$wiersz['id'];
							
							unset($_SESSION['blad']);
							$rezultat->free_result();
							header('Location: homepage.php');
						}
						else 
						{
							$_SESSION['e_password'] = 'Niepoprawne hasło';
						}
					} 
					else 
					{
						$_SESSION['e_email'] = 'Nie ma takiego użytkownika w bazie. Zarejestruj konto!';
					}
				}
				else
				{
					throw new Exception($polaczenie->error);
				}
				$polaczenie->close();
			}
		}
		catch(Exception $e)
		{
			echo '<span style="color:red;">Błąd serwera! Przepraszamy za niedogodności i prosimy o wizytę w innym terminie!</span>';
			echo '<br />Informacja developerska: '.$e;
		}
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
						<li><a href="logowanie.php"><span class="glyphicon glyphicon-log-in"></span> Logowanie </a></li>
						<li><a href="rejestracja.php"><span class="glyphicon glyphicon-hand-right"></span> Rejestracja</a></li>
					</ul>
				</div>
			</nav>
		</header>
	  
		 <main>
			<div class="container">    
				<div class="row text-center">
					<div class="col-sm-6 col-sm-offset-3"> 
						<article>
							<h1><b>Logowanie</b></h1>	
							
								<?php					
									if (isset($_SESSION['udanarejestracja']))
									{
											echo '<div style="color: limegreen;">'.'Gratulacje, rejestracja zakończyła się sukcesem'.'</div>';
											unset($_SESSION['udanarejestracja']);
									}
								?>
												
							<p>Wpisz poniższe dane, aby się zalogować</p></br>
											
							<form method="post">
											
								<div class="form-group">
									<label for="email">Email:</label>
									<div class="input-group">
										<span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
										<input id="email" type="text" class="form-control" name="email" placeholder="Email">	
									 </div>
										<?php
												if (isset($_SESSION['e_email']))
													{
														echo '<div style="color: red;">'.$_SESSION['e_email'].'</div>';
														unset($_SESSION['e_email']);
													}
											?>
								</div>
								<div class="form-group">
									<label for="password">Hasło:</label>
										<div class="input-group">
											<span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
											<input id="password" type="password" class="form-control" name="password" placeholder="Hasło">
									</div>
										 <?php
												if (isset($_SESSION['e_password']))
													{
														echo '<div style="color: red;">'.$_SESSION['e_password'].'</div>';
														unset($_SESSION['e_password']);
													}
											?>		
								</div></br>			
								<div class="form-group row d-inline-block">
									<div class="col-sm-6">
										<button type="submit" class="btn btn-success btn-block"><b><span class="glyphicon glyphicon-ok"></span> Logowanie</b></button>
									</div>
									<div class="col-sm-6">
										<button type="button" class="btn btn-danger btn-block"><b><span class="glyphicon glyphicon-remove"></span> Cancel</b></button>
									</div>
								</div>
								
							</form>
						</article>
					</div>
				</div>
			</div>
		</main>

		<script src="finance_assistant.js"></script>
	</body>
</html>
