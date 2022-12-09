<?php
/** ****************************************************************************************
* @file logout.php
* @brief Pagina 
* <specifiche del progetto>
* <specifiche del collaudo>
* 
* @author Filippo Bilardo
* @date 05/12/2022
* @version 1.0 20/03/2018 Versione iniziale
* @version 1.1 05/12/2022 Riorganizzazione del codice
*/

include 'functions.php';

session_start();
$_SESSION = array(); // Elimina tutti i valori della sessione.
//session_destroy(); // Cancella la sessione.

//session_start();
//$_SESSION['pag_count']=0;
header('Location: index.php');
?>
