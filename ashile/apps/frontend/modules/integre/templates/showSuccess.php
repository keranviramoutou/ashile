<table>
  <tbody>
    <tr>
      <th>Equipesuiviscolarite:</th>
      <td><?php echo $integre->getEquipesuiviscolariteId() ?></td>
    </tr>
    <tr>
      <th>Specialiste:</th>
      <td><?php echo $integre->getSpecialisteId() ?></td>
    </tr>
  </tbody>
</table>

<hr />

<a href="<?php echo url_for('integre/edit?equipesuiviscolarite_id='.$integre->getEquipesuiviscolariteId().'&specialiste_id='.$integre->getSpecialisteId()) ?>">Edit</a>
&nbsp;
<a href="<?php echo url_for('integre/index') ?>">List</a>
