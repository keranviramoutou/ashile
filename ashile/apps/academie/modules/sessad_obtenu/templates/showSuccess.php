<?php use_helper('Date') ?>

<table>
  <tbody>
    <tr>
      <th>Id:</th>
      <td><?php echo $sessad_obtenu->getId() ?></td>
    </tr>
    <tr>
      <th>Eleve:</th>
      <td><?php echo $sessad_obtenu->getEleveId() ?></td>
    </tr>
    <tr>
      <th>Sessad:</th>
      <td><?php echo $sessad_obtenu->getSessadId() ?></td>
    </tr>
    <tr>
      <th>Datedebut:</th>
      <td><?php echo format_date($sessad_obtenu->getDatedebut(), 'dd/MM/yyyy') ?></td>
    </tr>
    <tr>
      <th>Datefin:</th>
      <td><?php echo format_date($sessad_obtenu->getDatefin(), 'dd/MM/yyyy') ?></td>
    </tr>
  </tbody>
</table>

<hr />

<a href="<?php echo url_for('sessad_obtenu/edit?id='.$sessad_obtenu->getId()) ?>">Edit</a>
&nbsp;
<a href="<?php echo url_for('sessad_obtenu/index') ?>">List</a>
