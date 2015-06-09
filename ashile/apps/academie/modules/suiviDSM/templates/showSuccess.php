<table>
  <tbody>
    <tr>
      <th>Id:</th>
      <td><?php echo $demande_avs->getId() ?></td>
    </tr>
    <tr>
      <th>Mdph:</th>
      <td><?php echo $demande_avs->getMdphId() ?></td>
    </tr>
    <tr>
      <th>Naturecontratavs:</th>
      <td><?php echo $demande_avs->getNaturecontratavsId() ?></td>
    </tr>
    <tr>
      <th>Date demande avs:</th>
      <td><?php echo $demande_avs->getDateDemandeAvs() ?></td>
    </tr>
    <tr>
      <th>Datedebutnotif:</th>
      <td><?php echo $demande_avs->getDatedebutnotif() ?></td>
    </tr>
    <tr>
      <th>Datefinnotif:</th>
      <td><?php echo $demande_avs->getDatefinnotif() ?></td>
    </tr>
    <tr>
      <th>Datedecisioncda:</th>
      <td><?php echo $demande_avs->getDatedecisioncda() ?></td>
    </tr>
    <tr>
      <th>Decisioncda:</th>
      <td><?php echo $demande_avs->getDecisioncda() ?></td>
    </tr>
    <tr>
      <th>Traite:</th>
      <td><?php echo $demande_avs->getTraite() ?></td>
    </tr>
    <tr>
      <th>Etat:</th>
      <td><?php echo $demande_avs->getEtat() ?></td>
    </tr>
    <tr>
      <th>Notes:</th>
      <td><?php echo $demande_avs->getNotes() ?></td>
    </tr>
  </tbody>
</table>

<hr />

<a href="<?php echo url_for('suiviDSM/edit?id='.$demande_avs->getId()) ?>">Edit</a>
&nbsp;
<a href="<?php echo url_for('suiviDSM/index') ?>">List</a>
