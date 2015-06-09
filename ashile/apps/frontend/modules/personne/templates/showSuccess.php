<table>
  <tbody>
    <tr>
      <th>Id:</th>
      <td><?php echo $personne->getId() ?></td>
    </tr>
    <tr>
      <th>Quartier:</th>
      <td><?php echo $personne->getQuartierId() ?></td>
    </tr>
    <tr>
      <th>Nompersonne:</th>
      <td><?php echo $personne->getNompersonne() ?></td>
    </tr>
    <tr>
      <th>Prenompersonne:</th>
      <td><?php echo $personne->getPrenompersonne() ?></td>
    </tr>
    <tr>
      <th>Adressepersonnebat:</th>
      <td><?php echo $personne->getAdressepersonnebat() ?></td>
    </tr>
    <tr>
      <th>Adressepersonnerue:</th>
      <td><?php echo $personne->getAdressepersonnerue() ?></td>
    </tr>
    <tr>
      <th>Tel1personne:</th>
      <td><?php echo $personne->getTel1personne() ?></td>
    </tr>
    <tr>
      <th>Tel2personne:</th>
      <td><?php echo $personne->getTel2personne() ?></td>
    </tr>
    <tr>
      <th>Emailpersonne:</th>
      <td><?php echo $personne->getEmailpersonne() ?></td>
    </tr>
    <tr>
      <th>Role:</th>
      <td><?php echo $personne->getRoleId() ?></td>
    </tr>
  </tbody>
</table>

<hr />

<a href="<?php echo url_for('personne/edit?id='.$personne->getId()) ?>">Edit</a>
&nbsp;
<a href="<?php echo url_for('personne/index') ?>">List</a>
