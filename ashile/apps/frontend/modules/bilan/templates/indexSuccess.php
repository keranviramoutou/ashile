<?php use_helper('jQuery') ?>
<?php use_helper('Date') ?>
<?php use_stylesheet('data_table.css') ?>

<?php $i = 1 ?>



<fieldset>

	<table  cellpadding="0" cellspacing="10" border="0" class="display" id="maTable">
		<thead>
			<tr>
				<th>Partenaire </th>
				<th>Intitulé du Bilan</th>
				<th>nature du Bilan</th>
				<th>Date du bilan</th>
				<th>Notes</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach ($bilans as $bilan): ?>
				<tr onclick="<?php echo jq_remote_function(array('url' => 'bilan/edit?id=' . $bilan->getId() . '&Mdph_id=' . $bilan->getMdphId(), 'update' => 'acc_bilan')) ?>" class="<?php echo fmod($i, 2) ? 'even' : 'odd' ?>" style="cursor: pointer">
					<td><?php echo $bilan->getSpecialiste(); ?></td>
					<td><?php echo $bilan->getLibelleBilan() ?></td>
					<td><?php echo $bilan->getNaturebilan() ?></td>
					<td><?php echo format_date($bilan->getDateBilan(), 'dd/MM/yyyy') ?></td>
						<td><?php echo $bilan->getNotes() ?></td>
				</tr>
				<?php $i++ ?>
			<?php endforeach; ?>
			<?php if ($i == 1): ?>
				<tr><td colspan="4" style="font-style: italic">Il n'y a pas de bilan</td></tr>
			<?php endif; ?>
		</tbody>
	</table>
</fieldset>

<?php
	echo jq_button_to_remote('Nouvelle pièce', array(
								'url' => 'bilan/new?mdph_id=' . $sf_request->getParameter('mdph_id'),
								'update' => 'acc_bilan',
							))
?>
<button type="button" onClick="partenaire()" > créer partenaire test </button>
