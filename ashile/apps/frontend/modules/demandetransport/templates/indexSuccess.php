<h1>Demandetransports List</h1>
<?php $i = 1 ?>
<?php use_helper('jQuery') ?>
<table class="tabulaire">
    <thead>
        <tr>
            <th>Transport</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($demandetransports as $demandetransport): ?>
            <tr  onclick="<?php echo jq_remote_function(array('url' => 'demandetransport/edit?transport_id=' . $demandetransport->getId(), 'update' => 'acc_transport')) ?>" class="<?php echo fmod($i, 2) ? 'even' : 'odd' ?>" style="cursor: pointer">
                <td><?php echo Doctrine::getTable('Transport')->find($demandetransport->getTransportId())->getLibelletransport() ?></td>

            </tr>
            <?php $i++ ?>
        <?php endforeach; ?>
        <?php if ($i == 1): ?>
            <tr><td colspan="3" style="font-weight:normal"></td></tr>
        <?php endif; ?>
    </tbody>
</table>

<?php
echo jq_button_to_remote('Nouvelle demande', array(
    'url' => 'demandetransport/new?mdph_id=' . $sf_request->getParameter('mdph_id'),
    'update' => 'acc_transport',
))
?>
