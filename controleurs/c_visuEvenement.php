<?php
include("vues/v_sommaire.php");
$action = $_REQUEST['action'];
$idVisiteur = $_SESSION['idVisiteur'];
switch($action){
	case 'visuUnEvenement':{
		include("vues/v_voirEvenement.php");
		$lesEvenements=$pdo->getEvent($idVisiteur);	
	break;
	}
}

?>