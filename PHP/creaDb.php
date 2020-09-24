<?php

function getDatabase(){
    $server = 'localhost';
    $user = 'root';
    $pwd = '';
    $db = 'E-commerce';
    $conn = mysqli_connect($server, $user, $pwd, $db) or die('Connessione fallita');
}
/*
$conn = getDatabase();
$query = "
    CREATE TABLE smartphone(
        codSmartphone int auto_increment not null primary key,
        marca varchar(15),
        modello varchar(30),
        descrizione text, 
        quantita int,
        prezzo float
    );";
    $conn;
    mysqli_query($conn, $query) or die(mysqli_error($conn));
    mysqli_close($conn);
    */
