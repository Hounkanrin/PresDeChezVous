<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
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
							<h4>Nouveau Producteur </h4>
						</div>
						<form id="fproducteur" name="fproducteur" method="post" class="w3-container" action="controller/traitement.php">
							<?php if(isset($_GET["producteur"])) { if($_GET["producteur"] == "error") { ?>
    							<p class="w3-text-red">
    								Une erreur est survenue lors de la création du compte
    							</p>
							<?php }else if ($_GET["producteur"] == "ok"){ ?>
    							<p class="w3-text-red">
    								Compte créé avec succès
    							</p>
							<?php } else if ($_GET["producteur"] == "emailExist"){ ?>
							<p class="w3-text-red">
    								L'adresse email renseignée existe déja, merci d'utiliser un autre
    							</p>
							<?php }} ?>
							<p>
								<label class="w3-text-green"><b>Prénom</b></label> <input
									class="w3-input w3-border w3-round" id="prenom" name="prenom" value="" required 
									type="text"/>
							
							</p>
							<p>
							<label class="w3-text-green"><b>Nom</b></label> <input
								class="w3-input w3-border w3-round" id="nom" name="nom" value="" required 
								type="text"/>
						
							</p>

							<p>
							<label class="w3-text-green"><b>Inserer une photo (JPG, PNG, GIK)</b></label> 
							<input type="hidden" name="taillemax"  id ="taillemax" value="1048576" />
							<input class="w3-input w3-border w3-round" id="nom_photo" name="nom_photo" required type="file"/>
						
							</p>
							<p>
							<label class="w3-text-green"><b>Adresse</b></label> <input
								class="w3-input w3-border w3-round" id="adresse" name="adresse" value="" required 
								type="text"/>
						
							</p>

							<p>
							<label class="w3-text-green"><b>Code postal</b></label> <input
								class="w3-input w3-border w3-round" id="cp" name="cp" value="" required 
								type="text"/>
						
							</p>
							<p>
							<label class="w3-text-green"><b>Ville</b></label> 
							<input class="w3-input w3-border w3-round" id="ville" name="ville" required type="text"/>
						
							</p>
							
							<p>
							<label class="w3-text-green"><b>Pays</b></label> <input
								class="w3-input w3-border w3-round" id="pays" name="pays" value="" required 
								type="text"/>
							</p>
							<p>
							<label class="w3-text-green"><b>Souhaitez-vous rendre visible votre e-mail <input type="radio" class="w3-radio" name="oui" value="1"/>
								ou votre téléphone <input type="radio" class="w3-radio" name="oui" value="2"/></b></label> 
							</p>

							<p>
							<label class="w3-text-green"><b>Tétéphone</b></label> 
							<input class="w3-input w3-border w3-round" id="tel" name="tel" required type="text"/>
						
							</p>

							<p>
							<label class="w3-text-green"><b>E-mail</b></label> 
							<input class="w3-input w3-border w3-round" id="email" name="email" required="required" type="email" placeholder="Votre E-mail"/>						
							</p>
							<p>
							<label class="w3-text-green"><b>Présentation</b></label> 
							<textarea class="w3-input w3-border w3-round" id="pres" name="pres" required type="text" placeholder="Presentez-vous..." cols="25" rows="5" onKeyDown="maxcara1();" onKeyUp="maxcara1();" > </textarea>
							</p>
							<p>
							<label class="w3-text-green"><b>Login</b></label> <input
								class="w3-input w3-border w3-round" id="login" name="login"
								type="text" required />
						
							</p>
							<p>
							<label class="w3-text-green"><b>Mot de passe</b></label> <input
								class="w3-input w3-border w3-round" id="pass" name="pass"
								type="password"/>
						
							</p>
							<p>
							<label class="w3-text-green"><b>Confirmer Mot de passe</b></label> <input
								class="w3-input w3-border w3-round" id="pass1" name="pass1"
								type="password"/>
						
							</p>
																		
							<p>
							<button type="button" class="w3-btn form-submit w3-green" id="soumettre" onclick="validerProducteur();" name="soumettre"> <em> Soumettre </em> </button> 
							<button type="reset" class="w3-btn form-submit w3-indigo" name="annuler"> <em> Annuler </em> </button> </td></tr>
				  			
							<input type="hidden" name="action" id="action" value="producteur"/>
								
							</p>
						</form>
					</div>
				</div>
				<div class="w3-container w3-col l2 m6 s12"></div>
			</div>
		<?php include_once 'footer.php'; ?>
</body>
</html>