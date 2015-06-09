<h3>Liste des types de contrat</h3>
 
<?php  include_partial('filters', array('filters' => $filters)) ?>

<table>
  <thead>
    <tr>
      <th>Id</th>
      <th>Typecontrat</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($$pager->getResults() as $type_contrat_avs): ?>
    <tr>
      <td><a href="<?php echo url_for('type_contrat_avs/edit?id='.$type_contrat_avs->getId()) ?>"><?php echo $type_contrat_avs->getId() ?></a></td>
      <td><?php echo $type_contrat_avs->getTypecontrat() ?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

  <a href="<?php echo url_for('type_contrat_avs/new') ?>">New</a>
