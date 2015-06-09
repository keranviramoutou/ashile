<?php $i = 1 ?>
<?php use_helper('jQuery') ?>
<?php use_stylesheet('data_table.css') ?>
<?php use_stylesheet('datatable_jui.css') ?>
<?php use_helper('Date') ?>
<div class= 'aide' onClick="aide_histo()"></div> 
 <fieldset >
	<legend>Scolarisation en milieu ordinaire</legend>
	<table cellpadding="0" cellspacing="20" border="0" class="display" id="maTable">
	  <thead>
	    <tr>
	      <th>Etablissement scolaire</th>
	      <th>Classe</th>
		   <th>Niveau Scolaire </th>
	      <th>Début de scolarisation</th>
	      <th>Fin de scolarisation</th>
	    </tr>
	  </thead>
	  <tbody>

	    <?php $exist = false; ?>	

	    <?php foreach ($orientations as $orientation): ?>

	   <tr onclick="<?php echo jq_remote_function(array('url' => 'orientation/showHisto?id=' . $orientation->getId(), 'update' => 'div_histo')) ?>" style="cursor: pointer; color: #000; background:#e0e0e0">
                <td><center><?php echo $orientation->getEtabsco(); ?></center></td>
                <td><center><?php echo $orientation->getClasse(); ?></center></td>
				<td><center><?php echo $orientation->getNiveauscolaire(); ?></center></td>
                
                <td><center><?php  echo format_date($orientation->getDatedebut(),'dd/MM/yyyy')?></center></td>
                <td><center><?php echo  format_date($orientation->getDatefin(),'dd/MM/yyyy')?></center></td>

            
	    </tr>
		<?php $i++ ?>

		<?php if($orientation->getId()):
			$exist = true;
                        $i = 0 ;
		      endif; 
		?>
		
		<?php endforeach; ?>
		<?php if ($i == 1): ?>
		    <tr><center><td colspan="7" style="font-style: italic">Cet(te) élève n'a pas de scolarisation en milieu ordinaire</center></td></tr>
		<?php endif; ?>
	    </tbody>
	</table>
</fieldset>


<script>

		
	function aide_histo() {
	var src = "<?php echo url_for('orientation/aide') ?>";
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
	}


</script>