<?php
@session_start();

function issetNotEmpty($var){
    return isset($var) && !empty($var);
}

function getBDD(){
    try
    {
        $con = new PDO('mysql:host=localhost;dbname=pcvdb;charset=utf8', 'root', '');
        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $con;
     }
    catch(Exception $e)
    {
        die('Erreur : '.$e->getMessage());
        return null;
    }
}
// Gestion des listes de producteurs, produit
function getlisteAction($typeUser){
    $html = '<br/><div class="w3-row"><div class="w3-container">';
    $html .= '<button type="button" class="w3-btn w3-round w3-indigo">Mon profil</button>&nbsp;';
    $html .= '<button type="button" onclick="redirect(\'rechercher.php?type=0\');" class="w3-btn  w3-round w3-blue">Les producteurs</button>&nbsp;';
    $html .= '<button type="button" onclick="redirect(\'rechercher.php?type=1\');" class="w3-btn  w3-round w3-green">Les produits</button>&nbsp;';
    $html .= '<button type="button" onclick="redirect(\'listeCat.php\');" class="w3-btn w3-round w3-blue-gray">Liste des catégorie de produit </button>&nbsp;';
    if($typeUser == 0){
        // producteur
        $html .= '<button type="button" onclick="redirect(\'produit.php\');" class="w3-btn  w3-round w3-purple">Ajouter un produit</button>&nbsp;';
    }else{
        // admin
        $html .= '<button type="button" onclick="redirect(\'categorie.php\');" class="w3-btn  w3-round w3-brown">Ajouter les catégories</button>&nbsp;';
        $html .= '<button type="button" onclick="redirect(\'scategorie.php\');" class="w3-btn  w3-round w3-purple">Ajouter les sous-catégories</button>&nbsp;';
    }
    return $html.'</div></div>';
}

function getListeElement($type = 1){
    //produit 
    $query = "SELECT * FROM PRODUIT";
    $db = getBDD();
    $param = array();
    if($type == 0){
        $query = "SELECT * FROM PRODUCTEUR ORDER BY prenom,nom";
    }
    $stat = $db->prepare($query);
    $stat->execute($param);
    return $stat->fetchAll();
}
//affichage de la liste dans un tableau des producteur/produit
function displayTableElement($type = 1){
    $liste = getListeElement($type);
    $html = '<br/><table class="w3-table w3-striped w3-border"><tr>';
    if($type == 0){
        $html .= '<td>Prénom</td>';
        $html .= '<td>Nom</td>';
        $html .= '<td>Email</td>';
        $html .= '<td>Options</td>';
    }else if($type == 1){
        $html .= '<td>Nom produit</td>';
        $html .= '<td>description</td>';
        $html .= '<td>Prix</td>';
        $html .= '<td>Options</td>';
    }
    $html .= '</tr>';
    if(count($liste) > 0){
        foreach ($liste as $l) {
            $html .= '<tr>';
            if($type == 0){
                $html .= '<td>'.$l['prenom'].'</td>';
                $html .= '<td>'.$l['nom'].'</td>';
                $html .= '<td>'.$l['mail'].'</td>';
                
                $html .= '<td>';
                if(isset($_SESSION["user_type"]) && $_SESSION["user_type"] == 1){
                $html .= '<button type="button" class="w3-btn  w3-round w3-orange">Modifier</button>&nbsp;
                <button type="button" onclick="redirect(\'supprimer_producteur.php\');"class="w3-btn  w3-round w3-red">Supprimer</button>';
                }
                $html .= '</td>';
            }
            $html .= '</tr>';
             if($type==1){
                $html .= '<td>'.$l['nom_produit'].'</td>';
                $html .= '<td>'.$l['description'].'</td>';
                $html .= '<td>'.$l['prix'].'</td>';
                
                $html .= '<td>';
             }$html .= '</tr>';
        }
        
    }
    else
    {
        if($type == 0){
            $html .= '<tr><td class="w3-center" colspan="4">Aucun producteur trouvé</td></tr>';
        }else if ($type == 1){
            $html .= '<tr><td class="w3-center" colspan="4">Aucun produit trouvé</td></tr>';
        }
    }
    $html .= '</table>';
    return $html;
}



// gestion de la photo 

/*function upload($index,$destination,$maxsize=FALSE,$extensions=FALSE)
{
    //Test1: fichier correctement uploadé
    if (!isset($_FILES[$index]) OR $_FILES[$index]['error'] > 0) return FALSE;
    
    //Test2: taille limite
    if ($maxsize !== FALSE AND $_FILES[$index]['size'] > $maxsize) return FALSE;
    
    //Test3: extension
    $ext = substr(strrchr($_FILES[$index]['name'],'.'),1);
    if ($extensions !== FALSE AND !in_array($ext,$extensions)) return FALSE;
    
    //Déplacement
    return move_uploaded_file($_FILES[$index]['tmp_name'],$destination);
}*/

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


function upload(){
    

$target_dir = "upload/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }
}
// Check if file already exists
if (file_exists($target_file)) {
    echo "Sorry, file already exists.";
    $uploadOk = 0;
}
// Check file size
if ($_FILES["fileToUpload"]["size"] > 50000000) {
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
}
// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
    && $imageFileType != "gif" ) {
        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
    }
    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
        // if everything is ok, try to upload file
    } else {
        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
            echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }
}
