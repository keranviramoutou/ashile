<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>
<?php use_helper('jQuery') ?>
<?php use_helper('Date') ?>

<form action="<?php echo url_for('detailcommande/'.($form->getObject()->isNew() ? 'create' : 'update').(!$form->getObject()->isNew() ? '?id='.$form->getObject()->getId() : '')) ?>" method="post" <?php $form->isMultipart() and print 'enctype="multipart/form-data" ' ?>>
<?php if (!$form->getObject()->isNew()): ?>
<input type="hidden" name="sf_method" value="put" />
<?php endif; ?>
  <table>
    <tfoot>
      <tr>
        <td colspan="2">
          &nbsp;<a href="<?php echo url_for('detailcommande/index') ?>">Back to list</a>
          <?php if (!$form->getObject()->isNew()): ?>
            &nbsp;<?php echo link_to('Delete', 'detailcommande/delete?id='.$form->getObject()->getId(), array('method' => 'delete', 'confirm' => 'Are you sure?')) ?>
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
               <th><?php  echo $form['commande_id']->renderLabel('commande') ?></th>
				<td>
				   <?php  echo $form['commande_id'] ?>
				</td>
				<td>
                   <?php  echo $form['commande_id']->renderError() ?>
				</td>      
			</tr>
							
			<tr>
               <th><?php  echo $form['typemateriel_id']->renderLabel('Type materiel' ) ?></th>
				<td>
				   <?php  echo $form['typemateriel_id'] ?>
				</td>
				<td>
                   <?php  echo $form['typemateriel_id']->renderError() ?>
				</td>      
			</tr>      
			<tr>
               <th><?php  echo $form['specification']->renderLabel('specification' ) ?></th>
				<td>
				   <?php  echo $form['specification'] ?>
				</td>
				<td>
                   <?php  echo $form['specification']->renderError() ?>
				</td>      
			</tr>
			<tr>
               <th><?php  echo $form['quantite']->renderLabel('quantite' ) ?></th>
				<td>
				   <?php  echo $form['quantite'] ?>
				</td>
				<td>
                   <?php  echo $form['quantite']->renderError() ?>
				</td>      
			</tr>
			<tr>
               <th><?php  echo $form['datelivraison']->renderLabel('Date de livraison' ) ?></th>
				<td>
				   <?php  echo $form['datelivraison'] ?>
				</td>
				<td>
                   <?php  echo $form['datelivraison']->renderError() ?>
				</td>      
			</tr>			
    </tbody>
  </table>
</form>
