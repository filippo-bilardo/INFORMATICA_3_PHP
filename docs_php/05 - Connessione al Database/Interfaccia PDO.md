## **Interfaccia PDO**

PDO (**PHP Data Objects**) è un'estensione PHP che fornisce un'interfaccia unificata per accedere a diversi tipi di database. A differenza di MySQLi, che è specifico per MySQL/MariaDB, PDO supporta più driver di database (es. MySQL, PostgreSQL, SQLite, Oracle), rendendolo ideale per applicazioni che richiedono portabilità tra diversi sistemi di gestione dei database.

In questa sezione vedremo come utilizzare PDO per connettersi al database, eseguire query, gestire errori, transazioni e prepared statements.

---

### **1. Connessione al Database**

Per stabilire una connessione al database con PDO, si utilizza la classe `PDO`. Il costruttore della classe accetta una stringa di connessione (DSN) e le credenziali del database.

#### **Esempio di Connessione:**
```php
<?php
// Parametri di connessione
$host = "localhost";
$dbname = "testdb";
$username = "root";
$password = "";

try {
    // Stringa DSN (Data Source Name)
    $dsn = "mysql:host=$host;dbname=$dbname;charset=utf8mb4";

    // Creazione dell'oggetto PDO
    $pdo = new PDO($dsn, $username, $password);

    // Impostazione del modo di gestione degli errori
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    echo "Connessione riuscita!";
} catch (PDOException $e) {
    die("Errore di connessione: " . $e->getMessage());
}
?>
```

**Spiegazione:**
- `$dsn` specifica il tipo di database (`mysql`) e i parametri di connessione.
- `$pdo->setAttribute()` imposta il modo di gestione degli errori su `PDO::ERRMODE_EXCEPTION` per lanciare eccezioni in caso di errore.

---

### **2. Esecuzione di Query**

Per eseguire una query SQL con PDO, si utilizza il metodo `query()` o `exec()`.

#### **Esempio di Query SELECT:**
```php
<?php
$query = "SELECT id, name, email FROM users";

try {
    // Esecuzione della query
    $stmt = $pdo->query($query);

    // Recupero dei risultati
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        echo "ID: " . $row["id"] . ", Nome: " . $row["name"] . ", Email: " . $row["email"] . "<br>";
    }
} catch (PDOException $e) {
    echo "Errore nella query: " . $e->getMessage();
}
?>
```

**Spiegazione:**
- `$pdo->query()` esegue la query SQL.
- `$stmt->fetch(PDO::FETCH_ASSOC)` recupera una riga come array associativo.

---

### **3. Prepared Statements**

Le prepared statements in PDO utilizzano il metodo `prepare()` per creare uno statement preparato.

#### **Esempio di Prepared Statement:**
```php
<?php
$query = "INSERT INTO users (name, email) VALUES (:name, :email)";

try {
    // Preparazione dello statement
    $stmt = $pdo->prepare($query);

    // Associazione dei parametri
    $name = "Mario Rossi";
    $email = "mario@example.com";
    $stmt->bindParam(":name", $name);
    $stmt->bindParam(":email", $email);

    // Esecuzione dello statement
    if ($stmt->execute()) {
        echo "Record inserito con successo!";
    } else {
        echo "Errore durante l'inserimento.";
    }
} catch (PDOException $e) {
    echo "Errore: " . $e->getMessage();
}
?>
```

**Spiegazione:**
- `$pdo->prepare()` prepara la query.
- `$stmt->bindParam()` associa i valori ai segnaposto (es. `:name`, `:email`).
- `$stmt->execute()` esegue lo statement preparato.

---

### **4. Gestione degli Errori**

PDO offre diverse modalità per gestire gli errori:
- `PDO::ERRMODE_SILENT`: Nessun messaggio di errore (default).
- `PDO::ERRMODE_WARNING`: Genera avvisi PHP.
- `PDO::ERRMODE_EXCEPTION`: Lancia eccezioni in caso di errore.

#### **Esempio di Gestione degli Errori:**
```php
<?php
try {
    $query = "SELECT * FROM non_existent_table";
    $pdo->query($query);
} catch (PDOException $e) {
    echo "Errore: " . $e->getMessage();
}
?>
```

**Spiegazione:**
- Le eccezioni vengono lanciate grazie a `PDO::ERRMODE_EXCEPTION`.

---

### **5. Transazioni**

Le transazioni in PDO utilizzano i metodi `beginTransaction()`, `commit()` e `rollBack()`.

#### **Esempio di Transazione:**
```php
<?php
try {
    // Inizio della transazione
    $pdo->beginTransaction();

    // Query 1: Aggiorna il saldo di un utente
    $query1 = "UPDATE accounts SET balance = balance - 100 WHERE user_id = 1";
    $pdo->exec($query1);

    // Query 2: Aggiorna il saldo di un altro utente
    $query2 = "UPDATE accounts SET balance = balance + 100 WHERE user_id = 2";
    $pdo->exec($query2);

    // Conferma della transazione
    $pdo->commit();
    echo "Transazione confermata con successo!";
} catch (Exception $e) {
    // Annullamento della transazione
    $pdo->rollBack();
    echo "Errore: " . $e->getMessage();
}
?>
```

**Spiegazione:**
- `$pdo->beginTransaction()` avvia una nuova transazione.
- `$pdo->commit()` conferma le modifiche.
- `$pdo->rollBack()` annulla le modifiche in caso di errore.

---

### **6. Recupero dei Risultati**

I risultati delle query possono essere recuperati in diversi formati:
- `PDO::FETCH_ASSOC`: Array associativo.
- `PDO::FETCH_OBJ`: Oggetto anonimo.
- `PDO::FETCH_BOTH`: Array associativo e numerico.

#### **Esempio di Recupero dei Risultati:**
```php
<?php
$query = "SELECT id, name, email FROM users";

try {
    $stmt = $pdo->query($query);

    // Recupero dei risultati come oggetti
    while ($row = $stmt->fetch(PDO::FETCH_OBJ)) {
        echo "ID: " . $row->id . ", Nome: " . $row->name . ", Email: " . $row->email . "<br>";
    }
} catch (PDOException $e) {
    echo "Errore: " . $e->getMessage();
}
?>
```

**Spiegazione:**
- `$stmt->fetch(PDO::FETCH_OBJ)` recupera una riga come oggetto.

---

### **7. Chiusura della Connessione**

PDO non ha un metodo esplicito per chiudere la connessione. Quando l'oggetto `$pdo` esce dallo scope, la connessione viene chiusa automaticamente.

#### **Esempio di Chiusura Implicita:**
```php
<?php
// La connessione viene chiusa automaticamente quando l'oggetto $pdo non è più utilizzato
unset($pdo);
?>
```

---

### **Confronto tra PDO e MySQLi**

| **Aspetto**                | **PDO**                                    | **MySQLi**                                |
|----------------------------|--------------------------------------------|-------------------------------------------|
| **Supporto Multi-Database**| Sì (MySQL, PostgreSQL, SQLite, ecc.)       | No (solo MySQL/MariaDB)                   |
| **Stile di Programmazione**| Solo orientato agli oggetti               | Procedurale e OO                          |
| **Prepared Statements**    | Supportati nativamente                    | Supportati nativamente                    |
| **Gestione degli Errori**  | Eccezioni integrate                       | Richiede configurazione manuale           |
| **Portabilità**            | Alta                                      | Bassa                                     |

---

### **Conclusioni**

PDO è un'interfaccia potente e flessibile per interagire con i database in PHP. Grazie al suo supporto multi-database, alla gestione avanzata degli errori e alle prepared statements, PDO è particolarmente adatto per progetti complessi e applicazioni che richiedono portabilità tra diversi sistemi di gestione dei database.
