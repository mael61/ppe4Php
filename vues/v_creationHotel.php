<div id="contenu">
      <h2>crée un hotel</h2>
	   <form method="POST"  action="index.php?uc=creationHotel&action=uploadHotel"> 
	   <h3> Selectionner une ville</h3>
	   		<select id="ville" name="ville" onchange="verif()">
			
			<option value="">Selectionner une ville:</option>'
			<?php
				foreach ($ville as $uneVille)
				{
						$ville=$uneVille['ville'];
			?>
					<p><hotel/p>
						 <option   value="<?php echo $ville; ?>" selected> <?php echo $ville; ?></option>
			<?php
				}
			?>
			</select>
			 <p>Nom  de l'hotel: <input type="text" name="nom" /></p>
			
			
			 <div class="piedForm">
      <p>
        <input id="ok" type="submit" value="Valider" size="20" />
        <input id="annuler" type="reset" value="Effacer" size="20" />
      </p> 
      </div>
        
      </form>