<h1>Personnel etabnonscos List</h1>

<table>
  <thead>
    <tr>
      <th>Id</th>
      <th>Etabnonsco</th>
      <th>Personne</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($personnel_etabnonscos as $personnel_etabnonsco): ?>
    <tr>
      <td><a href="<?php echo url_for('personneletabnonsco/show?id='.$personnel_etabnonsco->getId()) ?>"><?php echo $personnel_etabnonsco->getId() ?></a></td>
      <td><?php echo $personnel_etabnonsco->getEtabnonscoId() ?></td>
      <td><?php echo $personnel_etabnonsco->getPersonneId() ?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

  <a href="<?php echo url_for('personneletabnonsco/new') ?>">New</a>
