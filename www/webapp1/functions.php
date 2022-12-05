<?php

function _pdodb_connection() {
  try {
    $hostname = "localhost";
    $dbname = "secure_login";
    $user = "sec_user";
    $pass = "FFcGZr59zAa2BEWU";
    $pdodb = new PDO ("mysql:host=$hostname;dbname=$dbname", $user, $pass);
    return array(true, $pdodb);
  } catch (PDOException $e) {
    return array(false, "Errore: " . $e->getMessage());
  }
}

function reset_password($userid, $password, $cpassword) {

  if(! isset($userid, $password, $cpassword)) 
    return array(false, "Inserire i dati richiesti.");

  if(empty($userid) || empty($password)) 
    return array(false, "Attenzione! Inserire dei valori nei campi prima di premere il pulsante Invia.");

  if($password!=$cpassword) 
    return array(false, "Attenzione! I campi password e conferma password non coincidono.");

  list($retval,$pdodb)=_pdodb_connection();
  if(!$retval) {return array(false, $pdodb);} //TODO: debug only

  // Crea una chiave casuale
  $salt="non-usata";
  
  //Inserimento dei dati nel db
  try {
    $sql = "UPDATE members SET password=:password,salt=:salt WHERE id=:userid;";
    $stmt = $pdodb->prepare($sql);
    $retval = $stmt->bindParam(':userid', $userid);
    $retval = $stmt->bindParam(':password', $password, PDO::PARAM_STR);
    $retval = $stmt->bindParam(':salt', $salt, PDO::PARAM_STR);
    $retval = $stmt->execute();
    
    if($retval) {
      return array(true, "Cambio password eseguito correttamente!");
    } else {
      return array(false, "Attenzione! Errore nella query di aggiornamento.");
    }  
    
  } catch (Exception $e) {
    return array(false, "Attenzione! Errore: " . $e->getMessage());
  }  
}

function register($email, $username, $password, $cpassword) {

  if(! isset($email, $username, $password, $cpassword)) 
    return array(false, "Per creare l'account, compilare il form e premere il pulsante Invia.");

  if(empty($email) || empty($username) || empty($password)) 
    return array(false, "Attenzione! Inserire dei valori nei campi prima di premere il pulsante Invia.");

  if($password!=$cpassword) 
    return array(false, "I campi password e conferma password non coincidono.");

  list($retval,$pdodb)=_pdodb_connection();
  if(!$retval) {return array(false, $pdodb);} //TODO: debug only

  $salt="non-usata";
  
  //Inserimento dei dati nel db
  try {
    $sql = "INSERT INTO members (username, email, password, salt) VALUES (:username, :email, :password, :salt)";
    $stmt = $pdodb->prepare($sql);
    $retval = $stmt->bindParam(':username', $username, PDO::PARAM_STR);
    $retval = $stmt->bindParam(':email', $email, PDO::PARAM_STR);
    $retval = $stmt->bindParam(':password', $password, PDO::PARAM_STR);
    $retval = $stmt->bindParam(':salt', $salt, PDO::PARAM_STR);
    $retval = $stmt->execute();
    
    if($retval) {
      //Utente inserito
      $_SESSION['userid'] = $db_userid; 
      $_SESSION['username'] = $db_username;
      return array(true, "Login eseguito correttamente");
    } else {
      //Errore nella query di inserimento
      $_SESSION['userid'] = null;
      $_SESSION['username'] = null;
      return array(false, "Attenzione! Errore nella query di inserimento.");
    }  
    
  } catch (Exception $e) {
    return array(false, "Attenzione! Errore: " . $e->getMessage());
  }  
}
function login($email, $password) {
  
  if(! isset($email, $password)) 
    return array(false, "Inserire le proprie credenziali e premere il pulsante login.");
    
  if(empty($email) || empty($password)) 
    return array(false, "Inserire le proprie credenziali non nulle e premere il pulsante login.");

  if($email=="admin" && $password="pwd") {
    // Password corretta! Login eseguito con successo.
    $_SESSION['userid'] = $email; 
    $_SESSION['username'] = $email;
    return array(true, "Login eseguito correttamente");
  } else {
    // Password sbagliata.
    $_SESSION['userid'] = null;
    return array(false, "Attenzione! Password sbagliata.");
  }
    /*
      // L'utente inserito non esiste.
      $_SESSION['userid'] = null;
      return array(false, "Attenzione! L'utente inserito non esiste.");
    */ 
}
function loginDB($email, $password) {
  
  if(! isset($email, $password)) 
    return array(false, "Inserire le proprie credenziali e premere il pulsante login.");
    
  if(empty($email) || empty($password)) 
    return array(false, "Inserire le proprie credenziali non nulle e premere il pulsante login.");
  
  list($retval,$pdodb)=_pdodb_connection();
  if(!$retval) {return array(false, $pdodb);} //TODO: debug only

  try {
    $sql = "SELECT id, username, password, salt FROM members WHERE email=:email LIMIT 1";
    $stmt = $pdodb->prepare($sql);
    $retval = $stmt->bindParam(':email', $email, PDO::PARAM_STR);
    $retval = $stmt->execute();
    $rowCount = $stmt->rowCount();

    if($rowCount == 1) {
      //l'utente esiste
      $row = $stmt->fetch(PDO::FETCH_ASSOC);
      $db_userid = $row['id'];
      $db_username = $row['username'];
      $db_password = $row['password'];
      // Verifica che la password memorizzata nel database corrisponda alla password fornita dall'utente.
      if($db_password == $password) { 
        // Password corretta! Login eseguito con successo.
        $_SESSION['userid'] = $db_userid; 
        $_SESSION['username'] = $db_username;
        return array(true, "Login eseguito correttamente");
      } else {
        // Password sbagliata.
        $_SESSION['userid'] = null;
        return array(false, "Attenzione! Password sbagliata.");
      }
    } else {
      // L'utente inserito non esiste.
      $_SESSION['userid'] = null;
      return array(false, "Attenzione! L'utente inserito non esiste.");
    }  
    
  } catch (Exception $e) {
    return array(false, "Attenzione! Errore: " . $e->getMessage());
  }
}

function login_check() {
  // Verifica che tutte le variabili di sessione siano impostate correttamente
  if(isset($_SESSION['userid'], $_SESSION['username'])) {
    return array(true, "L'utente ".$_SESSION['username'].", id=".$_SESSION['userid'].", ha gia' effettuato il login.");
  } else {
    return array(false, "E' necessario eseguire il login.");
  }
}

/*
#https://www.wikihow.it/Creare-uno-Script-Sicuro-per-il-Login-Usando-PHP-e-MySQL

#1. Crea il database MySQL.
CREATE DATABASE `secure_login`;

#2. Crea un utente che abbia solo i privilegi per eseguire 'SELECT', 'UPDATE' e 'INSERT'.
CREATE USER 'sec_user'@'localhost' IDENTIFIED BY 'FFcGZr59zAa2BEWU';
GRANT SELECT, INSERT, UPDATE ON `secure_login`.* TO 'sec_user'@'localhost';

#3. Crea una tabella MySQL chiamata 'members'
CREATE TABLE `secure_login`.`members` (
  `id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY, 
  `username` VARCHAR(30) NOT NULL, 
  `email` VARCHAR(50) NOT NULL, 
  `password` CHAR(128) NOT NULL, 
  `salt` CHAR(128) NOT NULL
) ENGINE = InnoDB;

#4. Crea la tabella di log che memorizzer� tutti i tentativi di login.
CREATE TABLE `secure_login`.`login_attempts` (
  `user_id` INT(11) NOT NULL,
  `time` VARCHAR(30) NOT NULL 
) ENGINE=InnoDB;

#5. Esegui un test di inserimento dati nella tabella 'members'
# Password: 6ZaxN2Vzm9NUJT2y
INSERT INTO `secure_login`.`members` VALUES(1, 'test_user', 'test@example.com', '00807432eae173f652f2064bdca1b61b290b52d40e429a7d295d76a71084aa96c0233b82f1feac45529e0726559645acaed6f3ae58a286b9f075916ebf66cacc', 'f9aab579fc1b41ed0c44fe4ecdbfcdb4cb99b9023abb241a6db833288f4eea3c02f76e0d35204a8695077dcf81932aa59006423976224be0390395bae152d4ef');

*/

?>