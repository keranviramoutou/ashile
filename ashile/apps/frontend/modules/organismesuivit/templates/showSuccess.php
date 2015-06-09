<table>
  <tbody>
    <tr>
      <th>Id:</th>
      <td><?php echo $organisme_suivit->getId() ?></td>
    </tr>
    <tr>
      <th>Libellesuivit:</th>
      <td><?php echo $organisme_suivit->getLibellesuivit() ?></td>
    </tr>
    <tr>
      <th>Secteur:</th>
      <td><?php echo $organisme_suivit->getSecteurId() ?></td>
    </tr>
  </tbody>
</table>

<hr />

<a href="<?php echo url_for('organismesuivit/edit?id='.$organisme_suivit->getId()) ?>">Edit</a>
&nbsp;
<a href="<?php echo url_for('organismesuivit/index') ?>">List</a>
