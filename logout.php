<?php

	session_start();
		unset($_SESSION['zalogowany']);
		unset($_SESSION['id']);
		unset($_SESSION['imie']);
		unset($_SESSION['nazwisko']);
		unset($_SESSION['login']);
		unset($_SESSION['email']);
		unset($_SESSION['kodp']);
		unset($_SESSION['adres']);
        foreach ($_SESSION["koszyk"] as $keys => $value)
			{
                    unset($_SESSION["koszyk"][$keys]);
            }
	header('Location: shop.php');

?>