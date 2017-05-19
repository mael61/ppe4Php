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
				<td><?php echo $ligneEvenement['nom']?></td>
				<td><?php echo $ligneEvenement['dateEv']?></td>
				<td><?php echo $ligneEvenement['duree']?></td>
				<td><?php echo $ligneEvenement['ville']?></td>
			</tr>
		<?php
			}
		}
		?>
		
	</table>

</div>