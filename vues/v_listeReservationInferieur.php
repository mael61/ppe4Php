

     <h1> Reservation des employer </h1>
	 
	 <select id="employe" name="employe" onchange="nom()">
			<option value=""selected>Selectionner un employer:</option>'
			<?php
				foreach ($inferieur as $uninferieur)
				{
					$nom = $uninferieur['nom'];
					$id =  $uninferieur['idVisiteur'];
					
			?>
						 <option value="<?php echo $id ; ?>" > <?php echo $nom; ?></option>
			<?php
				}
			?>
		</select>
	 
	 
	 
	  <select id="reservation2" name="reservation2" onchange="verif()">
			<option value=""selected>Selectionner une reservation:</option>'
			<?php
				$reservation2 =$pdo->retourneReservation($id);
				foreach ($reservation2 as $uneReservation2)
				{
					$idReservation2 = $uneReservation2['idReservation'];
					$idHotel = $uneReservation2['idHotel'];
					$date = $uneReservation2['dateReserv'];
			?>
						 <option value="<?php echo $idReservation2 ; ?>" > <?php echo $idReservation2 ; ?></option>
			<?php
				}
			?>
		</select>
		<div id="affichage2"> </div>
        
      </form>
	  

	  
	  
<script>

function nom(){
	var employe = document.getElementById('employe').value; 
				// On défini ce qu'on va faire quand on aura la réponse
				var xhttp = new XMLHttpRequest();
			xhttp.onreadystatechange=function() {
				if (this.readyState == 4 && this.status == 200) {
						
						// On se sert de innerHTML pour rajouter les options a la liste
						document.getElementById('reservation2').innerHTML =  this.responseText;
					}
				}
 
				
			  xhttp.open("GET", "vues/v_ajaxListeRe.php?employe="+employe,true);
			  xhttp.send();
	
}

function verif(){

var reservation = document.getElementById('reservation2').value; 

 var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange=function() {
    if (this.readyState == 4 && this.status == 200) {
      document.getElementById("affichage2").innerHTML = this.responseText;
    }
  };
  xhttp.open("GET", "vues/v_reservationAjax.php?reservation="+reservation,true);
  xhttp.send();
}
</script>
  
  
  