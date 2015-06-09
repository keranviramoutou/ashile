<?php use_helper('Date') ?>

<?php $i = 1 ?>
	<fieldset>
	<table  cellpadding="0" cellspacing="10" border="0" class="display" id="maTable">
    <thead>
        <tr>
            <th>Sessad</th>
			<th> Décision de la CDA</th>
            <th>Date Décision CDA</th>
			 <th>Notification</th>
         </tr>
    </thead>
    <tbody>
        <?php foreach ($demande_sessads as $demande_sessad): ?>
				<tr>
							<td><center><?php echo Doctrine::getTable('Typesessad')->find($demande_sessad->getTypesessadId()); ?></center></td>
						
							<td><center><?php echo format_date($demande_sessad->getDatedecisioncda(), 'dd/MM/yyyy') ?></center></td>
								<?php if($demande_sessad->getDecisioncda()==true): ?>
							<td><center><?php echo 'Accepté' ?></center></td>
								<?php elseif($demande_sessad->getDecisioncda()==false && $demande_sessad->getDatedecisioncda()): ?>
							<td><center><?php echo 'Refusé' ?></center></td>
								<?php elseif(!$demande_sessad->getDatedecisioncda()): ?>
							<td><center><?php echo 'Attente décision' ?><center></td>
					<?php endif; ?>
					 <td> <center> <?php echo format_date($demande_sessad->getDatedebutnotif(),'dd/MM/yyyy').'&nbsp;au&nbsp;'.format_date($demande_sessad->getDatefinnotif(),'dd/MM/yyyy') ?> </center></td> 
				</tr>
            <?php $i++ ?>
        <?php endforeach; ?>
        <?php if ($i == 1): ?>
            <tr><td colspan="4" style="font-weight:normal;"></td></tr>
        <?php endif; ?>
    </tbody>
</table>
	</fieldset>
