<?php
include_once 'fonctions.php';

$action = isset($_POST['action']) ? $_POST['action'] : null;
$bdd = getBDD();
//connexion
if ($action == "connexion") {
    if (issetNotEmpty($_POST["login"]) && issetNotEmpty($_POST["pass"])) {
        $login = $_POST["login"];
        $mdp = $_POST["pass"];
        
        $hash_password = hash('sha256', $mdp);
        $verifier_login_req = "select * from user where login = ? and mdp = ?";
        $requete = $bdd->prepare($verifier_login_req);
        $param = array(
            $login,
            $hash_password
        );
        $requete->execute($param);
        $ligne = $requete->fetch();
        if ($ligne !== FALSE) {
     
            $_SESSION["user_type"] = $ligne["user_type"];
            $_SESSION["login"] = $ligne["login"];
            $_SESSION["id_user"]=$ligne["id_user"];
            
            if ($_SESSION["user_type"]==0)
            {
                
                $producteur="select * from producteur where id_user in 
                    (select id_user from user where login = ? and mdp = ?)";
                $requete = $bdd->prepare($producteur);
                $param = array(
                    $login,
                    $hash_password
                );
                $requete->execute($param);
                $ligne = $requete->fetch();
                    if ($ligne !== FALSE) {
                       
            $_SESSION["prenom"]=$ligne["prenom"];
            $_SESSION["nom"]=$ligne["nom"];
            $_SESSION["nphoto"]=$ligne["nphoto"];
            $_SESSION["adresse"]=$ligne["adresse"];
            $_SESSION["cp"]=$ligne["cp"];
            $_SESSION["ville"]=$ligne["ville"];
            $_SESSION["tel"]=$ligne["tel"];
            $_SESSION["mail"]=$ligne["mail"];
            $_SESSION["affiche_contact"]=$lgne["affiche_contact"]; 
            $_SESSION["pres"]=$ligne["pres"];
            $_SESSION["lat"]=$ligne["lat"];
            $_SESSION["lon"]=$ligne["lon"];
            }
            }
            
            @header('location: ../administration.php');
        } else {
            @header('location: ../connexion.php?connexion=error');
        }
    }
      
    //traitement producteur
} else if ($action == "producteur") {
    $message = "";
    try {
        if (issetNotEmpty($_POST["prenom"]) && issetNotEmpty($_POST["nom"]) && issetNotEmpty($_POST["nom_photo"]) && issetNotEmpty($_POST["adresse"]) && issetNotEmpty($_POST["cp"]) && issetNotEmpty($_POST["ville"]) && issetNotEmpty($_POST["tel"]) && issetNotEmpty($_POST["email"]) && issetNotEmpty($_POST["pres"]) && issetNotEmpty($_POST["login"]) && issetNotEmpty($_POST["pass"]) && issetNotEmpty($_POST["pass1"]) && issetNotEmpty($_POST["oui"])) {
            
            // declaration des variables
            $prenom = $_POST["prenom"];
            $nom = $_POST["nom"];
            $nphoto = $_POST["nom_photo"];
            $adresse = $_POST["adresse"];
            $cp = $_POST["cp"];
            $ville = $_POST["ville"];
            $pays = $_POST["pays"];
            $tel = $_POST["tel"];
            $mail = $_POST["email"];
            $presentation = $_POST["pres"];
            $login = $_POST["login"];
            $affich = $_POST["oui"];
            $mdp = $_POST["pass"];
            
            //traitement de l'adresse
            $address=$_POST["adresse"];
            $address .=', ';
            $address .= $_POST["cp"];
            $address .=', ';
            $address .= $_POST["ville"];
            
          $coords= getXmlCoordsFromAdress($address);
                        
            $latitude=$coords['lat'];
            $longitude=$coords['lon'];
            
            // requete pour verifier le mail dans la base de données 
            
            $verifier_mail_req = "select count(*) as nbre from  producteur where mail=?";
            $requete = $bdd->prepare($verifier_mail_req);
            $param = array(
                $mail
            );
            $requete->execute($param);
            $ligne = $requete->fetch();
            if ($ligne['nbre'] == 0) {
                
                $sql = "INSERT INTO user VALUES (NULL,?, ?, 0)";
                $requete = $bdd->prepare($sql);
                $hash_password = hash('sha256', $mdp);
                
                $param = array(
                    $login,
                    $hash_password
                );
                
                if ($requete->execute($param)) {
                    // recuperer du dernier numero d'utilisateur
                    $user_id = $bdd->lastInsertId();
                    
                    // Creer un identifiant difficile à deviner
                    $photo = 'photoProducteur/'.$mail.'.jpeg';
                    
                   // $index,$destination,$maxsize=FALSE,$extensions=FALSE)
                   
                    
                    // recupération de la photo
                    upload('$photo', './photoProducteur', 1048576, array('png','gip','jpg','jpeg'));
                        
                     // insertion des variables dans la base de données
                    $sql = "INSERT INTO producteur VALUES (?,?,?,?,?,?,?,?,?, ?,0,?,?,?)";
                    $requete = $bdd->prepare($sql);
                    
                    // initialisation des variables
                    $param = array(
                        $user_id,
                        $prenom,
                        $nom,
                        $photo,
                        $adresse,
                        $cp,
                        $ville,
                        $tel,
                        $mail,
                        $presentation,
                        $affich,
                        $latitude,
                        $longitude
                    
                    );
                   if ($requete->execute($param)) {
                        $message = "ok";
                    } else {
                        $message = "emailExist";
                    }
                } else {
                    $message = "error";
                }
            }else{
                $message = "error";
            }
        }
    } catch (Exception $e) {
        $message = $e->getMessage();
    }
    @header("location: ../producteur.php?producteur=" . $message);
    
  //traitement produit
   
}   else if ($action =="produit") {
    $message = "";
    try {
        if (issetNotEmpty($_POST["id_cat"]) && issetNotEmpty($_POST["nom_produit"])&& issetNotEmpty($_POST["detail"]) && issetNotEmpty($_POST["prix"])){
            
            $id_cat=$_POST["id_cat"];
            $nproduit= $_POST["nom_produit"];
            $descrip=$_POST["detail"];
            $prix=$_POST["prix"];
            $photo=$_POST["photo_produit"];
            $id_user=$_SESSION["id_user"];
                       
            $param=array($nproduit,$descrip,$prix, $id_user,$id_cat, $photo);
            
            $sql="INSERT INTO produit VALUES ('',?,?,?,?,?,?)";
            $requete= $bdd->prepare($sql);
            $requete->execute($param);
            $ligne = $requete->fetch();
            if ($ligne !== FALSE) {
            
                $message = "ok";        
           }
           else {
            $message = "error";
        }
        
        } 
    }catch (Exception $e) {
        echo $e->getMessage();
    }
    @header("location: ../produit.php?produit=" .$message);
    
}else if ($action == "admin") {
    $message = "";
    try {
        // verification des champs du formulaire  (existe et non vide)
        if (issetNotEmpty($_POST["login"]) && issetNotEmpty($_POST["pass"]) && issetNotEmpty($_POST["pass1"])){
            
            $login=$_POST["login"];
            $mdp=$_POST["pass"];
            $mdp1= $_POST["pass1"];
            
            //verification de la forme du mots de passe
            
                $verifier_login_req = "select count(*) as nbre from user where login = ?;";
                $requete= $bdd->prepare($verifier_login_req);
                $param = array($login);
                $requete->execute($param);
                $ligne = $requete->fetch();
                if($ligne['nbre'] == 0){
                    
                    $sql="INSERT INTO user VALUES (NULL,?, ?, 1)";
                    $requete= $bdd->prepare($sql);
                    $hash_password= hash('sha256', $mdp);
                    
                    $param = array($login, $hash_password);
                      
                        if ($requete->execute($param)) {
                            $message = "ok";
                        }
                         else
                          {
                         $message="error";
                         }
                }else 
                    { $message="error";
                }
        }
    }
    catch (Exception $e) {
        echo $e->getMessage();
    } 
    @header("location: ../admin.php?admin=" . $message);
    
    //traitement catégorie
    
}   else if ($action == "categorie") {
    $message = "";
    try {
         
         if (issetNotEmpty($_POST["libelle"])){
             
             $libelle=$_POST["libelle"];
             
             $verifier_libelle_req = "select count(*) as nbre from categorie where libelle =:libelle";
             $requete= $bdd->prepare($verifier_libelle_req);
             $requete->bindParam(':libelle', $libelle);
             $requete->execute();
             $ligne = $requete->fetch(PDO::FETCH_ASSOC);
             if($ligne['nbre'] == 0){
                 
                 $sql="INSERT INTO categorie VALUES ('','$libelle')";
                 $requete = $bdd->prepare($sql);
                 $requete->bindParam(':libelle', $libelle);
                 
                 if ($requete->execute()){ 
                     $message="ok"; 
                 }
                 else{
                     $message="error"; 
              } 
         }
     }
    }
     catch (Exception $e) {
         echo $e->getMessage();
     }
     @header("location: ../categorie.php?categorie=" . $message);
     
     
     //traitement sous catégorie
}else if ($action == "scategorie") {
    $message = "";
    try {

        if (issetNotEmpty($_POST["libelle"]) && issetNotEmpty($_POST["id_cat"])){
            
            $libelle= $_POST["libelle"];
            $id_cat=$_POST["id_cat"];
            
            $verifier_login_req = "select count(*) as nbre from scategorie where libelle = ?;";
            $requete= $bdd->prepare($verifier_login_req);
            $param = array($libelle);
            $requete->execute($param);
            $ligne = $requete->fetch();
            if($ligne['nbre'] == 0){
                
                $param=array($libelle, $id_cat);
                
                $sql="INSERT INTO scategorie VALUES ('',?,?)";
                $requete= $bdd->prepare($sql);
                
                if($requete->execute($param)){
                    $messge="ok";
                }
                else{
                    $message="error";
                }
            }
        }
    }
    catch (Exception $e) {
        echo $e->getMessage();
    }
    @header("location: ../scategorie.php?scategorie=" . $message);
    
    //traitement modifier producteur
    
}   else if ($action == "avis") {
    $message = "";
        try {
            
             // verification des champs du formulaire  (existe et non vide)
             if (issetNotEmpty($_POST["avis"])){
                                       
                    $detail=$_POST["avis"];
                    
                    //verification de la forme du mots de passe
                   
                    $sql="INSERT INTO avis VALUES ('',?)";
                    $requete= $bdd->prepare($sql);
                    $param = array($avis);
                    $requete->execute($param);
                    if($requete->execute()){
                        
                      echo'Votre avis a été bien enrégistré ';
                    }else 
                    {
                        echo "Une erreur est produite lors de l'enregistrement de votre avis, veuillez réessayer svp!";
                    }
                }
            }
            catch (Exception $e) {
                echo $e->getMessage();
            }
     @header("location: ../Accueil.php?avis=". $message);
     
     
     //traitement sous supprimer producteur
     
 }  else if ($action == "supProducteur") {
    
     try {
            // verification des champs du formulaire  (existe et non vide)
            if (issetNotEmpty($_POST["mail"])){
                
                $mail=$_POST["mail"];
               
                // verifier si le mail existe dans la table producteur 
                $verifier_mail_req = "select * from producteur where mail =?";
                $requete = $bdd->prepare($verifier_mail_req);
                $param = array($mail);
                $requete->execute($param);
                $ligne = $requete->fetch();
                if($ligne == TRUE){
                    
                    $_SESSION["id_user"]=$ligne["id_user"];
                    $temp =  $ligne["id_user"];
                    
                    //supprimer dans la table producteur
                    $sql ="DELETE from producteur WHERE mail='$mail'";
                    $requete= $bdd->prepare($sql);
                    $requete->execute();
                   // $ligne=$requete->fetch();
                    
                    //supprimer dans la table user 
                         $sql ="DELETE from user WHERE id_user=$temp";
                         $requete= $bdd->prepare($sql);
                         $requete->execute();
                         
                        // suprimer dans la table produit
                         
                         $sql= "DELETE FROM produit WHERE id_user=$temp";
                         $requete= $bdd->prepare($sql);
                         $requete->execute();
                         
                         if ($requete->execute()){
                           echo'Le compte a été supprimé avec succès';
                             } 
                             else 
                             { echo'Une erreur est survenue lors de la suppression du compte';
                           
                             }
                          }else
                             {   echo'Une erreur est survenue lors de la sppression du compte';
                                    }
           
            }
        }  catch (Exception $e) {
            echo $e->getMessage();
        }
 } else if ($action == "modifProducteur") {
          
     try {
         // verification des champs du formulaire  (existe et non vide)
         if (issetNotEmpty($_POST["mail"])){
             
             $mail=$_POST["mail"];
             
             // verifier si le mail existe dans la table producteur
             $verifier_mail_req = "select * from producteur where mail =?";
             $requete = $bdd->prepare($verifier_mail_req);
             $param = array($mail);
             $requete->execute($param);
             $ligne = $requete->fetch();
             if($ligne == TRUE){
                 
                 $_SESSION["id_user"]=$ligne["id_user"];
                 $temp =  $ligne["id_user"];
                 
                 $sql= "select * from producteur WHERE id_user='$temp'";
                 $requete = $bdd->prepare($sql);
                 $param = array($temp);
                 $requete->execute($param);
                 $ligne = $requete->fetch();
                 if($ligne == TRUE){
                     
                     echo '<form action="traitement.php" method="post">
                    <input type="text" name="prenom" value="'.$ligne['prenom'].'"/>
                    <input type="text" name="nom" value="'.$ligne['nom'].'"/>
                    <input type="text" name="mail" value="'.$ligne['mail'].'"/>
                    <input type="text" name="adresse" value="'.$ligne['adresse'].'"/>
                    <input type="text" name="cp" value="'.$ligne['cp'].'"/>
                    <input type="text" name="ville" value="'.$ligne['ville'].'"/>
                    <input type="hidden" name="action" id="action" value="mdfProducteur"/>
                    <input name="submit" type="submit"/>';
                     
                 }
                 else
                 { echo'Une erreur est survenue lors de la suppression du compte';
                 
                 }
             }
         }
     }catch (Exception $e) {
         echo $e->getMessage();
     }
 } else if  ($action == "mdfProducteur") {
     
     if($_POST["submit"]){
     
     try {
         // verification des champs du formulaire  (existe et non vide)
         
         if (issetNotEmpty($_POST['prenom'])&&  issetNotEmpty($_POST["nom"]) && issetNotEmpty($_POST["mail"]) && issetNotEmpty($_POST["adresse"])&& issetNotEmpty($_POST["cp"]) && issetNotEmpty($_POST["ville"]))
         {
             
             $prenom = $_POST['prenom'];
             $nom = $_POST['nom'];
             $mail = $_POST['mail'];
             $adresse = $_POST['adresse'];
             $cp = $_POST['cp'];
             $ville = $_POST['ville'];
             $id_user=$_SESSION["id_user"];
             
             
             //traitement de l'adresse
            /* $address=$_POST["adresse"];
             $address .=', ';
             $address .= $_POST["cp"];
             $address .=', ';
             $address .= $_POST["ville"];*/
             
             /* $coords= getXmlCoordsFromAdress($address);
              $latitude=$coords['lat'];
              $longitude=$coords['lon'];*/
             
             $sql = "UPDATE producteur set prenom=:prenom , nom=:nom, adresse=:adresse, cp=:cp, ville=:ville, mail=:mail where id_user=:id_user";
            //echo $sql;
             $requete = $bdd->prepare($sql);
             
             // initialisation des variables
             $requete->execute(array(
                 'prenom'=> $prenom,
                 'nom' => $nom,
                 'adresse'=> $adresse,
                 'cp' => $cp,
                 'ville'=> $ville,
                 'mail'=>$mail,
                 'id_user'=>$id_user
             ));
             echo "modifications effectuées avec succès!";
             //  $requete->execute($param
             /*
             $ligne = $requete->fetch();
             if($ligne == TRUE){
                 echo 'modification effectuée';
             } else {
                 echo' une erreur est produite dabns la modifiactionde vos données';
             }*/
         }
        
         
     }catch (Exception $e) {
         echo $e->getMessage();
     }
 }
 }
 ?>