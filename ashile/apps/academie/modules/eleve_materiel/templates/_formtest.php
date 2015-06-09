<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>
<?php use_javascript('/sfFormExtraPlugin/js/jquery.autocompleter.js') ?>
<?php use_stylesheet('/sfFormExtraPlugin/css/jquery.autocompleter.css') ?>



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

            <td>
			<?php echo $form['materiel_id'] ?>
			<td>
			
			 <?php if(!$form->getObject()->isNew()): ?>
			<td>
				<?php echo $form['datedebut']->renderError().'&nbsp'.$form['datefin']->renderError() ?>
				<?php echo 'Prêt (*) &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp&nbsp;&nbsp;&nbsp;&nbsp&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;du&nbsp;&nbsp;'.$form['datedebut'].'&nbsp;&nbsp;au&nbsp;&nbsp;'.$form['datefin']  ?>

			</td>
           <?php endif; ?>
		   <?php if($form->getObject()->isNew()): ?>
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
