<table>
  <tbody>
    <tr>
      <th>Id:</th>
      <td><?php echo $classe->getId() ?></td>
    </tr>
    <tr>
      <th>Etabsco:</th>
      <td><?php echo $classe->getEtabscoId() ?></td>
    </tr>
    <tr>
      <th>Libelle classe:</th>
      <td><?php echo $classe->getLibelleClasse() ?></td>
    </tr>
  </tbody>
</table>

<hr />

<a href="<?php echo url_for('classe/edit?id='.$classe->getId()) ?>">Edit</a>
&nbsp;
<a href="<?php echo url_for('classe/index') ?>">List</a>
