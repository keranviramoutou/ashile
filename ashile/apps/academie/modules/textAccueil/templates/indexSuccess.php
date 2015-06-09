<h1>Liste des messages généraux</h1>

<table>
  <thead>
    <tr>
      <th>Id</th>
      <th>Message</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($accueils as $accueil): ?>
    <tr>
      <td><a href="<?php echo url_for('textAccueil/show?id='.$accueil->getId()) ?>"><?php echo $accueil->getId() ?></a></td>
      <td><?php echo $accueil->getType() ?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

  <a href="<?php echo url_for('textAccueil/new') ?>">New</a>
