<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>

<?php use_helper('jQuery') ?>
<?php use_javascript('modnonsco.js') ?>

<?php
echo jq_form_remote_tag(array(
    'update' => 'div_modnonsco',
    'url' => 'modnonsco/'. ($form->getObject()->isNew() ? 'create' : 'update') . (!$form->getObject()->isNew() ? '?id=' . $form->getObject()->getId() . '&eleve_id=' . $form->getObject()->getEleveId() : ''),

));
?> 

<?php if (!$form->getObject()->isNew()): ?>
    <input type="hidden" name="sf_method" value="put" />
<?php endif; ?>

<table>
    <tbody>
        <?php echo $form->renderGlobalErrors() ?>
        <tr>
            <th><?php echo $form['etabnonsco_id']->renderLabel('Etablissement spécialisé (*):') ?></th>
            <td>
                <?php echo $form['etabnonsco_id']->renderError() ?>
                <?php echo $form['etabnonsco_id'] ?>
            </td>
        </tr>
        <tr>
        <tr>
            <th><?php echo $form['classespe_id']->renderLabel('Classe spécialisée :') ?></th>
            <td>
                <?php echo $form['classespe_id']->renderError() ?>
                <?php echo $form['classespe_id'] ?>
            </td>
        </tr>
		  <tr>
            <th><?php echo $form['datedebut']->renderLabel('Début de scolarisation :') ?></th>
            <td>
                <?php echo $form['datedebut'] ?>
            </td>
            <td>
                <?php echo $form['datedebut']->renderError() ?>
            </td>
        </tr>
        <tr>
            <th><?php echo $form['datefin']->renderLabel('Fin de scolarisation :') ?></th>
            <td>
                <?php echo $form['datefin'] ?>
            </td>
            <td>
                <?php echo $form['datefin']->renderError() ?>
            </td>
        </tr>
		        <tr>
            <th><?php echo $form['niveauscolairespe_id']->renderLabel('Niveau:') ?></th>
            <td>
                <?php echo $form['niveauscolairespe_id'] ?>
            </td>
            <td>
                <?php echo $form['niveauscolairespe_id']->renderError() ?>
            </td>
        </tr>

        <tr>
            <th><?php echo $form['quothorreff']->renderLabel('Quotité horraire effective :') ?></th>
            <td>
                <?php echo $form['quothorreff']->renderError() ?>
                <?php echo $form['quothorreff'] ?>
            </td>
        </tr>
		 <tr>
            <th><?php echo $form['demijournee_id']->renderLabel('Nb de demi-journées :') ?></th>
            <td>
                <?php echo $form['demijournee_id']->renderError() ?>
                <?php echo $form['demijournee_id'] ?>
            </td>
        </tr>

							<!-- POUR PALIER AUX ERREURS CSRF_TOKEN ------------------>
					<!-------------------------------------------------------->
					<td>
					  <?php echo $form['_csrf_token']->renderError() ?>
					  <?php echo $form['_csrf_token'] ?>
					</td>
					<!------------------------------------------------------->
					<!------------------------------------------------------->
    </tbody>
    <tfoot>
        <tr>
            <td colspan="2" align="center">
                <?php if (!$form->getObject()->isNew()): ?>
				<?php echo jq_button_to_remote('Supprimer', array('url' => 'modnonsco/delete?id='.$form->getObject()->getId() . '&eleve_id=' . $form->getObject()->getEleveId(), 'update' => 'div_modnonsco', 'confirm' => 'Vous êtes sûr?')) ?>
                <?php endif; ?>
                &nbsp;
                <input type="submit" value="Enregistrer" onclick="return verif();" />&nbsp;
				<?php
                echo jq_button_to_remote('Retour', array(
                    'url' => 'modnonsco/index?eleve_id=' . $form->getObject()->getEleveId(),
                    'update' => 'div_modnonsco',
                ))
                ?>
            </td>
        </tr>
    </tfoot>
</table>
<?php echo $form->renderHiddenFields(); ?>
</form>
<script type="text/javascript">
    $j(function() {
        $j("input:submit, input:button, form ul li a").button();
    });
</script>



<script>
var src = "<?php echo url_for('modnonsco/aide') ?>";

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
