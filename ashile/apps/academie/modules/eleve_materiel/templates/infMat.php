<fieldset>
	<legend>Detail AVS</legend>
		<table>
			<tr><td>Nom : </td><td><?php echo $avs->getNom(); ?></td></tr>
			<tr><td>Prenom : </td><td><?php echo $avs->getPrenom(); ?></td></tr>
			<tr><td>Telephone : </td><td><?php echo $avs->getTel1(); ?></td></tr>
			<tr><td>E-mail : </td><td><?php echo $avs->getEmail(); ?></td></tr>
			<tr><td>Temps hebdo : </td><td><?php echo $infoContrat->getTempsHebdo(); ?></td></tr>
			<tr><td>Nature contrat : </td><td><?php echo $infoContrat->getNaturecontratavs(); ?></td></tr>
			<tr><td>Type contrat : </td><td><?php echo $infoContrat->getTypeContratAvs(); ?></td></tr>
			<tr><td>Date fin de contrat : </td><td><?php echo $infoContrat->getDateFinContrat(); ?></td></tr>
			<?php 	if($eleveEnCharge): ?>
						<tr><td>Eleve en charge : </td><td><?php echo $eleveEnCharge; ?></td></tr>
			<?php   endif;
			
					if($quotitehorraire): ?>		
					<tr><td>Quotite horraire affecté :</td><td><?php echo $quotitehorraire; ?></td></tr>
			<?php endif;
			
					if($datedebut): ?>		
					<tr><td>Date de debut de prise en charge :</td><td><?php echo $datedebut; ?></td></tr>		  
			<?php endif;
			
					if($datefin): ?>		
					<tr><td>Date de fin de prise en charge :</td><td><?php echo $datefin; ?></td></tr>
			<?php endif; ?>	
		</table>
</fieldset>		
