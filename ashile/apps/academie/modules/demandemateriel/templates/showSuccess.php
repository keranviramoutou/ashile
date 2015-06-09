<table>
  <tbody>
    <tr>
      <th>Id:</th>
      <td><?php echo $demande_materiel->getId() ?></td>
    </tr>
    <tr>
      <th>Mdph:</th>
      <td><?php echo $demande_materiel->getMdphId() ?></td>
    </tr>
    <tr>
      <th>Typemateriel:</th>
      <td><?php echo $demande_materiel->getTypematerielId() ?></td>
    </tr>
    <tr>
      <th>Date demande materiel:</th>
      <td><?php echo $demande_materiel->getDateDemandeMateriel() ?></td>
    </tr>
    <tr>
      <th>Datedecisioncda:</th>
      <td><?php echo $demande_materiel->getDatedecisioncda() ?></td>
    </tr>
    <tr>
      <th>Decisioncda:</th>
      <td><?php echo $demande_materiel->getDecisioncda() ?></td>
    </tr>
    <tr>
      <th>Traite:</th>
      <td><?php echo $demande_materiel->getTraite() ?></td>
    </tr>
    <tr>
      <th>Etat:</th>
      <td><?php echo $demande_materiel->getEtat() ?></td>
    </tr>
    <tr>
      <th>Notes:</th>
      <td><?php echo $demande_materiel->getNotes() ?></td>
    </tr>
  </tbody>
</table>

<hr />

<a href="<?php echo url_for('demandemateriel/edit?id='.$demande_materiel->getId()) ?>">Edit</a>
&nbsp;
<a href="<?php echo url_for('demandemateriel/index') ?>">List</a>
