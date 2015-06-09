<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>

<form action="<?php echo url_for('dgesco/'.($form->getObject()->isNew() ? 'create' : 'update').(!$form->getObject()->isNew() ? '?id='.$form->getObject()->getId() : '')) ?>" method="post" <?php $form->isMultipart() and print 'enctype="multipart/form-data" ' ?>>
<?php if (!$form->getObject()->isNew()): ?>
<input type="hidden" name="sf_method" value="put" />
<?php endif; ?>
  <table>
    <tfoot>
      <tr>
        <td colspan="2">
          <?php echo $form->renderHiddenFields(false) ?>
          &nbsp;<?php echo button_to('Retour à la liste', 'dgesco/index') ?>
          <?php if (!$form->getObject()->isNew()): ?>
            &nbsp;<?php echo link_to('Delete', 'dgesco/delete?id='.$form->getObject()->getId(), array('method' => 'delete', 'confirm' => 'Are you sure?')) ?>
          <?php endif; ?>
          <input type="submit" value="Enregistrer" />
        </td>
      </tr>
    </tfoot>
    <tbody>
      <?php echo $form->renderGlobalErrors() ?>
	   <tr>
        <th><?php echo $form['eleve_id']->renderLabel() ?></th>
        <td>
          <?php echo $form['eleve_id']->renderError() ?>
          <?php echo $form['eleve_id'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['question']->renderLabel() ?></th>
        <td>
          <?php echo $form['question']->renderError() ?>
          <?php echo $form['question'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['reponse_id']->renderLabel() ?></th>
        <td>
          <?php echo $form['reponse_id']->renderError() ?>
          <?php echo $form['reponse_id'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['libelle_reponse']->renderLabel() ?></th>
        <td>
          <?php echo $form['libelle_reponse']->renderError() ?>
          <?php echo $form['libelle_reponse'] ?>
        </td>
      </tr>
    </tbody>
  </table>
</form>
