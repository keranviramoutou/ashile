<table>
  <tbody>
    <tr>
      <th>Id:</th>
      <td><?php echo $personnel_etabnonsco->getId() ?></td>
    </tr>
    <tr>
      <th>Etabnonsco:</th>
      <td><?php echo $personnel_etabnonsco->getEtabnonscoId() ?></td>
    </tr>
    <tr>
      <th>Personne:</th>
      <td><?php echo $personnel_etabnonsco->getPersonneId() ?></td>
    </tr>
  </tbody>
</table>

<hr />

<a href="<?php echo url_for('personneletabnonsco/edit?id='.$personnel_etabnonsco->getId()) ?>">Edit</a>
&nbsp;
<a href="<?php echo url_for('personneletabnonsco/index') ?>">List</a>
