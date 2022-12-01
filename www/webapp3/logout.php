<?php
include 'functions.php';

sec_session_start(); // usiamo la nostra funzione per avviare una sessione php sicura
$params = session_get_cookie_params(); // Recupera i parametri di sessione.
// Cancella i cookie attuali.
setcookie(session_name(), '', time() - 42000, $params["path"], $params["domain"], $params["secure"], $params["httponly"]);
$_SESSION = array(); // Elimina tutti i valori della sessione.
session_destroy(); // Cancella la sessione.

sec_session_start();
$_SESSION['pag_count']=0;
header('Location: login.php');
?>
