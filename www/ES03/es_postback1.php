<!-- http://204.216.213.176/inf3php/ES03/es_postback1.php -->
<?php

//Stampiamo tutte le chiavi dell'array $_POST 
// e anche il valore associato a ciascuna chiave
foreach ($_POST as $key => $value) {
  echo "Chiave: $key, Valore: $value <br>";
}

$form = <<<FORM
  <form method="post">
    <label for="nome">Nome:</label><input type="text" id="nome" name="nome"><br>
    <label for="cognome">Cognome:</label><input type="text" id="cognome" name="cognome"><br>
    <label for="email">Email:</label><input type="email" id="email" name="email"><br>
    <input type="submit" value="Invia">
  </form>
FORM;

if (isset($_POST['nome'])) {
  $nome = $_POST['nome'];
  $cognome = $_POST['cognome'];
  $email = $_POST['email'];
  $stringa = <<<TESTO
  I dati inseriti nel form sono: <br/>
  Nome e Cognome: $nome $cognome <br/>
  Email: $email
  TESTO;  
  echo $stringa;
} else {
  echo $form;
}
?>
