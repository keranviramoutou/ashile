<?php use_helper('jQuery'); ?>
<?php use_stylesheet('data_table.css') ?>
<?php use_helper('Date') ?>
<?php $i = 1 ?>


<?php if ($sf_user->hasFlash('succes')): ?>
  <div class="flash_notice"><?php echo $sf_user->getFlash('succes') ?></div>
<?php endif ?>
<?php if ($sf_user->hasFlash('error')): ?>
  <div class="flash_notice"><?php echo $sf_user->getFlash('error') ?></div>
<?php endif ?>
<?php if ($sf_user->hasFlash('notice')): ?>
  <div class="flash_notice"><?php echo $sf_user->getFlash('notice') ?></div>
<?php endif ?>
<div class= 'aide' onClick="aide_transport()"></div> 
	<fieldset>
		<legend>Transport(s) obtenu(s)</legend>
		<table  cellpadding="0" cellspacing="10" border="0" class="display" id="maTable" width="100%">
		  <thead>
			<tr>
			  <th>Transport</th>
			  <th>Début de prise<br> en charge</th>
			  <th>Fin de prise<br> en charge</th>
			  <th>Décision <br>de la CDA</th>
			  <th>Début <br>notification </th>
			   <th>Fin <br>notification </th>
			</tr>
		  </thead>
		  <tbody>
			<?php foreach ($transportobtenus as $transport): ?>
			<!-- condition les dates de debut et de fin doivent être dans l'année scolaire pour que l'on puissse editer ce transport obtenu -->
			<?php if($transport->getDemandetransportId()): ?>
			<?php  if(format_date($transport['datefinnotif'],'dd/MM/yyyy')  >= format_date(time(),'dd/MM/yyyy') || ($transport->getDatedebut() && format_date($transport['datefinnotif'],'dd/MM/yyyy')  >= format_date(time(),'dd/MM/yyyy'))){ ?>
						 <?php if($transport->getDatedebut()){ ?>
							<tr onclick="<?php echo jq_remote_function(array('url'=>'transportobtenu/edit?id='.$transport->getId().'&eleve_id='.$transport->getEleveId().'&transport_id='.$transport->getTransportId().'&demandetransport_id='.$transport->getDemandetransportId(), 'update' => 'div_transport', 'method' => 'get')) ?>" class="<?php echo fmod($i, 2) ? 'even' : 'odd' ?>" style="cursor: pointer; color: #000; background:#e0e0e0">
						 <?php }else{ ?>
							<tr onclick="<?php echo jq_remote_function(array('url'=>'transportobtenu/edit?id='.$transport->getId().'&eleve_id='.$transport->getEleveId().'&transport_id='.$transport->getTransportId().'&demandetransport_id='.$transport->getDemandetransportId(), 'update' => 'div_transport', 'method' => 'get')) ?>" class="<?php echo fmod($i, 2) ? 'even' : 'odd' ?>" style="cursor: pointer; color: #000; background:#C0DCC0">
						 <?php } ?>
			
			<?php }else{ ?>
			<tr style="cursor: pointer; color: #000; background:#e0e0e0">
		    <?php } ?>
			<?php endif; ?>	
			<!-------------------------------------------------------------------------------------------------------------------------------->
				<td><?php echo $transport->getTransport() ?></td>
				  <td><center><?php echo  format_date($transport['datedebut'],'dd/MM/yyyy') ?></center></td>
				   <td><center><?php echo format_date($transport['datefin'],'dd/MM/yyyy')  ?></center></td>
				  <td><center><?php echo format_date($transport['datedecisioncda'],'dd/MM/yyyy') ?></center></td>
				  <td><center><?php echo format_date($transport['datedebutnotif'],'dd/MM/yyyy') ?></center></td>
				  <td><center><?php echo format_date($transport['datefinnotif'],'dd/MM/yyyy') ?></center></td>
				</tr>	
			<?php $i++ ?>
				<?php endforeach; ?>
				<?php if ($i == 1): ?>
					<tr><td colspan="4" style="font-style: italic">Cet(te) élève n'a pas d'aide au transport</td></tr>
				<?php endif; ?>
			</tbody>
		</table>
	</fieldset>
	
	<script>

		
	function aide_transport() {
	var src = "<?php echo url_for('transportobtenu/aide') ?>";
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