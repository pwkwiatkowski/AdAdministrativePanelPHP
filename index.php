<?php include "database.php"; ?>
<?php
    //wyciągam ogłoszenia z bazy
    $query = "SELECT * FROM ogloszenia_tabela";
    $ogloszenia = mysqli_query($con, $query);
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
                
                <button id="przycisk1" onclick="location.href='dodaj.php'">Dodaj ogłoszenie</button> <br /><br />

                <?php while($ogloszenie = mysqli_fetch_assoc($ogloszenia)) : ?>

                    <div class="ogloszenie">
                        <h3>
                            <?php echo $ogloszenie["title"] ?>
                        </h3>

                        <h3>
                            Cena: <?php echo $ogloszenie["price"] ?> zł
                        </h3>

                        <h3>
                            Zdjęcie
                        </h3>
                            <?php 
                                echo '<img class="img" src="data:image/jpeg;base64,'.base64_encode($ogloszenie['image'] ). '" /> ';
                            ?>

                        <h3>
                            Opis
                        </h3>

                        <p>
                            <?php echo $ogloszenie["description"] ?>
                        </p>

                        <?php echo '<a href="edytuj.php?variable1='.$ogloszenie["id"].'">Edytuj</a>' ?> |
                        <?php echo '<a href="usun.php?variable1='.$ogloszenie["id"].'">Usuń</a>' ?>

                    </div>

                <?php endwhile; ?>

            </div>

    </div>

</body>
</html>