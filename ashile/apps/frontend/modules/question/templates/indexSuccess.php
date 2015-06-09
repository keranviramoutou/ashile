<h1>Questions List</h1>

<table>
  <thead>
    <tr>
      <th>Id</th>
      <th>Question</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($questions as $question): ?>
    <tr>
      <td><a href="<?php echo url_for('question/show?id='.$question->getId()) ?>"><?php echo $question->getId() ?></a></td>
      <td><?php echo $question->getQuestion() ?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

  <a href="<?php echo url_for('question/new') ?>">New</a>
