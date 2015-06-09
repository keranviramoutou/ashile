<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>
<?php use_helper('Text') ?>
<?php use_helper('jQuery') ?>
<?php use_helper('Date') ?>

<?php
echo jq_form_remote_tag(array(
    'update' => 'acc_orientation',
    'url' => 'demandeorientation/' . ($form->getObject()->isNew() ? 'create' : 'update') . (!$form->getObject()->isNew() ? '?id=' . $form->getObject()->getId().'&mdph_id='.$form->getObject()->getMdphId() : '')))
?>  
<?php if (!$form->getObject()->isNew()): ?>
    <input type="hidden" name="sf_method" value="put" />
<?php endif; ?>
<table>
    <tfoot>
        <tr>
            <td colspan="2" align="center">
                <?php echo $form->renderHiddenFields(false) ?>
                &nbsp;
  
                <?php if (!$form->getObject()->isNew()): ?>
                    &nbsp;<?php echo jq_button_to_remote('Supprimer', array('url' => 'demandeorientation/delete?id=' . $form->getObject()->getId() . '&mdph_id=' . $form->getObject()->getMdphId() , 'update' => 'acc_orientation', 'confirm' => 'Vous êtes sur ?')) ?>
              
                <input type="submit" value="Enregistrer" onclick="return verif();" />
				<?php
				
                echo jq_button_to_remote('Retour', array(
                    'url' => 'demandeorientation/index?mdph_id=' .  $form->getObject()->getMdphId(),
                    'update' => 'acc_orientation',
                ))
                ?>
				  <?php endif; ?>
				<?php if ($form->getObject()->isNew()): ?>
				 <input type="submit" value="Enregistrer" onclick="return verif();" />
				<?php
                echo jq_button_to_remote('Retour', array(
                    'url' => 'demandeorientation/index?mdph_id='
					,
                    'update' => 'acc_orientation',
                ))
                ?>
			   <?php endif; ?>
            </td>
        </tr>
    </tfoot>
    <tbody>
        <?php echo $form->renderGlobalErrors() ?>
        <?php if ($form->getObject()->isNew()){ ?>
        <tr>		
           <th> <?php echo $form['classeext_id']->renderLabel('Orientation') ?> </th>
            <td>
            <?php echo $form['classeext_id']->renderError() ?>
            <?php echo $form['classeext_id'] ?>
            </td>
                       
           <th> <?php echo $form['demijournee_id']->renderLabel('Nombre de demi-journées') ?></th>
            <td>
                <?php echo $form['demijournee_id']->renderError() ?>
                <?php echo $form['demijournee_id'] ?>
            </td>
		
        </tr>
		  <?php  }else{ ?>
            
               <tr>
					
				<th><?php echo $form['classeext_id']->renderLabel('Orientation (*) :') ?></th>
					<td><?php echo $form['classeext_id']->renderError(); ?>
						<?php echo $form['classeext_id']; ?>

					</td>
				</tr>
				<tr>
				<th> <?php echo $form['demijournee_id']->renderLabel('Nombre de demi-journées (*) :') ?></th>
				<td>
					<?php echo $form['demijournee_id']->renderError() ?>
					<?php echo $form['demijournee_id'] ?>
				</td>
				</tr>
				<tr>
							
				<th><?php echo $form['decisioncda']->renderLabel('Décision CDA (non cochée = Refusée) :') ?></th>
					<td>
						<?php echo $form['decisioncda']->renderError() ?>
						<?php echo $form['decisioncda'] ?>
					</td>
				
				<th><?php echo $form['datedecisioncda']->renderLabel('date Décision CDA :') ?></th>
					<td>
						<?php echo $form['datedecisioncda']->renderError() ?>
						<?php echo $form['datedecisioncda'] ?>
					</td>
				</tr>
				<tr>				
				<th><?php echo $form['datedebutnotif']->renderLabel('Notifiée du ') ?></th>
					<td>
						<?php echo $form['datedebutnotif']->renderError() ?>
						<?php echo $form['datedebutnotif'] ?>
					</td>
					
			   <th><?php echo $form['datefinnotif']->renderLabel('Au') ?></th>
					<td>
						<?php echo $form['datefinnotif']->renderError() ?>
						<?php echo $form['datefinnotif'] ?>
					</td>
				</tr>	
				<?php } ?>
		
    </tbody>
</table>
</form>


<script>
  function verif() {
	
    var message ="";
    var flag = 0;
	var d_1="";
    var d_2="";
	var d_3="";

 

	 if ($j("#demande_orientation_classeext_id").val() == ""  || $j("#demande_orientation_classeext_id").val() == 0) {
       // alert ("selectionner une établissement  :");
		message = message + " - Sélectionner le type d'orientation  !" + d_2+" \n" ;
    	 flag = 1;
   
	   }else{
		if ($j("#demande_orientation_datefinnotif").val()){
			date2 =$j("#demande_orientation_datefinnotif").val() ; 
			jour_2 = date2.substring(0,2);
			mois_2 = date2.substring(3,5);
			annee_2 = date2.substring(6,10);
			d_2 = new Date(annee_2, mois_2-1, jour_2); 
		}	

		if ($j("#demande_orientation_datedecisioncda").val()){
			date3 =$j("#demande_orientation_datedecisioncda").val() ; 
			jour_3 = date3.substring(0,2);
			mois_3 = date3.substring(3,5);
			annee_3 = date3.substring(6,10);
			d_3 = new Date(annee_3, mois_3-1, jour_3); 
		}
		
		
		if ($j("#demande_orientation_datedebutnotif").val()){
			date1 =$j("#demande_orientation_datedebutnotif").val() ; 
			jour_1 = date1.substring(0,2);
			mois_1 = date1.substring(3,5);
			annee_1 = date1.substring(6,10);
			d_1 = new Date(annee_1, mois_1-1, jour_1);
        }	
		
	   	
	  		if(  d_2 <  d_1  ){  //date de début de notification supérieure à la date de fin de notification
			 flag = 1 ;
			message =  message + " - la date de début de notification " + date1 + " doit être inférieure à la date de fin de notification "+ date2+" \n";
			}
			
				
				
	//		if( d_3 > d_1 && $j("#demande_orientation_decisioncda").is(":checked") == true ){  //date de CDA supérieuere à la date de début de notification et décision CDA à OK
				   //alert("tititi");
				  //  return false;
	//			 flag = 1 ;
	//			 message = message + " - la date de la CDA  " + date3 + " doit être inférieure à la date de début de notification "+ date1 +" \n";

	//		}
			
		   // Décision de la CDA acceptée controle saisie de la date de CDA
		  //--------------------------------------------------------------

			 if ( $j("#demande_orientation_decisioncda").is(":checked") == true && (!$j("#demande_orientation_datedecisioncda").val() || !$j("#demande_orientation_datedebutnotif").val() || !$j("#demande_orientation_datefinnotif").val())  ) {
			var message = message + "- Décision de la CDA acceptée , saisir les dates de Décision et de notification   !!" + " \n";
			// $j("#demande_orientation_datefinnotif").attr('disabled', 'disabled');
			 flag = 1;
			} ;  
	 
	 	 
		//Décision refusée	 contrôle dates de notifications
		//--------------------------------------------------
		 if ( $j("#demande_orientation_decisioncda").is(":checked") == false && ($j("#demande_orientation_datefinnotif").val() || $j("#demande_orientation_datedebutnotif").val()) ) {
			var message = message + "- Décision de la CDA refusée , impossible de saisir des dates de notification !!"+ " \n";
			// $j("#demande_orientation_datefinnotif").attr('disabled', 'disabled');
			 flag = 1;
		 } ;  
	   

      }
	  

	  
	  

	 
    if(flag == 1){
	  alert(message);
	  return false;
	}else{
      document.body.style.cursor='wait';
       return true;
	}
    }
</script>

