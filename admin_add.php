<?php

	session_start();
	
	if($_SESSION['login']!='admin')
		header('Location: shop.php');
	
	if (isset($_POST['nazwa']))
	{
		$all_good=true;
		
		$nazwa = $_POST['nazwa'];
				
		if (strlen($nazwa)<1)
		{
				$all_good=false;
				$_SESSION['er_nazwa']="Pole Nazwa nie może być puste.";
		}
		
		$cena = $_POST['cena'];
		
		if (!(ctype_digit($cena)))
		{
				$all_good=false;
				$_SESSION['er_cena']="Pole Cena może składać się wyłącznie z cyfr.";
		}
		
		if ($cena<=0)
		{
				$all_good=false;
				$_SESSION['er_cena']="Cena musi być większa od 0.";
		}
		
		if (strlen($cena)<1)
		{
				$all_good=false;
				$_SESSION['er_cena']="Pole Cena nie może być puste.";
		}
		
		$opis = $_POST['opis'];

		if (strlen($opis)<1)
		{
				$all_good=false;
				$_SESSION['er_opis']="Pole Opis nie może być puste.";
		}

		if(isset($_POST['upload']))
		{
			$img = 'img/'.$_FILES['image']['name'];
		}	
		
		require_once "connect.php";
		mysqli_report(MYSQLI_REPORT_STRICT);
		
		try 
		{
				$connect = new mysqli($host, $db_user, $db_password, $db_name);
			
				$result = $connect->query("SELECT id FROM produkty WHERE nazwa='$nazwa'");
				if (!$result) throw new Exception($connect->error);
				if($result->num_rows > 0)
				{
						$all_good=false;
						$_SESSION['er_nazwa']="Podany produkt jest już w bazie.";
				}	

				if ($all_good==true)
				{
					if ($connect->query("INSERT INTO produkty VALUES (NULL, '$nazwa', '$opis', '$img', '$cena')"))
					{
							echo '<script>alert("Produkt został pomyślnie dodany do systemu.")</script>';
							echo '<script>window.location="shop.php"</script>';
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
	<title>Dodaj przedmiot.</title>
	
	<link rel="stylesheet" href="style.css">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
	
</head>

<body style="color:white; background-color:#303230;">

    <div class="container" style="width: 80%; ">
	
        <h2><a style="color:white"" href="shop.php">Sklep internetowy</a></h2>
			
					<h3 style="color:white">Dodaj przedmiot:</h3>
	
	<form method="post" enctype="multipart/form-data">
	
		Nazwa: <br /> <input type="text" name="nazwa" id="nazwa" />
		<?php
			if (isset($_SESSION['er_nazwa']))
			{
				echo '<div class="error">'.$_SESSION['er_nazwa'].'</div>';
				unset($_SESSION['er_nazwa']);
			}
		?>
		</br>
		
		Opis: <br /> <input type="text" name="opis" id="opis"/>
		<?php
			if (isset($_SESSION['er_opis']))
			{
				echo '<div class="error">'.$_SESSION['er_opis'].'</div>';
				unset($_SESSION['er_opis']);
			}
		?>
		</br>
		
		Cena: <br /> <input type="text" name="cena" id="cena"/>
		<?php
			if (isset($_SESSION['er_cena']))
			{
				echo '<div class="error">'.$_SESSION['er_cena'].'</div>';
				unset($_SESSION['er_cena']);
			}
		?>
		<br />
		
		Obraz: <span style="color:red">(Należy wybrać obraz już znajdujący się w katalogu /img)</span>
			  <input type="file" name="image">
			  
		<br/><br/>
		<input type="submit" name="upload" 
				style="background-color: #117864; border: 5px solid #566573" class="btn btn-success" 
				value="Dodaj przedmiot">

	</form>
	</br></br>
				<form action="shop.php">
					<input type="submit" name="powrot" 
					style="background-color: #117864; border: 5px solid #566573" class="btn btn-success" 
					value="Wróć na stronę sklepu">
			</form>
	
	</div>

</body>
</html>


