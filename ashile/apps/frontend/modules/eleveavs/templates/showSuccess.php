<h1>Informations les Avs alou&eacute;s</h1>

<fieldset>
	<legend>Détails</legend>
	<table class="show">
	  <tbody>
	    <tr>
	      <th>Avs :</th>
	      <td><?php echo $eleve_avs->getAvs() ?></td>
	    </tr>
	    <tr>
	      <th>telephone :</th>
	      <td><?php	echo $tel1; ?></td>
	    </tr>
	    <tr>	
	      <th>Etablissement employeur :</th>	
	      <td>
		<?php echo $EtabAvs; ?>
	      </td>
  	    </tr>
	    <tr>	
	      <th>Nature du contrat :</th>	
	      <td>
		<?php echo $nature_contrat; ?>
	      </td>
  	    </tr>
	    <tr>	
	      <th>Date de debut et de fin contrat :</th>	
	      <td>
		<?php echo 'Debut :'.$dateDebutCont." ".'Fin :'.$dateFinCont; ?>
	      </td>
	    </tr>
	    <tr>
		<th>Date de debut et de fin d'attribution Avs</th>
		<td>
		<?php echo 'Debut :'.$dateDebutAttrib.' Fin :'.$dateFinAttrib ?> 	
		</td>
	    </tr>		
	    <tr>
	      <th>Position de l'Avs :</th>	
	      <td>
		<?php echo $typeContratAvs; ?>
	      </td>
           </tr>
	      <th>Quotite horraire avs :</th>
	      <td><?php echo $eleve_avs->getQuotitehorraireavs() ?></td>
	    </tr>
	  </tbody>
	</table>
</fieldset>

<hr />

<?php use_helper('jQuery') ?>
&nbsp;
<?php echo jq_button_to_remote('Revenir à la liste', array('url' => 'eleveavs/index?eleve_id=' . $eleve_avs->getEleveId().'&avs_id='.$eleve_avs->getAvsId(), 'update' => 'div_avs')) ?>
<script type="text/javascript">
    $j("input:submit, input:button, form a").button();
</script>
