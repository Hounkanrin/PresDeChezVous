<?php include_once 'controller/fonctions.php'; ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php include_once 'header.php'; ?>
</head>
<body>
<?php include_once 'bar.php';
if(!isset($_SESSION["user_type"])){
    header("location: connexion.php");
}
?>
<div class="w3-row minh">
	<div class="w3-container w3-col l2 m6 s12">
	</div>
	<div class="w3-container w3-col l8 m6 s12">
		<?php echo getlisteAction($_SESSION["user_type"]); ?>
	</div>
	<div class="w3-container w3-col l2 m6 s12">
	</div>
</div>
<?php include_once 'footer.php'; ?>
</body>
</html>