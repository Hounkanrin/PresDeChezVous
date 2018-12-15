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
					<h4>Nouveu produit </h4>
				</div>
				<form id="fproduit" name="fproduit" method="post" class="w3-container" action="controller/traitement.php">
					<?php if(isset($_GET["produit"])) { if($_GET["produit"] == "error") { ?>
					<p class="w3-text-red">
						Une erreur est survenue lors de l'ajout du produit
					</p>
					<?php } else if ($_GET["produit"] == "ok"){ ?>

    							<p class="w3-text-red">
    								Votre produit a été bien ajouté 
    							</p>
					<?php }}?>
					<p>
					<label class="w3-text-green">Catégorie</label> <select 
					class="w3-select w3-border w3-round" id="id_cat" name="id_cat" >
						<?php include_once 'bar.php'; 
                        include_once 'controller/fonctions.php';
                        $bdd = getBDD();

                        $req1=('SELECT * from categorie');
                        $req2= $bdd -> query($req1);

                        //le script recupère directement les categories dans la base de donnees écrits dans Script_InsertTAble pour l'insertion des catégories dans la table
                        while($row=$req2->fetch(PDO::FETCH_ASSOC)) {
                         echo'<option value="'.$row['id_cat'].'">'.$row['libelle'].'</option>';
                                }
                            ?>
					</select>
					</p>
					
					<p>
						<label class="w3-text-green"><b>Nom du Produit</b></label> <input
							class="w3-input w3-border w3-round" id="nom_produit" name="nom_produit" value="" required 
							type="text"/>
					</p>
					<p>
					<label class="w3-text-green"><b>Inserer une photo (JPG, PNG, GIK)</b></label> 
							<input type="hidden" name="taillemax"  id ="taillemax" value="1048576" />
							<input class="w3-input w3-border w3-round" id="photo_produit" name="photo_produit"  type="file"/>
					</p>
					<p>
					<label class="w3-text-green"><b>Description </b></label> 
					<textarea class="w3-input w3-border w3-round" id="detail" name="detail" type="text" placeholder="Presentez-vous..." cols="25" rows="5" onKeyDown="maxcara2();" onKeyUp="maxcara2();" > </textarea>
					</p>
					<p>
					<label class="w3-text-green"><b>Prix</b></label> <input
							class="w3-input w3-border w3-round" id="prix" name="prix" value="" required 
							type="text"/>
					</p>									
					<p>
						<button type="button" class="w3-btn form-submit w3-green" id="envoyer" onclick="validerProduit();" name="envoyer"> <em> Envoyer </em> </button> 
						<button type="reset" class="w3-btn form-submit w3-indigo" name="annuler"> <em> Annuler </em> </button> 
				  			
						<input type="hidden" name="action" id="action" value="produit"/>
					</p>
						</form>
					</div>
				</div>
				<div class="w3-container w3-col l2 m6 s12"></div>
			</div>
		<?php include_once 'footer.php'; ?>
</body>
</html>