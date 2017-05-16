<div id="contenu">
	<h2>Creer un evenement</h2>
	
	<form action="index.php?uc=creerEvenement&action=validation" method="post">
		<h3>L'evenement</h3>
		<div class="corpsForm">
			 
			<p>		  
				Nom : <input type="text" name="nomEvent"></br>
				Dates (jj/mm/aaaa) :
					du <input type="date" name="dateD">
					
					au <input type="date" name="dateF"></br>
				Ville : <input type="text" name="villeEvent">
			</p>
				
		</div>
		<h3>Les conferences</h3>
		<div class="corpsForm">
			 
			<p>		  
				Libelle : <input type="text" name="nomConf"></br>
				Resume de la conference :</br><style>textarea{resize:none;}</style><textarea name="resume" cols="90" rows="4"></textarea></br>
				Date (jj/mm/aaaa) : <input type="date" name="dateConf">
			</p>
				
		</div>
		<div class="piedForm">
			<p>
				<input id="ok" type="submit" value="Valider" size="20" />
				<input id="annuler" type="reset" value="Effacer" size="20" />
			</p> 
		</div>
        
	</form>