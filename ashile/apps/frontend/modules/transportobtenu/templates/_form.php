<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>
<?php use_helper('jQuery') ?>
<?php use_helper('Date') ?>




	<?php
	echo jq_form_remote_tag(array(
		'update' => 'div_transport',
		'url' => 'transportobtenu/' . ($form->getObject()->isNew() ? 'create' : 'update') . (!$form->getObject()->isNew() ? '?id=' . $form->getObject()->getId() . '&eleve_id=' . $form->getObject()->getEleveId() : '')))
	?>
	<?php if (!$form->getObject()->isNew()): ?>
		<input type="hidden" name="sf_method" value="put" />
	<?php endif; ?>
	<?php echo $form->renderHiddenFields(false) ?>
  <table>
    <tfoot>
      <tr>
        <td colspan="2">
       				<br />&nbsp;
          <?php if (!$form->getObject()->isNew()): ?>
		 			&nbsp;<?php echo jq_button_to_remote('Supprimer', array('url' => 'transportobtenu/delete?id='.$form->getObject()->getId().'&eleve_id='.$form->getObject()->getEleveId(), 'update' => 'div_transport', 'confirm' => 'Vous êtes sur?')) ?>
			
            
          <?php endif; ?>
          <input type="submit" value="Enregistrer" onclick="return verif();"/>
		  <?php
					echo jq_button_to_remote('Revenir à la liste', array(
						'url' => 'transportobtenu/index?id=' . $form->getObject()->getId() . '&eleve_id=' . $form->getObject()->getEleveId(),
						'update' => 'div_transport',
					))
					?>
        </td>
      </tr>
    </tfoot>
		<tbody>
		  <?php echo $form->renderGlobalErrors() ?>
		  <tr>
					<th><?php echo $form['transport_id']->renderLabel('Nature du transport (*)') ?></th>
					<td>
					  <?php echo $form['transport_id']->renderError() ?>
					  <?php echo $form['transport_id'] ?>
					</td>
				  </tr>
				  <tr>
					<th><?php echo $form['datedebut']->renderLabel('Début de prise en charge') ?></th>
					<td>
					  <?php echo $form['datedebut']->renderError() ?>
					  <?php echo $form['datedebut'] ?>
					</td>
				  </tr>
				  <tr>
					<th><?php echo $form['datefin']->renderLabel('Fin de prise en charge') ?></th>
					<td>
					  <?php echo $form['datefin']->renderError() ?>
					  <?php echo $form['datefin'] ?>
					</td>
				  </tr>
				  
				
					<!-- POUR PALIER AUX ERREURS CSRF_TOKEN ------------------>
					<!-------------------------------------------------------->
					<td>
					  <?php echo $form['_csrf_token']->renderError() ?>
					  <?php echo $form['_csrf_token'] ?>
					</td>
					<!------------------------------------------------------->
					<!------------------------------------------------------->
					
		</tr>
		</tbody>
  </table>
</form>
<script>
  function verif() {
	
    var message ="";
    var flag = 0;
   
   
   	date1 =$j("#transportobtenu_datedebut").val() ; 
	jour_1 = date1.substring(0,2);
    mois_1 = date1.substring(3,5);
    annee_1 = date1.substring(6,10);
    d_1 = new Date(annee_1, mois_1-1, jour_1);
    
	date2 =$j("#transportobtenu_datefin").val() ; 
	jour_2 = date2.substring(0,2);
    mois_2 = date2.substring(3,5);
    annee_2 = date2.substring(6,10);
    d_2 = new Date(annee_2, mois_2-1, jour_2);
	
	

	  
	  
  	   if ($j("#transportobtenu_datedebut").val() == "" || $j("#transportobtenu_datefin").val() == "" ) {
        // alert ("Saisir une date de début et une date de fin de prise en charge ");
		 message = message + " - Saisir une date de début et une date de fin de prise en charge " + " \n";
		 	 flag = 1;
         // return false;
      }else{
	  
		   if( d_2 < d_1  ){  //date de début supérieure à la date de fin de scolarité
			   
			 
				message = message + " - la date de début de prise en charge " + date1 + " supérieure à la date de fin de prise en charge " + date2  + " \n";
				 flag = 1;
				 $j("#transportobtenu_datedebut").focus();

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
