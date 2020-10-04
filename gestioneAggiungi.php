<?php

require './PHP/smartphone.php';
require './PHP/gestione.php';
require './PHP/errors.php';

session_start();
if (!isset($_SESSION['id']) || $_SESSION['admin'] != 1) {
    header('Location: message.php');
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./CSS/main.css">
    <title>Gestione: Aggiungi Prodotto</title>
</head>

<body>
    <?php

    include './Templates/navbar.php';

    ?>

    <section class="gestione aggiungi">
        <div class="container">

            <ul class="gestione-nav">
                <li><a href="gestioneAggiungi.php">Aggiungi Prodotto</a></li>
                <li><a href="gestioneModifica.php">Modifica Prodotto</a></li>
                <li><a href="gestioneRimuovi.php">Rimuovi Prodotto</a></li>
            </ul>


            <form action="" method="post" enctype="multipart/form-data">
       
            <?php
            echo message();
            if (isset($_POST['submit'])) {

                $imageName = $_FILES['image']['name'];

                addSmartphone($_POST['marca'], $_POST['modello'], $_POST['descrizione'], $_POST['quantita'], $_POST['prezzo'], $imageName);
                //  CARICO IMG NELLA CARTELLA
                $target = "img/" . basename($_FILES['image']['name']);
                if (move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
                    $msg = 'Image uploaded succesfully.';
                } else {
                    $msg = 'Error...';
                }
            }
            ?>
                <div class="field field-marca">
                    <label for="marca">Marca</label>
                    <input type="text" name="marca" required>
                </div>

                <div class="field field-modello">
                    <label for="modello">Modello</label>
                    <input type="text" name="modello" required>
                </div>

                <div class="field field-descrizione">
                    <label for="descrizione">Descrizione</label>
                    <textarea name="descrizione" id="" cols="30" rows="10" required></textarea>
                </div>

                <div class="field field-numbers">

                    <div class="field field-prezzo">
                        <label for="prezzo">Prezzo</label>
                        <input type="number" name="prezzo" required>
                    </div>

                    <div class="field field-quantita">
                        <label for="quantita">Quantità</label>
                        <input type="number" name="quantita" required>
                    </div>

                </div>

                <div class="field field-image">
                    <label for="image">Immagine</label>
                    <input type="file" name="image" id="" required>
                </div>

                <button type="submit" name="submit">Aggiungi</button>
            </form>

            <div class="img-container"></div>

        </div>
    </section>

    <!--FONTAWESOME JS LINK-->
    <script src="https://kit.fontawesome.com/1640a3f9de.js"></script>
    <!--JQUERY JS LINK-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <!--GSAP JS LINK-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.5.0/gsap.min.js"></script>
    <!--GSAP TWEEN_MAX JS LINK-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/2.0.2/TweenMax.min.js"></script>

    <script src="./JS/main.js"></script>
</body>

</html>