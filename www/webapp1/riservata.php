<?php
//TODO intestazione
include 'functions.php';

session_start(); // Avvia la sessione php.
$_SESSION['pag_count']++; echo $_SESSION['pag_count']; //TODO: debug only

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
