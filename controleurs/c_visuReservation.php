<?php
include("vues/v_sommaire.php");

$idVisiteur = $_SESSION['idVisiteur'];
$action = $_REQUEST['action'];
$pdo = PdoGsb::getPdoGsb();
$status=$pdo-> statutVisiteur($idVisiteur);
$status=$status[0]['idRole'];
switch($action){
	case 'visuReservation':{
		$reservation = $pdo->retourneReservation($idVisiteur);
		include("vues/v_listeReservation.php");
		if (($status == 2)||($status == 3)){
			echo "vous etes responsable de quelqu'un voici sa liste de reservation ";
			$inferieur=$pdo->retourneHierachie($idVisiteur);
			//print_r($inferieur);
			include("vues/v_listeReservationInferieur.php");
		}
		break;
		}
		
	}
		
	

?>