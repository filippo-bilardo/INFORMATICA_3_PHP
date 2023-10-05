<?php

if(isset($email)) {$email=$_POST['email'];} else {$email="";}
$password = isset($password) ? $password=$_POST['password'] : $password = "";


?>
<!DOCTYPE html>
<html>
<head>
  <title>Login page</title>
</head>
<body>
  <h3>Pagina di login</h3>
  
  <form action="login.php" method="post">
    <label>Email <input type="text" name="email" value="<?=$email?>" /></label><br />
    <label>Password <input type="password" name="password" value="<?=$password?>" /></label><br />
    <input name="submit" type="submit" value="Login" />
    <input type="reset" value="Cancel" />
  </form>
  <p>Non hai un account? <a href="">Registrati adesso</a>.</p>        
  <a href="login.php">Torna alla home page</a>        
</body>
</html>

