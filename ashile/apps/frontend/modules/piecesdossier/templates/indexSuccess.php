<?php use_helper('jQuery') ?>
<?php use_helper('Date') ?>
<?php use_stylesheet('data_table.css') ?>

<?php $i = 1 ?>

<fieldset>

	<table  cellpadding="0" cellspacing="10" border="0" class="display" id="waTable">
		<thead>
			<tr>
				<th>Libellé pièce</th>
				<th>Reçue le </th>
			</tr>
		</thead>
		<tbody>
	    <?php foreach ($pieces_dossiers as $pieces_dossier): ?>
    <tr onclick="<?php echo jq_remote_function(array('url' => 'piecesdossier/edit?id=' . $pieces_dossier->getId(), 'update' => 'acc_pieces')) ?>" class="<?php echo fmod($i, 2) ? 'even' : 'odd' ?>" style="cursor: pointer"> 
            <td><?php echo $pieces_dossier->getLibellepiece() ?></td>
            <td><?php echo format_date($pieces_dossier->getDaterecep(),'dd/MM/yyyy') ?></td>
    </tr>

				<?php $i++ ?>
			<?php endforeach; ?>
			<?php if ($i == 1): ?>
				<tr><td colspan="4" style="font-style: italic">Il n'y a pas de pieces</td></tr>
			<?php endif; ?>
		</tbody>
	</table>
</fieldset>

<?php
echo jq_button_to_remote('Nouvelle piece dossier', array(
    'url' => 'piecesdossier/new?mdph_id='.$mdphId,
    'update' => 'acc_pieces',
))
?>

