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

                    <form action="process.php" method="post" enctype="multipart/form-data" name="form1" onsubmit="required()"> <!-- enctype="multipart/form-data" jest potrzebne -->
                        <input name="tytul" type="text" placeholder="Podaj tytuł ogłoszenia" class="edycja1" /> <br>
                        <input name="cena" type="text" placeholder="Podaj cenę w złotych" class="edycja1" /> <br>
                        Dodaj zdjęcie <br>
                        <!--<input type="file" name="dodaj_zdjecie" id="dodaj_zdjecie"> <br>-->

                        <img alt="" id="obrazek" class="img" />
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
                                    if(image_name == '')
                                    {
                                        alert("Proszę wybrać obraz");
                                        return false;
                                    }
                                    else
                                    {
                                        var extension = $('#image').val().split('.').pop().toLowerCase();
                                        if(jQuery.inArray(extension, ['gif','png','jpg','jpeg','jfif','webp']) == -1)
                                        {
                                            alert('Niepoprawny format pliku');
                                            $('#image').val('');
                                            return false;
                                        }
                                    }
                                }
                                )
                            }
                            );
                        </script>
                        <!-- zabezpieczenie, żeby były tylko zdjęcia - do tąd-->

                        <br>
                        
                        <textarea type="text" name="opis" class="edycja2" placeholder="Wprowadź opis"></textarea> <br>
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
                                alert('Dodano ogłoszenie');
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