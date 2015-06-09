<table>
  <tbody>
    <tr>
      <th>Id:</th>
      <td><?php echo $eleve->getId() ?></td>
    </tr>
    <tr>
      <th>Quartier:</th>
      <td><?php echo $eleve->getQuartierId() ?></td>
    </tr>
    <tr>
      <th>Secteur:</th>
      <td><?php echo $eleve->getSecteurId() ?></td>
    </tr>
    <tr>
      <th>Ine:</th>
      <td><?php echo $eleve->getIne() ?></td>
    </tr>
    <tr>
      <th>Numeromdph:</th>
      <td><?php echo $eleve->getNumeromdph() ?></td>
    </tr>
    <tr>
      <th>Nom:</th>
      <td><?php echo $eleve->getNom() ?></td>
    </tr>
    <tr>
      <th>Prenom:</th>
      <td><?php echo $eleve->getPrenom() ?></td>
    </tr>
    <tr>
      <th>Datenaissance:</th>
      <td><?php echo $eleve->getDatenaissance() ?></td>
    </tr>
    <tr>
      <th>Adresseelevebat:</th>
      <td><?php echo $eleve->getAdresseelevebat() ?></td>
    </tr>
    <tr>
      <th>Adresseleverue:</th>
      <td><?php echo $eleve->getAdresseleverue() ?></td>
    </tr>
    <tr>
      <th>Notes:</th>
      <td><?php echo $eleve->getNotes() ?></td>
    </tr>
    <tr>
      <th>Sexe:</th>
      <td><?php echo $eleve->getSexe() ?></td>
    </tr>
    <tr>
      <th>Datesortie:</th>
      <td><?php echo $eleve->getDatesortie() ?></td>
    </tr>
    <tr>
      <th>Motif:</th>
      <td><?php echo $eleve->getMotif() ?></td>
    </tr>
  </tbody>
</table>

<hr />

<a href="<?php echo url_for('eleve/edit?id='.$eleve->getId()) ?>">Edit</a>
&nbsp;
<a href="<?php echo url_for('eleve/index') ?>">List</a>
