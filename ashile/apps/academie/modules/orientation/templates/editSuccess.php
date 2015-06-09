<?php use_helper('Date') ?>
<?php use_stylesheet('data_table.css') ?>
<?php use_stylesheet('datatable_jui.css') ?>

<h3>Eleves > Changement de Scolarisation ou clôture de la scolarisation en cours</h3>
<?php $orientation = $form->getObject() ?>
<div id="orientation">

<?php
     echo '<fieldset><legend>Elève :&nbsp;'.$eleve[0]['nom'].' '.$eleve[0]['prenom'].'</strong>&nbsp;&nbsp; né(e) le &nbsp :&nbsp;<strong>'.format_date($eleve[0]['datenaissance'],'dd/MM/yyyy').'&nbsp;</legend></strong>';
	  echo '<br>Secteur de :&nbsp;<strong>'.$eleve[0]['libellesecteur'].'</strong></br>';
	  if($existeleve){ //test si l'élève a une scolarisation en cours
	  echo   '<br>Scolarisé(e) à &nbsp;<strong>'.$eleve[0]['typetab'].'&nbsp;'.$eleve[0]['nometabsco'].'</strong>&nbsp;du :&nbsp; <strong>'.format_date($eleve[0]['datedebut'],'dd/MM/yyyy').'</strong>&nbsp;au&nbsp;<strong> '.format_date($eleve[0]['datefin'],'dd/MM/yyyy').'</strong></br>';
	  echo '<br>Niveau scolaire :&nbsp;<strong>'.$eleve[0]['nomniveauscolaire'].'</strong>&nbsp;Classe :&nbsp;<strong>'.$eleve[0]['nomlongtypeclasse'].'</strong></br>';
	  echo '<br>Nbre de demi-journée<strong> :&nbsp;'.$eleve[0]['libelledemijournee'].'</strong></br>';
	  echo '</fieldset>';
?>



<?php	  
	
	
	  }else{
	  echo 'élève pas scolarisé(e) cette année à la date du jour !!';
	  }
	 include_partial('message');  
	 include_partial('form', array('form' => $form, 'etabs' => $etabs));
	 include_partial('scolarisation', array('scolarisation' => $scolarisation,'existhistosco'=> $existhistosco));
	 
?>

</div>

