<?php
/** ****************************************************************************************
* @file riservata.php
* @brief Pagina riservata del sito
* <specifiche del progetto>
* <specifiche del collaudo>
* 
* @author Filippo Bilardo
* @date 05/12/2022
* @version 1.0 20/03/2018 Versione iniziale
* @version 1.1 05/12/2022 Riorganizzazione del codice
*/
session_start(); // Avvia la sessione php.

// Check if the user is logged in, if not then redirect to login page
if( empty($_SESSION['username']) ) {
  $msg = "Attenzione! Prima di accedere alla sezione riservata del sito";
  $msg .= " e' necessario effetturare il login.";
  header("location: login.php?errmsg=$msg"); 
  die();
}
?>
 
<!DOCTYPE html>
<html>
<head>
  <title>Area riservata</title>
</head>
<body>
  <h2>Ciao, <b><?=htmlspecialchars($_SESSION['username']);?></b>. 
  Benvenuto nell'area riservata del sito.</h2>
  <p>
  <a href="index.php">Home page</a><br />
  <a href="logout.php">Logout</a>
  </p>
</body>
</html>
