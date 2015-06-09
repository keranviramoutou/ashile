<?php 	use_helper('jQuery');
		use_helper('Date');
$nul = true; ?>


<table class="show">
    <tbody>

        <?php foreach ($demande_transports as $demande_transport): ?>
            <?php $nul = false; ?>
 
            <tr>
                <th>Nature du transport :</th>
                <td><?php echo Doctrine_core::getTable('Transport')->findOneById($demande_transport->getTransportId()); ?></td>
				
            </tr>

            <?php if($demande_transport->getDatedecisioncda()): ?>
				<tr>
					<th>Date de la décision de la CDA :</th>
					<td><?php echo format_date($demande_transport->getDatedecisioncda(), 'dd/MM/yyyy') ?></td>
				</tr>
            <?php endif; ?>
            
       
            
           

				<?php if($demande_transport->getDecisioncda()==true && $demande_transport->getDatefinnotif() && $demande_transport->getDatedebutnotif()){ ?>
						<tr>
						<th>Décision CDA :</th>
						<td><?php echo 'Accepté' ?></td>
						<tr>
					<?php } ?>
						
					<?php if($demande_transport->getDecisioncda()==false && $demande_transport->getDatedecisioncda()){?>
						<tr>
						<th>Décision CDA :</th>
						<td><?php echo 'Refusé' ?></td>
						</tr>
					<?php } ?>
					
					<?php if (!$demande_transport->getDatedecisioncda()){ ?>
						<tr>
					    <th>Décision CDA :</th>
					    <td><?php echo 'Attente de décision' ; ?></td> 
					    </tr>
					  <?php }?>
					
		
          
            				
				<!-- ET si datedebut et fin notif sont connu -->
				 <?php if($demande_transport->getDatedebutnotif()): ?>
					<tr>
						<th>Notifiée du  :</th>
						<td>  <?php echo format_date($demande_transport->getDatedebutnotif(),'dd/MM/yyyy') ?> </td>
					
				<?php endif; ?>
				 <?php if($demande_transport->getDatefinnotif()): ?>
				
						<th>Au </th>
						<td>  <?php echo format_date($demande_transport->getDatefinnotif(),'dd/MM/yyyy') ?> </td>
					</tr>
				<?php endif; ?>
        
            <?php endforeach; ?>
    </tbody>
</table>
<br>



<?php 
		if ($cda == 'NEW'){
		echo '';
	   // echo '<i>Il n\'y a pas de demande sessad</i>';
    echo jq_button_to_remote('Nouvelle demande' , array(
        'url' => 'demandetransport/new?mdph_id=' . $sf_request->getParameter('mdph_id'),
        'update' => 'acc_transport',));
    }
		

	
		if($cda == 'ATTENTE'){
		       echo jq_button_to_remote('Modification de la décision', array(
        'url' => 'demandetransport/edit?id=' . $demande_transports[0]['id'],
        'update' => 'acc_transport',
		));
		
		echo jq_button_to_remote('Supprimer', array(
			'url' => 'demandetransport/delete?id='.$demande_transports[0]['id'].'&mdph_id='.$demande_transports[0]['mdph_id'],
			'update' => 'acc_transport',
		));	
		
	
		}
	
	
		if ($cda == 'REJET' ){ //rejet
       echo jq_button_to_remote('Modification de la décision', array(
        'url' => 'demandetransport/edit?id=' . $demande_transports[0]['id'],
        'update' => 'acc_transport',
		));
		echo jq_button_to_remote('Supprimer', array(
			'url' => 'demandetransport/delete?id='.$demande_transports[0]['id'].'&mdph_id='.$demande_transports[0]['mdph_id'],
			'update' => 'acc_transport',
		));	
		}
		
		if ($cda == 'ACCORD' && $count_transport_obtenu_a_completer > 0){ //rejet
				echo 'un Transport est généré , il faut le compléter voir onglet Transport';
			}
?>	
<br />

