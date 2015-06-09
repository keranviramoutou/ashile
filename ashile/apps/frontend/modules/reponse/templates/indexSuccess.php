<h1>Reponses List</h1>

<table>
  <thead>
    <tr>
      <th>Id</th>
      <th>Reponse</th>
      <th>Libelle reponse</th>
      <th>Question</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($reponses as $reponse): ?>
    <tr>
      <td><a href="<?php echo url_for('reponse/show?id='.$reponse->getId()) ?>"><?php echo $reponse->getId() ?></a></td>
      <td><?php echo $reponse->getReponse() ?></td>
      <td><?php echo $reponse->getLibelleReponse() ?></td>
      <td><?php echo $reponse->getQuestionId() ?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

  <a href="<?php echo url_for('reponse/new') ?>">New</a>
