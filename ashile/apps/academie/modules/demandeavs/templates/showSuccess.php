<?php use_helper('jQuery');
$nul = true; ?>
<table class="show">
    <tbody>
        <?php foreach ($demandeavss as $demandeavs): ?>
            <?php $nul = false; ?>
            <tr>
                <th>Type d'avs:</th>
                <td><?php echo Doctrine_core::getTable('qualiteavs')->findOneById($demandeavs->getqualiteavsId())->getNaturecontrat(); ?></td>
            </tr>
            <tr>
                <th>Date demande avs:</th>
                <td><?php echo $demandeavs->getDateDemandeAvs() ?></td>
            </tr>
            <?php if($demandeavs->getDatedecisioncda()): ?>
	    <tr>
                <th>Date decision CDA:</th>
                <td><?php echo $demandeavs->getDatedecisioncda(); ?></td>
            </tr>
	    <?php endif; ?>
            <?php if($demandeavs->getDecisioncda()): ?>
	    <tr>
                <th>Decision Avs:</th>
		<?php if($demandeavs->getDecisioncda()==true): ?>
                	<td><?php echo 'Accepté' ?></td>
		<?php elseif($demandeavs->getDecisioncda()==false && $demandeavs->getDatedecisioncda()): ?>
			<td><?php echo 'Refusé' ?></td>
		<?php endif; ?>
            </tr>
	    <?php endif; ?>	
        <?php endforeach; ?>

    </tbody>
</table>
<?php
if ($nul):
    echo '<i>Il n\'y a pas de demande avs</i>';
    echo jq_button_to_remote('Nouvelle demande avs', array(
        'url' => 'demandeavs/new?mdph_id=' . $sf_request->getParameter('mdph_id'),
        'update' => 'acc_avs',
    ));
else:
	// si la demande a une datedecisioncda on ne peut plus modifier la demande
	if(!$demandeavs->getDatedecisioncda()):
    echo jq_button_to_remote('Modifier', array(
        'url' => 'demandeavs/edit?id=' . $demandeavs->getId(),
        'update' => 'acc_avs',
    ));
	endif;
endif;
?>
<br />
<?php
?>
