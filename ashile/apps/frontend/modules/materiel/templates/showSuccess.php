<h1>Informations sur les materiels</h1>


<fieldset>
    <legend>Détails materiel</legend>
	    <table class="show">
		<thead>
	    <tr>
	      <th>Marque :</th>
	      <td><?php echo $materiel->getMarque() ?></td>
	    </tr>
	    <tr>
	      <th>Typemateriel :</th>
	      <td><?php echo $materiel->getTypemateriel() ?></td>
	    </tr>
	    <tr>
	      <th>Libellemateriel :</th>
	      <td><?php echo $materiel->getLibellemateriel() ?></td>
	    </tr>
	    <tr>
	      <th>Caracteristiques :</th>
	      <td><?php echo $materiel->getCaracteristiquemateriel() ?></td>
	    </tr>
	    <tr>
	      <th>Numero de serie :</th>
	      <td><?php echo $materiel->getNumeromateriel() ?></td>
	    </tr>
	    <tr>
	      <th>Livraison :</th>
	      <td><?php echo $materiel->getLivraison() ?></td>
	    </tr>	
	      <th>Debut materiel:</th>
	      <td><?php echo Tools::convertYmdTodmY($eleve_materiel->getDatedebut()) ?></td>
	    </tr>
	    <tr>
	      <th>Fin materiel:</th>
	      <td><?php echo Tools::convertYmdTodmY($eleve_materiel->getDatefin()) ?></td>
	    </tr>
	    <tr>
	      <th>Date convention:</th>
	      <td><?php echo Tools::convertYmdTodmY($eleve_materiel->getDateconvention()) ?></td>
	    </tr>
	</table>
<hr />

<?php use_helper('jQuery') ?>

&nbsp;
<?php echo jq_button_to_remote('Revenir à la liste', array('url' => 'elevemateriel/index?eleve_id=' . $materiel->getEleveId().'&materiel_id='.$materiel->getId(), 'update' => 'div_materiel')) ?>
<script type="text/javascript">
    $j("input:submit, input:button, form a").button();
</script>

