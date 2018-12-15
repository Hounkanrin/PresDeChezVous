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
							<h4>Modifier profil </h4>
						</div>
						<form id="fmodifProducteur" name="fmodifProducteur" method="post" class="w3-container" action="controller/traitement.php">
							<p>
							<label class="w3-text-green"><b>E-mail</b></label> 
							<input class="w3-input w3-border w3-round" id="mail" name="mail" required="required" type="email" placeholder="Votre E-mail"/>						
							</p>
							<p>
							
							</p>
																		
							<p>
							<button type="button" class="w3-btn form-submit w3-green" id="soumettre" onclick="modifProducteur();" name="soumettre"> <em> Soumettre </em> </button> 
							<button type="reset" class="w3-btn form-submit w3-indigo" name="annuler"> <em> Annuler </em> </button> </td></tr>
				  			
							<input type="hidden" name="action" id="action" value="modifProducteur"/>
								
							</p>
						</form>
					</div>
				</div>
				<div class="w3-container w3-col l2 m6 s12"></div>
			</div>
		<?php include_once 'footer.php'; ?>
</body>
</html>