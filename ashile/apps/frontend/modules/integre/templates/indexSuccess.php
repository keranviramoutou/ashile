<h1>Integres List</h1>

<table>
  <thead>
    <tr>
      <th>Equipesuiviscolarite</th>
      <th>Specialiste</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($integres as $integre): ?>
    <tr>
      <td><a href="<?php echo url_for('integre/show?equipesuiviscolarite_id='.$integre->getEquipesuiviscolariteId().'&specialiste_id='.$integre->getSpecialisteId()) ?>"><?php echo $integre->getEquipesuiviscolariteId() ?></a></td>
      <td><a href="<?php echo url_for('integre/show?equipesuiviscolarite_id='.$integre->getEquipesuiviscolariteId().'&specialiste_id='.$integre->getSpecialisteId()) ?>"><?php echo $integre->getSpecialisteId() ?></a></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

  <a href="<?php echo url_for('integre/new') ?>">New</a>
