<h3>Gestion des personnels accompagnants > Personnels acc.par type de contrat</h3>

<table>
  <thead>
    <tr>
    
      <th>Selectionner un type de contrat</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($type_contrat_avss as $type_contrat_avs): ?>
    <tr>
      <td><a href="<?php echo url_for('contrat_avs/Typecontrat?typecontratavs_id='.$type_contrat_avs->getId()) ?>"><?php echo $type_contrat_avs->getTypecontrat() ?></a></td>
      <td><?php ?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

 
