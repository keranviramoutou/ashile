<?php use_helper('Date') ?>


<?php if ($countbilans > 0) { ?>
<?php $i = 1 ?>

<table class="tabList">
    <thead>
        <tr>
            <th>Partenaire </th>
            <th>Libellé du bilan</th>
            <th>Date du bilan</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($bilans as $bilan): ?>
            <tr>
                <td><center><?php //echo $bilan->getPersonne().' ('.Doctrine::getTable('Role')
				//				->find($bilan->getPersonne()->getRole())
				//				->getLibellerole().')' 
			echo $bilan->getSpecialiste();
		?></center></td>
                <td><center><?php echo $bilan->getNaturebilan() ?></center></td>
                <td><center><?php echo format_date($bilan->getDateBilan(), 'dd/MM/yyyy') ?></center></td>
            </tr>
            <?php $i++ ?>
        <?php endforeach; ?>
        <?php if ($i == 1): ?>
            <tr><td colspan="4" style="font-style: italic">Il n'y a pas de bilan</td></tr>
        <?php endif; ?>
    </tbody>
</table>
<?php }else{ ?>

<?php echo '<span style="font-weight:normal;">Il n\'y a pas bilan</font>' ; ?>
 <?php } ?>
