<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>
<?php use_helper('jQuery') ?>
<?php use_helper('Date')  ?>


<?php $mdph = Doctrine::getTable('Mdph')->find($form->getObject()->getMdph());
      $orientation = Doctrine::getTable('Orientation')->findOneByEleveId($mdph->getEleveId());

  echo '<fieldset><legend><h3>Synthèse </h3></legend>';
         echo '<p><i> vous traitez l\'éleve :<strong> '.$mdph->getEleve().'</strong><br>Etablissement frequenté&nbsp:&nbsp <strong> ';
			
			// -- condition si l'objet orientation existe -----
			if($orientation){
				echo $orientation->Etabsco->Typeetablissement->nomtypeetablissement.'&nbsp;'.$orientation->Etabsco->nometabsco.'</strong>&nbsp&nbsp Niveau scolaire :&nbsp<strong>'.$orientation->Niveauscolaire->nomniveauscolaire.'</strong>&nbsp&nbspClasse :&nbsp&nbsp<strong>'.$orientation->Classe->TypeClasse->nomtypeclasse.'</strong></i></p>';
			}
				
  echo '<p><i> Dossier MDPH n °&nbsp  <strong>' .$mdph->id.'</strong>&nbsp Date ESS  :&nbsp'.format_date($mdph->dateess,'dd/MM/yyyy').'&nbsp Date envoi dossier : ' .format_date($mdph->dateenvoiedossier,'dd/MM/yyyy').'</i></p></fieldset>';
?>



<fieldset>
<form action="<?php echo url_for('demandeavs/'.($form->getObject()->isNew() ? 'create' : 'update').(!$form->getObject()->isNew() ? '?id='.$form->getObject()->getId().'&mdph_id='.$form->getObject()->getMdphId() : '' )) ?>" method="post" <?php $form->isMultipart() and print 'enctype="multipart/form-data" ' ?>>
<?php if (!$form->getObject()->isNew()): ?>
<input type="hidden" name="sf_method" value="put" />
<?php endif; ?>
  <table>
    <tbody>
	<?php echo $form->renderGlobalErrors() ?>

		<th><?php echo $form['mdph_id']->renderLabel(' ') ?></th>
        <td>
          <?php echo $form['mdph_id']->renderError() ?>
          <?php echo $form['mdph_id'] ?>
        </td>
		<tr>
		<th><?php echo $form['date_demande_avs']->renderLabel('Demande saisie le : ') ?></th>
        <td>
          <?php echo $form['date_demande_avs']->renderError() ?>
          <?php echo $form['date_demande_avs']  ?>
        </td>
		</tr>
        <tr>
		 <th><?php echo $form['naturecontratavs_id']->renderLabel('Type d\'accompagnement demandé * ') ?></th>
        <td>
          <?php echo $form['naturecontratavs_id']->renderError() ?>
          <?php echo $form['naturecontratavs_id'] ?>
        </td>
       </tr>
       <tr>
        <th><?php echo $form['quotitehorrairenotifie']->renderLabel('Quotité Horaire Notifiée :') ?></th>
        <td>
          <?php echo $form['quotitehorrairenotifie']->renderError() ?>
          <?php echo $form['quotitehorrairenotifie'] ?>
        </td>
       </tr>
        <tr>
        <th><?php echo $form['datedebutnotif']->renderLabel('Décison CDA notifié du :') ?></th>
        <td>
          <?php echo $form['datedebutnotif']->renderError().'&nbsp'.$form['datefinnotif']->renderError() ?>
          <?php echo $form['datedebutnotif'] .'&nbsp au &nbsp'.$form['datefinnotif']?>
        </td>
       </tr>
      <tr>
        <th><?php echo $form['decisioncda']->renderLabel('Décision de la CDA (cocher ACCEPTEE/ décocher REFUSEE)').'&nbsp&nbsp' ?></th>
        <td>
          <?php echo $form['decisioncda']->renderError(). '&nbsp'. $form['datedecisioncda']->renderError()  ?>
          <?php echo $form['decisioncda'].'&nbsp&nbsp le &nbsp'.$form['datedecisioncda'] ?>
      </tr>
	 
	  <tr>
        <th><?php echo $form['conditionsuspensive_id']->renderLabel('Condition suspensive :').'&nbsp&nbsp' ?></th>
        <td>
          <?php echo $form['conditionsuspensive_id']->renderError()  ?>
          <?php echo $form['conditionsuspensive_id']?>
      </tr>
      <tr>
        <th><?php echo $form['notes']->renderLabel('Commentaires') ?></th>
        <td>
          <?php echo $form['notes']->renderError() ?>
          <?php echo $form['notes'] ?>
        </td>
      </tr>
	  
    </tbody>
    <tfoot>
      <tr>
        <td colspan="2">
		    <!-- Gestion du bouton retour en fonction de l'endroit d'ou l'on vient -->
       		<?php if($sf_request->getParameter('retour') == 2) {	?>	<!-- la form appelé depuis la liste des demande en attent de CDA -->				
		   &nbsp;<button type="button" onclick="location.href='<?php echo url_for('demandeavs/index') ?>'">Retour</button>
		    <?php } else { ?> <!-- la form appelé depuis la recherche élève-->
			&nbsp;<button type="button" onclick="location.href='<?php echo url_for('eleve/recherche?eleve_id='.$sf_request->getParameter('eleve_id').'&eleve_nom='.$sf_request->getParameter('eleve_nom').'&eleve_prenom=' . $sf_request->getParameter('eleve_prenom').'&flag_recherche=1' ) ?>'">Retour</button>
            <?php } ?>        
		<?php if (!$form->getObject()->isNew()): ?>
		  <?php echo link_to('<button>Supprimer</button>', 'demandeavs/delete?id='.$form->getObject()->getId().'&eleve_nom='.$sf_request->getParameter('eleve_nom').'&eleve_prenom=' . $sf_request->getParameter('eleve_prenom').'&flag_recherche=1', array('method' => 'delete', 'confirm' => 'êtes vous sur?')) ?>	
          <?php endif; ?>
          <input type="submit" value="Enregistrer" onclick="return verif();" />
        </td>
      </tr>
    </tfoot>    
  </table>
</form>
* : Quotité horaire notifiée obligatoire si décision de la CDA acceptée ; pour un type d'acccompagenement "AVS-M" mettre la quotité horaire à zéro.
</fieldset>

<script>
  function verif() {
	
    var message ="";
    var flag = 0;
	var d_1="";
    var d_2="";
	var d_3="";

 
 
	 if (($j("#demande_avs_quotitehorrairenotifie").val() == ""  ) && $j("#demande_avs_decisioncda").is(":checked") == true) {
    
		message = message + " - Saisie une quotité horaire  !" +" \n" ;
		 flag = 1;
   
	   }

	 if ($j("#demande_avs_naturecontratavs_id").val() == ""  || $j("#demande_avs_naturecontratavs_id").val() == 0) {
       
		message = message + " - Sélectionner le type d'accompagnement  !" + " \n" ;
     	 flag = 1;
   
	   }
		if ($j("#demande_avs_datefinnotif").val()){
			date2 =$j("#demande_avs_datefinnotif").val() ; 
			jour_2 = date2.substring(0,2);
			mois_2 = date2.substring(3,5);
			annee_2 = date2.substring(6,10);
			d_2 = new Date(annee_2, mois_2-1, jour_2); 
		}	

		if ($j("#demande_avs_datedecisioncda").val()){
			date3 =$j("#demande_avs_datedecisioncda").val() ; 
			jour_3 = date3.substring(0,2);
			mois_3 = date3.substring(3,5);
			annee_3 = date3.substring(6,10);
			d_3 = new Date(annee_3, mois_3-1, jour_3); 
		}
		
		
		if ($j("#demande_avs_datedebutnotif").val()){
			date1 =$j("#demande_avs_datedebutnotif").val() ; 
			jour_1 = date1.substring(0,2);
			mois_1 = date1.substring(3,5);
			annee_1 = date1.substring(6,10);
			d_1 = new Date(annee_1, mois_1-1, jour_1);
        }	
		
	   	
	  		if(  d_2 <  d_1  ){  //date de début de notification supérieure à la date de fin de notification
			 flag = 1 ;
			message =  message + " - la date de début de notification " + date1 + " doit être inférieure à la date de fin de notification "+ date2+" \n";
			}
			
				
				
		//	if( d_3 > d_1 && $j("#demande_avs_decisioncda").is(":checked") == true ){  //date de CDA supérieur à la date de début de notification et décision CDA à OK
				   //alert("tititi");
				  //  return false;
		//		 flag = 1 ;
		//		 message = message + " - la date de la CDA  " + date3 + " doit être inférieure à la date de début de notification "+ date1 +" \n";

		//	}
			
		   // Décision de la CDA acceptée controle saisie de la date de CDA
		  //--------------------------------------------------------------

			 if ( $j("#demande_avs_decisioncda").is(":checked") == true && !$j("#demande_avs_datedecisioncda").val()  ) {
			var message = message + "Décision de la CDA acceptée , saisir la date de Décision  !!"
			// $j("#demande_avs_datefinnotif").attr('disabled', 'disabled');
			 flag = 1;
			} ;  
	 
	 	 
		//Décision refusée	 contrôle dates de notifications
		//--------------------------------------------------
		 if ( $j("#demande_avs_decisioncda").is(":checked") == false && ($j("#demande_avs_datefinnotif").val() || $j("#demande_avs_datedebutnotif").val()) ) {
			var message = message + "Décision de la CDA refusée , impossible de saisir des dates de notification !!"
			// $j("#demande_avs_datefinnotif").attr('disabled', 'disabled');
			 flag = 1;
		 } ;  
	   


	  


	 
    if(flag == 1){
	  alert(message);
	  return false;
	}else{
      document.body.style.cursor='wait';
       return true;
	}
    }
</script>
