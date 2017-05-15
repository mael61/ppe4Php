
<div id="contenu">
     <h1> Reservations Personnel </h1>
	  <select id="reservation" name="reservation" onchange="verif1()">
			<option value="" selected>Selectionner une reservation:</option>'
			<?php
				foreach ($reservation as $uneReservation)
				{
					$idReservation = $uneReservation['idReservation'];
					$idHotel = $uneReservation['idHotel'];
					$date = $uneReservation['dateReserv'];
			?>
						 <option value="<?php echo $idReservation ; ?>" > <?php echo $idReservation ; ?></option>
			<?php
				}
			?>
		</select>
		<div id="affichage"> </div>
        
      </form>
	  

	  
	  
<script>
function verif1(){
	
var reservation = document.getElementById('reservation').value; 

 var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange=function() {
    if (this.readyState == 4 && this.status == 200) {
      document.getElementById("affichage").innerHTML = this.responseText;
    }
  };
  xhttp.open("GET", "vues/v_reservationAjax.php?reservation="+reservation,true);
  xhttp.send();
}
</script>
  
  
  