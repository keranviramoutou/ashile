<h1>Mouvement materiels List</h1>

<table>
  <thead>
    <tr>
      <th>Id</th>
      <th>Materiel</th>
      <th>Mouvement</th>
      <th>Datedebut</th>
      <th>Datefin</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($mouvement_materiels as $mouvement_materiel): ?>
    <tr>
      <td><a href="<?php echo url_for('mouvement_materiel/edit?id='.$mouvement_materiel->getId()) ?>"><?php echo $mouvement_materiel->getId() ?></a></td>
      <td><?php echo $mouvement_materiel->getMaterielId() ?></td>
      <td><?php echo $mouvement_materiel->getMouvementId() ?></td>
      <td><?php echo $mouvement_materiel->getDatedebut() ?></td>
      <td><?php echo $mouvement_materiel->getDatefin() ?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

  <a href="<?php echo url_for('mouvement_materiel/new') ?>">New</a>
