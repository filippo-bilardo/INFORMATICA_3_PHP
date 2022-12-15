<?php
// Avvia una nuova sessione
session_start();

// Distrugge la sessione attiva
session_destroy();

// Redirigi l'utente verso la pagina di login
header("Location: login.php");
exit;
?>