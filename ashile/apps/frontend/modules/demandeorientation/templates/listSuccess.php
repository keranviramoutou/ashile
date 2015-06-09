<?php use_helper('Date') ?>
<?php if ($countdemande > 0) { ?>
<?php $i = 1 ?>
<table class="tabList">
    <thead>
        <tr>
		 <th>Orientation</th>
	     <th>Décision de la CDA</th>
		 <th>Notification</th>
		 <th>Notes</th>		
        </tr>
    </thead>
    <tbody>
        <?php foreach ($demandeorientations as $demandeorientation): ?>
		<tr>
			<td><center><?php echo $demandeorientation['libelleclasseext']; ?></center></td>
			<?php if($demandeorientation['decisioncda'] == true): ?>
				<td><center><?php echo 'Accepté le &nbsp;'.format_date($demandeorientation['datedecisioncda'],'dd/MM/yyyy') ?></center></td>
				<td><center><?php echo '&nbsp;&nbsp;du&nbsp;'.format_date($demandeorientation['datebutnotif'] ,'dd/MM/yyyy').'&nbsp;au&nbsp;'.format_date($demandeorientation['datefinnotif'] ,'dd/MM/yyyy') ?></center></td>
			<?php elseif($demandeorientation['decisioncda']==false && $demandeorientation['datedecisioncda']): ?>
				<td><center><?php echo 'Refusé le&nbsp;'.format_date($demandeorientation['datedecisioncda'],'dd/MM/yyyy') ?></center></center></td>
				<td></td>
			<?php elseif(!$demandeorientation['datedecisioncda']): ?>
				<td><center><?php echo 'Attente decision' ?></center></td>
				<td></center></td>
			<?php endif; ?>
			   
			<td><center><?php echo $demandeorientation['notes'] ; ?></center></td>
	    </tr>	
            <?php $i++ ?>
        <?php endforeach; ?>
        <?php if ($i == 1): ?>
            <tr><center><td colspan="3" style="font-style: italic">Il n'y a pas de demande orientation</center></td></tr>
        <?php endif; ?>
    </tbody>
</table>
<?php }else{ ?>

<?php echo '<span style="font-weight:normal;">Il n\'y a pas de demande d\'orientation</font>' ; ?>
 <?php } ?>
