<?php

	session_start();
	$_SESSION['zalogowany'] = false;
	require_once "connect.php";

	$connect = @new mysqli($host, $db_user, $db_password, $db_name);

		$login = $_POST['login'];
		$haslo = $_POST['haslo'];
		
		$login = htmlentities($login, ENT_QUOTES, "UTF-8");
		
		$sql = "SELECT * FROM users WHERE login='$login' AND haslo='$haslo'";
		$result = mysqli_query($connect, $sql);
		
			if(mysqli_num_rows($result) === 1)
			{
				$row = mysqli_fetch_assoc($result);
				
				if ($row['login'] === $login && $row['haslo'] === $haslo)
				{
					$_SESSION['zalogowany'] = true;
					$_SESSION['id'] = $row['id'];
					$_SESSION['imie'] = $row['imie'];
					$_SESSION['nazwisko'] = $row['nazwisko'];
					$_SESSION['login'] = $row['login'];
					$_SESSION['email'] = $row['email'];
					$_SESSION['kodp'] = $row['kodp'];
					$_SESSION['adres'] = $row['adres'];
					
					unset($_SESSION['error']);
					$result->free_result();
					header('Location: shop.php');
				}
				else 
				{
					$_SESSION['error'] = '<div class="error">Nieprawidłowy login lub hasło!</div>';
					header('Location: login.php');
				}
				
			} 
			else 
			{
				
					$_SESSION['error'] = '<div class="error">Nieprawidłowy login lub hasło!</div>';
					header('Location: login.php');
				
			}
			
		
		
		$connect->close();
	
	
?>

