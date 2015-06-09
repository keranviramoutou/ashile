<?php use_helper('Date') ?>

<?php $i = 1 ?>
<table class="tabList">
    <thead>
        <tr>
            <th>Type de transport</th>
            <th>Date de demande transport</th>
            <th>Date de d&eacute;cision CDA</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($demande_transports as $demande_transport): ?>
            <tr>
                <td><?php echo Doctrine::getTable('Typetransport')->find($demande_transport->getTransportId())->getLibelletypetransport() ?></td>
                <td><?php echo format_date($demande_transport->getDateDemandeTransport(), 'dd/MM/yyyy') ?></td>
            </tr>
            <?php $i++ ?>
        <?php endforeach; ?>
        <?php if ($i == 1): ?>
            <tr><td colspan="4" style="font-weight:normal"></td></tr>
        <?php endif; ?>
    </tbody>
</table>
