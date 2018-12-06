 <?php
session_start();
if (!isset($_SESSION['zalogowany'])) header('Location: /include/login_page.php');

include "config/connect.php";
include "include/nav.php";



	if (isset($_POST['last_name']))
	{
		//Udana walidacja? Załóżmy, że tak!
		$wszystko_OK=true;
		
		//przypisanie do zmiennych wpisanych informacji
		$name = $_POST['name'];
		$last_name = $_POST['last_name'];
		$email = $_POST['email'];
		$postal_code = $_POST['postal_code'];
		$town = $_POST['town'];
		$street = $_POST['street'];
		$phone = $_POST['phone'];
		$description = $_POST['description'];
		
		//Sprawdzenie długości imienia i nazwiska
		if ((strlen($name)<1) || (strlen($name)>25))
		{
			$wszystko_OK=false;
			$_SESSION['e_name']="Imie musi posiadać od 1 do 25 znaków!";
		}
		if ((strlen($last_name)<1) || (strlen($last_name)>25))
		{
			$wszystko_OK=false;
			$_SESSION['e_last_name']="Nazwisko musi posiadać od 1 do 25 znaków!";
		}
		//Czy numer to wartośc liczbowa
		if(!(is_numeric($_POST['phone'])) && ($_POST['phone']) != null){
			$wszystko_OK=false;
			$_SESSION['e_phone']="Podaj poprawny numer telefonu!";
		}
		
		
		// Sprawdź poprawność adresu email
		$email = $_POST['email'];
		$emailB = filter_var($email, FILTER_SANITIZE_EMAIL);
		
		if ((filter_var($emailB, FILTER_VALIDATE_EMAIL)==false) || ($emailB!=$email))
		{
			if (!empty($email))
			{
			
				$wszystko_OK=false;
				$_SESSION['e_email']="Podaj poprawny adres e-mail!";
			}
		}
		

		//Zapamiętaj wprowadzone dane
		$_SESSION['fr_name'] = $name;
		$_SESSION['fr_last_name'] = $last_name;
		$_SESSION['fr_email'] = $email;
		$_SESSION['fr_phone'] = $phone;
		$_SESSION['fr_postal_code'] = $postal_code;
		$_SESSION['fr_town'] = $town;
		$_SESSION['fr_street'] = $street;
		$_SESSION['fr_description'] = $description;

		
		
		try 
		{
			
			if ($connect->connect_errno!=0)
			{
				throw new Exception(mysqli_connect_errno());
			}
			

			if ($wszystko_OK==true)
			{
				
				if ($connect->query("INSERT INTO clients VALUES (NULL, '$name', '$last_name', '$email', '$phone', '$postal_code', '$town', '$street',NOW(), '$description')"))
				{
					$_SESSION['client_added']=true;
					header('Location: clients.php');
				}
				else
				{
					throw new Exception($connect->error);
				}
				
			}
			
			$connect->close();
			
			
		}
		catch(Exception $e)
		{
			echo '<span style="color:red;">Błąd serwera! Przepraszamy za niedogodności i prosimy o dodanie klienta później!</span>';
			echo '<br />Informacja developerska: '.$e;
		}
		
	}
	
?>



<html lang="pl">
<html>
<head>
	<meta charset="UTF-8 general ci">
	<title>CRM-dodaj klienta</title>
	<link rel="Stylesheet" type="text/css" href="css/style.css." />
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

</head>
<body>

<form method="post">
	Dodaj nowego klienta do bazy danych <br />
	
		Imie: 
		<br /> <input type="text" value="<?php
			if (isset($_SESSION['fr_name']))
			{
				echo $_SESSION['fr_name'];
				unset($_SESSION['fr_name']);
			}
		?>" name="name" /><br />
		
		<?php
			if (isset($_SESSION['e_name']))
			{
				echo '<div class="error">'.$_SESSION['e_name'].'</div>';
				unset($_SESSION['e_name']);
			}
		?>


		nazwisko: 
		<br /> <input type="text" value="<?php
			if (isset($_SESSION['fr_last_name']))
			{
				echo $_SESSION['fr_last_name'];
				unset($_SESSION['fr_last_name']);
			}
		?>" name="last_name" /><br />
		
		<?php
			if (isset($_SESSION['e_last_name']))
			{
				echo '<div class="error">'.$_SESSION['e_last_name'].'</div>';
				unset($_SESSION['e_last_name']);
			}
		?>


		Numer telefonu 
		<br /> <input type="text" name="phone" value="<?php
		if (isset($_SESSION['fr_phone']))
			{
				echo $_SESSION['fr_phone'];
				unset($_SESSION['fr_phone']);
			}?>"><br />
		<?php 
		if (isset($_SESSION['e_phone']))
			{
				echo '<div class="error">'.$_SESSION['e_phone'].'</div>';
				unset($_SESSION['e_phone']);
			}?>
		

		E-mail: 
		<br /> <input type="text" value="<?php
			if (isset($_SESSION['fr_email']))
			{
				echo $_SESSION['fr_email'];
				unset($_SESSION['fr_email']);
			}
		?>" name="email" /><br />
		
		<?php
		if (isset($_SESSION['e_email']))
			{
				echo '<div class="error">'.$_SESSION['e_email'].'</div>';
				unset($_SESSION['e_email']);
			}
		?>


		Kod pocztowy: 
		<br /> <input type="text" value="<?php
			if (isset($_SESSION['fr_postal_code']))
			{
				echo $_SESSION['fr_postal_code'];
				unset($_SESSION['fr_postal_code']);
			}
		?>" name="postal_code" /><br />
		
		<?php
			if (isset($_SESSION['e_postal_code']))
			{
				echo '<div class="error">'.$_SESSION['e_postal_code'].'</div>';
				unset($_SESSION['e_postal_code']);
			}
		?>


		Miasto: 
		<br /> <input type="text" value="<?php
			if (isset($_SESSION['fr_town']))
			{
				echo $_SESSION['fr_town'];
				unset($_SESSION['fr_town']);
			}
		?>" name="town" /><br />
		
		<?php
			if (isset($_SESSION['e_town']))
			{
				echo '<div class="error">'.$_SESSION['e_town'].'</div>';
				unset($_SESSION['e_town']);
			}
		?>


		Ulica: 
		<br /> <input type="text" value="<?php
			if (isset($_SESSION['fr_street']))
			{
				echo $_SESSION['fr_street'];
				unset($_SESSION['fr_street']);
			}
		?>" name="street" /><br />
		
		<?php
			if (isset($_SESSION['e_street']))
			{
				echo '<div class="error">'.$_SESSION['e_street'].'</div>';
				unset($_SESSION['e_street']);
			}
		?>


		Opis klienta: 
		<br /> <input type="text" value="<?php
			if (isset($_SESSION['fr_description']))
			{
				echo $_SESSION['fr_description'];
				unset($_SESSION['fr_description']);
			}
		?>" name="description" /><br />
		
		<?php
			if (isset($_SESSION['e_description']))
			{
				echo '<div class="error">'.$_SESSION['e_description'].'</div>';
				unset($_SESSION['e_description']);
			}
		?>

		

		
		<br />
		
		<input type="submit" value="dodaj nowego klienta" />
		
	</form>

<?php
include "include/footer.php";
?>
</body>
</html>

