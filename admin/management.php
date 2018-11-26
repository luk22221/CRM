<html lang="pl">
<html>
<head>
	<meta charset="UTF-8 general ci">
	<title>CRM</title>
	<link rel="stylesheet" href="/css/style.css">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>

<?php
session_start();
include "../config/connect.php";
include "../include/nav.php";
?>
<form action="add_user.php" method="post">
	<input type="submit" name="submit" value="dodaj nowego użytkownika" />
<br /><br />
 <a href="../index.php">powrót</a> 


</form>

<?php
include "../include/footer.php";
?>


</body>
</html>