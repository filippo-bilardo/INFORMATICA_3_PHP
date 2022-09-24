<html>
<head>
    <title>Tavola pitagorica php</title>
</head>
<body>
    <h1>Tavola pitagorica richiamata da pagina HTML</h1>
    <table border="1">
    <?php
    $limite = $_POST['limite'];
    $limite2 = $_POST['limite2'];
    for ($riga=1; $riga<=$limite; $riga++ )
    {
        echo "<tr>";
        for ($colonna=1; $colonna<=$limite2; $colonna++ )
        {
            $valore = $riga * $colonna;
            echo "<td>"; echo $valore; echo "</td>";
        }
        echo "</tr>";
    }
    ?>
    </table>
</body>
</html>
