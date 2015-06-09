<?php use_helper('jQuery') ?>
<?php use_helper('Date') ?>

<table class="show">
    <tbody>
        <tr>
            <th>Type Materiel:</th>
            <td><?php echo Doctrine_core::getTable('Typemateriel')->find($demande_materiel->getTypematerielId()); ?></td>
        </tr>

                    <?php if($demande_materiel->getDatedecisioncda()): ?>
			<tr>
                <th>Date decision CDA:</th>
                <td><?php echo format_date($demande_materiel->getDatedecisioncda()) ?></td>
            </tr>
            <?php endif; ?>
               <tr>
               <th>Decision CDA:</th>
               <?php if($demande_materiel->getDecisioncda()==true): ?>
                        <td><?php echo 'Accepté' ?></td>
                <?php elseif($demande_materiel->getDecisioncda()==false && $demande_materiel->getDatedecisioncda()): ?>
                        <td><?php echo 'Refusé' ?></td>
                <?php elseif(!$demande_materiel->getDatedecisioncda()): ?>
                        <td><?php echo 'Attente decision' ?></td>
                <?php endif; ?>
            </tr>
    </tbody>
</table>
<?php
echo jq_button_to_remote('Retour', array(
    'url' => 'demandemateriel/index?mdph_id=' . $demande_materiel->getMdphId(),
    'update' => 'acc_materiel'
));
// si la demande a une datedecisioncda on ne peut plus modifier la demande
if (!$demande_materiel->getDatedecisioncda()):
    echo jq_button_to_remote('Modifier', array(
        'url' => 'demandemateriel/edit?id=' . $demande_materiel->getId() . '&mdph_id=' . $demande_materiel->getMdphId(),
        'update' => 'acc_materiel',
    ));
else:
   // echo '<p><br><i>La date de decision cda :</i></br></p>';
endif;
?>
