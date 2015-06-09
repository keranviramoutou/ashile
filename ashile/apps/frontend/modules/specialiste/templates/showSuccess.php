<?php use_helper('jQuery') ?>
<?php use_stylesheet('data_table.css') ?>
<?php use_stylesheet('datatable_jui.css') ?>


<h1>Détails du Specialiste</h1>

<table cellpadding="0" cellspacing="0" border="0" class="display" id="maTable">
  <tbody>
    <tr>
      <th>Nom:</th>
      <td><?php echo $specialiste->getNom() ?></td>
    </tr>
    <tr>
      <th>Prenom:</th>
      <td><?php echo $specialiste->getPrenom() ?></td>
    </tr>
    <tr>
      <th>Quartier:</th>
      <td><?php echo $specialiste->getQuartierId() ?></td>
    </tr>
    <tr>
      <th>Adressebat:</th>
      <td><?php echo $specialiste->getAdressebat() ?></td>
    </tr>
    <tr>
      <th>Adresserue:</th>
      <td><?php echo $specialiste->getAdresserue() ?></td>
    </tr>
    <tr>
      <th>Tel1:</th>
      <td><?php echo $specialiste->getTel1() ?></td>
    </tr>
    <tr>
      <th>Tel2:</th>
      <td><?php echo $specialiste->getTel2() ?></td>
    </tr>
    <tr>
      <th>Email:</th>
      <td><?php echo $specialiste->getEmail() ?></td>
    </tr>
    <tr>
      <th>Specialite:</th>
      <td><?php echo $specialiste->getSpecialiteId() ?></td>
    </tr>
  </tbody>
</table>

<hr />

<button style="float: left" onClick="window.location.href='<?php echo url_for('specialiste/edit?id='.$specialiste->getId()) ?>'">Edition</button>
&nbsp;
<button style="float: left" onClick="window.location.href='<?php echo url_for('specialiste/index') ?>'">Retour liste</button>
