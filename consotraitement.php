<!doctype html>
<html lang="fr">
<head>
 <meta name="viewport" content="initial-scale=1.0, user-scalable=no"/>
<meta charset="UTF-8" />
  <title>Titre de la page</title>
    	<style>
			html, body {
				height: 100%;
				margin: 10;
				padding: 10
			}
			#EmplacementDeMaCarte {
				height: 80%
				
			}
		</style>
</head>
<body>
 <?php
function getXmlCoordsFromAdress($address)
{
$coords=array();
$base_url="http://maps.googleapis.com/maps/api/geocode/xml?";
// ajouter &region=FR si ambiguité (lieu de la requete pris par défaut)
$request_url = $base_url . "address=" . urlencode($address).'&sensor=false';
$xml = simplexml_load_file($request_url) or die("url not loading");
//print_r($xml);
$coords['lat']=$coords['lon']='';
$coords['status'] = $xml->status ;
if($coords['status']=='OK')
{
 $coords['lat'] = $xml->result->geometry->location->lat ;
 $coords['lon'] = $xml->result->geometry->location->lng ;
}
return $coords;
}
/*
$adresseComplete = $_POST['adresse'];
$adresseComplete .=', ';
$adresseComplete .=$_POST['cp'];
$adresseComplete .=', ';
$adresseComplete .=$_POST['ville']; */
$coords=getXmlCoordsFromAdress(htmlspecialchars ($_POST['adresse']));
//echo $coords['status']." ".$coords['lat']." ".$coords['lon'];
//$coords_arrive=getXmlCoordsFromAdress(" Republique, 35000 RENNES, france");
//echo $coords['lat']." ".$coords['lon'];
?>

 <?php
 function distance($lat1, $lon1, $lat2, $lon2, $unit) {
$lat1 = floatval($lat1);
$lat2 = floatval($lat2);
$lon1 = floatval($lon1);
$lon2 = floatval($lon2);
  $theta = $lon1 - $lon2;
  $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) +  cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
  $dist = acos($dist);
  $dist = rad2deg($dist);
  $miles = $dist * 60 * 1.1515;
  $unit = strtoupper($unit);
 
  if ($unit == "K") {
    return ($miles * 1.609344)*1000;
  } else if ($unit == "N") {
      return ($miles * 0.8684);
    } else {
        return $miles;
      }
}
?>
<?php

// Sous WAMP (Windows)
try
{
$bdd = new PDO('mysql:host=localhost;dbname=pcvdb;charset=utf8', 'root', '');
}
catch(Exception $e)
{
        die('Erreur : '.$e->getMessage());
}
?>
<script LANGAGE = "javascript">
var tableauMarqueurs=[];
var tableautemp = {};

</script>
<table border = 1>
	<tr>
	<td>nom de producteur</td>
	<td>adresse</td>
	<td>nom de produit</td>
	<td>le prix</td>
	<td>Distance</td>
	<!-- <th> le prix</th> -->
	</tr>

<?php
$reqDistance = $bdd -> query('SELECT producteur.lat, producteur.lon, producteur.id_user FROM producteur');
while ($distanceDonnes = $reqDistance -> fetch())
{
	$dis = distance($distanceDonnes['lat'], $distanceDonnes['lon'], $coords['lat'], $coords['lon'],"N");
	if (htmlspecialchars($_POST['choix']) > $dis)
	{ 
	//	echo $dis." ".$distanceDonnes['id_prod'].'<br/>';
		if(htmlspecialchars($_POST['choixClassement']) =="prix"){
		$req = $bdd -> query('SELECT produit.prix, produit.nom_produit , producteur.nom, producteur.lat, producteur.lon, producteur.adresse, producteur.id_user, produit.id_user 
		FROM produit, producteur WHERE producteur.id_user = produit.id_user and producteur.id_user = \''.$distanceDonnes['id_user'].'\' ORDER BY produit.prix');
		} else {
		$req = $bdd -> query('SELECT produit.prix, produit.nom_produit, producteur.lat,producteur.lon, producteur.nom, producteur.adresse, producteur.id_user, produit.id_user 
		FROM produit, producteur WHERE producteur.id_user = produit.id_user and producteur.id_user = \''.$distanceDonnes['id_user'].'\'');
		}
		if ($donnees = $req->fetch())
		{   ?>
			<script LANGAGE = "javascript">		
			tableautemp = {lat : '<?php echo $donnees['lat']; ?>',lng : '<?php echo $donnees['lon']; ?>'};
			tableauMarqueurs.push(tableautemp);
		
			</script>
			<tr> 
			<td><?php echo $donnees['nom']; ?></td>
			<td><?php echo $donnees['adresse']; ?></td>
			<td><?php echo htmlspecialchars($_POST['produit']); ?></td>
			<td><?php echo $donnees['prix']." euro"; ?></td>
			<td><?php echo $dis." km "; ?></td>

			</tr>
			

<?php
	}                                           
$req->closeCursor();
}
}
?>
</table>
<br/>
<div id="EmplacementDeMaCarte"></div>
		<noscript>
			<p>Attention : </p>
			<p>Afin de pouvoir utiliser Google Maps, JavaScript doit être activé.</p>
			<p>Or, il semble que JavaScript est désactivé ou qu\'il ne soit pas supporté par votre navigateur.</p>
			<p>Pour afficher Google Maps, activez JavaScript en modifiant les options de votre navigateur, puis essayez à nouveau.</p>
		</noscript>
		<script>
			function initialisation() {
								var zoneMarqueurs = new google.maps.LatLngBounds();
				var optionsCarte = {
					zoom: 8,
					center: { lat: 47.389982, lng: 0.688877 }
				}
				var maCarte = new google.maps.Map( document.getElementById("EmplacementDeMaCarte"), optionsCarte );
				tableauMarqueurs.forEach( function(latlng) {
					var latitude = latlng.lat,
						longitude = latlng.lng;
					var optionsMarqueur = {
						map: maCarte,
						position: new google.maps.LatLng( latitude, longitude )
					};
					var marqueur = new google.maps.Marker( optionsMarqueur );
					zoneMarqueurs.extend( marqueur.getPosition() );
				} );
				maCarte.fitBounds( zoneMarqueurs );
			}
</script>
<script async defer  src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBDd7Vwz6C_g9HwpoIM8waIYH-WzDZVs1Y&callback=initialisation"></script>

<form>
  <input id="impression" name="impression" type="button" onclick="imprimer_page()" value="Imprimer cette page" />
</form>

<script type="text/javascript">
function imprimer_page(){
  window.print();
}
</script>
</body>
</html> 