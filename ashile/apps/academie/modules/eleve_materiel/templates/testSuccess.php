<?php use_helper('Date') ?>

<h3>Gestion Matériel > Attribution d'un matériel</h3>
<br>
<div id="materiel_eleve">
<div class='aide' onClick="<?php echo url_for('eleve_materiel/aide') ?>"> </div> 
<?php
   if($existeleve)
   {
    echo '<fieldset><legend> vous traitez l\'éleve :<strong> '.$eleve.'&nbsp&nbsp né(e) le :&nbsp;'.format_date($eleve->datenaissance,'dd/MM/yyyy').'</strong></legend>';
    ?>
	
	
	<?php if ($sf_request->getParameter('eleve_id')) { ?>

       <?php if($count_dem_mat > 0){ ?>

		<?php foreach ($demande_materiel_selectionner as $demande_materiels){ ?>

			<?php echo '-Demande de matériel de Type :&nbsp; <strong>'.$demande_materiels['typemateriel'].'</strong>&nbsp; catégorie matériel :&nbsp;<strong>'.$demande_materiels['dd'].'</strong>&nbsp;&nbsp;- Notifiée du &nbsp:&nbsp<strong>'.format_date($demande_materiels['datedebutnotif'],'dd/MM/yyyy').'</strong>&nbsp&nbspau&nbsp&nbsp<strong>'.format_date($demande_materiels['datefinnotif'],'dd/MM/yyyy')
		 .'</strong>&nbsp-&nbspDécision de la CDA du :&nbsp<strong>'.format_date($demande_materiels['datedecisioncda'],'dd/MM/yyyy').'</strong><p>'.$demande_materiels['notes'];
		  ?>

 		<?php	} // fin foreach?> 

        <?php	} // test existence demande matériel à attribuer?> 
        </fieldset>
		 <fieldset>
		<?php if( $count_dem_mat > 0 && $sf_request->getParameter('demande_materiel_id')) { ?>
			<br><br>Selectionner le matériel en stock correspondant à la demande du type &nbsp;&nbsp;:<?php echo '<strong>&nbsp;'.$demande_materiel_selectionner[0]['typemateriel'].'</strong>' ?></br><br>
			<select id="materiel_id" name="materiel_id" style="width: auto;" onchange="maFonction1('<?php echo $sf_request->getParameter('eleve_id') ?>')"   >
			<option value = "">	</option>
			 <?php foreach ($mat_en_stock as $mat_en_stocks){ ?>
				<option  value ="<?php echo $mat_en_stocks['materiel_id']; ?>"<?php echo ( $mat_en_stocks['materiel_id'] == $sf_request->getParameter('materielsel_id') ? 'selected="selected"' : '' ) ?>>
				<?php echo '- n°&nbsp;'. $mat_en_stocks['numeroMateriel'].'- marque :&nbsp'.$mat_en_stocks['marque'].'- référence :&nbsp;'.$mat_en_stocks['libelleMateriel']?>
			</option>
		   
			<?php	} ?> 
			</select>
			 <?php echo '</strong><p>'; ?>
		<?php  } ?>
	<?php  }else{ //test existence eleve_id ?> 
	
	 <?php echo '<div class="flash_error">Pas de demande de matériel dossier MDPH en cours à la date du&nbsp '.format_date(time(),'dd/MM/yyyy').'</div>';

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





<form action="<?php echo url_for('eleve_materiel/'.($form->getObject()->isNew() ? 'create' : 'update').(!$form->getObject()->isNew() ? '?id='.$form->getObject()->getId().'&eleve_id='.$form->getObject()->getEleveId().'&materiel_id='.$form->getObject()->getMaterielId() : '?eleve_id='.$form->getObject()->getEleveId())) ?>" method="post" <?php $form->isMultipart() and print 'enctype="multipart/form-data" ' ?>>
<?php if (!$form->getObject()->isNew()): ?>
<input type="hidden" name="sf_method" value="put" />
<?php endif; ?>
  <table>
    <tfoot>
		
      <tr>
        <td colspan="2">


							
			<input type="submit" value="Enregistrer" />
			  <?php if (!$form->getObject()->isNew()): ?>
				&nbsp;<?php echo button_to('Supprimer', 'eleve_materiel/delete?id='.$form->getObject()->getId(), array('method' => 'delete', 'confirm' => 'etes vous sur ?')) ?>

			  <?php endif; ?>
		    <!-- Envoi mail à l'ERF -->
			 
			         <?php if($form['datefin']->getValue()){ ?>
						<?php $datefin = $form['datefin']->getValue() ?>
					  <?php }else{ ?>
						<?php $datefin = '01-01-1900' ?>
					  <?php } ?>
					  <?php if($form['datedebut']->getValue()){ ?>
						<?php $datedebut = $form['datedebut']->getValue() ?>
					  <?php }else{ ?>
						<?php $datedebut = '01-01-1900' ?>
					  <?php } ?>
					<?php echo button_to('Envoi mail à l\'ERF', 'mail/envoimail?user_id='.$sf_user->getGuardUser()->getId().'&modules=eleve_materiel'.'&datedebut='.
					$datedebut .'&datefin='.$datefin.'&eleve_id='.$form->getObject()->getEleveId().'&materiel_id='.$form->getObject()->getMaterielId(), array('popup' => array('popupWindow', 'width=310,height=400,left=320,top=0','scrollbars=yes')) )  ?>
			 
			  &nbsp;<button type="button" onclick="location.href='<?php echo url_for('eleve/recherche?eleve_id='.$sf_request->getParameter('eleve_id').'&eleve_nom='.$sf_request->getParameter('eleve_nom').'&eleve_prenom=' . $sf_request->getParameter('eleve_prenom').'&flag_recherche=1'  ) ?>'">Retour</button>
			  
			 <!-- Button tag -->

			<!---------------------------------------------------------------------------------------------->

        </td>
      </tr>
    </tfoot>
    <tbody>
      <?php //echo $form ?>
      <?php echo $form->renderGlobalErrors() ?>
	<?php  echo $form->renderHiddenFields() ?>      


			
			 <?php if(!$form->getObject()->isNew()): ?>
			<td>
				<?php echo $form['datedebut']->renderError().'&nbsp'.$form['datefin']->renderError() ?>
				<?php echo 'Prêt (*) &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp&nbsp;&nbsp;&nbsp;&nbsp&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;du&nbsp;&nbsp;'.$form['datedebut'].'&nbsp;&nbsp;au&nbsp;&nbsp;'.$form['datefin']  ?>

			</td>
           <?php endif; ?>
		   <?php if($form->getObject()->isNew()): ?>
		     <td>
			   
  		<?php if( $count_dem_mat > 0 && $sf_request->getParameter('demande_materiel_id')) { ?>
			<br><br>Selectionner le matériel en stock correspondant à la demande du type &nbsp;&nbsp;:<?php echo '<strong>&nbsp;'.$demande_materiel_selectionner[0]['typemateriel'].'</strong>' ?></br><br>
			<select id="materiel_sel_id" name="materiel_sel_id" style="width: auto;" onchange="maFonction1('<?php echo $sf_request->getParameter('eleve_id') ?>')"   >
			<option value = "">	</option>
			 <?php foreach ($mat_en_stock as $mat_en_stocks){ ?>
				<option  value ="<?php echo $mat_en_stocks['materiel_id']; ?>"<?php echo ( $mat_en_stocks['materiel_id'] == $sf_request->getParameter('materielsel_id') ? 'selected="selected"' : '' ) ?>>
				<?php echo '- n°&nbsp;'. $mat_en_stocks['numeroMateriel'].'- marque :&nbsp'.$mat_en_stocks['marque'].'- référence :&nbsp;'.$mat_en_stocks['libelleMateriel']?>
			</option>
		   
			<?php	} ?> 
			</select>
			 <?php echo '</strong><p>'; ?>
		<?php  } ?>
		    
		  <?php echo 'jjjjj&nbsp;'.$form['eleve_id'] ?>
		  <?php echo 'jjjjj&nbsp;'.$form['materiel_id'] ?>
		    </td>
		   	<td>
				<?php echo $form['datedebut']->renderError() ?>
				<?php echo '- Prêt du&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$form['datedebut']  ?>
			</td>
			</tr>
		
		   <?php endif; ?>
		   
		   	<tr>
			<td>
				<?php echo $form['dateconvention']->renderError().$form['numero_convention']->renderError() ?>
				<?php echo '- Convention éditée le &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$form['dateconvention'].'&nbsp;&nbsp; - N° de la convention&nbsp;&nbsp;'.$form['numero_convention'] ?>
            <!-- affichage du lien pour visualiser la convention -->			
			<?php if($form->getObject()->getCheminConv()): ?>	
			&nbsp;&nbsp;<a onclick="window.open(this.href,'popupWindow','width=310,height=400,left=320,top=0');return false;" href="<?php echo $form->getObject()->getCheminConv(); ?>">Convention</a>
	         <?php endif; ?>
			</td>
			
			</tr>
	
			<tr>
			<td>
				<?php echo $form['dateremiseerf']->renderError()  ?>
				<?php echo '- Date de remise du matériel à l\'ERF &nbsp;'.$form['dateremiseerf']  ?>
			</td>
			
			</tr>
			
			<tr>
			<td>
				<?php echo $form['autorisationparent']->renderError() .$form['_csrf_token']->renderError()  ?>
				<?php echo '- Date d\'autorisation parentale &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$form['autorisationparent'].$form['_csrf_token']   ?>
			</td>
			
			</tr>
		
 



    </tbody>
  </table>
</form>


        <?php echo '<small><br>* la date de début de prêt est égale à la date de signature de la convention par les parents </small></br>' ?>
		<?php echo '<small><br> cette date correspond également à la date de remise aux parents du matériel </small></br>' ?>
		<?php echo '<small><br> cette date correspond  à la date d\'autorisation donnée par les parents pour enlever la protection parentale pour l\'accès Internet </small></br>' ?>   
		
	

 
<script>
// -------------------------------------------------------------------------------------------------
function winPopApplication(url, width, height, isScrollable) {
	if (width == null) width = '800';
	if (height == null) height = '450';
	popupwinApplication = window.open (url, '',	  'toolbar=no'
												+ ',width='+width
												+ ',height='+height
												+ ',directories=no'
												+ ',status=no'
												+ ',scrollbars='+(isScrollable?'yes':'no')
												+ ',menubar=yes'
										);
	if (popupwinApplication && popupwinApplication.focus) popupwinApplication.focus();
	return false;
}

</script>

	
	


	
	


<?php echo '</fieldset>'; ?>



<div>

</div>

</div>


<script>
	

	
	function maFonction1(eleveId) {

	
	//selection du matériel
    var indexsite1 = document.getElementById('materiel_sel_id') ;
    valeursite1 = indexsite1.options[indexsite1.selectedIndex].value;

	$j("#eleve_materiel_materiel_id").val() = valeursite1;
	alert ( 'ttt' );   

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