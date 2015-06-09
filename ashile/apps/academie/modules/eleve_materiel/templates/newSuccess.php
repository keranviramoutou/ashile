<?php use_helper('Date') ?>

<h3>Gestion Matériel > Attribution d'un materiel</h3>
<div id="materiel_eleve">
<div class='aide' onClick="<?php echo url_for('eleve_materiel/aide') ?>"> </div> 
<?php
   if($existeleve)
   {
    echo '<fieldset><legend> vous traitez l\'éleve :<strong> '.$eleve.'&nbsp&nbsp né(e) le :&nbsp;'.format_date($eleve->datenaissance,'dd/MM/yyyy').'</strong></legend>';
    ?>

	
	<?php if ($sf_request->getParameter('eleve_id')) { ?>
       <?php //echo 'hhhhhh'.$count_dem_mat ?>
       <?php if($count_dem_mat > 0){ ?>
		Selectionner la demande matériel à "A ATTRIBUER" à traiter&nbsp;:</br><br>
		<select id="valDemandeId" name="demandemat" style="width: auto;"  onchange="maFonction('<?php echo $sf_request->getParameter('eleve_id') ?>')" >
		<option value = "">	</option>
		<?php foreach ($demande_materiel as $demande_materiels){ ?>
		<option  value ="<?php echo $demande_materiels['demandemateriel_id']; ?>"<?php echo ( $demande_materiels['demandemateriel_id'] == $sf_request->getParameter('demandemateriel_id') ? 'selected="selected"' : '' ) ?>>
		<?php echo  '- Type :&nbsp; <strong>'.$demande_materiels['typemateriel'].'&nbsp; cat :&nbsp;'.$demande_materiels['catmateriel'].'</strong>&nbsp;&nbsp;- Notifiée du &nbsp:&nbsp<strong>'.format_date($demande_materiels['datedebutnotif'],'dd/MM/yyyy').'</strong>&nbsp&nbspau&nbsp&nbsp<strong>'.format_date($demande_materiels['datefinnotif'],'dd/MM/yyyy')
		 .'</strong>&nbsp-&nbspDécision de la CDA du :&nbsp<strong>'.format_date($demande_materiels['datedecisioncda'],'dd/MM/yyyy').'</strong><p>'.$demande_materiels['notes'];
		  ?>
		</option>
 		<?php	} // fin foreach?> 
	   </select>
	    <?php }else{ ?>
		<?php echo '<div class="flash_error">Pas de demande de matériel à l\'état A ATTRIBUER, impossible de créer un PRET de matériel'?>
        <?php	} // test existence demande matériel à attribuer?> 

		<?php if( $count_dem_mat > 0 && $sf_request->getParameter('demandemateriel_id')) { ?>
			<br><br>Selectionner le matériel en stock&nbsp;:</br><br>
			<select id="materiel_id" name="materiel_id" style="width: auto;" onchange="maFonction1('<?php echo $sf_request->getParameter('eleve_id') ?>')"   >
			<option value = "">	</option>
			 <?php foreach ($mat_en_stock as $mat_en_stocks){ ?>
				<option  value ="<?php echo $mat_en_stocks['materiel_id']; ?>"<?php echo ( $mat_en_stocks['materiel_id'] == $sf_request->getParameter('materielsel_id') ? 'selected="selected"' : '' ) ?>>
				<?php echo '- n°&nbsp;'. $mat_en_stocks['numeroMateriel'].'- marque :&nbsp'.$mat_en_stocks['marque'].'- référence :&nbsp;'.$mat_en_stocks['libelleMateriel']?>
			</option>
		   
			<?php	} ?> 
			</select>
			 <?php echo '</strong><p></fieldset>'; ?>
		<?php  } ?>
	<?php  }else{ //test existence eleve_id ?> 
	
	 <?php echo '<div class="flash_error">Pas de demande de matériel dossier MDPH en cours à la date du&nbsp '.format_date(time(),'dd/MM/yyyy').'</div></fieldset>';

	  }

	 } //test eleve
	  
	 if($existmateriel) { ?>
	        <?php echo '<fieldset><legend> vous traitez le matériel :<strong> '.$materiel.'&nbsp;&nbsp; '.'</strong></legend>'; ?>
	 		<br><br>Selectionner un élève <small> ( qui a une demande matériel en cours à l'état A ATTRIBUER et dont la demande et du même type que le matériel selectionné ) </small>&nbsp;:</br><br>
			<select id="demandemateriel_id" name="demandemateriel_id" style="width: auto;" onchange="maFonction2('<?php echo $sf_request->getParameter('materiel_id') ?>')"   >
			<option value = "">	</option>
			 <?php foreach ($eleves as $eleve){ ?>
				<option  value ="<?php echo $eleve['demandemateriel_id']; ?>"<?= ( $eleve['demandemateriel_id'] == $sf_request->getParameter('demandematerielsel_id') ? 'selected="selected"' : '' ) ?>>
				<?php echo ''.$eleve['nom'].'&nbsp;'.$eleve['prenom'].'&nbsp;- notifiée du&nbsp'.format_date($eleve['datedebutnotif'],'dd/MM/yyyy').'</strong>&nbsp&nbspau&nbsp&nbsp<strong>'
				.format_date($eleve['datefinnotif'],'dd/MM/yyyy').'&nbsp; - CDA du &nbsp;'.format_date($eleve['datedecisioncda'],'dd/MM/yyyy').'&nbsp; - Type :&nbsp;'.$eleve['typemateriel']?>
			   </option>
		   
			<?php	} ?> 
			</select>
	 

  <?php	 } ?>

<?php  if($sf_request->getParameter('demandemateriel_id') && $sf_request->getParameter('materielsel_id')) { ?>
    <fieldset>
	<?php include_partial('form', array('form' => $form)) ?>
	
	</fieldset>
	<?php include_partial('eleve_materiel/materiel_eleve', array('materielEleve' => $materielEleve)) ?>
	
<?php } ?>


<?php  if($sf_request->getParameter('materiel_id')) { ?>
   
   <fieldset>
	<?php include_partial('form', array('form' => $form)) ?>
	<?php include_partial('eleve_materiel/materiel_eleve', array('materielEleve' => $materielEleve)) ?>
<?php } ?>

<?php echo '</fieldset>'; ?>




</div>


<script>
	
	/* ---- fonction qui envoie les materiel attribué selectionnés pour edition convention */
	
	function maFonction(eleveId) {

    var indexsite = document.getElementById('valDemandeId') ;
    valeursite = indexsite.options[indexsite.selectedIndex].value;
	//var type_materiel = <?php echo($demande_materiel_selectionner[0]['typemateriel_id']); ?>;
    //alert (  valeursite );   
  // document.forms['select_demande_mat'].submit();
    //var var_js=<?php echo($_SERVER['REMOTE_ADDR']); ?>;
//	alert (  var_js ); 
	var url_dest =  location.href+"&demandemateriel_id="+valeursite+"";
	document.location.replace(url_dest);  
	//window.location="http://accueil.in.ac-reunion.fr/ashilep/academie.php/eleve_materiel/new?eleve_id="+eleveId+"&demandemateriel_id="+valeursite+""; 
	}
	
	function maFonction1(eleveId) {
    
	//selection de la demande matériel
	var indexsite = document.getElementById('valDemandeId') ;
    valeursite = indexsite.options[indexsite.selectedIndex].value;
	
	//selection du matériel
    var indexsite1 = document.getElementById('materiel_id') ;
    valeursite1 = indexsite1.options[indexsite1.selectedIndex].value;
	// alert (  valeursite1 );   
	var url_dest =  location.href+"&demandemateriel_id="+valeursite+"&materielsel_id="+valeursite1+""; 
	document.location.replace(url_dest);  
	//window.location="http://accueil.in.ac-reunion.fr/ashilep/academie.php/eleve_materiel/new?eleve_id="+eleveId+"&demandemateriel_id="+valeursite+"&materielsel_id="+valeursite1+""; 
	}
	
	function maFonction2(materiel_id) {
	//selection de l'élève
	
	             	//selection de l'élève
				var indexsite1 = document.getElementById('demandemateriel_id') ;
				valeursite1 = indexsite1.options[indexsite1.selectedIndex].value;
		//		var REMOTE_ADDR = '<?php echo($_SERVER['REMOTE_ADDR']); ?>';
		//		var HTTP_HOST = '<?php echo($_SERVER['HTTP_HOST']); ?>';
				var url_dest =  location.href+"&demandematerielsel_id="+valeursite1+""; 
				document.location.replace(url_dest);  
 		//window.location="http://accueil.in.ac-reunion.fr/ashilep/academie.php/eleve_materiel/new?materiel_id="+materiel_id+"&demandematerielsel_id="+valeursite1+""; 
	}
	
	
</script>


<script>


$j(document).ready(function(){
        $j('.aide').click(function (){
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
        });
});

</script>