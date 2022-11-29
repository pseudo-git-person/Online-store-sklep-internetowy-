<?php

	session_start();
	
	if (!isset($_SESSION['success']))
	{
		header('Location: register.php');
		exit();
	}
	else
	{
		unset($_SESSION['success']);
	}
	
	if (isset($_SESSION['er_imie'])) unset($_SESSION['er_imie']);
	if (isset($_SESSION['er_nazwisko'])) unset($_SESSION['er_nazwisko']);
	if (isset($_SESSION['er_login'])) unset($_SESSION['er_login']);
	if (isset($_SESSION['er_haslo'])) unset($_SESSION['er_haslo']);
	if (isset($_SESSION['er_email'])) unset($_SESSION['er_email']);
	if (isset($_SESSION['er_kodp'])) unset($_SESSION['er_kodp']);
	if (isset($_SESSION['er_adres'])) unset($_SESSION['er_adres']);
	if (isset($_SESSION['er_regulamin'])) unset($_SESSION['er_regulamin']);
	
	$imie = $_SESSION['imie'];
	$nazwisko = $_SESSION['nazwisko'];
	$login = $_SESSION['login'];
	$haslo = $_SESSION['haslo'];
	$email = $_SESSION['email'];
	$kodp = $_SESSION['kodp'];
	$adres = $_SESSION['adres'];

	
?>

<!DOCTYPE HTML>
<html lang="pl">
<head>
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<title>Pomyślna rejestracja.</title>
	
	<link rel="stylesheet" href="style.css">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
	
</head>

<body style="background-color:#303230;">
   <div class="container" style="width: 80%; ">
        <h2><a style="color:white"" href="shop.php">Sklep internetowy</a></h2>
		<h3 style="color:white">Rejestracja zakończona sukcesem.</br></br>Twoje dane:</h3>
		<div class="table-responsive">
            <table style="color:black" class="table table-bordered">
				<tr>
					<td>Imię:</td><td><?php echo $imie ?></td>
				</tr>
				<tr>
				   <td>Nazwisko:</td><td><?php echo $nazwisko ?></td>
				</tr>
				<tr>
					<td>Login:</td><td><?php echo $login ?></td>
				</tr>
				<tr>
					<td>e-mail:</td><td><?php echo $email ?></td>
				</tr>
				<tr>
					<td>Kod pocztowy:</td><td><?php echo $kodp ?></td>
				</tr>
				<tr>
					<td>Adres:</td><td><?php echo $adres ?></td>
				</tr>
			</table>
			
			<h3 style="color:white">Możesz teraz zalogować się na swoje konto.</h3>
			<form action="login.php">
					<input type="submit" name="login" 
					style="float: left; background-color: #117864; border: 5px solid #566573" class="btn btn-success" 
					value="Zaloguj się">
			</form>
			</br></br>
			
			<h3 style="color:white">Lub wrócić na stronę sklepu:</h3>
			<form action="shop.php">
					<input type="submit" name="powrot" 
					style="background-color: #117864; border: 5px solid #566573" class="btn btn-success" 
					value="Wróć na stronę sklepu">
			</form>

	
	</form>
	</div>
	</div>
</body>
</html>