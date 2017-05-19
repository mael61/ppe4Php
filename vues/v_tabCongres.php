<?php
echo"
<h3>Liste des congrès</h3>";
?>
<table border=1>
	<tr>
		<td>
			Visiteur
		</td>
		<td>
			Nom
		</td>
		<td>
			Date
		</td>
		<td>
			Durée
		</td>
		<td>
			Ville
		</td>
	</tr>
<?php
				foreach ($lesCongres as $unCongres )
				{
					$visiteur = $unCongres['idVisiteur'];
					$nom = $unCongres['nom'];
					$date = $unCongres['dateEv'];
					$duree = $unCongres['duree'];
					$ville = $unCongres['ville'];
			?>
					<tr>
						<td>
							<?php echo $visiteur ?>
						</td>
						<td>
							<?php echo $nom ?>
						</td>
						<td>
							<?php echo $date ?>
						</td>
						<td>
							<?php echo $duree ?>
						</td>
						<td>
							<?php echo $ville ?>
						</td>
					</tr>
			
			<?php
				}
			?>
<table>	