function confirmation() {
         var message = "";
         var flag_nom = 0 ;
         var flag_prenom = 0 ;
         var flag_message = 0;
     
      //var regex_nom = new RegExp("/^([\s]*[-A-Z\'\`a-zàáâãäåçèéêëìíîïðòóôõöùúûüýÿÊËÄ ]+[\s]*)+$/");
    var regex_nom= new RegExp("^[-A-Z\'\`a-zàáâãäåçèéêëìíîïðòóôõöùúûüýÿÊÈÉËÄÀ ]*$", "g");
      var regex_prenom = new RegExp("^[-A-Z\'\`a-zàáâãäåçèéêëìíîïðòóôõöùúûüýÿÊÈÉËÄÀ ]*$", "g");
    var regex_email = new RegExp('^[a-z0-9]+([_|\.|-]{1}[a-z0-9]+)*@[a-z0-9]+([_|\.|-]{1}[a-z0-9]+)*[\.]{1}[a-z]{2,6}$', 'i');

     
      //contrôle de la chaine saisie pour le nom
      ///////////////////////////////////////////
     
      var nom = $j("#specialiste_nom").val();
      if (regex_nom.test($j("#specialiste_nom").val())) {
 
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
                
                  //contrôle de la chaine saisie pour le prénom
      /////////////////////////////////////////////
      var prenom = $j("#specialiste_prenom").val();

      if (regex_prenom.test($j("#specialiste_prenom").val())) {
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
                
     
      //controle saisie du motif de fin de prise en charge
      ////////////////////////////////////////////////////
     
     
               
     
     var email = $j("#specialiste_email").val();
      
if (email.length >= 1 ){

if (regex_email.test($j("#specialiste_email").val())) {

       }
       
       
      else{
          var flag_nom = 1 ;
          message = message  + "- Format incorrect, caractère non autorisé dans l'email "+ " \n";
     var flag_message = 1; 

 } 
}
//Affichage du message d'alerte ou submit de la form
      //////////////////////////////////////////////////////  
   

  
  
      if (flag_message == 0 ) {
          return true;
      }
      else if (flag_message = 1) {
          alert( message );
          var message = "";
          return false;
    }
 
      }   
   
