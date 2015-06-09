


function confirm_message() {

if( $j("#mdph_dateenvoiedossier").val()!=""  && $j("#mdph_depotparent").is(":checked") == false  ){
	
	var message1 = "Vous avez renseigné la date de transmission à la MDPH \n  ";
}

if ( $j("#mdph_depotparent").is(":checked") == true && $j("#mdph_dateenvoiedossier").val() =="") {
	var message1 = "Vous avez coché la case Déposé par les parents \n"  }


	flag_message = 0;
	
	if( $j("#mdph_dateess").val()==""){
	message1= message1 + " - Vous n'avez pas renseigné : \nde date de réunion \n ";	
	flag_message = 1;
	}

	if( $j("#mdph_datecreationpps").val()==""){
	message1= message1 + "- Vous n'avez pas renseigné : \nla date de signature de la demande Cerfa \n";	
	flag_message = 1;
	}
	if( $j("#mdph_datepjdom").val()==""){
	message1= message1 + "- Vous n'avez pas renseigné : \nla date du reçu du justificatif de domicile \n";	
	flag_message = 1;
	}
	if( $j("#mdph_datepjident").val()==""){
	message1= message1 + "- Vous n'avez pas renseigné : \nla date du reçu du justificatif d'identité  \n";
	flag_message = 1;	
	}

	if( $j("#mdph_datebilanmedical").val()==""){
	message1= message1 + "- la date du bilan Medical \n";	
	flag_message = 1;
	}


message1 = message1 + "Voulez vous continuer ?"
return { message1:message1,flag_message:flag_message };
}




function verif_mdph() {
var message ="";
   var flag = 0;


    date1 =$j("#mdph_dateess").val() ; 
	jour_1 = date1.substring(0,2);
    mois_1 = date1.substring(3,5);
    annee_1 = date1.substring(6,10);
    d_1 = new Date(annee_1, mois_1-1, jour_1);
    
	date2 =$j("#mdph_datecreationpps").val() ; 
	jour_2 = date2.substring(0,2);
    mois_2 = date2.substring(3,5);
    annee_2 = date2.substring(6,10);
    d_2 = new Date(annee_2, mois_2-1, jour_2);
	
	date3 =$j("#mdph_datepjdom").val() ; 
	jour_3 = date3.substring(0,2);
    mois_3 = date3.substring(3,5);
    annee_3 = date3.substring(6,10);
    d_3 = new Date(annee_3, mois_3-1, jour_3);
	
	date4 =$j("#mdph_datepjident").val() ; 
	jour_4 = date4.substring(0,2);
    mois_4 = date4.substring(3,5);
    annee_4 = date4.substring(6,10);
    d_4 = new Date(annee_4, mois_4-1, jour_4);
	

	date5 =$j("#mdph_datebilanmedical").val() ; 
	jour_5 = date5.substring(0,2);
    mois_5 = date5.substring(3,5);
    annee_5 = date5.substring(6,10);
    d_5 = new Date(annee_5, mois_5-1, jour_5);
	
	date6 =$j("#mdph_dateenvoiedossier").val() ; 
	jour_6 = date6.substring(0,2);
    mois_6 = date6.substring(3,5);
    annee_6 = date6.substring(6,10);
    d_6 = new Date(annee_6, mois_6-1, jour_6);
  	 

  	// La date de reunion doit etre la date la plus anterieure 

            if(d_2 < d_1 && $j("#mdph_datecreationpps").val()!="" ){   
			
			
				message = message + " - la date de réunion  " + date1 + " doit étre antérieure \n à la date de signature de la demande Cerfa " + date2  + " \n";
				 flag = 1;
			   
			}
	  
	 
	       if( d_3 < d_1 && $j("#mdph_datepjdom").val()!=""  ){  
			
			
		
				message = message + " - la date de réunion  " + date1 + " doit étre antérieure \n à la date du reçu du justificatif de domicile " + date3 + " \n";
				 flag = 1;
				
			}
	
	  
 
            if( d_4 < d_1 && $j("#mdph_datepjident").val()!="" ){ 
			
			
			  
				message = message + " - la date de réunion  " + date1 + " doit étre antérieure \n à la date du reçu du justificatif d'identité   " + date4  + " \n";
				 flag = 1;
				 
			}


			if( d_5 < d_1 && $j("#mdph_datebilanmedical").val()!=""  ){   
			
			

				message = message + " - la date de réunion  " + date1 + " doit étre antérieure \n à la date du bilan Medical " + date5  + " \n";
				 flag = 1;
				 
			}

	      if( d_6 < d_1 && $j("#mdph_dateenvoiedossier").val()!=""   ){   
			
			
			  
				message = message + " - la date de réunion  " + date1 + " doit étre antérieure \n à la date de la transmission du dossier MDPH " + date6  + " \n";
				 flag = 1;
				 
			}
	        if(d_6 < d_2 && $j("#mdph_datecreationpps").val()!="" && $j("#mdph_dateenvoiedossier").val()!="" ){   
			
								
					message = message + " - la date de transmission du dossier mdph  " + date6 + " doit étre postérieure \n à la date de signature de la demande Cerfa " + date2  + " \n";
					 flag = 1;
					
			
	        }
	 
	       if( d_3 >d_6 && $j("#mdph_datepjdom").val()!="" && $j("#mdph_dateenvoiedossier").val()!="" ){  
			
			
		
				message = message + " - la date de transmission du dossier mdph " + date6 + " doit étre postérieure \n à la date du reçu du justificatif de domicile " + date3  + " \n";
				 flag = 1;
				
			}
			
			
	
           if( d_4 > d_6 && $j("#mdph_datepjident").val()!="" && $j("#mdph_dateenvoiedossier").val()!=""){ 
			
					  
				message = message + " - la date de transmission du dossier mdph  " + date6 + " doit étre postérieure \n à la date du reçu du justificatif d'identité   " + date4  + " \n";
				 flag = 1;
				 
			}


            if( d_5 > d_6 && $j("#mdph_datebilanmedical").val()!="" && $j("#mdph_dateenvoiedossier").val()!=""){   
						
				message = message + " - la date de transmission du dossier mdph  " + date6 + " doit étre postérieure \n à la date du bilan Medical " + date5  + " \n";
				 flag = 1;
				 
			}
			
			
			
			if( $j("#mdph_dateenvoiedossier").val()!="" && $j("#mdph_depotparent").is(":checked") == true  ){ 
		   	 flag = 1;
			 message = message + 'le dossier ne peut pas être';			

           }else{
		   
		   			 
			//Affichage suite aux controles des dates du dossier MDPH
            //----------------------------------------------------------	

			//Exécution de la fonction message
			Affichage = confirm_message();	
			
		   if( Affichage.flag_message == 1   ){ //test du flag_message
			
				if ( confirm(Affichage.message1) == true) {
					return true; }
				else {
					return false;
				} 
			
			
		   }

		   }

			if(flag == 1){
			  alert(message );
			return false;  
			}



  
 }



