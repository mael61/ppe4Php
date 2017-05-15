<?php
require_once("../include/fct.inc.php");
require_once ("../include/class.pdogsb.inc.php");
$ids=$_GET['employe'];
$pdo = PdoGsb::getPdoGsb();
$reservation = $pdo->retourneReservation($ids);
$result = count($reservation);
print $result;

echo '<select id="reservation2" name="reservation2" onchange="verif()">';
for ($i=0;$i <= $result;$i++) {
	$resarv=$reservation[$i]['idReservation'];
echo "<option value=$resarv> $resarv</option>";	
}
echo"</select>";


?>

  