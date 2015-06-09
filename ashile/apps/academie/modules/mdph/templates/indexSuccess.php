<h1>Mdphs List</h1>

<table>
  <thead>
    <tr>
      <th>Id</th>
      <th>Eleve</th>
      <th>Datecreationpps</th>
      <th>Nbheuresavs</th>
      <th>Dateenvoiedossier</th>
      <th>Etat</th>
      <th>Dateess</th>
      <th>Datepjdom</th>
      <th>Datepjident</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($mdphs as $mdph): ?>
    <tr>
      <td><a href="<?php echo url_for('mdph/show?id='.$mdph->getId()) ?>"><?php echo $mdph->getId() ?></a></td>
      <td><?php echo $mdph->getEleveId() ?></td>
      <td><?php echo $mdph->getDatecreationpps() ?></td>
      <td><?php echo $mdph->getNbheuresavs() ?></td>
      <td><?php echo $mdph->getDateenvoiedossier() ?></td>
      <td><?php echo $mdph->getEtat() ?></td>
      <td><?php echo $mdph->getDateess() ?></td>
      <td><?php echo $mdph->getDatepjdom() ?></td>
      <td><?php echo $mdph->getDatepjident() ?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

  <a href="<?php echo url_for('mdph/new') ?>">New</a>
