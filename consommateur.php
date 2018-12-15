<head>
<?php include_once 'header.php'; ?>
</head>
<body>
<?php include_once 'bar.php'; ?>
<div class="w3-row minh">
		<div class="w3-container w3-col l2 m6 s12"></div>
		<div class="w3-container w3-col l8 m6 s12">
		<br/>
			<div class="w3-card-4">
				<div class="w3-container w3-green">
					<label>Vous êtes un consommateur </label>
					<h6>Rechercher un Produit </h6>
				</div>
				<form id="fconsommateur" name="fconsommateur" method="post" class="w3-container" action="consotraitement.php" >

				<p>
					<label class="w3-text-green"> Donnez votre adresse svp ! (n°rue/voie, nom de la rue/voie,code postal, ville):<input class="w3-select w3-border w3-round" type="text" name="adresse"/></label>
				</p>
				<p>
				<label class="w3-text-green"> Veuillez choisir un périmètre de recherche svp!</label>
					<select class="w3-select w3-border w3-round" name="choix">
   					<option value=5.00>5km</option>
    				<option value=10.00>10 km</option>
    				<option value=15.00>15 km</option>
   	 				<option value=20.00>20 km</option>
					<option value=25.00>25 km</option>
					<option value=10000000000> Superieur a 25 km</option>
					</select>
				</p>

				<p>
					<label class="w3-text-green"> Veuillez entrer le produit que vous cherchez <input class="w3-select w3-border w3-round" type="text" name="produit"/></label>
				</p>
	
				<p>
					<label class="w3-text-green"> Veuillez choisir un type de classement!</label>
					<select class="w3-select w3-border w3-round" name="choixClassement">
    				<option value='prix'>prix</option>
   					<option value='distance'>distance</option>
				</select>
				</p>
				<p>
							<button type="button" class="w3-btn form-submit w3-green" id="soumettre" onclick="validerconsommateur();" name="soumettre"> <em> Rechercher </em> </button> 
							<button type="reset" class="w3-btn form-submit w3-indigo" name="annuler"> <em> Annuler </em> </button> </td></tr>
				  			
				</p> 
				</form>
					</div>
				</div>
				<div class="w3-container w3-col l2 m6 s12"></div>
			</div>
		
</body>
</html>