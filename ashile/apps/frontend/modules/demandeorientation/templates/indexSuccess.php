<?php use_helper('jQuery') ?>
<?php use_helper('Date') ?>
<?php use_stylesheet('data_table.css') ?>
<?php if ($sf_user->hasFlash('succes')): ?>
    <div class="flash_error">
        <?php echo $sf_user->getFlash('succes') ?>
        
    </div>
<?php endif; ?>  
<?php $i = 1 ?>
<?php if ($countdemande > 0) { ?>
<fieldset>
	
	<table  cellpadding="0" cellspacing="10" border="0" class="display" id="maTable">
		<thead>
			<tr>
				<th>Orientation</th>
				<th>Décision de la CDA</th>
				<th>Notification</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach ($demandeorientations as $demandeorientation ): ?>
			<?php if (!$demandeorientation['decisioncda'] || !$demandeorientation['datedecisioncda']): ?>
				<tr onclick="<?php echo jq_remote_function(array('url' => 'demandeorientation/edit?id=' . $demandeorientation['id'] .'&mdph_id=' .$demandeorientation['mdph_id'], 'update' => 'acc_orientation')) ?>" class="<?php echo fmod($i, 2) ? 'even' : 'odd' ?>" style="cursor: pointer">
			<?php elseif ($demandeorientation['decisioncda']): ?>
				<tr onclick="<?php echo jq_remote_function(array('url' => 'demandeorientation/edit?id=' . $demandeorientation['id'] .'&mdph_id=' .$demandeorientation['mdph_id'], 'update' => 'acc_orientation')) ?>" class="<?php echo fmod($i, 2) ? 'even' : 'odd' ?>" style="cursor: pointer">
			<?php  endif; ?>
			<td><?php echo $demandeorientation['libelleclasseext']; ?></td>
			<?php if($demandeorientation['decisioncda'] == true): ?>
				<td><?php echo 'Accepté le &nbsp;'.format_date($demandeorientation['datedecisioncda'],'dd/MM/yyyy') ?></td>
				<td><?php echo '&nbsp;&nbsp;du&nbsp;'.format_date($demandeorientation['datebutnotif'] ,'dd/MM/yyyy').'&nbsp;au&nbsp;'.format_date($demandeorientation['datefinnotif'] ,'dd/MM/yyyy') ?></td>
			<?php elseif($demandeorientation['decisioncda']==false && $demandeorientation['datedecisioncda']): ?>
				<td><?php echo 'Refusé le&nbsp;'.format_date($demandeorientation['datedecisioncda'],'dd/MM/yyyy') ?></td>
				<td></td>
			<?php elseif(!$demandeorientation['datedecisioncda']): ?>
				<td><?php echo 'Attente decision' ?></td>
				<td></td>
			<?php endif; ?>
				</tr>
				<?php $i++ ?>
			<?php endforeach; ?>
			<?php if ($i == 1): ?>
				<tr><td colspan="3" style="font-style: italic"></td></tr>
			<?php endif; ?>
		</tbody>
	</table>
</fieldset>	
<?php }else{ ?>

<?php // echo '<style="font-style: italic">Il n\'y a eeeeepas de demande d\'orientation</font><br><br>' ; ?>
 <?php } ?>



<?php
if($countdemande < 3){
//echo 'index'.$mdphId;
echo jq_button_to_remote('Nouvelle demande ', array(
    'url' => 'demandeorientation/new?mdph_id=' . $sf_request->getParameter('mdph_id'),
    'update' => 'acc_orientation',
));
}else{
echo 'Il n\'est plus posible de créer de demande , pas plus de 3 demandes d\'orientation par dossier ASH';
}
?>


