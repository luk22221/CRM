<?php
include "../config/connect.php";
session_start();
if(isset($_POST['submit']) && ($_SESSION['zalogowany'])== 1 && ($_SESSION['privilege'] == 1)){

function generateRandomString($length = 8) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}
$user = generateRandomString();
$pass = generateRandomString();
try 
{
	$connect = new mysqli($host, $db_user, $db_password, $db_name);
	if ($connect->connect_errno!=0)
	{
		throw new Exception(mysqli_connect_errno());
	}
	else
	{	

		//Czy nick jest już w bazie?
		$resultnick = $connect->query("SELECT id FROM users WHERE user='$user'");
		if (!$resultnick) throw new Exception($connect->error);
		$how_much_users = $resultnick->num_rows;

		for ($i=0 ; $how_much_users>0 ; $user = generateRandomString(8) ) { 
			$resultnick = $connect->query("SELECT id FROM users WHERE user='$user'");
			$how_much_users = $resultnick->num_rows;
			echo "zmieniam nick na nowy";
		}
		
		$pass_hash = password_hash($pass, PASSWORD_DEFAULT);
		if ($connect->query("INSERT INTO users (id, user, pass,  email, datetime,privilege) VALUES (NULL, '$user', '$pass_hash', '0',NOW(),'0' );"))
		{
			echo "Nowy użytkownik został dodany jego dane do logowania są następujące:" . '<br/>';
		}
		else
		{
			throw new Exception($connect->error);
		}
			
		
		$connect->close();
	}
	
}
catch(Exception $e)
{
	?><div class="error">Błąd serwera dodaj użytkownika w innym terminie</div>
	//echo '<br />Informacja developerska: '.$e;
<?php
}

echo($user) . '<br/>';
echo($pass) . '<br/>';
echo "<a href='management.php'>Powrót</a>";




}else{
	echo "musisz zalogować sie jako administrator";
}

?>

