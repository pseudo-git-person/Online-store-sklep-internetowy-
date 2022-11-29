 <?php
 session_start();
  ?>

<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sklep internetowy</title>

	<link rel="stylesheet" href="style.css">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
</head>
<body style="background-color:#303230;">

    <div class="container" style="width: 80%">
	
		<?php
		if (isset($_SESSION["zalogowany"]))
		{
		?><span style="float:right; color:white">Zalgowany jako: <?php echo $_SESSION['login']; ?></span><div style="clear:both"></div>
		<?php
		}
		?>
	
         <h2><a style="color:white"" href="shop.php">Sklep internetowy</a></h2>
				
				 <?php
		require_once "connect.php";
		mysqli_report(MYSQLI_REPORT_STRICT);
		
		try 
		{
				$connect = new mysqli($host, $db_user, $db_password, $db_name);
				foreach ($_SESSION["koszyk"] as $keys => $value)
				{
					$user_id = $_SESSION['id'];
					$prod_id = $value["produkt_id"];
					$ilosc = $value["produkt_ilosc"];
					$czas =  $_SERVER['REQUEST_TIME'] ;
					$czas = date("y-m-d G:i:s", $czas);
					if ($connect->query("INSERT INTO orders VALUES (NULL, '$user_id', '$prod_id', '$ilosc', '$czas')"))
					{
							$sql_succ = true;
					}
					else
					{
							throw new Exception($connect->error);
					}

				}
		}
		catch(Exception $er)
		{
			echo $connect->error;
		}
	

				 $message=
				 "
				<html>
				<head>
				<style>
				table, tr, th, td 
				{
				border: 1px solid;
				text-align: center;
				color: black;
				}
				h2
				{
				color: black;
				}
				</style>
				<title>HTML email</title>
				</head>
				<body>
				<h2>Zamowienie:</h2>
				<table>
				<tr>
					<th width='50%'>Produkt</th>
					<th width='10%'>Ilość</th>
					<th width='20%'>Cena za sztukę</th>
					<th width='20%'>Cena razem</th>
				</tr>
				";
				
				foreach ($_SESSION["koszyk"] as $keys => $value)
							{
								$message = $message.
								"
								<tr>
									<td>".$value["produkt_nazwa"]."</td>
									<td>".$value["produkt_ilosc"]." szt.</td>
									<td>".$value["produkt_cena"]."  zł</td>
									<td>".$value["produkt_cena"]*$value["produkt_ilosc"]." zł</td>
								</tr>
								";
							}
				$message = $message.
				"
				<tr>
				<th colspan='3' style='text-align:right;'>W sumie</th>
				<th style='text-align:center;'>".$_SESSION['sum']." zł</th>
				</tr>
				</table>
				
				<br/>
				<h2>Zaadresowane do:</h2>
				<table style='width:400px'>
					<tr>
						<td>Imię:</td><td>".$_SESSION['imie']."</td>
					</tr>
					<tr>
					   <td>Nazwisko:</td><td>".$_SESSION['nazwisko']."</td>
					</tr>
					<tr>
						<td>e-mail:</td><td>".$_SESSION['email']."</td>
					</tr>
					<tr>
						<td>Kod pocztowy:</td>".$_SESSION['kodp']."</td>
					</tr>
					<tr>
						<td>Adres:</td><td>".$_SESSION['adres']."</td>
					</tr>
				</table>
				
				
				</body>
				</html>
				";
    
				require 'phpmailer/PHPMailer.php';
				require 'phpmailer/SMTP.php';
				require 'phpmailer/Exception.php';
				use PHPMailer\PHPMailer\PHPMailer;
				use PHPMailer\PHPMailer\SMTP;
				use PHPMailer\PHPMailer\Exception;
				$mail = new PHPMailer();
				$mail->Host = "smtp.gmail.com";
				$mail->SMTPAuth = true;
				$mail->SMTPSecure = "tls";
				$mail->Port = "587";
				$mail->Username = <your email address>
				$mail->Password = <email password>;
				$mail->Subject = "Zamowienie";
				$mail->setFrom('sklep.internetowy.php@gmail.com');
				$mail->isHTML(true);
				$mail->Body = $message;
				$mail->addAddress('p.krajenta@gmail.com');
				if ( $mail->send() && $sql_succ==true) 
				{
					echo "<h3 style='color:white'>Dziękujemy. Twoje zamówienie zostało przekazane do realizacji.</h3>";
					        foreach ($_SESSION["koszyk"] as $keys => $value)
							{
								unset($_SESSION["koszyk"][$keys]);
							}
				}
				else
				{
					echo "<h3 style='color:white'>Przepraszamy. Zamówienie nie mogło zostać przesłane. Spróbuj ponownie później.</h3>";
				}
				$mail->smtpClose();
				
				?>

				<form action="shop.php">
					<input type="submit" name="powrot" 
					style="background-color: #117864; border: 5px solid #566573" class="btn btn-success" 
					value="Wróć na stronę sklepu">
			</form>
			
			
		
    </div>


</body>
</html>