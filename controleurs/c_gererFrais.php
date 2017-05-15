<?php
include("vues/v_sommaire.php");
$idVisiteur = $_SESSION['idVisiteur'];

$mois = $_SESSION['mois'];
$numAnnee =substr( $mois,0,4);
$numMois =substr( $mois,4,2);

$action = $_REQUEST['action'];

switch($action){
	case 'moisPrecedent':{
		$_SESSION['mois'] = getMois(date("d/m/Y",strtotime("-1 month")));
		$mois = $_SESSION['mois'];
		
		if($pdo->estPremierFraisMois($idVisiteur,$mois)){
			$pdo->creeNouvellesLignesFrais($idVisiteur,$mois);
		}
		break;
	}
	
	case 'moisCourant':{
		$_SESSION['mois'] = getMois(date("d/m/Y"));
		$mois = $_SESSION['mois'];
		
		if($pdo->estPremierFraisMois($idVisiteur,$mois)){
			$pdo->creeNouvellesLignesFrais($idVisiteur,$mois);
		}
		break;
	}
	
	case 'validerMajFraisForfait':{
		$lesFrais = $_REQUEST['lesFrais'];
		if(lesQteFraisValides($lesFrais)){
	  	 	$pdo->majFraisForfait($idVisiteur,$mois,$lesFrais);
		}
		else{
			ajouterErreur("Les valeurs des frais doivent être numériques");
			include("vues/v_erreurs.php");
		}
		break;
	}
	
	case 'validerCreationFrais':{
		$dateFrais = $_REQUEST['dateFrais'];
		$libelle = $_REQUEST['libelle'];
		$montant = $_REQUEST['montant'];
		valideInfosFrais($dateFrais,$libelle,$montant);
		if (nbErreurs() != 0 ){
			include("vues/v_erreurs.php");
		}
		else{
			$pdo->creeNouveauFraisHorsForfait($idVisiteur,$mois,$libelle,$dateFrais,$montant);
		}
		break;
	}
	
	case 'supprimerFrais':{
		$idFrais = $_REQUEST['idFrais'];
	    $pdo->supprimerFraisHorsForfait($idFrais);
		break;
	}
	
	case 'validerCreationFraisForfait':{
		echo$mois;
		$fraisForfait = $_REQUEST['fraisForfait'];
		$quantite = $_REQUEST['quantite'];
		if (nbErreurs() != 0 ){
			include("vues/v_erreurs.php");
		}
		else{
			$pdo->creeNouveauFraisForfait($quantite,$mois,$fraisForfait,$idVisiteur);
		}
		break;
	}
}
$mois = $_SESSION['mois'];
$numAnnee =substr( $mois,0,4);
$numMois =substr( $mois,4,2);

$lesFraisForfait= $pdo->getLesFraisForfait($idVisiteur,$mois);
//echo$mois;
//print_r($lesFraisForfait);
$lesFraisHorsForfait = $pdo->getLesFraisHorsForfait($idVisiteur,$mois);
$listeTypesFraisForfait = $pdo->getListeFraisForfait();

include("vues/v_fichePrecedente.php");
include("vues/v_listeFraisForfait.php");
include("vues/v_ajoutfraisForfait.php");
include("vues/v_listeFraisHorsForfait.php");
?>