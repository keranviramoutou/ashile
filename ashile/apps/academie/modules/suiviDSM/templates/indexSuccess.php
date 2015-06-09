<h1>Demande avss List</h1>

<table>
  <thead>
    <tr>
      <th>Id</th>
      <th>Mdph</th>
      <th>Naturecontratavs</th>
      <th>Date demande avs</th>
      <th>Datedebutnotif</th>
      <th>Datefinnotif</th>
      <th>Datedecisioncda</th>
      <th>Decisioncda</th>
      <th>Traite</th>
      <th>Etat</th>
      <th>Notes</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($demande_avss as $demande_avs): ?>
    <tr>
      <td><a href="<?php echo url_for('suiviDSM/show?id='.$demande_avs->getId()) ?>"><?php echo $demande_avs->getId() ?></a></td>
      <td><?php echo $demande_avs->getMdphId() ?></td>
      <td><?php echo $demande_avs->getNaturecontratavsId() ?></td>
      <td><?php echo $demande_avs->getDateDemandeAvs() ?></td>
      <td><?php echo $demande_avs->getDatedebutnotif() ?></td>
      <td><?php echo $demande_avs->getDatefinnotif() ?></td>
      <td><?php echo $demande_avs->getDatedecisioncda() ?></td>
      <td><?php echo $demande_avs->getDecisioncda() ?></td>
      <td><?php echo $demande_avs->getTraite() ?></td>
      <td><?php echo $demande_avs->getEtat() ?></td>
      <td><?php echo $demande_avs->getNotes() ?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

  <a href="<?php echo url_for('suiviDSM/new') ?>">New</a>
