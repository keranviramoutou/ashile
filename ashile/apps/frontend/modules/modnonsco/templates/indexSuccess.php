<?php $i = 1 ?>
<?php use_helper('jQuery') ?>
<?php use_stylesheet('data_table.css') ?>
<?php use_helper('Date') ?>
<?php if ($sf_user->hasFlash('error')): ?>
    <div class="flash_error"><?php echo $sf_user->getFlash('error') ?></div>
<?php endif; ?>

<?php if ($sf_user->hasFlash('succes')): ?>
    <div class="flash_notice"><?php echo $sf_user->getFlash('succes') ?></div>
<?php endif; ?>

 <fieldset >
	<legend>Scolarisation externe</legend>
		<table <table cellpadding="0" cellspacing="10" border="0" class="display" id="maTable" width="100%">
	  <thead>
	    <tr>
	      <th>Etablissement d'accueil</th>
		  <th>Classe</th>
		   <th>Début de<br> scolarisation</th>
	      <th>Fin de<br> scolarisation</th>
		   <th>Niveau  </th>
	      <th>Quotité <br>horaire  </th>
	      <th>Nb de<br> demi-journée</th>

	    </tr>
	  </thead>
	  <tbody>

	   

	    <?php foreach ($modnonscos as $modnonsco): ?>
	   <tr onclick="<?php echo jq_remote_function(array('url' => 'modnonsco/edit?id=' . $modnonsco['modnonsco_id'], 'update' => 'div_modnonsco')) ?>" style="cursor: pointer; color: #000; background:#e0e0e0">
	      <td><center><?php echo $modnonsco['nometabnonsco'];  ?></center></td>
		  <td><center><?php echo $modnonsco['libelle_classe_spe']; ?></center></td>
		  <td><center><?php echo format_date($modnonsco['datedebut'],'dd/MM/yyyy') ?></center></td>
	      <td><center><?php echo format_date($modnonsco['datefin'],'dd/MM/yyyy');  ?></center></td>
	  	  <td><center><?php echo $modnonsco['niveauscolaire']; ?> </center></td>
	      <td><center><?php echo $modnonsco['quothorreff'].'&nbsp;heure(s)';  ?></center></td>
	      <td><center><?php echo $modnonsco['libelledemijournee'];  ?></center></td>	

	    </tr>
		<?php $i++ ?>


		
		<?php endforeach; ?>
		<?php if ($i == 1): ?>
		    <tr><center><td colspan="7" style="font-style: italic">Cet(te) élève n'a pas de scolarisation externe</center></td></tr>
		<?php endif; ?>
	    </tbody>
	</table>
</fieldset>

<?php if($orientations[0]['libelledemijournee'] == 'Temps complet'){ ?>
<?php echo '* Impossible de créer une scolarisation externe , élève scolarisé(e) en milieu ordinaire à "Temps complet"' ?>
<?php }else{ ?>
<?php echo jq_button_to_remote('Nouvelle scolarité externe' , array('url' => 'modnonsco/new?eleve_id=' . $sf_request->getParameter('eleve_id'), 'update' => 'div_modnonsco')) ?>
<?php } ?>
<script type="text/javascript">
    $j("input:submit, input:button, form ul li a").button();
</script>
