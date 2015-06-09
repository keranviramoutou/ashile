<h1>Informations sur le responsable</h1>
<?php use_helper('jQuery') ?>
<fieldset>
    <legend>Détails</legend>
    <table class="show">
        <tbody>
            <tr><th>Représentant légal :</th><td><?php echo $tuteur->getTuteurlegal() == 1 ? 'Oui' : 'Non' ?></td></tr>
            <tr><th>Lien parental:</th><td><?php echo $tuteur->getTypeResponsableEleve() ?></td></tr>
			 <tr><th>Lien autre :</th><td><?php echo $tuteur->getAutretyperesponsable() ?></td></tr>
        </tbody>
    </table>
</fieldset>
<?php $coord = $tuteur->getResponsableEleve() ?>
<fieldset>
    <legend>Coordonn&eacute;es</legend>
    <table class="show">
        <tbody>
            <tr><th>Nom :</th><td><?php echo $coord->getNom() ?></td></tr>
            <tr><th>Prenom :</th><td><?php echo $coord->getPrenom(); ?></td></tr>
            <tr><th>Adresse :</th><td><?php echo $coord->getAdressebat(); ?></td></tr>
            <tr><th>n° de rue ou chemin :</th><td><?php echo $coord->getAdresserue(); ?></td></tr>
            <tr><th>Commune :</th><td><?php echo $coord->getQuartier() ?></td></tr>
            <tr><th>Telephone 1 :</th><td><?php echo $coord->getTel1(); ?></td></tr>
            <tr><th>Telephone 2 :</th><td><?php echo $coord->getTel2(); ?></td></tr>
            <tr><th>E-mail :</th><td><?php echo $coord->getEmail(); ?></td></tr>
        </tbody>
    </table>
</fieldset>
<hr />
<?php echo jq_button_to_remote('Edition', array('url' => 'tuteur/edit?eleve_id=' . $tuteur->getEleveId() . '&responsableeleve_id=' . $tuteur->getResponsableeleveId(), 'update' => 'div_tuteur')) ?>
&nbsp;
<?php echo jq_button_to_remote('Retour à la liste', array('url' => 'tuteur/index?eleve_id=' . $tuteur->getEleveId() . '&responsableeleve_id=' . $tuteur->getResponsableeleveId(), 'update' => 'div_tuteur')) ?>
