
<br><h3>Dossier MDPH > Demande d'accompagnant > Affectation des ressources </h3>
<?php //use_helper('jQuery') ?>
<?php //$eleve = ""; ?>

<table class="tabulaire">
    <thead>
        <tr>
            <th>Eleve</th>
            <th>Nature contrat AVS</th>
            <th>Date d'envoi du dossier</th>		
        </tr>
    </thead>
    <tbody>
        <?php foreach ($demandeavss as $demandeavs): ?>
            <!-- je cherche eleve -->

            <?php 
            $mdph = $demandeavs->getMdphId();
            $eleve = Doctrine_core::getTable('Eleve')->findOneById(Doctrine_core::getTable('Mdph')
                            ->find($mdph)
                            ->getEleveId());
            ?>

            <tr onClick="window.location='<?php echo url_for('@Eleveavs?eleve_id=' . $eleve->getId()) ?>'">

                <td><?php echo '(' . $eleve->getIne() . ')' . $eleve->getNom() . '.' . $eleve->getPrenom(); ?></td>
                <td><?php echo $demandeavs->getNaturecontratavs() ?></td>
                <td><?php echo $demandeavs->getDateDemandeAvs() ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

