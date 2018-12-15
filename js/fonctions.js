function redirect(page){
	location.href = page;
}

function seconnecter(){
	var message = "";
	if(document.getElementById('login').value.trim() == ""){
		message += "- Merci de renseigner votre login\n";
	}
	if(document.getElementById('pass').value.trim() == ""){
		message += "- Merci de renseigner votre mot de passe\n";
	}
	if(message == ""){
		document.getElementById('formConnexion').submit();
	}else{
		alert(message);
	}
}
/**
 * validation du formulaire admin 
 */			

function validerAdmin()
{
		    var message ="";
	    if ( document.fadmin.login.value =="")
	    {
	    	message += "- Veuillez renseigner votre login !\n";
	    }
	    	
	    var pass1 = document.fadmin.pass.value;
	    var pass2 = document.fadmin.pass1.value;
	    if ( pass1 == "" )
	    {
	    	message += "-Veuillez entrer votre Mot de passe !\n";
	    }
	        
	    if ( pass2 == "" )
	    {
	    	message += "-Veuillez confirmer votre Mot de passe !\n";
	    }
	    
	    if(pass1 != "" && pass2 != "" && pass1 != pass2){
	    	message += "-Les mots de passe ne sont pas identiques !\n";
	    }
	   
	   if (message !=""){
    	alert(message);
	   }
	   else {
    	    	document.fadmin.submit();
    }

}

/**
 * validation du numero de téléphone producteur 
 */	

function numtelvalide(arg)

{
	var regex = new RegExp(/^([0-9]{10})/gi);
	/* var regex = new RegExp(/^(06));
	[0-9]{2}[0-9]{2}[0-9]{2}[0-9]{2}[0-9]{2} */
	
	if (regex.test (arg))
	{
		return (true);
	}
	else 
	{
		return (false);
	}
}

/**
 * validation du formulaire producteur 
 */		
function validerProducteur()
{
    var message = "";
    if ( document.fproducteur.prenom.value == "" )
    {
    	message += "- Veuillez entrer votre prénom !\n";
    }
    
    if ( document.fproducteur.nom.value == "" )
    {
    	message += "-Veuillez entrer votre nom !\n";
    }
    
//    if ( document.fproducteur.nom_photo.value == "" )
//    {
//        message += "-Veuillez entrer votre photo !\n";
//    }
    
    if ( document.fproducteur.adresse.value == "" )
    {
    	message += "-Veuillez entrer votre adresse !\n";
    }
        
    if ( document.fproducteur.cp.value == "" )
    {
    	message += "-Veuillez entrer votre Code Postal !\n";
    }
       
    if ( document.fproducteur.ville == "" )
    {
    	message += "-Veuillez entrer votre Ville !\n";
    }
       
    if ( document.fproducteur.oui.value == "" )
    {
    	message += "-Veuillez selectionner un champs !\n";
    }
    /*var tel =document.fproducteur.tel.value == "" ; 
    if (!numtelvalide(tel)) 
    { 
    	message += "- Respectez le champ requis pour le numero de telephone (ex.0610203040) \n";
    }
    */
   var email = document.fproducteur.email.value;
   
    if ( email == "" )
    {
    	message += "-Veuillez entrer votre e-mail !\n";
    }else if(!(email.indexOf('@') > 1 && email.lastIndexOf('.') > (email.indexOf('@') + 1) && email.lastIndexOf('.') < email.length-1) ){
    	message += "-Veuillez vérifier votre e-mail !\n";
    }
        
    if ( document.fproducteur.pres.value == "" )
    {
    	message += "-Veuillez entrer votre présenter !\n";
    }
        
    if ( document.fproducteur.login.value == "" )
    {
    	message += "-Veuillez entrer votre login !\n";
  
    }
    var pass1 = document.fproducteur.pass.value;
    var pass2 = document.fproducteur.pass1.value;
    if ( pass1 == "" )
    {
    	message += "-Veuillez entrer votre Mot de passe !\n";
    }
        
    if ( pass2 == "" )
    {
    	message += "-Veuillez confirmer votre Mot de passe !\n";
    }
    
    if(pass1 != "" && pass2 != "" && pass1 != pass2){
    	message += "-Les mots de passe ne sont pas identiques !\n";
    }
    
    if (message !=""){
    	alert(message);
    }
    else {
    	document.fproducteur.submit();
    }

}

/**
 * validation du formulaire produit 
 */	

function validerProduit()
{
	
    var message = "";
    if ( document.fproduit.nom_produit.value == "" )
    {
    	message += "- Veuillez entrer le nom du produit !\n";
    }
    
    if ( document.fproduit.detail.value == "" )
    {
    	message += "-Veuillez faire la description du produit !\n";
    }
    /*
    if ( document.fproduit.photo_produit.value == "" )
    {
    	message += "-Veuillez ajouter une photo du produit !\n";
    }
    */
    
  if ( document.fproduit.id_cat.value == "" )
    {
    	message += "-Veuillez choisir la catégorie !\n";
    }

    if ( document.fproduit.prix.value == "" )
    {
    	message += "-Veuillez donner le prix !\n";
    }
        
    if (message !=""){
    	alert(message);
	   }
	   else {
    	    	document.fproduit.submit();
    }

}
/**
 * validation du formulaire catégorie 
 */	

function validerCategorie()
{
	    var message = "";
    if ( document.fcategorie.libelle.value == "" )
    {
    	message += "- Veuillez entrer le nom de la catégorie !\n";
    }
    
    if ( document.fcategorie.image_categorie.value == "" )
    {
    	message += "-Veuillez une image de la catégorie !\n";
    }
    if (message !=""){
    	alert(message);
	   }
	   else {
    	    	document.fcategorie.submit();
    }

}

/**
 * validation du formulaire de la sous catégorie 
 */	


function validerSCategorie()
{
	    var message = "";
    if ( document.fscategorie.libelle.value == "" )
    {
    	message += "- Veuillez entrer le nom de la sous catégorie !\n";
    }
    
    if ( document.fscategorie.id_cat.value == "" )
    {
    	message += "-Veuillez selectionner une catégorie !\n";
    }
    if (message !=""){
    	alert(message);
	   }
	   else {
    	    	document.fscategorie.submit();
    }

}


/**
 * validation du formulaire consommateur 
 */		

function validerconsommateur()
{
    var message = "";
    if ( document.fconsommateur.adresse.value == "" )
    {
    	message += "- Veuillez entrer votre adresse !\n";
    }
    
    if ( document.fconsommateur.choix.value == "" )
    {
    	message += "-Veuillez faire une choix !\n";
    }
    
   if ( document.fconsommateur.produit.value == "" )
  {
       message += "-Veuillez entrer un produit !\n";
  	}
          
    if (message !=""){
    	alert(message);
    }
    else {
    	document.fconsommateur.submit();
    }
    }

//contrôle de la longueur du texte  Avis 
function maxcara(){
	max=350;
	champ=document.favis.avis; //nom du formulaire et nom du champ
	test=document.favis.test; //le_nom_du_formulaire.le_name_du_<input>
	  if (champ.value.length > max){
	champ.value = champ.value.substring(0, max);
	  }
	  else {
	test.value = max-champ.value.length;
			}
	  }
/*function maxcara1(){
	max=250;
	champ=document.fproducteur.pres; //nom du formulaire et nom du champ
	
if (champ.value.length > max){
	champ.value = champ.value.substring(0, max);
	else {
		test.value = max-champ.value.length;
			}
		}	
 }	*/		

 /*function maxcara2(){
		max=100;
		champ=document.fproduit.detail; //nom du formulaire et nom du champ
		
	if (champ.value.length > max){
				champ.value = champ.value.substring(0, max);
				else {
					test.value = max-champ.value.length;
				}
			}	
	 }			
	*/
 /**
  * validation du formulaire avis 
  */	

 function validerAvis()
 {
 	    var message = "";
     if ( document.favis.avis.value =="" )
     {
     	message += "- Veuillez saisir votre avis !";
     }
     if (message !=""){
     	alert(message);
 	   }
 	   else {
     	    document.favis.submit();
     }

 }
 
 /**
  * validation du formulaire supprimer producteur  
  */	

 function suppProducteur()
 {
	 var message = "";
	 var email = document.fsupProducteur.mail.value;
	   
	    if ( email == "" )
	    {
	    	message += "-Veuillez entrer votre e-mail !\n";
	    }else if(!(email.indexOf('@') > 1 && email.lastIndexOf('.') > (email.indexOf('@') + 1) && email.lastIndexOf('.') < email.length-1) ){
	    	message += "-Veuillez vérifier votre e-mail !\n";
	    }
 	         
     if (message !=""){
     	alert(message);
 	   }
 	   else {
     	    	document.fsupProducteur.submit();
     }

 }
  
 /**
  * validation du formulaire modifier producteur
  */
 function modifProducteur()
 {
	 var message = "";
	 var email = document.fmodifProducteur.mail.value;
	   
	    if ( email == "" )
	    {
	    	message += "-Veuillez entrer votre e-mail !\n";
	    }else if(!(email.indexOf('@') > 1 && email.lastIndexOf('.') > (email.indexOf('@') + 1) && email.lastIndexOf('.') < email.length-1) ){
	    	message += "-Veuillez vérifier votre e-mail !\n";
	    }
 	         
     if (message !=""){
     	alert(message);
 	   }
 	   else {
     	    	document.fmodifProducteur.submit();
     }

 }
	 