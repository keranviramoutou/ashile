<table>
  <tbody>
    <tr>
      <th>Id:</th>
      <td><?php echo $demande_orientation->getId() ?></td>
    </tr>
    <tr>
      <th>Mdph:</th>
      <td><?php echo $demande_orientation->getMdphId() ?></td>
    </tr>
    <tr>
      <th>Classeext:</th>
      <td><?php echo $demande_orientation->getClasseextId() ?></td>
    </tr>
    <tr>
      <th>Demijournee:</th>
      <td><?php echo $demande_orientation->getDemijourneeId() ?></td>
    </tr>
    <tr>
      <th>Date demande orientation:</th>
      <td><?php echo $demande_orientation->getDateDemandeOrientation() ?></td>
    </tr>
    <tr>
      <th>Datedecisioncda:</th>
      <td><?php echo $demande_orientation->getDatedecisioncda() ?></td>
    </tr>
    <tr>
      <th>Decisioncda:</th>
      <td><?php echo $demande_orientation->getDecisioncda() ?></td>
    </tr>
    <tr>
      <th>Traite:</th>
      <td><?php echo $demande_orientation->getTraite() ?></td>
    </tr>
    <tr>
      <th>Etat:</th>
      <td><?php echo $demande_orientation->getEtat() ?></td>
    </tr>
    <tr>
      <th>Notes:</th>
      <td><?php echo $demande_orientation->getNotes() ?></td>
    </tr>
  </tbody>
</table>

<hr />

<a href="<?php echo url_for('demandeorientation/edit?id='.$demande_orientation->getId()) ?>">Edit</a>
&nbsp;
<a href="<?php echo url_for('demandeorientation/index') ?>">List</a>
