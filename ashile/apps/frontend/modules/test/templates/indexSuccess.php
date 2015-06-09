<h1>Demandesessads List</h1>

<table>
  <thead>
    <tr>
      <th>Id</th>
      <th>Mdph</th>
      <th>Typesessad</th>
      <th>Date demande sessad</th>
      <th>Datedebutnotif</th>
      <th>Datefinnotif</th>
      <th>Datedecisioncda</th>
      <th>Decisioncda</th>
      <th>Traite</th>
      <th>Etat</th>
      <th>Notes</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($demandesessads as $demandesessad): ?>
    <tr>
      <td><a href="<?php echo url_for('test/show?id='.$demandesessad->getId()) ?>"><?php echo $demandesessad->getId() ?></a></td>
      <td><?php echo $demandesessad->getMdphId() ?></td>
      <td><?php echo $demandesessad->getTypesessadId() ?></td>
      <td><?php echo $demandesessad->getDateDemandeSessad() ?></td>
      <td><?php echo $demandesessad->getDatedebutnotif() ?></td>
      <td><?php echo $demandesessad->getDatefinnotif() ?></td>
      <td><?php echo $demandesessad->getDatedecisioncda() ?></td>
      <td><?php echo $demandesessad->getDecisioncda() ?></td>
      <td><?php echo $demandesessad->getTraite() ?></td>
      <td><?php echo $demandesessad->getEtat() ?></td>
      <td><?php echo $demandesessad->getNotes() ?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

  <a href="<?php echo url_for('test/new') ?>">New</a>
