<?php
/** ****************************************************************************************
* @file logout.php
* @brief Pagina 
* 
* @author Filippo Bilardo
* @date 27/10/23
* @version 1.0 20/03/18 Versione iniziale
* @version 1.1 05/12/22 Riorganizzazione del codice
*/
session_start();   // Inizializza la sessione
session_unset();   // Rimuovi tutte le variabili di sessione
 
//Altri metodi per terminare la sessione attiva
//session_destroy(); // Distrugge la sessione
//$_SESSION = array();

// Redirect alla pagina di login
header('Location: login.php');
exit;
?>
