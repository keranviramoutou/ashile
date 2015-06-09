<h1>Inclusions List</h1>

<table>
  <thead>
    <tr>
      <th>Id</th>
      <th>Classe</th>
      <th>Temps en classe integration</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($inclusions as $inclusion): ?>
    <tr>
      <td><a href="<?php echo url_for('inclusion/show?id='.$inclusion->getId()) ?>"><?php echo $inclusion->getId() ?></a></td>
      <td><?php echo $inclusion->getClasseId() ?></td>
      <td><?php echo $inclusion->getTemspclasseintegration() ?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

  <a href="<?php echo url_for('inclusion/new') ?>">New</a>
