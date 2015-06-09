<h1>Liste des Materiels en prêt</h1>

<?php $i = 1 ?>

<?php use_helper('jQuery') ?>

<table>
  <thead>
    <tr>
      <th>Type</th>
      <th>Debut pr&ecirc;t</th>
      <th>Fin pr&ecirc;t</th>
      <th>Date de convention</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($materiels as $materiel): ?>
            <tr onclick="<?php echo jq_remote_function(array('url' => 'materiel/show?eleve_id=' . $materiel->getEleveId() . '&id=' . $materiel->getId(), 'update' => 'div_materiel', 'method' => 'get')) ?>" class="<?php echo fmod($i, 2) ? 'even' : 'odd' ?>" style="cursor: pointer">
      <td><?php echo Doctrine_core::getTable('Typemateriel')->findOneById($materiel->getTypematerielId()) ?></td>
      <td><?php echo Tools::convertYmdTodmY($materiel->getDatedebut()) ?></td>
      <td><?php echo Tools::convertYmdTodmY($materiel->getDateFin()) ?></td>
      <td><?php echo Tools::convertYmdTodmY($materiel->getDateconvention()) ?></td>
    </tr>	
<?php $i++ ?>
        <?php endforeach; ?>
        <?php if ($i == 1): ?>
            <tr><td colspan="4" style="font-style: italic">Cet élève n'a pas de materiels</td></tr>
        <?php endif; ?>
    </tbody>
</table>
