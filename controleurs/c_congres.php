<?php
include("vues/v_sommaire.php");
$idVisiteur = $_SESSION['idVisiteur'];

$action = $_REQUEST['action'];

switch($action){
	case 'verification':{
		if($pdo->estDelegue($idVisiteur)){
			$lesCongres = $pdo->tousLesEvenementsDelegue($idVisiteur);
			include('vues/v_tabCongres.php');
		}
		else{
			include('vues/v_pasDelegue.php');
		}
		break;
	}
}

?>