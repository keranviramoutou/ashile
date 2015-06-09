<?php use_helper('jQuery');
$nul = true; ?>
<table class="show">
    <tbody>
        <?php foreach ($demandeavss as $demandeavs): ?>
            <?php $nul = false; ?>
            <tr>
                <th>Type d'avs:</th>
                <td><?php echo Doctrine_core::getTable('qualiteavs')->find($demandeavs->getqualiteavsId())->getLibellequaliteavs(); ?></td>
            </tr>
            <tr>
                <th>Date demande avs:</th>
                <td><?php echo $demandeavs->getDateDemandeAvs() ?></td>
            </tr>
            <tr>
                <th>Date decidion CDA :</th>
                <td><?php echo $demandeavs->getDatedecisioncda() ?></td>
            </tr>
            <tr>
                <th>Date decidion CDA :</th>
                <td><?php echo $demandeavs->getDatedebutnotif() ?></td>
            </tr>
            <tr>
                <th>Date decidion CDA :</th>
                <td><?php echo $demandeavs->getDatefinnotif() ?></td>
            </tr>

            <tr>
                <th>Decision CDA:</th>
		<?php if($demandeavs->getDecisioncda()==true): ?>
                	<td><?php echo 'Accepté' ?></td>
		<?php elseif($demandeavs->getDecisioncda()==false && $demandeavs->getDatedecisioncda()): ?>
			<td><?php echo 'Refusé' ?></td>
		<?php elseif(!$demandeavs->getDatedecisioncda()): ?>
			<td><?php echo 'Attente decision' ?></td>
		<?php endif; ?>
            </tr>
        <?php endforeach; ?>

    </tbody>
</table>
<?php if ($nul): ?>
    <i>Il n'y a pas encore de demande avs</i>
<?php endif; ?>
