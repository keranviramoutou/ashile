<?php 	use_helper('jQuery');
		use_helper('Date'); 

$nul = true; ?>
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
            
            <?php if($demandeavs->getDatedecisioncda()): ?>
				<tr>
					<th>Date décision CDA:</th>
					<td><?php echo format_date($demandeavs->getDatedecisioncda(), 'dd/MM/yyyy') ?></td>
				</tr>
            <?php endif; ?>
			
			
            <tr>
				<th>Décision de la CDA:</th>
				<?php if($demandeavs->getDecisioncda()==true): ?>


                	<td><?php echo 'Acceptée' ?></td>
						<?php elseif($demandeavs->getDecisioncda()==false && $demandeavs->getDatedecisioncda()): ?>
					<td><?php echo 'Refusé' ?></td>
						<?php elseif(!$demandeavs->getDatedecisioncda()): ?>
					<td><?php echo 'Attente decision' ?></td>
				<?php endif; ?>	
			</tr>	
				
			<!-- ET si datedebut et fin notif sont connu -->
			 <?php if($demandeavs->getDatedebutnotif()): ?>
			<tr>
				<th>Notification </th>
				<td><?php echo 'du&nbsp;'.format_date($demandeavs->getDatedebutnotif(), 'dd/MM/yyyy').'&nbsp;au&nbsp;'. format_date($demandeavs->getDatefinnotif(), 'dd/MM/yyyy'); ?>  </td>
			<?php endif; ?>
		
			</tr>
			
			
			<tr>
			<th> Nombre d'heures notifiée(s) : </th>
			<td><?php echo $demandeavs->getQuotitehorrairenotifie().'Heure(s)'; ?></td>
			</tr>
			

            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<?php if ($nul): ?>
    <i>Il n'y a pas de demande Avs</i>
<?php endif; ?>

