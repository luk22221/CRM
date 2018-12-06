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
    <title>CRM-clients</title>
    <link rel="stylesheet" href="css/style.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
<a href="new_client.php"><button type="button">Dodaj nowego klienta</button></a></br>
<?php
if (isset($_SESSION['client_added']))
    {?>
        Klient został dodany do bazy
    <?php
    }
    unset($_SESSION['client_added']);
    //Usuwanie zmiennych pamiętających wartości wpisane do formularza
    if (isset($_SESSION['fr_name'])) unset($_SESSION['fr_name']);
    if (isset($_SESSION['fr_last_name'])) unset($_SESSION['fr_last_name']);
    if (isset($_SESSION['fr_email'])) unset($_SESSION['fr_email']);
    if (isset($_SESSION['fr_phone'])) unset($_SESSION['fr_phone']);
    if (isset($_SESSION['fr_postal_code'])) unset($_SESSION['fr_postal_code']);
    if (isset($_SESSION['fr_town'])) unset($_SESSION['fr_town']);
    if (isset($_SESSION['fr_street'])) unset($_SESSION['fr_street']);
    if (isset($_SESSION['fr_description'])) unset($_SESSION['fr_description']);
    
    //Usuwanie błędów rejestracji
    if (isset($_SESSION['e_name'])) unset($_SESSION['e_name']);
    if (isset($_SESSION['e_last_name'])) unset($_SESSION['e_last_name']);
    if (isset($_SESSION['e_email'])) unset($_SESSION['e_email']);
    if (isset($_SESSION['e_phone'])) unset($_SESSION['e_phone']);
    if (isset($_SESSION['e_postal_code'])) unset($_SESSION['e_postal_code']);


$records_per_page = 3;

if($result = $connect->query("SELECT id, name, last_name FROM clients ")){
    if($result->num_rows != 0){
        $total_records = $result->num_rows;
        $total_pages = ceil($total_records / $records_per_page);
        
        if(isset($_GET['page']) && is_numeric($_GET['page'])){
            
            $show_page = $_GET['page'];
            
            if($show_page > 0 && $show_page <= $total_pages){
                $start = ($show_page-1) * $records_per_page;
                $end = $start + $records_per_page;
            } else {
                $start = 0;
                $end = $records_per_page;
            }
        } else {
            $start = 0;
            $end = $records_per_page;
        }
        echo "<p> | Zobacz stronę: ";
        for($i = 1; $i <= $total_pages; $i++){
                if(isset($_GET['page']) && $_GET['page'] == $i){
                    echo $i . " ";
                } else {
                    echo "<a href='clients.php?page=$i'>" . $i . "</a>";
                }
            }
        echo "</p>";
        
        for($i = $start; $i < $end; $i++){
            if($i == $total_records) {break;}
            
            $result->data_seek($i);
            $row = mysqli_fetch_array($result);
            
            echo $row['id'] . " ";
            echo $row['name'] . " ";
            echo $row['last_name'] . " ";
            echo "<a href='clients_info.php?id=" . $row['id'] . "'>"?><button type="button">Pokaż</button></a><br /><?php
            
        }
            
        
        
    } else {
        echo "Brak rekordów";
    }
} else {
    echo "Błąd zapytania";
}?>

<a href="index.php">powrót</a> 

<?php
$connect->close();
include "include/footer.php";
?>

</body>
</html>
