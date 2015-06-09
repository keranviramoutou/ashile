<h3>demandes avs</h3>

<?php 
	$eleve_id = "";
 ?>

<?php use_helper('jQuery') ?>
  <div id="sf_admin_content">

    <div class="academie">
<table>
  <thead>
    <tr>
      <th>Eleve</th>
      <th>Nature contrat AVS</th>
      <th>Date d'envoi du dossier</th>		
    </tr>
  </thead>

<?php
	foreach($demandeavss as $demandeavs):

	// 2 requetes pour recuperer eleve_id et donc eleve du dossier mdph a l'origine de la demande.
		$eleve = Doctrine_Query::create()
						->select('m.eleve_id')
						->from('Mdph m')
						->where('m.id = ?', $demandeavs->getMdphId())
						->execute();
		$q = Doctrine_Query::create()
			->select('*')
			->from('Eleve e')
			->where('e.id = ?', $eleve[0]['eleve_id'])
			->execute();
?>
<tr onClick="window.location.href='<?php echo url_for('@demandeavs_edit?id=' . $demandeavs->getId()) ?>'">
	<td>
	<?php	
		$maVar = '('.$q['0']['ine'].')'." ".$q['0']['prenom']." ".$q['0']['nom'];
		$this->monEleve = $maVar; 
			echo $maVar;
	?></td>
	      <td><?php echo $demandeavs->getQualiteavs() ?></td>
	      <td><?php echo $demandeavs->getDateDemandeAvs() ?></td>
    </tr>	
        <?php endforeach; ?>
</table>
</div>
</div>



