<?php
/** ****************************************************************************************
* @file login.php
* @brief Pagina per l'autenticazione degli utenti ed accesso alla sezione riservata del sito
* <specifiche del progetto>
* <specifiche del collaudo>
* 
* @author Filippo Bilardo
* @date 05/12/2022
* @version 1.0 20/03/2018 Versione iniziale
* @version 1.1 05/12/2022 Riorganizzazione del codice
*/

include 'functions.php';

session_start(); // Avvia la sessione php.
$_SESSION['pag_count']++; echo $_SESSION['pag_count']; //TODO: debug only

$email = (isset($_POST['email'])) ? $_POST['email'] : null;
$password = (isset($_POST['password'])) ? $_POST['password'] : null;
echo "-".$email."-".$password."-"; //TODO: debug only
list($retval,$errmsg)=login_simple($email, $password);
if($retval) {header("location: index.php"); die();} 
?>
 
<!DOCTYPE html>
<html>
<head>
  <title>Login</title>
</head>
<style>
.err {color: #FF0000;}
</style>
<body>
  <h3>Pagina di login</h3>
  
  <form action="login.php" method="post">
    <span class="err"><?=$errmsg?></span><br />
    <label>Email <input type="text" name="email" /></label><br />
    <label>Password <input type="password" name="password"/></label><br />
    <input type="submit" value="Login" />
    <input type="reset" value="Cancel" />
  </form>
  <p>Non hai un account? <a href="register.php">Registrati adesso</a>.</p>        
  <a href="index.php">Torna alla home page</a>        
</body>
</html>

