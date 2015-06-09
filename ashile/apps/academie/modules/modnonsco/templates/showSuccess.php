<table>
  <tbody>
    <tr>
      <th>Id:</th>
      <td><?php echo $modnonsco->getId() ?></td>
    </tr>
    <tr>
      <th>Eleve:</th>
      <td><?php echo $modnonsco->getEleveId() ?></td>
    </tr>
    <tr>
      <th>Etabnonsco:</th>
      <td><?php echo $modnonsco->getEtabnonscoId() ?></td>
    </tr>
    <tr>
      <th>Demijournee:</th>
      <td><?php echo $modnonsco->getDemijourneeId() ?></td>
    </tr>
    <tr>
      <th>Classespe:</th>
      <td><?php echo $modnonsco->getClassespeId() ?></td>
    </tr>
    <tr>
      <th>Quothorreff:</th>
      <td><?php echo $modnonsco->getQuothorreff() ?></td>
    </tr>
    <tr>
      <th>Datedebut:</th>
      <td><?php echo $modnonsco->getDatedebut() ?></td>
    </tr>
    <tr>
      <th>Datefin:</th>
      <td><?php echo $modnonsco->getDatefin() ?></td>
    </tr>
  </tbody>
</table>

<hr />

<a href="<?php echo url_for('modnondco/edit?id='.$modnonsco->getId()) ?>">Edit</a>
&nbsp;
<a href="<?php echo url_for('modnondco/index') ?>">List</a>
