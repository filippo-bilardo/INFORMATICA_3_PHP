<?php
$username = $_POST['username'];
$passwd = $_POST['password'];

if($username=="Mario.Rossi" && $passwd=="123") {
  $msg = "Benvenuto $username nella pagina riservata del sito!";
} else {
  $msg = "Attenzione credenziali non corrette";
}
?>
<!DOCTYPE html>
<html>
<head>
  <title>Accesso a pagina riservata</title>
</head>
<body>
  <h3>Pagina di login</h3>
  
  <?=$msg?>

</body>
</html>

