function verif_tuteur()
{


         var message = "";
         var flag_nom = 0 ;
         var flag_prenom = 0 ;
         var flag_message = 0;

   
     
      //contrôle de la chaine saisie pour le nom
      ///////////////////////////////////////////
    
      var nom = $j("#tuteur_new_ResponsableEleve_nom").val();
	  var nom_edit = $j("#tuteur_ResponsableEleve_nom").val();
      var prenom = $j("#tuteur_new_ResponsableEleve_prenom").val();
    

	
       //var regex_nom = new RegExp("/^([\s]*[-A-Z\'\`a-zàáâãäåçèéêëìíîïðòóôõöùúûüýÿÊËÄ ]+[\s]*)+$/");
      var regex_nom= new RegExp("^[-A-Z\'\`a-zàáâãäåçèéêëìíîïðòóôõöùúûüýÿÊÈÉËÄ ]*$", "g");
	    var regex_nom_edit= new RegExp("^[-A-Z\'\`a-zàáâãäåçèéêëìíîïðòóôõöùúûüýÿÊÈÉËÄ ]*$", "g");
      var regex_prenom = new RegExp("^[-A-Z\'\`a-zàáâãäåçèéêëìíîïðòóôõöùúûüýÿÊÈÉËÄ ]*$", "g");
	   
     
     
      //contrôle de la chaine saisie pour le nom
      ///////////////////////////////////////////
        if (regex_nom.test($j("#tuteur_new_ResponsableEleve_nom").val())) {
 
       }else{
          var flag_nom = 1 ;
          message = message  + "- Format incorrect, caractère non autorisé dans le Nom "+ " \n";
          var flag_message = 1;
      }
	  
	  if (regex_nom_edit.test($j("#tuteur_ResponsableEleve_nom").val())) {
 
       }else{
          var flag_nom = 1 ;
          message = message  + "- Format incorrect, caractère non autorisé dans le Nom___ "+ " \n";
          var flag_message = 1;
      }
	  
	  
	   //contrôle de la chaine saisie pour le prénom
      ///////////////////////////////////////////
                
       if   ( nom.length == 0  ) {
            var message =  message +"- Renseigner le Nom " + " \n";
           var flag_message = 1;
                  } 
				  

				  
        if   ( prenom.length == 0  ) {
            var message =  message +"- Renseigner le Prénom " + " \n";
            var flag_message = 1;
                  }   
  
      if (regex_prenom.test($j("#tuteur_new_ResponsableEleve_prenom").val())) {
 
       }
       
       
        else{
          var flag_nom = 1 ;
          message = message  + "- Format incorrect, caractère non autorisé dans le prénom "+ " \n";
          var flag_message = 1;
      }

	 
      if (nom.length <= 2 && nom.length >= 1){ 
	  var message = message + "- Saisir au moins 3 caractères dans le nom"+ " \n"
        var flag_message = 1;
     
      }
	  
	 if (prenom.length <= 2 && prenom.length >= 1){ 
	 var message = message + "- Saisir au moins 3 caractères dans le prénom"+ " \n"
        var flag_message = 1;
     
      }
   				  
   
      if (nom.length > 30){ 
	  var message = message + "- Le nom ne peut excéder 30 caractéres"+ " \n"
        var flag_message = 1;
     
      }
     
      if ( prenom.length >20){ 
	 var message = message + "- Le prénom ne pet excéder 20 caractéres"+ " \n"
        var flag_message = 1;
     
      }


 //Affichage du message d'alerte ou submit de la form
      //////////////////////////////////////////////////////
	if(flag_message == 1){
	  alert(message);
	  return false;
	}else{
	//document.eleve.submit();
    document.body.style.cursor='default';
    return true;
	}
   

}
	
function aide_tuteur() {
	var src = "<?php echo url_for('tuteur/aide') ?>";
		$j.modal('<iframe src="' + src + '" height="450" width="830" style="border:0">', {
			closeHTML:"",
			containerCss:{
				backgroundColor:"#fff",
				borderColor:"#fff",
				height:450,
				padding:0,
				width:830
			},
			overlayClose:true
		});
	}
