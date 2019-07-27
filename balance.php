<?php

	session_start();
	
	if (!isset($_SESSION['zalogowany']))
	{
		header('Location: index.php');
		exit();
	}
	
	$balance = 0;
	$chosen_date="current_month";
	$data_correct=false;
	$date_period=strtotime(date("Y-m"));
	
	if (isset($_POST['date_from']) & isset($_POST['date_to']))
	{
		$date_from = strtotime(date("Y-m-d", strtotime($_POST['date_from'])));
		$date_to = strtotime(date("Y-m-d", strtotime($_POST['date_to'])));
		$_SESSION['calendar_menu']="date_period";
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
						<div class="col-sm-8 col-sm-offset-2" style="position: relative;">
						
						<div class="dropdown calendar_button text-center">
							<button class="btn btn-warning btn-block custom-btn dropdown-toggle" id="calendar_menu" type="button" data-toggle="dropdown"> 
								<span class="glyphicon glyphicon-calendar" style="font-size: 30px;"></span>
							</button>
							<div class="dropdown-menu" role="menu" aria-labelledby="calendar_menu" name="calendar_menu">
								<li role="presentation"><a role="menuitem" tabindex="-1" href="balance.php">Bieżący miesiąc</a></li>
								<li role="presentation"><a role="menuitem" tabindex="-1" href="previous_month.php">Poprzedni miesiąc</a></li>
								<li role="presentation"><a role="menuitem" tabindex="-1" href="current_year.php">Bieżący rok</a></li>
								<li role="presentation"><a role="menuitem" tabindex="-1" href="#choose_date_modal" data-toggle="modal">Wybierz okres</a></li>    
							</div>
						</div>
						
						<div class="modal fade" id="choose_date_modal" tabindex="-1" role="dialog" aria-labelledby="choose_date_label" aria-hidden="true">
							<div class="modal-dialog" role="document">
						 
								<div class="modal-content">
								
									 <div class="modal-header">
											<h2 class="modal-title" id="choose_date_label">Wybierz okres</h2>
											<button type="button" class="close" data-dismiss="modal" aria-label="Close">
												<span aria-hidden="true">&times;</span>
											</button>
									 </div>
								 
									<form method="POST" action="balance.php">
									<div class="modal-body">
									
										<div class="form-group">
											 <label for="data">Data od </label>
												<div class="input-group">
													<span class="input-group-addon"><i class="glyphicon glyphicon-hourglass"></i></span>
													<input id="date_from" type="date" class="form-control" name="date_from" placeholder="Data od">
												</div>
										</div>
										
										<div class="form-group">
											 <label for="data">Data do </label>
												<div class="input-group">
													<span class="input-group-addon"><i class="glyphicon glyphicon-hourglass"></i></span>
													<input id="date_to" type="date" class="form-control" value = "date_to" name="date_to" placeholder="Data do">
												</div>
										</div>
								  
									</div>
									<div class="modal-footer">
										<button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
										<button type="submit" class="btn btn-success">Zapisz</button>
									</div>
									</form>
								</div>
							</div>
						</div>
						
						<h1><b>Bilans </b></h1>
						<?php
							if (isset($_SESSION['calendar_menu']))
								{
									$chosen_date= $_SESSION['calendar_menu'];
								}

										
							echo "Okres: ";	
							if ($chosen_date == "current_month")
							{
								echo "Bieżący miesiąc";
							}
							else if ($chosen_date == "previous_month")
							{
								echo "Poprzedni miesiąc";
							}
							if ($chosen_date == "current_year")
							{
								echo "Bieżący rok";
							}
							if ($chosen_date == "date_period")
							{
								echo "Od ".date("d-m-Y", strtotime($_POST['date_from']))." do ".date("d-m-Y", strtotime($_POST['date_to']));
							}

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
									$date_income_query=$polaczenie->query("SELECT * FROM incomes WHERE user_id='$user_ID' ORDER BY date_of_income ASC");
									$row_number=$date_income_query->num_rows;
									
									$i = 1;
									while ($i <= $row_number)
									{
										$single_row=$date_income_query->fetch_assoc();
										$amount=$single_row['amount'];
										$category_id=$single_row['income_category_assigned_to_user_id'];
										$category_query=$polaczenie->query("SELECT name FROM incomes_category_assigned_to_users WHERE id='$category_id'");
										$single_category_row=$category_query->fetch_assoc();
										$category=$single_category_row['name'];									
										$date_of_income=$single_row['date_of_income'];
										$comment=$single_row['income_comment'];

										if ($chosen_date == "date_period")
											{
												$single_date=strtotime(date("Y-m-d", strtotime($single_row['date_of_income'])));
												if($date_from <= $single_date && $date_to >= $single_date)
												{
												$data_correct=true;
												$single_date=strtotime(date("Y-m-d", strtotime($single_row['date_of_income'])));
												}
											}	
										else
										{
											if ($chosen_date == "current_year")
												{
													$date_period=strtotime(date("Y"));
													$single_date=strtotime(date("Y", strtotime($single_row['date_of_income'])));
												}
											else if ($chosen_date == "previous_month")
												{
													$date_period=strtotime(date("Y-m")." -1 month");
													$single_date=strtotime(date("Y-m", strtotime($single_row['date_of_income'])));
												}
											else if ($chosen_date == "current_month")
												{
													$date_period=strtotime(date("Y-m"));
													$single_date=strtotime(date("Y-m", strtotime($single_row['date_of_income'])));
												}
											if($date_period == $single_date)
												$data_correct=true;
										}

										if($data_correct == true)
										{
											echo '
											<div class="row income">
												<div class="col-sm-1" style="margin-top: 20px;">
													<div style="font-size: 40px;"><span class="glyphicon glyphicon-plus"></span></div>
												</div>
															
												<div class="col-sm-2" style="margin-top: 27px;">
													<div style="font-size: 25px;"><b>'.$amount.'</b></div>
												</div>';
												
												if (!$comment=="")
												{
													echo'
												<div class="col-sm-6">
													<div  style="font-size: 22px; margin-top: 15px;"><b>'.$category.'</b></div>
													<div  style="font-size: 15px; margin-top: 5px;">'.$comment.'</div>
												</div>';
												}
												 else
												 {
													 echo'
												<div class="col-sm-6">
													<div  style="font-size: 22px; margin-top: 28px;"><b>'.$category.'</b></div>
												</div>';
												 }
												echo'
												<div class="col-sm-2" style="margin-top: 32px;">
													<div style="font-size: 18px;">'.$date_of_income.'</div>
												</div> 
												
												<div class="col-sm-1" style="margin-top: 15px;">
													<span class="glyphicon glyphicon-pencil"></span>
													<span class="glyphicon glyphicon-trash"></span>
												</div>
										
											</div>';
											
											$data_correct=false;
											$balance = $balance + $amount;
										}
									$i++;
									}	
									unset($_SESSION['calendar_menu']);
									
									$date_expense_query=$polaczenie->query("SELECT * FROM expenses WHERE user_id='$user_ID' ORDER BY date_of_expense ASC");
									$row_number=$date_expense_query->num_rows;
									
									$i = 1;
									while ($i <= $row_number)
									{
										$single_row=$date_expense_query->fetch_assoc();
										$single_date=strtotime(date("Y-m", strtotime($single_row['date_of_expense'])));
										$amount=$single_row['amount'];
										
										$category_id=$single_row['expense_category_assigned_to_user_id'];
										$category_query=$polaczenie->query("SELECT name FROM expenses_category_assigned_to_users WHERE id='$category_id'");
										$single_category_row=$category_query->fetch_assoc();
										$category=$single_category_row['name'];
										
										$payment_method_id=$single_row['payment_method_assigned_to_user_id'];
										$method_query=$polaczenie->query("SELECT name FROM payment_methods_assigned_to_users WHERE id='$payment_method_id'");
										$single_method_row=$method_query->fetch_assoc();
										$method=$single_method_row['name'];
										
										$date_of_expense=$single_row['date_of_expense'];
										$comment=$single_row['expense_comment'];
										
										
										if ($chosen_date == "date_period")
											{
												$single_date=strtotime(date("Y-m-d", strtotime($single_row['date_of_expense'])));
												if($date_from <= $single_date && $date_to >= $single_date)
												{
												$data_correct=true;
												$single_date=strtotime(date("Y-m-d", strtotime($single_row['date_of_expense'])));
												}
											}	
										else
										{
											if ($chosen_date == "current_year")
												{
													$date_period=strtotime(date("Y"));
													$single_date=strtotime(date("Y", strtotime($single_row['date_of_expense'])));
												}
											else if ($chosen_date == "previous_month")
												{
													$date_period=strtotime(date("Y-m")." -1 month");
													$single_date=strtotime(date("Y-m", strtotime($single_row['date_of_expense'])));
												}
											else if ($chosen_date == "current_month")
												{
													$date_period=strtotime(date("Y-m"));
													$single_date=strtotime(date("Y-m", strtotime($single_row['date_of_expense'])));
												}
											if($date_period == $single_date)
												$data_correct=true;
										}
										
				
										
										if($data_correct == true)
										{
											echo '
											<div class="row expense">
												<div class="col-sm-1" style="margin-top: 20px;">
													<div style="font-size: 40px;"><span class="glyphicon glyphicon-minus"></span></div>
												</div>
															
												<div class="col-sm-2" style="margin-top: 27px;">
													<div style="font-size: 25px;"><b>'.$amount.'</b></div>
												</div>';
											
											if (!$comment=="")
											{
												echo'
											
												<div class="col-sm-6">
													<div  style="font-size: 22px; margin-top: 5px;"><b>'.$category.'</b></div>
													<div style="font-size: 18px;">'.$method.'</div>
													<div  style="font-size: 12px; margin-top: 5px;">'.$comment.'</div>
												</div>';
											}
											 else
											 {
												 echo'
													<div class="col-sm-6">
													<div  style="font-size: 22px; margin-top: 10px;"><b>'.$category.'</b></div>
													<div  style="font-size: 18px; margin-top: 5px;">'.$method.'</div>
												</div>';
											 }
											echo'
												<div class="col-sm-2" style="margin-top: 32px;">
													<div style="font-size: 18px;">'.$date_of_expense.'</div>
												</div> 
												
												<div class="col-sm-1" style="margin-top: 15px;">
													<span class="glyphicon glyphicon-pencil"></span>
													<span class="glyphicon glyphicon-trash"></span>
												</div>
										
											</div>';

											$data_correct=false;
											$balance = $balance - $amount;
										}
										$i++;
									}	
									unset($_SESSION['calendar_menu']);	
								}
								
								echo "</br> Bilans za wybrany okres wynosi: <b>".$balance."</b></br>";
								if ($balance > 0)
								{
									echo '<div style="color: green; font-size: 25px;"><b>Gratulacje, świetnie zarządzasz finansami!</b></div>';
								}
								else if ($balance <= 0)
								{
									echo '<div style="color: red; font-size: 25px;"><b>Czas zacząć oszczędzać</b></div>';
								}	
								
								
							}
							catch(Exception $e)
							{
								echo '<span style="color:red;">Błąd serwera! Przepraszamy za niedogodności i prosimy o akcję w innym terminie!</span>';
								echo '<br />Informacja developerska: '.$e;
							}
							?>
					</div> 
				</article>
			</div>
		</main>

		<script src="finance_assistant.js"></script>
	</body>
</html>