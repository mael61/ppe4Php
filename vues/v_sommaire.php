    <!-- Division pour le sommaire -->
    <div id="menuGauche">
     <div id="infosUtil">
    
        <h2></h2>
    
      </div>  
        <ul id="menuList">
			<li >
				  Visiteur :<br>
				<?php echo $_SESSION['prenom']."  ".$_SESSION['nom']  ?>
			</li>

			<li class="smenu">
				<a href="index.php?uc=gererFrais&action=moisCourant" title="Saisie fiche de frais ">Saisie fiche de frais</a>
			</li>
			<li class="smenu">
				<a href="index.php?uc=etatFrais&action=selectionnerMois" title="Consultation de mes fiches de frais">Mes fiches de frais</a>
			</li>
			<li class="smenu">
				<a href="index.php?uc=visuEvenement&action=visuUnEvenement" title="Visulaiser les événements">Visualiser les événements</a>
			</li>
			<li class="smenu">
              <a href="index.php?uc=creationHotel&action=saisieVille" title="Creation d'un Hotel">Creation d'un Hotel</a>
           </li>
		   
		   <li class="smenu">
              <a href="index.php?uc=gererReservation&action=saisieVille" title="Saisie Reservation Hotel">Saisie Reservation Hotel</a>
           </li>
		   
		   <li class="smenu">
              <a href="index.php?uc=visuReservation&action=visuReservation" title="Visualiser les reservation">Visualiser les reservation </a>
           </li>
		   
		   <li class="smenu">
				<a href="index.php?uc=congres&action=verification" title="Afficher les congrès">Afficher les congrès</a>
			</li>
			<li class="smenu">
				<a href="index.php?uc=connexion&action=deconnexion" title="Se déconnecter">Déconnexion</a>
			</li>
		</ul>

    </div>
    