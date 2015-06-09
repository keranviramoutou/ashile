<?php $i = 1 ?>
<?php use_helper('jQuery') ?>
<?php use_stylesheet('data_table.css') ?>
<?php use_helper('Date') ?>
<!-- historique -->
 <fieldset >
	<legend>Scolarisation externe</legend>
	<table cellpadding="0" cellspacing="20" border="0" class="display" id="maTable">
	  <thead>
	    <tr>
	      <th>Etablissement d'accueil</th>
		  <th>Classe</th>
		   <th>Début de<br> scolarisation</th>
	      <th>Fin de<br> scolarisation</th>
		   <th>Niveau  </th>
	      <th>Quotité <br>horaire  </th>
	      <th>Nb de demi-journée</th>
	    </tr>
	  </thead>
	  <tbody>

	    <?php $exist = false; ?>	

	    <?php foreach ($modnonscos as $modnonsco): ?>
	   <tr onclick="<?php echo jq_remote_function(array('url' => 'modnonsco/show?id=' . $modnonsco['modnonsco_id'], 'update' => 'div_modnonsco')) ?>" style="cursor: pointer; color: #000; background:#e0e0e0">
	    
	      <td><center><?php echo $modnonsco['nometabnonsco'];  ?></center></td>
		  <td><?php echo $modnonsco['libelle_classe_spe']; ?></td>
		  <td><center><?php echo format_date($modnonsco['datedebut'],'dd/MM/yyyy') ?></center></td>
	      <td><center><?php echo format_date($modnonsco['datefin'],'dd/MM/yyyy');  ?></center></td>
	  	  <td><?php echo $modnonsco['niveauscolaire']; ?> </td>
	      <td><center><?php echo $modnonsco['quothorreff'].'&nbsp;heure(s)';  ?></center></td>
	      <td><center><?php echo $modnonsco['libelledemijournee'];  ?></center></td>	
	    </tr>
		<?php $i++ ?>

		<?php if($modnonsco['eleve_id']):
			$exist = true;
		      endif; 
		?>
		
		<?php endforeach; ?>
		<?php if ($i == 1): ?>
		    <tr><td colspan="7" style="font-style: italic">Cet(te) élève n'a pas de scolarisation externe</td></tr>
		<?php endif; ?>
	    </tbody>
	</table>
</fieldset>
