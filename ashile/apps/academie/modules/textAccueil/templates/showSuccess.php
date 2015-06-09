<table>
  <tbody>
    <tr>
      <th>Id:</th>
      <td><?php echo $accueil->getId() ?></td>
    </tr>
    <tr>
      <th>Type:</th>
      <td><?php echo $accueil->getType() ?></td>
    </tr>
  </tbody>
</table>

<hr />

<a href="<?php echo url_for('textAccueil/edit?id='.$accueil->getId()) ?>">Edit</a>
&nbsp;
<a href="<?php echo url_for('textAccueil/index') ?>">List</a>
