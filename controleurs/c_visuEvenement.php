<?php
include("vues/v_sommaire.php");
$action = $_REQUEST['action'];
$idVisiteur = $_SESSION['idVisiteur'];
switch($action){
	case 'visuUnEvenement':{
		$lesEvenements=$pdo->getEvent($idVisiteur);	
		include("vues/v_voirEvenement.php");
	break;
	}
}

?>