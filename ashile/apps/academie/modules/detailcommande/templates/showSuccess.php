<table>
  <tbody>
    <tr>
      <th>Id:</th>
      <td><?php echo $detail_commande->getId() ?></td>
    </tr>
    <tr>
      <th>Typemateriel:</th>
      <td><?php echo $detail_commande->getTypematerielId() ?></td>
    </tr>
    <tr>
      <th>Commande:</th>
      <td><?php echo $detail_commande->getCommandeId() ?></td>
    </tr>
    <tr>
      <th>Specification:</th>
      <td><?php echo $detail_commande->getSpecification() ?></td>
    </tr>
    <tr>
      <th>Quantite:</th>
      <td><?php echo $detail_commande->getQuantite() ?></td>
    </tr>
    <tr>
      <th>Datelivraison:</th>
      <td><?php echo $detail_commande->getDatelivraison() ?></td>
    </tr>
  </tbody>
</table>

<hr />

<a href="<?php echo url_for('detailcommande/edit?id='.$detail_commande->getId()) ?>">Edit</a>
&nbsp;
<a href="<?php echo url_for('detailcommande/index') ?>">List</a>
