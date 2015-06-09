<?php $i = 1 ?>
<table class="tabList">
    <thead>
        <tr>
			  <th>Nature du Sessad</th>
			  <th>Etablissement  </th>
			  <th>Début de prise en charge </th>
			  <th>Find de prise en charge </th>>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($sessadobtenus as $sessadobtenu): ?>
            <tr>
			  <td><center><?php echo $sessadobtenu->getSessad() ?></td>
			  <td><center><?php echo Doctrine::getTable('Sessad')->findOneById($sessadobtenu->getSessadId())->getEtabnonsco() ?></td>
			  <td><center><?php echo Tools::convertYmdTodmY($sessadobtenu->getDatedebut()) ?></center></td>
			  <td><center><?php echo Tools::convertYmdTodmY($sessadobtenu->getDatefin()) ?></center></td>
            </tr>
            <?php $i++ ?>
        <?php endforeach; ?>
        <?php if ($i == 1): ?>
            <tr><td colspan="4" style="font-style: italic">Il n'y a pas de demande sessad</td></tr>
        <?php endif; ?>
    </tbody>
</table>
