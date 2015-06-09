<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>

<form action="<?php echo url_for('position_avs/'.($form2->getObject()->isNew() ? 'create' : 'update').(!$form2->getObject()->isNew() ? '?id='.$form2->getObject()->getId(): '')) ?>" method="post" <?php $form2->isMultipart() and print 'enctype="multipart/form-data" ' ?>>
<?php if (!$form2->getObject()->isNew()): ?>
<input type="hidden" name="sf_method" value="put" />
<?php endif; ?>
  <table>
    <tfoot>
      <tr>
        <td colspan="2">
          &nbsp;<a href="<?php echo url_for('contrat_avs/edit?id='.$form2->getObject()->getContratavsId()) ?>">Retour au contrat</a>
          <?php if (!$form2->getObject()->isNew()): ?>
            &nbsp;<?php //echo link_to('Delete', 'position_avs/delete?id='.$form2->getObject()->getId(), array('method' => 'delete', 'confirm' => 'Are you sure?')) ?>
          <?php endif; ?>
          <input type="submit" value="Enregistrer" />
        </td>
      </tr>
    </tfoot>
    <tbody>
      <?php //echo $form2 ?>
	  <?php echo $form2->renderGlobalErrors() ?>
        <tr>
        <th><?php //echo $form2['contratavs_id']->renderLabel('contratavs_id') ?></th>
        <td>
          <?php echo $form2['contratavs_id']->renderError() ?>
          <?php echo $form2['contratavs_id'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form2['typepositionavs_id']->renderLabel('type de position') ?></th>
        <td>
          <?php echo $form2['typepositionavs_id']->renderError() ?>
          <?php echo $form2['typepositionavs_id'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form2['datedebut']->renderLabel('date debut') ?></th>
        <td>
          <?php echo $form2['datedebut']->renderError() ?>
          <?php echo $form2['datedebut'] ?>
        </td>

        <th><?php echo $form2['datefin']->renderLabel('date fin') ?></th>
        <td>
          <?php echo $form2['datefin']->renderError() ?>
          <?php echo $form2['datefin'] ?>
        </td>
      </tr>
    
    </tbody>
  </table>
</form>

