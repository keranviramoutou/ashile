<?php use_helper('jQuery') ?>
<?php use_helper('Date') ?>

<?php $i = 1 ?>
<fieldset>
<table  cellpadding="0" cellspacing="10" border="0" class="display" id="maTable">
    <thead>
        <tr>
            <th>Sessad</th>
			<th> Décision </th>
            <th>Date de Décision de la  CDA</th>
			 <th>Notification</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($demande_sessads as $demande_sessad): ?>
            <tr onclick="<?php echo jq_remote_function(array('url' => 'demandesessad/edit?mdph_id=' . $demande_sessad->getId())) ?>">
							<td><center><?php echo Doctrine::getTable('Typesessad')->find($demande_sessad->getTypesessadId()); ?></center></td>
						
							<td><center><?php echo format_date($demande_sessad->getDatedecisioncda(), 'dd/MM/yyyy') ?></center></td>
								<?php if($demande_sessad->getDecisioncda()==true): ?>
							<td><center><?php echo 'Accepté' ?></center></td>
								<?php elseif($demande_sessad->getDecisioncda()==false && $demande_sessad->getDatedecisioncda()): ?>
							<td><center><?php echo 'Refusé' ?></center></td>
								<?php elseif(!$demande_sessad->getDatedecisioncda()): ?>
							<td><center><?php echo 'Attente decision' ?></center></td>
							<?php endif; ?>	
							 <td><center>  <?php echo format_date($demande_sessad->getDatedebutnotif(),'dd/MM/yyyy').'&nbsp;au&nbsp;'.format_date($demande_sessad->getDatefinnotif(),'dd/MM/yyyy') ?> </center></td> 
								           
		   </tr>
            <?php $i++ ?>
        <?php endforeach; ?>
        <?php if ($i == 1): ?>
            <tr><td colspan="2" style="font-weight:normal;"></td></tr>
        <?php endif; ?>
    </tbody>
</table>
</fieldset>
<?php
echo jq_button_to_remote('Nouvelle demande', array(
    'url' => 'demandesessad/new?mdph_id=' . $sf_request->getParameter('mdph_id'),
    'update' => 'acc_sessad',
))
?>
