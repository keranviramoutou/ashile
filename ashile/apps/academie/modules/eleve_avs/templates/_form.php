<?php //use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>
<?php use_stylesheet('data_table.css') ?>
<?php use_stylesheet('datatable_jui.css') ?>
<?php use_javascript('jquery.dataTables.min.js') ?>
<?php use_helper('Date') ?>
<?php use_helper('jQuery') ?>

<script language="javascript">
    $j(document).ready(function(){
        executeAjaxAvs();
        $j("#eleve_avs_avs_id").change(function(){
            executeAjaxAvs();
            executeContratAvs();
        });
    });
    
    function executeAjaxAvs(){
        if($j("#eleve_avs_avs_id").val() != ""){
            $j.post("<?php echo url_for('@ajax_avs') ?>", { avs_id: $j("#eleve_avs_avs_id").val() },
            function(data){
				$j("#infoAvs").html(""); $j("#infoAvs").html(data);
				});
        }else{
            $j("#infoAvs").html("Aucune AVS selectionnée");
        }
    }
    
        function executeContratAvs(){
        if($j("#eleve_avs_avs_id").val() != ""){
            $j.post("<?php echo url_for('@contrat_avs-dyn') ?>", { avs_id: $j("#eleve_avs_avs_id").val() },
            function(data){
				$j("#contratAvs").html(""); $j("#contratAvs").html(data);
				});
        }else{
            $j("#contratAvs").html("Aucune AVS selectionnée");
        }
    }
   
</script>

<?php //echo 'le nom du module = '.$nomModule // OK ?>

<div>

		<td>
			<fieldset>
			<form action="<?php echo url_for('eleve_avs/' . ($form->getObject()->isNew() ? 'create' : 'update') . (!$form->getObject()->isNew() ? '?id='.$form->getObject()->getId().'&eleve_id='.$form->getObject()->getEleveId().'&avs_id='.$form->getObject()->getAvsId(): '')) ?>" method="post" <?php $form->isMultipart() and print 'enctype="multipart/form-data" ' ?>>
				<?php if (!$form->getObject()->isNew()): ?>
					<input type="hidden" name="sf_method" value="put" />
				<?php endif; ?>
				<table>
					<tfoot>
						<tr>
							<td colspan="2">
								 <?php //echo 'OK SECTEUR ICI !! '.$secteur = $sf_request->getParameter('secteur_id') ?>
							    <?php  echo $form->renderHiddenFields() ?>
								  
								  
								  <input type="submit" value="Enregistrer"  onclick="return verif();"/>
								  <!-- echo link_to('Delete this page', 'my_module/my_action', array('id' => 'myid', 'confirm' => 'Are you sure?', 'absolute' => true)); -->
								  
								  

                                					      
								<?php if (!$form->getObject()->isNew()): ?>
									&nbsp;<?php //echo link_to('Supprimer', 'eleve_avs/delete?id=' . $form->getObject()->getId() , array('method' => 'delete', 'confirm' => 'Voulez-vous le supprimer?')) ?>  
								<?php endif; ?>
							
								<!-- Envoi mail à l'ERF -->
		                          <?php //if(!$form->getObject()->isNew()): ?>
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
																		
													<?php echo button_to('Envoi mail à l\'ERF', 'mail/envoimail?user_id='.$sf_user->getGuardUser()->getId().'&modules=eleve_avs'.'&datedebut='.
										$datedebut.'&datefin='.$datefin .'&quotitehorraireavs='.$form['quotitehorraireavs']->getValue().'&eleve_id='.$form->getObject()->getEleveId().'&avs_id='.$form->getObject()->getAvsId(), array('popup' => array('popupWindow', 'width=310,height=400,left=320,top=0','scrollbars=yes')) )  ?>
								<?php //endif; ?>
								<?php //gestion du retour ?>
								<?php if ($sf_request->getParameter('retour')){ ?>
								    &nbsp;<button type="button" onclick="location.href='<?php echo url_for('eleve/recherche?eleve_id='.$sf_request->getParameter('eleve_id').'&eleve_nom='.$sf_request->getParameter('eleve_nom').'&eleve_prenom=' . $sf_request->getParameter('eleve_prenom').'&flag_recherche=1' ) ?>'">Retour</button>
								<?php } ?>
								<!---------------------------------------------------------------------------------------------->
									
							</td>
						</tr>
					</tfoot>
					<tbody>
					
		
						<?php echo $form->renderGlobalErrors() ?>
						<?php if ($form->getObject()->isNew()): ?>
						<tr>
						<th><?php echo $form['avs_id']->renderLabel() ?></th>
						<td>
							<?php echo $form['avs_id']->renderError() ?>
							<?php echo $form['avs_id'] ?>
						</td>
						</tr>
						
						
						<?php endif; ?>
			
						<tr>
							<th><?php echo $form['quotitehorraireavs']->renderLabel('Quotite horaire Affectée') ?></th>
							<td>
								<?php echo $form['quotitehorraireavs']->renderError() ?>
								<?php echo $form['quotitehorraireavs']?>
						
							</td>
						</tr>
						<tr>
							<th><?php echo $form['datedebut']->renderLabel('Affectation du ') ?></th>
							<td>
							  
								<?php echo $form['datedebut']->renderError().$form['datefin']->renderError() ?>
							  <?php if($form->getObject()->isNew()): ?>
								<?php echo $form['datedebut'].'&nbsp;<small> * pour rensignée la de fin d\'acc modifier l\'ac en cours</small>' ?>
						   	 <?php endif; ?>
							 
							 
							  <?php if(!$form->getObject()->isNew()): ?>
								<?php echo $form['datedebut'].'&nbsp;&nbsp;au&nbsp'.$form['datefin'] ?>
						   	 <?php endif; ?>
							</td>
				
						</tr>
						<tr>
							<th><?php echo $form['commentaire']->renderLabel('commentaire') ?></th>
							<td>
								<?php echo $form['commentaire']->renderError() ?>
								<?php echo $form['commentaire'] ?>
							</td>
						</tr>

					
						<tr>
							<th><?php echo $form['_csrf_token']->renderLabel('.') ?></th>
							<td>
								<?php echo $form['_csrf_token']->renderError() ?>
								<?php echo $form['_csrf_token'] ?>
							</td>
						
						</tr>
					
		
					</tbody>
				</table>
			</form>
		</fieldset>
		</td>

</div>


<br></strong>
<div id="infoAvs">
	
</div>

<script>
  function verif() {
	
    var message ="";
    var flag = 0;
	var d_1="";
    var d_2="";
	var d_3="";

 

		if ($j("#eleve_avs_datedebut").val() == ""  || $j("#eleve_avs_datedebut").val() == 0) {
   			message = message + "Saisir une date de début de prise en charge ! "+" \n" ;
			flag = 1;
        }
		
		
		  if ($j("#eleve_avs_datedebut").val() && $j("#eleve_avs_datefin").val()){	
			date2 =$j("#eleve_avs_datedebut").val() ; 
			jour_2 = date2.substring(0,2);
			mois_2 = date2.substring(3,5);
			annee_2 = date2.substring(6,10);
			d_2 = new Date(annee_2, mois_2-1, jour_2); 
	
			date3 =$j("#eleve_avs_datefin").val() ; 
			jour_3 = date3.substring(0,2);
			mois_3 = date3.substring(3,5);
			annee_3 = date3.substring(6,10);
			d_3 = new Date(annee_3, mois_3-1, jour_3); 
		
			if(  d_3 < d_2  ){  //date de début de notification supérieure à la date de fin de notification
			   flag = 1 ;
			   message =  message + " - la date de début de prise en charge " + date1 + " doit être inférieure à la date de fin de prise en charge "+ date3+" \n";
			}
		}
		

		 
		 
		 if ($j("eleve_avs_quotitehorraireavs").val() == ""  || $j("#eleve_avs_quotitehorraireavs").val() == 0) {
      
		  message = message + "Saisir une Quotité horaire ! "+" \n" ;

		 flag = 1;
         }
		 
		 
		if ($j("eleve_avs_avs_id").val() == ""  || $j("#eleve_avs_avs_id").val() == 0) {
 
		   message = message + "Sélectionner une Accompagnant avec un contrat valide ! "+" \n" ;

		 flag = 1;
         }
		 
		 
		 eleve_avs_avs_id
 
    if(flag == 1){
	  alert(message);
	  return false;
	}else{
      document.body.style.cursor='wait';
       return true;
	}
    }
</script>