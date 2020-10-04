<?php

require './PHP/smartphone.php';
require './PHP/errors.php';

session_start();
if(!isset($_SESSION['cart'])){
    $_SESSION['cart'] = array();
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./CSS/main.css">
    <title>E-commerce-Tech</title>
</head>

<body>

    <?php

    include './Templates/navbar.php';

    ?>
    <section class="home">
        <div class="container">
            <form action="" method="post">
                <input type="search" name="search" id="">
                <button type="submit" class="search" name="lens"><i class="fas fa-search"></i></button>
                <div name="costoso" class="filter">Filtri
                    <ul class="filter-ul">
                        <li><button name="più-costoso">Più Costoso</button> </li>
                        <li><button name="meno-costoso">Meno Costoso</button></li>
                    </ul>
                </div>

            </form>

            <?php echo message() ?>

            <div class="card-container">


                <?php
                //Se uso search box
                if (isset($_POST['lens'])) {
                    if (search($_POST['search'])) {
                        echo search($_POST['search']);
                    }
                }
                //  se uso filtri
                else if (isset($_POST['più-costoso'])) {
                    echo piùCostoso();
                } else if (isset($_POST['meno-costoso'])) {
                    echo menoCostoso();
                }
                //  default
                else {
                    echo getCardSmartphone();
                }
                ?>
            </div>

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