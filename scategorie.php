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
					<h4> Sous Cat�gorie</h4>
				</div>
				<form id="fscategorie" name="fscategorie" method="post" class="w3-container" action="controller/traitement.php">
					<?php if(isset($_GET["scategorie"])) { if($_GET["scategorie"] == "error") { ?>
					<p class="w3-text-red">
						Cette sous cat�gorie est existe d�ja. Veuillez v�rifier !
					</p>
					<?php }else if ($_GET["scategorie"] == "ok"){ ?>
    							<p class="w3-text-red">
    						la sous cat�gorie a �t� cr��e avec succ�s
    							</p>
					<?php }} ?>
					<p>
						<label class="w3-text-green"><b>Libell�</b></label> <input
							class="w3-input w3-border w3-round" id="libelle"  name="libelle"
							type="text"/>
					</p>
					<p>
					<label class="w3-text-green">Cat�gorie</label> <select 
					class="w3-select w3-border w3-round" id="id_cat" name="id_cat" >
						<?php include_once 'bar.php'; 
                        include_once 'controller/fonctions.php';
                        $bdd = getBDD();

                        $req1=('SELECT * from categorie');
                        $req2= $bdd -> query($req1);

                        //le script recup�re directement les categories dans la base de donnees �crits dans Script_InsertTAble pour l'insertion des cat�gories dans la table
                        while($row=$req2->fetch(PDO::FETCH_ASSOC)) {
                         echo'<option value="'.$row['id_cat'].'">'.$row['libelle'].'</option>';
                                }
                            ?>
					</select>
					</p>
<p>
							<button type="button" class="w3-btn form-submit w3-green" id="enregistre" onclick="validerSCategorie();" name="enregistre"> <em> Enregistrer </em> </button> 
							<button type="reset" class="w3-btn form-submit w3-indigo" name="annuler"> <em> Annuler </em> </button> </td></tr>
				  			
							<input type="hidden" name="action" id="action" value="scategorie"/>
								
							</p>
						</form>
					</div>
				</div>
				<div class="w3-container w3-col l2 m6 s12"></div>
			</div>
		<?php include_once 'footer.php'; ?>
</body>
</html>














