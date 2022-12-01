<?php

include 'functions.php';

session_start(); // Avvia la sessione php.
$_SESSION['pag_count']++; echo $_SESSION['pag_count']; //TODO: debug only

$email = (isset($_POST['email'])) ? $_POST['email'] : "";
$username = (isset($_POST['username'])) ? $_POST['username'] : "";
$password = (isset($_POST['password'])) ? $_POST['password'] : "";
$cpassword = (isset($_POST['cpassword'])) ? $_POST['cpassword'] : "";
echo "-".$email."-".$username."-".$password."-".$cpassword."-"; //TODO: debug only
list($retval,$errmsg)=register($email, $username, $password, $cpassword);
if($retval) {header("location: index.php"); die();}  

?>

<!DOCTYPE html>
<html>
<head>
  <title>Registrazione</title>
</head>
<body>
  <h3>Registrazione di un nuovo utente</h3>
  <p><?=$errmsg?></p>
  <form action="register.php" method="post">
    <label>Email <input type="text" name="email" /></label><br/>
    <label>Username <input type="text" name="username" /></label><br/>
    <label>Password <input type="password" name="password" /></label><br/>
    <label>Conferma Password <input type="password" name="cpassword" /></label><br/>
    <input type="submit" value="Invia" />
    <input type="reset" value="Cancel" />
  </form>
  <p>Hai gi&aacute; un account? Vai alla pagina di <a href="login.php">login</a>.</p>
</body>
</html>
