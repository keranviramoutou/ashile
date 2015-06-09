 
  
  <?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>
<?php use_helper('jQuery') ?>
<?php use_helper('Date') ?>

<?php
echo jq_form_remote_tag(array(
    'update' => 'acc_avs',
    'url' => 'demandeavs/' . ($form->getObject()->isNew() ? 'create' : 'update') . (!$form->getObject()->isNew() ? '?id=' . $form->getObject()->getId() . '&mdph_id=' . $form->getObject()->getMdphId() : '')))
?>


<?php if (!$form->getObject()->isNew()): ?>
    <input type="hidden" name="sf_method" value="put" />
<?php endif; ?>
<?php echo $form->renderGlobalErrors() ?>

<table>
    <tfoot>
        <tr>
            <td colspan="2" align="center">
                <?php echo $form->renderHiddenFields(False) ?>
                <?php if (!$form->getObject()->isNew()): ?>
				

                
                   &nbsp;<?php echo jq_button_to_remote('Supprimer', array('url' => 'demandeavs/delete?id=' . $form->getObject()->getId().'&mdph_id='.$sf_request->getUrlParameter('mdph_id') , 'update' => 'acc_avs', 'confirm' => 'Etes vous sur?')) ?>
                   
				<?php endif; ?>
				    &nbsp;&nbsp;<input type="submit" value="Enregistrer" />&nbsp;
									<?php echo jq_button_to_remote('Retour', array(
					'url' => 'demandeavs/show?mdph_id=' . $form->getObject()->getMdphId(),
					'update' => 'acc_avs'
				));
				?>
		
            </td>
        </tr>
    </tfoot>
     <tbody>
        <?php echo $form->renderGlobalErrors() ?>

		<tr>
            <th><?php echo $form['naturecontratavs_id']->renderLabel('Type acc.') ?></th>
            <td>
			    <?php if ($form->getObject()->isNew()){
                echo $form['naturecontratavs_id']->renderError() ;
                 echo $form['naturecontratavs_id'] ; 
			    //echo 'mdph'. $sf_request->getUrlParameter('mdph_id') ; 
			    ?>
			</td> 

	
				<?php }else{ 
				 echo Doctrine_core::getTable('Naturecontratavs')->find($form->getObject()->getNaturecontratavsId()); ?>
					<?php    echo $form->getObject()->getNaturecontratavsId() ;  ?>
					<?php    echo $form->getObject()->getQuotitehorrairenotifie() ?>
				 <?php } ?>
				
            </td>
            
        </tr>
    </tbody>
</table>
</form>

<script type="text/javascript">
   $j(function() {
       $j("input:submit, input:button, form ul li a").button();
   });
</script>
