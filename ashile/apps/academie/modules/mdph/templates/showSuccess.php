<table>
  <tbody>
    <tr>
      <th>Id:</th>
      <td><?php echo $mdph->getId() ?></td>
    </tr>
    <tr>
      <th>Eleve:</th>
      <td><?php echo $mdph->getEleveId() ?></td>
    </tr>
    <tr>
      <th>Datecreationpps:</th>
      <td><?php echo $mdph->getDatecreationpps() ?></td>
    </tr>
    <tr>
      <th>Nbheuresavs:</th>
      <td><?php echo $mdph->getNbheuresavs() ?></td>
    </tr>
    <tr>
      <th>Dateenvoiedossier:</th>
      <td><?php echo $mdph->getDateenvoiedossier() ?></td>
    </tr>
    <tr>
      <th>Etat:</th>
      <td><?php echo $mdph->getEtat() ?></td>
    </tr>
    <tr>
      <th>Dateess:</th>
      <td><?php echo $mdph->getDateess() ?></td>
    </tr>
    <tr>
      <th>Datepjdom:</th>
      <td><?php echo $mdph->getDatepjdom() ?></td>
    </tr>
    <tr>
      <th>Datepjident:</th>
      <td><?php echo $mdph->getDatepjident() ?></td>
    </tr>
  </tbody>
</table>

<hr />

<a href="<?php echo url_for('mdph/edit?id='.$mdph->getId()) ?>">Edit</a>
&nbsp;
<a href="<?php echo url_for('mdph/index') ?>">List</a>
