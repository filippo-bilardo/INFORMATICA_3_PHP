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
  <h2>Ciao, <b><?=htmlspecialchars($_SESSION['username']); ?></b>. Benvenuto nel nostro sito.</h2>
  <p>
    <a href="reset.php" class="btn btn-warning">Resetta la password</a>
    <a href="logout.php" class="btn btn-danger">Logout</a>
  </p>
</body>
</html>
