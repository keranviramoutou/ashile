<?php use_helper('Date') ?>


<h3>Dossier MDPH > Demande Sessad > Affectation des ressources  </h3>
<br>


<?php $sessad_obtenu = $form->getObject() ?>


<?php

echo '<fieldset><legend>éleve :<strong> '.$sessad_obtenu->getEleve()->getNom().'&nbsp&nbsp'.$sessad_obtenu->getEleve()->getPrenom().'&nbsp&nbsp Date de Naissance :&nbsp'.format_date($sessad_obtenu->getEleve()->getdatenaissance(),'dd/MM/yyyy').'<strong></legend>';
 if(existdemande_sessad){
 	 echo ' <legend>Dossier MDPH n°&nbsp :<strong> '.$demande_sessad[0]['MdphId'].'</strong>&nbsp&nbsp Nature du Sessad demandé : <strong>'.$demande_sessad[0]['libelletypesessad'].'</strong><br><br> notifiée du &nbsp:&nbsp<strong>'.format_date($demande_sessad[0]['datedebutnotif'],'dd/MM/yyyy').'</strong>&nbsp&nbspau&nbsp&nbsp<strong>'.format_date($demande_sessad[0]['datefinnotif'],'dd/MM/yyyy')
	 .'</strong>&nbsp-&nbspDécision de la CDA du :&nbsp<strong>'.format_date($demande_sessad[0]['datedecisioncda'],'dd/MM/yyyy');
	  }
 
echo '</fieldset>';
?>

<?php
echo '<fieldset>';
include_partial('form', array('form' => $form)) ;
echo '</fieldset>';
?>




