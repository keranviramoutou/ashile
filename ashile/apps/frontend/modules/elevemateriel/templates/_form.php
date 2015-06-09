<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>

<form action="<?php echo url_for('elevemateriel/'.($form->getObject()->isNew() ? 'create' : 'update').(!$form->getObject()->isNew() ? '?eleve_id='.$form->getObject()->getEleveId().'&materiel_id='.$form->getObject()->getMaterielId() : '')) ?>" method="post" <?php $form->isMultipart() and print 'enctype="multipart/form-data" ' ?>>
<?php if (!$form->getObject()->isNew()): ?>
<input type="hidden" name="sf_method" value="put" />
<?php endif; ?>
  <table>
    <tfoot>
      <tr>
        <td colspan="2">
          <?php echo $form->renderHiddenFields(false) ?>
          &nbsp;<a href="<?php echo url_for('elevemateriel/index') ?>">Back to list</a>
          <?php if (!$form->getObject()->isNew()): ?>
            &nbsp;<?php echo link_to('Delete', 'elevemateriel/delete?eleve_id='.$form->getObject()->getEleveId().'&materiel_id='.$form->getObject()->getMaterielId(), array('method' => 'delete', 'confirm' => 'Are you sure?')) ?>
          <?php endif; ?>
          <input type="submit" value="Save" />
        </td>
      </tr>
    </tfoot>
    <tbody>
      <?php echo $form->renderGlobalErrors() ?>
      <tr>
        <th><?php echo $form['dateconvention']->renderLabel() ?></th>
        <td>
          <?php echo $form['dateconvention']->renderError() ?>
          <?php echo $form['dateconvention'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['datedebut']->renderLabel() ?></th>
        <td>
          <?php echo $form['datedebut']->renderError() ?>
          <?php echo $form['datedebut'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['datefin']->renderLabel() ?></th>
        <td>
          <?php echo $form['datefin']->renderError() ?>
          <?php echo $form['datefin'] ?>
        </td>
      </tr>
    </tbody>
  </table>
</form>
