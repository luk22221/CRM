<?php
session_start();
if (!isset($_SESSION['zalogowany'])) header('Location: /include/login_page.php');

include "config/connect.php";
include "include/nav.php";

?>



<html lang="pl">
<html>
<head>
	<meta charset="UTF-8">
	<title>CRM</title>
	<link rel="stylesheet" href="/css/style.css">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
<?php

echo("clients info");

if(isset($_GET['id'])){	
	if(is_numeric($_GET['id'])){
		$id = ($_GET['id']);
		if ($result = $connect->query("SELECT * FROM clients  WHERE id='$id';")){
			while ($row = mysqli_fetch_array($result)){
				echo "</br>" . '<h3>' . 'Klient numer: ' . $row['id'] . '</h3>';
           	    echo "imie: " . $row['name'] . "</br>";
                echo "nazwisko: " . $row['last_name'] . "</br>";
                echo "email: " . $row['email'] . "</br>";
                echo "telefon: " . $row['phone'] . "</br>";
                echo "kod pocztowy i miasto: " . $row['postal-code'] . " " . $row['town'] . "</br>";
                echo "ulica: " . $row['street'] . "</br>";
                echo "informacje o kliencie: " . $row['description'] . "</br>";
    	    }


        }

	}

}
?>
<a href="clients.php">powrót</a> 


<?php
include "include/footer.php";
?>
</body>
</html>
