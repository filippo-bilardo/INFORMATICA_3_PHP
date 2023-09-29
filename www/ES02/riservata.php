<html>
<body>
    <h1>Verifica dati inseriti</h1>

    <?php

    $Nome = $_GET['nome'];
    $Password = $_GET["password"];
    
    echo "Benvenuto $Nome<br>\n";
    echo "Hai inserito come password $Password";

    ?>
</body>
</html>