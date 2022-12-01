<?php
include 'functions.php';

sec_session_start(); // usiamo la nostra funzione per avviare una sessione php sicura
$_SESSION['pag_count']++; echo $_SESSION['pag_count']; //TODO: debug only

$email = (isset($_POST['email'])) ? $_POST['email'] : "";
$crypt_pwd = (isset($_POST['crypt_pwd'])) ? $_POST['crypt_pwd'] : "";

list($retval,$errmsg)=login($email, $crypt_pwd);
if($retval) {header("location: welcome.php"); die();} 
?>
 
<!DOCTYPE html>
<html>
<head>
  <title>Login</title>
  <script type="text/javascript" src="sha512.js"></script>
  <script type="text/javascript" src="forms.js"></script>
</head>
<body>
  <div align="center">
    <?=$errmsg?>
    <form action="login.php" method="post">
      <label>Email <input type="text" name="email" /></label><br />
      <label>Password <input type="password" id="password"/></label><br />
      <input type="button" value="Login" onclick="formLoginHash(this.form, this.form.password);" />
      <input type="button" value="Cancel" onclick="formLoginCancel(this.form.email, this.form.password);" />
    </form>
    <p>Non hai un account? <a href="register.php">Registrati adesso</a>.</p>        
  </div>    
</body>
</html>

