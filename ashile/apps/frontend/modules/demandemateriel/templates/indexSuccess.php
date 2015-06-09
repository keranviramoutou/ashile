<?php use_helper('jQuery') ?>
<?php use_stylesheet('data_table.css') ?>
<?php use_helper('Date') ?>
<?php $i = 1 ?>
	<fieldset>

		<table  cellpadding="0" cellspacing="10" border="0" class="display" id="maTable">
			<thead>
				<tr>
					<th>Materiel</th>
					<th>Décision de la CDA</th>
					<th>Notification</th>
					<th>Notes</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach ($demandemateriels as $demandemateriel): ?>
				<?php if (!$demandemateriel->getDecisioncda()): ?>
					<tr onclick="<?php echo jq_remote_function(array('url' => 'demandemateriel/edit?id=' . $demandemateriel->getId(), 'update' => 'acc_materiel')) ?>" class="<?php echo fmod($i, 2) ? 'even' : 'odd' ?>" style="cursor: pointer">
				<?php elseif ($demandemateriel->getDecisioncda()): ?>
					<tr onclick="<?php echo jq_remote_function(array('url' => 'demandemateriel/show?id=' . $demandemateriel->getId(), 'update' => 'acc_materiel')) ?>" class="<?php echo fmod($i, 2) ? 'even' : 'odd' ?>" style="cursor: pointer">
  				<?php  endif; ?>
						<td>
							<?php
							$typeMateriel = Doctrine::getTable('Typemateriel')->find($demandemateriel->getTypematerielId());
							echo $typeMateriel->getLibelletypemateriel();
							?>
						</td>

                        <?php if ($demandemateriel->getDecisioncda() == true): ?>
							<td><?php echo 'Accepté le &nbsp;'.format_date($demandemateriel->getDateDecisioncda(),'dd/MM/yyyy') ?> </td>
							<td><?php echo 'du &nbsp;'.format_date($demandemateriel->getDatedebutnotif() ,'dd/MM/yyyy').'&nbsp;au&nbsp;'.format_date($demandemateriel->getDatefinnotif() ,'dd/MM/yyyy') ?></td>
						<?php elseif ($demandemateriel->getDecisioncda() == false && $demandemateriel->getDatedecisioncda()): ?>
							<td><?php echo 'Refusé le&nbsp;'.format_date($demandemateriel->getDateDecisioncda(),'dd/MM/yyyy')?></td>
							<td></td>
						<?php elseif (!$demandemateriel->getDatedecisioncda()): ?>
							<td><?php echo 'Attente décision' ?></td>
							<td></td>

						<?php endif; ?>
						<td>
						 <?php echo $demandemateriel->getNotes() ?>
						</td>
						
					</tr>
					<?php $i++ ?>
				<?php endforeach; ?>
				<?php if ($i == 1): ?>
					<tr><td colspan="4" style="font-style: italic">Il n'y a pas de demande materiel</td></tr>
				<?php endif; ?>
			</tbody>
		</table>
	</fieldset>
<?php
echo jq_button_to_remote('Nouvelle demande ', array(
    'url' => 'demandemateriel/new?mdph_id=' . $sf_request->getParameter('mdph_id'),
    'update' => 'acc_materiel',
))
?>

