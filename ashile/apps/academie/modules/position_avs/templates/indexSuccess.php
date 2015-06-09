<h1>Position avss List</h1>

<table>
  <thead>
    <tr>
      <th>Id</th>
      <th>Contratavs</th>
      <th>Typepositionavs</th>
      <th>Datedebut</th>
      <th>Datefin</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($position_avss as $position_avs): ?>
    <tr>
      <td><a href="<?php echo url_for('position_avs/show?id='.$position_avs->getId()) ?>"><?php echo $position_avs->getId() ?></a></td>
      <td><?php echo $position_avs->getContratavsId() ?></td>
      <td><?php echo $position_avs->getTypepositionavsId() ?></td>
      <td><?php echo $position_avs->getDatedebut() ?></td>
      <td><?php echo $position_avs->getDatefin() ?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

  <a href="<?php echo url_for('position_avs/new') ?>">New</a>
