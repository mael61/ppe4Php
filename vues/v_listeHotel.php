
<div id="contenu">
      <h2>selectionner la ville</h2>
         
      <form method="post"  action="index.php?uc=gererReservation&action=saisieHotel">
      <div class="corpsForm">
          
          <fieldset>
            <legend>
            </legend>
		
			<select name="ville" id="">
			<option value="">Selectionner une ville:</option>
			
			<?php
				foreach ($lesHotels as $unHotel)
				{
					$idlibelle = $unHotel['libelle'];
					$ville = $unHotel['ville'];		
			?>	
						 
				<option value="<?php echo $ville ?>"><?php echo $ville ?></option>	
			<?php
				}
			?>
			
			

           
          </fieldset>
		 
      <div class="piedForm">
      <p>
        <input id="ok" type="submit" value="Valider" size="20" />
        <input id="annuler" type="reset" value="Effacer" size="20" />
      </p> 
      </div>
        
      </form>
  
  
  