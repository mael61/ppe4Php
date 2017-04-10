<?php
include("vues/v_sommaire.php");
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
		
	}

?>