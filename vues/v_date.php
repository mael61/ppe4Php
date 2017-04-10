<?php
require_once("../include/fct.inc.php");
require_once ("../include/class.pdogsb.inc.php");
$ids=$_GET['event'];
$hotel=$_GET['hotel'];
$nombreJours=$_GET['nombre'];
$pdo = PdoGsb::getPdoGsb();
$date=$pdo->dateEvenement($ids);

echo"<br>";
echo "L'Hotel est :";
echo $hotel;
echo"<br>";
echo "L'evenement commence a cette date :";
echo($date[0]['dateEv']);
echo $nombreJours;

?>











