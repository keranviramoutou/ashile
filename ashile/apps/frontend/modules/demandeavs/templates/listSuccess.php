<?php use_helper('jQuery') ?>
<?php use_stylesheet('data_table.css') ?>
<?php if ($countdemande > 0) { ?>
<?php $i = 1 ?>
	<fieldset>
			<legend>Liste des demandes Avs liées à ce Mdph</legend>
			<table  cellpadding="0" cellspacing="10" border="0" class="display" id="maTable">
				<thead>
					<tr>
						<th>Type d'avs</th>
						<th>Date décision CDA</th>
						<th>Decision CDA</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach ($demande_avss as $demande_avs): ?>
						<tr>
							<td><?php echo Doctrine::getTable('Naturecontratavs')->find($demande_avs->getNaturecontratavsId())->getNaturecontrat(); ?></td>
							<td><?php echo format_date($demande_avs->getDatedecisioncda(), 'dd/MM/yyyy') ?></td>
								<?php if($demande_avs->getDecisioncda()==true): ?>
							<td><?php echo 'Accepté' ?></td>
								<?php elseif($demande_avs->getDecisioncda()==false && $demande_avs->getDatedecisioncda()): ?>
							<td><?php echo 'Refusé' ?></td>
								<?php elseif(!$demande_avs->getDatedecisioncda()): ?>
							<td><?php echo 'Attente decision' ?></td>
					<?php endif; ?>
						</tr>
						<?php $i++ ?>
					<?php endforeach; ?>
					<?php if ($i == 1): ?>
						<tr><td colspan="4" style="font-style: italic">Il n'y a pas de demande avs</td></tr>
					<?php endif; ?>
				</tbody>
			</table>
	</fieldset>
<?php }else{ ?>

<?php echo '<style="font-style: italic">Il n\'y a pas de demande d\'avs</font>' ; ?>
 <?php } ?>