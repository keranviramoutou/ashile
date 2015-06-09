<?php use_helper('Date') ?>
<h3><?php echo 'Gestion des personnels > Edition Contrat ' ; ?></h3>
<div id="contrat_avs">
<?php include_partial('message') ?>

<fieldset><?php echo 'Avs :&nbsp;<strong>'. $avs[0]['nom'].' '.$avs[0]['prenom'].'</strong>'; ?>
<?php echo '<br>né(e) le :&nbsp;<strong>'. format_date($avs[0]['date_naissance'],'dd/MM/yyyy').'</strong>'; ?>
<?php echo '<p><i>Téléphone(s) :&nbsp;<strong>'. $avs[0]['tel1'].' '.$avs[0]['tel2'].'</strong>&nbspemail:&nbsp; <strong>'.$avs[0]['email'].'</strong></i></p>'; ?>

</fieldset>
<?php
		echo '</fieldset>';
		echo '<fieldset>';
		include_partial('form', array('form' => $form, 'form2' => $form2));
		echo '</fieldset>';
?>
</div>

<div id="position_avs">
<?php //	if ($existetestPosition)
	//	{
	//	include_partial('infoPosition', array('position'=>$position, 'contratAvs'=>$contratAvs));		
	//	}
		
?>
</div>
<?php // Historique des contrats pour l'avs concerné?>
<?php include_partial('listcontrat', array('ContratEnCour'=>$ContratEnCour));		?>

