<?php

define('TEST_CONSTANT', 123);

$anArray = array(1, 'test' => 2, 'test2' => ['t' => 123]);
$aFloat = 1.23;
$anInt = 123;
$aString = '123';
$anEmptyString = '';
$aVeryLongString = str_repeat('lol', 1000);
$aBoolean = true;
$nullValue = null;
$variableThatsNotSet;
$aLargeArray = array_fill(0, 100, 'test');
$arrayWithSpaceKey = array('space key' => 1);


echo "Helloooo<br>";
echo $aFloat + $anInt;
echo "<br>"; $a="10"; $b=20; echo $a . $b;
echo "<br>"; $c="Ciao"; $d=20; echo $c . $d;
echo "<br>";
echo "risultato = " . $aFloat . $anInt;
echo "<br>";
echo "<br>";
echo "<br>";
$nome="Mario";
$cogn="Rossi";
echo "Cioa $nome       $cogn";
echo "<br>";
echo 'Cioa $nome       $cogn';

exit;