<!-- https://www.w3schools.com/php/php_examples.asp -->
<!DOCTYPE HTML>  
<html>
<head>
<style>
.error {color: #FF0000;}
</style>
</head>
<body>  

<?php
// define variables and set to empty values
$nameErr = $emailErr = $genderErr = $websiteErr = "";
$name = $email = $gender = $comment = $website = "";

function checkName(&$name, &$nameErr, $val) {
  $name = trim($val);
  $name = stripslashes($name);
  $name = htmlspecialchars($name);
  if(!preg_match("/^[a-zA-Z ]{2,20}$/", $name)) {
    $nameErr = "Inserire un nome valido"; //"Only letters and white space allowed";
  } else
    $nameErr = "Nome valido";
}

if (isset($_POST["submit"])) {
  checkName($name, $nameErr, $_POST["name"]);
}
?>

<h2>PHP Form Validation Example</h2>
<p><span class="error">* required field</span></p>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">  
  Name: <input type="text" name="name" value="<?php echo $name;?>">
  <span class="error">* <?php echo $nameErr;?></span>
  <br><br>
  E-mail: <input type="text" name="email" value="<?php echo $email;?>">
  <span class="error">* <?php echo $emailErr;?></span>
  <br><br>
  Website: <input type="text" name="website" value="<?php echo $website;?>">
  <span class="error"><?php echo $websiteErr;?></span>
  <br><br>
  Comment: <textarea name="comment" rows="5" cols="40"><?php echo $comment;?></textarea>
  <br><br>
  Gender:
  <input type="radio" name="gender" <?php if (isset($gender) && $gender=="female") echo "checked";?> value="female">Female
  <input type="radio" name="gender" <?php if (isset($gender) && $gender=="male") echo "checked";?> value="male">Male
  <input type="radio" name="gender" <?php if (isset($gender) && $gender=="other") echo "checked";?> value="other">Other  
  <span class="error">* <?php echo $genderErr;?></span>
  <br><br>
  <input type="submit" name="submit" value="Submit">  
</form>

<?php
echo "<h2>Your Input:</h2>";
echo "Nome: " . $name;
echo "<br>";
echo "Email: " . $email;
echo "<br>";
echo "web: " . $website;
echo "<br>";
echo "Comment: " . $comment;
echo "<br>";
echo "Gender: " . $gender;
?>

</body>
</html>
