function ValiderForm() {
     var message = "";
         var flag_nom = 0 ;
         var flag_prenom = 0 ;
         var flag_message = 0;
     
    // var regex = new RegExp("/^([\s]*[-A-Z\'\`a-zàáâãäåçèéêëìíîïðòóôõöùúûüýÿÊËÄ ]+[\s]*)+$/");
       var regex_nom= new RegExp("^[-A-Z\'\`a-zàáâãäåçèéêëìíîïðòóôõöùúûüýÿÊÈÉËÄ ]*$", "g");
      var regex_prenom = new RegExp("^[-A-Z\'\`a-zàáâãäåçèéêëìíîïðòóôõöùúûüýÿÊÈÉËÄ ]*$", "g");
     var regex_nom_nais = new RegExp("^[-A-Z\'\`a-zàáâãäåçèéêëìíîïðòóôõöùúûüýÿÊÈÉËÄ ]*$", "g");     
      //contrôle de la chaine saisie pour le nom
      ///////////////////////////////////////////
     
     var nom = $j("#avs_nom").val();
      if (regex_nom.test($j("#avs_nom").val())) {

       }
       
       
        else{
          var flag_nom = 1 ;
          message = message  + "- Format incorrect, caractère non autorisé dans le Nom "+ " \n";
          var flag_message = 1;
      } 
     

       
       
       
        if (nom.length <= 2 && nom.length >= 1){ var message = message + "- Saisir au moins 3 caractères dans le nom"+ " \n"
        var flag_message = 1; 
     }      
     
       if   ( nom.length == 0  ) {
            var message =  "- Renseigner le Nom " + " \n";
           var flag_message = 1;
                  }            
       
var nom_nais = $j("#avs_nom_nais").val();

      if (regex_nom_nais.test($j("#avs_nom_nais").val())) {
     }     
            else{
             
           //alert ('Format incorrect, caractère non autorisé dans le Nom ')
              message = message  + "- Format incorrect, caractère non autorisé dans le Nom de Naissance " + " \n";
              var flag_message = 1;
         // return false;
      }

        if (nom_nais.length <= 2 && nom_nais.length >= 1){ var message = message + "- Si vous souhaitez saisir un nom de naissance veuillez saisir au moins 3 caractéres"+ " \n"
        var flag_message = 1; 
     }      
       
                
                  //contrôle de la chaine saisie pour le prénom
      /////////////////////////////////////////////
      var prenom = $j("#avs_prenom").val();

      if (regex_prenom.test($j("#avs_prenom").val())) {
     }     
            else{
              var flag_prenom = 1 ;
              //alert ('Format incorrect, caractère non autorisé dans le Nom ')
              message = message  + "- Format incorrect, caractère non autorisé dans le Prénom" + " \n";
              var flag_message = 1;
         // return false;
      }
     
      if (prenom.length <= 2 && prenom.length >= 1){
          var message = message + "- Saisir au moins 3 caractères dans le prénom"+ " \n";
          var flag_message = 1;
      }
     
      
      
      
        if   (prenom.length == 0 ) {
              var message = message +  "- Renseigner le Prénom " + " \n";
              var flag_message = 1;}     
 
if ( $j("#avs_date_naissance").val() == "" ) {
           var message = message +"- Renseigner la date de Naissance "+ " \n" ;
           var flag_message = 1;
       } ; 


 if (flag_message == 0 ) {
          document.avs.submit();
      }
      else if  (flag_message == 1) {
          alert( message );
          var message = "";
          return false;
      } 
   }