<?php
include("vues/v_sommaire.php");
$action = $_REQUEST['action'];
$idVisiteur = $_SESSION['idVisiteur'];
switch($action){
	case 'creerEvenement':{
		include("vues/v_creationEvenement.php");
		break;
	}
	case 'validation':{
		$nomEvent = $_POST['nomEvent'];
		$dateDeb = $_POST['dateD'];
		$dateFin = $_POST['dateF'];
		$dateD = new DateTime($_POST['dateD']);
		$dateF = new DateTime($_POST['dateF']);
		$diff = $dateD->diff($dateF);
		$diff = $diff->format('%d');
		$duree = intval($diff);
		$villeEvent = $_POST['villeEvent'];
		echo $nomEvent;
		echo $duree;
		echo $villeEvent;
		echo $idVisiteur;
		valideInfoEven($nomEvent, $dateDeb, $dateFin, $villeEvent);
		if (nbErreurs() != 0 ){
			include("vues/v_erreurs.php");
		}
		else{
			$pdo->creerEvent($nomEvent, $dateDeb, $duree, $villeEvent, $idVisiteur);
		}
		break;
	}
}

?>