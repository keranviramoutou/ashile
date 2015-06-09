<h1>Avss List</h1>

<table>
  <thead>
    <tr>
      <th>Id</th>
      <th>Quartier</th>
      <th>Nom</th>
      <th>Prenom</th>
      <th>Nom nais</th>
      <th>Date naissance</th>
      <th>Commentaire</th>
      <th>Adressebat</th>
      <th>Adresserue</th>
      <th>Tel1</th>
      <th>Tel2</th>
      <th>Email</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($avss as $avs): ?>
    <tr>
      <td><a href="<?php echo url_for('avs/show?id='.$avs->getId()) ?>"><?php echo $avs->getId() ?></a></td>
      <td><?php echo $avs->getQuartierId() ?></td>
      <td><?php echo $avs->getNom() ?></td>
      <td><?php echo $avs->getPrenom() ?></td>
      <td><?php echo $avs->getNomNais() ?></td>
      <td><?php echo $avs->getDateNaissance() ?></td>
      <td><?php echo $avs->getCommentaire() ?></td>
      <td><?php echo $avs->getAdressebat() ?></td>
      <td><?php echo $avs->getAdresserue() ?></td>
      <td><?php echo $avs->getTel1() ?></td>
      <td><?php echo $avs->getTel2() ?></td>
      <td><?php echo $avs->getEmail() ?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

  <a href="<?php echo url_for('avs/new') ?>">New</a>
