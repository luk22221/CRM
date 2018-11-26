<?php
session_start();
if (!isset($_SESSION['zalogowany'])) header('Location: /include/login_page.php');

include "config/connect.php";
include "include/nav.php";

?>



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

echo("ustawienia konta");

?>


<?php
include "include/footer.php";
?>
</body>
</html>