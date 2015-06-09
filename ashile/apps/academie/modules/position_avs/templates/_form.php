<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>

<form action="<?php echo url_for('position_avs/'.($form->getObject()->isNew() ? 'create' : 'update').(!$form->getObject()->isNew() ? '?id='.$form->getObject()->getId(): '')) ?>" method="post" <?php $form->isMultipart() and print 'enctype="multipart/form-data" ' ?> onsubmit="return confirm('Voulez vous ajouter cette position?')">
<?php if (!$form->getObject()->isNew()): ?>
<input type="hidden" name="sf_method" value="put" />
<?php endif; ?>
  <table>
    <tfoot>
      <tr>
        <td colspan="2">
          
          <?php if (!$form->getObject()->isNew()): ?>
            &nbsp;<?php //echo link_to('Delete', 'position_avs/delete?id='.$form->getObject()->getId(), array('method' => 'delete', 'confirm' => 'Are you sure?')) ?>
          <?php endif; ?>
          <input type="submit" value="Enregistrer" /> <button type="button" onclick="window.close()" >Fermer</button>

		</td>
      </tr>
    </tfoot>
    <tbody>
      <?php //echo $form ?>
	  <?php echo $form->renderGlobalErrors() ?>
        <tr>
        <th><?php //echo $form['contratavs_id']->renderLabel('contratavs_id') ?></th>
        <td>
          <?php echo $form['contratavs_id']->renderError() ?>
          <?php echo $form['contratavs_id'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['typepositionavs_id']->renderLabel('type de position') ?></th>
        <td>
          <?php echo $form['typepositionavs_id']->renderError() ?>
          <?php echo $form['typepositionavs_id'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['datedebut']->renderLabel('date debut') ?></th>
        <td>
          <?php echo $form['datedebut']->renderError() ?>
          <?php echo $form['datedebut'] ?>
        </td>

        <th><?php echo $form['datefin']->renderLabel('date fin') ?></th>
        <td>
          <?php echo $form['datefin']->renderError() ?>
          <?php echo $form['datefin'] ?>
        </td>
      </tr>
    
    </tbody>
  </table>
</form>
