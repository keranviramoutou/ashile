<h3>Gestion des Personnels acc. > Modification d'une fiche d'un AVS</h3>
<?php include_partial('message') ?>


<?php 
echo '<fieldset>';
include_partial('form', array('form' => $form));
echo '</fieldset>';

 ?>

<?php
	// inclusion du partial 'liste des contrats'	------------------------

	if($count_ContratEnCour > 0){		
		echo  '<div id=contratAvs>'; 
			include_partial('list', array('ContratEnCour' => $ContratEnCour));  
		echo '</div>';
		};
?>

