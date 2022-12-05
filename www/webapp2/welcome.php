<?php
include 'functions.php';

// Initialize the session
sec_session_start(); // usiamo la nostra funzione per avviare una sessione php sicura
$_SESSION['pag_count']++; echo $_SESSION['pag_count']; //TODO: debug only

// Check if the user is logged in, if not then redirect to login page
list($retval,$errmsg)=login_check();
if(!$retval) {header("location: login.php"); die();} 
?>
 
<!DOCTYPE html>
<html>
<head>
    <title>Benvenuto</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
</head>
<body>
    <div class="page-header">
        <h2>Ciao, <b><?php echo htmlspecialchars($_SESSION['username']); ?></b>. Benvenuto nel nostro sito.</h2>
    </div>
    <p>
        <a href="reset.php" class="btn btn-warning">Resetta la password</a>
        <a href="logout.php" class="btn btn-danger">Logout</a>
    </p>
</body>
</html>
