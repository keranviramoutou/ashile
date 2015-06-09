<?php use_helper('Date') ?>
<h3>Gestion des AVS > Nouveau Contrat </h3>
<div id="contrat_avs" >
<fieldset><?php echo 'Avs :&nbsp;<strong>'. $avs['nom'].' '.$avs['prenom'].'</strong>'; ?>
<?php echo '<br>né(e) le :&nbsp;<strong>'. format_date($avs['date_naissance'],'dd/MM/yyyy').'</strong>'; ?>
<?php echo '<p><i>Téléphone(s) :&nbsp;<strong>'. $avs['tel1'].' '.$avs['tel2'].'</strong>&nbspemail:&nbsp; <strong>'.$avs['email'].'</strong></i></p>'; ?>

</fieldset>
<?php include_partial('message') ?>
<fieldset>
<?php 

		include_partial('form', array('form' => $form));
		if ($existetestPosition)
		{
		include_partial('infoPosition', array('position'=>$position, 'contratAvs'=>$contratAvs));		
		}
?>
</fieldset>
</div>