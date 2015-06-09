<table>
  <tbody>
    <tr>
      <th>Id:</th>
      <td><?php echo $etabnonsco->getId() ?></td>
    </tr>
    <tr>
      <th>Quartier:</th>
      <td><?php echo $etabnonsco->getQuartierId() ?></td>
    </tr>
    <tr>
      <th>Nometabnonsco:</th>
      <td><?php echo $etabnonsco->getNometabnonsco() ?></td>
    </tr>
    <tr>
      <th>Adresseetabnonscobat:</th>
      <td><?php echo $etabnonsco->getAdresseetabnonscobat() ?></td>
    </tr>
    <tr>
      <th>Adresseetabnonscorue:</th>
      <td><?php echo $etabnonsco->getAdresseetabnonscorue() ?></td>
    </tr>
    <tr>
      <th>Teletabnonsco:</th>
      <td><?php echo $etabnonsco->getTeletabnonsco() ?></td>
    </tr>
    <tr>
      <th>Faxetabnonsco:</th>
      <td><?php echo $etabnonsco->getFaxetabnonsco() ?></td>
    </tr>
    <tr>
      <th>Emailetabnonsco:</th>
      <td><?php echo $etabnonsco->getEmailetabnonsco() ?></td>
    </tr>
  </tbody>
</table>

<hr />

<a href="<?php echo url_for('etabnonsco/edit?id='.$etabnonsco->getId()) ?>">Edit</a>
&nbsp;
<a href="<?php echo url_for('etabnonsco/index') ?>">List</a>
