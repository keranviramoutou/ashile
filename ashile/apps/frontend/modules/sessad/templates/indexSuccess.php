<h1>Sessads List</h1>

<table>
  <thead>
    <tr>
      <th>Id</th>
      <th>Etabnonsco</th>
      <th>Typesessad</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($sessads as $sessad): ?>
    <tr>
      <td><a href="<?php echo url_for('sessad/edit?id='.$sessad->getId()) ?>"><?php echo $sessad->getId() ?></a></td>
      <td><?php echo $sessad->getEtabnonscoId() ?></td>
      <td><?php echo $sessad->getTypesessadId() ?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

  <a href="<?php echo url_for('sessad/new') ?>">New</a>
