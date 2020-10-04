<?php

require './PHP/smartphone.php';
require './PHP/gestione.php';
require './PHP/errors.php';

session_start();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./CSS/main.css">
    <title>LogIn</title>
</head>

<body>
    <?php

    include './Templates/navbar.php';

    ?>

    <section class="gestione login">
        <div class="container">

        <h1 class="title">Accesso</h1>

            <form class="form" action="" method="post">

                <div class="field field-email">
                    <label for="email">Email</label>
                    <input type="text" name="email">
                </div>

                <div class="field field-password">
                    <label for="password">Password</label>
                    <input type="password" name="password">
                </div>

                <?php echo message() ?>

                <button type="submit" name="submit">Accedi</button>

                <p>Non hai ancora un account? <a href="./userSignIn.php">Registrati</a></p>

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

    $hash = hash("sha512", $_POST['password']);

    login($_POST['email'], $hash);
}



?>

</html>