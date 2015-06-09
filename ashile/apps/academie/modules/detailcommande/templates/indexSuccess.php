<h1>Detail commandes List</h1>

<table>
  <thead>
    <tr>
      <th>Id</th>
      <th>Typemateriel</th>
      <th>Commande</th>
      <th>Specification</th>
      <th>Quantite</th>
      <th>Datelivraison</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($detail_commandes as $detail_commande): ?>
    <tr>
      <td><a href="<?php echo url_for('detailcommande/show?id='.$detail_commande->getId()) ?>"><?php echo $detail_commande->getId() ?></a></td>
      <td><?php echo $detail_commande->getTypematerielId() ?></td>
      <td><?php echo $detail_commande->getCommandeId() ?></td>
      <td><?php echo $detail_commande->getSpecification() ?></td>
      <td><?php echo $detail_commande->getQuantite() ?></td>
      <td><?php echo $detail_commande->getDatelivraison() ?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

  <a href="<?php echo url_for('detailcommande/new') ?>">New</a>
