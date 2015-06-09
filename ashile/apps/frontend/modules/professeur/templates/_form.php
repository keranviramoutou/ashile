<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>
<?php use_helper('jQuery') ?>
<?php $url = 'professeur/' . ($form->getObject()->isNew() ? 'create?orientation=' . $orientation : 'update') . (!$form->getObject()->isNew() ? '?id=' . $form->getObject()->getId() . '&orientation=' . $orientation : '') ?>
<?php echo jq_form_remote_tag(array('update' => 'accProf', 'url' => $url)) ?>
<?php if (!$form->getObject()->isNew()): ?>
    <input type="hidden" name="sf_method" value="put" />
<?php endif; ?>
    <?php echo $form->renderHiddenFields(false) ?>
<table>
    <tfoot>
        <tr>
            <td colspan="2">
                <?php if (!$form->getObject()->isNew()): ?>
                    &nbsp;<?php echo jq_button_to_remote('Supprimer', array('url' => 'professeur/delete?id=' . $form->getObject()->getId() . '&orientation=' . $orientation, 'update' => 'accProf', 'confirm' => 'Êtes vous sur de vouloir supprimer ce professeur?')) ?>
                <?php endif; ?>
                <input type="submit" value="<?php echo $form->getObject()->isNew() ? 'Ajouter' : 'Modifier' ?>" />
            </td>
        </tr>
    </tfoot>
    <tbody>
        <?php echo $form ?>
    </tbody>
</table>
</form>
<?php echo jq_javascript_tag(!$form->getObject()->isNew() ? '$j("#titreAccProf").text("Information sur professeur")' : '$j("#titreAccProf").text("Ajouter un professeur")') ?>