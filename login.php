<?php
	session_start();
?>

<!DOCTYPE HTML>
<html lang="pl">
<head>
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<title>Logowanie</title>
	
	<link rel="stylesheet" href="style.css">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
	
</head>

<body style="background-color:#303230;">
   <div class="container" style="width: 80%; ">
        <h2><a style="color:white"" href="shop.php">Sklep internetowy</a></h2>
		<h3 style="color:white">Zaloguj się:</h3>
	
	<form action="login_process.php" method="post">
		<span style="color:white">Login: </span><br /> <input type="text" name="login" /> <br />
		<span style="color:white">Hasło: </span><br /> <input type="password" name="haslo" /> <br /><br />
		<?php
		if(isset($_SESSION['error']))	echo $_SESSION['error'];
		?>
		<input type="submit"
		style="background-color: #117864; border: 5px solid #566573" class="btn btn-success" 
		value="Zaloguj się">
	</form>
	
			</br>
			<h3 style="color:white">Nie masz konta?</h3>
			<form action="register.php">
					<input type="submit" name="register" 
					style="background-color: #117864; border: 5px solid #566573" class="btn btn-success" 
					value="Zarejestruj się">
			</form>
		</br><h3 style="color:white">Lub</h3></br>
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
