<div class="w3-bar w3-green">
  <a href="accueil.php" class="w3-bar-item w3-button">Accueil</a>
  <a href="administration.php" class="w3-bar-item w3-button">Administration</a>
  <a href="avis.php" class="w3-bar-item w3-button">Votre Avis</a>
  <?php if(!isset($_SESSION["login"])) { ?>
  <a href="connexion.php" class="w3-bar-item w3-button">Connexion</a>
  <?php } else { ?>
   <a href="index.php" class="w3-bar-item w3-button">D&eacute;connexion</a>
  <?php } ?>
  <?php if(isset($_SESSION["user_type"])&& $_SESSION["user_type"]==1) { ?> 
      
  <a  href="Admin.php" class="w3-bar-item w3-button">Ajouter un Admin</a>
  <a  href="producteur.php" class="w3-bar-item w3-button">Ajouter un producteur </a>
  <a  href="fsupprimer.php" class="w3-bar-item w3-button">Supprimer un producteur </a>
   <?php }?>
  <?php if(isset($_SESSION["user_type"])&& $_SESSION["user_type"]==0) { ?>
  <a href="modifiProducteur.php" class="w3-bar-item w3-button">Modifier profil</a>
  <?php }?>
 
  </div>


