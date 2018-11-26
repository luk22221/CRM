<?php
session_start();
if (!isset($_SESSION['zalogowany'])) header("location: index.php");
include "config/connect.php";
	?>
<html lang="pl">
<html>
<head>
	<meta charset="UTF-8 general ci">
	<title>CRM-zadania</title>
	<link rel="stylesheet" href="/css/style.css">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>

<?php
include "include/nav.php";
?>


<?php
include "include/footer.php";
?>


</body>
</html>