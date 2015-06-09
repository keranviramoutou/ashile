<?php use_helper('Date') ?>

<table>
  <tbody>
    <tr>
      <th>Transport :</th>
      <td><?php echo $transportobtenu->getTransport() ?></td>
    </tr>
    <tr>
      <th>Date de debut transport :</th>
      <td><?php echo format_date($transportobtenu->getDatedebut(), 'dd/MM/yyyy') ?></td>
    </tr>
    <tr>
      <th>Date de fin transport :</th>
      <td><?php echo format_date($transportobtenu->getDatefin(), 'dd/MM/yyyy') ?></td>
    </tr>
  </tbody>
</table>

<hr />

<?php use_helper('jQuery') ?>

&nbsp;
<?php echo jq_button_to_remote('Revenir à la liste', array('url' => 'transportobtenu/index?eleve_id=' . $transportobtenu->getEleveId().'&transport_id='.$transportobtenu->getTransportId(), 'update' => 'div_transport')) ?>
<script type="text/javascript">
    $j("input:submit, input:button, form a").button();
</script>
