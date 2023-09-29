<html>
<body>
    <h1>Verifica dati inseriti</h1>

    <?php
    $nome = $_GET['nome'];
    $pwd = $_GET["password"];

    echo "Dati inseriti tramite il form html:<br/>\n";
    echo "nome = $nome<br/>\n";
    echo "password = $pwd<br/>\n";
    echo "<br/><br/>\n";

    if($nome!="admin" && $pwd!='passwd')
    {
        echo "<h4>Attenzione! Nome utente o password sbagliate</h4>";
    }
    else
    {
        echo "<h4>Benvenuto $nome <br/>Nell'area riservata del sito!</h4>";
    }
    ?>
</body>
</html>