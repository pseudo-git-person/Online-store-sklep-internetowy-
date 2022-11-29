<?php
    session_start();
	
	if($_SESSION['login']!='admin')
		header('Location: shop.php');
	
	require_once "connect.php";
	
    $con = mysqli_connect($host, $db_user, $db_password, $db_name);
		
    if (isset($_GET["action"]))
	{
        if ($_GET["action"] == "delete")
		{
			$id=$_GET["id"];
			$sql1="DELETE FROM orders WHERE prod_id=$id"; 
			$sql2="DELETE FROM produkty WHERE id=$id"; 
			$con->query($sql1);
			if ($con->query($sql2)===TRUE)
			{
			  echo '<script>alert("Produkt został usunięty")</script>';
			} else {
			  echo '<script>alert("Błąd połączenia z bazą danych.")</script>';
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
									<input type="hidden" name="hid_nazwa" value="<?php echo $row["nazwa"]; ?>">
									<input type="hidden" name="hid_cena" value="<?php echo $row["cena"]; ?>">
									<a href="admin_remove.php?action=delete&id=<?php echo $row["id"]; ?>">
									<span style="margin-top: 10px; background-color: #BB2929; border: 5px solid #AAAAAA" class="btn btn-success" >Usuń produkt</span>
									</a>
									
                            </div>
							
                        </form>
						
                    </div>
                    <?php
                }
            }
        ?>

        <div style="clear: both"></div>
		<br/><br/>
			<form action="shop.php">
					<input type="submit" name="powrot" 
					style="background-color: #117864; border: 5px solid #566573" class="btn btn-success" 
					value="Wróć na stronę sklepu">
			</form>
    </div>


</body>
</html>