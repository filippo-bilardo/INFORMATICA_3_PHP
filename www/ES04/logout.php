<?php
// Avvia una nuova sessione
session_start();
// Distrugge la sessione attiva
session_destroy();
// Redirigi l'utente verso la pagina di login
//header("Location: login.php");
//exit;
?>
<html>
<head>
	<title>Logout</title>
</head>
<body>
	<h2>Sessione chiusa correttamente</h2>
	<a href="login.php">Accedi di nuovo.</a>
	<a href="index.php">Torna alla home.</a>
</body>
</html>