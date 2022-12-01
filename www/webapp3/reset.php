<?php
include 'functions.php';

// Initialize the session
sec_session_start(); // usiamo la nostra funzione per avviare una sessione php sicura
$_SESSION['pag_count']++; echo $_SESSION['pag_count']; //TODO: debug only

// Check if the user is logged in, if not then redirect to login page
list($retval,$errmsg)=login_check();
if(!$retval) {header("location: login.php"); die();} 

$crypt_pwd = (isset($_POST['crypt_pwd'])) ? $_POST['crypt_pwd'] : "";
$crypt_cpwd = (isset($_POST['crypt_cpwd'])) ? $_POST['crypt_cpwd'] : "";
$userid = (isset($_SESSION['userid'])) ? $_SESSION['userid'] : "";
$username = (isset($_SESSION['username'])) ? $_SESSION['username'] : "";
echo "-".$userid."-".$crypt_pwd."-".$crypt_cpwd."-";
list($retval,$errmsg)=reset_password($userid, $crypt_pwd, $crypt_cpwd);
if($retval) {header('Location: login.php'); die();} 

?>
 
<!DOCTYPE html>
<html>
<head>
  <title>Reset Password</title>
  <script type="text/javascript" src="sha512.js"></script>
  <script type="text/javascript" src="forms.js"></script>
</head>
<body>
  <div align="center">
    <h2>Reset Password dell'utente <?=$username?>.</h2>
    <?=$errmsg?>
    <form action="<?=htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
      <label>New Password <input type="password" name="password" /></label><br />
      <label>Conferma Password <input type="password" name="cpassword" /></label><br/>
      <input type="button" value="Invia" onclick="formResetHash(this.form, this.form.password, this.form.cpassword);" />
      <input type="reset" value="Cancel" />
    </form>
    <p>Torna alla pagina di <a href="welcome.php">benvenuto</a>.</p>        
  </div>    
</body>
</html>
