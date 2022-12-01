<?php
include 'functions.php';

session_start();
$_SESSION = array(); // Elimina tutti i valori della sessione.
session_destroy(); // Cancella la sessione.

session_start();
$_SESSION['pag_count']=0;
header('Location: login.php');
?>
