<?php
include 'functions.php';

session_start(); // Avvia la sessione php.
$_SESSION['pag_count']++; echo $_SESSION['pag_count']; //TODO: debug only

// Check if the user is logged in, if not then redirect to login page
list($retval,$errmsg)=login_check();
if(!$retval) {header("location: login.php"); die();} 

$password = (isset($_POST['password'])) ? $_POST['password'] : "";
$cpassword = (isset($_POST['cpassword'])) ? $_POST['cpassword'] : "";
$userid = (isset($_SESSION['userid'])) ? $_SESSION['userid'] : "";
$username = (isset($_SESSION['username'])) ? $_SESSION['username'] : "";
echo "-".$userid."-".$password."-".$cpassword."-"; //TODO: debug only
list($retval,$errmsg)=reset_password($userid, $password, $cpassword);
if($retval) {header('Location: login.php'); die();} 

?>
 
<!DOCTYPE html>
<html>
<head>
  <title>Reset Password</title>
</head>
<body>
  <h2>Reset Password dell'utente <?=$username?>.</h2>
  <?=$errmsg?>
  <form action="<?=htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
    <label>New Password <input type="password" name="password" /></label><br/>
    <label>Conferma Password <input type="password" name="cpassword" /></label><br/>
    <input type="submit" value="Invia" />
    <input type="reset" value="Cancel" />
  </form>
  <p>Torna alla pagina di <a href="index.php">benvenuto</a>.</p>        
</body>
</html>
