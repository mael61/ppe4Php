<?php
include("vues/v_sommaire.php");
$idVisiteur = $_SESSION['idVisiteur'];
$pdo = PdoGsb::getPdoGsb();
$action = $_REQUEST['action'];
switch($action){
	
	case 'saisieVille':{	
		$lesHotels=$pdo->listeAvecVille();
		$ville=$pdo->listeVilleEv();
		include("vues/v_creationHotel.php");
		break;
		}
		
	case 'uploadHotel':{
		$libelle=$_REQUEST['nom'];
		$ville=$_REQUEST['ville'];
		echo $libelle;
		echo $ville;
		valideInsertionHotel($libelle,$ville);
		if (nbErreurs() != 0 ){
			include("vues/v_erreurs.php");
		}
		else{
	echo"ok cela fonctionne";			
	//$pdo->insertionHotel
	}
}
}

?>