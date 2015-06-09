<h1>Questions List</h1>

<table>
  <thead>
    <tr>
      <th>Id</th>
      <th>Question</th>
      <th>Num question</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($questions as $question): ?>
    <tr>
      <td><a href="<?php echo url_for('test/show?id='.$question->getId()) ?>"><?php echo $question->getId() ?></a></td>
      <td><?php echo $question->getQuestion() ?></td>
      <td><?php echo $question->getNumQuestion() ?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

  <a href="<?php echo url_for('test/new') ?>">New</a>
