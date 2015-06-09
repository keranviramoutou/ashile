<table>
  <tbody>
    <tr>
      <th>Id:</th>
      <td><?php echo $avs->getId() ?></td>
    </tr>
    <tr>
      <th>Quartier:</th>
      <td><?php echo $avs->getQuartierId() ?></td>
    </tr>
    <tr>
      <th>Nom:</th>
      <td><?php echo $avs->getNom() ?></td>
    </tr>
    <tr>
      <th>Prenom:</th>
      <td><?php echo $avs->getPrenom() ?></td>
    </tr>
    <tr>
      <th>Nom nais:</th>
      <td><?php echo $avs->getNomNais() ?></td>
    </tr>
    <tr>
      <th>Date naissance:</th>
      <td><?php echo $avs->getDateNaissance() ?></td>
    </tr>
    <tr>
      <th>Commentaire:</th>
      <td><?php echo $avs->getCommentaire() ?></td>
    </tr>
    <tr>
      <th>Adressebat:</th>
      <td><?php echo $avs->getAdressebat() ?></td>
    </tr>
    <tr>
      <th>Adresserue:</th>
      <td><?php echo $avs->getAdresserue() ?></td>
    </tr>
    <tr>
      <th>Tel1:</th>
      <td><?php echo $avs->getTel1() ?></td>
    </tr>
    <tr>
      <th>Tel2:</th>
      <td><?php echo $avs->getTel2() ?></td>
    </tr>
    <tr>
      <th>Email:</th>
      <td><?php echo $avs->getEmail() ?></td>
    </tr>
  </tbody>
</table>

<hr />

<a href="<?php echo url_for('avs/edit?id='.$avs->getId()) ?>">Edit</a>
&nbsp;
<a href="<?php echo url_for('avs/index') ?>">List</a>
