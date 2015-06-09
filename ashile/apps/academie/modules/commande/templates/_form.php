<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>
<?php use_helper('jQuery') ?>
<?php use_helper('Date') ?>

<form action="<?php echo url_for('commande/'.($form->getObject()->isNew() ? 'create' : 'update').(!$form->getObject()->isNew() ? '?id='.$form->getObject()->getId() : '')) ?>" method="post" <?php $form->isMultipart() and print 'enctype="multipart/form-data" ' ?>>
<?php if (!$form->getObject()->isNew()): ?>
<input type="hidden" name="sf_method" value="put" />
<?php endif; ?>
  <table>
    <tfoot>
      <tr>
        <td colspan="2">
          &nbsp;<a href="<?php echo url_for('commande/index') ?>">Back to list</a>
          <?php if (!$form->getObject()->isNew()): ?>
            &nbsp;<?php echo link_to('Delete', 'commande/delete?id='.$form->getObject()->getId(), array('method' => 'delete', 'confirm' => 'Are you sure?')) ?>
          <?php endif; ?>
          <input type="submit" value="Save" />
        </td>
      </tr>
    </tfoot>
    <tbody>
		<?php //echo $form ?>
		<?php echo $form->renderGlobalErrors() ?>   
		<?php echo $form->renderHiddenFields(false) ?>		
      <tr>
               <th><?php  echo $form['fournisseur_id']->renderLabel('Fournisseur' ) ?></th>
					<td>
							<?php  echo $form['fournisseur_id'] ?>
					</td>
					<td>
                        <?php  echo $form['fournisseur_id']->renderError() ?>
					</td>      
      </tr>
      <tr>
               <th><?php  echo $form['date_commande']->renderLabel('Date commande' ) ?></th>
					<td>
							<?php  echo $form['date_commande'] ?>
					</td>
					<td>
                        <?php  echo $form['date_commande']->renderError() ?>
					</td>      
      </tr>      
    </tbody>
  </table>
		  <?php if(!$form->getObject()->isNew()){ ?>	
          <tr>	  
         <td rowspan = "6" colspan = "6" >
			    <fieldset>
                <legend>Détails de la commande</legend>
					<table>
				        <tr><th><?php echo $form['newDetailCommande']->renderLabel('Ajout d\'une piece') ?></th></tr>
							<td>
								<?php echo $form['newDetailCommande'] ?> 
                                 			</td>
							<td>
								<?php echo $form['newDetailCommande']->renderError() ?>

                         				</td>
					</table>
		</tr>
		<?php } ?>			
</form>
