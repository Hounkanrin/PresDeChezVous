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
					<h4>Connexion</h4>
				</div>
				<form id="formConnexion" method="post" class="w3-container" action="controller/traitement.php">
					<?php if(isset($_GET["connexion"]) && $_GET["connexion"] == "error") { ?>
					<p class="w3-text-red">
						Le Mot passe ou votre Login est incorrect. Veuillez vérifier !
					</p>
					<?php } ?>
					<p>
						<label class="w3-text-green"><b>Login</b></label> <input
							class="w3-input w3-border w3-round" id="login" name="login"
							type="text"/>
					
					</p>
					<p>
						<label class="w3-text-green"><b>Mot de passe</b></label> <input
							class="w3-input w3-border w3-round" id="pass" name="pass"
							type="password"/>
					
					</p>
					<p>
						<input type="hidden" name="action" id="action" value="connexion"/>
						<button type="button" onclick="seconnecter();" class="w3-btn w3-green">Connecter</button>
						&nbsp;
						<button type="button" onclick="redirect('producteur.php');" class="w3-btn w3-indigo">S'inscrire</button>
						&nbsp;
						<button type="button" class="w3-btn w3-deep-orange">Identifiant oublié</button>
						&nbsp;
						<button type="button" class="w3-btn w3-red">Mot de passe oublié</button>
					</p>
				</form>
			</div>
		</div>
		<div class="w3-container w3-col l2 m6 s12"></div>
	</div>
<?php include_once 'footer.php'; ?>
</body>
</html>