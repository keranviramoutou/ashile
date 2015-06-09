<h1>Scolarisation en milieu ordinaire</h1>
<?php use_helper('jQuery'); ?>


<?php //echo 'lo sector '.sfContext::getInstance()->getUser()->getAttribute('secteur'); ?>
<?php
if ($param == 0):
   if ($count_changesecteur = 0 ){ //pas de changement de secteur demandé
    echo jq_button_to_remote('Edition', array('url' => 'orientation/edit?id=' . $orientation->getId(), 'update' => 'div_orientation'));
	}else{
	echo 'vous avez demandé un changement de secteur, impossible de modifier la scolarité' ;
	}
    echo '&nbsp';
    echo jq_button_to_remote('Revenir à la liste', array('url' => 'orientation/index?eleve_id=' . $orientation->getEleveId(), 'update' => 'div_orientation'));
else:
    echo '&nbsp';
    echo jq_button_to_remote('Revenir à la liste', array('url' => 'orientation/index?eleve_id=' . $orientation->getEleveId(), 'update' => 'div_histo'));
endif;
?>
<fieldset>
    <legend>Détails</legend>
    <table class="show">
        <tbody>
            <tr>
                <th>Niveauscolaire :</th>
                <td>
                    <?php
                    echo $orientation->getNiveauscolaire()->getNomniveauscolaire();
                    ?>
                </td>
            </tr>
            <tr>
                <th>Orientation :</th>
                <td>
                    <?php
                    echo $orientation->getDemijournee()->getLibelledemijournee();
                    ?>
                </td>
            </tr>
            <tr>
                <th>Etablissement scolaire1 :</th>
                <td>
                    <?php
                    echo $orientation->getEtabsco();
                    ?>
                </td>
            </tr>
            <tr>
                <th>Classe :</th>
                <td>
                    <?php
                    echo $orientation->getClasse();
                    ?>
                </td>
            </tr>
            
            <tr>
                <th>Debut de scolarisation :</th> 
                <td><?php  echo Tools::convertYmdTodmY($orientation->getDatedebut()) ?></td>
                    
            </tr>
            <tr>
                <th>Fin de scolarisation :</th>
                <td><?php echo Tools::convertYmdTodmY($orientation->getDatefin()) ?></td>
            </tr>
        </tbody>
    </table>
</fieldset>
<fieldset>
    <legend>Coordonn&eacute;es de l'enseignant</legend>
    <table class="show">
        <tbody>
            <tr>
                <th>Nom :</th>
                <td>
                    <?php
                    // je crée un objet $personne avec une requete
                    $enseignant = Doctrine_core::getTable('Enseignant')->find($orientation->getEnseignantId());
                    // Si la requete trouve un enregistrement (personne), on l'affiche
                    if ($enseignant)
                        echo $enseignant->getNom();
                    ?>
                </td>
            </tr>
            <tr>
                <th>Prenom :</th>
                <td><?php if ($enseignant) echo $enseignant->getPrenom(); ?></td>
            </tr>
            <tr>
                <th>Telephone 1 :</th>
                <td><?php if ($enseignant) echo $enseignant->getTel1(); ?></td>
            </tr>
        </tbody>
    </table>
</fieldset>
<fieldset>
    <legend>Classe inclusion</legend>
    <table class="show">
        <tbody>
            <tr>
                <th>Classe :</th>
			<td><?php
		            // je crée un objet $inclusion avec une requete
		            $inclusion = Doctrine_core::getTable('Inclusion')->find($orientation->getInclusionId());
		            // Si la requete trouve un enregistrement (personne), on l'affiche
		            if ($inclusion)
		                echo $inclusion->getClasse();
		            ?>
                	</td>
	   </tr>
	   <tr>			
		<th>Temsp inclusion :</th>
			<td><?php 
				if($inclusion)
				echo $inclusion->getTemspclasseintegration();
				?>
			</td>
	    </tr>
	</body>
   </table>
</fieldset>		
<hr />

