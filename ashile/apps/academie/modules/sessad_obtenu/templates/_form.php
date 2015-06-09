<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>
<?php use_helper('jQuery') ?>
<?php use_helper('Date') ?>

<form action="<?php echo url_for('sessad_obtenu/'.($form->getObject()->isNew() ? 'create' : 'update').(!$form->getObject()->isNew() ? '?id='.$form->getObject()->getId() : '')) ?>" method="post" <?php $form->isMultipart() and print 'enctype="multipart/form-data" ' ?>>
<?php if (!$form->getObject()->isNew()): ?>
<input type="hidden" name="sf_method" value="put" />
<?php endif; ?>
  <table>
    <tfoot>
      <tr>
        <td colspan="2">
          &nbsp;<button type="button" onclick="location.href='<?php echo url_for('sessad_obtenu/index' ) ?>'">Retour</button>
          <?php if (!$form->getObject()->isNew()): ?>
            &nbsp;
			<?php echo jq_button_to_remote('Supprimer', array('url' => 'sessad_obtenu/delete?id=' . $form->getObject()->getId() ,'confirm' => 'Etes vous sur?')) ?>
          <?php endif; ?>
          <input type="submit" value="Enregistrer" />
        </td>
      </tr>
    </tfoot>
    <tbody>
      <?php //echo $form ?>
	  					<?php if ($form->getObject()->isNew()): ?>
			
							<?php echo $form['eleve_id']->renderError() ?>
							<?php echo $form['eleve_id'] ?>
					
						<?php endif; ?>
	    	  				<tr>
							<th><?php echo $form['sessad_id']->renderLabel('Sessad obtenu') ?></th>
							<td>
								<?php echo $form['sessad_id']->renderError() ?>
								<?php echo $form['sessad_id']?>
						
							</td>
					
						</tr>
	  						<tr>
							<th><?php echo $form['datedebut']->renderLabel('Du') ?></th>
							<td>
								<?php echo $form['datedebut']->renderError() ?>
								<?php echo $form['datedebut']?>
						
							</td>
	
							<th><?php echo $form['datefin']->renderLabel('Au') ?></th>
							<td>
								<?php echo $form['datefin']->renderError() ?>
								<?php echo $form['datefin']?>
						
							</td>
						</tr>
    </tbody>
  </table>
</form>
