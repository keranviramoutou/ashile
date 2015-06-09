<h1>Typescos List</h1>

<table>
  <thead>
    <tr>
      <th>Id</th>
      <th>Type</th>
      <th>Modsconouveaunom</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($typescos as $typesco): ?>
    <tr>
      <td><a href="<?php echo url_for('typesco/show?id='.$typesco->getId()) ?>"><?php echo $typesco->getId() ?></a></td>
      <td><?php echo $typesco->getType() ?></td>
      <td><?php echo $typesco->getModsconouveaunom() ?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

  <a href="<?php echo url_for('typesco/new') ?>">New</a>
