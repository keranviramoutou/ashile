<h1>Classes List</h1>

<table>
  <thead>
    <tr>
      <th>Id</th>
      <th>Etabsco</th>
      <th>Libelle classe</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($classes as $classe): ?>
    <tr>
      <td><a href="<?php echo url_for('classe/show?id='.$classe->getId()) ?>"><?php echo $classe->getId() ?></a></td>
      <td><?php echo $classe->getEtabscoId() ?></td>
      <td><?php echo $classe->getLibelleClasse() ?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

  <a href="<?php echo url_for('classe/new') ?>">New</a>
