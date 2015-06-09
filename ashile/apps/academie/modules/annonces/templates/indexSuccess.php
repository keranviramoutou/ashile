<h1>Accueils List</h1>

<table>
  <thead>
    <tr>
      <th>Id</th>
      <th>Type</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($accueils as $accueil): ?>
    <tr>
      <td><a href="<?php echo url_for('annonces/edit?id='.$accueil->getId()) ?>"><?php echo $accueil->getId() ?></a></td>
      <td><?php echo $accueil->getType() ?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

  <a href="<?php echo url_for('annonces/new') ?>">New</a>
