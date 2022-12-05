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

function login_locale($email, $password) {
  
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
?>