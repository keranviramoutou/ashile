<table>
  <tbody>
    <tr>
      <th>Id:</th>
      <td><?php echo $orientation->getId() ?></td>
    </tr>
    <tr>
      <th>Niveaudgesco:</th>
      <td><?php echo $orientation->getNiveaudgescoId() ?></td>
    </tr>
    <tr>
      <th>Niveauscolaire:</th>
      <td><?php echo $orientation->getNiveauscolaireId() ?></td>
    </tr>
    <tr>
      <th>Libelleclasse:</th>
      <td><?php echo $orientation->getLibelleclasse() ?></td>
    </tr>
    <tr>
      <th>Demijournee:</th>
      <td><?php echo $orientation->getDemijourneeId() ?></td>
    </tr>
    <tr>
      <th>Eleve:</th>
      <td><?php echo $orientation->getEleveId() ?></td>
    </tr>
    <tr>
      <th>Classe:</th>
      <td><?php echo $orientation->getClasseId() ?></td>
    </tr>
    <tr>
      <th>Inclusion:</th>
      <td><?php echo $orientation->getInclusionId() ?></td>
    </tr>
    <tr>
      <th>Enseignant:</th>
      <td><?php echo $orientation->getEnseignantId() ?></td>
    </tr>
    <tr>
      <th>Etabsco:</th>
      <td><?php echo $orientation->getEtabscoId() ?></td>
    </tr>
    <tr>
      <th>Datedebut:</th>
      <td><?php echo $orientation->getDatedebut() ?></td>
    </tr>
    <tr>
      <th>Datefin:</th>
      <td><?php echo $orientation->getDatefin() ?></td>
    </tr>
  </tbody>
</table>

<hr />

<a href="<?php echo url_for('orientation/edit?id='.$orientation->getId()) ?>">Edit</a>
&nbsp;
<a href="<?php echo url_for('orientation/index') ?>">List</a>
