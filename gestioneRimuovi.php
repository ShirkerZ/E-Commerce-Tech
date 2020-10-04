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
    <title>Gestione: Modifica Prodotto</title>
</head>

<body>
    <?php

    include './Templates/navbar.php';

    ?>

    <section class="gestione rimuovi">
        <div class="container">

            <ul class="gestione-nav">
                <li><a href="gestioneAggiungi.php">Aggiungi Prodotto</a></li>
                <li><a href="gestioneModifica.php">Modifica Prodotto</a></li>
                <li><a href="gestioneRimuovi.php">Rimuovi Prodotto</a></li>
            </ul>

            <p class="show-table"><span>Mostra Tabella</span><i class="fas fa-chevron-down"></i></p>

            <?php

            echo message();

            if (isset($_POST['submit'])) {
                echo getTabellaSmartphone();
                removeSmartphone($_POST['id']);
            } else {
                echo getTabellaSmartphone();
            }

            ?>

            <form action="" method="post" enctype="multipart/form-data">

                <div class="field field-id">
                    <label for="id">ID</label>
                    <input type="number" name="id" required>
                </div>

                <button type="submit" name="submit">Rimuovi</button>
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