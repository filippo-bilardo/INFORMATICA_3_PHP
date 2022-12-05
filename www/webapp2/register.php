<?php
/** ****************************************************************************************
* @file register.php
* @brief Aggiunta utente al DB e accesso alla sezione riservata del sito
* <specifiche del progetto>
* <specifiche del collaudo>
* 
* @author Filippo Bilardo
* @date 05/12/2022
* @version 1.0 20/03/2018 Versione iniziale
* @version 1.1 05/12/2022 Riorganizzazione del codice
*/

include 'functions.php';

session_start(); // usiamo la nostra funzione per avviare una sessione php sicura
$_SESSION['pag_count']++; echo $_SESSION['pag_count']; //TODO: debug only

$email = (isset($_POST['email'])) ? $_POST['email'] : null;
$username = (isset($_POST['username'])) ? $_POST['username'] : null;
$crypt_pwd = (isset($_POST['crypt_pwd'])) ? $_POST['crypt_pwd'] : null;
$crypt_cpwd = (isset($_POST['crypt_cpwd'])) ? $_POST['crypt_cpwd'] : null;

list($retval,$errmsg)=register($email, $username, $crypt_pwd, $crypt_cpwd);
if($retval) {header("location: welcome.php"); die();}  
?>

<!DOCTYPE html>
<html>
<head>
  <title>Registrazione</title>
  <script type="text/javascript" src="sha512.js"></script>
  <script type="text/javascript" src="forms.js"></script>
  <style>
    form.myform {display: table;}
    div.myform {display: table-row; margin-bottom: 2px;}
    label, input {display: table-cell; margin-bottom: 10px;}
    .err {color: #FF0000;}
  </style>
</head>
<body>
  <div align="center">
    <h3>Registrazione</h3>
    <br />
    <form action="register.php" class="myform" method="post">
      <span class="err"><?=$errmsg?></span><br />
      <div class="myform"><label>Email <input type="text" name="email" value="<?=$email?>" /></label></div>
      <div class="myform"><label>Username <input type="text" name="username" value="<?=$username?>" /></label></div>
      <div class="myform"><label>Password <input type="password" name="password" value="" /></label></div>
      <div class="myform"><label>Conferma Password <input type="password" name="cpassword" value="" /></label></div>
      <div class="myform">
        <input type="button" value="Invia" onclick="formRegisterHash(this.form, this.form.password, this.form.cpassword);" />
        <input type="reset" value="Cancel" />
      </div>
    </form>
    <p>Hai gi&aacute; un account? Vai alla pagina di <a href="login.php">login</a>.</p>
  </div>
</body>
</html>
