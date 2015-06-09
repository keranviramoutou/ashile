<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>
<?php use_helper('jQuery') ?>

<?php $url = 'enseignant/' . ($form->getObject()->isNew() ? 'create?orientation=' . $orientation : 'update') . (!$form->getObject()->isNew() ? '?id=' . $form->getObject()->getId() . '&orientation=' . $orientation : '') ?>
<?php echo jq_form_remote_tag(array('update' => 'accEnseignant', 'url' => $url)) ?>
<?php if (!$form->getObject()->isNew()): ?>
    <input type="hidden" name="sf_method" value="put" />
<?php endif; ?>
<?php echo $form->renderHiddenFields(false) ?>
<table>
    <tfoot>
        <tr>
            <td colspan="2">
                <?php if (!$form->getObject()->isNew()): ?>
                    <?php echo jq_button_to_remote('Supprimer', array('url' => 'enseignant/delete?id=' . $form->getObject()->getId() . '&orientation=' . $orientation, 'update' => 'accEnseignant', 'confirm' => 'Êtes vous sur de vouloir supprimer cet enseignant?')) ?>
                <?php endif; ?>
                <input type="submit" value="<?php echo $form->getObject()->isNew() ? 'Enregistrer' : 'Enregistrer' ?>" />
				<?php 
              echo jq_button_to_remote('Fermer', array(
                    'url' => 'orientation/edit?id=' . $orientation,
                    'update' => 'div_orientation', 
                ))
   
                ?>
            </td>
        </tr>
    </tfoot>
    <tbody>
        <?php echo $form ?>
    </tbody>
</table>
</form>
<?php echo jq_javascript_tag(!$form->getObject()->isNew() ? '$j("#titreAccEnseignant").text("Information sur l\'enseignant")' : '$j("#titreAccEnseignant").text("Ajouter un enseignant")') ?>

