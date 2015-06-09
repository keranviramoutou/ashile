<table>
  <tbody>
    <tr>
      <th>Id:</th>
      <td><?php echo $position_avs->getId() ?></td>
    </tr>
    <tr>
      <th>Contratavs:</th>
      <td><?php echo $position_avs->getContratavsId() ?></td>
    </tr>
    <tr>
      <th>Typepositionavs:</th>
      <td><?php echo $position_avs->getTypepositionavsId() ?></td>
    </tr>
    <tr>
      <th>Datedebut:</th>
      <td><?php echo $position_avs->getDatedebut() ?></td>
    </tr>
    <tr>
      <th>Datefin:</th>
      <td><?php echo $position_avs->getDatefin() ?></td>
    </tr>
  </tbody>
</table>

<hr />

<a href="<?php echo url_for('position_avs/edit?id='.$position_avs->getId()) ?>">Edit</a>
&nbsp;
<a href="<?php echo url_for('position_avs/index') ?>">List</a>
