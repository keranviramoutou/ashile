<?php use_helper('Date') ?>
<!-- creation d'un bandeau d'information sur le contrat -->
<div id="position_avs">
<h2>Nouvelle Position pour le contrat </h2>
<!--------------------------------------------------------->
<fieldset><legend>Avs</legend><?php echo 'Avs :&nbsp;<strong>'. $avs[0]['nom'].' '.$avs[0]['prenom'].'</strong>'; ?>
<?php echo '<br>né(e) le :&nbsp;<strong>'. format_date($avs[0]['date_naissance'],'dd/MM/yyyy').'</strong>'; ?>
<?php echo '<p><i>Téléphone(s) :&nbsp;<strong>'. $avs[0]['tel1'].' '.$avs[0]['tel2'].'</strong>&nbspemail:&nbsp; <strong>'.$avs[0]['email'].'</strong></i></p>'; ?>
</fieldset>
<fieldset><legend>Contrat</legend><?php echo 'Du :&nbsp;<strong>'.format_date($avs[0]['date_debut_contrat'],'dd/MM/yyyy').'&nbsp;au&nbsp;'.format_date($avs[0]['date_fin_contrat'],'dd/MM/yyyy').'</strong>'; ?>

<?php echo '<p>Type du contrat :&nbsp;<strong>'. $avs[0]['typecontrat'].'&nbsp;Quotité horaire hebdo. :&nbsp;'.$avs[0]['temps_hebdo'].'Heure(s)</strong>'; ?>

<?php echo '<p>Etablissement Employeur :&nbsp;<strong>'. $avs[0]['typetab'].'&nbsp;'.$avs[0]['etab'].'&nbsp;-&nbsp;'.$avs[0]['rne'].'</strong>'; ?>
</fieldset>
<?php echo '<fieldset><legend>Position</legend>' ?>
<?php include_partial('form', array('form' => $form)) ?>
<?php echo '</fieldset>' ?>
<div>