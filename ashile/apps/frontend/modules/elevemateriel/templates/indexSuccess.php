<?php use_helper('Date') ?>               
<?php use_helper('jQuery') ?>
<?php use_javascript('jquery.dataTables.min.js') ?>
<?php use_javascript('jquery-1.7.2.min.js') ?>
<?php use_javascript('jquery-ui-1.8.21.custom.min.js') ?>


<?php $i = 1 ?>


 <div class= 'aide' onClick="aide_elevemateriel()"></div> 
<fieldset>
		<legend>Liste des Matériels en prêt	</legend>
	
		<table  cellpadding="0" cellspacing="10" border="0" class="display" id="maTable">
			  <thead>
				<tr>
				  <th>Références du matériel<br></br></th>
				  <th> Prêt <br><small>(date de remise aux parents)</small></th>
				  <th>N° Convention<br></br></th>
				</tr>
			  </thead>
			  
			  <tbody>
				<?php foreach ($materiels as $materiel): ?>
				  <?php if(date('Y-m-d', time()) < $materiel['datefin'] || !$materiel['datefin']) {?>
				 	 <tr onClick="<?php echo jq_remote_function(array('url' => 'elevemateriel/show?id='.$materiel['eleve_materiel_Id'].'$eleve_id=' . $materiel['eleve_id'] . '&materiel_id=' . $materiel['materiel_id'], 'update' => 'div_materiel', 'method' => 'get')) ?>" class="<?php echo fmod($i, 2) ? 'even' : 'odd' ?>" style="cursor: pointer; color: #000; background:#C0DCC0"> 
				<?php }else{ ?> 
				 <tr onClick="<?php echo jq_remote_function(array('url' => 'elevemateriel/show?id='.$materiel['eleve_materiel_Id'].'$eleve_id=' . $materiel['eleve_id'] . '&materiel_id=' . $materiel['materiel_id'], 'update' => 'div_materiel', 'method' => 'get')) ?>" class="<?php echo fmod($i, 2) ? 'even' : 'odd' ?>" style="cursor: pointer; color: #000; background:#e0e0e0">
				     
				<?php } ?>	
				<td><?php echo $materiel['libelletypemateriel'].'&nbsp;-&nbsp;'.$materiel['libellemarque'].'&nbsp;-&nbsp;'.$materiel['libelleMateriel'].'&nbsp;n° :&nbsp'.$materiel['numeroMateriel']; ?></td>
				  <td><?php echo '&nbsp;&nbsp;&nbsp;- du &nbsp;'.format_date($materiel['datedebut'],'dd/MM/yyyy').'&nbsp;au&nbsp;'.format_date($materiel['datefin'],'dd/MM/yyyy') ?></td>
				 <?php if($materiel['numero_convention']){ ?>
				 <td> <?php echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$materiel['numero_convention'] ?></td>
				<?php  }else{ ?>
				<td> </td>
				<?php } ?>
				</tr>	
			<?php $i++ ?>
					<?php endforeach; ?>
					<?php if ($i == 1): ?>
						<tr><center><td colspan="4" style="font-style: italic">Cet(te) élève n'a pas de materiel en prêt</center></td></tr>
					<?php endif; ?>
				</tbody>
			</table>
</fieldset>	


<script>

function aide_elevemateriel() {
	var src = "<?php echo url_for('elevemateriel/aide') ?>";
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