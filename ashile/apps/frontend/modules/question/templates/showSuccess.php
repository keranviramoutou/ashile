<table>
  <tbody>
    <tr>
      <th>Id:</th>
      <td><?php echo $question->getId() ?></td>
    </tr>
    <tr>
      <th>Question:</th>
      <td><?php echo $question->getQuestion() ?></td>
    </tr>
  </tbody>
</table>

<hr />

<a href="<?php echo url_for('question/edit?id='.$question->getId()) ?>">Edit</a>
&nbsp;
<a href="<?php echo url_for('question/index') ?>">List</a>
