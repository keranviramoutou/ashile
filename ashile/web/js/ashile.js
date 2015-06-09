   function ValiderForm() {
     
	 var message ="Renseigner ";
	 
	 //contrôle de la chaine saisie pour le nom
	  var regex = new RegExp("/^([\s]*[-A-Z\'\`a-zàáâãäåçèéêëìíîïðòóôõöùúûüýÿÊËÄ ]+[\s]*)+$/");
      if (regex.test ($j("#eleve_nom").val())) {
      alert ('Format incorrect, caractère non autorisé dans le Nom');
          return false;
      }
	  
	   if (regex.test ($j("#eleve_prenom").val())) {
      alert ('Format incorrect, caractère non autorisé dans le Prénom');
          return false;
      }
	   if ( $j("#eleve_datenaissance").val() == "" ) { var message = message +"la date de Naissance"+ " \u00a0" } ;
       if ( $j("#eleve_nom").val() == "" ) { var message = message +" le Nom " + " \u00a0"} ;
	   if ( $j("#eleve_prenom").val() == "" ) { var message = message + " le Prénom" } ;
	   if ( $j("#eleve_sexe").val() == "" ) { var message = message + "le Sexe" } ;
      if ($j("#eleve_nom").val() != "" && $j("#eleve_prenom").val() != "" && $j("#eleve_datenaissance").val() != "" && $j("#eleve_sexe").val() != "") { document.eleve.submit() }
      else {
      alert( message );
      }
   }