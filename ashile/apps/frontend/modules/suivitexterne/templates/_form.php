<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>
<?php use_helper('jQuery') ?>
<?php use_helper('Text') ?>



<?php
echo jq_form_remote_tag(array(
    'update' => 'div_suivitext',
    'url' => 'suivitexterne/' . ($form->getObject()->isNew() ? 'create' : 'update') . (!$form->getObject()->isNew() ? '?eleve_id=' . $form->getObject()->getEleveId() . '&id=' . $form->getObject()->getId() : '')))
?>
<?php if (!$form->getObject()->isNew()): ?>
    <input type="hidden" name="sf_method" value="put" />
<?php endif; ?>
  <table>
    <tfoot>
        <tr>
            <td colspan="2">
                <?php echo $form->renderHiddenFields(false) ?>
                <?php if (!$form->getObject()->isNew()): ?>
                    &nbsp;
                    <?php echo jq_button_to_remote('Supprimer', array('url' => 'suivitexterne/delete?id=' . $form->getObject()->getId(), 'update' => 'div_suivitext', 'confirm' => 'Vous êtes sûr?')) ?>
                <?php endif; ?>
                <input type="submit" value="Enregistrer" />&nbsp;
				 <?php
                echo jq_button_to_remote('Retour ', array(
                    'url' => 'suivitexterne/index?eleve_id=' . $form->getObject()->getEleveId(),
                    'update' => 'div_suivitext',
                ))
                ?>

            </td>
        </tr>
    </tfoot>
    <tbody>
      <?php //echo $form ?>
	    <tr>
            <th><?php echo $form['naturesuiviext_id']->renderLabel('Nature du suivi') ?></th>
            <td>
                <?php echo $form['naturesuiviext_id'] ?>
            </td>
            <td>
                <?php echo $form['naturesuiviext_id']->renderError() ?>
            </td>
        </tr>
        <tr>

            <th><?php echo $form['specialiste_id']->renderLabel('Partenaire') ?></th>
            <td>
                <?php echo $form['specialiste_id'] ?>
            </td>
            <td>
                <?php echo $form['specialiste_id']->renderError() ?>
            </td>
        </tr>
        <tr>

            <th><?php echo $form['organismesuivit_id']->renderLabel('Etablissement ') ?></th>
            <td>
                <?php echo $form['organismesuivit_id'] ?>
            </td>
            <td>
                <?php echo $form['organismesuivit_id']->renderError() ?>
            </td>
        </tr>


		 <tr>
           <th><?php echo $form['datedebutpriseencharge']->renderLabel('Prise en charge du ') ?></th>
            <td>
                <?php echo $form['datedebutpriseencharge'].'&nbsp;</b>au&nbsp;'.  $form['datefinpriseencharge']?>
            </td>
            <td>
                <?php echo $form['datedebutpriseencharge']->renderError().$form['datefinpriseencharge']->renderError()  ?>
            </td>
        </tr>

    </tbody>
  </table>
</form>


<!-- Le second script pour le pop up d'aide -->
<script>
var src = "<?php echo url_for('suivitexterne/aide') ?>";

$j(document).ready(function(){	
		
	$j('.aide').click(function (){
		$j.modal('<iframe src="' + src + '" height="450" width="830" style="border:0">', {
			closeHTML:"",
			containerCss:{
				backgroundColor:"#fff",
				borderColor:"#fff",
				height:450,
				padding:0,
				width:830
			},
			overlayClose:true
		});
	});
});

</script>
