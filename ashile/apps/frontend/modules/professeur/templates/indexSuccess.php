<h1>Personnes List</h1>

<table>
  <thead>
    <tr>
      <th>Id</th>
      <th>Quartier</th>
      <th>Nompersonne</th>
      <th>Prenompersonne</th>
      <th>Adressepersonnebat</th>
      <th>Adressepersonnerue</th>
      <th>Tel1personne</th>
      <th>Tel2personne</th>
      <th>Emailpersonne</th>
      <th>Role</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($personnes as $personne): ?>
    <tr>
      <td><a href="<?php echo url_for('professeur/edit?id='.$personne->getId()) ?>"><?php echo $personne->getId() ?></a></td>
      <td><?php echo $personne->getQuartierId() ?></td>
      <td><?php echo $personne->getNompersonne() ?></td>
      <td><?php echo $personne->getPrenompersonne() ?></td>
      <td><?php echo $personne->getAdressepersonnebat() ?></td>
      <td><?php echo $personne->getAdressepersonnerue() ?></td>
      <td><?php echo $personne->getTel1personne() ?></td>
      <td><?php echo $personne->getTel2personne() ?></td>
      <td><?php echo $personne->getEmailpersonne() ?></td>
      <td><?php echo $personne->getRoleId() ?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

  <a href="<?php echo url_for('professeur/new') ?>">New</a>
