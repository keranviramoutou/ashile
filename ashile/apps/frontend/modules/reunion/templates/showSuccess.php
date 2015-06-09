<?php use_helper('Date') ?>
<?php use_helper('jQuery') ?>

<h1>Informations sur la reunion</h1>

<fieldset>
    <legend>Détails</legend>
    <table class="show">
  <tbody>
    <tr>
      <th>Type de reunion :</th>
      <td><?php echo $reunion->getLibellereunion() ?></td>
    </tr>
    <tr>
      <th>Date de la reunion :</th>
      <td><?php echo format_date( $reunion->getDatereunion(),'dd/MM/yyyy') ?></td>
    </tr>
    <tr>
      <th>Observations :</th>
      <td><?php echo $reunion->getObservation() ?></td>
    </tr>
  </tbody>
</table>
</fieldset>
<hr />

&nbsp;
<?php echo jq_button_to_remote('Edition', array('url' => 'reunion/edit?id=' .  $reunion->getId() . '&eleve_id=' . $reunion->getEleveId() , 'update' => 'div_reunion')) ?>
<?php echo jq_button_to_remote('Revenir à la liste', array('url' => 'reunion/index?eleve_id=' . $reunion->getEleveId().'&id='.$reunion->getId(), 'update' => 'div_reunion')) ?>

