<?php use_helper('Date') ?>
<h3>Eleves > Changement de Scolarisation ou clôture de la scolarisation en cours</h3>



<?php
     echo '<fieldset><legend>Elève :&nbsp;'.$eleve[0]['nom'].' '.$eleve[0]['prenom'].'</strong>&nbsp;&nbsp; né(e) le &nbsp :&nbsp;<strong>'.format_date($eleve[0]['datenaissance'],'dd/MM/yyyy').'&nbsp;</legend></strong>';
	  echo '<br>Secteur de :&nbsp;<strong>'.$eleve[0]['libellesecteur'].'</strong></br>';
	  if(existeleve){ //test si l'élève a une scolarisation en cours
	  echo   '<br>Scolarisé(e) à &nbsp;<strong>'.$eleve[0]['typetab'].'&nbsp;'.$eleve[0]['nometabsco'].'</strong>&nbsp;du :&nbsp; <strong>'.format_date($eleve[0]['datedebut'],'dd/MM/yyyy').'</strong>&nbsp;au&nbsp;<strong> '.format_date($eleve[0]['datefin'],'dd/MM/yyyy').'</strong></br>';
	  echo '<br>Niveau scolaire :&nbsp;<strong>'.$eleve[0]['nomniveauscolaire'].'</strong>&nbsp;Classe :&nbsp;<strong>'.$eleve[0]['nomlongtypeclasse'].'</strong></br>';
	  echo '<br>Nbre de demi-journée<strong> :&nbsp;'.$eleve[0]['libelledemijournee'].'</strong></br>';
	  
	  
?>
<form action="<?php echo url_for('orientation/cloture'); ?>" method="POST">

  <table>
	  
	  
	 <!-------------------------------------------------------------------->

    <tfoot>
      <tr>

						à la date du &nbsp &nbsp <input type="text" name="maj" id ="calendrier">
							<p><input type="submit" value="Clôturer" /></p>

	
      </tr>
    </tfoot>
  
    <!--------------------------------------------------------------------->
    
    


  
</table>
</form>

<?php	  
	
	  echo '</fieldset>';
	  }else{
	  echo 'élève pas scolarisé(e) cette année à la date du jour !!';
	  }
	 include_partial('message');  
?>
	 




