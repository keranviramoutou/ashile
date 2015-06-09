<?php use_helper('Date') ?>

<table>
  <tbody>
    <tr>
      <th>Eleve:</th>
      <td><?php echo $elevemateriel->getEleveId() ?></td>
    </tr>
    <tr>
      <th>Materiel:</th>
      <td><?php echo $elevemateriel->getMaterielId() ?></td>
    </tr>
    <tr>
      <th>Dateconvention:</th>
      <td><?php echo format_date($elevemateriel->getDateconvention(), 'dd/MM/yyyy') ?></td>
    </tr>
    <tr>
      <th>Datedebut:</th>
      <td><?php echo format_date($elevemateriel->getDatedebut(), 'dd/MM/yyyy') ?></td>
    </tr>
    <tr>
      <th>Datefin:</th>
      <td><?php echo format_date($elevemateriel->getDatefin(), 'dd/MM/yyyy') ?></td>
    </tr>
  </tbody>
</table>

<hr />

<a href="<?php echo url_for('eleve_materiel/edit?eleve_id='.$elevemateriel->getEleveId().'&materiel_id='.$elevemateriel->getMaterielId()) ?>">Edit</a>
&nbsp;
<a href="<?php echo url_for('eleve_materiel/index') ?>">List</a>
