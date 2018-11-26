<?php
include "../config/connect.php";
session_start();
if (isset($_SESSION['zalogowany'])) header('Location: ../index.php');
		
?>
<form action="../config/login.php" method="post">

	Login: <br /> <input type="text" name="login" /> <br />
	Hasło: <br /> <input type="password" name="haslo" /> <br /><br />
	<input type="submit" value="zaloguj się" />
<br /><br />

</form>
	
<?php

//wyswietlanie błędu w przypadku niepoprawnych danych logowania
if(isset($_SESSION['blad']))	echo $_SESSION['blad'];
unset($_SESSION['blad']);

?>