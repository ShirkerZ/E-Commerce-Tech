<?php

function message(){
    if(isset($_GET['message'])){
        switch($_GET['message']){
            /*      ERRORS       */
            case "r1":
                echo "<div class='error'>Password sbagliata.</div>";
            break;
            case "r2":
                echo "<div id='error'>Questo account esiste gia'...</div>";
            break;
            case "r3":
                echo "<div id='error'>ERROR: Could not execute query...</div> " ;
            break;
            case "r4":
                echo "<div id='error'>ERROR: Could not prepare query...</div> " ;
            break;
            case "r5":
                echo "<div id='error'>Acquisto non riuscito...</div> " ;
            break;
            case "r6":
                echo "<div id='error'>Connessione al DB non riuscita...</div> " ;
            break;
            case "r7":
                echo "<div id='error'>Le password non coincidono...</div> " ;
            break;
            case "r8":
                echo "<div id='error'>Selezionare ID prodotto...</div> " ;
            break;

            /*      SUCCESS     */ 
            //messaggi gestione utente
            case "s1":
                echo "<div class='success'>Utente autenticato.</div>";
            break;
            case "s2":
                echo "<div class='success'>Logout effettuato.</div>";
            break;
            case "s3":
                echo "<div class='success'>Registrazione completata.</div>";
            break;
            //messaggi gestione carrello
            case "s4":
                echo "<div class='success'>Prodotto aggiunto al carrello.</div>";
            break;
            case "s5":
                echo "<div class='success'>Prodotto rimosso dal carrello.</div>";
            break;
            case "s6":
                echo "<div class='success'>Acquisto riuscito.</div>";
            break;
            case "s7":
                echo "<div class='success'>Prodotto aggiunto.</div>";
            break;
            case "s8":
                echo "<div class='success'>Prodotto modificato.</div>";
            break;
            case "s9":
                echo "<div class='success'>Prodotto rimosso.</div>";
            break;
        }
    }
}
