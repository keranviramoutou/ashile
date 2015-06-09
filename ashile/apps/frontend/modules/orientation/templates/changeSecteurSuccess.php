<?php use_helper('jQuery') ?>
<?php use_stylesheet('data_table.css') ?>
<?php use_stylesheet('datatable_jui.css') ?>
<?php use_javascript('jquery.dataTables.min.js') ?>
<?php use_helper('Date') ?>

<h3> <?php echo 'Changement de secteur pour l\'élève :&nbsp;' .$orientation[0]['nom'].'&nbsp;'.$orientation[0]['prenom'].'&nbsp;('.$orientation[0]['eleveId'].')</b>' ?> </h3>


	<form action="<?php echo url_for('orientation/changeSecteur?flag=1'.'&eleve_id='.$orientation[0]['eleveId']); ?>"  method="POST">
	<fieldset>
	                            <?php echo 'Secteur d\'origine de l\'élève &nbsp;:&nbsp;<b>'.$orientation[0]['libellesecteur'].'</b><br><br>'?>
								<?php echo ' Scolarisé(e) à&nbsp;<b>'.$orientation[0]['typetab'].'&nbsp;'.$orientation[0]['nometabsco'].'&nbsp;'.$orientation[0]['rne'].'<br></b>Du&nbsp;<b>'.format_date($orientation[0]['datedebut'],'dd-MM-yyyy').'</b>&nbsp;au&nbsp;<b>'.format_date($orientation[0]['datefin'],'dd-MM-yyyy').'<br>'?>&nbsp;&nbsp; 
						         <br>Sélectionner le secteur d'accueil de l'élève &nbsp;&nbsp;
								<select id="valSecteurId" name="secteur_id" style="width: auto;">
								<option value = "">	</option>
								<?php foreach($secteur as $secteurs) { ?>		
								<option  value ="<?php echo $secteurs['secteur_id']; ?>"
								
								<?= ( $secteurs['libellesecteur'] == $_POST['libellesecteur'] ? 'selected="selected"' : '' ) ?>>
								<?php	echo $secteurs['libellesecteur']; ?>
								</option>
								<?php	} ?>
								</select>
								
								<br><br>Saisir la date fin de scolarisation&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" name="maj" value ="<?php echo format_date($orientation[0]['datefin'],'dd-MM-yyyy'); ?>" style="width:80px" id="calendrier"></br>&nbsp;<br>
							
								
								<br> <br><input type="submit" value="Enregistrer le changement de secteur" onclick="return confirmation();" />
	</fieldset>
	</form>
	
	
	
	<!-- Script pour DatePicker -->
	<script>
		$j(function() {
		$j( "#calendrier" ).datepicker({ dateFormat: 'dd-mm-yy'}); //'format_date' => ''  dd/mm/yy
		});
	</script>
	<!---------------------------->
	
	
	
<script>


function confirmation() {

//vérification de la date saisie
var message = "";
var message1 = "";
var secteur = document.getElementById('valSecteurId').value;
var sdate1 = document.getElementById('calendrier').value;
var date1 = new Date(sdate1.substr(6,4),sdate1.substr(3,2),sdate1.substr(0,2));
var eleveavs = "<?php echo $count_eleveavs ?>";
var flag ="";

 //date de début de scolarité
var sdate2 = "<?php echo $orientation[0]['datedebut'] ?>";
var date2 = new Date(sdate2.substr(0,4),sdate2.substr(5,2),sdate2.substr(8,2));
 var affiche2 = sdate2.substr(8,2)+'-'+sdate2.substr(5,2)+'-'+sdate2.substr(0,4)

 //date de fin de scolarité
var sdate3 = "<?php echo $orientation[0]['datefin'] ?>";
var date3 = new Date(sdate3.substr(0,4),sdate3.substr(5,2),sdate3.substr(8,2));
 var affiche3 = sdate3.substr(8,2)+'-'+sdate3.substr(5,2)+'-'+sdate3.substr(0,4)
 
 
  //date de début de 'lannée scolaire 
var sdate4 = "<?php echo $deb ?>";
var date4 = new Date(sdate4.substr(0,4),sdate4.substr(5,2),sdate4.substr(8,2));
 var affiche4 = sdate4.substr(8,2)+'-'+sdate4.substr(5,2)+'-'+sdate4.substr(0,4)

 //date de fin de l'année scolaire
var sdate5 = "<?php echo $fin ?>";
var date5 = new Date(sdate5.substr(0,4),sdate5.substr(5,2),sdate5.substr(8,2));
var affiche5 = sdate5.substr(8,2)+'-'+sdate5.substr(5,2)+'-'+sdate5.substr(0,4)


    //controle saisie du secteur
	if( secteur == "" ) 
	{  
		message = 'Saisir un secteur '+  " \n";;
		flag = 1 ;
	}

    //comparaison date saisie avec de début de scolarité
	if( date1 <date2 ) //date saisie inférieure à la date de début de scolarité
	{  
		message = message + 'Vous avez saisi une date incorrecte ' +sdate1+', elle est inférieure à la date de début de scolarité ! : ' + affiche2+ " \n";;
		flag = 1 ;
	}
	
	//comparaison date saisie avec date de fin de scolarité
		if( date1 < date3) //date saisie supérieure à la date de fin de scolarité
	{  
		//message = message +'Vous avez saisi une date incorrecte ' +sdate1+', elle est inférieure à la date de fin de scolarité ! : ' + affiche3+ " \n";;
		//flag = 1 ;
	}
	
		//comparaison date saisie avec date de fin de scolarité
		if( date1 > date5) //date saisie supérieure à la date de fin de l'année scolaire
	{  
		message = message +'Vous avez saisi une date incorrecte ' +sdate1+', elle est supérieure à la date de fin de l\'année scolaire ! : ' + affiche5+ " \n";;
		flag = 1 ;
	}

    if(eleveavs == 0){
	}else{
	message1 = 'Attention !!\n il existe des accompagnements en cours pour cet(te) élève '+'\n ils devront être certainement clôturé(s) et ou modifié(s)\n';
	//alert( message1);
	}	
  
   if(flag == 1){
   alert (message);
    return false;
	}else{

	
	//alert('ggggggggggggggggggggggggg');
       	    var conf = confirm(message1+'\nConfirmez vous le changement de secteur pour cet(te) élève ?');
		if (conf){
		  //action à faire pour la valeur true
		  return true;
		}else{
			alert("Abandon de la procèdure");
		  //action à faire pour la valeur false
		   return false;

		}
	
   }


}

</script>
