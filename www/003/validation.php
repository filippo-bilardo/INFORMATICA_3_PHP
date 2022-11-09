<?php
/*
https://github.com/Riculum/PHP-Validation
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
  
$patterns1 = array(
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
array $patterns = [
  'uri' => '[A-Za-z0-9-\/_?&=]+',
  'slug' => '[-a-z0-9_-]',
  'url' => '[A-Za-z0-9-:.\/_?&=#]+',
  'alpha' => '[\p{L}]+',
  'words' => '[\p{L}\s]+',
  'alphanum' => '[\p{L}0-9]+',
  'numeric' => '[+-]?([0-9]*[.])?[0-9]+',
  'boolean' => 'true|false|1|0',
  'int' => '[0-9]+',
  //'int' => '\d+',
  //'float' => '[0-9\.,]+',
  'float' => '[+-]?([0-9]*[.])?[0-9]+',
  'tel' => '[0-9+\s()-]+',
  'text' => '[\p{L}0-9\s-.,;:!"%&()?+\'°#\/@]+',
  'file' => '[\p{L}\s0-9-_!%&()=\[\]#@,.;+]+\.[A-Za-z0-9]{2,4}',
  'folder' => '[\p{L}\s0-9-_!%&()=\[\]#@,.;+]+',
  'address' => '[\p{L}0-9\s.,()°-]+',
  'date_dmy' => '[0-9]{1,2}\-[0-9]{1,2}\-[0-9]{4}',
  'date_ymd' => '[0-9]{4}\-[0-9]{1,2}\-[0-9]{1,2}',
  'email' => '[a-zA-Z0-9_.-]+@[a-zA-Z0-9-]+.[a-zA-Z0-9-.]+[.]?[a-z-A-Z]?'
];

function rule_url($data): bool {return (bool)filter_var((string)$data, FILTER_VALIDATE_URL);}
?>
