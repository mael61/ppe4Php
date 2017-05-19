<?php
/** 
 * Classe d'accès aux données. 
 
 * Utilise les services de la classe PDO
 * pour l'application GSB
 * Les attributs sont tous statiques,
 * les 4 premiers pour la connexion
 * $monPdo de type PDO 
 * $monPdoGsb qui contiendra l'unique instance de la classe
 
 * @package default
 * @author Cheri Bibi
 * @version    1.0
 * @link       http://www.php.net/manual/fr/book.pdo.php
 */

class PdoGsb{   		
      	private static $serveur='mysql:host=localhost';
      	private static $bdd='dbname=piroma_php';   		
      	private static $user='root' ;  
      	private static $mdp='' ;
		private static $monPdo;
		private static $monPdoGsb=null;
/**
 * Constructeur privé, crée l'instance de PDO qui sera sollicitée
 * pour toutes les méthodes de la classe
 */				
	private function __construct(){
    	PdoGsb::$monPdo = new PDO(PdoGsb::$serveur.';'.PdoGsb::$bdd, PdoGsb::$user, PdoGsb::$mdp); 
		PdoGsb::$monPdo->query("SET CHARACTER SET utf8");
	}
	public function _destruct(){
		PdoGsb::$monPdo = null;
	}
/**
 * Fonction statique qui crée l'unique instance de la classe
 
 * Appel : $instancePdoGsb = PdoGsb::getPdoGsb();
 
 * @return l'unique objet de la classe PdoGsb
 */
	public  static function getPdoGsb(){
		if(PdoGsb::$monPdoGsb==null){
			PdoGsb::$monPdoGsb= new PdoGsb();
		}
		return PdoGsb::$monPdoGsb;  
	}
/**
 * Retourne les informations d'un visiteur
 
 * @param $login 
 * @param $mdp
 * @return l'id, le nom et le prénom sous la forme d'un tableau associatif 
*/
	public function getInfosVisiteur($login, $mdp){
		$req = "select visiteur.idVisiteur as id, visiteur.nom as nom, visiteur.prenom as prenom from visiteur 
		where visiteur.loginUser='$login' and visiteur.mdp='$mdp'";
		$rs = PdoGsb::$monPdo->query($req);
		$ligne = $rs->fetch();
		return $ligne;
	}

/**
 * Retourne sous forme d'un tableau associatif toutes les lignes de frais hors forfait
 * concernées par les deux arguments
 
 * La boucle foreach ne peut être utilisée ici car on procède
 * à une modification de la structure itérée - transformation du champ date-
 
 * @param $idVisiteur 
 * @param $mois sous la forme aaaamm
 * @return tous les champs des lignes de frais hors forfait sous la forme d'un tableau associatif 
*/
	public function getLesFraisHorsForfait($idVisiteur,$mois){
	    $req = "select * from ligneFraisHorsForfait where ligneFraisHorsForfait.idVisiteur ='$idVisiteur' 
		and ligneFraisHorsForfait.idFicheFrais = '$mois' ";	
		$res = PdoGsb::$monPdo->query($req);
		$lesLignes = $res->fetchAll();
		$nbLignes = count($lesLignes);
		for ($i=0; $i<$nbLignes; $i++){
			$date = $lesLignes[$i]['laDate'];
			$lesLignes[$i]['laDate'] =  dateAnglaisVersFrancais($date);
		}
		return $lesLignes; 
	}
/**
 * Retourne le nombre de justificatif d'un visiteur pour un mois donné
 
 * @param $idVisiteur 
 * @param $mois sous la forme aaaamm
 * @return le nombre entier de justificatifs 
*/
	public function getNbjustificatifs($idVisiteur, $mois){
		$req = "select ficheFrais.nbJustificatifs as nb from  ficheFrais where ficheFrais.idVisiteur ='$idVisiteur' and ficheFrais.mois = '$mois'";
		$res = PdoGsb::$monPdo->query($req);
		$laLigne = $res->fetch();
		return $laLigne['nb'];
	}
/**
 * Retourne sous forme d'un tableau associatif toutes les lignes de frais au forfait
 * concernées par les deux arguments
 
 * @param $idVisiteur 
 * @param $mois sous la forme aaaamm
 * @return l'id, le libelle et la quantité sous la forme d'un tableau associatif 
*/
	public function getLesFraisForfait($idVisiteur, $mois){
		$req = "select DISTINCT fraisForfait.idFraisForfait as idFrais, fraisForfait.libelle as libelle, ligneFraisForfait.quantite as quantite from ficheFrais ,ligneFraisForfait, fraisForfait where ligneFraisForfait.idVisiteur = '$idVisiteur' and fraisForfait.idFraisForfait = ligneFraisForfait.idFraisForfait and ficheFrais.mois = '$mois' and ligneFraisForfait.idFicheFrais = ficheFrais.mois ";
		$res = PdoGsb::$monPdo->query($req);
		$lesLignes = $res->fetchAll();
		return $lesLignes; 
	}
/**
 * Retourne sous forme d'un tableau associatif tous les types de frais au forfait
 
 * @return l'id, le libelle et le montant sous la forme d'un tableau associatif 
*/
	public function getListeFraisForfait(){
		$req = "select DISTINCT fraisForfait.idFraisForfait as idFrais, fraisForfait.libelle as libelle, fraisForfait.montant as montant from fraisForfait";
		$res = PdoGsb::$monPdo->query($req);
		$lesLignes = $res->fetchAll();
		return $lesLignes; 
	}
/**
 * Retourne tous les id de la table FraisForfait
 
 * @return un tableau associatif 
*/
	public function getLesIdFrais(){
		$req = "select fraisForfait.idFraisForfait as idFrais from fraisForfait order by fraisForfait.idFraisForfait ";
		$res = PdoGsb::$monPdo->query($req);
		$lesLignes = $res->fetchAll();
		return $lesLignes;
	}
/**
 * Met à jour la table ligneFraisForfait
 
 * Met à jour la table ligneFraisForfait pour un visiteur et
 * un mois donné en enregistrant les nouveaux montants
 
 * @param $idVisiteur 
 * @param $mois sous la forme aaaamm
 * @param $lesFrais tableau associatif de clé idFrais et de valeur la quantité pour ce frais
 * @return un tableau associatif 
*/
	public function majFraisForfait($idVisiteur, $mois, $lesFrais){
		$lesCles = array_keys($lesFrais);
		foreach($lesCles as $unIdFrais){
			$qte = $lesFrais[$unIdFrais];
			$req = "update ligneFraisForfait set ligneFraisForfait.quantite = $qte
			where ligneFraisForfait.idvisiteur = '$idVisiteur' and ligneFraisForfait.idFicheFrais = '$mois'
			and ligneFraisForfait.idFraisForfait = '$unIdFrais'";
			PdoGsb::$monPdo->exec($req);
		}
		
	}
/**
 * met à jour le nombre de justificatifs de la table ficheFrais
 * pour le mois et le visiteur concerné
 
 * @param $idVisiteur 
 * @param $mois sous la forme aaaamm
*/
	public function majNbJustificatifs($idVisiteur, $mois, $nbJustificatifs){
		$req = "update ficheFrais set nbJustificatifs = $nbJustificatifs 
		where ficheFrais.idvisiteur = '$idVisiteur' and ficheFrais.mois = '$mois'";
		PdoGsb::$monPdo->exec($req);	
	}
/**
 * Teste si un visiteur possède une fiche de frais pour le mois passé en argument
 
 * @param $idVisiteur 
 * @param $mois sous la forme aaaamm
 * @return vrai ou faux 
*/	
	public function estPremierFraisMois($idVisiteur,$mois)
	{
		$ok = false;
		$req = "select count(*) as nbLignesFrais from ficheFrais 
		where ficheFrais.mois = '$mois' and ficheFrais.idVisiteur = '$idVisiteur'";
		$res = PdoGsb::$monPdo->query($req);
		$laLigne = $res->fetch();
		if($laLigne['nbLignesFrais'] == 0){
			$ok = true;
		}
		return $ok;
	}
/**
 * Retourne le dernier mois en cours d'un visiteur
 
 * @param $idVisiteur 
 * @return le mois sous la forme aaaamm
*/	
	public function dernierMoisSaisi($idVisiteur){
		$req = "select max(mois) as dernierMois from ficheFrais where ficheFrais.idVisiteur = '$idVisiteur'";
		$res = PdoGsb::$monPdo->query($req);
		$laLigne = $res->fetch();
		$dernierMois = $laLigne['dernierMois'];
		return $dernierMois;
	}
	
/**
 * Crée une nouvelle fiche de frais et les lignes de frais au forfait pour un visiteur et un mois donnés
 * récupère le dernier mois en cours de traitement, met à 'CL' son champs idEtat, crée une nouvelle fiche de frais
 * avec un idEtat à 'CR' et crée les lignes de frais forfait de quantités nulles 
 
 * @param $idVisiteur 
 * @param $mois sous la forme aaaamm
*/
	public function creeNouvellesLignesFrais($idVisiteur,$mois){
		$dernierMois = $this->dernierMoisSaisi($idVisiteur);
		$laDerniereFiche = $this->getLesInfosFicheFrais($idVisiteur,$dernierMois);
		if($laDerniereFiche['idEtat']=='CR'){
				$this->majEtatFicheFrais($idVisiteur, $dernierMois,'CL');
				
		}
		$req = "insert into ficheFrais(idVisiteur,mois,nbJustificatifs,montantValide,dateModif,idEtat) 
		values('$idVisiteur','$mois',0,0,now(),'CR')";
		PdoGsb::$monPdo->exec($req);
		$lesIdFrais = $this->getLesIdFrais();
		foreach($lesIdFrais as $uneLigneIdFrais){
			$unIdFrais = $uneLigneIdFrais['idfrais'];
			$req = "insert into ligneFraisForfait(idVisiteur,mois,idFraisForfait,quantite) 
			values('$idVisiteur','$mois','$unIdFrais',0)";
			PdoGsb::$monPdo->exec($req);
		 }
	}
/**
 * Crée un nouveau frais hors forfait pour un visiteur un mois donné
 * à partir des informations fournies en paramètre
 
 * @param $idVisiteur 
 * @param $mois sous la forme aaaamm
 * @param $libelle : le libelle du frais
 * @param $date : la date du frais au format français jj//mm/aaaa
 * @param $montant : le montant
*/
	public function creeNouveauFraisHorsForfait($idVisiteur,$mois,$libelle,$date,$montant){
		$dateFr = dateFrancaisVersAnglais($date);
		$req = "insert into ligneFraisHorsForfait (libelle, laDate, montant, valid, idFicheFrais, idVisiteur)
		values('$libelle','$dateFr','$montant',0,'$mois','$idVisiteur')";
		$temp = PdoGsb::$monPdo->exec($req);
		
	}
/**
 * 
 
 * @param $idVisiteur 
 * @param $mois sous la forme aaaamm
 * @param $libelle : le libelle du frais
 * @param $date : la date du frais au format français jj//mm/aaaa
 * @param $montant : le montant
*/
	public function creeNouveauFraisForfait($quantite,$mois,$fraisForfait,$idVisiteur){
		$req = "insert into ligneFraisForfait (quantite, idFicheFrais, idFraisForfait, idVisiteur)
		values('$quantite','$mois','$fraisForfait','$idVisiteur')";
		$temp = PdoGsb::$monPdo->exec($req);
		
	}
/**
 * Supprime le frais hors forfait dont l'id est passé en argument
 
 * @param $idFrais 
*/
	public function supprimerFraisHorsForfait($idFrais){
		$req = "delete from ligneFraisHorsForfait where ligneFraisHorsForfait.idLigneFraisHorsForfait =$idFrais ";
		PdoGsb::$monPdo->exec($req);
	}
/**
 * Retourne les mois pour lesquel un visiteur a une fiche de frais
 
 * @param $idVisiteur 
 * @return un tableau associatif de clé un mois -aaaamm- et de valeurs l'année et le mois correspondant 
*/
	public function getLesMoisDisponibles($idVisiteur){
		$req = "select ficheFrais.mois as mois from  ficheFrais where ficheFrais.idVisiteur ='$idVisiteur' 
		order by ficheFrais.mois desc ";
		$res = PdoGsb::$monPdo->query($req);
		$lesMois =array();
		$laLigne = $res->fetch();
		while($laLigne != null)	{
			$mois = $laLigne['mois'];
			$numAnnee =substr( $mois,0,4);
			$numMois =substr( $mois,4,2);
			$lesMois["$mois"]=array(
		     "mois"=>"$mois",
		    "numAnnee"  => "$numAnnee",
			"numMois"  => "$numMois"
             );
			$laLigne = $res->fetch(); 		
		}
		return $lesMois;
	}
/**
 * Retourne les informations d'une fiche de frais d'un visiteur pour un mois donné
 
 * @param $idVisiteur 
 * @param $mois sous la forme aaaamm
 * @return un tableau avec des champs de jointure entre une fiche de frais et la ligne d'état 
*/	
	public function getLesInfosFicheFrais($idVisiteur,$mois){
		$req = "select ficheFrais.idEtat as idEtat, ficheFrais.dateModif as dateModif, ficheFrais.nbrJustificatif as nbJustificatif, ficheFrais.montantValide as montantValide, etat.libelle as libEtat from ficheFrais inner join Etat on ficheFrais.idEtat = Etat.idEtat where ficheFrais.idVisiteur ='$idVisiteur' and ficheFrais.mois = '$mois'";
			
			/*select ficheFrais.idEtat as idEtat, ficheFrais.dateModif as dateModif, fichefrais.nbrJustificatif as nbJustificatif, ficheFrais.montantValide as montantValide, etat.libelle as libEtat from fichefrais inner join Etat on ficheFrais.idEtat = Etat.idEtat where fichefrais.idvisiteur ='1' and fichefrais.mois = '3' */
			
			
		$res = PdoGsb::$monPdo->query($req);
		$laLigne = $res->fetch();
		return $laLigne;
	}
/**
 * Modifie l'état et la date de modification d'une fiche de frais
 
 * Modifie le champ idEtat et met la date de modif à aujourd'hui
 * @param $idVisiteur 
 * @param $mois sous la forme aaaamm
 */
 
	public function majEtatFicheFrais($idVisiteur,$mois,$etat){
		$req = "update ficheFrais set idEtat = '$etat', dateModif = now() 
		where ficheFrais.idvisiteur ='$idVisiteur' and ficheFrais.mois = '$mois'";
		PdoGsb::$monPdo->exec($req);
	}
	

	public function creerEvent($nom, $dateD, $duree, $ville, $idVis){
		$req ="insert into evenement(nom, dateEv, duree, ville, idVisiteur) values ('$nom','$dateD','$duree','$ville','$idVis')";
		PdoGsb::$monPdo->exec($req);
	}
	public function creerConf($libelle, $resume, $date, $idEvent){
		$req ="insert into evenement(nom, dateEv, duree, ville, idVisiteur) values ('$libelle','$resume','$date','$idEvent')";
		PdoGsb::$monPdo->exec($req);
	}
	
	public function getEvent($idVisiteur){
		$req ="select nom, dateEv, duree, ville from evenement where idVisiteur ='$idVisiteur'";
		PdoGsb::$monPdo->exec($req);
	}


/**
 * Mael Maillard
 
 * retourne la liste des villes avec des hotels
 * 
 * 
 */	
	
	public function listeAvecVille(){
		$req ="SELECT libelle,ville FROM `hotel` GROUP BY `ville` ASC ";
		$res = PdoGsb::$monPdo->query($req);
		$lesLignes = $res->fetchAll();
		return $lesLignes;
	}
	
	
	public function listeVilleEv(){
		$req ="SELECT ville FROM `evenement`";
		$res = PdoGsb::$monPdo->query($req);
		$lesLignes = $res->fetchAll();
		return $lesLignes;
	}
	 
	
	
/**
 * Mael Maillard
 
 * retourne la liste des hotel pour une ville séléctionner
 * @param $ville selectionner auparavant  
 * 
 */	
	
	public function listeHotelpourVille($ville){
		$req ="SELECT * FROM `hotel` where ville ='$ville'";
		$res = PdoGsb::$monPdo->query($req);
		$lesLignes = $res->fetchAll();
		return $lesLignes;
	}



/**
 * Mael Maillard
 
 * retourne la liste des evenement pour une ville séléctionner
 * @param $ville selectionner auparavant  
 * 
 */	
	public function listeEvenementpourVille($ville){
		$req ="SELECT nom,dateEv,duree FROM `evenement` where ville ='$ville'";
		$res = PdoGsb::$monPdo->query($req);
		$lesLignes = $res->fetchAll();
		return $lesLignes;
	}
	
	
	
/**
 * Mael Maillard
 
 * retourne la date de l'evenement pour un evenement séléctionner
 * @param $evenement selectionner auparavant  
 * 
 */	
	public function dateEvenement($evenement){
		$req ="SELECT nom,dateEv,duree FROM `evenement` where nom ='$evenement'";
		$res = PdoGsb::$monPdo->query($req);
		$lesLignes = $res->fetchAll();
		return $lesLignes;
	}
	
	
	public function FindateEvenement($date){
		$date = date_create('$date');
		echo date_format($date, 'Y-m-d H:i:s');

		$date->add(new DateInterval("P2D"));
		return $date;
	}
	
	
	
	
	
	
	
	
/**
 * Mael Maillard
 
 * effectue la reservation pour l'hotel en inserant
 * @param  dateReservation
 * @param  duree
 * @param  idHotel
 * @param  idEvenement
 * @param  idPraticien
 
 */		
	
	public function reservationHotel($dateReserv,$duree,$idHotel,$idEvenement,$idPraticien){
		// echo $dateReserv;
		// echo"/";
		// echo $duree;
		// echo"/";
		// echo $idHotel;
		// echo"/";
		// echo $idEvenement;
		// echo"/";
		// echo $idPraticien;
		$req ="INSERT INTO reservation (`dateReserv`, `duree`, `idHotel`, `idEvenement`, `idPraticien`) VALUES ( '$dateReserv', '$duree', '$idHotel', '$idEvenement', '$idPraticien')";
		PdoGsb::$monPdo->exec($req);
		
	}
	
	public function statutVisiteur($idVisiteur){
		$req = "SELECT idRole FROM `visiteur` where idVisiteur ='$idVisiteur'";
		$res = PdoGsb::$monPdo->query($req);
		$lesLignes = $res->fetchAll();
		return $lesLignes;
	}




	public function retourneIdHotel($hotel){
		$req ="SELECT idHotel FROM `hotel` where libelle ='$hotel'";
		$res = PdoGsb::$monPdo->query($req);
		$lesLignes = $res->fetchAll();
		return $lesLignes;
	}
	
	public function retourneIdEvenement($evenement){
		$req ="SELECT idEvenement FROM `evenement` where nom ='$evenement'";
		$res = PdoGsb::$monPdo->query($req);
		$lesLignes = $res->fetchAll();
		return $lesLignes;
	}

	
	public function retourneReservation($idVisiteur){
		$req ="SELECT * FROM `reservation`  where idPraticien = '$idVisiteur'";
		$res = PdoGsb::$monPdo->query($req);
		$lesLignes = $res->fetchAll();
		return $lesLignes;
	
	}
	public function retourneInfoReservation($idReservation){
		$req ="SELECT * FROM `reservation`  where idReservation = '$idReservation'";
		$res = PdoGsb::$monPdo->query($req);
		$lesLignes = $res->fetchAll();
		return $lesLignes;
	}
	
	public function retourneHotel($id){
		$req ="SELECT * FROM `hotel`  where idHotel = '$id'";
		$res = PdoGsb::$monPdo->query($req);
		$lesLignes = $res->fetchAll();
		return $lesLignes;
	}
	
	public function retourneEvenement($id){
		$req ="SELECT * FROM `evenement` where idEvenement = '$id'";
		$res = PdoGsb::$monPdo->query($req);
		$lesLignes = $res->fetchAll();
		return $lesLignes;
		
	}
	public function retourneHierachie($id){
		$req ="SELECT * FROM `visiteur` where visiteurLier = '$id'";
		$res = PdoGsb::$monPdo->query($req);
		$lesLignes = $res->fetchAll();
		return $lesLignes;		
	}
	
	
	public function insertionHotel($libelle,$ville){
		$req ="INSERT INTO `hotel` (`libelle`, `ville`) VALUES ('$libelle', '$ville')";
		PdoGsb::$monPdo->exec($req);
	}
}	
?>