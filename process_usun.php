<?php 
include "database.php";

//sprawdzam czy formularz został wysłany
if(isset($_POST["zatwierdz"])) {
    $id_edytuj = mysqli_real_escape_string($con, $_POST["id_edytuj"]);

    $query = "DELETE FROM ogloszenia_tabela
                  WHERE id = $id_edytuj";

    if(!mysqli_query($con, $query)) {
         die("Błąd: " . mysqli_error($con));
    } else {
        //skaczę do index.php
        header("Location: index.php");
        exit();
    }
}
?>