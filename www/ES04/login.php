<?php
/** ***************************************************************************
* @file login.php
* @brief Pagina per l'autenticazione degli utenti ed accesso  
* alla sezione riservata del sito
* 
* @author Filippo Bilardo
* @date 27/10/23
* @version 1.0 20/03/18 Versione iniziale
* @version 1.1 05/12/22 Riorganizzazione del codice
* @version 1.2 27/10/23 Semplificazione del codice
*/
session_start(); // Avvia la sessione php.

$errmsg = $_GET['errmsg'] ?? "";
$username = $_POST['username'] ?? "";
$password = $_POST['password'] ?? "";

if(isset($_POST['submit'])) 
{
  if($username=="mrossi" && $password=="123") {
    // Password corretta! Login eseguito con successo.
    $_SESSION['username'] = $username;
    header("location: riservata.php"); 
    exit();
  } else {
    // Password sbagliata.
    $_SESSION['username'] = null;
    $errmsg="Attenzione! Le credenziali inserite non sono corrette.";
  }
}  
?>
 
<!DOCTYPE html>
<html>
<head>
  <title>Login</title>
  <style>.err {color: #FF0000;}</style>
</head>
<body>
  <h3>Pagina di login</h3>

  <p class="err"><?=$errmsg?></p>

  <form action="login.php" method="post">
    <label>Usermame <input type="text" name="username" value="<?=$username?>" placeholder="Inserire il nome utente" /></label><br />
    <label>Password <input type="password" name="password" value="<?=$password?>" placeholder="Inserire la password"/></label><br />
    <br />
    <input name="submit" type="submit" value="Login" />
    <input type="reset" value="Cancel" />
  </form>

  <br /><a href="index.php">Torna alla home page</a>        

</body>
</html>
