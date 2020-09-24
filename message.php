<?php

require './PHP/smartphone.php';

session_start();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./CSS/main.css">
    <title>Message</title>
</head>

<body>

    <?php

    include './Templates/navbar.php';

    ?>
    <section class="message">
        <div class="container">

            <h2 class="msg">Per accedere a questa funzione è necessario accedere come ADMIN. <br> <p>EMAIL: admin@admin.com <br>PASSWORD: Admin</p></h2>
            <div class="access">
                <a href="./userSignIn.php" class="signIn">Registrati</a>
                <a href="./userLogin.php" class="login">Accedi</a>
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