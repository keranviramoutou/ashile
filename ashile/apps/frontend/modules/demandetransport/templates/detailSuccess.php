<?php 	use_helper('jQuery');
		use_helper('Date');

$nul = true; ?>
<table class="show">
    <tbody>
        <?php foreach ($demande_transports as $demande_transport): ?>
  <?php $nul = false; ?>
            <tr>
                <th>Type transport:</th>
                <td><?php echo Doctrine_core::getTable('Transport')->findOneById($demande_transport->getTransportId()); ?></td>
            </tr>




            <?php if($demande_transport->getDatedecisioncda()): ?>
				<tr>
					<th>Date décision CDA:</th>
					<td><?php echo format_date($demande_transport->getDatedecisioncda(), 'dd/MM/yyyy') ?></td>
				</tr>
            <?php endif; ?>
			<tr>
                <th>Décision de la CDA:</th>
					<?php if($demande_transport->getDecisioncda()==true): ?>
                	<td><?php echo 'Accepté' ?></td>
						<?php elseif($demande_transport->getDecisioncda()==false && $demande_transport->getDatedecisioncda()): ?>
				<td><?php echo 'Refusé' ?></td>
							<?php elseif(!$demande_transport->getDatedecisioncda()): ?>
				<td><?php echo 'Attente decision' ?></td>
					<?php endif; ?>
            </tr>
            				
				<!-- ET si datedebut et fin notif sont connu -->
				 <?php if($demande_transport->getDatedebutnotif()): ?>
					<tr>
						<th> Notification </th>
						<td>  <?php echo 'du&nbsp;'.format_date($demande_transport->getDatedebutnotif(),'dd/MM/yyyy').'&nbsp;au&nbsp;'. format_date($demande_transport->getDatefinnotif(),'dd/MM/yyyy') ?> </td>
					</tr>
				<?php endif; ?>
	
        <?php endforeach; ?>
    </tbody>
</table>
<?php if ($nul): ?>
    <span style= "font-weight:normal"></span>
<?php endif; ?>
