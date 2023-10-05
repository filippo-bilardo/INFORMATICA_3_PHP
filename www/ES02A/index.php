<!DOCTYPE html>
<html>
<head>
  <title>Pagina di login</title>
</head>
<body>
  <h3>Accesso a pagina riservata</h3>
  
  <form action="login.php" method="post">
    <label for="username"><b>Username</b></label>
    <input type="text" name="username" /><br />
    <label for="password"><b>Password</b></label>
    <input type="password" name="password" /><br />
    <input name="submit" type="submit" value="Login" />
    <input type="reset" value="Cancella" />
  </form>
</body>
</html>

