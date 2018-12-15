<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php include_once 'header.php'; ?>
</head>
<body>
<?php include_once 'bar.php'; ?>
<div class="w3-row minh">
	<div class="w3-container w3-col l2 m6 s12">
	</div>

<body>
<?php 
include_once 'controller/fonctions.php';

$bdd = getBDD();

$req1=('SELECT * from categorie');
$req2= $bdd -> query($req1);

//le script recupère directement les categories dans la base de donnees écrits dans Script_InsertTAble pour l'insertion des catégories dans la table
while($row=$req2->fetch(PDO::FETCH_ASSOC)) {
    echo'<option value="'.$row['id_cat'].'">'.$row['libelle'].'</option>';
    
}
?>
