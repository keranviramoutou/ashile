 function verif_scolarite() {
	
    var message ="";
    var flag = 0;
   
   
   	date1 =$j("#orientation_datedebut").val() ; 
	jour_1 = date1.substring(0,2);
    mois_1 = date1.substring(3,5);
    annee_1 = date1.substring(6,10);
    d_1 = new Date(annee_1, mois_1-1, jour_1);
    
	date2 =$j("#orientation_datefin").val() ; 
	jour_2 = date2.substring(0,2);
    mois_2 = date2.substring(3,5);
    annee_2 = date2.substring(6,10);
    d_2 = new Date(annee_2, mois_2-1, jour_2);
	
	
	//contrôle des dates saisies par rapport à l'annèe scolaire
	//--------------------------------------------------------
	debut_annee_sco = "<?php echo $deb ?>";
	debut_annee_sco_affiche = "<?php echo $affiche_deb ?>";
	jour_3 = debut_annee_sco.substring(8,10);
    mois_3 = debut_annee_sco.substring(5,7);
    annee_3 = debut_annee_sco.substring(0,4);
    debut_annee_sco1 = new Date(annee_3, mois_3-1, jour_3);  

	
	fin_annee_sco = "<?php echo $fin ?>";
	fin_annee_sco_affiche = "<?php echo $affiche_fin ?>";
	jour_4 = fin_annee_sco.substring(8,10);
    mois_4 = fin_annee_sco.substring(5,7);
    annee_4 = fin_annee_sco.substring(0,4);
    fin_annee_sco1 = new Date(annee_4, mois_4-1, jour_4); 
		
	
	//date de la dernière scolarisation controle de chevauchement des dates saisies avec les scolarités existentes
	//------------------------------------------------------------------------------------------------------------
	
	/* if("<?php echo $orientation[0]['orienId'] ?>"){
	date5 ="<?php echo $orientation[0]['datedebut']?>";
	jour_5 = date5.substring(0,2);
    mois_5 = date5.substring(3,5);
    annee_5 = date5.substring(6,10);
    d_1 = new Date(annee_6, mois_6-1, jour_6);
    
	date7 ="<?php echo  $orientation[0]['datefin'] ?>";
	jour_7 = date7.substring(0,2);
    mois_7 = date7.substring(3,5);
    annee_7 = date7.substring(6,10);
    d_7 = new Date(annee_7, mois_7-1, jour_7); 
	}*/
	
	
	
	
	
  	   if ($j("#orientation_etabsco_id").val() == "" ) {
         //alert ("selectionner une établissement  :");
		 message = " - Sélectionner un établissement  " + " \n" ;
		 flag = 1;
         // return false;
      }
	  
	  
	  if ($j("#orientation_classe_id").val() == "" || $j("#orientation_classe_id").val() == 0 ) {
        //alert ("selectionner une établissement  :");
		message = message + " - Sélectionner une classe  " + " \n" ;
		 flag = 1;
         // return false;
      }
	  
	  
	  
	  if ($j("#orientation_niveauscolaire_id").val() == "" || $j("#orientation_niveauscolaire_id").val() == 0) {
        //alert ("selectionner une établissement  :");
		message = message + " - Sélectionner le niveau scolaire  " + " \n" ;
		 flag = 1;
         // return false;

      }
	  
	  
	  	  if ($j("#orientation_demijournee_id").val() == "" || $j("#orientation_demijournee_id").val() == 0) {
        //alert ("selectionner une établissement  :");
		message = message + " - Sélectionner le temps de scolarisation  " + " \n" ;
		 flag = 1;
         // return false;

      }
	  
	  
  	   if ($j("#orientation_datedebut").val() == "" || $j("#orientation_datefin").val() == "" ) {
        // alert ("Saisir une date de début et une date de fin de prise en charge ");
		 message = message + " - Saisir une date de début et une date de fin de prise en charge " + " \n";
		 	 flag = 1;
         // return false;
      }else{
	  
		   if( d_2 < d_1  ){  //date de début supérieure à la date de fin de scolarité
			   
			 
				message = message + " - la date de début de scolarité " + date1 + " inférieure à la date de fin de scolarité " + date2  + " \n";
				 flag = 1;

			}
		
			
			if( fin_annee_sco1 < d_2  ){  //date de fin de scolarité saisie  supérieure à la date de fin de l'année scolaire en cours
		
			   	message = message + " - la date de fin de scolarité  " + date2 + " supérieure à la date de fin de l'année scolaire en cours  " +	fin_annee_sco_affiche  +" \n";
                 flag = 1;

			}
			
			
			if( debut_annee_sco1 > d_1  ){  //date de début inférieure à la date de fin de l'année scolaire en cours
			 
				message = message + " - la date de début de scolarité " + date1 + " inférieure à la date de début de l'année scolaire en cours "  +	debut_annee_sco_affiche  +" \n";
				 flag = 1;
		

			}
	  
	  }
	  
	    var rased = $j("#orientation_rased_id").val();
 var rased2 = $j("#orientation_rased2_id").val();
if ((rased != "" ) && (rased == rased2)) {
        
		 message = message + " - Veuilez saisir deux Rased Differents " + " \n";
		 	 flag = 1;
         // return false;

} 

   if(flag == 1){
	  alert(message);
	  return false;
	}else{
      document.body.style.cursor='wait';
     
        return true;
	}
    }