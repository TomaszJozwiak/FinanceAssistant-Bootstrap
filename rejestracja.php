<?php

	session_start();
	
	if (isset($_POST['email']))
	{
		$wszystko_OK=true;
		
		$name = $_POST['name'];
		
		$email = $_POST['email'];
		$emailB = filter_var($email, FILTER_SANITIZE_EMAIL);
		
		if ((filter_var($emailB, FILTER_VALIDATE_EMAIL)==false) || ($emailB!=$email))
		{
			$wszystko_OK=false;
			$_SESSION['e_email']="Podaj poprawny adres e-mail!";
		}
		
		$password = $_POST['password'];
		$repassword = $_POST['repassword'];
		
		if ((strlen($password)<6) || (strlen($password)>20))
		{
			$wszystko_OK=false;
			$_SESSION['e_password']="Hasło musi posiadać od 6 do 20 znaków!";
		}
		
		if ($password!=$repassword)
		{
			$wszystko_OK=false;
			$_SESSION['e_password']="Podane hasła nie są identyczne!";
		}	

		$password_hash = password_hash($password, PASSWORD_DEFAULT);
	
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
				$rezultat = $polaczenie->query("SELECT id FROM users WHERE email='$email'");
				
				if (!$rezultat) throw new Exception($polaczenie->error);
				
				$ile_takich_maili = $rezultat->num_rows;
				if($ile_takich_maili>0)
				{
					$wszystko_OK=false;
					$_SESSION['e_email']="Istnieje już konto przypisane do tego adresu e-mail!";
				}		

				if ($wszystko_OK==true)
				{
					
					if ($polaczenie->query("INSERT INTO users VALUES (NULL, '$name', '$password_hash', '$email')"))
					{


						$user_ID_query=$polaczenie->query("SELECT * FROM users WHERE email='$email'");
						$user_ID_row=$user_ID_query->fetch_assoc();
						$user_ID=$user_ID_row['id'];
						$categories=$polaczenie->query("SELECT * FROM expenses_category_default");
						$row_number=$categories->num_rows;
						

						
						$i = 1;
						while ($i <= $row_number){
							$category_name_query=$polaczenie->query("SELECT name FROM expenses_category_default WHERE id=$i");
							$category_row=$category_name_query->fetch_assoc();
							$category=$category_row['name'];
							
							$polaczenie->query("INSERT INTO expenses_category_assigned_to_users VALUES (NULL, '$user_ID', '$category')");
							$i++;
						}		

						$incomes_category=$polaczenie->query("SELECT * FROM incomes_category_default");
						$row_number=$incomes_category->num_rows;
						
						$i = 1;
						while ($i <= $row_number){
							$category_name_query=$polaczenie->query("SELECT name FROM incomes_category_default WHERE id=$i");
							$category_row=$category_name_query->fetch_assoc();
							$category=$category_row['name'];
							
							$polaczenie->query("INSERT INTO incomes_category_assigned_to_users VALUES (NULL, '$user_ID', '$category')");
							$i++;
						}
						
						$payment_method=$polaczenie->query("SELECT * FROM payment_methods_default");
						$row_number=$payment_method->num_rows;
						
						$i = 1;
						while ($i <= $row_number){
							$method_name_query=$polaczenie->query("SELECT name FROM payment_methods_default WHERE id=$i");
							$method_row=$method_name_query->fetch_assoc();
							$method=$method_row['name'];
							
							$polaczenie->query("INSERT INTO payment_methods_assigned_to_users VALUES (NULL, '$user_ID', '$method')");
							$i++;
						}
						
						
						$_SESSION['udanarejestracja']=true;
						header('Location: logowanie.php');
					}
					else
					{
						throw new Exception($polaczenie->error);
					}
					
				}
				$polaczenie->close();
			}
		}
		catch(Exception $e)
		{
			echo '<span style="color:red;">Błąd serwera! Przepraszamy za niedogodności i prosimy o rejestrację w innym terminie!</span>';
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
								<h1><b>Rejestracja</b></h1>	
													
								<p>Wpisz poniższe dane, aby się zarejestrować</p></br>
								
									<form method="post">
										
										<div class="form-group">
											<label for="name">Imię:</label>
											<div class="input-group">
												<span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
												<input id="text" type="text" class="form-control" name="name" placeholder="Imię">
											 </div>
										</div>
										<div class="form-group">
											<label for="email">Email:
												<?php
													if (isset($_SESSION['e_email']))
														{
															echo '<div style="color: red;">'.$_SESSION['e_email'].'</div>';
															unset($_SESSION['e_email']);
														}
												?></label>
											<div class="input-group">
												<span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
												<input id="email" type="text" class="form-control" name="email" placeholder="Email">
											 </div>
										</div>
										<div class="form-group">
											 <label for="password">Hasło:
											 <?php
													if (isset($_SESSION['e_password']))
														{
															echo '<div style="color: red;">'.$_SESSION['e_password'].'</div>';
															unset($_SESSION['e_password']);
														}
												?>		
											 </label>
												<div class="input-group">
													<span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
													<input id="password" type="password" class="form-control" name="password" placeholder="Hasło">
												</div>
										</div>
										<div class="form-group">
											 <label for="repassword">Powtórz hasło:</label>
												<div class="input-group">
													<span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
													<input id="password" type="password" class="form-control" name="repassword" placeholder="Powtórz hasło">
												</div>
										</div></br>
														
										<div class="form-group row d-inline-block">
											<div class="col-sm-6">
												<button type="submit" class="btn btn-success btn-block"><b><span class="glyphicon glyphicon-ok"></span> Zarejestruj</b></button>
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