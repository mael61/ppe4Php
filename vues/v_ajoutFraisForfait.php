<?php
if(count($lesFraisForfait)<4){
echo"
<fieldset><h3>Ajouter un nouveau frais</h3>
<form method='POST' action='index.php?uc=gererFrais&action=validerCreationFraisForfait'>
<table class='tabNonQuadrille'>

<tr>
	<td>Type de frais</td>
	<td>
		<select name='fraisForfait'>";

			foreach ($listeTypesFraisForfait as $unFrais)
			{
				echo"<option value=".$unFrais['idfrais'].">".$unFrais['libelle']."</option>";
			}
		
		echo"</select>
	</td>
</tr>
<tr>
	<td>Quantité</td>
	<td>
		<input  type='text' name='quantite'  size='30' maxlength='45'>
	</td>
</tr>
</table>
<input type='submit' value='Valider' name='valider'>
         <input type='reset' value='Annuler' name='annuler'>

</form>
</fieldset>
";
}
?>