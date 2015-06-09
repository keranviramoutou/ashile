<h1>Naturesuiviexts List</h1>

<table>
  <thead>
    <tr>
      <th>Id</th>
      <th>Libellenaturesuiviext</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($naturesuiviexts as $naturesuiviext): ?>
    <tr>
      <td><a href="<?php echo url_for('naturesuivitext/edit?id='.$naturesuiviext->getId()) ?>"><?php echo $naturesuiviext->getId() ?></a></td>
      <td><?php echo $naturesuiviext->getLibellenaturesuiviext() ?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

  <a href="<?php echo url_for('naturesuivitext/new') ?>">New</a>
