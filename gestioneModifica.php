<?php

require './PHP/smartphone.php';
require './PHP/gestione.php';

session_start();
if( !isset($_SESSION['id']) || $_SESSION['admin'] != 1){
    header('Location: message.php');
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./CSS/main.css">
    <title>Gestione: Modifica Prodotto</title>
</head>

<body>
    <?php

    include './Templates/navbar.php';

    ?>

    <section class="gestione modifica">
        <div class="container">

            <ul class="gestione-nav">
                <li><a href="gestioneAggiungi.php">Aggiungi Prodotto</a></li>
                <li><a href="gestioneModifica.php">Modifica Prodotto</a></li>
                <li><a href="gestioneRimuovi.php">Rimuovi Prodotto</a></li>
            </ul>

            <p class="show-table"><span>Mostra Tabella</span><i class="fas fa-chevron-down"></i></p>

            <?php

            echo getTabellaSmartphone();

            ?>

            <form action="" method="post" enctype="multipart/form-data">

                <div class="field field-id">
                    <label for="id">ID</label>
                    <input type="number" name="id">
                </div>

                <div class="field field-marca">
                    <label for="marca">Marca</label>
                    <input type="text" name="marca">
                </div>

                <div class="field field-modello">
                    <label for="modello">Modello</label>
                    <input type="text" name="modello">
                </div>

                <div class="field field-descrizione">
                    <label for="descrizione">Descrizione</label>
                    <textarea name="descrizione" id="" cols="30" rows="10"></textarea>
                </div>

                <div class="field field-numbers">

                    <div class="field field-prezzo">
                        <label for="prezzo">Prezzo</label>
                        <input type="number" name="prezzo">
                    </div>

                    <div class="field field-quantita">
                        <label for="quantita">Quantità</label>
                        <input type="number" name="quantita">
                    </div>

                </div>

                <div class="field field-image">
                    <label for="image">Immagine</label>
                    <input type="file" name="image" id="">
                </div>

                <button type="submit" name="submit">Modifica</button>
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

<?php

if (isset($_POST['submit'])) {

    $imageName = $_FILES['image']['name'];

    modifySmartphone($_POST['marca'], $_POST['modello'], $_POST['descrizione'], $_POST['quantita'], $_POST['prezzo'], $imageName, $_POST['id']);
    //  CARICO IMG NELLA CARTELLA
    $target = "img/" . basename($_FILES['image']['name']);
    if (move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
        $msg = 'Image uploaded succesfully.';
    } else {
        $msg = 'Error...';
    }
}

?>

</html>