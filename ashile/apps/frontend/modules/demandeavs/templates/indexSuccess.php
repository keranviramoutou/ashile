<?php use_helper('jQuery') ?>
<?php use_stylesheet('data_table.css') ?>
<?php use_helper('Date') ?>
<?php $i = 1 ?>
	<fieldset>
			<legend>Liste des demandes Avs liées à ce Mdph</legend>
			<table  cellpadding="0" cellspacing="10" border="0" class="display" id="maTable">
				<thead>
					<tr>
						<th>Type d'avs</th>
						<th>Date décision CDA</th>
						<th>Décision CDA</th>
						<th>Notification </th>
					</tr>
				</thead>
				<tbody>
					<?php foreach ($demande_avss as $demande_avs): ?>
					   <tr onclick="<?php echo jq_remote_function(array('url' => 'demandeavs/show?id=' . $demande_avs->getId() . '&mdph_id='. $demande_avs->getMdphId(), 'update' => 'acc_avs')) ?>" class="<?php echo fmod($i, 2) ? 'even' : 'odd' ?>" style="cursor: pointer">
                        	<td><?php echo $demande_avs['naturecontrat'] ?></td>
							<td><?php echo format_date($demande_avs->getDatedecisioncda(), 'dd/MM/yyyy') ?></td>
								<?php if($demande_avs->getDecisioncda()==true): ?>
							<td><?php echo 'Accepté' ?></td>
								<?php elseif($demande_avs->getDecisioncda()==false && $demande_avs->getDatedecisioncda()): ?>
							<td><?php echo 'Refusé' ?></td>
								<?php elseif(!$demande_avs->getDatedecisioncda()): ?>
							<td><?php echo 'Attente decision' ?></td>
					<?php endif; ?>		
					      <td>  <?php echo format_date($demande_avs->getDatedebutnotif(),'dd/MM/yyyy').'&nbsp;au&nbsp;'.format_date($demande_avs->getDatefinnotif(),'dd/MM/yyyy') ?> </td> 
                        </tr>
						<?php $i++ ?>
					<?php endforeach; ?>
					<?php if ($i == 1): ?>
					<!--	<tr><td colspan="2" style="font-style: italic">Il n'y a pas de demande avs</td></tr> -->
					<?php endif; ?>
				</tbody>
			</table>
	</fieldset>		

<?php
echo jq_button_to_remote('Nouvelle demande', array(
    'url' => 'demandeavs/new?mdph_id=' . $sf_request->getParameter('mdph_id'),
    'update' => 'acc_avs',
))
?>
