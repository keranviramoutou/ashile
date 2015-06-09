<?php //use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>
<?php use_helper('jQuery') ?>
<?php use_helper('Date') ?> 




<form action="<?php echo url_for('demandemateriel/'.($form->getObject()->isNew() ? 'create' : 'update').(!$form->getObject()->isNew() ? '?id='.$form->getObject()->getId() : '')) ?>" method="post" <?php $form->isMultipart() and print 'enctype="multipart/form-data" ' ?>>
<?php if (!$form->getObject()->isNew()): ?>
<input type="hidden" name="sf_method" value="put" />
<?php endif; ?>
<table>
    <tfoot>
        <tr>
            <td colspan="2" >

              <?php echo $form->renderHiddenFields(False) ?>
		          <?php if (!$form->getObject()->isNew()): ?>
				  		  <?php echo link_to('<button>Supprimer</button>', 'demandemateriel/delete?id='.$form->getObject()->getId().'&eleve_nom='.$sf_request->getParameter('eleve_nom').'&eleve_prenom=' . $sf_request->getParameter('eleve_prenom').'&flag_recherche=1', array('method' => 'delete', 'confirm' => 'êtes vous sur?')) ?>	

				                  <?php endif; ?>
				<?php if ($form->getObject()->getTraitement()  != 'RDD'  ){ ?> <!-- si la demande est pas à l'état RDD -->				  
                <input type="submit" value="Enregistrer" onclick="return verif()"  />
				<?php }else{ ?>
			    <input type="submit" value="Traiter et Enregistrer" onclick="return verif();" /> 
			    <?php } ?>
				
				
				 <?php if ($form->getObject()->getTraitement()  != 'RDD'  ): ?> <!-- si la demande est pas à l'état RDD -->
				<input type="submit" value="Dupliquer" name ="prolongation"/>
				  <?php //gestion du bouton retour ?>
				  <?php endif; ?>
				&nbsp;
			      <?php if ($form->getObject()->getTraitement()  != 'RDD'  ): ?> <!-- si la demande est pas à l'état RDD -->
					&nbsp;<?php echo button_to('Typer la suivante*', 'demandemateriel/suivante?precedente=' .$form->getObject()->getId().'&retour='. 1  )."&nbsp;" ?>
					 <?php if ($form->getObject()->getTraitement()  == 'A ATTRIBUER'  ): ?> <!-- si la demande est  à l'état A ATTRIBUER -->
					     <?php echo button_to('Créer affectation', 'eleve_materiel/new?eleve_id='.$sf_request->getParameter('eleve_id').'&demande_materiel_id='.$sf_request->getParameter('id').'&typemateriel_id='.$form['typemateriel_id']->getvalue()); ?>
					     <?php echo button_to(' test', 'eleve_materiel/test?eleve_id='.$sf_request->getParameter('eleve_id').'&demande_materiel_id='.$sf_request->getParameter('id').'&typemateriel_id='.$form['typemateriel_id']->getvalue()); ?>
                     <?php endif; ?>				
				<?php endif; ?>
				  <?php if($sf_request->getParameter('retour') == 2) {	?>	<!-- la form appelé depuis la liste des demande en attent de CDA -->				
						&nbsp;<button type="button" onclick="location.href='<?php echo url_for('demandemateriel/index') ?>'">Retour</button>
				  <?php } else { ?> <!-- la form appelé depuis la recherche élève-->
						<button type="button" onclick="location.href='<?php echo url_for('eleve/recherche?eleve_id='.$sf_request->getParameter('eleve_id').'&eleve_nom='.$sf_request->getParameter('eleve_nom').'&eleve_prenom=' . $sf_request->getParameter('eleve_prenom').'&flag_recherche=1' ) ?>'">Retour</button>
				  <?php } ?>   
		  </td>
        </tr>
    </tfoot>
    <tbody>
        <?php //echo $eleve; ?>
		        <tr>
            <th><?php echo $form['date_demande_materiel']->renderLabel('Demande saisie le : ') ?></th>
            <td>
                <?php echo  format_date($form['date_demande_materiel']->getvalue(),'dd/MM/yyyy')?>
            </td>
            <td>
               <?php echo $form['date_demande_materiel']->renderError() ?>
            </td>
        </tr>
		     <tr>
            <th><?php echo $form['materiel_id']->renderLabel('Matériel_id'); ?></th>
            <td>
                <?php echo $form['materiel_id']; ?>
			</td>
            <td>
		<?php echo $form['materiel_id']->renderError(); ?>
            </td>
        </tr>

        <tr>
            <th><?php echo $form['typemateriel_id']->renderLabel('Type de materiel demandé à la MDPH'); ?></th>
            <td>
                <?php echo $form['typemateriel_id']; ?>
	    </td>
            <td>
		<?php echo $form['typemateriel_id']->renderError(); ?>
            </td>
        </tr>
		 <tr>
            <th><?php echo $form['catmateriel_id']->renderLabel('catégorie du materiel demandé '); ?></th>
            <td>
                <?php echo $form['catmateriel_id']; ?>
	    </td>
            <td>
		<?php echo $form['typemateriel_id']->renderError(); ?>
            </td>
        </tr>
		


      <tr>   

        <tr>
            <th><?php  echo $form['decisioncda']->renderLabel('Décision de la CDA (cocher ACCEPTEE/ décocher REFUSEE)') ?> </th>
            <td>
           <?php echo $form['decisioncda']->renderError(). '&nbsp'. $form['datedecisioncda']->renderError()  ?>
           <?php echo $form['decisioncda'].'&nbsp&nbsp le &nbsp'.$form['datedecisioncda'] ?>
            </td>
        </tr>
		<tr>
		<th><?php echo $form['datedebutnotif']->renderLabel('Décison CDA notifié du ') ?></th>
        <td>
          <?php echo $form['datedebutnotif']->renderError().'&nbsp'.$form['datefinnotif']->renderError() ?>
          <?php echo $form['datedebutnotif'] .'&nbsp au &nbsp'.$form['datefinnotif']?>
        </td>
		</tr>
        <tr>
            <th><?php echo $form['traitement_id']->renderLabel('Traitement (attribution du matériel)&nbsp;&nbsp;') ?></th>
            <td>
                <?php echo $form['traitement_id'] ?>
            </td>
            <td>
                <?php echo $form['traitement_id']->renderError() ?>
            </td>
        </tr> 
		

		
		   <tr>
            <th><?php echo $form['notes']->renderLabel('Notes') ?></th>
            <td>
                <?php echo $form['notes'].$form['_csrf_token']   ?>
            </td>
            <td>
                <?php echo $form['notes']->renderError().$form['_csrf_token']->renderError() ?>
            </td>
        </tr> 
    </tbody>

</table>
* Type la demande suivante de type 'ND' (attention enregistrer la demande avant de cliquer sur "Typer la demande suivante)"
</form>



<script>
  function verif() {
	
    var message ="";
    var flag = 0;
	var d_1="";
    var d_2="";
	var d_3="";

	    if ($j("#demande_materiel_typemateriel_id").val() == ""  || $j("#demande_materiel_typemateriel_id").val() == 0) {
 		  message = message + " - Saisir un type de matériel ! "+" \n" ;
		  flag = 1;
        }

	   if ($j("#demande_materiel_catmateriel_id").val() == ""  || $j("#demande_materiel_catmateriel_id").val() == 0) {
 		 message = message + " - Sélectionner la catégorie du matériel  !" + " \n" ;
		 flag = 1;
 	   }
	   
		if ($j("#demande_materiel_datefinnotif").val()){
			date2 =$j("#demande_materiel_datefinnotif").val() ; 
			jour_2 = date2.substring(0,2);
			mois_2 = date2.substring(3,5);
			annee_2 = date2.substring(6,10);
			d_2 = new Date(annee_2, mois_2-1, jour_2); 
		}	

		if ($j("#demande_materiel_datedecisioncda").val()){
			date3 =$j("#demande_materiel_datedecisioncda").val() ; 
			jour_3 = date3.substring(0,2);
			mois_3 = date3.substring(3,5);
			annee_3 = date3.substring(6,10);
			d_3 = new Date(annee_3, mois_3-1, jour_3); 
		}
		
		
		if ($j("#demande_materiel_datedebutnotif").val()){
			date1 =$j("#demande_materiel_datedebutnotif").val() ; 
			jour_1 = date1.substring(0,2);
			mois_1 = date1.substring(3,5);
			annee_1 = date1.substring(6,10);
			d_1 = new Date(annee_1, mois_1-1, jour_1);
        }	
	   	
		if(  d_2 <  d_1  ){  //date de début de notification supérieure à la date de fin de notification
			flag = 1 ;
			message =  message + " - la date de début de notification " + date1 + " doit être inférieure à la date de fin de notification "+ date2+" \n";
		}
				
	//	if( d_3 > d_1 && $j("#demande_materiel_decisioncda").is(":checked") == true ){  //date de CDA supérieure à la date de début de notification et décision CDA à OK
			   //alert("tititi");
			  //  return false;
	//		 flag = 1 ;
	//		 message = message + " - la date de la CDA  " + d_3 + " doit être inférieure à la date de début de notification "+ d_1 +" \n";
	//	}
			
		   // Décision de la CDA acceptée controle saisie de la date de CDA
		  //--------------------------------------------------------------

			 if ( $j("#demande_materiel_decisioncda").is(":checked") == true && !$j("#demande_materiel_datedecisioncda").val()  ) {
			var message = message + "Décision de la CDA acceptée , saisir la date de Décision  !!"
			// $j("#demande_materiel_datefinnotif").attr('disabled', 'disabled');
			 flag = 1;
			} ;  
	 
	 	 
		//Décision refusée	 contrôle dates de notifications
		//--------------------------------------------------
		 if ( $j("#demande_materiel_decisioncda").is(":checked") == false && ($j("#demande_materiel_datefinnotif").val() || $j("#demande_materiel_datedebutnotif").val()) ) {
			var message = message + "Décision de la CDA refusée , impossible de saisir des dates de notification !!"
			// $j("#demande_materiel_datefinnotif").attr('disabled', 'disabled');
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