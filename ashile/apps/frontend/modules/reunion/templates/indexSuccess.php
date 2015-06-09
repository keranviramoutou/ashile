<?php use_helper('jQuery') ?>
<?php use_stylesheet('data_table.css') ?>
<?php use_helper('Date') ?>
<?php if ($sf_user->hasFlash('succes')): ?>
      <div class="flash_notice"><?php echo $sf_user->getFlash('succes') ?></div>
<?php endif ?>

<script>
    $j("input:submit, input:button").button(); 
</script>
<div class= 'aide' onClick="aide_reunion()"></div> 
<?php $i = 1 ?>

<fieldset>

	<table  cellpadding="0" cellspacing="10" border="0" class="display" id="maTable">
		<thead>
			<tr>
				<th>Intitulé de la réunion</th>
				<th>Nature</th>
				<th>Date</th>
				<th>Observations</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach ($reunions as $reunion): ?>
				<tr onclick="<?php echo jq_remote_function(array('url' => 'reunion/edit?id='.$reunion->getId(), 'update' => 'div_reunion','method' => 'get')) ?>" class="<?php echo fmod($i, 2) ? 'even' : 'odd' ?>" style="cursor: pointer; color: #000; background:#e0e0e0">
					<td><center><?php echo $reunion->getLibellereunion() ?></center></td>
					<td><center><?php echo $reunion->getTypeReunion() ?></center></td>
					<td><center><?php echo format_date($reunion->getDatereunion(),'dd/MM/yyyy') ?></center></td>
					<td><center><?php echo $reunion->getObservation() ?></center></td>
				</tr>
				<?php $i++ ?>
			<?php endforeach; ?>
			<?php if ($i == 1): ?>
				<tr><center><td colspan="7" style="font-style: italic">Cet(te) élève n'a pas de reunion</center></td></tr>
			<?php endif; ?>
		</tbody>
	</table>
</fieldset>
<br />
<?php
echo jq_button_to_remote('Nouvelle réunion', array(
    'url' => 'reunion/new?eleve_id=' . $sf_request->getParameter('eleve_id'),
    'update' => 'div_reunion',
))
?>


</script>
<!-- Le second script pour le pop up d'aide -->
<script>

		
	function aide_reunion() {
	var src = "<?php echo url_for('reunion/aide') ?>";
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