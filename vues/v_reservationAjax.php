<?php
require_once("../include/fct.inc.php");
require_once("../include/class.pdogsb.inc.php");
$idReservation=$_GET['reservation'];
$pdo = PdoGsb::getPdoGsb();

$reservation = $pdo->retourneInfoReservation($idReservation);
$id=$reservation[0]['idReservation'];
$date=$reservation[0]['dateReserv'];
$dure=$reservation[0]['duree'];
$idHotel=$reservation[0]['idHotel'];
$idEvenement=$reservation[0]['idEvenement'];
$idPraticien=$reservation[0]['idPraticien'];
$hotel=$pdo->retourneHotel($idHotel);
$nomHotel=$hotel[0]['libelle'];
$villeHotel=$hotel[0]['ville'];
$evenement=$pdo->retourneEvenement($idEvenement);
$nomEvenement=$evenement[0]['nom'];
$dureEvenement=$evenement[0]['duree'];


$html= "<table>
<tr> 
<td>Nom de la ville</td>
<td>Nom de l'Hotel</td>
<td>Date de la reservation</td>
<td>durée de la reservation </td>
<td>Nom de l'evenement</td>
<td>Durée de l'evenment</td>
</tr>

<tr> 
<td>$villeHotel</td>
<td>$nomHotel</td>
<td>$date</td>
<td>$dure jours</td>
<td>$nomEvenement</td>
<td>$dureEvenement jours</td>
</tr>
</table>";
print $html;


?>