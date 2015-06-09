<?php $i = 1 ?>
<?php use_helper('jQuery') ?>
<?php use_stylesheet('data_table.css') ?>
<?php use_stylesheet('datatable_jui.css') ?>
<?php use_helper('Date') ?>

 <fieldset >
	<legend>Scolarisation en milieu ordinaire</legend>
	<table cellpadding="0" cellspacing="20" border="0" class="display" id="maTable">
	  <thead>
	    <tr>
	      <th>Etablissement scolaire</th>
	      <th>Classe</th>
	      <th>Debut de scolarisation</th>
	      <th>Fin de scolarisation</th>
	    </tr>
	  </thead>
	  <tbody>

	    <?php $exist = false; ?>	

	    <?php foreach ($orientations as $orientation): ?>

	   <tr onclick="<?php echo jq_remote_function(array('url' => 'orientation/showHisto?id=' . $orientation->getId(), 'update' => 'div_histo')) ?>" style="cursor: pointer">
                <td><?php echo $orientation->getEtabsco(); ?></td>
                <td><?php echo $orientation->getClasse(); ?></td>
                
                <td><?php  echo format_date($orientation->getDatedebut(),'dd/MM/yyyy')?></td>
                <td><?php echo  format_date($orientation->getDatefin(),'dd/MM/yyyy')?></td>

            
	    </tr>
		<?php $i++ ?>

		<?php if($orientation->getId()):
			$exist = true;
                        $i = 0 ;
		      endif; 
		?>
		
		<?php endforeach; ?>
		<?php if ($i == 1): ?>
		    <tr><td colspan="7" style="font-style: italic">Cet élève n'a pas de scolariation en milieu ordinaire</td></tr>
		<?php endif; ?>
	    </tbody>
	</table>
</fieldset>

