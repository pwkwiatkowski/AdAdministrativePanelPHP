<?php 
include "database.php";

//sprawdzam czy formularz został wysłany
if(isset($_POST["zatwierdz"])) {
    $tytul = mysqli_real_escape_string($con, $_POST["tytul"]);
    $cena = mysqli_real_escape_string($con, $_POST["cena"]);
    $opis = mysqli_real_escape_string($con, $_POST["opis"]);

    //id z pliku edytuj.php
    $id_edytuj = mysqli_real_escape_string($con, $_POST["id_edytuj"]);

    if( isset( $_FILES["dodaj_zdjecie"]["tmp_name"] )) {
        $file = addslashes(file_get_contents($_FILES["dodaj_zdjecie"]["tmp_name"]));
    }

    if(!isset($file) || $file == "") {
        $zapytanie = "SELECT * FROM ogloszenia_tabela WHERE id =".$id_edytuj."";

        $wybrany_plik = mysqli_query($con, $zapytanie);
        $jeden_plik = mysqli_fetch_assoc($wybrany_plik);
        $file = addslashes( $jeden_plik['image'] );
     }

    //walidacja danych
    if(!isset($tytul) || $tytul == "" || !isset($cena) || $cena == "" || !isset($opis) || $opis == "" || !isset($file) || $file == "") {
        //$error = "Proszę uzupełnić wszytkie pola";
        //header("Location: index.php?error=".urlencode($error));
        
        //dodawanie
        if($id_edytuj == "") {
            header("Location: dodaj.php");
            }

        //edycja
        if($id_edytuj != "") {
            header("Location: edytuj.php?variable1=".urlencode($id_edytuj));
            }

        exit();
    } else {

        //obsługa dodawania ogłoszenia
        if($id_edytuj == "") {
        $query = "INSERT INTO ogloszenia_tabela (title,price,image,description) 
                  VALUES ('$tytul', '$cena', '$file', '$opis')";
        }
        
        //obsługa edycji ogłoszenia
        if($id_edytuj != "") {
            $query = "UPDATE ogloszenia_tabela
                    SET title = '$tytul', price = '$cena', image = '$file', description = '$opis'
                    WHERE id = $id_edytuj";
        }

        if(!mysqli_query($con, $query)) {
            die("Błąd: " . mysqli_error($con));
        } else {
            //skaczę do index.php
            header("Location: index.php");
            exit();
        }
    }
}
?>