<table>
  <tbody>
    <tr>
      <th>Id:</th>
      <td><?php echo $eleve->getId() ?></td>
    </tr>
    <tr>
      <th>Niveau scolaire:</th>
      <td><?php //echo ($eleve->getNomniveauscolaireId()); 
           echo Doctrine_core::getTable('niveauscolaire')->findOneById( $eleve->getNomniveauscolaireId());
      ?></td>
    </tr>
    <tr>
      <th>Commune:</th>
      <td><?php //echo $eleve->getCommuneId()
            echo Doctrine_core::getTable('commune')->findOneById( $eleve->getCommuneId() );
      ?></td>
    </tr>
    <tr>
      <th>Ine:</th>
      <td><?php echo $eleve->getIne() ?></td>
    </tr>
    <tr>
      <th>Nom:</th>
      <td><?php echo $eleve->getNom() ?></td>
    </tr>
    <tr>
      <th>Prenom:</th>
      <td><?php echo $eleve->getPrenom() ?></td>
    </tr>
    <tr>
      <th>Date de naissance:</th>
      <td>  <?php echo format_date($eleve->getDatenaissance(),'dd/MM/yyyy') ?> </td>
    </tr>
    <tr>
      <th>Situation:</th>
      <td><?php echo $eleve->getSituationeleve() ?></td>
    </tr>
    <tr>
      <th>Adresse batiment:</th>
      <td><?php echo $eleve->getAdresseelevebat() ?></td>
    </tr>
    <tr>
      <th>Adresse rue:</th>
      <td><?php echo $eleve->getAdresseleverue() ?></td>
    <tr>
      <th>Sexe:</th>
      <td><?php  
                if($eleve->getSexe()=='G'): echo 'Garçon';
                else : echo 'Fille';
                endif; 
      ?></td>
    </tr>
  </tbody>
</table>

<hr />

<a href="<?php echo url_for('eleve/edit?id='.$eleve->getId()) ?>">Edition</a>
&nbsp;
<a href="<?php echo url_for('eleve/index') ?>">Liste</a>
