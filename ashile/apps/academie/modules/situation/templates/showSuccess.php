<table>
  <tbody>
    <tr>
      <th>Id:</th>
      <td><?php echo $situation->getId() ?></td>
    </tr>
    <tr>
      <th>Situation:</th>
      <td><?php echo $situation->getSituation() ?></td>
    </tr>
  </tbody>
</table>

<hr />

<a href="<?php echo url_for('situation/edit?id='.$situation->getId()) ?>">Edit</a>
&nbsp;
<a href="<?php echo url_for('situation/index') ?>">List</a>
