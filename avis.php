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
					<h4> Votre Avis </h4>
				</div>
				<form id="favis" name="favis" method="post" class="w3-container" action="controller/traitement.php">
					
					<p>
						<label  class="w3-text-green"><b>Description </b></label> 
						<textarea class="w3-input w3-border w3-round" id="avis" name="avis" type="texte" placeholder="Votre avis..." cols="25" rows="5" onKeyDown="maxcara();" onKeyUp="maxcara();" > </textarea>
						<i>Il vous reste <input readonly type=text name="test" size="1" maxlength=3 value="350">caract&egrave;res</i></td></tr>
					</p>
					<p>
							<button type="button" class="w3-btn form-submit w3-green" id="soumettre" onclick="validerAvis();" name="soumettre"> <em> Enregistrer </em> </button> 
							<button type="reset" class="w3-btn form-submit w3-indigo" name="annuler"> <em> Annuler </em> </button> </td></tr>
				  			
							<input type="hidden" name="action" id="action" value="avis"/>
								
							</p>
						</form>
					</div>
				</div>
				<div class="w3-container w3-col l2 m6 s12"></div>
			</div>
		<?php include_once 'footer.php'; ?>
</body>
</html>