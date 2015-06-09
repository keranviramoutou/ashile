<?php use_helper('jQuery'); ?>
<?php use_stylesheet('data_table.css') ?>
<?php use_helper('Date') ?>

<?php if ($sf_user->hasFlash('succes')): ?>
  <div class="flash_notice"><?php echo $sf_user->getFlash('succes') ?></div>
<?php endif ?>
<?php if ($sf_user->hasFlash('error')): ?>
  <div class="flash_notice"><?php echo $sf_user->getFlash('error') ?></div>
<?php endif ?>
<?php if ($sf_user->hasFlash('notice')): ?>
  <div class="flash_notice"><?php echo $sf_user->getFlash('notice') ?></div>
<?php endif ?>
<div class= 'aide' onClick="aide_sessad()"></div> 
 <fieldset >
	<legend>Sessad(s) obtenu(us) </legend>
	<?php $i = 1 ?>
		<table  cellpadding="0" cellspacing="10" border="0" class="display" id="maTable" width="100%">
		  <thead>
			<tr>
			  <th>Nature du Sessad</th>
			  <th> Etablissement  </th>
			  <th>Début de prise en charge </th>
			  <th>Fin de prise en charge </th>
			 <th>Décision de la CDA</th>
			  <th>Début notification </th>
			   <th>Fin notification </th>
			 
			</tr>
		  </thead>
		  <tbody>
			<?php foreach ($sessadobtenus as $sessadobtenu): ?>
			<?php if($sessadobtenu->getDemandesessadId()): ?>

			
			<?php  if(format_date($sessadobtenu['datefinnotif'],'dd/MM/yyyy')  >= format_date(time(),'dd/MM/yyyy') || ($sessadobtenu->getDatedebut() && format_date($sessadobtenu['datefinnotif'],'dd/MM/yyyy')  >= format_date(time(),'dd/MM/yyyy'))){ ?>
				<?php if($sessadobtenu->getDatedebut()) { ?>
					<tr onclick="<?php echo jq_remote_function(array('url'=>'sessadobtenu/edit?id='.$sessadobtenu->getId().'&eleve_id='.$sessadobtenu->getEleveId().'&sessad_id='.$sessadobtenu->getSessadId().'&demandesessad_id='.$sessadobtenu->getDemandesessadId(), 'update' => 'div_sessad', 'method' => 'get')) ?>" class="<?php echo fmod($i, 2) ? 'even' : 'odd' ?>"style="cursor: pointer; color: #000; background:#e0e0e0">
				<?php }else{ ?>
					<tr onclick="<?php echo jq_remote_function(array('url'=>'sessadobtenu/edit?id='.$sessadobtenu->getId().'&eleve_id='.$sessadobtenu->getEleveId().'&sessad_id='.$sessadobtenu->getSessadId().'&demandesessad_id='.$sessadobtenu->getDemandesessadId(), 'update' => 'div_sessad', 'method' => 'get')) ?>" class="<?php echo fmod($i, 2) ? 'even' : 'odd' ?>"style="cursor: pointer; color: #000; background:#C0DCC0">
				<?php } ?>
		
		<?php }else{ ?>
		 <tr style="cursor: pointer; color: #000; background:#e0e0e0">
        <?php } ?>		
			<?php endif; ?>						
			<td><center><?php echo $sessadobtenu->getSessad()->getTypesessad() ?></td>
				<td><center><?php echo Doctrine::getTable('Sessad')->findOneById($sessadobtenu->getSessadId())->getEtabnonsco() ?></td>
				<td><center><?php echo format_date($sessadobtenu->getDatedebut(),'dd/MM/yyyy')?></center></td>
				<td><center><?php echo format_date($sessadobtenu->getDatefin(),'dd/MM/yyyy') ?></center></td>
					<td><center><?php echo format_date($sessadobtenu['datedecisioncda'],'dd/MM/yyyy') ?></center></td>
				  <td><center><?php echo format_date($sessadobtenu['datedebutnotif'],'dd/MM/yyyy') ?></center></td>
				  <td><center><?php echo format_date($sessadobtenu['datefinnotif'],'dd/MM/yyyy') ?></center></td>
			</tr>
		<?php $i++ ?>
				<?php endforeach; ?>
				<?php if ($i == 1): ?>
					<tr><center><td colspan="4" style="font-style: italic">Cet(te) élève n'a pas de sessad</center></td></tr>
				<?php endif; ?>
			</tbody>
		</table>
</fieldset>

	<script>

		
	function aide_sessad() {
	var src = "<?php echo url_for('sessadobtenu/aide') ?>";
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

