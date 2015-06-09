<?php use_stylesheets_for_form($form2) ?>
<?php use_javascripts_for_form($form2) ?>
<?php use_helper('Date') ?>

<?php echo 'C ICI !!!' ?>


<form action="<?php echo url_for('mail/'.($form2->getObject()->isNew() ? 'create' : 'update').(!$form2->getObject()->isNew() ? '?id='.$form2->getObject()->getId().'&module='.$nomModule : '')) ?>" method="post" <?php $form2->isMultipart() and print 'enctype="multipart/form-data" ' ?>>
<?php if (!$form2->getObject()->isNew()): ?>
<input type="hidden" name="sf_method" value="put" />
<?php endif; ?>
  <table>
    <tfoot>
      <tr>
        <td colspan="2">
          <?php echo $form2->renderHiddenFields(false) ?>
          <input type="submit" value="Envoi Email" />
        </td>
      </tr>
    </tfoot>
    <tbody>
			<?php echo $form2; ?>
    </tbody>
  </table>
</form>

