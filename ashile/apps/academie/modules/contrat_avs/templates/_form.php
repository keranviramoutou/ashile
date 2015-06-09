<?php //use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>

<?php use_helper('Date') ?>
<?php use_helper('jQuery') ?>

<form action="<?php echo url_for('contrat_avs/'.($form->getObject()->isNew() ? 'create' : 'update').(!$form->getObject()->isNew() ? '?id='.$form->getObject()->getId() : '')) ?>" method="post" <?php $form->isMultipart() and print 'enctype="multipart/form-data" ' ?>>
<?php if (!$form->getObject()->isNew()): ?>
<input type="hidden" name="sf_method" value="put" />
<?php endif; ?>
  <table>
    <tbody>
      <?php echo $form->renderGlobalErrors() ?>
      <tr>
        <th><?php echo $form['etabsco_id']->renderLabel('Etablissement Employeur (*)') ?></th>
        <td>
          <?php echo $form['etabsco_id']->renderError() ?>
          <?php echo $form['etabsco_id'] ?>
        </td>
      </tr>
      <tr>

        <th><?php echo $form['typecontratavs_id']->renderLabel('Type du Contrat (*)') ?></th>
        <td>
          <?php echo $form['typecontratavs_id']->renderError() ?>
          <?php echo $form['typecontratavs_id'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['temps_hebdo']->renderLabel('Temps hebdomadaire à effectuer') ?></th>
        <td>
          <?php echo $form['temps_hebdo']->renderError() ?>
          <?php echo $form['temps_hebdo'].'&nbsp;Heure(s)' ?>
        </td>
      </tr>
      <tr>
	  <th> <?php echo $form['date_fin_contrat']->renderLabel('Contrat du') ?></th>
        <td>
          <?php echo $form['date_debut_contrat']->renderError().'&nbsp;'.$form['date_fin_contrat']->renderError() ?>
          <?php echo $form['date_debut_contrat'].'&nbsp;&nbsp;au&nbsp;&nbsp;'.$form['date_fin_contrat'] ?>
 
        </td>
      </tr>
	  <tr>
    <th><?php echo ''. $form['date_fin_projete']->renderLabel('fin de contrat projetée') ?></th>
	  <td>
		<?php echo $form['date_fin_projete']->renderError() ?>
		<?php echo $form['date_fin_projete'] ?>	
      </td>
	  </tr>
	  <tr>
	  <th><?php echo $form['date_fin_projete']->renderLabel('commentaire') ?></th>
      <td>
		<?php echo $form['commentaire']->renderError() ?>
		<?php echo $form['commentaire'] ?>	
      </td>
	  </tr>
    </tbody>
    <tfoot>
	 <?php if(!$form->isNew()):?> 


	 <?php endif; ?>		
		
		
      <tr>
        <td colspan="3">
          <?php echo $form->renderHiddenFields(false) ?>
           
			<?php if (!$form->getObject()->isNew()): ?>
		        &nbsp;<?php echo '&nbsp;'.link_to('<button>Supprimer</button>', 'contrat_avs/delete?id='.$form->getObject()->getId().'&avs_id='.$form->getObject()->getAvsId(), array('method' => 'delete', 'confirm' => 'Etes vous sur ?')) ?>
						<?php echo link_to('<u><b><button>Position(s)</button></b></u>', 'contrat_avs/listpos?avs_id='.$sf_request->getParameter('avs_id'). '&retour='. 1, 
          array('popup' => array('popupWindow', 'width=600,height=300,left=350,top=60','scrollbars=yes')) )  ?>
			
			<button type="button" onClick="mouvement()" >Nouvel position </button>		
		<?php endif; ?>


		<!-- <input type=button onClick=window.open("<?php echo url_for('position_avs/popup?contratavs_id='.$form->getObject()->getId() ) ?>","Position","location=no,status=no,scrollbars=no,width=400,height=400,left=150,top=200,"); value="Nouvelle position"> -->
	         &nbsp;<input type="submit" value="Enregistrer" onclick="return verif();" />&nbsp;
			 <?php if (!$form->getObject()->isNew()): ?>
			  <button type="button" onclick="location.href='<?php echo url_for('avs/edit?id='.$sf_request->getParameter('avs_id').'&avs_nom='.$sf_request->getParameter('avs_nom').'&avs_prenom='.$sf_request->getParameter('avs_prenom') ) ?>'">Retour</button>
		   <?php endif; ?>
            <?php if ($form->getObject()->isNew()): ?>
   		   <button type="button" onclick="window.close()" >Fermer</button>
		    <?php endif; ?>
        </td>
      </tr>
    </tfoot>    
  </table>
  
  
  

</form>


<script>
  function verif() {
	
    var message ="";
    var flag = 0;
   
   
   	date1 =$j("#contrat_avs_date_debut_contrat").val() ; 
	jour_1 = date1.substring(0,2);
    mois_1 = date1.substring(3,5);
    annee_1 = date1.substring(6,10);
    d_1 = new Date(annee_1, mois_1-1, jour_1);
    
	date2 =$j("#contrat_avs_date_fin_contrat").val() ; 
	jour_2 = date2.substring(0,2);
    mois_2 = date2.substring(3,5);
    annee_2 = date2.substring(6,10);
    d_2 = new Date(annee_2, mois_2-1, jour_2);

       //controle saisie etablissement employeur
	   
	   if ($j("#contrat_avs_etabsco_id").val() == "" || $j("#contrat_avs_etabsco_id").val() == 0) {
     
		message = message + " - Sélectionner un établissement employeur " + " \n" ;
		 flag = 1;
      

      }
	  
	         //controle saisie etablissement employeur
	   
	   if ($j("#contrat_avs_temps_hebdo").val() == "" || $j("#contrat_avs_temps_hebdo").val() == 0) {
     
		message = message + " - Saisir le temps hebdomadaire de service " + " \n" ;
		 flag = 1;
      

      }
	  
	  
      //contrôle des dates saisies
  	   if ($j("#contrat_avs_date_debut_contrat").val() == "" || $j("#contrat_avs_date_fin_contrat").val() == "" ) {
        // alert ("Saisir une date de début et une date de fin de prise en charge ");
		 message = message + " - Saisir une date de début et une date de fin de prise en charge " + " \n";
		 	 flag = 1;
         // return false;
      }else{
	  
		   if( d_2 < d_1  ){  //date de début supérieure à la date de fin de scolarité
			   
			 
				message = message + " - la date de début de scolarité " + date1 + " inférieure à la date de fin de scolarité " + date2  + " \n";
				 flag = 1;

			}	

	  }

    if(flag == 1){
	  alert(message);
	  return false;
	}else{
    
     
        return true;
	}
    }
</script>

<script>
function mouvement() {
//ouverture d'une popup
//---------------------
 var url = " <?php echo url_for('position_avs/popup?contratavs_id='.$form->getObject()->getId() ) ?>";
 var width  = 400;
 var height = 400;
 var left   = (screen.width  - width)/2;
 var top    = (screen.height - height)/2;
 var params = 'width='+width+', height='+height;
 params += ', top='+top+', left='+left;
 params += ', directories=no';
 params += ', location=no';
 params += ', menubar=no';
 params += ', resizable=no';
 params += ', scrollbars=no';
 params += ', status=no';
 params += ', toolbar=no';
 newwin=window.open(url,'windowname5', params);
 if (window.focus) {newwin.focus()}
 return false;
}
// -->

</script>