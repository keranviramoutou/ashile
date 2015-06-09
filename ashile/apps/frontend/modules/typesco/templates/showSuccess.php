<table>
  <tbody>
    <tr>
      <th>Id:</th>
      <td><?php echo $typesco->getId() ?></td>
    </tr>
    <tr>
      <th>Type:</th>
      <td><?php echo $typesco->getType() ?></td>
    </tr>
    <tr>
      <th>Modsconouveaunom:</th>
      <td><?php echo $typesco->getModsconouveaunom() ?></td>
    </tr>
  </tbody>
</table>

<hr />

<a href="<?php echo url_for('typesco/edit?id='.$typesco->getId()) ?>">Edit</a>
&nbsp;
<a href="<?php echo url_for('typesco/index') ?>">List</a>
