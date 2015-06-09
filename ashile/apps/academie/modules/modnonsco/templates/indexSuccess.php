<h1>Modnonscos List</h1>

<table>
  <thead>
    <tr>
      <th>Id</th>
      <th>Eleve</th>
      <th>Etabnonsco</th>
      <th>Demijournee</th>
      <th>Classespe</th>
      <th>Quothorreff</th>
      <th>Datedebut</th>
      <th>Datefin</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($modnonscos as $modnonsco): ?>
    <tr>
      <td><a href="<?php echo url_for('modnondco/show?id='.$modnonsco->getId()) ?>"><?php echo $modnonsco->getId() ?></a></td>
      <td><?php echo $modnonsco->getEleveId() ?></td>
      <td><?php echo $modnonsco->getEtabnonscoId() ?></td>
      <td><?php echo $modnonsco->getDemijourneeId() ?></td>
      <td><?php echo $modnonsco->getClassespeId() ?></td>
      <td><?php echo $modnonsco->getQuothorreff() ?></td>
      <td><?php echo $modnonsco->getDatedebut() ?></td>
      <td><?php echo $modnonsco->getDatefin() ?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

  <a href="<?php echo url_for('modnondco/new') ?>">New</a>
