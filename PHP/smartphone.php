<?php

//  CONNESSIONE AL DB
function getDatabase()
{
    $server = 'sql202.epizy.com';
    $user = 'epiz_26814141';
    $pwd = 'NnIhvb2zlBML';
    $db = 'epiz_26814141_E_Commerce';
    $conn = mysqli_connect($server, $user, $pwd, $db) or die('Connessione fallita');
    return $conn;
}

/*
//  CONNESSIONE AL DB LOCALHOST
function getDatabase()
{
    $server = 'localhost';
    $user = 'root';
    $pwd = '';
    $db = 'e-commerce';
    $conn = mysqli_connect($server, $user, $pwd, $db) or die('Connessione fallita');
    return $conn;
}
*/


/*       CARDS       */

//  SMARTPHONE CARD
function creaCardSmartphone($elenco)
{
    $contenuto = "<div class='card-container'>";
    foreach ($elenco as $cont) {
        $contenuto .= "
        <div class='card'>
            <a href='mainDetail.php?idSmartphone=" . $cont['idSmartphone'] . "'>
                <h2 class='marca'>{$cont['marca']}</h2>
                <img src='img/" . $cont['immagine'] . "' alt=''>
                <h2 class='modello'>{$cont['modello']}</h2>
                <p class='descrizione'>{$cont['descrizione']}</p>
                <div class='numbers'>
                    <p class='prezzo'>€ {$cont['prezzo']}</p>
                    <p class='qta'>Quantità: {$cont['quantita']}</p>
                </div>
            </a>
        </div>
        ";
    }
    $contenuto .= "</div>";

    return $contenuto;
}

//  MOSTRA CARD SMARTPHONE
function getCardSmartphone()
{
    $elenco = [];
    $query = 'SELECT * FROM smartphone';
    $conn = getDatabase();
    $smartphones = mysqli_query($conn, $query);
    while ($smartphone = mysqli_fetch_assoc($smartphones)) {
        $elenco[] = $smartphone;
    }
    $contenuto = creaCardSmartphone($elenco);
    //$contenuto = creaTabellaSmartphone($elenco);
    mysqli_close($conn);

    return $contenuto;
}

/*       TABELLA       */

//  SMARTPHONE TABELLA
function creaTabellaSmartphone($elenco)
{
    $contenuto = '<div class="table-smartphone"><h2> Tabella Smartphone</h2><table><tr><th>Immagine</th><th>ID Smartphone</th><th>Marca</th><th>Modello</th><th>Prezzo</th><th>Quantità</th><th>Descrizione</th></tr>';
    foreach ($elenco as $cont) {
        $contenuto .= "
			<tr><td><img src='img/" . $cont['immagine'] . "' alt=''></td>
			<td>{$cont['idSmartphone']}</td>
			<td>{$cont['marca']}</td>
			<td>{$cont['modello']}</td>
			<td>{$cont['prezzo']}</td>
			<td>{$cont['quantita']}</td>
			<td>{$cont['descrizione']}</td></tr>";
    }
    $contenuto .= '</table></div>';

    return $contenuto;
}

//  MOSTRA TABELLA SMARTPHONE
function getTabellaSmartphone()
{
    $elenco = [];
    $query = 'SELECT * FROM smartphone';
    $conn = getDatabase();
    $smartphones = mysqli_query($conn, $query);
    while ($smartphone = mysqli_fetch_assoc($smartphones)) {
        $elenco[] = $smartphone;
    }
    $contenuto = creaTabellaSmartphone($elenco);
    mysqli_close($conn);

    return $contenuto;
}


/*       DETAIL PAGE       */

//  SMARTPHONE DETAIL
function creaDetailSmartphone($elenco)
{
    foreach ($elenco as $cont) {
        $contenuto = "
        <div class='content'>
            <img src='img/" . $cont['immagine'] . "' alt=''>
            <main>
                <h1>{$cont['marca']} {$cont['modello']}</h1>
                <div class='descrizione'>{$cont['descrizione']}</div>
                <div class='bottom'>
                    <div class='numbers'>
                        <p class='prezzo'>€ {$cont['prezzo']}</p>
                        <p class='quantita'>Quantità: {$cont['quantita']}</p>
                    </div>
                    <form method='post'>
                    <button name='add'>Aggiungi al Carrello</button>
                    </form>
                </div>
            </main>
        </div>";
    }

    return $contenuto;
}

//  MOSTRA CARD SMARTPHONE
function getDetailSmartphone()
{
    $elenco = [];
    $query = "SELECT * FROM smartphone WHERE idSmartphone = {$_GET['idSmartphone']}";
    $conn = getDatabase();
    $smartphones = mysqli_query($conn, $query);
    while ($smartphone = mysqli_fetch_assoc($smartphones)) {
        $elenco[] = $smartphone;
    }
    $contenuto = creaDetailSmartphone($elenco);
    mysqli_close($conn);

    return $contenuto;
}


/*       SHOPPING CART      */

//  PRODOTTO CARRELLO
function creaShoppingCart($elenco)
{
    $contenuto = "";
    $totale = 0;
    foreach ($elenco as $cont) {
        $contenuto .= "   
        <div class='product'>
            <img src='img/" . $cont['immagine'] . "' alt=''>
            <main>
                <h3 class='title'>{$cont['marca']} <span>{$cont['modello']}</span></h3> 
                <p>{$cont['descrizione']}</p>
                <div class='prezzo'>€ {$cont['prezzo']}</div>
                <div class='cross-remove'>
                <a href='remove.php?idSmartphone=" . $cont['idSmartphone'] . "'>
                    <div class='rec a'></div>
                    <div class='rec b'></div>
                </a>
                </div>
            </main>
        </div>";
        $totale += $cont['prezzo'];
    }

    $contenuto .= "
    <div class='bottom'>
        <div class='totale'>Totale: € $totale</div>
        <form method='post'>
            <button type='submit' name='checkOut'>CheckOut</button>
        </form>
    </div>";

    return $contenuto;
}

//  MOSTRA CARRELLO
function getShoppingCart()
{
    $elenco = [];
    //se visitatore
    if (!isset($_SESSION['id'])) {
        $values = @join(",", $_SESSION['cart']);
        $query = "SELECT * FROM smartphone WHERE idSmartphone IN ($values);";
    }
    //se utente registrato
     else {
        $query = "SELECT * FROM smartphone WHERE idSmartphone IN (SELECT idProdotto FROM carrello WHERE idUtente = {$_SESSION['id']});";
    }
    $conn = getDatabase();
    $smartphones = mysqli_query($conn, $query);
    while ($smartphone = @mysqli_fetch_assoc($smartphones)) {
        $elenco[] = $smartphone;
    }
    $contenuto = creaShoppingCart($elenco);
    mysqli_close($conn);

    return $contenuto;
}


/*       SEARCH BOX      */

//  MOSTRA TROVATO
function mostraTrovato($elenco)
{

    $contenuto = "<div class='card-container'>";
    foreach ($elenco as $cont) {
        $contenuto .= "
        <div class='card'>
            <a href='mainDetail.php?idSmartphone=" . $cont['idSmartphone'] . "'>
                <h2 class='marca'>{$cont['marca']}</h2>
                <img src='img/" . $cont['immagine'] . "' alt=''>
                <h2 class='modello'>{$cont['modello']}</h2>
                <p class='descrizione'>{$cont['descrizione']}</p>
                <div class='numbers'>
                    <p class='prezzo'>€ {$cont['prezzo']}</p>
                    <p class='qta'>Quantità: {$cont['quantita']}</p>
                </div>
            </a>
        </div>
        ";
    }
    $contenuto .= "</div>";

    return $contenuto;
}

//  SEARCH  CERCA
function search($search)
{
    $elenco = [];
    $query = "SELECT * FROM smartphone WHERE marca LIKE '%$search%' OR modello LIKE '%$search%' OR descrizione LIKE '%$search% '";
    $conn = getDatabase();
    $searched = mysqli_query($conn, $query);
    while ($find = mysqli_fetch_assoc($searched)) {
        $elenco[] = $find;
    }
    $contenuto = mostraTrovato($elenco);
    mysqli_close($conn);

    return $contenuto;
}


/*       FILTRI      */

//  DAL PIU' COSTOSO
function piùCostoso()
{
    $elenco = [];
    $query = "SELECT * FROM smartphone ORDER BY prezzo DESC ";
    $conn = getDatabase();
    $filter = mysqli_query($conn, $query);
    while ($filtered = mysqli_fetch_assoc($filter)) {
        $elenco[] = $filtered;
    }
    $contenuto = mostraTrovato($elenco);
    mysqli_close($conn);

    return $contenuto;
}

//  DAL MENO COSTOSO
function menoCostoso()
{
    $elenco = [];
    $query = "SELECT * FROM smartphone ORDER BY prezzo ASC";
    $conn = getDatabase();
    $filter = mysqli_query($conn, $query);
    while ($filtered = mysqli_fetch_assoc($filter)) {
        $elenco[] = $filtered;
    }
    $contenuto = mostraTrovato($elenco);
    mysqli_close($conn);

    return $contenuto;
}
