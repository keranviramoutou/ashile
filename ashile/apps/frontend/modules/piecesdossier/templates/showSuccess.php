
<table>
  <tbody>
    <tr>
      <th>Id:</th>
      <td><?php echo $pieces_dossier->getId() ?></td>
    </tr>
    <tr>
      <th>Eleve:</th>
      <td><?php echo $pieces_dossier->getEleveId() ?></td>
    </tr>
    <tr>
      <th>Libellepiece:</th>
      <td><?php echo $pieces_dossier->getLibellepiece() ?></td>
    </tr>
    <tr>
      <th>Restitue:</th>
      <td><?php echo $pieces_dossier->getRestitue() ?></td>
    </tr>
  </tbody>
</table>

<a href="<?php echo url_for('piecesdossier/edit?id='.$pieces_dossier->getId()) ?>">Edit</a>
&nbsp;
<a href="<?php echo url_for('piecesdossier/index') ?>">List</a>
