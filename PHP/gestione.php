<?php

/*      GESTIONE SMARTPHONE     */

//  AGGIUNGI SMARTPHONE
function addSmartphone($marca, $modello, $descrizione, $quantita, $prezzo, $imageName)
{
    $query = "INSERT INTO smartphone(marca, modello, descrizione, quantita, prezzo, immagine) VALUES (?, ?, ?, ?, ?, ?);";
    $conn = getDatabase();

    if ($stmt = mysqli_prepare($conn, $query)) {
        mysqli_stmt_bind_param($stmt, "sssids", $marca, $modello, $descrizione, $quantita, $prezzo, $imageName);
        if (mysqli_stmt_execute($stmt)) {
            echo "<div id='success'>Input inserito correttamente </div>";
        } else {
            echo "<div id='error'>ERROR: Could not execute query: $query. </div> " . mysqli_error($conn);
        }
    } else {
        echo "<div id='error'>ERROR: Could not prepare query: $query. </div> " . mysqli_error($conn);
    }
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
}

//  MODIFICA SMARTPHONE
function modifySmartphone($marca, $modello, $descrizione, $quantita, $prezzo, $imageName, $id)
{
    $query = "UPDATE smartphone SET marca = ?  modello = ? descrizione = ? quantita = ? prezzo = ? immagine = ? WHERE idSmartphone = ?;";
    $conn = getDatabase();

    if ($stmt = mysqli_prepare($conn, $query)) {
        mysqli_stmt_bind_param($stmt, "sssidsi", $marca, $modello, $descrizione, $quantita, $prezzo, $imageName, $id);
        if (mysqli_stmt_execute($stmt)) {
            echo "<div id='success'>Input inserito correttamente </div>";
        } else {
            echo "<div id='error'>ERROR: Could not execute query: $query. </div> " . mysqli_error($conn);
        }
    } else {
        echo "<div id='error'>ERROR: Could not prepare query: $query. </div> " . mysqli_error($conn);
    }
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
}

//  RIMUOVI SMARTPHONE
function removeSmartphone($id)
{
    $query = "DELETE FROM smartphone WHERE idSmartphone = ?;";
    $conn = getDatabase();

    if ($stmt = mysqli_prepare($conn, $query)) {
        mysqli_stmt_bind_param($stmt, "i", $id);
        if (mysqli_stmt_execute($stmt)) {
            echo "<div id='success'>Input inserito correttamente </div>";
        } else {
            echo "<div id='error'>ERROR: Could not execute query: $query. </div> " . mysqli_error($conn);
        }
    } else {
        echo "<div id='error'>ERROR: Could not prepare query: $query. </div> " . mysqli_error($conn);
    }
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
}


/*      GESTIONE UTENTI     */

//  AGGIUNGI UTENTE /   REGISTRATI
function addUser($username, $email, $hash)
{
    $query = "INSERT INTO registro(username, email, password) VALUES (?, ?, ?);";
    $conn = getDatabase();

    // Controlla se l'utente ha gia' un account
    $user_check_query = "SELECT * FROM register WHERE username='$username' AND email = '$email' LIMIT 1";
    $result = mysqli_query($conn, $user_check_query);
    $user = mysqli_fetch_assoc($result);

    // Se l'utente ha già un account...
    if ($user) {
        if ($user['username'] === $username && $user['email'] === $email) {
            echo "<div id='error'>Questo account esiste gia'...</div>";
            mysqli_close($conn);
            alert('Questo account esiste già...');
            exit;
        }
    } else {
        if ($stmt = mysqli_prepare($conn, $query)) {
            mysqli_stmt_bind_param($stmt, "sss", $username, $email, $hash);
            if ($test = mysqli_stmt_execute($stmt)) {
                echo "<div id='success'>Input inserito correttamente </div>";
                $_SESSION['id'] = mysqli_insert_id($conn);
                alert('Registrazione completata.');
                header('Location: index.php');
            } else {
                echo "<div id='error'>ERROR: Could not execute query: $query. </div> " . mysqli_error($conn);
            }
        } else {
            echo "<div id='error'>ERROR: Could not prepare query: $query. </div> " . mysqli_error($conn);
        }
        mysqli_stmt_close($stmt);
        mysqli_close($conn);
    }
}

//  LOGIN   /   ACCEDI
function login($email, $hash)
{
    $query = "SELECT * FROM registro WHERE email = '$email';";
    $conn = getDatabase();
    $result = mysqli_query($conn, $query);

    //  Controllo se la password inserita corrisponde a quella registrata
    if ($user = mysqli_fetch_assoc($result)) {
        if ($hash === $user['password']) {
            $autenticato = true;
        }
        else {
            alert('Password sbagliata...');
            $autenticato = false;
        }
    } 


    if ($autenticato) {
        $_SESSION['id'] = $user['idUtente'];
        $_SESSION['username'] = $user['username'];
        $_SESSION['admin'] = $user['admin'];
        alert('Utente autenticato.');
        header('Location: index.php');
    } else {
        mysqli_close($conn);
    }
}

//  LOGOUT  /   ESCI
function logOut()
{
    session_start();
    unset($_SESSION);
    session_destroy();
    session_write_close();
    alert('Utente uscito.');
    header('Location: index.php');
    die;
}

/*      GESTIONE CARRELLO       */

//  AGGIUNGI AL CARRELLO
function addToCart()
{
    $idProdotto = $_GET['idSmartphone'];
    //se visitatore
    if (!isset($_SESSION['id'])) {
        array_push($_SESSION['cart'], $idProdotto);
        foreach ($_SESSION['cart'] as $value) {
            echo $value;
        }
        print_r($_SESSION['cart']);
    }
    //se utente registrato
    else {
        $idUtente = $_SESSION['id'];

        $conn = getDatabase();
        $query = "INSERT INTO carrello(idProdotto, idUtente) VALUES ($idProdotto, $idUtente);";
        mysqli_query($conn, $query);
        mysqli_close($conn);
    }

    header('Location: ./index.php');
}

//  RIMUOVI DAL CARRELLO
function removeFromCart()
{
    $idProdotto = $_GET['idSmartphone'];
    //se visitatore
    if (!isset($_SESSION['id'])) {
        if (($key = array_search($idProdotto, $_SESSION['cart'])) !== false) {
            unset($_SESSION['cart'][$key]);
            print_r($_SESSION['cart']);
        }
    }
    //se utente registrato
    else {
        $idUtente = $_SESSION['id'];

        $conn = getDatabase();
        $query = "DELETE FROM carrello WHERE idProdotto = $idProdotto AND idUtente = $idUtente";
        mysqli_query($conn, $query);
        mysqli_close($conn);
    }
    header('Location: ./mainCarrello.php?idSmartphone=' . $idProdotto . '');
}

//  ACQUISTO    /   TOGLI QUANTITA'
function acquista()
{
    //se visitatore
    if (!isset($_SESSION['id'])) {
        $values = @join(",", $_SESSION['cart']);
        $query = "UPDATE smartphone SET quantita = (quantita - 1) WHERE idSmartphone IN ($values);";
    }
    //se utente registrato
    else {
        $query = "UPDATE smartphone SET quantita = (quantita - 1) WHERE idSmartphone IN (SELECT idProdotto FROM carrello WHERE idUtente = {$_SESSION['id']});";
    }

    $conn = getDatabase();
    if (mysqli_query($conn, $query)) {
        //se visitatore
        if (!isset($_SESSION['id'])) {
            $values = @join(",", $_SESSION['cart']);
            unset($_SESSION['cart']);
        }
        //se utente registrato
        else {
            $query_remove_cart = "DELETE FROM carrello WHERE idUtente = {$_SESSION['id']}";
            mysqli_query($conn, $query_remove_cart);
            mysqli_close($conn);
        }
        alert('Acquisto riuscito :)');
    } else {
        alert('ERRORE:  Acquisto non riuscito :(');
        mysqli_close($conn);
    }
}
