<?php use_helper('Date') ?>

<h1>Informations sur le sessad</h1>


<fieldset>
    <legend>Détails sessad</legend>
	    <table class="show">
	    <tr>
		<th>Etablissement Hospitalier</th>
      		<td><?php $etbn = Doctrine::getTable('Sessad')->findOneById($sessadobtenu->getSessadId())->getEtabnonsco();
			  echo $etbn; 	
 ?></td>
	    </tr>		
	    <tr>
	      <th>Sessad :</th>
	      <td><?php echo $sessadobtenu->getSessad() ?></td>
	    </tr>
	    <tr>
	      <th>Date debut:</th>
	      <td><?php echo format_date($sessadobtenu->getDatedebut(), 'dd/MM/yyyy') ?></td>
	    </tr>
	    <tr>
	      <th>Date fin:</th>
	      <td><?php echo format_date($sessadobtenu->getDatefin(), 'dd/MM/yyyy') ?></td>
	    </tr>
	</table>
</fieldset>
<hr />

<?php use_helper('jQuery') ?>
&nbsp;
<?php echo jq_button_to_remote('Revenir à la liste', array('url' => 'sessadobtenu/index?eleve_id=' . $sessadobtenu->getEleveId().'&sessad_id='.$sessadobtenu->getSessadId(), 'update' => 'div_sessad')) ?>
<script type="text/javascript">
    $j("input:submit, input:button, form a").button();
</script>

