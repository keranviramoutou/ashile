<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>
<?php use_stylesheet('data_table.css') ?>
<?php use_stylesheet('datatable_jui.css') ?>
<?php use_javascript('jquery.dataTables.min.js') ?>
<?php use_helper('Date') ?>
<?php use_helper('jQuery') ?>

<script language="javascript">
    $j(document).ready(function(){
        executeAjaxMns();
        $j("#modnonsco_etabnonsco_id").change(function(){
            executeAjaxMns();

        });
    });
    
    function executeAjaxMns(){
        if($j("#modnonsco_etabnonsco_id").val() != ""){
            $j.post("<?php echo url_for('@ajax_mns') ?>", { etabnonsco_id: $j("#modnonsco_etabnonsco_id").val() },
            function(data){
				$j("#infoMns").html(""); $j("#infoMns").html(data);
				});
        }else{
            $j("#infoMns").html("Aucune etablissement spécialisé selectionné");
        }
    }
   
</script>

<div>
	<fieldset>
		<?php echo '<legend> vous traitez l\'eleve :<strong> '.$form->getObject()->getEleve().'</strong>&nbsp&nbsp Date de Naissance :&nbsp<strong>'.format_date($form->getObject()->getEleve()->getdatenaissance(),'dd/MM/yyyy').'</strong>'; ?>
	</fieldset>
</div>

<div>
	<table>
		<td>
			<form action="<?php echo url_for('modnonsco/'.($form->getObject()->isNew() ? 'create' : 'update') . (!$form->getObject()->isNew() ? '?id=' . $form->getObject()->getId() . '&eleve_id=' . $form->getObject()->getEleveId() : '')) ?>" method="post" <?php $form->isMultipart() and print 'enctype="multipart/form-data" ' ?>>
			<?php if (!$form->getObject()->isNew()): ?>
			<input type="hidden" name="sf_method" value="put" />
			<?php endif; ?>
			  <table>
				<tfoot>
				  <tr>
					<td colspan="2">
					  &nbsp;<a href="<?php echo url_for('modnonsco/index') ?>">Retour</a>
					  <?php if (!$form->getObject()->isNew()): ?>
						&nbsp;<?php echo link_to('Delete', 'modnonsco/delete?id='.$form->getObject()->getId(), array('method' => 'delete', 'confirm' => 'Are you sure?')) ?>
					  <?php endif; ?>
					  <input type="submit" value="Save" />

							</td>
						</tr>
					</tfoot>
					<tbody>
						<?php echo $form->renderGlobalErrors() ?>
						<?php echo $form->renderHiddenFields(); ?>
						<tr>
							<th><?php echo $form['etabnonsco_id']->renderLabel() ?></th>
							<td>
								<?php echo $form['etabnonsco_id']->renderError() ?>
								<?php echo $form['etabnonsco_id'] ?>
							</td>
						</tr>
						<tr>
							<th><?php echo $form['demijournee_id']->renderLabel() ?></th>
							<td>
								<?php echo $form['demijournee_id']->renderError() ?>
								<?php echo $form['demijournee_id'] ?>
							</td>
						</tr>
																		<tr>
							<th><?php echo $form['classespe_id']->renderLabel() ?></th>
							<td>
								<?php echo $form['classespe_id']->renderError() ?>
								<?php echo $form['classespe_id'] ?>
							</td>
						</tr>
						<tr>
							<th><?php echo $form['quothorreff']->renderLabel() ?></th>
							<td>
								<?php echo $form['quothorreff']->renderError() ?>
								<?php echo $form['quothorreff'] ?>
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
		</td>
    </table>
</div>
<div id="infoMns">
</div>
