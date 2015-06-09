<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>
<?php use_helper('jQuery') ?>
<?php
echo jq_form_remote_tag(array(
    'update' => 'accClasseInclu',
    'url' => 'inclusion/' . ($form->getObject()->isNew() ? 'create?orientation=' . $orientation : 'update') . (!$form->getObject()->isNew() ? '?id=' . $form->getObject()->getId() . '&orientation=' . $orientation : '')));
?>
<?php if (!$form->getObject()->isNew()): ?>
    <input type="hidden" name="sf_method" value="put" />
<?php endif; ?>
<table>
    <tfoot>
        <tr>
            <td colspan="2">
                <?php /*
                  echo jq_button_to_remote('Retour à la liste', array(
                  'url' => 'inclusion/index',
                  'update' => 'accClasseInclu',
                  ))*/ 
                ?>
                <?php if (!$form->getObject()->isNew()): ?>
                    &nbsp;<?php echo jq_button_to_remote('Supprimer', array('url' => 'inclusion/delete?id=' . $form->getObject()->getId(). '&orientation=' . $orientation, 'update' => 'accClasseInclu', 'confirm' => 'Etes vous sûr de supprimer cette classe d\'inclusion?')) ; ?>
                <?php endif; ?>
                <input type="submit" value="<?php echo $form->getObject()->isNew() ? 'Ajouter' :'Enregistrer' ?>" />
            </td>
        </tr>
    </tfoot>
    <tbody>
        <?php echo $form ?>
    </tbody>
</table>
</form>
<?php echo jq_javascript_tag(!$form->getObject()->isNew() ? '$j("#titreAccInclu").text("Information sur la classe d\'inclusion")' : '$j("#titreAccInclu").text("Ajouter une classe d\'inclusion")') ?>
