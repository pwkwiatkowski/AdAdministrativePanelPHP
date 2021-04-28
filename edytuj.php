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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
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

                <div class="ogloszenie" id="ogloszenie_dodaj">

                    <form action="process.php?variable1='".$jedno_ogloszenie[id] method="post" enctype="multipart/form-data" name="form1" onsubmit="required()">
                        
                        <?php 
                            echo 'Tytuł ogłoszenia: <input name="tytul" type="text" value="'.$jedno_ogloszenie["title"].'" class="edycja1"/>'
                        ?>
                        <br>
                        
                        <?php 
                            echo 'Cena w złotych: <input name="cena" type="text" value="'.$jedno_ogloszenie["price"].'" class="edycja1" />'
                        ?>
                        <br>
                        
                        <?php 
                            echo 'Zdjęcie: <br /> <img id="obrazek" class="img" src="data:image/jpeg;base64,'.base64_encode($jedno_ogloszenie['image'] ). '" /> ';
                        ?>

                        <?php 
                            //echo '<input type="hidden" name="obrazek_z_bazy" value="'.base64_encode($jedno_ogloszenie['image']).'" />';
                        ?>

                        <br>

                        <!-- wgrywanie zdjęcia i od razu podgląd-->
                        <input type="file" accept="image/*" name="dodaj_zdjecie" id="image" onchange="loadFile(event)">

                        <script>
                        var loadFile = function(event) {
                            var image = document.getElementById('obrazek');
                            image.src = URL.createObjectURL(event.target.files[0]);
                        };
                        </script>
                        <!-- wgrywanie zdjęcia i od razu podgląd - do tąd-->

                        <!-- zabezpieczenie, żeby były tylko zdjęcia-->
                        <script>
                            $(document).ready(function() {
                                $('#zatwierdz').click(function(){
                                    var image_name = $('#image').val();
                                    var extension = $('#image').val().split('.').pop().toLowerCase();
                                    if(jQuery.inArray(extension, ['gif','png','jpg','jpeg','jfif','webp','']) == -1)
                                    {
                                        alert('Niepoprawny format pliku');
                                        $('#image').val('');
                                        return false;
                                    }
                                }
                                )
                            }
                            );
                        </script>
                        <!-- zabezpieczenie, żeby były tylko zdjęcia - do tąd-->

                        <br>
                        
                        <?php 
                            echo 'Opis ogłoszenia:<br /> <textarea type="text" name="opis" class="edycja2">'.$jedno_ogloszenie["description"].'</textarea>'
                        ?>
                        <br>

                        <?php 
                            echo ' <input type="hidden" name="id_edytuj" value="'.$id.'" />';
                        ?>

                        <input type="submit" value="Zatwierdź" id="zatwierdz" name="zatwierdz">

                    </form>

                     <!-- walidacja pustych pól-->
                     <script>
                         function required()
                         {
                            var empt1 = document.forms["form1"]["tytul"].value;
                            var empt2 = document.forms["form1"]["cena"].value;
                            var empt3 = document.forms["form1"]["opis"].value;
                            if (empt1 == "" || empt2 == "" || empt3 == "")
                            {
                                alert("Pola nie mogą być puste");
                                return false;
                            }
                            else 
                            {
                                alert('Edytowano ogłoszenie');
                                return true; 
                            }
                         }
                    </script>
                    <!-- walidacja pustych pól - do tąd-->

                </div>

            </div>

    </div>

</body>
</html>