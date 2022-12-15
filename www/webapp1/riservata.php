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
*/include 'functions.php';

session_start(); // Avvia la sessione php.
if(isset($_SESSION['pag_count'])) {
  $_SESSION['pag_count']++; echo $_SESSION['pag_count']; //TODO: debug only
}

// Check if the user is logged in, if not then redirect to login page
list($retval,$errmsg)=login_check();
if(!$retval) {header("location: login.php"); die();} 
?>
 
<!DOCTYPE html>
<html>
<head>
  <title>Benvenuto</title>
</head>
<body>
  <h2>Ciao, <b><?=htmlspecialchars($_SESSION['username']); ?></b>. Benvenuto nell'area riservata del nostro sito.</h2>
  <p>
  <a href="index.php">Home page</a><br />
  <a href="welcome.php">Pagina di benvenuto</a><br />
  <a href="logout.php">Logout</a>
  </p>
</body>
</html>
