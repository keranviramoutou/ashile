
<?php use_helper('Date') ?>

<h3>Dossier MDPH > Demande de transport > Affectation des ressources</h3>
<br>
<?php

echo '<fieldset><legend> vous traitez l\'éleve :<strong> '.$eleve.'&nbsp&nbsp Date de Naissance :&nbsp'.format_date($eleve->datenaissance,'dd/MM/yyyy').'</strong></legend>';
 if(existdemande_transport){
 	 echo ' <legend>Dossier MDPH n°&nbsp :<strong> '.$demande_transport[0]['MdphId'].'</strong>&nbsp&nbsp Nature du Transport obtenu : <strong>'.$demande_transport[0]['libelletransport'].'</strong><br><br> notifiée du &nbsp:&nbsp<strong>'.format_date($demande_transport[0]['datedebutnotif'],'dd/MM/yyyy').'</strong>&nbsp&nbspau&nbsp&nbsp<strong>'.format_date($demande_transport[0]['datefinnotif'],'dd/MM/yyyy')
	 .'</strong>&nbsp-&nbspDécision de la CDA du :&nbsp<strong>'.format_date($demande_transport[0]['datedecisioncda'],'dd/MM/yyyy');
	  }
 
echo '</fieldset>';
?>



<?php
echo '<fieldset>';
include_partial('form', array('form' => $form)) ;
echo '</fieldset>';
?>
