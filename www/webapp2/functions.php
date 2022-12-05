<?php
/** ****************************************************************************************
* @file functions.php
* @brief <inserire una breve descrizione del modulo>
* <specifiche del progetto>
* <specifiche del collaudo>
* 
* @author Filippo Bilardo
* @date 05/12/2022
* @version 1.0 20/03/2018 Versione iniziale
* @version 1.1 05/12/2022 Riorganizzazione del codice
*/

function login_simple($email, $password) {
  
  if(! isset($email, $password)) 
    return array(false, "Inserire le proprie credenziali e premere il pulsante login.");
    
  if(empty($email) || empty($password)) 
    return array(false, "Inserire le proprie credenziali non nulle e premere il pulsante login.");

  if($email=="admin" && $password="pwd") {
    // Password corretta! Login eseguito con successo.
    $_SESSION['username'] = $email;
    return array(true, "Login eseguito correttamente");
  } else {
    // Password sbagliata.
    $_SESSION['username'] = null;
    return array(false, "Attenzione! Password sbagliata.");
  }
}
function login_check() {
  // Verifica che tutte le variabili di sessione siano impostate correttamente
  if(isset($_SESSION['username'])) {
    return array(true, "L'utente ".$_SESSION['username'].", ha gia' effettuato il login.");
  } else {
    return array(false, "E' necessario eseguire il login.");
  }
}



function validate() {
  
  if ($_SESSION['LoginMsg'] != null && $_SESSION['LoginMsg'] != "") {
    session_unset();
  }
}

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
      $_SESSION['username'] = $username;
      return array(true, "Login eseguito correttamente");
    } else {
      //Errore nella query di inserimento
      $_SESSION['username'] = null;
      return array(false, "Attenzione! Errore nella query di inserimento.");
    }  
    
  } catch (Exception $e) {
    return array(false, "Attenzione! Errore: " . $e->getMessage());
  }  
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
?>