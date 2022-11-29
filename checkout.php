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
		        <h3 style="color:white">Podsumowanie zamówienia:</h3>
		
        <div class="table-responsive">
            <table class="table table-bordered">
            <tr>
                <th style="text-align:center;" width="40%">Nazwa</th>
                <th style="text-align:center;" width="10%">Ilość</th>
                <th style="text-align:center;" width="25%">Cena za sztukę </th>
                <th style="text-align:center;" width="25%">Cena razem</th>
            </tr>

            <?php
                if(!empty($_SESSION["koszyk"])){
                    foreach ($_SESSION["koszyk"] as $key => $value) {
                        ?>
                        <tr>
                            <td><?php echo $value["produkt_nazwa"]; ?></td>
                            <td><?php echo $value["produkt_ilosc"]; ?> szt.</td>
                            <td><?php echo number_format($value["produkt_cena"],2); ?> zł</td>
                            <td><?php echo number_format($value["produkt_ilosc"] * $value["produkt_cena"], 2); ?> zł</td>
                        </tr>
                        <?php
                        $sum=$_SESSION['sum'];
                    }
                        ?>
                        <tr>
                            <td colspan="3" align="right">W sumie</td>
                            <th style="text-align:center;"><?php echo number_format($sum, 2); ?> zł</th>
                        </tr>
                        <?php
                    }
                ?>
            </table>
			
		<?php
		if (isset($_SESSION["zalogowany"]))
		{
		?>
			<form action="thank_you.php">
					<input type="submit" name="thankyou" 
					style="float: right; background-color: #117864; border: 5px solid #566573" class="btn btn-success" 
					value="Złóż zamówienie">
			</form>
		<?php
		}
		else
		{
		?>
		<h3 style="color:white">Załóż konto, aby móc dokończyć składanie zamówienia.</h3>
		<form action="register.php">
				<input type="submit" name="zarejestruj" 
						style="background-color: #117864; border: 5px solid #566573" class="btn btn-success" 
						value="Zarejestruj się">
		</form>
		<h3 style="color:white">Masz już konto? Zaloguj się.</h3>
		<form action="login.php">
				<input type="submit" name="zarejestruj" 
						style="background-color: #117864; border: 5px solid #566573" class="btn btn-success" 
						value="Zaloguj się">
		</form>
		<?php
		}
		?>
			
			
        </div>

    </div>


</body>
</html>