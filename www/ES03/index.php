<?php
//Code from https://chat.openai.com/chat

// Recupera i dati del form di login
$username = $_POST['username'];
$password = $_POST['password'];

// Verifica i dati di login
if ($username == "admin" && $password == "password") {
  // Avvia una nuova sessione
  session_start();
  
  // Memorizza i dati dell'utente nella sessione
  $_SESSION['username'] = $username;
  
  // Redirigi l'utente verso la pagina protetta
  header("Location: protected-page.php");
  exit;
} else {
  // Redirigi l'utente verso la pagina di login con un messaggio di errore
  header("Location: login.php?error=invalid_credentials&from=verify-login.php");
  exit;
}
?>