<h1>Enseignants List</h1>

<table>
  <thead>
    <tr>
      <th>Id</th>
      <th>Quartier</th>
      <th>Nom</th>
      <th>Prenom</th>
      <th>Adressebat</th>
      <th>Adresserue</th>
      <th>Tel1</th>
      <th>Tel2</th>
      <th>Email</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($enseignants as $enseignant): ?>
    <tr>
      <td><a href="<?php echo url_for('enseignant/edit?id='.$enseignant->getId()) ?>"><?php echo $enseignant->getId() ?></a></td>
      <td><?php echo $enseignant->getQuartierId() ?></td>
      <td><?php echo $enseignant->getNom() ?></td>
      <td><?php echo $enseignant->getPrenom() ?></td>
      <td><?php echo $enseignant->getAdressebat() ?></td>
      <td><?php echo $enseignant->getAdresserue() ?></td>
      <td><?php echo $enseignant->getTel1() ?></td>
      <td><?php echo $enseignant->getTel2() ?></td>
      <td><?php echo $enseignant->getEmail() ?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

  <a href="<?php echo url_for('enseignant/new') ?>">New</a>
