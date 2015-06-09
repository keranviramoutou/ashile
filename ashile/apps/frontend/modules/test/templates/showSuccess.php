<table>
  <tbody>
    <tr>
      <th>Id:</th>
      <td><?php echo $demandesessad->getId() ?></td>
    </tr>
    <tr>
      <th>Mdph:</th>
      <td><?php echo $demandesessad->getMdphId() ?></td>
    </tr>
    <tr>
      <th>Typesessad:</th>
      <td><?php echo $demandesessad->getTypesessadId() ?></td>
    </tr>
    <tr>
      <th>Date demande sessad:</th>
      <td><?php echo $demandesessad->getDateDemandeSessad() ?></td>
    </tr>
    <tr>
      <th>Datedebutnotif:</th>
      <td><?php echo $demandesessad->getDatedebutnotif() ?></td>
    </tr>
    <tr>
      <th>Datefinnotif:</th>
      <td><?php echo $demandesessad->getDatefinnotif() ?></td>
    </tr>
    <tr>
      <th>Datedecisioncda:</th>
      <td><?php echo $demandesessad->getDatedecisioncda() ?></td>
    </tr>
    <tr>
      <th>Decisioncda:</th>
      <td><?php echo $demandesessad->getDecisioncda() ?></td>
    </tr>
    <tr>
      <th>Traite:</th>
      <td><?php echo $demandesessad->getTraite() ?></td>
    </tr>
    <tr>
      <th>Etat:</th>
      <td><?php echo $demandesessad->getEtat() ?></td>
    </tr>
    <tr>
      <th>Notes:</th>
      <td><?php echo $demandesessad->getNotes() ?></td>
    </tr>
  </tbody>
</table>

<hr />

<a href="<?php echo url_for('test/edit?id='.$demandesessad->getId()) ?>">Edit</a>
&nbsp;
<a href="<?php echo url_for('test/index') ?>">List</a>
