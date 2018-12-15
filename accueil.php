<?php include_once 'controller/fonctions.php'; ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php include_once 'header.php'; ?>
</head>
<body>
<?php include_once 'bar.php'; ?>
<div class="w3-row minh">
	<div class="w3-container w3-col l2 m6 s12">
	<h3 class="w3-text-blue"><em><b>PrèsDeChezVous </b></em></h3>
	<a href="connexion.php" class="w3-text-green"><b>Vous êtes un producteur</b></a><br/><br></br>
	<div>text</div>
	<div><img src="http://www.poissonnerie-nano.fr/userfiles/4388/poissons-etalage.png" alt="Poissonnerie"width="150"height="150"/></div><br/><br></br>
	<div><img src="http://4everstatic.com/images/674xX/aliments-et-boissons/fruits,-boissons-162166.jpg"alt="Boissons"width="150"height="150"/></div><br/><br></br>
		</div>
	
	<div class="w3-container w3-col l8 m6 s12">
	 	<?php include("consommateur.php"); ?>
	 		</div>
	<div class="w3-container w3-col l2 m6 s12">
  	<img src="http://fasee.fr/wp-content/uploads/2015/10/fruit-et-legume.jpg"alt="Fruits & légumes"width="150"height="150"/> </div>
  	<div> <br/><br></br>
  	<img src="http://www.lesviandesduterroir.com/ressources/images/b630dce5f8e1.jpg" width="150"height="150"alt="Viande" /></div>
  <div><br/><br></br>
  <img src="http://www.le-fournil-hamois.fr/img/photos/zoom/accueil_01.jpg" alt="Boulangerie/"width="150"height="150"> </div>
</div>
<?php include_once 'footer.php'; ?>
</body>
</html>
