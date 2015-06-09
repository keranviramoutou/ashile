<?php use_helper('jQuery'); ?>
<?php use_helper('Date') ?>

<?php $nul = true; ?>

<table class="show">

    <tbody>
        <?php foreach ($demande_sessads as $demande_sessad): ?>
            <?php $nul = false; ?>

			 <tr>
                <th>Type de sessad:</th>
                <td><?php echo Doctrine_core::getTable('Typesessad')->findOneById($demande_sessad->getTypesessadId()); ?></td>
            </tr>
            
               <?php if($demande_sessad->getDatedecisioncda()): ?>
				<tr>
					<th>Date décision CDA:</th>
					<td><?php echo format_date($demande_sessad->getDatedecisioncda(), 'dd/MM/yyyy') ?></td>
				</tr>
            <?php endif; ?>
            <tr>
                <th>Décision de la CDA:</th>
					<?php if($demande_sessad->getDecisioncda()==true): ?>
                	<td><?php echo 'Accepté' ?></td>
						<?php elseif($demande_sessad->getDecisioncda()==false && $demande_sessad->getDatedecisioncda()): ?>
				<td><?php echo 'Refusé' ?></td>
							<?php elseif(!$demande_sessad->getDatedecisioncda()): ?>
				<td><?php echo 'Attente decision' ?></td>
					<?php endif; ?>
            </tr>
			
			<tr>
				<th>Notification</th>
				<td><?php  echo 'du&nbsp;'.format_date($demande_sessad->getDatedebutnotif(),'dd/MM/yyyy').'&nbsp;au&nbsp;'. format_date($demande_sessad->getDatefinnotif(),'dd/MM/yyyy')?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<?php if ($nul): ?>
    <span style="font-weight:normal;"></span>
<?php endif; ?>
