<div id="contenu">
	<h2>Les evenements</h2>
	
	<form method='POST' action='index.php?uc=creerEvenement&action=creerEvenement'>
		<input id="creerEvent" type="submit" value="Creer un Evenement" size="20" />
	</form>
	
	<table class="listelegere">
		<tr>
			<th>Nom</th>
			<th>Date de Debut</th>
			<th>Duree</th>
			<th>Ville</th>
		</tr>
		<?php
		if(count($lesEvenements)>0){
			foreach($lesEvenements as $ligneEvenement){
		?>
		<tr>
			<td><?=$ligneEvenement['nom']?></td>
			<td><?=$ligneEvenement['dateEv']?></td>
			<td><?=$ligneEvenement['duree']?></td>
			<td><?=$ligneEvenement['ville']?></td>
		</tr>
		<?php
			}
		}
		?>
		
	</table>

</div>