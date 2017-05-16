
      <h2>selectionner l'hotel pour la ville : 	<?php echo $villeSelectionner;	?></h2>
	 
         
      <form method="POST"  action="">
	
      
          
          <fieldset>
            <legend>
            </legend>
				<p> selectionner l'hotel</p>
			<form>
			
			<select id="hotel" name="hotel">;
			<option value="">Selectionner un hotel:</option>';
			<?php
				foreach ($lesHotelsVille as $unHotel)
				{
					$libelle = $unHotel['libelle'];
					$idHotel = $unHotel['idHotel']
		
			?>
					<p>
						 <option  select="<?php echo $idHotel ?>"><?php echo $idlibelle ?></option>
					</p>
			
			<?php
				}
			?>
			
			
			
			</select>
			
		
			<p> selectionner l evenement</p>
			<select id="evenement" name="evenement">;
			<option value="">Selectionner un evenement:</option>';
			<?php
				foreach ($lesEvenementVille as $unEvenement)
				{
					$libelleEvenement = $unEvenement['nom'];
					$id = $unEvenement['idEvenement'];
					
			?>
					<p> evenement</p>
						 <option  select="<?php echo $id ?>"><?php echo $id ?></option>
			<?php
				}
			?>
			</select>
			
			</form>
        
          </fieldset>
      
      <div class="piedForm">
      <p>
        <input id="ok" type="submit" value="Valider" size="20" />
        <input id="annuler" type="reset" value="Effacer" size="20" />
      </p> 
      </div>
        
      </form>
  
  
  