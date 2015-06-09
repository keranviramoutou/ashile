<h1>Edit Commande</h1>

<?php include_partial('form', array('form' => $form)) ?>

<!-- On affiches les details commande de cette commande -->

<?php 
	if($detailcommande){
		include_partial('detail_commande', array('detailcommandes' => $detailcommandes));
	}	
?>	
