<?php

	session_start();
	
	if (isset($_POST['email']))
	{
		$all_good=true;
		
		$imie = $_POST['imie'];
		
		if (!ctype_alpha($imie))
		{
				$all_good=false;
				$_SESSION['er_imie']="Imie może zawierać tylko litery (bez polskich znaków)";
		}
		
		if (strlen($imie)<1)
		{
				$all_good=false;
				$_SESSION['er_imie']="Pole Imie nie może być puste.";
		}
		
		$nazwisko = $_POST['nazwisko'];

		if (!ctype_alpha($nazwisko))
		{
				$all_good=false;
				$_SESSION['er_nazwisko']="Nazwisko może zawierać tylko litery (bez polskich znaków)";
		}
			
		if (strlen($nazwisko)<1)
		{
				$all_good=false;
				$_SESSION['er_nazwisko']="Pole Nazwisko nie może być puste.";
		}
		
		
		$login = $_POST['login'];
		
		if (!ctype_alnum($login))
		{
				$all_good=false;
				$_SESSION['er_login']="Login może składać się tylko z liter i cyfr (bez polskich znaków)";
		}
		
		if ((strlen($login)<5) || (strlen($login)>15))
		{
				$all_good=false;
				$_SESSION['er_login']="Login musi posiadać od 5 do 15 znaków.";
		}
		
		$email = $_POST['email'];
		$emailB = filter_var($email, FILTER_SANITIZE_EMAIL);
		
		if (!(filter_var($emailB, FILTER_VALIDATE_EMAIL)) || ($emailB!=$email))
		{
				$all_good=false;
				$_SESSION['er_email']="Składnia podanego adres e-mail jest nieprawidłowa.";
		}
		
		$haslo1 = $_POST['haslo1'];
		$haslo2 = $_POST['haslo2'];
		
		if ((strlen($haslo1)<5) || (strlen($haslo1)>15))
		{
				$all_good=false;
				$_SESSION['er_haslo']="Hasło musi posiadać od 5 do 15 znaków.";
		}
		
		if ($haslo1!=$haslo2)
		{
				$all_good=false;
				$_SESSION['er_haslo']="Powtórzone hasło różni się od podanego.";
		}	
		
		$kodp = $_POST['kodp'];
		$kodp_less = str_replace('-', '', $kodp);
		
		if (!(ctype_digit($kodp_less)) || ((strlen($kodp_less)!=5)))
		{
				$all_good=false;
				$_SESSION['er_kodp']="Podany kod pocztowy jest nieprawidłowy.";
		}
		
		if (strlen($kodp)<1)
		{
				$all_good=false;
				$_SESSION['er_kodp']="Pole Kod Pocztowy nie może być puste.";
		}
		
		
		$adres = $_POST['adres'];
		
		if (!ctype_alnum(str_replace(' ', '', $adres)))
		{
				$all_good=false;
				$_SESSION['er_adres']="Adres może składać się tylko z liter i cyfr (bez polskich znaków).";
		}
		
		if (strlen($adres)<1)
		{
				$all_good=false;
				$_SESSION['er_adres']="Pole Adres nie może być puste.";
		}
		
		if (!isset($_POST['regulamin']))
		{
			$all_good=false;
			$_SESSION['er_regulamin']="Pole wymagane.";
		}
		
		require_once "connect.php";
		mysqli_report(MYSQLI_REPORT_STRICT);
		
		try 
		{
				$connect = new mysqli($host, $db_user, $db_password, $db_name);
			
				$result = $connect->query("SELECT id FROM users WHERE email='$email'");
				if (!$result) throw new Exception($connect->error);
				if($result->num_rows > 0)
				{
						$all_good=false;
						$_SESSION['er_email']="Wpisany adres e-mail jest już w użyciu.";
				}	
			
			
				$result = $connect->query("SELECT id FROM users WHERE login='$login'");
				if (!$result) throw new Exception($connect->error);
				if($result->num_rows > 0)
				{
						$all_good=false;
						$_SESSION['er_login']="Wpisany login jest już w użyciu.";
				}
				
				if ($all_good==true)
				{
					if ($connect->query("INSERT INTO users VALUES (NULL, '$imie', '$nazwisko', '$login', '$haslo1', '$email','$kodp', '$adres')"))
					{
							$_SESSION['success']=true;
							$_SESSION['imie']=$imie;
							$_SESSION['nazwisko']=$nazwisko;
							$_SESSION['login']=$login;
							$_SESSION['haslo']=$haslo1;
							$_SESSION['email']=$email;
							$_SESSION['kodp']=$kodp;
							$_SESSION['adres']=$adres;
							header('Location: success_reg.php');
					}
					else
					{
							throw new Exception($connect->error);
					}
			}
			$connect->close();
		}
		
		catch(Exception $er)
		{
				echo '<div class="error">Wystapił nieoczekiwany błąd. Spróbuj ponownie.</div>';
		}
	}
?>

<!DOCTYPE HTML>
<html lang="pl">
<head>
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<title>Rejestracja.</title>
	
	<link rel="stylesheet" href="style.css">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
	
</head>

<body style="color:white; background-color:#303230;">

    <div class="container" style="width: 80%; ">
	
        <h2><a style="color:white"" href="shop.php">Sklep internetowy</a></h2>
			
					<h3 style="color:white">Zarejestruj się:</h3>
	
	<form method="post">
	
		Imie: <br /> <input type="text" name="imie" id="imie" />
		<?php
			if (isset($_SESSION['er_imie']))
			{
				echo '<div class="error">'.$_SESSION['er_imie'].'</div>';
				unset($_SESSION['er_imie']);
			}
		?>
		</br>
		
		Nazwisko: <br /> <input type="text" name="nazwisko" id="nazwisko"/>
		<?php
			if (isset($_SESSION['er_nazwisko']))
			{
				echo '<div class="error">'.$_SESSION['er_nazwisko'].'</div>';
				unset($_SESSION['er_nazwisko']);
			}
		?>
		</br>
		
		Login: <br /> <input type="text" name="login" id="login"/>
		<?php
			if (isset($_SESSION['er_login']))
			{
				echo '<div class="error">'.$_SESSION['er_login'].'</div>';
				unset($_SESSION['er_login']);
			}
		?>
		<br />
		
		Hasło: <br /> <input type="password"   name="haslo1"  id="haslo"/>
		<?php
			if (isset($_SESSION['er_haslo']))
			{
				echo '<div class="error">'.$_SESSION['er_haslo'].'</div>';
				unset($_SESSION['er_haslo']);
			}
		?>		
		<br />
		
		Powtórz hasło: <br /> <input type="password"  name="haslo2" /><br />	
		
		Email: <br /> <input type="text" name="email" />
		<?php
			if (isset($_SESSION['er_email']))
			{
				echo '<div class="error">'.$_SESSION['er_email'].'</div>';
				unset($_SESSION['er_email']);
			}
		?>
		<br />
		
		Kod pocztowy: <br /> <input type="text" name="kodp"  id="kodp"/>
		<?php
			if (isset($_SESSION['er_kodp']))
			{
				echo '<div class="error">'.$_SESSION['er_kodp'].'</div>';
				unset($_SESSION['er_kodp']);
			}
		?>
		<br />
		
		Adres: <br /> <input type="text" name="adres" id="adres" />
		<?php
			if (isset($_SESSION['er_adres']))
			{
				echo '<div class="error">'.$_SESSION['er_adres'].'</div>';
				unset($_SESSION['er_adres']);
			}
		?>
		<br />
		
		<label><input type="checkbox" name="regulamin"> Akceptuję <a href="#">regulamin</a>
		</label>
		<?php
			if (isset($_SESSION['er_regulamin']))
			{
				echo '<div class="error">'.$_SESSION['er_regulamin'].'</div>';
				unset($_SESSION['er_regulamin']);
			}
		?>	
		<br/><br/>
		
		<input type="submit" name="zarejestruj" 
				style="background-color: #117864; border: 5px solid #566573" class="btn btn-success" 
				value="Zarejestruj się">
				
	</form>
	
		<br/><br/>
		<h3 style="color:white">Masz już konto?</h3>
		<form action="login.php">
				<input type="submit" name="zaloguj" 
				style="background-color: #117864; border: 5px solid #566573" class="btn btn-success" 
				value="Zaloguj się">
		</form>
	
	</div>

</body>
</html>


