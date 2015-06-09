<?php use_helper('Date') ?>

<table>
  <tbody>
    <tr>
      <th>Id:</th>
      <td><?php echo $bilan->getId() ?></td>
    </tr>
    <tr>
      <th>Specialiste:</th>
      <td><?php echo $bilan->getSpecialiste() ?></td>
    </tr>
    <tr>
      <th>Mdph:</th>
      <td><?php echo $bilan->getMdphId() ?></td>
    </tr>
    <tr>
      <th>Libelle bilan:</th>
      <td><?php echo $bilan->getNaturebilan() ?></td>
    </tr>
    <tr>
      <th>Date bilan:</th>
      <td><?php echo  format_date($bilan->getDateBilan(), 'dd/MM/yyyy') ?></td>
    </tr>
  </tbody>
</table>

<hr />

<a href="<?php echo url_for('bilan/edit?id='.$bilan->getId()) ?>">Edition</a>
&nbsp;
<a href="<?php echo url_for('bilan/index') ?>">List</a>
