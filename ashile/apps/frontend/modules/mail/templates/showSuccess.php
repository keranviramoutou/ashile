<table>
  <tbody>
    <tr>
      <th>Id:</th>
      <td><?php echo $mail->getId() ?></td>
    </tr>
    <tr>
      <th>Eleve:</th>
      <td><?php echo $mail->getEleveId() ?></td>
    </tr>
    <tr>
      <th>Sf guard user:</th>
      <td><?php echo $mail->getSfGuardUserId() ?></td>
    </tr>
    <tr>
      <th>Date:</th>
      <td><?php echo $mail->getDate() ?></td>
    </tr>
    <tr>
      <th>Sujet:</th>
      <td><?php echo $mail->getSujet() ?></td>
    </tr>
    <tr>
      <th>Texte:</th>
      <td><?php echo $mail->getTexte() ?></td>
    </tr>
  </tbody>
</table>

<hr />

<a href="<?php echo url_for('mail/edit?id='.$mail->getId()) ?>">Edit</a>
&nbsp;
<a href="<?php echo url_for('mail/index') ?>">List</a>
