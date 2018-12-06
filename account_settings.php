<?php
session_start();
if (!isset($_SESSION['zalogowany'])) header('Location: /include/login_page.php');

include "config/connect.php";
include "include/nav.php";

$id = $_SESSION['id'];
if(isset($_SESSION['account_data']))
{ 
	echo($_SESSION['account_data']);
	unset($_SESSION['account_data']);
}
if(isset($_SESSION['account_pass']))
{ 
	echo($_SESSION['account_pass']);
	unset($_SESSION['account_pass']);
}
?>



<html lang="pl">
<html>
<head>
	<meta charset="UTF-8 general ci">
	<title>CRM</title>
	<link rel="stylesheet" href="css/style.css">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>

<?php
$id = $_SESSION['id'];
if($result = $connect->query("SELECT pass,user,email,phone,avatar_path FROM users where id='$id'")){
	$data_account = mysqli_fetch_array($result);

$_SESSION['fr_user']= $data_account['user'];
$_SESSION['fr_phone']= $data_account['phone'];
$_SESSION['fr_email']= $data_account['email'];
//$_SESSION['fr_avatar_path']= $data_account['avatar_path'];
}


?>
<form enctype="multipart/form-data" action="save_in_database/account_settings_save.php" method="post">

	Nazwa użytkownika 
	<br /> <input type="text" name="user" value="<?php
	if (isset($_SESSION['fr_user']))
		{
			echo $_SESSION['fr_user'];
			unset($_SESSION['fr_user']);
		}?>"><br />
	<?php 
	if (isset($_SESSION['e_user']))
		{
			echo '<div class="error">'.$_SESSION['e_user'].'</div>';
			unset($_SESSION['e_user']);
		}?>


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
	<br /> <input type="email" value="<?php
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
	<input type="submit" value="Aktualizuj dane" name="submit1"/>
</form>

<form  action="save_in_database/account_settings_save.php" method="post">
	Stare hasło <br /> <input type="text" name="old_pass" /> <br />
<?php
	if (isset($_SESSION['e_pass1']))
	{
		echo '<div class="error">'.$_SESSION['e_pass1'].'</div>';
		unset($_SESSION['e_pass1']);
	}?>
	Nowe hasło <br /> <input type="password" name="new_pass1" /> <br />	
	Powtórz nowe hasło <br /> <input type="password" name="new_pass2" /> <br />
<?php
	if (isset($_SESSION['e_pass2']))
	{
		echo '<div class="error">'.$_SESSION['e_pass2'].'</div>';
		unset($_SESSION['e_pass2']);
	}?>
	<input type="submit" value="Zmień hasło" name="submit2"/>
</form>


<?php
include "include/footer.php";
?>
</body>
</html>