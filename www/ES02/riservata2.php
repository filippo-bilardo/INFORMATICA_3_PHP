<html>
<body>
    <h1>Verifica dati inseriti</h1>

    <?php

    $nome = $_GET["nome"];
    $pwd = $_GET["password"];
    $nome2 = $_POST['nome2'];
    $pwd2 = $_POST["password2"];

    echo '$_GET["nome"]='. $nome ."<br>\n";
    echo '$_GET["password"]='. $pwd ."<br>\n";
    echo "<br><br>\n";
    echo '$_POST["nome"]='. $nome2 ."<br>\n";
    echo '$_POST["password"]='. $pwd2 ."<br>\n";
    echo "<br><br>\n";
    echo '$_REQUEST["nome"]='. $nome ."<br>\n";
    echo '$_REQUEST["nome2"]='. $nome2 ."<br>\n";

    ?>
</body>
</html>