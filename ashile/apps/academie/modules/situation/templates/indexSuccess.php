<h1>Situations List</h1>

<table>
  <thead>
    <tr>
      <th>Id</th>
      <th>Situation</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($situations as $situation): ?>
    <tr>
      <td><a href="<?php echo url_for('situation/show?id='.$situation->getId()) ?>"><?php echo $situation->getId() ?></a></td>
      <td><?php echo $situation->getSituation() ?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

  <a href="<?php echo url_for('situation/new') ?>">New</a>
