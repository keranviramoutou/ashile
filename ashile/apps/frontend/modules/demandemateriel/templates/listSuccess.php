<?php use_helper('jQuery') ?>
<?php use_stylesheet('data_table.css') ?>
<?php use_helper('Date') ?>
<?php $i = 1 ?>


		<table class="tabList">
			<thead>
				<tr>
					<th>Materiel</th>
					<th>Notes</th>
					<th>Décision de la CDA</th>
					<th>Notification</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach ($demandemateriels as $demandemateriel): ?>
					<tr onclick="<?php echo jq_remote_function(array('url' => 'demandemateriel/edit?id=' . $demandemateriel->getId(), 'update' => 'acc_materiel')) ?>" class="<?php echo fmod($i, 2) ? 'even' : 'odd' ?>" style="cursor: pointer">
						<td><center>
							<?php
							$typeMateriel = Doctrine::getTable('Typemateriel')->find($demandemateriel->getTypematerielId());
							echo $typeMateriel->getLibelletypemateriel();
							?>
						</center></td>
						<td><center>
						<?php echo $demandemateriel->getNotes() ?>
						</center></td>
                        <?php if ($demandemateriel->getDecisioncda() == true): ?>
							<td><center><?php echo 'Accepté le &nbsp;'.format_date($demandemateriel->getDateDecisioncda(),'dd/MM/yyyy') ?> </center></td>
							<td><center><?php echo 'du &nbsp;'.format_date($demandemateriel->getDatedebutnotif() ,'dd/MM/yyyy').'&nbsp;au&nbsp;'.format_date($demandemateriel->getDatefinnotif() ,'dd/MM/yyyy') ?></center></td>
						<?php elseif ($demandemateriel->getDecisioncda() == false && $demandemateriel->getDatedecisioncda()): ?>
							<td><center><?php'Refusé le&nbsp;'.format_date($demandemateriel->getDateDecisioncda(),'dd/MM/yyyy')?></center></td>
							<td></center></td>
						<?php elseif (!$demandemateriel->getDatedecisioncda()): ?>
							<td><center><?php echo 'Attente décision' ?></center></td>
							<td></center></td>
						<?php endif; ?>
						
					</tr>
					<?php $i++ ?>
				<?php endforeach; ?>
				<?php if ($i == 1): ?>
					<tr><td colspan="4" style="font-weight:normal;">Il n'y a pas de demande materiel</td></tr>
				<?php endif; ?>
			</tbody>
		</table>
	


