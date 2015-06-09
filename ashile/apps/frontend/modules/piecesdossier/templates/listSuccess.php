<?php use_helper('jQuery') ?>
<?php use_helper('Date') ?>
<?php use_stylesheet('data_table.css') ?>

<?php $i = 1 ?>


	<table  cellpadding="0" cellspacing="10" border="0" class="display" id="waTable">
		<thead>
			<tr>
				<th>Libelléd pièce</th>
				<th>Reçue </th>
			</tr>
		</thead>
		<tbody>
	    <?php foreach ($pieces_dossiers as $pieces_dossier): ?>
    <tr onclick="<?php echo jq_remote_function(array('url' => 'piecesdossier/edit?id=' . $pieces_dossier->getId(), 'update' => 'acc_pieces')) ?>" class="<?php echo fmod($i,2) ? 'even' : 'odd' ?>" style="cursor: pointer"> 
            <td><?php echo $pieces_dossier->getLibellepiece() ?></td>
			 <td><?php  echo format_date($pieces_dossier->getDaterecep(),'dd/MM/yyyy')  ?></td>

    </tr>

				<?php $i++ ?>
			<?php endforeach; ?>
			<?php if ($i == 1): ?>
				<tr><td colspan="4" style="font-style: italic">aucune(s) pièce(s) complémentaire(s)</td></tr>
			<?php endif; ?>
		</tbody>
	</table>



