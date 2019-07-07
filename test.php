<?php

	session_start();

			require_once "connect.php";
			mysqli_report(MYSQLI_REPORT_STRICT);
			
			$user_ID=72;
					
		try 
		{
			$polaczenie = new mysqli($host, $db_user, $db_password, $db_name);
			
			if ($polaczenie->connect_errno!=0)
			{
				throw new Exception(mysqli_connect_errno());
			}
			else
			{
					$categories=$polaczenie->query("SELECT * FROM incomes_category_assigned_to_users WHERE user_id='$user_ID'");
						$row_number=$categories->num_rows;
						
						$i = 1;
						while ($i <= $row_number){
							$category_row=$categories->fetch_assoc();
							$category=$category_row['name'];
							
							echo $category;
							$i++;
						}		
			}	
		}
		catch(Exception $e)
		{
			echo '<span style="color:red;">Błąd serwera! Przepraszamy za niedogodności i prosimy o wizytę w innym terminie!</span>';
			echo '<br />Informacja developerska: '.$e;
		}	
?>