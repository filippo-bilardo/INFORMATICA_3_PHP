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

/*
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (empty($_POST["name"])) {
    $nameErr = "Name is required";
  } else {
    $name = test_input($_POST["name"]);
    // check if name only contains letters and whitespace
    if (!preg_match("/^[a-zA-Z-' ]*$/",$name)) {
      $nameErr = "Only letters and white space allowed";
    }
  }
  
  if (empty($_POST["email"])) {
    $emailErr = "Email is required";
  } else {
    $email = test_input($_POST["email"]);
    // check if e-mail address is well-formed
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $emailErr = "Invalid email format";
    }
  }
    
  if (empty($_POST["website"])) {
    $website = "";
  } else {
    $website = test_input($_POST["website"]);
    // check if URL address syntax is valid (this regular expression also allows dashes in the URL)
    if (!preg_match("/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i",$website)) {
      $websiteErr = "Invalid URL";
    }
  }

  if (empty($_POST["comment"])) {
    $comment = "";
  } else {
    $comment = test_input($_POST["comment"]);
  }

  if (empty($_POST["gender"])) {
    $genderErr = "Gender is required";
  } else {
    $gender = test_input($_POST["gender"]);
  }
}

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
*/
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
  
//!preg_match("/([\w\-]+\@[\w\-]+\.[\w\-]+)/",$email);
// preg_match('/^\S+@[\w\d.-]{2,}\.[\w]{2,6}$/iU', $email)
//!preg_match("/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i",$website)
//https://github.com/davidecesarano/Validation/blob/master/Validation.php 
//ISO date time format: Y-m-d H:i:s.
const DATE_TIME_ISO = '/^[\d]{4}\-[\d]{2}\-[\d]{2} [\d]{2}\:[\d]{2}\:[\d]{2}$/';
//ISO date time format: Y-m-d.
const DATE_ISO = '/^[\d]{4}\-[\d]{2}\-[\d]{2}$/';
//Date format: d.m.Y.
const DATE_DMY = '/^[0-9]{2}\.[0-9]{2}\.[0-9]{4}$/';
//International phone number.
const PHONE_NUMBER = '/^\+[0-9]{6,}$/';
// Positive integer >= 1.
const ID = '/^[1-9][0-9]*$/';
//Generic UUID.
const UUID = '/^\w{8}-\w{4}-\w{4}-\w{4}-\w{12}$/';
//Postal code. Can start with 0. Not for canada.
const POSTAL_CODE = '/^[\d]{4,}$/';
//Positive float.
const POSITIVE_FLOAT = '/^([\d]*[.])?[\d]+$/';
  
$patterns = array(
  'uri'           => '[A-Za-z0-9-\/_?&=]+',
  'url'           => '[A-Za-z0-9-:.\/_?&=#]+',
  'alpha'         => '[\p{L}]+',
  'words'         => '[\p{L}\s]+',
  'alphanum'      => '[\p{L}0-9]+',
  'int'           => '[0-9]+',
  'float'         => '[0-9\.,]+',
  'tel'           => '[0-9+\s()-]+',
  'text'          => '[\p{L}0-9\s-.,;:!"%&()?+\'°#\/@]+',
  'file'          => '[\p{L}\s0-9-_!%&()=\[\]#@,.;+]+\.[A-Za-z0-9]{2,4}',
  'folder'        => '[\p{L}\s0-9-_!%&()=\[\]#@,.;+]+',
  'address'       => '[\p{L}0-9\s.,()°-]+',
  'date_dmy'      => '[0-9]{1,2}\-[0-9]{1,2}\-[0-9]{4}',
  'date_ymd'      => '[0-9]{4}\-[0-9]{1,2}\-[0-9]{1,2}',
  'email'         => '[a-zA-Z0-9_.-]+@[a-zA-Z0-9-]+.[a-zA-Z0-9-.]+[.]+[a-z-A-Z]'
);
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
