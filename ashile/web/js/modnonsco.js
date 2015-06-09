
    function verif() {
	 var message ="";
   var flag = 0;
   
   
   	date1 =$j("#modnonsco_datedebut").val() ; 
	jour_1 = date1.substring(0,2);
    mois_1 = date1.substring(3,5);
    annee_1 = date1.substring(6,10);
    d_1 = new Date(annee_1, mois_1-1, jour_1);
    
	date2 =$j("#modnonsco_datefin").val() ; 
	jour_2 = date2.substring(0,2);
    mois_2 = date2.substring(3,5);
    annee_2 = date2.substring(6,10);
    d_2 = new Date(annee_2, mois_2-1, jour_2);
	
	
	
	
  	   if ($j("#modnonsco_etabnonsco_id").val() == "" ) {
        //alert ("selectionner une établissement  :");
		message = " - Sélectionner une établissement  " + " \n" ;
		 flag = 1;
         // return false;

      }
	  
	  
  	   if ($j("#modnonsco_datedebut").val() == "" || $j("#modnonsco_datefin").val() == "" ) {
        // alert ("Saisir une date de début et une date de fin de prise en charge ");
		 message = message + " - Saisir une date de début et une date de fin de scolarité" + " \n";
		 	 flag = 1;
         // return false;
      }else{
	  
		if( d_2 > d_1  ){  //date de début supérieure à la date de fin de scolarité
			   // return true;
			}
			else{
			  //  alert ("la date de début de prise " + date1 + " inférieure \n à la date de fin de prise en charge " + date2 );
				message = message + " - la date de début scolarité " + date1 + " inférieure \n à la date de fin de scolarité " + date2  + " \n";
				 flag = 1;
				//$j("#modnonsco_datedebut").focus() ;
			   // return false;
			}
	  
	  }
	  

    

	
	  
    if(flag == 1){
	  alert(message );
	  return false;
	}
    
        message ="";
        return true;
    }


