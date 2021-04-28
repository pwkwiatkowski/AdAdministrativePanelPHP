<?php include "database.php"; ?>
<?php
    $id = $_GET['variable1'];
    $query = "SELECT * FROM ogloszenia_tabela where id=".$id."";
    $wybrane_ogloszenie = mysqli_query($con, $query);
    $jedno_ogloszenie = mysqli_fetch_assoc($wybrane_ogloszenie);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Serwis ogłoszeniowy</title>
    <link href="css/style.css" type="text/css" rel="stylesheet" />
</head>
<body>

    <div id="containter">

            <header>
                <h1>Serwis ogłoszeniowy</h1>
                <h2>Zarządzaj swoimi ogłoszeniami</h2>
            </header>

            <div id="content">
                
            <button id="przycisk1" onclick="location.href='index.php'">Wróć do ofert</button> <br /><br />

                    <div class="ogloszenie">

                    <h2 id="ostrzezenie">Czy na pewno chcesz usunąć ogłoszenie? Nie można cofnąć tej operacji</h2>

                        <form action="process_usun.php" method="post" enctype="multipart/form-data" name="form1" onsubmit="powiadomienie()"> <!-- enctype="multipart/form-data" jest potrzebne -->

                            <h3 name="tytul">
                                <?php echo $jedno_ogloszenie["title"] ?>
                            </h3>

                            <h3 name="cena">
                                Cena: <?php echo $jedno_ogloszenie["price"] ?> zł
                            </h3>

                            <h3>
                                Zdjęcie
                            </h3>
                                <?php 
                                    echo '<img name="obraz" class="img" src="data:image/jpeg;base64,'.base64_encode($jedno_ogloszenie['image'] ). '" /> ';
                                ?>

                            <h3>
                                Opis
                            </h3>

                            <p name="opis">
                                <?php echo $jedno_ogloszenie["description"] ?>
                            </p>

                            <?php 
                                echo ' <input type="hidden" name="id_edytuj" value="'.$id.'" />';
                            ?>

                            <input type="submit" value="Usuń" id="zatwierdz" name="zatwierdz">

                        </form>

                        <!-- Powiadomienie o usunięciu-->
                        <script>
                            function powiadomienie()
                            {
                                alert('Usunięto ogłoszenie');
                                return true;
                            }
                        </script>
                        <!-- Powiadomienie o usunięciu - do tąd-->

                    </div>

            </div>

    </div>

</body>
</html>