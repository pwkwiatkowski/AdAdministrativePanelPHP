<?php 
//Połączenie z MySQL (MariaDB)
$con = mysqli_connect("localhost", "patryk2", "patryk2", "ogloszenia_baza");

//Test połączenia
if(mysqli_connect_errno()) {
    echo "Nie można połączyć się z bazą danych: " . $mysqli_connect_error();
}

?>