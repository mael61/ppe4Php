      <h2>selectionner l'hotel pour la ville : 	<?php echo $villeSelectionner;	?></h2>
	 
         
      <form method="POST"  action="index.php?uc=gererReservation&action=saisieDate">  
          <fieldset>
            <legend>
            </legend>
				<p> selectionner l'hotel</p>
			
			
			<select id="hotel" name="hotel">
			<option value="">Selectionner un hotel:</option>'
			<?php
				foreach ($lesHotelsVille as $unHotel)
				{
					$libelle = $unHotel['libelle'];
					$idHotel = $unHotel['idHotel']
			?>
					<p><hotel/p>
						 <option   value="<?php echo $libelle; ?>"selected><?php echo $libelle; ?></option>
			<?php
				}
			?>
			</select>
			<p> selectionner l evenement</p>
			<select id="evenement" name="evenement">
			<option value="">Selectionner un evenement:</option>
			<?php
				foreach ($lesEvenementVille as $unEvenement)
				{
					$libelleEvenement = $unEvenement['nom'];
					$id = $unEvenement['idEvenement'];
					
			?>
					<p> evenement</p>
						 <option value="<?php echo $libelleEvenement;?>" selected ><?php echo $libelleEvenement; ?></option>
						 
			<?php
				}
			?>
			</select>
			
			<p>	Durée en jour (max 3 jours)</p>
			<input type="number" id="nombre" name="quantity" min="1" max="3">
			
          </fieldset>
		  <div id="hotel"></div>
		  <div id="date"></div>

      
      <div class="piedForm">
      <p>
        <input id="ok" type="submit" value="Valider" size="20" />
        <input id="annuler" type="reset" value="Effacer" size="20" />
      </p> 
      </div>
        
      </form>
  
  <script>
var hotel = document.getElementById('hotel').value ; 
var event = document.getElementById('evenement').value ; 
var nombre = document.getElementById('nombre').value ; 

 var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange=function() {
    if (this.readyState == 4 && this.status == 200) {
      document.getElementById("date").innerHTML = this.responseText;
    }
  };
  xhttp.open("GET", "vues/v_date.php?hotel="+hotel+"&event="+event+"&nombre="+nombre, true);
  xhttp.send();

</script>
  