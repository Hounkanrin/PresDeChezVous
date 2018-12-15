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
					<h4>Catégorie</h4>
				</div>
				<form id="fcategorie" name="fcategorie" method="post" class="w3-container" action="controller/traitement.php">
					<?php if(isset($_GET["categorie"])) { if($_GET["categorie"] == "error") { ?>
					<p class="w3-text-red">
						Cette catégorie est existe déja. Veuillez vérifier !
					</p>
					<?php }else if ($_GET["categorie"] == "ok"){ ?>
    							<p class="w3-text-red">
    						la catégorie a été créée avec succès
    							</p>
					<?php }} ?>
					<p>
						<label class="w3-text-green"><b>Libellé</b></label> <input
							class="w3-input w3-border w3-round" id="libelle"  name="libelle"
							type="text"/>
					</p>
					
					<p>
						<label class="w3-text-green"><b>Inserer une image  (JPG, PNG, GIK)</b></label> 
							<input type="hidden" name="taillemax"  id ="taillemax" value="1048576" />
							<input class="w3-input w3-border w3-round" id="image_categorie" name="image_categorie" required type="file"/>
						
					</p>
					<p>
							<button type="button" class="w3-btn form-submit w3-green" id="enregistre" onclick="validerCategorie();" name="enregistre"> <em> Enregistrer </em> </button> 
							<button type="reset" class="w3-btn form-submit w3-indigo" name="annuler"> <em> Annuler </em> </button> </td></tr>
				  			
							<input type="hidden" name="action" id="action" value="categorie"/>
								
							</p>
						</form>
					</div>
				</div>
				<div class="w3-container w3-col l2 m6 s12"></div>
			</div>
		<?php include_once 'footer.php'; ?>
</body>
</html>