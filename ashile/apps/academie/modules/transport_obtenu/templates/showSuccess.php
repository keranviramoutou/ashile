<table>
  <tbody>
    <tr>
      <th>Id:</th>
      <td><?php echo $transport_obtenu->getId() ?></td>
    </tr>
    <tr>
      <th>Transport:</th>
      <td><?php echo $transport_obtenu->getTransportId() ?></td>
    </tr>
    <tr>
      <th>Eleve:</th>
      <td><?php echo $transport_obtenu->getEleveId() ?></td>
    </tr>
    <tr>
      <th>Datedebut:</th>
      <td><?php echo $transport_obtenu->getDatedebut() ?></td>
    </tr>
    <tr>
      <th>Datefin:</th>
      <td><?php echo $transport_obtenu->getDatefin() ?></td>
    </tr>
  </tbody>
</table>

<hr />

<a href="<?php echo url_for('transport_obtenu/edit?id='.$transport_obtenu->getId()) ?>">Edit</a>
&nbsp;
<a href="<?php echo url_for('transport_obtenu/index') ?>">List</a>
