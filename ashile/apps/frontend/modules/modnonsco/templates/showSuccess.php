<h1>Informations sur La scolarisation externe</h1>

<?php use_helper('jQuery') ?>
<?php use_helper('Date') ?>
<fieldset>
    <legend>Détails</legend>
 <table class="show">
	  <tbody>
	    <tr>
	      <th>Etabnonsco :</th>
	      <td><?php echo $modnonsco->getEtabnonsco() ?></td>
	    </tr>
	    <tr>
	      <th>Nb de demi-journ&eacute;es :</th>
	      <td><?php echo Doctrine_core::getTable('Demijournee')->find($modnonsco->getDemijourneeId()); ?></td>
	    </tr>
	    <tr>
	      <th>Quotité horraire effective :</th>
	      <td><?php echo $modnonsco->getQuothorreff() ?></td>
	    </tr>
			    <tr>
	      <th>date début :</th>
	      <td><?php echo format_date($modnonsco->getDatedebut(),'dd/MM/yyyy') ?></td>
	    </tr>
	  </tbody>
</table>
</fieldset>
<hr />

<?php echo jq_button_to_remote('Edition', array('url' => 'modnonsco/edit?id=' . $modnonsco->getId(), 'update' => 'div_modnonsco')) ?>
&nbsp;
<?php echo jq_button_to_remote('Revenir à la liste', array('url' => 'modnonsco/index?eleve_id=' . $modnonsco->getEleveId(), 'update' => 'div_modnonsco')) ?>
<script type="text/javascript">
    $j("input:submit, input:button, form a").button();
</script>


