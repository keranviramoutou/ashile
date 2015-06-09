<h3>Dossier MDPH > Demande de Transport > Affectation des ressources </h3>
<br>




<?php use_helper('Date') ?>

<?php $transport_obtenu = $form->getObject() ?>

<?php

echo '<fieldset><legend>éleve :<strong> '.$transport_obtenu->getEleve()->getNom().'&nbsp&nbsp'.$transport_obtenu->getEleve()->getPrenom().'&nbsp&nbsp Date de Naissance :&nbsp'.format_date($transport_obtenu->getEleve()->getdatenaissance(),'dd/MM/yyyy').'<strong></legend>';
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
