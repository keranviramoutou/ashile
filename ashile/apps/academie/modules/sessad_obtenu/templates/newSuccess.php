<?php use_helper('Date') ?>

<h3>Dossier MDPH > Demande Sessad > Affectation des ressources</h3>
<br>

<?php 

//echo '<fieldset><legend><h3>Synthèse </h3></legend>';

echo '<fieldset><legend> vous traitez l\'éleve :<strong> '.$eleve.'&nbsp&nbsp Date de Naissance :&nbsp'.format_date($eleve->datenaissance,'dd/MM/yyyy').'</strong></legend>';
 //echo '<p>Sessad demandé :&nbsp<strong>'. '</strong>&nbsp&nbspDecision CDA : '.$demandesessad->decisioncda. '&nbsp&nbsp Date de la decision CDA : &nbsp' .'<strong>'.format_date($demandesessad->datedecisioncda,'dd/MM/yyyy').'</strong>&nbspDate de debut notif :&nbsp<strong>'.format_date($demandesessad->datedebutnotif,'dd/MM/yyyy').'</strong>&nbspDate de fin notif :&nbsp<strong>'.format_date($demandesessad->datefinnotif,'dd/MM/yyyy').'</strong>&nbsp;</p>';

//echo '<p><i> Dossier MDPH n °&nbsp  <strong>' .$mdph->id.'</strong>&nbsp Date ESS  :&nbsp'.format_date($mdph->dateess,'dd/MM/yyyy').'&nbsp Date envoi dossier : ' .format_date($mdph->dateenvoiedossier,'dd/M/yyyy').'</i></p></fieldset>';
//echo 'ggggg'. $users;

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