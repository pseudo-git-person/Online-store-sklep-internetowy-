<?php
    session_start();
	
	require_once "connect.php";
	
    $con = mysqli_connect($host, $db_user, $db_password, $db_name);
		
    if (isset($_POST["dodaj"]))
	{
        if (isset($_SESSION["koszyk"]))
		{
            $array_id = array_column($_SESSION["koszyk"],"produkt_id");
            if (!in_array($_GET["id"],$array_id))
			{
                $count = count($_SESSION["koszyk"]);
                $prod_array = array
				(
                    'produkt_id' => $_GET["id"],
                    'produkt_nazwa' => $_POST["hid_nazwa"],
                    'produkt_cena' => $_POST["hid_cena"],
                    'produkt_ilosc' => $_POST["ilosc"],
                );
                $_SESSION["koszyk"][$count] = $prod_array;
                echo '<script>window.location="shop.php"</script>';
            }
			else
			{
                echo '<script>alert("Produkt został już dodany do koszyka.")</script>';
                echo '<script>window.location="shop.php"</script>';
            }
        }
		else
		{
            $prod_array = array
			(
                'produkt_id' => $_GET["id"],
                'produkt_ilosc' => $_POST["ilosc"],
            );
            $_SESSION["koszyk"][0] = $prod_array;
        }
    }

    if (isset($_GET["action"]))
	{
        if ($_GET["action"] == "delete")
		{
            foreach ($_SESSION["koszyk"] as $keys => $value)
			{
                if ($value["produkt_id"] == $_GET["id"])
				{
                    unset($_SESSION["koszyk"][$keys]);
                }
            }
        }
    }
?>

<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
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
		<form action="logout.php">
			<input type="submit" name="wyloguj" 
						style="float: right; background-color: #117864; border: 5px solid #566573; margin-top:45px" class="btn btn-success" 
						value="Wyloguj się">
		</form>
		<?php
		}
		else
		{
		?>			
		<form action="register.php">
				<input type="submit" name="zarejestruj" 
						style="float: right; background-color: #117864; border: 5px solid #566573; margin-top:45px" class="btn btn-success" 
						value="Zarejestruj się">
		</form>
		
		<form action="login.php">
				<input type="submit" name="zaloguj" 
						style="float: right; background-color: #117864; border: 5px solid #566573; margin-top:45px" class="btn btn-success" 
						value="Zaloguj się">
		</form>
		<?php 
		}
		?>
		
        <h2><a style="color:white"" href="shop.php">Sklep internetowy</a></h2>
        <?php
		
            $query = "SELECT * FROM produkty ORDER BY id ASC ";
            $result = mysqli_query($con,$query);
            if(mysqli_num_rows($result) > 0) {

                while ($row = mysqli_fetch_array($result)) {

                    ?>
                    <div class="col-md-2">

                        <form method="post" action="shop.php?action=dodaj&id=<?php echo $row["id"]; ?>">

                            <div class="produkt">
									<img src="<?php echo $row["img"]; ?>" class="img-responsive">
									<h4 class="text-info"><?php echo $row["nazwa"]; ?></h4>
									<h4 class="text-danger"><?php echo number_format($row["cena"],2); echo " zł"; ?></h4>
									<h5 class="text-info" style="text-align:left;" ><?php echo $row["opis"]; ?></h5>
									Ilość sztuk:
									<input type="text" name="ilosc" class="form-control" value="1">
									<input type="hidden" name="hid_nazwa" value="<?php echo $row["nazwa"]; ?>">
									<input type="hidden" name="hid_cena" value="<?php echo $row["cena"]; ?>">
									<input type="submit" name="dodaj" 
									style="margin-top: 10px; background-color: #0063FF; border: 5px solid #AAAAAA" class="btn btn-success" 
									value="Dodaj do koszyka">
                            </div>
							
                        </form>
						
                    </div>
                    <?php
                }
            }
        ?>

        <div style="clear: both"></div>
		
		
		<?php
		if(isset($_SESSION['login']))
		if($_SESSION['login']=='admin')
		{
		?>
		<div style="margin-top:20px">
		<form action="admin_remove.php">
			<input type="submit" name="remove" 
						style="float: right; background-color: #BB2929; border: 5px solid #566573" class="btn btn-success" 
						value="Usuń produkt">
		</form>
		<form action="admin_add.php">
			<input type="submit" name="add" 
						style="float: right; background-color: #117864; border: 5px solid #566573" class="btn btn-success" 
						value="Dodaj produkt">
		</form>
		
		<?php
		}
		?>
		
	    <div style="clear: both"></div>
        <h2 class="title2">Koszyk:</h2>
        <div class="table-responsive">
            <table class="table table-bordered">
            <tr>
                <th style="text-align:center;" width="30%">Nazwa</th>
                <th style="text-align:center;" width="10%">Ilość</th>
                <th style="text-align:center;" width="25%">Cena za sztukę </th>
                <th style="text-align:center;" width="25%">Cena razem</th>
                <th style="text-align:center;" width="10%">Usuń</th>
            </tr>

            <?php
                if(!empty($_SESSION["koszyk"])){
                    $sum = 0;
                    foreach ($_SESSION["koszyk"] as $key => $value) {
                        ?>
                        <tr>
                            <td><?php echo $value["produkt_nazwa"]; ?></td>
                            <td><?php echo $value["produkt_ilosc"]; ?> szt.</td>
                            <td><?php echo number_format($value["produkt_cena"],2); ?> zł</td>
                            <td><?php echo number_format($value["produkt_ilosc"] * $value["produkt_cena"], 2); ?> zł</td>
                            <td><a href="shop.php?action=delete&id=<?php echo $value["produkt_id"]; ?>" class="btnRemoveAction"><img src="img/usun.png" alt="Usuń" /></a></td>
                        </tr>
                        <?php
                        $sum = $sum + ($value["produkt_ilosc"] * $value["produkt_cena"]);
						$_SESSION['sum'] = $sum;
                    }
                        ?>
                        <tr>
                            <td colspan="3" align="right">W sumie</td>
                            <th style="text-align:center;"><?php echo number_format($sum, 2); ?> zł</th>
                            <td></td>
                        </tr>
                        <?php
                    }
                ?>
            </table>
			
				<?php
				if (!isset($sum))
					{
						exit;
					}
					else
						{
				?>
						<form action="checkout.php">
							<input type="submit" name="checkout" 
							style="float: right; background-color: #117864; border: 5px solid #566573" class="btn btn-success" 
							value="Do kasy">
						</form>
						<?php
						}
						?>

        </div>

    </div>


</body>
</html>