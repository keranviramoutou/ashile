<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>
<?php use_helper('jQuery') ?>
<?php use_helper('Date') ?>
<?php use_helper('Text') ?>
<?php use_javascript('mdph.js') ?>

<script type="text/javascript">
    $j(function() {
        $j("#accordion").accordion({ collapsible: true, active: false, clearStyle: true});
    });
    function checkedAccordion(id){
        if($j('#'+id).attr('checked'))
            $j('#'+id).removeAttr('checked');
        else
            $j('#'+id).attr('checked', 'checked');
    }
</script>
<?php $mdph_id = $form->getObject()->getId() ?>



<?php
echo jq_form_remote_tag(array(
    'update' => 'div_mdph',
    'url' => 'mdph/' . ($form->getObject()->isNew() ? 'create' : 'update') . (!$form->getObject()->isNew() ? '?id=' . $form->getObject()->getId() . '&eleve_id=' . $form->getObject()->getEleveId() : '')))
?>
<?php if (!$form->getObject()->isNew()): ?>
    <input type="hidden" name="sf_method" value="put" />
<?php endif; ?>
<?php echo $form->renderHiddenFields(false) ?>

<table>
      <tr>
		<?php echo $form->renderGlobalErrors() ?>


               <th><?php  echo $form['dateess']->renderLabel('Date réunion : ' ) ?></th>
					<td>
							<?php  echo $form['dateess'] ?>
					</td>
					<td>
                        <?php  echo $form['dateess']->renderError() ?>
					</td>


				<th><?php echo $form['datecreationpps']->renderLabel('Cerfa de demande signé le : ') ?></th>
					<td>
						<?php echo $form['datecreationpps'] ?>
					</td>
					<td>
						<?php echo $form['datecreationpps']->renderError() ?>
					</td>
              
        </tr>
        <tr>
                 <th><?php  echo $form['datepjdom']->renderLabel(' justificatif de domicile reçu le : ' ) ?></th>
					<td>
                        <?php  echo $form['datepjdom'] ?>
					</td>
					<td>
                        <?php  echo $form['datepjdom']->renderError() ?>
					</td>
				
                <th><?php  echo $form['datepjident']->renderLabel(' justificatif d\'identité reçu le : ' ) ?></th>
					<td>
                        <?php  echo $form['datepjident'] ?>
					</td>
					<td>
                        <?php  echo $form['datepjident']->renderError() ?>
					</td>
         </tr>
		 		 <tr>
					<th><?php echo $form['datebilanmedical']->renderLabel('Bilan médical : ' ) ?></th>
					<td>
							<?php  echo $form['datebilanmedical'] ?>
					</td>
					<td>
							<?php  echo $form['datebilanmedical']->renderError() ?>
					</td>

					<th><?php echo $form['dateenvoiedossier']->renderLabel('Transmis à la MDPH le :' ) ?></th>
					<td>
							<?php  echo $form['dateenvoiedossier'] ?>
					</td>
					<td>
							<?php  echo $form['dateenvoiedossier']->renderError() ?>
					</td>
         </tr>
		          </tr>
		 		 <tr>
					<th><?php echo $form['depotparent']->renderLabel('Dossier déposé par les parents : ' ) ?></th>
					<td>
							<?php  echo $form['depotparent'] ?>
					</td>
					<td>
							<?php  echo $form['depotparent']->renderError() ?>
					</td>

         </tr>
	</script>
</table>	
<table>
    <tr>
        <td colspan="2" align="center">
            <br />&nbsp;
            <?php if (!$form->getObject()->isNew()): ?>
                &nbsp;<?php echo jq_button_to_remote('Supprimer', array('url' => 'mdph/delete?id=' . $form->getObject()->getId() . '&eleve_id=' . $form->getObject()->getEleveId(), 'update' => 'div_mdph', 'confirm' => 'Vous êtes sur?')) ?>
            <?php endif; ?>
            <input type="submit" value="Enregistrer" onClick="return verif_mdph()" />&nbsp;
			<?php
                echo jq_button_to_remote('Retour', array(
                    'url' => 'mdph/index?eleve_id=' . $form->getObject()->getEleveId(),
                    'update' => 'div_mdph',
                ))
                ?>
        </td>
    </tr>
</table>
</form>

<?php if($count_demandeorientations > 0)  {
$demandeorientations = '<font color="blue">Demande(s) d\'orientation &nbsp;('.$count_demandeorientations.')</font>' ;
}else{
$demandeorientations = 'Demande(s) d\'orientation ';
} ?>

<?php if($count_demandemateriels > 0)  {
$demandemateriels = '<font color="blue">Demande(s) de matériel &nbsp;('.$count_demandemateriels.')</font>' ;
}else{
$demandemateriels = 'Demande(s) de matériel ';
} ?>

<?php if($count_bilans > 0)  {
$bilans = '<font color="blue">Pièce(s) complémentaire(s) &nbsp;('.$count_bilans.')</font>' ;
}else{
$bilans = 'Pièce(s) complémentaire(s) ';
} ?>


<?php if($count_demandeavs > 0)  {
$avs = '<font color="blue">Demande d\'accompagnement scolaire &nbsp;('.$count_demandeavs.')</font>' ;
}else{
$avs = 'Demande d\'accompagnement scolaire ';
} ?>


<?php if($count_demandesessads > 0)  {
$sessad = '<font color="blue">Demande de Sessad &nbsp;('.$count_demandesessads.')</font>' ;
}else{
$sessad= 'Demande de Sessad ';
} ?>


<?php if($count_demandetransport> 0)  {
$transport = '<font color="blue">Demande de transport &nbsp;('.$count_demandetransport.')</font>' ;
}else{
$transport = 'Demande de transport ';
} ?>



<?php if($count_autrepiece > 0)  {
$autrepieces = '<font color="blue">Autre(s) pièce(s) &nbsp;('.$count_autrepiece.')</font>' ;
}else{
$autrepieces = 'Autre(s) pièce(s) ';
} ?>

<?php if (!$form->getObject()->isNew()): ?>
    <div id="accordion">
        <h3><a href="#" onClick="checkedAccordion('mdph_bilan');"><?php echo $bilans ?></a></h3>
        <div id="acc_bilan">
            <?php echo jq_javascript_tag(jq_remote_function(array('update' => 'acc_bilan', 'url' => 'bilan/index?mdph_id=' . $mdph_id))) ?>
        </div>
        <h3><a href="#" onClick="checkedAccordion('mdph_demandeorientation');"><?php echo $demandeorientations ?></a></h3>
        <div id="acc_orientation">
            <?php echo jq_javascript_tag(jq_remote_function(array('update' => 'acc_orientation', 'url' => 'demandeorientation/index?mdph_id=' . $mdph_id))) ?>
        </div>
        <h3><a href="#" onClick="checkedAccordion('mdph_demandemateriel');"><?php echo $demandemateriels ?></a></h3>
        <div id="acc_materiel">
            <?php echo jq_javascript_tag(jq_remote_function(array('update' => 'acc_materiel', 'url' => 'demandemateriel/index?mdph_id=' . $mdph_id))) ?>
        </div>
        <h3><a href="#" onClick="checkedAccordion('mdph_demandeavs');"><?php echo $avs ?></a></h3>
        <div id="acc_avs">
            <?php echo jq_javascript_tag(jq_remote_function(array('update' => 'acc_avs', 'url' => 'demandeavs/show?mdph_id=' . $mdph_id))) ?>
        </div>
        <h3><a href="#" onClick="checkedAccordion('mdph_demandesessad');"><?php echo $sessad ?></a></h3>
        <div id="acc_sessad">
            <?php echo jq_javascript_tag(jq_remote_function(array('update' => 'acc_sessad', 'url' => 'demandesessad/show?mdph_id=' . $mdph_id))) ?>
        </div>
        <h3><a href="#" onClick="checkedAccordion('mdph_demandetransport');"><?php echo $transport ?></a></h3>
        <div id="acc_transport">
            <?php echo jq_javascript_tag(jq_remote_function(array('update' => 'acc_transport', 'url' => 'demandetransport/show?mdph_id=' . $mdph_id))) ?>
        </div>
		<h3><a href="#" onClick="checkedAccordion('mdph_piecesdossier');"><?php echo $autrepieces ?></a></h3>
        <div id="acc_pieces">
            <?php echo jq_javascript_tag(jq_remote_function(array('update' => 'acc_pieces', 'url' => 'piecesdossier/index?mdph_id=' . $mdph_id))) ?>
        </div>

     </div>   
    <?php endif; ?>


<script>
var src = "<?php echo url_for('mdph/aide') ?>";

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
