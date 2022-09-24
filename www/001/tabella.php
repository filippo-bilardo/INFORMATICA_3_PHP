<html>
<head>
<title>Laboratorio  1</title>
</head>
<body>
    <h1>Tavola pitagorica</h1>
    <table border="1" cellspacing="3" cellpadding="2">
    <?php
    $limite=12;
    $limite2=12;
    for ($riga=1; $riga<=$limite; $riga++ )
    {
        echo "<tr>";
        for($colonna=1; $colonna<=$limite2; $colonna++)
        {
            $valore = $riga * $colonna;
            echo "<td align=\"center\">"; echo $valore; echo "</td>";
        }
        echo "</tr>";
    }
    ?>
    </table>
</body>
</html>
