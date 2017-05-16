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
echo " Pour l'evenement qui est :";
echo $ids;
echo "<br>";
echo "Et qui commence a cette date :";
$date=$date[0]['dateEv'];
echo $date;
echo"<br>";
echo "Pour une durée de ";
echo $nombreJours;
echo "jours";
//echo $test= $pdo->FindateEvenement($date);
//echo "et qui finira a cette date"

?>











