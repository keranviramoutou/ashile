<table>
  <tbody>
    <tr>
      <th>Id:</th>
      <td><?php echo $commande->getId() ?></td>
    </tr>
    <tr>
      <th>Fournisseur:</th>
      <td><?php echo $commande->getFournisseurId() ?></td>
    </tr>
    <tr>
      <th>Date commande:</th>
      <td><?php echo $commande->getDateCommande() ?></td>
    </tr>
  </tbody>
</table>

<hr />

<a href="<?php echo url_for('commande/edit?id='.$commande->getId()) ?>">Edit</a>
&nbsp;
<a href="<?php echo url_for('commande/index') ?>">List</a>
