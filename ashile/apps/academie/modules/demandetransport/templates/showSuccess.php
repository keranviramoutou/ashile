<?php use_helper('Date') ?>

<table>
  <tbody>
    <tr>
      <th>Id:</th>
      <td><?php echo $demande_transport->getId() ?></td>
    </tr>
    <tr>
      <th>Transport:</th>
      <td><?php echo $demande_transport->getTransportId() ?></td>
    </tr>
    <tr>
      <th>Mdph:</th>
      <td><?php echo $demande_transport->getMdphId() ?></td>
    </tr>
    <tr>
      <th>Date demande transport:</th>
      <td><?php echo format_date($demande_transport->getDateDemandeTransport(), 'dd/MM/yyyy') ?></td>
    </tr>
    <tr>
      <th>Datedecisioncda:</th>
      <td><?php echo format_date($demande_transport->getDatedecisioncda, 'dd/MM/yyyy') ?></td>
    </tr>
    <tr>
      <th>Decisioncda:</th>
      <td><?php echo $demande_transport->getDecisioncda() ?></td>
    </tr>
    <tr>
      <th>Traite:</th>
      <td><?php echo $demande_transport->getTraite() ?></td>
    </tr>
    <tr>
      <th>Etat:</th>
      <td><?php echo $demande_transport->getEtat() ?></td>
    </tr>
  </tbody>
</table>

<hr />

<a href="<?php echo url_for('demandetransport/edit?id='.$demande_transport->getId()) ?>">Edit</a>
&nbsp;
<a href="<?php echo url_for('demandetransport/index') ?>">List</a>
