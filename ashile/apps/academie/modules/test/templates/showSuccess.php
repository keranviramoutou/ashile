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
    <tr>
      <th>Num question:</th>
      <td><?php echo $question->getNumQuestion() ?></td>
    </tr>
  </tbody>
</table>

<hr />

<a href="<?php echo url_for('test/edit?id='.$question->getId()) ?>">Edit</a>
&nbsp;
<a href="<?php echo url_for('test/index') ?>">List</a>
