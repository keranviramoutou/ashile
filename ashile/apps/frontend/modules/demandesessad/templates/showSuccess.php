<?php 	use_helper('jQuery');
		use_helper('Date');
$nul = true; ?>

<table class="show">
    <tbody>

        <?php foreach ($demande_sessads as $demande_sessad): ?>
            <?php $nul = false; ?>
            <tr>
                <th>Type de sessad :</th>
                <td><?php echo Doctrine_core::getTable('Typesessad')->findOneById($demande_sessad->getTypesessadId()); ?></td>
            </tr>


            <?php if($demande_sessad->getDatedecisioncda()): ?>
				<tr>
					<th>Date décision CDA:</th>
					<td><?php echo format_date($demande_sessad->getDatedecisioncda(), 'dd/MM/yyyy') ?></td>
				</tr>
            <?php endif; ?>
            

				
					<?php if($demande_sessad->getDecisioncda()==true && $demande_sessad->getDatefinnotif() && $demande_sessad->getDatedebutnotif()){ ?>
						<tr>
						<th>Décision CDA :</th>
						<td><?php echo 'Accepté' ?></td>
						<tr>
					<?php } ?>
						
					<?php if($demande_sessad->getDecisioncda()==false && $demande_sessad->getDatedecisioncda()){?>
						<tr>
						<th>Décision CDA :</th>
						<td><?php echo 'Refusé' ?></td>
						</tr>
					<?php } ?>
					
					<?php if (!$demande_sessad->getDatedecisioncda()){ ?>
						<tr>
					    <th>Décision CDA :</th>
					    <td><?php echo 'Attente de décision' ; ?></td> 
					    </tr>
					  <?php }?>
     
            				
				<!-- ET si datedebut et fin notif sont connu -->
				 <?php if($demande_sessad->getDatedebutnotif()): ?>
					<tr>
						<th>Début Notification :</th>
						<td>  <?php echo format_date($demande_sessad->getDatedebutnotif(),'dd/MM/yyyy') ?> </td>
					</tr>
				<?php endif; ?>
				 <?php if($demande_sessad->getDatefinnotif()): ?>
					<tr>
						<th>Fin de Notification :</th>
						<td>  <?php echo format_date($demande_sessad->getDatefinnotif(),'dd/MM/yyyy') ?> </td>
					</tr>
				
            <?php endif; ?>

			<?php endforeach; ?>

    </tbody>
</table>
<br>


<br />
<?php 
		if ($cda == 'NEW'){
		echo '';
		echo jq_button_to_remote('Nouvelle demande', array(
			'url' => 'demandesessad/new?mdph_id=' . $sf_request->getParameter('mdph_id'),
			'update' => 'acc_sessad',
		));}
		
		
		if($cda == 'ATTENTE'){
		   echo jq_button_to_remote('Saisie de la décision', array(
			'url' => 'demandesessad/edit?id=' . $demande_sessads[0]['id'],
			'update' => 'acc_sessad',
			));

			echo jq_button_to_remote('Supprimer', array(
				'url' => 'demandesessad/delete?id='.$demande_sessads[0]['id'].'&mdph_id='.$demande_sessads[0]['mdph_id'],
				'update' => 'acc_sessad',
			));		
		}
	
	
		if ($cda == 'REJET' ){ //rejet
		   echo jq_button_to_remote('Modification de la décision', array(
			'url' => 'demandesessad/edit?id=' . $demande_sessads[0]['id'],
			'update' => 'acc_sessad',
			));
		   	echo jq_button_to_remote('Supprimer', array(
				'url' => 'demandesessad/delete?id='.$demande_sessads[0]['id'].'&mdph_id='.$demande_sessads[0]['mdph_id'],
				'update' => 'acc_sessad',
			));	
		}
		
			if ($cda == 'ACCORD' && $count_sessad_obtenu_a_completer > 0){ //rejet
				echo 'un Sessad est généré , il faut le compléter voir onglet Sessad';
			}
?>
