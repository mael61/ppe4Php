<?php
include("vues/v_sommaire.php");
require_once("include/fct.inc.php");
$idVisiteur = $_SESSION['idVisiteur'];
$mois = getMois(date("d/m/Y"));
$numAnnee =substr( $mois,0,4);
$numMois =substr( $mois,4,2);
$action = $_REQUEST['action'];
switch($action){
	case 'saisieVille':{
		$lesHotels=$pdo->listeAvecVille();
		include("vues/v_listeHotel.php");
		break;
		}
		
	case 'saisieHotel':{
		$villeSelectionner=$_REQUEST['ville']; 
		$lesHotels=$pdo->listeAvecVille();
		$lesHotelsVille=$pdo->listeHotelpourVille($villeSelectionner);
		$lesEvenementVille=$pdo->listeEvenementpourVille($villeSelectionner);
		include("vues/v_listeHotel.php");
		include("vues/v_listeHotelVille.php");
		break;
		}
	case 'uploadReservation':{
		$duree=$_REQUEST['nombre'];
		$Hotel=$_REQUEST['hotel'];
		$Evenement=$_REQUEST['evenement'];
		$idHotel=$pdo->retourneIdHotel($Hotel);
		$idHotel=$idHotel[0]['idHotel'];
		$idEvenement=$pdo->retourneIdEvenement($Evenement);
		$idEvenement=$idEvenement[0]['idEvenement'];
		$date=$pdo->dateEvenement($Evenement);
		//print_r ($date);
		$date=$date[0]['dateEv'];
		//print_r ($idHotel);
		// print_r ($idEvenement);
		// print_r ($date);
		
		//echo "id hotel".$idHotel."/";
		//echo "id evenement".$idEvenement."/";
		//echo "date".$date."/";
		valideInfoReservation($idHotel,$idEvenement,$duree);
		if (nbErreurs() != 0 ){
			include("vues/v_erreurs.php");
		}
		else{	
		$pdo->reservationHotel($date,$duree,$idHotel,$idEvenement,$idVisiteur);
		$reservation = $pdo->retourneReservation($idVisiteur);
		include("vues/v_listeReservation.php");
			}
		break;
		}
}

?>