<?php
session_start();
$_SESSION = array();
// On active les sessions :
session_destroy();
session_regenerate_id(true);
unset($_COOKIE);
unset($_SESSION);
// On redirige le visiteur vers la page désirée :

header("location: accueil.php");
?>
