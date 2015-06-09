<?php use_helper('Date') ?>
<h3>Eleves > Nouvelle scolarité</h3>
<div id="orientation">

<?php
     echo '<fieldset><legend>Elève :&nbsp;'.$eleve[0]['nom'].' '.$eleve[0]['prenom'].'</strong>&nbsp;&nbsp; né(e) le &nbsp :&nbsp;<strong>'.format_date($eleve[0]['datenaissance'],'dd/MM/yyyy').'&nbsp;</legend></strong>';
	  echo '<br>Secteur de :&nbsp;<strong>'.$eleve[0]['libellesecteur'].'</strong></br>';
	  if($existeleve > 0){ //test si l'élève a une scolarisation en cours
	  echo   '<br>Scolarisé(e) à &nbsp;<strong>'.$eleve[0]['typetab'].'&nbsp;'.$eleve[0]['nometabsco'].'</strong>&nbsp;du :&nbsp; <strong>'.format_date($eleve[0]['datedebut'],'dd/MM/yyyy').'</strong>&nbsp;au&nbsp;<strong> '.format_date($eleve[0]['datefin'],'dd/MM/yyyy').'</strong></br>';
	  echo '<br>Niveau scolaire :&nbsp;<strong>'.$eleve[0]['nomniveauscolaire'].'</strong>&nbsp;Classe :&nbsp;<strong>'.$eleve[0]['nomlongtypeclasse'].'</strong></br>';
	  echo '<br>Nbre de demi-journée<strong> :&nbsp;'.$eleve[0]['libelledemijournee'].'</strong></br>';
?>
<br><strong><a href="<?php echo url_for('orientation/edit?id=' . $eleve[0]['orienId'].'&secteur_id=' . $eleve[0]['secteur_id'].'&eleve_id=' . $eleve[0]['eleveId'] ) ?>"><?php echo 'clôturer scolarisation en cours'  ?></br></strong></a>
		
		
		<input id="csecteur" type= "button" onclick= "test()" value= "Changer Secteur"><br>
		<input id="ctest" type = "text" name = "test">
<?php	  
	
	  echo '</fieldset>';
	  }else{
	  echo 'élève pas scolarisé(e) cette année à la date du jour !!';
	   echo '</fieldset>';
	  }
	  
	 include_partial('form', array('form' => $form));
	 include_partial('scolarisation', array('scolarisation' => $scolarisation));
?>


</div>


<script language="javascript">
function test() {
$param = 0;
alert('changement de secteur pris en compte '+$param);
 if ( document.getElementById("csecteur").value === "Changer Secteur" ){
document.getElementById("csecteur").value = "changement de secteur demandé"; //change la valeur du bouton
document.getElementById("ctest").value = "test";
$param = 1;
alert('ddddd');
}else{
document.getElementById("csecteur").value = "Changer secteur";
alert('dd');
$param = 0;
}
return 1; }
</script>