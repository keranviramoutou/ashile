<?php use_helper('jQuery'); ?>
<?php use_helper('Date') ?>

<?php $nul = true; ?>

<table class="show">
     <tbody>
        <?php foreach ($demande_avss as $demandeavs): ?>
            <?php $nul = false; ?>
            <?php if($demandeavs->getNaturecontratavsId()): ?>
            <tr>
                <th>Type d'avs:</th>
                <td><?php echo Doctrine_core::getTable('Naturecontratavs')->find($demandeavs->getNaturecontratavsId())->getNaturecontrat(); ?></td>
				
            </tr>
            <?php endif; ?>
            
			<?php if($demandeavs->getDateDemandeAvs()): ?>
            <tr>
                <th>Date demande avs :</th>
                <td><?php echo format_date($demandeavs->getDateDemandeAvs(), 'dd/MM/yyyy') ?></td>
            </tr>
            <?php endif; ?>
            <tr>
				<th>Décision de la CDA:</th>
				<?php if($demandeavs->getDecisioncda()==true): ?>


                	<td><?php echo 'Acceptée' ?></td>
					<td>&nbsp;&nbsp;le&nbsp;&nbsp; <?php echo format_date($demandeavs->getDatedecisioncda(), 'dd/MM/yyyy'); ?></td>
						<?php elseif($demandeavs->getDecisioncda()==false && $demandeavs->getDatedecisioncda()): ?>
					<td><?php echo 'Refusé' ?></td>
						<?php elseif(!$demandeavs->getDatedecisioncda()): ?>
					<td><?php echo 'Attente decision' ?></td>
				<?php endif; ?>	
			</tr>	
				
			<!-- ET si datedebut et fin notif sont connu -->
			 <?php if($demandeavs->getDatedebutnotif()): ?>
			<tr>
				<th>Notification du :</th>
				<td><?php echo format_date($demandeavs->getDatedebutnotif(), 'dd/MM/yyyy'); ?>  </td>
			
			<?php endif; ?>
			 <?php  if($demandeavs->getDatefinnotif()): ?>
		
				
				<td>&nbsp;&nbsp;au&nbsp;&nbsp;<?php echo format_date($demandeavs->getDatefinnotif(), 'dd/MM/yyyy'); ?></td>
			</tr>
			<tr>
			<th> Nombre d'heures notifiée(s) : </th>
			<td><?php echo $demandeavs->getQuotitehorrairenotifie().'Heure(s)'; ?></td>
			</tr>
			<?php  endif; ?>

            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

				<?php

					if ($nul == true):
						//echo '<i>Il n\'y a pas de demande avs</i>';
						echo jq_button_to_remote('Nouvelle demande', array(
							'url' => 'demandeavs/new?mdph_id=' . $sf_request->getParameter('mdph_id'),
							'update' => 'acc_avs',
						));
				    elseif(!$demande_avss[0]['datedecisioncda']):

								echo jq_button_to_remote('Supprimer', array(
									'url' => 'demandeavs/delete?id=' . $demande_avss[0]->getId() . '&mdph_id='.$demande_avss[0]->getMdphId() ,
									'update' => 'acc_avs',
								));
					endif ;
				?>

<!-------------------------------------------------------------------------------------------------------------->




