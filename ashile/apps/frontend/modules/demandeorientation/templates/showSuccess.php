<?php 	use_helper('jQuery');
		use_helper('Date');
$nul = true; ?>

<table class="show">
  <tbody>
   <?php // foreach ($demandeorientations as $demandeorientation): ?>
            <?php $nul = false; ?>
    <tr>
      <th>Type de scolarisation (*):</th>
      <td><?php echo $demandeorientations->getClasseext() ?></td>
    </tr>
    <tr>
      <th>Nb de demi-journées :</th>
      <td><?php echo $demandeorientations-> getDemijournee() ?></td>
    </tr>

		<?php if($demandeorientations->getDatedecisioncda()): ?>
		<tr>
			<th>Date decision CDA:</th>
			<td><?php echo format_date($demandeorientations->getDatedecisioncda(), 'dd/MM/yyyy') ?></td>
		</tr>
		<?php endif; ?>
		
		
		<?php if($demandeorientations->getDecisioncda()): ?>
	
			<tr>
				<?php if($demandeorientations->getDecisioncda()==true): ?>
					<th>Decision CDA:</th>

                	<td><?php echo 'Accepté' ?></td>
						<?php elseif($demandeorientations->getDecisioncda()==false && $demandeorientations->getDatedecisioncda()): ?>
					<td><?php echo 'Refusé' ?></td>
						<?php elseif(!$demandeorientations->getDatedecisioncda()): ?>
					<td><?php echo 'Attente decision' ?></td>
				<?php endif; ?>	
            </tr>
            				
				<!-- ET si datedebut et fin notif sont connu -->
				 <?php if($demandeorientations->getDatedebutnotif()): ?>
					<tr>
						<th>Date de début Notification :</th>
						<td>  <?php echo format_date($demandeorientations->getDatedebutnotif(),'dd/MM/yyyy') ?> </td>
					</tr>
				<?php endif; ?>
				 <?php if($demandeorientations->getDatefinnotif()): ?>
					<tr>
						<th>Date de fin de Notification :</th>
						<td>  <?php echo format_date($demandeorientations->getDatefinnotif(),'dd/MM/yyyy') ?> </td>
					</tr>
		
				<?php endif; ?>
			<?php endif; ?>
			<?php //endforeach; ?>
  </tbody>
</table>

</br>

<?php  

//echo 'CDA = '.$cda;


	if($cda == 'EDIT'  ){
       echo jq_button_to_remote('Saisie de la décision', array(
        'url' => 'demandeorientation/edit?id=' . $demandeorientations[0]['id'],
        'update' => 'acc_orientation',
		));

		echo jq_button_to_remote('Supprimer', array(
			'url' => 'demandeorientation/delete?id='.$demandeorientations[0]['id'].'&mdph_id='.$demandeorientations[0]['mdph_id'],
			'update' => 'acc_orientation',
		));		
	}

	if ($cda == 'NEW'){
	   echo '<i>Il n\'y a pas de demande d\'orientation</i>';
		echo jq_button_to_remote('Nouvelle demande d\'orientation', array(
			'url' => 'demandeorientation/new?mdph_id=' .  $sf_request->getParameter('mdph_id'),
			'update' => 'acc_orientation',
		));
	}
	
	
	if ($cda == 'SHOW' && !$demandeorientations->getDatefinnotif() && !$demandeorientations->getDatedebutnotif()){
	       echo jq_button_to_remote('Saisie de la décision', array(
        'url' => 'demandeorientation/edit?id=' . $demandeorientations[0]['id'],
        'update' => 'acc_orientation',
		));
	}




echo jq_button_to_remote('Retour', array(
    'url' => 'demandeorientation/index?mdph_id=' . $sf_request->getParameter('mdph_id'),
    'update' => 'acc_orientation'
));
// si la demande a une datedecisioncda on ne peut plus modifier la demande
if (!$demandeorientations->getDatedecisioncda()):
    echo jq_button_to_remote('Modifier', array(
        'url' => 'demandeorientation/edit?id=' .  $demandeorientations[0]['id'] . '&mdph_id=' .$sf_request->getParameter('mdph_id'),
        'update' => 'acc_orientation',
    ));
else:
   // echo '<p><br><i>La date de decision cda :</i></br></p>';
endif;

?>

