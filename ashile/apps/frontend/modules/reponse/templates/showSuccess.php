<table>
  <tbody>
    <tr>
      <th>Id:</th>
      <td><?php echo $reponse->getId() ?></td>
    </tr>
    <tr>
      <th>Reponse:</th>
      <td><?php echo $reponse->getReponse() ?></td>
    </tr>
    <tr>
      <th>Libelle reponse:</th>
      <td><?php echo $reponse->getLibelleReponse() ?></td>
    </tr>
    <tr>
      <th>Question:</th>
      <td><?php echo $reponse->getQuestionId() ?></td>
    </tr>
  </tbody>
</table>

<hr />

<a href="<?php echo url_for('reponse/edit?id='.$reponse->getId()) ?>">Edit</a>
&nbsp;
<a href="<?php echo url_for('reponse/index') ?>">List</a>
