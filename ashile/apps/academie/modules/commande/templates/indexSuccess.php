<h1>Commandes List</h1>

<table>
  <thead>
    <tr>
      <th>Id</th>
      <th>Fournisseur</th>
      <th>Date commande</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($commandes as $commande): ?>
    <tr>
      <td><a href="<?php echo url_for('commande/show?id='.$commande->getId()) ?>"><?php echo $commande->getId() ?></a></td>
      <td><?php echo $commande->getFournisseurId() ?></td>
      <td><?php echo $commande->getDateCommande() ?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

  <a href="<?php echo url_for('commande/new') ?>">New</a>
